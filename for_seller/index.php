<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Продавцу");
?>
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