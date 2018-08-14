<?
require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php';

$APPLICATION->SetTitle('Контакты');
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?\Lema\Components\Breadcrumbs::inc('breadcrumbs');?>
            </div>
        </div>
    </div>
    <div class="content-page_color">
        <div class="map-wrapper">
            <div id="map_contacts"></div>
        </div>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBr4vuLpC6apKgl5YdtNOgYqjiRerk8X_I&callback=initialize" async></script>
        <div class="container-fluid contacts_data">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="contacts_data__title">
                            <h2> <? $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/our_contacts_block/title.php'); ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <div class="contacts_data_item contacts_data_item__address">
                            <h5><? $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/our_contacts_block/address_title.php'); ?></h5>
                            <div><? $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/our_contacts_block/address_text.php'); ?></div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-lg-3">
                        <div class="contacts_data_item contacts_data_item__time">
                            <h5><? $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/our_contacts_block/work_schedule_title.php'); ?></h5>
                            <? $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/our_contacts_block/work_schedule_text.php'); ?>
                        </div>
                    </div>

                    <div class="clearfix visible-sm"></div>

                    <div class="col-xs-12 col-sm-6 col-lg-3">
                        <div class="contacts_data_item contacts_data_item__phone">
                            <h5><? $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/our_contacts_block/phone_title.php'); ?></h5>
                            <? $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/our_contacts_block/phone_text.php'); ?>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-lg-2">
                        <div class="contacts_data__instagram">
                            <a href="">
                                <img src="<?=SITE_DIR.'assets/img/icons/instagram.png'?>" alt="">
                                <span> <? $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/our_contacts_block/instagram_text.php'); ?></span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container contacts_bottom">
            <div class="row">

                <div class="col-xs-12 col-sm-6 contacts_bottom_email">
                    <div class="contacts_bottom_email__inner">

                        <div class="contacts_bottom_email__inner__img">
                            <img src="<?=SITE_DIR.'assets/img/contacts-footer-img.png'?>" alt="">
                        </div>

                        <div class="contacts_bottom_email__inner__text">
                            <h5><? $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/email_block/title.php'); ?></h5>
                            <span class="description"><? $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/email_block/text.php'); ?></span>
                            <div class="row">

                                <div class="col-xs-12 col-md-6">
                                    <span class="purpose"><? $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/email_block/general_mail_title.php'); ?></span>
                                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/email_block/general_mail_text.php'); ?>
                                </div>

                                <div href="mailto:" class="col-xs-12 col-md-6">
                                    <span class="purpose"><? $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/email_block/resume_mail_title.php'); ?></span>
                                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/email_block/resume_mail_text.php'); ?>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-lg-4 col-lg-offset-2 contacts_bottom_feedback">
                    <h5><? $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/form/title.php'); ?></h5>
                    <? $APPLICATION->IncludeComponent(
	"lema:form.ajax", 
	"to_manager", 
	array(
		"COMPONENT_TEMPLATE" => "to_manager",
		"FORM_CLASS" => "ajax-form",
		"FORM_ACTION" => "",
		"FORM_152_FZ" => "Я ознакомлен <a target=\"_blank\" href=\"/contacts/apply.pdf\">c положением об обработке и защите персональных данных.</a>",
		"FORM_BTN_TITLE" => "Отправить руководителю",
		"FORM_SUCCESS_FUNCTION" => "\$.fancybox.open(\"Ваше сообщение успешно отправлено\")",
		"FORM_SUCCESS_FUNCTION_CORRECT_JSON" => "Y",
		"FORM_FIELDS" => "[
                                {\"name\":\"name\",\"type\":\"text\",\"title\":\"\",\"placeholder\":\"Ваше имя\",\"default\":\"\",\"required\":\"Y\"},
                                {\"name\":\"phone\",\"type\":\"tel\",\"title\":\"\",\"placeholder\":\"Ваш телефон\",\"default\":\"\",\"required\":\"Y\"},
                                {\"name\":\"email\",\"type\":\"text\",\"title\":\"\",\"placeholder\":\"Ваша почта\",\"default\":\"\",\"required\":\"Y\"}
                            ]",
		"NEED_SAVE_TO_IBLOCK" => "Y",
		"NEED_SEND_EMAIL" => "Y",
		"EVENT_TYPE" => "57",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"IBLOCK_TYPE" => "feedback",
		"IBLOCK_ID" => "22"
	),
	false
); ?>
                </div>
            </div>
        </div>
    </div>
<?
require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php';
?>