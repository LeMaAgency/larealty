<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$APPLICATION->SetTitle('Аренда');

$rootDir = SITE_DIR . 'rent';
$currentDir = \Lema\Common\Request::get()->getRequestedPageDirectory();
$inRootDir = $currentDir == $rootDir;

if(empty($GLOBALS['arrFilter']))
    $GLOBALS['arrFilter'] = array();

/**
 * Ordering sort for filter items
 */
$filterFields = array(
    array('key' => 'ROOMS_COUNT', 'type' => 'property', 'expanded' => false),
    array('key' => 'PRICE', 'type' => 'property', 'expanded' => false),
    array('key' => 'REGION', 'type' => 'property', 'expanded' => false),
    array('key' => 'ID', 'type' => 'field', 'expanded' => false),
);

/**
 * Load rent & realty types from iblock properties
 */
$rentAndRealtyTypes = array();
$tmp = \LIblock::getPropEnumValues(LIblock::getPropId('objects', 'RENT_TYPE'));
foreach($tmp as $code => $data)
    $rentAndRealtyTypes[$code] = $data['VALUE'];
$tmp = \LIblock::getPropEnumValues(LIblock::getPropId('objects', 'REALTY_TYPE'));
foreach($tmp as $code => $data)
    $rentAndRealtyTypes[$code] = $data['VALUE'];
unset($tmp);

if($inRootDir)
{
    /**
     * We need to check for showing elements of "public" section only
     */
    $sections = LIblock::getSectionsByIblockCode('objects');
    $rootSectionId = isset($sections['active']) ? $sections['active']['ID'] : 0;
    if(!empty($rootSectionId))
    {
        $GLOBALS['arrFilter']['SECTION_ID'] = array();
        foreach($sections as $section)
        {
            if($section['IBLOCK_SECTION_ID'] === $rootSectionId)
                $GLOBALS['arrFilter']['SECTION_ID'][] = $section['ID'];
        }
    }
}
else
{

    /**
     * Add chain items
     */
    $uriParts = explode('/', trim(ltrim($currentDir, $rootDir), '/'));
    $lastUrl = $rootDir;

    if(!empty($uriParts[0]) && in_array($uriParts[0], array('kvartiry-komnaty', 'doma-dachi-zemelnyy_uchastok')))
    {
        $currentSectionCode = array_shift($uriParts);
    }

    if(!empty($uriParts))
    {
        $currentSectionCode = array_shift($uriParts);

        $section = \LIblock::getSectionInfo('objects', $currentSectionCode);
        if(!empty($section))
        {
            $lastUrl .= '/' . $section['CODE'];
            $APPLICATION->AddChainItem($section['NAME'], $lastUrl . '/');
        }

        if(!empty($uriParts) && is_array($uriParts))
        {
            foreach($uriParts as $uriPart)
            {
                if(isset($rentAndRealtyTypes[$uriPart]))
                {
                    $lastUrl .= '/' . $uriPart;
                    $APPLICATION->AddChainItem($rentAndRealtyTypes[$uriPart], $lastUrl . '/');
                }
            }
        }
    }
}

/**
 * Filter by rent types
 */
$typeFilter = array();
if(!empty($rentAndRealtyTypes['sdam']))
    $typeFilter[] = $rentAndRealtyTypes['sdam'];
if(!empty($rentAndRealtyTypes['snimu']))
    $typeFilter[] = $rentAndRealtyTypes['snimu'];

$GLOBALS['arrFilter']['PROPERTY_RENT_TYPE_VALUE'] = $typeFilter;
?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <? \Lema\Components\Breadcrumbs::inc('breadcrumbs'); ?>
            </div>
        </div>
    </div>

