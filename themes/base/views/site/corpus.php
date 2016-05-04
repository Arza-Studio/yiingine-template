<?php 
/**
 * @link https://github.com/Arza-Studio/yiingine
 * @copyright Copyright (c) 2016 ARZA Studio
 * @license https://github.com/Arza-Studio/yiingine/blob/master/LICENSE.md
 */
?>

/* Headings */

.corpus h1,
.corpus .h1
{
    font-family: "FontBold", Helvetica, Arial, sans-serif;
    color: <?php echo Yii::$app->palette->get('BrandPrimary'); ?>;
}
.corpus h2,
.corpus .h2
{
    font-family: "FontBold", Helvetica, Arial, sans-serif;
    color: <?php echo Yii::$app->palette->get('BrandPrimary', -30); ?>;
}
.corpus h3,
.corpus .h3
{
    font-family: "FontBold", Helvetica, Arial, sans-serif;
    color: <?php echo Yii::$app->palette->get('BrandPrimary', -60); ?>;
}
.corpus h4,
.corpus .h4
{
    font-family: "FontRegular", Helvetica, Arial, sans-serif;
    color: <?php echo Yii::$app->palette->get('BrandPrimary', -60); ?>;
}

/* Paragraphs and List */

.corpus p,
.corpus li
{
    font-family: "FontRegular", Helvetica, Arial, sans-serif;
    color: <?php echo Yii::$app->palette->get('Gray', -30); ?>;
    font-size: 14px;
}
@media (min-width: 992px)
{
    .corpus p,
    .corpus li
    {
        font-size: 14.5px;
    } 
}
@media (min-width: 1200px)
{
    .corpus p,
    .corpus li
    {
        font-size: 15px;
    } 
}

/* Links */
.corpus a
{
    font-family: "FontRegular", Helvetica, Arial, sans-serif;
    color: <?php echo Yii::$app->palette->get('BrandPrimary'); ?>
    text-decoration: none;
    font-size: inherit;
}
.corpus a:hover,
.corpus h1 a:hover,
.corpus h2 a:hover,
.corpus h3 a:hover,
.corpus h4 a:hover
{
    color: <?php echo Yii::$app->palette->get('Gray', 60); ?>;
    text-decoration: underline;
}
.corpus a:active,
.corpus h1 a:active,
.corpus h2 a:active,
.corpus h3 a:active,
.corpus h4 a:active
{
    color: <?php echo Yii::$app->palette->get('Gray', -60); ?>;
    text-decoration: underline;
}

/* Links on images */
.corpus a img
{
    border-color: <?php echo Yii::$app->palette->get('Gray', -20); ?>;
}
.corpus a:hover img
{
    border-color: <?php echo Yii::$app->palette->get('BrandPrimary', -20); ?>;
}
.corpus a:active img
{
    border-color: <?php echo Yii::$app->palette->get('BrandPrimary'); ?>;
}

/* Bold (not corpus only) */
strong,
b
{
    font-family: 'FontBold', Arial, Helvetica, sans-serif;
    font-weight: normal;
}

/* Italic (not corpus only) */
i,
em
{
    font-family: 'FontRegularItalic', Arial, Helvetica, sans-serif;
    font-style: normal;
}

/* Bold Italic (not corpus only) */
strong i,
strong em,
b i,
b em
{
    font-family: 'FontBoldItalic', Arial, Helvetica, sans-serif;
    font-weight: normal;
    font-style: normal;
}

/* Highlighting */
.corpus .highlight
{
    background-color: <?php echo Yii::$app->palette->get('BrandPrimary', 70); ?>;
}

/* Separators */
.corpus hr
{
    background-color: <?php echo Yii::$app->palette->get('Gray', 80); ?>;
    margin: 5px 0 5px 0;
}

/* Grid inside corpus */
@media (min-width: 768px)
{
    .corpus .col-sm-6:first-of-type
    {
        padding-right: 6px;
    }
    .corpus .col-sm-6:last-of-type
    {
        padding-left: 6px;
    }
    .corpus .col-sm-4:nth-child(1)
    {
        padding-right: 3px;
    }
    .corpus .col-sm-4:nth-child(2)
    {
        padding-right: 9px;
        padding-left: 9px;
    }
    .corpus .col-sm-4:nth-child(3)
    {
        padding-left: 3px;
    }
}
