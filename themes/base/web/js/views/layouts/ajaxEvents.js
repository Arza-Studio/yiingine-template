/**
 * @link https://github.com/Arza-Studio/yiingine
 * @copyright Copyright (c) 2016 ARZA Studio
 * @license https://github.com/Arza-Studio/yiingine/blob/master/LICENSE.md
 */

/** This function is called prior to an ajax request.
 @param string href the requested url.
 @param string loadingMessage the message. */
function beforeAjax(href, loadingMessage)
{
    // Menu items locking
    unlockMenuItems('mainMenu');
    lockMenuItems('mainMenu', href + (window.location.hash ? window.location.hash : ""), Yii.Request.baseUrl, Yii.language, Yii.homeUrl);
    unlockMenuItems('footerMenu');
    lockMenuItems('footerMenu', href + (window.location.hash ? window.location.hash : ""), Yii.Request.baseUrl, Yii.language, Yii.homeUrl);
    // Breadcrumb loading
    $("#breadcrumbText").fadeOut(500, function()
    {
        $("#breadcrumbText").html("<a>" + loadingMessage + "</a>").fadeIn(500);
    });
    // Content wrapping
    $("#content").wrapInner("<div id=\"ajaxData\" />").addClass("ajaxLoading");
    // Content fadding out
    $("#ajaxData").fadeOut(200, function()
    {             
         // Add the content css height inline (fixing bug with first height animate)
         contentHeight = $(this).height();
         $("#content").css({height:contentHeight});
         // Animate content height to this min-height
         contentMinHeight = parseInt($("#content").css("min-height")); //'console.log("contentMinHeight : "+contentMinHeight);
         $("#content").animate({height:contentMinHeight}, parseInt((contentHeight-contentMinHeight)/2), function()
         {
             $(window).trigger("resize");
             requestAjax(href);
         });
     });
    // Page scrolling to top
    $("html, body").animate({scrollTop:0});
}

/**This function is called after an ajax request.
 @param string href the requested url.
 @param string data the ajax response.
 */
function afterAjax(href, data)
{
    // BREADCRUMB UPDATE
    $("#breadcrumbText").fadeOut(500, function()
    {
        $("#breadcrumbText").html($(data).find("#breadcrumbText").html()).fadeIn(200);
    });
    
    // SITE WIDE FLASH MESSAGE HANDLING
    // Fade out and remove current flash messages.
    $(".flashMessage").fadeOut(400, function()
    {
        $(".flashMessage").remove();
    });
    // Add loaded general flash messages.
    /* NOTE: use of fade in or fade outs is not possible here because it conflicts
    with the effects of the admin flash messages.*/
    $("#generalFlashMessages").append($(data).find(".flashMessage"));
    
    // CONTENT UPDATE
    // Content wrapping
    $("#ajaxData").html($(data).find("#content").html());
    // Initialize image galleries.
    initCorpusGalleries();
    var displayNewContent = function()
    {
        // Get content height
        contentHeight = $("#ajaxData").height(); //'console.log("contentHeight : "+contentHeight);
        // Content animate height to ajaxData height
        $("#content").animate({height:contentHeight}, parseInt(contentHeight/2), function()
        {
            // Window resize
            $(window).trigger("resize");
            // Remove ajaxLoading class
            $("#content").removeClass("ajaxLoading").css({height:'auto'});
            // Fade in data
            $("#ajaxData").fadeIn(200, function()
            {
                // Unwrap data
                $("#content").html($("#ajaxData").html());
                updateAjaxJs(data, function()
                {
                    // Eval all inline scripts that have not been evaled yet.
                    $(data).filter("script").not("script[src]").each(function()
                    {
                        src = $(this).html();
    
                        if (window.execScript) // For IE.
                        {
                            window.execScript(src);
                            return;
                        }
                        var fn = function() 
                        {
                            window.eval.call(window,src);
                        };
                        fn();
                    });
                });
                // Call initAjax again to parse the links in content.
                initAjax();

                // BODY BACKGROUND UPDATE
                // Retrieve background from the received data
                currentBackground =  $("body").css("background-image").replace("url(","").replace(")",""); //'console.log("currentBackground : "+currentBackground);
                dataBackground = $(data).filter("link[rel=\"body_background\"]").attr("href"); //'console.log("dataBackground : "+dataBackground);
                // Background update
                if(currentBackground!=dataBackground)
                {
                    // Clone backgroundTempZone
                    $(".backgroundTempZone").clone().prependTo("body").addClass("backgroundTempZoneCopy");
                    // Set the css to cover body for the copy 
                    $(".backgroundTempZoneCopy").css(
                    {
                        width:getWindowWidth(),
                        backgroundImage:"url("+currentBackground+")",
                        backgroundRepeat:$("body").css("background-repeat"),
                        backgroundPosition:$("body").css("background-position"),
                        backgroundColor:$("body").css("background-color")
                    });
                    syncDocumentHeight($(".backgroundTempZoneCopy"));
                    
                    // Set bodyBackgroundImageUrl with dataBackground without hostInfo
                    bodyBackgroundImageUrl = dataBackground.replace(window.location.protocol + "//" + window.location.host + Yii.Request.baseUrl, ""); //'console.log("bodyBackgroundImageUrl : "+bodyBackgroundImageUrl);
                    // Empty the current body background (it's necessary for adjustBackgroundTopPosition)
                    //'$("body").css({backgroundImage:"none"});'.
                    // Set new backgroud to body with cropping
                    cropBodyBackground(true, Yii.Request.baseUrl, function()
                    {
                        // Adjust backgroundDivToBobyColor
                        $("#backgroundDivToBodyColor").adjustBackgroundTopPosition();
                        
                        // Fade out and remove backgroundTempZoneCopy
                        $(".backgroundTempZoneCopy").fadeOut(200, function()
                        {
                            $(".backgroundTempZoneCopy").remove();
                        });
                    });
                }
            });
        });
    };

    // PRELOAD IMAGES
    // Get all images in ajax data
    var images = [];
    $("#ajaxData").find("img").each(function()
    {
        images.push($(this).prop("src"));
    });
    // If there are images, preload them first
    if(images.length)
    {
        $.preLoadImages(images, displayNewContent);
    }
    else
    {
        displayNewContent();
    }
}
