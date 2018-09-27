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
<div id="feedback-form" class="fancybox-feedback" style="display: none;">
    <? $APPLICATION->IncludeComponent(
	"lema:form.ajax", 
	"feedback", 
	array(
		"COMPONENT_TEMPLATE" => "feedback",
		"FORM_CLASS" => "ajax-form call-order for_seller",
		"FORM_ACTION" => "",
		"FORM_152_FZ" => "Я ознакомлен <a target=\"_blank\" href=\"/contacts/apply.pdf\">c положением об обработке и защите персональных данных.</a>",
		"FORM_BTN_TITLE" => "Получить консультацию",
		"FORM_SUCCESS_FUNCTION" => "\$.fancybox.open(\"Ваше сообщение успешно отправлено\")",
		"FORM_SUCCESS_FUNCTION_CORRECT_JSON" => "Y",
		"FORM_FIELDS" => "[{\"name\":\"name\",\"type\":\"text\",\"title\":\"\",\"placeholder\":\"Имя\",\"default\":\"\",\"required\":\"Y\"},{\"name\":\"phone\",\"type\":\"tel\",\"title\":\"\",\"placeholder\":\"Телефон\",\"default\":\"\",\"required\":\"Y\"}]",
		"NEED_SAVE_TO_IBLOCK" => "Y",
		"NEED_SEND_EMAIL" => "Y",
		"EVENT_TYPE" => "61",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"IBLOCK_TYPE" => "feedback",
		"IBLOCK_ID" => "13"
	),
	false
); ?>
</div>
</body>

</html>