<? $APPLICATION->IncludeComponent(
    "lema:news",
    "rent",
    array(
        "DISPLAY_DATE" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "SEF_MODE" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "realty",
        "IBLOCK_ID" => "2",
        'PARENT_SECTION_CODE' => (isset($currentSectionCode) ? $currentSectionCode : null),
        "NEWS_COUNT" => "6",
        "USE_SEARCH" => "N",
        "USE_RSS" => "N",
        "USE_RATING" => "N",
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
        "DETAIL_PROPERTY_CODE" => array(
            'PROPOSED_ROOMS_COUNT',
            'MATERIAL',
            'YEAR',
            'CADASTRAL_NUMBER',
            'LIFT',
            'SEP_ENTRANCE',
            'LAYOUT_TYPE',
            'BATHROOM',
            'BATHROOM_COUNT',
            'SQUARE_RESIDENT',
            'SQUARE_KITCHEN',
            'SQUARE_LAND',
            'LAND_STATUS',
            'BALCONIES_COUNT',
            'LOGGIAS_COUNT',
            'REPAIR_TYPE',
            'SIDE',
            'CLASS_TYPE',
            'PARKING',
            'SECURITY_CONCIERGE',
            'PHONE',
            'INTERNET',
            'HEATING',
            'COLD_WATER',
            'HOT_WATER',
            'SEWERAGE',
            'ELECTRIC',
            'GAZ',
            'SAUNA',
            'GARAGE',
            'CLOSED_TERRITORY',
            'SECURITY_ALARM',
            'FIRE_ALARM',
            'FIRE_EXT_SYSTEM',
            'SECURITY_VIDEO',
            'HAVINGS_TYPE',
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
        'FILTER_ORDER' => $filterFields,
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
        "SEF_FOLDER" => "/rent/",
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
            "detail" => "#SECTION_CODE#/#RENT_TYPE#/#ELEMENT_CODE#/",
            "search" => "search/",
            'realty' => '#SECTION_CODE#/',
            'realty_rent' => '#SECTION_CODE#/#RENT_TYPE#/',
        ),
    ),
    false
); ?>

