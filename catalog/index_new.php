<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';
$APPLICATION->SetTitle('Каталог');?>

<? $APPLICATION->IncludeComponent(
    "bitrix:news",
    "catalog_new",
    array(
        "DISPLAY_DATE" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "SEF_MODE" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "realty",
        "IBLOCK_ID" => "2",
        'PARENT_SECTION_CODE' => null,
        "NEWS_COUNT" => "6",
        "USE_SEARCH" => "N",
        "USE_RSS" => "N",
        "USE_RATING" => "N",
        "USE_CATEGORIES" => "N",
        "USE_REVIEW" => "N",
        "USE_FILTER" => "N",
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
            9 => "REALTY_TYPE",
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
        "DETAIL_PROPERTY_CODE" => [
            'METRO', 'HEIGHT', 'SLABS', 'FINISHING', 'SECURITY', 'INFRASTRUCTURE',
            'LANDSCAPING', 'WINDOWS', 'REGION_INFRASTRUCTURE',
        ],
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
        "SET_STATUS_404" => "N",
        "SHOW_404" => "N",
        "MESSAGE_404" => "",
        "PAGER_BASE_LINK" => "",
        "PAGER_PARAMS_NAME" => "arrPager",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "USE_PERMISSIONS" => "N",
        "GROUP_PERMISSIONS" => array(
            //0 => "1",
        ),
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Элементы",
        "PAGER_SHOW_ALWAYS" => "Y",
        "PAGER_TEMPLATE" => "pagination",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "Y",
        "FILTER_NAME" => "arrFilter",
        "FILTER_FIELD_CODE" => array(
            0 => "ID",
            1 => "",
        ),
        "FILTER_PROPERTY_CODE" => array(
            'RENT_TYPE',
            'ROOMS_COUNT',
            'PRICE',
            'REGION',
            'STAGE',
            'STAGES_COUNT',
            'SQUARE_LAND',
            'SQUARE',
            'LOT_CATEGORIES',
            'HEATING',
            'WATER_SUPPLY',
            'SEWERAGE',
            'LOT_HAVINGS_TYPE',
            'ELECTRIC',
        ),
        'FILTER_ORDER' => '',
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
        "SEF_FOLDER" => "/catalog/",
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
        "COMPONENT_TEMPLATE" => "catalog",
        "AJAX_OPTION_ADDITIONAL" => "",
        "STRICT_SECTION_CHECK" => "N",
        "DISPLAY_AS_RATING" => "rating",
        "FILE_404" => "",
        "SEF_URL_TEMPLATES" => array(
            "news" => "",
            "section" => "",
            "detail" => "#SECTION_CODE#/#ELEMENT_CODE#/",
            "search" => "search/",
        ),
        'SHOW_ALL_WO_SECTION' => 'Y',
    ),
    false
); ?>

<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
