<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

global $APPLICATION;

?>
    <footer class="footer">
        <div class="container">
            <div class="footer-top">
                <div class="footer-logo"><img src="/assets/img/footer-logo.png" alt="img"></div>
                <? $APPLICATION->IncludeComponent('bitrix:menu', 'footer_menu', array(
                    'ALLOW_MULTI_SELECT' => 'N',
                    'ROOT_MENU_TYPE' => 'footer',
                    'CHILD_MENU_TYPE' => 'footer',
                    'DELAY' => 'N',
                    'MAX_LEVEL' => '1',
                    'MENU_CACHE_GET_VARS' => array(),
                    'MENU_CACHE_TIME' => '3600',
                    'MENU_CACHE_TYPE' => 'A',
                    'MENU_CACHE_USE_GROUPS' => 'N',
                    'USE_EXT' => 'Y',
                    'COMPONENT_TEMPLATE' => 'footer_menu'
                )); ?>
            </div>
            <div class="footer-bottom">
                <div class="footer-copyright"><? $APPLICATION->IncludeFile(SITE_DIR . 'include/footer/copyright.php'); ?></div>
                <div class="footer-social">
                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/footer/social.php'); ?>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>