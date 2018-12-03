<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Главная");
?>
<?$APPLICATION->IncludeComponent(
    "lema:new_catalog.filter",
    "main_page",
    Array(
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "FIELD_CODE" => array("",""),
        "FILTER_NAME" => "arrFilter",
        "IBLOCK_ID" => "2",
        "IBLOCK_TYPE" => "realty",
        "LIST_HEIGHT" => "5",
        "NUMBER_WIDTH" => "5",
        "PAGER_PARAMS_NAME" => "arrPager",
        "PRICE_CODE" => array(),
        "PROPERTY_CODE" => array("CITY","PRICE",""),
        "SAVE_IN_SESSION" => "N",
        "TEXT_WIDTH" => "20"
    )
);?>
<!--<section class="realties">
    <div class="container">
        <h2 class="section-h2">Все виды недвижимости</h2>
        <div class="row">
            <div class="col-md-8">
                <div class="realties-item realties-first">
                    <div class="realties-overlay"></div>
                    <div class="realties-title">Жилая в городе</div>
                    <div class="realties-list">
                        <ul>
                            <li><a href="#">Все жилые комплексы <span>163</span></a></li>
                            <li><a href="#">Дома <span>9</span></a></li>
                            <li><a href="#">Квартиры <span>3 149</span></a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Пентхаусы <span>166</span></a></li>
                            <li><a href="#">Таунхаусы <span>27</span></a></li>
                            <li><a href="#">Новостройки <span>52</span></a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Аренда <span>275</span></a></li>
                            <li><a href="#">Дисконты <span>27</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="realties-item realties-second">
                    <div class="realties-overlay"></div>
                    <div class="realties-title">Загородная</div>
                    <div class="realties-list">
                        <ul>
                            <li><a href="#">Дом <span>1 184</span></a></li>
                            <li><a href="#">Квартира <span>174</span></a></li>
                            <li><a href="#">Таунхаус <span>251</span></a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Поселки <span>85</span></a></li>
                            <li><a href="#">Участок <span>526</span></a></li>
                            <li><a href="#">Аренда <span>277</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="realties-item realties-third">
                    <div class="realties-overlay"></div>
                    <div class="realties-title">Коммерческая</div>
                    <div class="realties-list">
                        <ul>
                            <li><a href="#">Аренда <span>764</span></a></li>
                            <li><a href="#">Продажа <span>100</span></a></li>
                            <li><a href="#">Арендный бизнес <span>33</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="realties-item realties-fourth">
                    <div class="realties-overlay"></div>
                    <div class="realties-title">Зарубежная</div>
                    <div class="realties-list">
                        <ul>
                            <li><a href="#">Вилла <span>214</span></a></li>
                            <li><a href="#">Апартаменты <span>124</span></a></li>
                            <li><a href="#">Пентхаус <span>27</span></a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Таунхаус <span>18</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!--<div class="realties-consultation">
            <div class="consultation-text">
                <h3>Индивидуальная консультация</h3>
                <p>По вопросам покупки и продажи жилой и коммерческой недвижимости в Москве и за рубежом</p>
            </div>
            <div class="consultation-link"><a href="#">Получить консультацию</a></div>
        </div>-->
    </div>
</section>
<section class="expert">
    <div class="expert-overlay"></div>
    <div class="expert-txt">
        <h2>
            Группа компаний LEXHOME
            5 лет на рынке
        </h2>
        <p>
            Является одним из лидеров рынка коммерческой и жилой недвижимости. На сегодняшний день LEXHOME
            насчитывает более 3000 объектов в работе, 34 сотрудника, 2 млрд. рублей общий объем недвижимости
            в управлении.
        </p>
    </div>
</section>
<section class="popular">
    <div class="container">
        <h2 class="section-h2">Популярные объекты</h2>
        <?
        $GLOBALS['arPopularMainPage']['=PROPERTY_POPULAR_VALUE']='Y';
        $APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"main_popular_objects", 
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
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "arPopularMainPage",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "realty",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "6",
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
			0 => "CITY",
			1 => "STREET",
			2 => "HOUSE_NUMBER",
			3 => "ADDRESS",
			4 => "METRO",
			5 => "SQUARE_LAND",
			6 => "SQUARE_RESIDENT",
			7 => "CLASS_TYPE",
			8 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "main_popular_objects"
	),
	false
);?>
    </div>
</section>

<section class="newoffer">
    <div class="container">
        <h2 class="section-h2">Новые предложения</h2>
        <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"main_new_objects", 
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
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "realty",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "",
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
			0 => "CITY",
			1 => "STREET",
			2 => "HOUSE_NUMBER",
			3 => "ADDRESS",
			4 => "METRO",
			5 => "SQUARE_LAND",
			6 => "SQUARE_RESIDENT",
			7 => "CLASS_TYPE",
			8 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "main_new_objects"
	),
	false
);?>
    </div>
</section>
<!--Акции-->
<section class="stock">
    <div class="container">
        <h2 class="section-h2">Акции</h2>
        <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"main_stocks_block", 
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
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "26",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "",
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
			0 => "LINK",
			1 => "CITY",
			2 => "STREET",
			3 => "HOUSE_NUMBER",
			4 => "ADDRESS",
			5 => "METRO",
			6 => "SQUARE_LAND",
			7 => "SQUARE_RESIDENT",
			8 => "CLASS_TYPE",
			9 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "main_stocks_block"
	),
	false
);?>
    </div>
</section>
<!--Новости-->
<section class="news">
    <div class="container">
        <h2 class="section-h2">Новости и материалы</h2>
        <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"main_news_block", 
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
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "25",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "",
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
			1 => "CITY",
			2 => "STREET",
			3 => "HOUSE_NUMBER",
			4 => "ADDRESS",
			5 => "METRO",
			6 => "SQUARE_LAND",
			7 => "SQUARE_RESIDENT",
			8 => "CLASS_TYPE",
			9 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "main_news_block"
	),
	false
);?>
    </div>
</section>
<!--форма обратной связи-->
<section class="help">
    <div class="container">
        <div class="help-form">
            <form action="<?= SITE_DIR; ?>ajax/feedback-form.php" class="js-feedback-form" method="POST">
                <h2 class="section-h2">
                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/footer/feedback_title.php'); ?>
                </h2>
                <div class="subtitle">
                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/footer/feedback_subtitle.php'); ?>
                </div>
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
                    <textarea placeholder="Расскажите о своих пожеланиях" name="comment"></textarea>
                    <div class="it-error"></div>
                </div>
                <div class="help-consent">
                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/footer/personal_data_text.php'); ?>
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
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
