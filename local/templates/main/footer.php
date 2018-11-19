<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>

<footer>
    <div class="container">
        <div class="row row-top">
            <div class="col-md-3 col-6">
                <div class="footer-list">
                    <div class="list-item">
                        <a href="#" class="list-title">Жилая в городе</a>
                        <ul>
                            <li><a href="#">Квартира</a></li>
                            <li><a href="#">Особняк</a></li>
                            <li><a href="#">Пентхаус</a></li>
                            <li><a href="#">Новостройки</a></li>
                            <li><a href="#">Аренда</a></li>
                            <li><a href="#">Апартаменты</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="footer-list">
                    <div class="list-item">
                        <a href="#" class="list-title">Загородная</a>
                        <ul>
                            <li><a href="#">Дом</a></li>
                            <li><a href="#">Поселок</a></li>
                            <li><a href="#">Квартира</a></li>
                            <li><a href="#">Участок</a></li>
                            <li><a href="#">Таунхаус</a></li>
                            <li><a href="#">Аренда</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="footer-list">
                    <div class="list-item">
                        <a href="#" class="list-title">Зарубежная</a>
                        <ul>
                            <li><a href="#">Дом</a></li>
                            <li><a href="#">Коммерческая</a></li>
                            <li><a href="#">Вилла</a></li>
                            <li><a href="#">Пентхаус</a></li>
                            <li><a href="#">Апартаменты</a></li>
                            <li><a href="#">Таунхаус</a></li>
                            <li><a href="#">Шале</a></li>
                            <li><a href="#">Гражданство ЕС</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="footer-list last-list">
                    <div class="list-item">
                        <a href="#" class="list-title">Коммерческая</a>
                        <ul>
                            <li><a href="#">Аренда</a></li>
                            <li><a href="#">Продажа</a></li>
                            <li><a href="#">Арендный бизнес</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-bottom">
            <div class="col-md-3 col-6">
                <div class="footer-list_bottom">
                    <div class="list-item">
                        <a href="#" class="list-title">Продажа</a>
                        <ul>
                            <li><a href="#">По метро</a></li>
                            <li><a href="#">По району</a></li>
                            <li><a href="#">По улицам Москвы</a></li>
                            <li><a href="#">Все ЖК Москвы</a></li>
                        </ul>
                    </div>
                    <div class="list-item">
                        <a href="#" class="list-title">Аренда</a>
                        <ul>
                            <li><a href="#">По метро</a></li>
                            <li><a href="#">По району</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="footer-list_bottom">
                    <div class="list-item">
                        <a href="#" class="list-title">Продажа</a>
                        <ul>
                            <li><a href="#">Дома по шоссе</a></li>
                            <li><a href="#">Участки по шоссе</a></li>
                            <li><a href="#">Поселки по шоссе</a></li>
                            <li><a href="#">Все поселки</a></li>
                        </ul>
                    </div>
                    <div class="list-item">
                        <a href="#" class="list-title">Аренда</a>
                        <ul>
                            <li><a href="#">По шоссе</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6"></div>
            <div class="col-md-3 col-12">
                <div class="footer-list_bottom">
                    <div class="list-item last-list">
                        <a href="#" class="list-title">Продажа</a>
                        <ul>
                            <li><a href="#">По метро</a></li>
                            <li><a href="#">По району</a></li>
                            <li><a href="#">Все БЦ Москвы</a></li>
                        </ul>
                    </div>
                    <div class="list-item last-list">
                        <a href="#" class="list-title">Аренда</a>
                        <ul>
                            <li><a href="#">По метро</a></li>
                            <li><a href="#">По району</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container pt1">
        <div class="row">
            <div class="col-lg-3 col-md-8">
                <div class="footer-contact">
                    <div class="footer-phone">
                        <? $APPLICATION->IncludeFile(SITE_DIR . 'include/header/phone.php'); ?>
                    </div>
                    <div class="footer-callback">
                        <a class="hlink" href="#">
                            <? $APPLICATION->IncludeFile(SITE_DIR . 'include/header/phone-text.php'); ?>
                        </a>
                    </div>
                    <div class="copyright">
                        <? $APPLICATION->IncludeFile(SITE_DIR . 'include/footer/copyright.php'); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="footer-social">
                    <h3>
                        <? $APPLICATION->IncludeFile(SITE_DIR . 'include/footer/social-text.php'); ?>
                    </h3>
                    <div class="social-list">
                        <? $APPLICATION->IncludeFile(SITE_DIR . 'include/footer/social-link.php'); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="footer-form">
                    <h3>
                        <? $APPLICATION->IncludeFile(SITE_DIR . 'include/footer/subscribe-text.php'); ?>
                    </h3>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:subscribe.form",
                        "",
                        Array(
                            "CACHE_TIME" => "3600",
                            "CACHE_TYPE" => "A",
                            "PAGE" => "#SITE_DIR#about/subscr_edit.php",
                            "SHOW_HIDDEN" => "N",
                            "USE_PERSONALIZATION" => "Y"
                        )
                    );?>
                    <div class="form-txt">
                        <? $APPLICATION->IncludeFile(SITE_DIR . 'include/footer/subscribe-subtext.php'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-txt">
            <? $APPLICATION->IncludeFile(SITE_DIR . 'include/footer/bottom-text.php'); ?>
        </div>
    </div>
</footer>
</body>
</html>