<?if($inRootDir):?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "feature",
        array(
            'ROOT_DIR' => $inRootDir,
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
            "IBLOCK_ID" => "7",
            "IBLOCK_TYPE" => "content",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "N",
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
            "PARENT_SECTION_CODE" => "feature_block",
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
            "SORT_BY2" => "ID",
            "SORT_ORDER1" => "ASC",
            "SORT_ORDER2" => "ASC",
            "STRICT_SECTION_CHECK" => "N",
            "COMPONENT_TEMPLATE" => "feature"
        ),
        false
    ); ?>
    <div class="inquiry">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="inquiry__wrap">
                        <h3 class="inquiry__h3">
                            <? $APPLICATION->IncludeFile(SITE_DIR . 'include/old/rent/feedback-form-title.php'); ?>
                        </h3>
                        <? $APPLICATION->IncludeComponent("lema:form.ajax", "send_application", Array(
                            "COMPONENT_TEMPLATE" => ".default",
                            "FORM_CLASS" => "ajax-form connect-consultant__form connect-consultant__form_inline",    // Класс формы
                            "FORM_ACTION" => "",    // URL формы (свой обработчик)
                            "FORM_152_FZ" => "Я ознакомлен <a target=\"_blank\" href=\"/contacts/apply.pdf\">c положением об обработке и защите персональных данных.</a>",    // Текст соглашения (152-ФЗ)
                            "FORM_BTN_TITLE" => "Отправить заявку",    // Подпись кнопки формы
                            "FORM_SUCCESS_FUNCTION" => "\$.fancybox.open(\"Ваше сообщение успешно отправлено\")",    // Функция при успешной отправке
                            "FORM_SUCCESS_FUNCTION_CORRECT_JSON" => "Y",    // Функция в корректном JSON-формате
                            "FORM_FIELDS" => "[{\"name\":\"name\",\"type\":\"text\",\"title\":\"\",\"placeholder\":\"Ваше имя\",\"default\":\"\",\"required\":\"Y\"},{\"name\":\"phone\",\"type\":\"tel\",\"title\":\"\",\"placeholder\":\"Ваш телефон\",\"default\":\"\",\"required\":\"Y\"}]",    // Поля формы
                            "NEED_SAVE_TO_IBLOCK" => "Y",    // Сохранять в инфоблок
                            "NEED_SEND_EMAIL" => "Y",    // Отправка сообщения
                            "EVENT_TYPE" => "57",    // Тип почтового события
                            "CACHE_TYPE" => "A",    // Тип кеширования
                            "CACHE_TIME" => "3600",    // Время кеширования (сек.)
                            "IBLOCK_TYPE" => "feedback",    // Тип информационного блока
                            "IBLOCK_ID" => "12",    // Код информационного блока
                        ),
                            false
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <? /*$APPLICATION->IncludeComponent('bitrix:news.list', 'advantages_apartments', array(
        'DISPLAY_DATE' => 'Y',
        'DISPLAY_NAME' => 'Y',
        'DISPLAY_PICTURE' => 'Y',
        'DISPLAY_PREVIEW_TEXT' => 'Y',
        'AJAX_MODE' => 'N',
        'IBLOCK_TYPE' => 'content',
        'IBLOCK_ID' => '3',
        'NEWS_COUNT' => '20',
        'SORT_BY1' => 'ACTIVE_FROM',
        'SORT_ORDER1' => 'DESC',
        'SORT_BY2' => 'SORT',
        'SORT_ORDER2' => 'ASC',
        'FILTER_NAME' => '',
        'FIELD_CODE' => array(),
        'PROPERTY_CODE' => array(),
        'CHECK_DATES' => 'Y',
        'DETAIL_URL' => '',
        'PREVIEW_TRUNCATE_LEN' => '',
        'ACTIVE_DATE_FORMAT' => 'd.m.Y',
        'SET_TITLE' => 'N',
        'SET_BROWSER_TITLE' => 'N',
        'SET_META_KEYWORDS' => 'N',
        'SET_META_DESCRIPTION' => 'N',
        'SET_LAST_MODIFIED' => 'N',
        'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
        'ADD_SECTIONS_CHAIN' => 'N',
        'HIDE_LINK_WHEN_NO_DETAIL' => 'Y',
        'PARENT_SECTION' => '',
        'PARENT_SECTION_CODE' => '',
        'INCLUDE_SUBSECTIONS' => 'Y',
        'CACHE_TYPE' => 'A',
        'CACHE_TIME' => '36000000',
        'CACHE_FILTER' => 'Y',
        'CACHE_GROUPS' => 'N',
        'DISPLAY_TOP_PAGER' => 'Y',
        'DISPLAY_BOTTOM_PAGER' => 'Y',
        'PAGER_TITLE' => 'Элементы',
        'PAGER_SHOW_ALWAYS' => 'N',
        'PAGER_TEMPLATE' => '',
        'PAGER_DESC_NUMBERING' => 'N',
        'PAGER_DESC_NUMBERING_CACHE_TIME' => '36000',
        'PAGER_SHOW_ALL' => 'N',
        'PAGER_BASE_LINK_ENABLE' => 'N',
        'SET_STATUS_404' => 'N',
        'SHOW_404' => 'N',
        'MESSAGE_404' => '',
        'PAGER_BASE_LINK' => '',
        'PAGER_PARAMS_NAME' => 'arrPager',
        'AJAX_OPTION_JUMP' => 'N',
        'AJAX_OPTION_STYLE' => 'Y',
        'AJAX_OPTION_HISTORY' => 'N',
        'AJAX_OPTION_ADDITIONAL' => '',
    ));*/ ?>
<?endif;?>

<?if(empty($currentSectionCode)):?>

        <?php
        global $roomNewElementFilter;
        $roomNewElementFilter = array(
            'PROPERTY_RENT_TYPE_VALUE' => $typeFilter,
            'PROPERTY_IS_EXCLUSIVE_VALUE' => 'Y',
        );
        ?>
        <? $APPLICATION->IncludeComponent('bitrix:news.list', 'resembling', array(
            'DISPLAY_DATE' => 'Y',
            'DISPLAY_NAME' => 'Y',
            'DISPLAY_PICTURE' => 'Y',
            'DISPLAY_PREVIEW_TEXT' => 'Y',
            'AJAX_MODE' => 'N',
            'IBLOCK_TYPE' => 'realty',
            'IBLOCK_ID' => '2',
            'NEWS_COUNT' => '9',
            'SORT_BY1' => 'ACTIVE_FROM',
            'SORT_ORDER1' => 'DESC',
            'SORT_BY2' => 'SORT',
            'SORT_ORDER2' => 'ASC',
            'FILTER_NAME' => 'roomNewElementFilter',
            'FIELD_CODE' => array(),
            'PROPERTY_CODE' => array(
                0 => "ROOMS_COUNT",
                1 => "PRICE",
                2 => "ADDRESS",
                3 => "YEAR",
                4 => "MAP",
                5 => "REGION",
                6 => "LAYOUT",
                7 => "SQUARE",
                8 => "SIDE",
                9 => "IS_EXCLUSIVE",
                10 => "STAGE",
                11 => "STAGES_COUNT",
            ),
            'CHECK_DATES' => 'Y',
            'DETAIL_URL' => '',
            'PREVIEW_TRUNCATE_LEN' => '',
            'ACTIVE_DATE_FORMAT' => 'd.m.Y',
            'SET_TITLE' => 'N',
            'SET_BROWSER_TITLE' => 'N',
            'SET_META_KEYWORDS' => 'N',
            'SET_META_DESCRIPTION' => 'N',
            'SET_LAST_MODIFIED' => 'N',
            'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
            'ADD_SECTIONS_CHAIN' => 'N',
            'HIDE_LINK_WHEN_NO_DETAIL' => 'Y',
            'PARENT_SECTION' => '',
            'PARENT_SECTION_CODE' => '',
            'INCLUDE_SUBSECTIONS' => 'Y',
            'CACHE_TYPE' => 'A',
            'CACHE_TIME' => '36000000',
            'CACHE_FILTER' => 'Y',
            'CACHE_GROUPS' => 'N',
            'DISPLAY_TOP_PAGER' => 'Y',
            'DISPLAY_BOTTOM_PAGER' => 'Y',
            'PAGER_TITLE' => 'Элементы',
            'PAGER_SHOW_ALWAYS' => 'N',
            'PAGER_TEMPLATE' => '',
            'PAGER_DESC_NUMBERING' => 'N',
            'PAGER_DESC_NUMBERING_CACHE_TIME' => '36000',
            'PAGER_SHOW_ALL' => 'N',
            'PAGER_BASE_LINK_ENABLE' => 'N',
            'SET_STATUS_404' => 'N',
            'SHOW_404' => 'N',
            'MESSAGE_404' => '',
            'PAGER_BASE_LINK' => '',
            'PAGER_PARAMS_NAME' => 'arrPager',
            'AJAX_OPTION_JUMP' => 'N',
            'AJAX_OPTION_STYLE' => 'Y',
            'AJAX_OPTION_HISTORY' => 'N',
            'AJAX_OPTION_ADDITIONAL' => '',
            'THE_BEST' => true,
            'IS_RENT' => true,
        )); ?>
<?endif;?>
<?if($inRootDir):?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:news.detail",
        "tenant",
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
            "ELEMENT_CODE" => "lessee",
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
            "COMPONENT_TEMPLATE" => "tenant"
        ),
        false
    ); ?>

    <? $APPLICATION->IncludeComponent(
        "bitrix:news.detail",
        "tenant",
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
            "ELEMENT_CODE" => "_landlord",
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
            "COMPONENT_TEMPLATE" => "tenant"
        ),
        false
    ); ?>
