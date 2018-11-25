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
                        <? $APPLICATION->IncludeFile(SITE_DIR . 'include/footer/bottom_menu_city.php'); ?>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "bottom_menu",
                            Array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "ROOT_MENU_TYPE" => "bottom-city",
                                "CHILD_MENU_TYPE" => "footer",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "1",
                                "MENU_CACHE_GET_VARS" => "",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_USE_GROUPS" => "N",
                                "USE_EXT" => "Y",
                                "COMPONENT_TEMPLATE" => "footer_menu"
                            ),
                            false
                        ); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="footer-list">
                    <div class="list-item">
                        <? $APPLICATION->IncludeFile(SITE_DIR . 'include/footer/bottom_menu_cottage.php'); ?>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "bottom_menu",
                            array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "ROOT_MENU_TYPE" => "bottom-cottage",
                                "CHILD_MENU_TYPE" => "footer",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "1",
                                "MENU_CACHE_GET_VARS" => array(),
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_USE_GROUPS" => "N",
                                "USE_EXT" => "Y",
                                "COMPONENT_TEMPLATE" => "bottom_menu"
                            ),
                            false
                        ); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="footer-list">
                    <div class="list-item">
                        <? $APPLICATION->IncludeFile(SITE_DIR . 'include/footer/bottom_menu_foreign.php'); ?>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "bottom_menu",
                            Array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "ROOT_MENU_TYPE" => "bottom-foreign",
                                "CHILD_MENU_TYPE" => "footer",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "1",
                                "MENU_CACHE_GET_VARS" => "",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_USE_GROUPS" => "N",
                                "USE_EXT" => "Y",
                                "COMPONENT_TEMPLATE" => "footer_menu"
                            ),
                            false
                        ); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="footer-list last-list">
                    <div class="list-item">
                        <? $APPLICATION->IncludeFile(SITE_DIR . 'include/footer/bottom_menu_commercial.php'); ?>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "bottom_menu",
                            Array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "ROOT_MENU_TYPE" => "bottom-commercial",
                                "CHILD_MENU_TYPE" => "footer",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "1",
                                "MENU_CACHE_GET_VARS" => "",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_USE_GROUPS" => "N",
                                "USE_EXT" => "Y",
                                "COMPONENT_TEMPLATE" => "footer_menu"
                            ),
                            false
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="row row-bottom">
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
        </div>-->
    </div>
    <div class="container pt1">
        <div class="row">
            <div class="col-lg-3 col-md-8">
                <div class="footer-contact">
                    <div class="footer-phone">
                        <? $APPLICATION->IncludeFile(SITE_DIR . 'include/header/phone.php'); ?>
                    </div>
                    <div class="footer-callback">
                        <a class="hlink js-order-call" href="#">
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
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:subscribe.edit",
                        ".default",
                        array(
                            "AJAX_MODE" => "Y",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "ALLOW_ANONYMOUS" => "Y",
                            "CACHE_TIME" => "3600",
                            "CACHE_TYPE" => "A",
                            "SET_TITLE" => "N",
                            "SHOW_AUTH_LINKS" => "N",
                            "SHOW_HIDDEN" => "N",
                            "COMPONENT_TEMPLATE" => ".default"
                        ),
                        false
                    ); ?>
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
    <div id="order-call-form" style="display: none;">
        <section class="catalog-text assign-view-form">
            <div class="container bhelp">
                <div class="help-form">
                    <form method="post" class="ajax-form js-assign-view-form" action="<?= SITE_DIR ?>ajax/order-call.php">
                        <h2 class="section-h2">
                            Заказать звонок
                        </h2>
                        <div class="form-row">
                            <div class="it-block">
                                <input required type="text" name="name" placeholder="Имя *" class="">
                                <div class="it-error"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="it-block">
                                <input required type="text" name="phone" placeholder="Телефон *" class="">
                                <div class="it-error"></div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="">
                        <input type="hidden" name="offer-id" value="">
                        <div class="help-consent">
                            Нажимая на кнопку «Отправить», Вы даете согласие на обработку персональных данных<br>
                            в соответствии с <a href="#">«Положением об обработке персональных данных»</a>
                        </div>
                        <div class="help-btn">
                            <button class="hover-black">
                                Отправить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</footer>
</body>
</html>