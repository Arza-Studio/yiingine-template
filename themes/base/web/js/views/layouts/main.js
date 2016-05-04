/**
 * @link https://github.com/Arza-Studio/yiingine
 * @copyright Copyright (c) 2016 ARZA Studio
 * @license https://github.com/Arza-Studio/yiingine/blob/master/LICENSE.md
 */

function initializeMainMenuDropdownHover(dropdowns)
{
    if($(window).width()>=768)
    {
        // Require Bootstrap Hover Dropdown Plugin (see : AppAssets)
        dropdowns.dropdownHover({delay:0}); // delay is the time to wait before closing a dropdown when the mouse is no longer over it.
    }
}
function initializeMainMenu()
{
    // Disabled menu items click behaviour
    $('.mainMenu .disabled a').on('click', function(e)
    {
        e.preventDefault();
    });
    // Get dropdowns
    var dropdowns = $('.mainMenu .dropdown-toggle');
    // Initialize dropdowns hover behaviour
    initializeMainMenuDropdownHover(dropdowns);
    // Initialize dropdowns click behaviour
    dropdowns.on('click', function(e)
    {
        if('ontouchstart' in document || $(window).width()<768 || $(this).parent().hasClass('disabled'))
        {
            return;
        }
        else
        {
            window.location.href = this.href;
        }
    });
    // On window resizing
    $(window).resize(function()
    {
        // Unbind dropdowns hover from dropdownHover()
        dropdowns.unbind('mouseenter mouseleave');
        dropdowns.parent().unbind('mouseenter mouseleave');
        dropdowns.parent().find('.dropdown-submenu').unbind('mouseenter mouseleave');
        // Re-initialize dropdowns hover behaviour
        initializeMainMenuDropdownHover(dropdowns);
    });
}