<?endif;?>


    <div id="rent-form" class="fancybox-feedback" style="display: none;">
        <? $APPLICATION->IncludeComponent(
	"lema:form.ajax", 
	"rent_request",
	array(
		"COMPONENT_TEMPLATE" => "rent_request",
		"FORM_CLASS" => "ajax-form rent-order",
		"FORM_ACTION" => "",
		"FORM_152_FZ" => "Я ознакомлен <a target=\"_blank\" href=\"/contacts/apply.pdf\">c положением об обработке и защите персональных данных.</a>",
		"FORM_BTN_TITLE" => "Отправить",
		"FORM_SUCCESS_FUNCTION" => "\$.fancybox.open(\"Ваше сообщение успешно отправлено\")",
		"FORM_SUCCESS_FUNCTION_CORRECT_JSON" => "Y",
		"FORM_FIELDS" => "[{\"name\":\"name\",\"type\":\"text\",\"title\":\"\",\"placeholder\":\"Ваше имя\",\"default\":\"\",\"required\":\"Y\"},{\"name\":\"email\",\"type\":\"email\",\"title\":\"\",\"placeholder\":\"Ваша электронная почта\",\"default\":\"\",\"required\":\"Y\"},{\"name\":\"phone\",\"type\":\"text\",\"title\":\"\",\"placeholder\":\"Ваш номер телефона\",\"default\":\"\",\"required\":\"Y\"},{\"name\":\"comment\",\"type\":\"text\",\"title\":\"\",\"placeholder\":\"Комментарий\",\"default\":\"\",\"required\":\"N\"}]",
		"NEED_SAVE_TO_IBLOCK" => "Y",
		"NEED_SEND_EMAIL" => "Y",
		"EVENT_TYPE" => "69",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"IBLOCK_TYPE" => "feedback",
		"IBLOCK_ID" => "17"
	),
	false
); ?>
    </div>

<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
?>