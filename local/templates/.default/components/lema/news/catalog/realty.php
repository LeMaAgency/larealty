<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if(isset($arResult['VARIABLES']['SECTION_CODE']) && in_array($arResult['VARIABLES']['SECTION_CODE'], array('doma', 'dachi', 'zemelnyy_uchastok'))) {
    $showButtonTypes = array(
        'doma' => 'Дома',
        'dachi' => 'Дачи',
        'zemelnyy_uchastok' => 'Земельные участки',
    );
}
else
{
    $showButtonTypes = array(
        'kvartiry' => 'Квартиры',
        'komnaty' => 'Комнаты',
    );
}

?>

<?if($arParams["USE_RSS"]=="Y"):?>
	<?
	if(method_exists($APPLICATION, 'addheadstring'))
		$APPLICATION->AddHeadString('<link rel="alternate" type="application/rss+xml" title="'.$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"].'" href="'.$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"].'" />');
	?>
	<!--suppress ALL -->
    <a href="<?=$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"]?>" title="rss" target="_self"><img alt="RSS" src="<?=$templateFolder?>/images/gif-light/feed-icon-16x16.gif" border="0" align="right" /></a>
<?endif?>

<?if($arParams["USE_SEARCH"]=="Y"):?>
<?=GetMessage("SEARCH_LABEL")?><?$APPLICATION->IncludeComponent(
	"bitrix:search.form",
	"flat",
	Array(
		"PAGE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["search"]
	),
	$component
);?>
<?endif?>
<?if($arParams["USE_FILTER"]=="Y"):?>
<?$APPLICATION->IncludeComponent(
	"lema:catalog.filter",
	"filter",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"FIELD_CODE" => $arParams["FILTER_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["FILTER_PROPERTY_CODE"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
		"SEF_MODE" => $arParams["SEF_MODE"],
        "FILTER_ORDER" => $arParams["FILTER_ORDER"],
        'SHOW_BUTTON_TYPES' => $showButtonTypes,
        'SECTION_CODE' => $arParams['PARENT_SECTION_CODE'],
	),
	$component
);
?>
<?endif?>

<?php
$sortBy = 'PROPERTY_PRICE';
$sortOrder = 'asc';
if(isset($_GET['sort']) && in_array(strtolower($_GET['sort']), array('asc', 'desc')))
    $sortOrder = strtolower($_GET['sort']);
$squareFrom = 8;
if(isset($_GET['square']) && in_array((int) $_GET['square'], array(15, 45, 80)))
    $squareFrom = (int) $_GET['square'];
if(empty($GLOBALS[$arParams['FILTER_NAME']]['PROPERTY']))
    $GLOBALS[$arParams['FILTER_NAME']]['PROPERTY'] = array();
$GLOBALS[$arParams['FILTER_NAME']]['PROPERTY']['>=SQUARE'] = $squareFrom;
?>

<div class="content-page">
    <div class="sort-catalog">
        <form method="get">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-9">
                        <div class="sort">
                            <span class="sort__title">Сортировка:</span>
                            <select name="price" id="price-id" class="js-sort sort__select cs-select cs-skin-border">
                                <option value=""
                                    <?=selected('sort', 'asc');?>
                                        data-url="<?=$APPLICATION->GetCurPageParam('sort=asc', array('sort'));?>"
                                        class="sort__option">от дешевых к дорогим </option>
                                <option value=""
                                    <?=selected('sort', 'desc');?>
                                        data-url="<?=$APPLICATION->GetCurPageParam('sort=desc', array('sort'));?>"
                                        class="sort__option">от дорогих к дешевым </option>
                            </select>
                            <select name="square-meters" id="square-meters-id" class="js-sort sort__select cs-select cs-skin-border">
                                <option value=""
                                    <?=selected('square', '15');?>
                                        data-url="<?=$APPLICATION->GetCurPageParam('square=15', array('square'));?>"
                                        class="sort__option">от 15м2</option>
                                <option value=""
                                    <?=selected('square', '45');?>
                                        data-url="<?=$APPLICATION->GetCurPageParam('square=45', array('square'));?>"
                                        class="sort__option">от 45м2</option>
                                <option value=""
                                    <?=selected('square', '80');?>
                                        data-url="<?=$APPLICATION->GetCurPageParam('square=80', array('square'));?>"
                                        class="sort__option">от 80м2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-3">
                        <a href="#" class="js-flat-fit-order order-selection"><span>Заказать подбор квартир</span></a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?$APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "catalog",
        Array(
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "NEWS_COUNT" => $arParams["NEWS_COUNT"],
            "SORT_BY1" => $sortBy,
            "SORT_ORDER1" => $sortOrder,
            "SORT_BY2" => $arParams["SORT_BY2"],
            "SORT_ORDER2" => $arParams["SORT_ORDER2"],
            "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
            "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
            "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
            "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
            "IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
            "DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
            "SET_TITLE" => $arParams["SET_TITLE"],
            "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
            "MESSAGE_404" => $arParams["MESSAGE_404"],
            "SET_STATUS_404" => $arParams["SET_STATUS_404"],
            "SHOW_404" => $arParams["SHOW_404"],
            "FILE_404" => $arParams["FILE_404"],
            "INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
            "ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_FILTER" => $arParams["CACHE_FILTER"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
            "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
            "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
            "PAGER_TITLE" => $arParams["PAGER_TITLE"],
            "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
            "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
            "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
            "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
            "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
            "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
            "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
            "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
            "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
            "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
            "PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
            "ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
            "USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
            "GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
            "FILTER_NAME" => $arParams["FILTER_NAME"],
            "HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
            "CHECK_DATES" => $arParams["CHECK_DATES"],
            'PARENT_SECTION_CODE' => $arParams['PARENT_SECTION_CODE'],
        ),
        $component
    );?>
</div>
<div id="flat-fit-order" class="fancybox-feedback" style="display: none;">
    <? $APPLICATION->IncludeComponent(
        "lema:form.ajax",
        "feedback",
        array(
            "COMPONENT_TEMPLATE" => "feedback",
            "FORM_CLASS" => "ajax-form empty",
            "FORM_ACTION" => "",
            "FORM_152_FZ" => "Я ознакомлен <a target=\"_blank\" href=\"/contacts/apply.pdf\">c положением об обработке и защите персональных данных.</a>",
            "FORM_BTN_TITLE" => "Заказать",
            "FORM_SUCCESS_FUNCTION" => "\$.fancybox.open(\"Ваше сообщение успешно отправлено\")",
            "FORM_SUCCESS_FUNCTION_CORRECT_JSON" => "Y",
            "FORM_FIELDS" => "[{\"name\":\"name\",\"type\":\"text\",\"title\":\"\",\"placeholder\":\"Имя\",\"default\":\"\",\"required\":\"Y\"},{\"name\":\"phone\",\"type\":\"tel\",\"title\":\"\",\"placeholder\":\"Телефон\",\"default\":\"\",\"required\":\"Y\"}]",
            "NEED_SAVE_TO_IBLOCK" => "Y",
            "NEED_SEND_EMAIL" => "Y",
            "EVENT_TYPE" => "79",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "3600",
            "IBLOCK_TYPE" => "feedback",
            "IBLOCK_ID" => "20"
        ),
        false
    ); ?>
</div>