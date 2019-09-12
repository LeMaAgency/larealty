<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оставить заявку на продажу/покупку");
?>

    <section class="help">
        <div class="container">
            <div class="help-form zayavka_page_form">
                <form action="<?= SITE_DIR; ?>ajax/zayavka.php" class="js-sale_page-form" method="POST" enctype="multipart/form-data">
                    <h2 class="section-h2">
                        <? $APPLICATION->IncludeFile(SITE_DIR . 'include/zayavki_page_form/form_title.php'); ?>
                    </h2>
                    <div class="subtitle">
                        <? $APPLICATION->IncludeFile(SITE_DIR . 'include/zayavki_page_form/form_subtitle.php'); ?>
                    </div>
                    <div class="form-row">
                        <div class="it-block">
                            <input type="text" placeholder="Имя *" name="name" required>
                            <div class="it-error"></div>
                        </div>
                        <div class="it-block">
                            <input type="text" class="phone_mask" placeholder="+7(___)___-__-__" name="phone" required>
                            <div class="it-error"></div>
                        </div>
                        <!--<div class="it-block">
                            <input type="text" placeholder="E-mail *" name="email" required>
                            <div class="it-error"></div>
                        </div>-->

                    </div>
                    <div class="it-block">
                        <textarea placeholder="Комментарии" name="comment"></textarea>
                        <div class="it-error"></div>
                    </div>
                    <div class="it-block">
                        <div class="file_input_wrap">
                            <label class="file_input" for="file_input_arenda_prodazha"><i class="fa fa-folder-open-o" aria-hidden="true"></i> Прикепить файлы... <span id="file_count"></span></label>
                            <span class="file_input_info">Вы можете прикрепить до 10 файлов, форматов docx,doc,jpeg,jpg,png</span>
                            <input id="file_input_arenda_prodazha" type="file" placeholder="Прикрепите файлы" name="files[]" multiple="multiple" accept=".docx,.doc,.jpeg,.jpg,.png">
                            <div id="upload_progress">

                            </div>
                        </div>
                        <div class="it-error"></div>
                    </div>
                    <div class="help-consent">
                        <? $APPLICATION->IncludeFile(SITE_DIR . 'include/zayavki_page_form/personal_data_text.php'); ?>
                    </div>
                    <div class="help-btn">
                        <button class="hover-black">
                            Отправить заявку
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>