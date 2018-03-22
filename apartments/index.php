<?
require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php';

$APPLICATION->SetTitle('Каталог квартир');
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?\Lema\Components\Breadcrumbs::inc('breadcrumbs');?>
            </div>
        </div>
    </div>

<?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"apartments", 
	array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"SEF_MODE" => "Y",
		"AJAX_MODE" => "Y",
		"IBLOCK_TYPE" => "realty",
		"IBLOCK_ID" => "2",
		"NEWS_COUNT" => "20",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"USE_RATING" => "Y",
		"USE_CATEGORIES" => "N",
		"USE_REVIEW" => "N",
		"USE_FILTER" => "Y",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"CHECK_DATES" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(
            0 => "ROOMS_COUNT",
            1 => "PRICE",
            2 => "ADDRESS",
            3 => "YEAR",
            4 => "MAP",
            5 => "PLACEMENT",
            6 => "LAYOUT",
            7 => "SQUARE",
            8 => "SIDE",
            9 => "RIELTY_TYPE",
            10 => "STAGE",
            11 => "STAGES_COUNT",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
		"DISPLAY_NAME" => "Y",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_SET_CANONICAL_URL" => "Y",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(
            0 => "ROOMS_COUNT",
            1 => "PRICE",
            2 => "ADDRESS",
            3 => "YEAR",
            4 => "MAP",
            5 => "PLACEMENT",
            6 => "LAYOUT",
            7 => "SQUARE",
            8 => "SIDE",
            9 => "RIELTY_TYPE",
            10 => "STAGE",
            11 => "STAGES_COUNT",
		),
		"DETAIL_DISPLAY_TOP_PAGER" => "Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_STRICT_SECTION_CHECK" => "Y",
		"SET_TITLE" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_ELEMENT_CHAIN" => "Y",
		"SET_LAST_MODIFIED" => "Y",
		"PAGER_BASE_LINK_ENABLE" => "Y",
		"SET_STATUS_404" => "Y",
		"SHOW_404" => "Y",
		"MESSAGE_404" => "",
		"PAGER_BASE_LINK" => "",
		"PAGER_PARAMS_NAME" => "arrPager",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"USE_PERMISSIONS" => "N",
		"GROUP_PERMISSIONS" => array(
			0 => "1",
		),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"DISPLAY_TOP_PAGER" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"FILTER_NAME" => "",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			1 => "ROOMS_COUNT",
			2 => "PLACEMENT",
			3 => "RIELTY_TYPE",
			0 => "PRICE",
			4 => "STAGE",
			5 => "STAGES_COUNT",
			12 => "",
		),
		"NUM_NEWS" => "20",
		"NUM_DAYS" => "30",
		"YANDEX" => "Y",
		"MAX_VOTE" => "5",
		"VOTE_NAMES" => array(
			0 => "0",
			1 => "1",
			2 => "2",
			3 => "3",
			4 => "4",
			5 => "",
		),
		"CATEGORY_IBLOCK" => "",
		"CATEGORY_CODE" => "CATEGORY",
		"CATEGORY_ITEMS_COUNT" => "5",
		"MESSAGES_PER_PAGE" => "10",
		"USE_CAPTCHA" => "Y",
		"REVIEW_AJAX_POST" => "Y",
		"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
		"FORUM_ID" => "1",
		"URL_TEMPLATES_READ" => "",
		"SHOW_LINK_TO_FORUM" => "Y",
		"POST_FIRST_MESSAGE" => "Y",
		"SEF_FOLDER" => "/apartments/",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "Y",
		"USE_SHARE" => "N",
		"SHARE_HIDE" => "Y",
		"SHARE_TEMPLATE" => "",
		"SHARE_HANDLERS" => array(
			0 => "delicious",
			1 => "facebook",
			2 => "lj",
			3 => "twitter",
		),
		"SHARE_SHORTEN_URL_LOGIN" => "",
		"SHARE_SHORTEN_URL_KEY" => "",
		"COMPONENT_TEMPLATE" => "apartments",
		"AJAX_OPTION_ADDITIONAL" => "",
		"STRICT_SECTION_CHECK" => "Y",
		"DISPLAY_AS_RATING" => "rating",
		"FILE_404" => "",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
			"search" => "search/",
		)
	),
	false
);?>

    <section class="advantages">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="h2"><span>преимущества</span></h2>
                </div>
                <div class="col-sm-4 col-md-2">
                    <figure>
                        <div class="advant-img">
                            <img src="/assets/img/adv-icon-1.png" alt="icon">01</div>
                        <figcaption>Оформление ипотеки совершено бесплатно</figcaption>
                    </figure>
                </div>
                <div class="col-sm-4 col-md-2">
                    <figure>
                        <div class="advant-img">
                            <img src="/assets/img/adv-icon-2.png" alt="icon">02</div>
                        <figcaption>Безопасное сопровождение сделки любой сложности</figcaption>
                    </figure>
                </div>
                <div class="col-sm-4 col-md-2">
                    <figure>
                        <div class="advant-img">
                            <img src="/assets/img/adv-icon-3.png" alt="icon">03</div>
                        <figcaption>Просмотр квартир на автомобиле компании</figcaption>
                    </figure>
                </div>
                <div class="col-sm-6 col-md-2">
                    <figure>
                        <div class="advant-img">
                            <img src="/assets/img/adv-icon-4.png" alt="icon">04</div>
                        <figcaption>Фирменные гарантии на услуги</figcaption>
                    </figure>
                </div>
                <div class="col-sm-6 col-md-2">
                    <figure>
                        <div class="advant-img">
                            <img src="/assets/img/adv-icon-5.png" alt="icon">05</div>
                        <figcaption>Выгодные условия сотрудничества
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </section>
    <section class="new-flats">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class=" h2 new-flats__h2"><span>НОВЫЕ ПОСТУПЛЕНИЯ</span></h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <a class="new-flats__tab-nav" href="#one-room" data-toggle="tab"><i></i><span>Однокомнатные</span></a>
                </div>
                <div class="col-sm-3">
                    <a class="new-flats__tab-nav active" href="#two-room" data-toggle="tab"><i></i><i></i><span>двухкомнатные</span></a>
                </div>
                <div class="col-sm-3">
                    <a class="new-flats__tab-nav" href="#three-room" data-toggle="tab">
                        <div class="new-flats__tab-nav__wrap-icon"><i class="new-flats__tab-nav__wrap-icon__hide"></i><i></i><i></i><i></i></div><span>трехкомнатные</span></a>
                </div>
                <div class="col-sm-3">
                    <a class="new-flats__tab-nav" href="#four-room" data-toggle="tab">
                        <div class="new-flats__tab-nav__wrap-icon"><i></i><i></i><i></i><i></i></div><span>четырехкомнатные</span></a>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane" id="one-room">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div id="map" class="new-flats__map"></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card-flat_min">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-flat__content">
                                            <div class="card-flat__content__head clearfix">
                                                <h3 class="card-flat__content__head__title_min">Однокомнатная квартира</h3>
                                                <div class="card-flat__content__head__price card-flat__content__head__price_min"><b>7 900 000</b> руб</div>
                                            </div>
                                            <div class="offers-item-info offers-item-info_min clearfix">
                                                <div class="item-info item-info_room">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_room"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Кол-во комнат</div>
                                                            <div class="item-info-value">5</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info item-info_floor">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_floor"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Этаж</div>
                                                            <div class="item-info-value">3/9</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info item-info_area">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_area"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Площадь</div>
                                                            <div class="item-info-value">90м<sup>2</sup></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="card-flat__content__address card-flat__content__address_min icon-location">г. Москва, ул. Руставели, д. 6 к. 6. Район «Бутырский»</p>
                                            <div class="offers-item-more offers-item-more_min">Подробнее<i class="more-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-flat_min">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-flat__content">
                                            <div class="card-flat__content__head clearfix">
                                                <h3 class="card-flat__content__head__title_min">Однокомнатная квартира</h3>
                                                <div class="card-flat__content__head__price card-flat__content__head__price_min"><b>7 900 000</b> руб</div>
                                            </div>
                                            <div class="offers-item-info offers-item-info_min clearfix">
                                                <div class="item-info item-info_room">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_room"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Кол-во комнат</div>
                                                            <div class="item-info-value">5</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info item-info_floor">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_floor"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Этаж</div>
                                                            <div class="item-info-value">3/9</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info item-info_area">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_area"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Площадь</div>
                                                            <div class="item-info-value">90м<sup>2</sup></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="card-flat__content__address card-flat__content__address_min icon-location">г. Москва, ул. Руставели, д. 6 к. 6. Район «Бутырский»</p>
                                            <div class="offers-item-more offers-item-more_min">Подробнее<i class="more-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-flat_min">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-flat__content">
                                            <div class="card-flat__content__head clearfix">
                                                <h3 class="card-flat__content__head__title_min">Однокомнатная квартира</h3>
                                                <div class="card-flat__content__head__price card-flat__content__head__price_min"><b>7 900 000</b> руб</div>
                                            </div>
                                            <div class="offers-item-info offers-item-info_min clearfix">
                                                <div class="item-info item-info_room">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_room"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Кол-во комнат</div>
                                                            <div class="item-info-value">5</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info item-info_floor">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_floor"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Этаж</div>
                                                            <div class="item-info-value">3/9</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info item-info_area">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_area"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Площадь</div>
                                                            <div class="item-info-value">90м<sup>2</sup></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="card-flat__content__address card-flat__content__address_min icon-location">г. Москва, ул. Руставели, д. 6 к. 6. Район «Бутырский»</p>
                                            <div class="offers-item-more offers-item-more_min">Подробнее<i class="more-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane active" id="two-room">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div id="map-2" class="new-flats__map"></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card-flat_min">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-flat__content">
                                            <div class="card-flat__content__head clearfix">
                                                <h3 class="card-flat__content__head__title_min">Двухкомнатная квартира</h3>
                                                <div class="card-flat__content__head__price card-flat__content__head__price_min"><b>7 900 000</b> руб</div>
                                            </div>
                                            <div class="offers-item-info offers-item-info_min clearfix">
                                                <div class="item-info item-info_room">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_room"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Кол-во комнат</div>
                                                            <div class="item-info-value">5</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info item-info_floor">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_floor"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Этаж</div>
                                                            <div class="item-info-value">3/9</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info item-info_area">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_area"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Площадь</div>
                                                            <div class="item-info-value">90м<sup>2</sup></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="card-flat__content__address card-flat__content__address_min icon-location">г. Москва, ул. Руставели, д. 6 к. 6. Район «Бутырский»</p>
                                            <div class="offers-item-more offers-item-more_min">Подробнее<i class="more-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-flat_min">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-flat__content">
                                            <div class="card-flat__content__head clearfix">
                                                <h3 class="card-flat__content__head__title_min">Двухкомнатная квартира</h3>
                                                <div class="card-flat__content__head__price card-flat__content__head__price_min"><b>7 900 000</b> руб</div>
                                            </div>
                                            <div class="offers-item-info offers-item-info_min clearfix">
                                                <div class="item-info item-info_room">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_room"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Кол-во комнат</div>
                                                            <div class="item-info-value">5</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info item-info_floor">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_floor"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Этаж</div>
                                                            <div class="item-info-value">3/9</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info item-info_area">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_area"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Площадь</div>
                                                            <div class="item-info-value">90м<sup>2</sup></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="card-flat__content__address card-flat__content__address_min icon-location">г. Москва, ул. Руставели, д. 6 к. 6. Район «Бутырский»</p>
                                            <div class="offers-item-more offers-item-more_min">Подробнее<i class="more-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-flat_min">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-flat__content">
                                            <div class="card-flat__content__head clearfix">
                                                <h3 class="card-flat__content__head__title_min">Двухкомнатная квартира</h3>
                                                <div class="card-flat__content__head__price card-flat__content__head__price_min"><b>7 900 000</b> руб</div>
                                            </div>
                                            <div class="offers-item-info offers-item-info_min clearfix">
                                                <div class="item-info item-info_room">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_room"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Кол-во комнат</div>
                                                            <div class="item-info-value">5</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info item-info_floor">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_floor"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Этаж</div>
                                                            <div class="item-info-value">3/9</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info item-info_area">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_area"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Площадь</div>
                                                            <div class="item-info-value">90м<sup>2</sup></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="card-flat__content__address card-flat__content__address_min icon-location">г. Москва, ул. Руставели, д. 6 к. 6. Район «Бутырский»</p>
                                            <div class="offers-item-more offers-item-more_min">Подробнее<i class="more-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="three-room">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div id="map-3" class="new-flats__map"></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card-flat_min">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-flat__content">
                                            <div class="card-flat__content__head clearfix">
                                                <h3 class="card-flat__content__head__title_min">Трехкомнатная квартира</h3>
                                                <div class="card-flat__content__head__price card-flat__content__head__price_min"><b>7 900 000</b> руб</div>
                                            </div>
                                            <div class="offers-item-info offers-item-info_min clearfix">
                                                <div class="item-info item-info_room">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_room"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Кол-во комнат</div>
                                                            <div class="item-info-value">5</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info item-info_floor">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_floor"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Этаж</div>
                                                            <div class="item-info-value">3/9</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info item-info_area">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_area"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Площадь</div>
                                                            <div class="item-info-value">90м<sup>2</sup></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="card-flat__content__address card-flat__content__address_min icon-location">г. Москва, ул. Руставели, д. 6 к. 6. Район «Бутырский»</p>
                                            <div class="offers-item-more offers-item-more_min">Подробнее<i class="more-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-flat_min">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-flat__content">
                                            <div class="card-flat__content__head clearfix">
                                                <h3 class="card-flat__content__head__title_min">Трехкомнатная квартира</h3>
                                                <div class="card-flat__content__head__price card-flat__content__head__price_min"><b>7 900 000</b> руб</div>
                                            </div>
                                            <div class="offers-item-info offers-item-info_min clearfix">
                                                <div class="item-info item-info_room">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_room"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Кол-во комнат</div>
                                                            <div class="item-info-value">5</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info item-info_floor">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_floor"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Этаж</div>
                                                            <div class="item-info-value">3/9</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info item-info_area">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_area"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Площадь</div>
                                                            <div class="item-info-value">90м<sup>2</sup></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="card-flat__content__address card-flat__content__address_min icon-location">г. Москва, ул. Руставели, д. 6 к. 6. Район «Бутырский»</p>
                                            <div class="offers-item-more offers-item-more_min">Подробнее<i class="more-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-flat_min">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-flat__content">
                                            <div class="card-flat__content__head clearfix">
                                                <h3 class="card-flat__content__head__title_min">Трехкомнатная квартира</h3>
                                                <div class="card-flat__content__head__price card-flat__content__head__price_min"><b>7 900 000</b> руб</div>
                                            </div>
                                            <div class="offers-item-info offers-item-info_min clearfix">
                                                <div class="item-info item-info_room">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_room"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Кол-во комнат</div>
                                                            <div class="item-info-value">5</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info item-info_floor">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_floor"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Этаж</div>
                                                            <div class="item-info-value">3/9</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info item-info_area">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_area"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Площадь</div>
                                                            <div class="item-info-value">90м<sup>2</sup></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="card-flat__content__address card-flat__content__address_min icon-location">г. Москва, ул. Руставели, д. 6 к. 6. Район «Бутырский»</p>
                                            <div class="offers-item-more offers-item-more_min">Подробнее<i class="more-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="four-room">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div id="map-4" class="new-flats__map"></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card-flat_min">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-flat__content">
                                            <div class="card-flat__content__head clearfix">
                                                <h3 class="card-flat__content__head__title_min">Четырехкомнатная квартира</h3>
                                                <div class="card-flat__content__head__price card-flat__content__head__price_min"><b>7 900 000</b> руб</div>
                                            </div>
                                            <div class="offers-item-info offers-item-info_min clearfix">
                                                <div class="item-info item-info_room">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_room"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Кол-во комнат</div>
                                                            <div class="item-info-value">5</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info item-info_floor">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_floor"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Этаж</div>
                                                            <div class="item-info-value">3/9</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info item-info_area">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_area"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Площадь</div>
                                                            <div class="item-info-value">90м<sup>2</sup></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="card-flat__content__address card-flat__content__address_min icon-location">г. Москва, ул. Руставели, д. 6 к. 6. Район «Бутырский»</p>
                                            <div class="offers-item-more offers-item-more_min">Подробнее<i class="more-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-flat_min">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-flat__content">
                                            <div class="card-flat__content__head clearfix">
                                                <h3 class="card-flat__content__head__title_min">Четырехкомнатная квартира</h3>
                                                <div class="card-flat__content__head__price card-flat__content__head__price_min"><b>7 900 000</b> руб</div>
                                            </div>
                                            <div class="offers-item-info offers-item-info_min clearfix">
                                                <div class="item-info item-info_room">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_room"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Кол-во комнат</div>
                                                            <div class="item-info-value">5</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info item-info_floor">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_floor"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Этаж</div>
                                                            <div class="item-info-value">3/9</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info item-info_area">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_area"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Площадь</div>
                                                            <div class="item-info-value">90м<sup>2</sup></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="card-flat__content__address card-flat__content__address_min icon-location">г. Москва, ул. Руставели, д. 6 к. 6. Район «Бутырский»</p>
                                            <div class="offers-item-more offers-item-more_min">Подробнее<i class="more-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-flat_min">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-flat__content">
                                            <div class="card-flat__content__head clearfix">
                                                <h3 class="card-flat__content__head__title_min">Четырехкомнатная квартира</h3>
                                                <div class="card-flat__content__head__price card-flat__content__head__price_min"><b>7 900 000</b> руб</div>
                                            </div>
                                            <div class="offers-item-info offers-item-info_min clearfix">
                                                <div class="item-info item-info_room">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_room"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Кол-во комнат</div>
                                                            <div class="item-info-value">5</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info item-info_floor">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_floor"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Этаж</div>
                                                            <div class="item-info-value">3/9</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info item-info_area">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_area"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name">Площадь</div>
                                                            <div class="item-info-value">90м<sup>2</sup></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="card-flat__content__address card-flat__content__address_min icon-location">г. Москва, ул. Руставели, д. 6 к. 6. Район «Бутырский»</p>
                                            <div class="offers-item-more offers-item-more_min">Подробнее<i class="more-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--
