<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'functions.php';

JHtml::_('bootstrap.framework');

$app = JFactory::getApplication();
$config = JFactory::getConfig();

$defaultLogo = getLogoInfo(array('src' => ''));

// Create alias for $this object reference:
$documentError = $this;
$document = JFactory::getDocument();

if ($app::getRouter()->getMode() == JROUTER_MODE_SEF)
{
    $document->setBase(JUri::getInstance()->toString());
}

$metaGeneratorContent = 'Nicepage 6.11.6, nicepage.com';
if ($metaGeneratorContent) {
    $document->setMetaData('generator', $metaGeneratorContent);
}
$metaReferrer = '';
if ($metaReferrer) {
    $document->setMetaData('referrer', 'origin');
}

$templateUrl = $documentError->baseurl . '/templates/' . $documentError->template;
$faviconPath = "" ? $templateUrl . '/images/' . "" : '';

Core::load("Core_Page");
Core::load("Core_PageProperties");

// Initialize $view:
$view = new CorePage($this);
$indexDir = dirname(__FILE__);

$app = JFactory::getApplication();
$themeOptions = $app->getTemplate(true)->params;
$fileName = $themeOptions->get('page404', '');
if ($fileName) {
    include_once $indexDir . '/views/' . $fileName . '.php';
}

$pageProperties = new CorePageProperties($document, '404');
$bodyClass = $pageProperties->getBodyClass('');
$bodyStyle = $pageProperties->getBodyStyle();
$backToTop = $pageProperties->getBackToTop();
$popupDialogs = $pageProperties->getPopupDialogs();
$showHeader = $pageProperties->showHeader();
$showFooter = $pageProperties->showFooter();
$localFontsFile = $pageProperties->getLocalFontsFile();

$pageContent = isset($document->pageContent) && $document->pageContent ? $document->pageContent : '';
$pageStyles = isset($document->pageStyles) && $document->pageStyles ? $document->pageStyles : '';
$document->pageType = '404';
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <?php if ($faviconPath) : ?>
        <link href="<?php echo $faviconPath; ?>" rel="icon" type="image/x-icon" />
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    
    <meta name="theme-color" content="#478ac9">
    <link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/default.css" media="screen" type="text/css" />
    <?php if($view->isFrontEditing()) : ?>
        <link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/frontediting.css" media="screen" type="text/css" />
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/template.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/media.css" id="theme-media-css" media="screen" type="text/css" />
    <?php if ($localFontsFile) : ?><link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/<?php echo $localFontsFile; ?>" media="screen" type="text/css" /><?php else : ?><?php endif; ?><link id="u-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i|Lobster:400">
    <?php include_once "$indexDir/styles.php"; ?>
    <script src="<?php echo $templateUrl; ?>/scripts/jquery.js"></script>
    <script src="<?php echo $templateUrl; ?>/scripts/script.js"></script>
    <?php echo $pageStyles; ?>
    
    
    
</head>
<body <?php echo $bodyClass . $bodyStyle; ?>>

<?php
if ($showHeader) {
    $view->renderHeader($indexDir);
}
?>
<?php echo $pageContent; ?>
<?php
if ($showFooter) {
    $view->renderFooter($indexDir);
}
?>
<section class="u-backlink u-clearfix u-grey-80">
            <p class="u-text">
                <span>This site was created with the </span>
                <a class="u-link" href="https://nicepage.com/" target="_blank" rel="nofollow">
                    <span>Nicepage</span>
                </a>
             </p>
    </section>

<?php echo $backToTop; ?>
<?php echo $popupDialogs; ?>
</body>
</html>
