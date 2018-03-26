<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Продавцу");
?>
    <!-- REASON -->
<? $APPLICATION->IncludeComponent(
	"bitrix:news.detail", 
	"blocks_list", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_CODE" => "reason",
		"ELEMENT_ID" => "",
		"FIELD_CODE" => array(
			0 => "CODE",
			1 => "PREVIEW_TEXT",
			2 => "DETAIL_TEXT",
			3 => "",
		),
		"IBLOCK_ID" => "7",
		"IBLOCK_TYPE" => "content",
		"IBLOCK_URL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Страница",
		"PROPERTY_CODE" => array(
			0 => "LIST_ELEMENTS",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_SHARE" => "N",
		"COMPONENT_TEMPLATE" => "blocks_list"
	),
	false
); ?>
    <!-- /REASON -->
    <div class="request">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <h3 class="request__title">
                        <span class="request__title__small">
                            <? $APPLICATION->IncludeFile(SITE_DIR . 'include/seller/title.php'); ?>
                        </span>
                        <br>
                        <? $APPLICATION->IncludeFile(SITE_DIR . 'include/seller/subtitle.php'); ?>
                    </h3>
                    <div class="request__text">
                        <? $APPLICATION->IncludeFile(SITE_DIR . 'include/seller/description.php'); ?>
                    </div>
                </div>

                <div class="col-xs-12 col-md-6 col-lg-8">
                    <? $APPLICATION->IncludeComponent(
                        "lema:form.ajax",
                        "request",
                        array(
                            "COMPONENT_TEMPLATE" => "request",
                            "FORM_CLASS" => "ajax-form request__form request-form",
                            "FORM_ACTION" => "",
                            "FORM_152_FZ" => "Я ознакомлен <a target=\"_blank\" href=\"/contacts/apply.pdf\">c положением об обработке и защите персональных данных.</a>",
                            "FORM_BTN_TITLE" => "Отправить заявку",
                            "FORM_SUCCESS_FUNCTION" => "\$.fancybox.open(\"Ваше сообщение успешно отправлено\")",
                            "FORM_SUCCESS_FUNCTION_CORRECT_JSON" => "Y",
                            "FORM_FIELDS" => "[{\"name\":\"name\",\"type\":\"text\",\"title\":\"\",\"placeholder\":\"Имя\",\"default\":\"\",\"required\":\"Y\"},{\"name\":\"phone\",\"type\":\"tel\",\"title\":\"\",\"placeholder\":\"Телефон\",\"default\":\"\",\"required\":\"Y\"}]",
                            "NEED_SAVE_TO_IBLOCK" => "N",
                            "NEED_SEND_EMAIL" => "Y",
                            "EVENT_TYPE" => "57",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "3600"
                        ),
                        false
                    ); ?>
                </div>

            </div>
        </div>
    </div>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>