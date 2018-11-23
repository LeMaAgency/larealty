<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>

    <div class="item-card">
        <div class="container">
            <? \Lema\Components\Breadcrumbs::inc('catalog'); ?>
        </div>
    </div>
    <section class="catalog-text">
    <div class="container bhelp">
        <h1><?=$APPLICATION->ShowTitle();?></h1>
        <p>
            <? $APPLICATION->IncludeFile(SITE_DIR . 'include/contacts/text.php'); ?>
        </p>
        <div class="help-form">
            <form action="<?= SITE_DIR; ?>ajax/contacts.php" class="js-contacts-form" method="POST">
                <h2 class="section-h2">
                    Остались вопросы?
                </h2>
                <div class="form-row">
                    <div class="it-block">
                        <input type="text" placeholder="Имя *" name="name" required>
                        <div class="it-error"></div>
                    </div>
                    <div class="it-block">
                        <input type="text" placeholder="Телефон *" name="phone" required>
                        <div class="it-error"></div>
                    </div>
                    <div class="it-block">
                        <input type="text" placeholder="E-mail *" name="email" required>
                        <div class="it-error"></div>
                    </div>
                </div>
                <div class="it-block">
                    <textarea placeholder="Задайте свой вопрос здесь" name="comment"></textarea>
                    <div class="it-error"></div>
                </div>
                <div class="help-consent">
                    Нажимая на кнопку «Отправить», Вы даете согласие на обработку персональных данных<br>
                    в соответствии с <a href="#">«Положением об обработке персональных данных»</a>
                </div>
                <div class="help-btn">
                    <button class="hover-black">
                        Отправить заявку
                    </button>
                </div>
            </form>
        </div>
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>