<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Покупателю");
?>

    <div class="content-page_color">

        <div class="why-not">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <h2 class="why-not__h2">
                            <? $APPLICATION->IncludeFile(SITE_DIR . 'include/main/why-not/title.php'); ?>
                        </h2>
                        <p class="why-not__title">
                            <? $APPLICATION->IncludeFile(SITE_DIR . 'include/main/why-not/subtitle.php'); ?>
                        </p>
                        <div class="row">
                            <div class="col-md-5 col-sm-6">
                                <h4 class="why-not__h4 why-not__h4_1">
                                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/main/why-not/block-1/title.php'); ?>
                                </h4>
                                <p class="why-not__text">
                                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/main/why-not/block-1/description.php'); ?>
                                </p>
                            </div>
                            <div class="col-md-5 col-sm-6">
                                <h4 class="why-not__h4 why-not__h4_2">
                                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/main/why-not/block-2/title.php'); ?>
                                </h4>
                                <p class="why-not__text">
                                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/main/why-not/block-2/description.php'); ?>
                                </p>
                            </div>
                            <div class="col-md-5 col-sm-6">
                                <h4 class="why-not__h4 why-not__h4_3">
                                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/main/why-not/block-3/title.php'); ?>
                                </h4>
                                <p class="why-not__text">
                                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/main/why-not/block-3/description.php'); ?>
                                </p>
                            </div>
                            <div class="col-md-5 col-sm-6">
                                <h4 class="why-not__h4 why-not__h4_4">
                                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/main/why-not/block-4/title.php'); ?>
                                </h4>
                                <p class="why-not__text">
                                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/main/why-not/block-4/description.php'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="service-package">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="service-package__h2">В пакет наших услуг входит:</h2>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="service-package__item">
                            <div class="service-package__item__img service-package__item__img_1"></div>
                            <div class="service-package__item__text">Подбор наиболее подходящих объектов согласно Вашим
                                потребностям;
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="service-package__item">
                            <div class="service-package__item__img service-package__item__img_2"></div>
                            <div class="service-package__item__text">Показы недвижимости в удобное для Вас время;</div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="service-package__item">
                            <div class="service-package__item__img service-package__item__img_3"></div>
                            <div class="service-package__item__text">Помощь в оформлении ипотеки в ведущих банках
                                города
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="service-package__item">
                            <div class="service-package__item__img service-package__item__img_4"></div>
                            <div class="service-package__item__text">Профессиональные рекомендации по соотношению
                                «цена-предложение»
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="service-package__item">
                            <div class="service-package__item__img service-package__item__img_5"></div>
                            <div class="service-package__item__text">Оценка юридической чистоты объекта</div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="service-package__item">
                            <div class="service-package__item__img service-package__item__img_6"></div>
                            <div class="service-package__item__text">Гарантии сделки</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FAVORABLY -->
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
                "ELEMENT_CODE" => "favorably",
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
        <!-- /FAVORABLY -->
        <!-- WE CHECK HISTORY -->
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.detail",
            "blocks_text",
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
                "ELEMENT_CODE" => "we-check-history",
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
                "COMPONENT_TEMPLATE" => "blocks_text"
            ),
            false
        ); ?>
        <!-- /WE CHECK HISTORY -->
        <div class="connect-consultant">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="connect-consultant__title">
                            <? $APPLICATION->IncludeFile(SITE_DIR . 'include/buyer/reviews/title.php'); ?>
                        </h3>
                        <? $APPLICATION->IncludeComponent(
                            "lema:form.ajax",
                            "consultation",
                            array(
                                "COMPONENT_TEMPLATE" => "consultation",
                                "FORM_CLASS" => "ajax-form connect-consultant__form feedback-form",
                                "FORM_ACTION" => "",
                                "FORM_152_FZ" => "Я ознакомлен <a target=\"_blank\" href=\"/contacts/apply.pdf\">c положением об обработке и защите персональных данных.</a>",
                                "FORM_BTN_TITLE" => "Получить консультацию",
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

        <section class="realtors">
            <div class="realtor__title">
                <span> Наши специалисты готовы проконсультировать
                        Вас по любым вопросам</span>
            </div>
            <div class="container">
                <div class="realtors__carousel">
                    <div class="realtors__carousel__item">
                        <div class="realtors__carousel__item__wrap">
                            <div class="realtors__carousel__item__img">
                                <img src="/assets/img/ipothec-ava.jpg" alt="realtor">
                            </div>
                            <div class="realtors__carousel__item__description">
                                <div class="realtors__carousel__item__description__name">Медведева <br> Анастасия</div>
                                <div class="realtors__carousel__item__description__title">120 объектов</div>
                                <div class="realtors__carousel__item__description__tel__text">Связаться со мной!</div>
                                <div class="realtors__carousel__item__description__tel">8 (961) 991-09-11</div>
                                <div class="realtors__carousel__item__description__link">
                                    <a href="#">Жду звонка</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="realtors__carousel__item">
                        <div class="realtors__carousel__item__wrap">
                            <div class="realtors__carousel__item__img">
                                <img src="/assets/img/ipothec-ava.jpg" alt="realtor">
                            </div>
                            <div class="realtors__carousel__item__description">
                                <div class="realtors__carousel__item__description__name">Медведева <br> Анастасия</div>
                                <div class="realtors__carousel__item__description__title">120 объектов</div>
                                <div class="realtors__carousel__item__description__tel__text">Связаться со мной!</div>
                                <div class="realtors__carousel__item__description__tel">8 (961) 991-09-11</div>
                                <div class="realtors__carousel__item__description__link">
                                    <a href="#">Жду звонка</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="realtors__carousel__item">
                        <div class="realtors__carousel__item__wrap">
                            <div class="realtors__carousel__item__img">
                                <img src="/assets/img/ipothec-ava.jpg" alt="realtor">
                            </div>
                            <div class="realtors__carousel__item__description">
                                <div class="realtors__carousel__item__description__name">Медведева <br> Анастасия</div>
                                <div class="realtors__carousel__item__description__title">120 объектов</div>
                                <div class="realtors__carousel__item__description__tel__text">Связаться со мной!</div>
                                <div class="realtors__carousel__item__description__tel">8 (961) 991-09-11</div>
                                <div class="realtors__carousel__item__description__link">
                                    <a href="#">Жду звонка</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="realtors__carousel__item">
                        <div class="realtors__carousel__item__wrap">
                            <div class="realtors__carousel__item__img">
                                <img src="/assets/img/ipothec-ava.jpg" alt="realtor">
                            </div>
                            <div class="realtors__carousel__item__description">
                                <div class="realtors__carousel__item__description__name">Медведева <br> Анастасия</div>
                                <div class="realtors__carousel__item__description__title">120 объектов</div>
                                <div class="realtors__carousel__item__description__tel__text">Связаться со мной!</div>
                                <div class="realtors__carousel__item__description__tel">8 (961) 991-09-11</div>
                                <div class="realtors__carousel__item__description__link">
                                    <a href="#">Жду звонка</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="realtors__carousel__item">
                        <div class="realtors__carousel__item__wrap">
                            <div class="realtors__carousel__item__img">
                                <img src="/assets/img/ipothec-ava.jpg" alt="realtor">
                            </div>
                            <div class="realtors__carousel__item__description">
                                <div class="realtors__carousel__item__description__name">Медведева <br> Анастасия</div>
                                <div class="realtors__carousel__item__description__title">120 объектов</div>
                                <div class="realtors__carousel__item__description__tel__text">Связаться со мной!</div>
                                <div class="realtors__carousel__item__description__tel">8 (961) 991-09-11</div>
                                <div class="realtors__carousel__item__description__link">
                                    <a href="#">Жду звонка</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="realtors__carousel__item">
                        <div class="realtors__carousel__item__wrap">
                            <div class="realtors__carousel__item__img">
                                <img src="/assets/img/ipothec-ava.jpg" alt="realtor">
                            </div>
                            <div class="realtors__carousel__item__description">
                                <div class="realtors__carousel__item__description__name">Медведева <br> Анастасия</div>
                                <div class="realtors__carousel__item__description__title">120 объектов</div>
                                <div class="realtors__carousel__item__description__tel__text">Связаться со мной!</div>
                                <div class="realtors__carousel__item__description__tel">8 (961) 991-09-11</div>
                                <div class="realtors__carousel__item__description__link">
                                    <a href="#">Жду звонка</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- REVIEWS -->
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "reviews",
            array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_FILTER" => "N",
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
                "FIELD_CODE" => array(
                    0 => "NAME",
                    1 => "PREVIEW_TEXT",
                    2 => "PREVIEW_PICTURE",
                    3 => "",
                ),
                "FILTER_NAME" => "",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "8",
                "IBLOCK_TYPE" => "content",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "N",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "2",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Новости",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "SORT",
                "SORT_BY2" => "ACTIVE_FROM",
                "SORT_ORDER1" => "ASC",
                "SORT_ORDER2" => "ASC",
                "STRICT_SECTION_CHECK" => "N",
                "COMPONENT_TEMPLATE" => "reviews"
            ),
            false
        ); ?>
        <!-- /REVIEWS -->

    </div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>