<section class="new-arrivals">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="h2">Новые поступления</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row without-paddings">
            <div class="col-md-6">
                <div class="flat-card flat-card-revers">
                    <a href="#"></a>
                    <img src="/assets/img/smart-plan-22.png" class="img-flat-1" alt="plan-flat-1">
                    <div class="flat-plan">
                        <h3><span>1</span> <br> Комнатные квартиры</h3>
                        <img src="/assets/img/scheme.png" alt="scheme">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="flat-card">
                    <a href="#"></a>
                    <img src="/assets/img/smart-plan-32.png" class="img-flat-2" alt="plan-flat-2">
                    <div class="flat-plan pos-left">
                        <h3><span>2</span> <br> Комнатные квартиры</h3>
                        <img src="/assets/img/scheme.png" alt="scheme">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="flat-card">
                    <a href="#"></a>
                    <img src="/assets/img/planirovka-kvartir-foto-readgy-com-3.png" class="img-flat-3" alt="plan-flat-3">
                    <div class="flat-plan">
                        <h3><span>3</span> <br> Комнатные квартиры</h3>
                        <img src="/assets/img/scheme.png" alt="scheme">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="flat-card flat-card-revers">
                    <a href="#"></a>
                    <img src="/assets/img/plan-4.png" class="img-flat-4" alt="plan-flat-4">
                    <div class="flat-plan pos-left">
                        <h3><span>4</span> <br> Комнатные квартиры</h3>
                        <img src="/assets/img/scheme.png" alt="scheme">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
-->
<?
require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php';
?>