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
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

?>

<?if($arParams["USE_RSS"]=="Y"):?>
	<?
	if(method_exists($APPLICATION, 'addheadstring'))
		$APPLICATION->AddHeadString('<link rel="alternate" type="application/rss+xml" title="'.$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"].'" href="'.$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"].'" />');
	?>
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
<br />
<?endif?>
<? if ($arParams["USE_FILTER"] == "Y"): ?>
    <? $APPLICATION->IncludeComponent(
        "lema:new_catalog.filter",
        "",
        Array(
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "FILTER_NAME" => 'arrFilter',
            "FIELD_CODE" => $arParams["FILTER_FIELD_CODE"],
            "PROPERTY_CODE" => $arParams["FILTER_PROPERTY_CODE"],
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
            "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
        ),
        $component
    );
    ?>
<? endif ?>
<?

$arFilter =array(
    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
    'ACTIVE' => 'Y',
);
if($_GET['show_new_objects'] == 'Y')
{
    $GLOBALS['arrFilter']['PROPERTY_SHOW_IN_NEW_OBJ_BLOCK_VALUE'] = 'Y';
}
if(!empty($GLOBALS['arrFilter']['ID'])){
    $arFilter['ID'] = $GLOBALS['arrFilter']['ID'];
}elseif (!empty($GLOBALS['arrFilter']['PROPERTY'])) {
    foreach ($GLOBALS['arrFilter']['PROPERTY'] as $prop => $val) {
        $strProp = preg_replace("/[^a-zA-ZА-Яа-я0-9\s]/","",$prop);
        $arFilter[str_replace($strProp,'PROPERTY_'.$strProp,$prop)] = $val;
        var_dump($arFilter);
    }
}
$countElements = '0';
$res = \CIblockElement::getList(
    array(),
    $arFilter,
    false,
    false,
    array(
        'ID'
    )
);
while ($ar_res = $res->Fetch()) {
    $countElements++;
}

?>
<section class="catalog">
    <div class="container">
        <!-- Сортировка -->
        <div class="catalog-sort">
            <div class="catalog-title">Найдено
                <?= \Lema\Common\Helper::pluralizeN(
                    $countElements,
                    array(
                        Loc::getMessage('LEMA_ELEM_NEW_ONE_OBJECT'),
                        Loc::getMessage('LEMA_ELEM_NEW_TWO_OBJECTS'),
                        Loc::getMessage('LEMA_ELEM_NEW_MANY_OBJECTS'),
                    )
                ); ?>
            </div>
            <div class="sort-list">
                <!--<select name="sort-select" class="sort-select js-sort-select">
                    <option value="1">
                        Сортировать по
                    </option>
                </select>-->
                <div>
                    <div class="sort-list_count js-sort">
                        <div class="sort-btn <? if (!!selected('count', '24')) { ?>sort-list_count-active<? } ?>"
                             data-url="<?= $APPLICATION->GetCurPageParam('count=24', array('count')); ?>">
                            24
                        </div>
                        <div class="sort-btn <? if (!!selected('count', '36')) { ?>sort-list_count-active<? } ?>"
                             data-url="<?= $APPLICATION->GetCurPageParam('count=36', array('count')); ?>">
                            36
                        </div>
                        <div class="sort-btn <? if (!!selected('count', '48')) { ?>sort-list_count-active<? } ?>"
                             data-url="<?= $APPLICATION->GetCurPageParam('count=48', array('count')); ?>">
                            48
                        </div>
                        <div class="sort-btn <? if (!!selected('count', '60')) { ?>sort-list_count-active<? } ?>"
                             data-url="<?= $APPLICATION->GetCurPageParam('count=60', array('count')); ?>">
                            60
                        </div>
                    </div>

                    <!--<div class="sort-list_type">
                        <div class="sort-type1"></div>
                        <div class="sort-type2"></div>
                        <div class="sort-type3"></div>
                    </div>-->
                </div>
            </div>
        </div>


        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "",
            Array(
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "NEWS_COUNT" => $_REQUEST['count'] ? $_REQUEST['count'] : $arParams["NEWS_COUNT"],
                "SORT_BY1" => $arParams["SORT_BY1"],
                "SORT_ORDER1" => $arParams["SORT_ORDER1"],
                "SORT_BY2" => $arParams["SORT_BY2"],
                "SORT_ORDER2" => $arParams["SORT_ORDER2"],
                "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
                "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                "DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
                "SET_TITLE" => "Y",
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
                "FILTER_NAME" => 'arrFilter',
                "HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
                "CHECK_DATES" => $arParams["CHECK_DATES"],
                "STRICT_SECTION_CHECK" => $arParams["STRICT_SECTION_CHECK"],

                "PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
                "PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
                "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                "IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
            ),
            $component
        ); ?>

    </div>
</section>



<section class="catalog-text">
    <div class="container bhelp">
        <? $rsSections = CIBlockSection::GetList(
            array(),
            array(
                'IBLOCK_ID' => 2,
                '=CODE' => $arResult['VARIABLES']['SECTION_CODE']
            ),
            false,
            array(
                'DESCRIPTION'
            )
        );
        if ($arSection = $rsSections->Fetch()) {
            if ($arSection['DESCRIPTION_TYPE'] == "html") {
                echo htmlspecialchars_decode($arSection['DESCRIPTION']);
            } else {
                echo $arSection['DESCRIPTION'];
            }
        }
        ?>
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
    <?
    $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "catalog-sections", Array(
        "ADD_SECTIONS_CHAIN" => "Y",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "COUNT_ELEMENTS" => "Y",
        "IBLOCK_ID" => "2",
        "IBLOCK_TYPE" => "realty",
        "SECTION_CODE" => $_REQUEST["SECTION_CODE"],
        "SECTION_FIELDS" => array(
            0 => "",
            1 => "",
        ),
        "SECTION_ID" => $_REQUEST["SECTION_ID"],
        "SECTION_URL" => "",
        "SECTION_USER_FIELDS" => array(
            0 => "",
            1 => "",
        ),
        "SHOW_PARENT_NAME" => "Y",
        "TOP_DEPTH" => "3",
        "VIEW_MODE" => "LIST",
    ),
        false
    ); ?>
</section>
