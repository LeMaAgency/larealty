<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
?>
<div class="item-card">
    <div class="container">

        <? \Lema\Components\Breadcrumbs::inc('catalog'); ?>

        <? $ElementID = $APPLICATION->IncludeComponent(
            "bitrix:news.detail",
            "detail",
            Array(
                "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
                "DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
                "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
                "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
                "PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
                "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
                "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                "META_KEYWORDS" => $arParams["META_KEYWORDS"],
                "META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
                "BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
                "SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
                "DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
                "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                "SET_TITLE" => $arParams["SET_TITLE"],
                "MESSAGE_404" => $arParams["MESSAGE_404"],
                "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                "SHOW_404" => $arParams["SHOW_404"],
                "FILE_404" => $arParams["FILE_404"],
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
                "CACHE_TYPE" => "N",//$arParams["CACHE_TYPE"]
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                "USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
                "GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
                "DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
                "DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
                "PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
                "PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
                "CHECK_DATES" => $arParams["CHECK_DATES"],
                "ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
                "ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
                "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                "IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
                "USE_SHARE" => $arParams["USE_SHARE"],
                "SHARE_HIDE" => $arParams["SHARE_HIDE"],
                "SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
                "SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
                "SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
                "SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
                "ADD_ELEMENT_CHAIN" => (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : ''),
                'STRICT_SECTION_CHECK' => (isset($arParams['STRICT_SECTION_CHECK']) ? $arParams['STRICT_SECTION_CHECK'] : ''),
            ),
            $component
        ); ?>
        <!--<p><a href="<? /*=$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"]*/ ?>"><? /*=GetMessage("T_NEWS_DETAIL_BACK")*/ ?></a></p>-->
        <? if ($arParams["USE_RATING"] == "Y" && $ElementID): ?>
            <? $APPLICATION->IncludeComponent(
                "bitrix:iblock.vote",
                "",
                Array(
                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "ELEMENT_ID" => $ElementID,
                    "MAX_VOTE" => $arParams["MAX_VOTE"],
                    "VOTE_NAMES" => $arParams["VOTE_NAMES"],
                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                ),
                $component
            ); ?>
        <? endif ?>
        <? if ($arParams["USE_CATEGORIES"] == "Y" && $ElementID):
            global $arCategoryFilter;
            $obCache = new CPHPCache;
            $strCacheID = $componentPath . LANG . $arParams["IBLOCK_ID"] . $ElementID . $arParams["CATEGORY_CODE"];
            if (($tzOffset = CTimeZone::GetOffset()) <> 0)
                $strCacheID .= "_" . $tzOffset;
            if ($arParams["CACHE_TYPE"] == "N" || $arParams["CACHE_TYPE"] == "A" && COption::GetOptionString("main", "component_cache_on", "Y") == "N")
                $CACHE_TIME = 0;
            else
                $CACHE_TIME = $arParams["CACHE_TIME"];
            if ($obCache->StartDataCache($CACHE_TIME, $strCacheID, $componentPath)) {
                $rsProperties = CIBlockElement::GetProperty($arParams["IBLOCK_ID"], $ElementID, "sort", "asc", array("ACTIVE" => "Y", "CODE" => $arParams["CATEGORY_CODE"]));
                $arCategoryFilter = array();
                while ($arProperty = $rsProperties->Fetch()) {
                    if (is_array($arProperty["VALUE"]) && count($arProperty["VALUE"]) > 0) {
                        foreach ($arProperty["VALUE"] as $value)
                            $arCategoryFilter[$value] = true;
                    } elseif (!is_array($arProperty["VALUE"]) && strlen($arProperty["VALUE"]) > 0)
                        $arCategoryFilter[$arProperty["VALUE"]] = true;
                }
                $obCache->EndDataCache($arCategoryFilter);
            } else {
                $arCategoryFilter = $obCache->GetVars();
            }
            if (count($arCategoryFilter) > 0):
                $arCategoryFilter = array(
                    "PROPERTY_" . $arParams["CATEGORY_CODE"] => array_keys($arCategoryFilter),
                    "!" . "ID" => $ElementID,
                );
                ?>
                <hr/><h3><?= GetMessage("CATEGORIES") ?></h3>
                <? foreach ($arParams["CATEGORY_IBLOCK"] as $iblock_id): ?>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    $arParams["CATEGORY_THEME_" . $iblock_id],
                    Array(
                        "IBLOCK_ID" => $iblock_id,
                        "NEWS_COUNT" => $arParams["CATEGORY_ITEMS_COUNT"],
                        "SET_TITLE" => "N",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "FILTER_NAME" => "arCategoryFilter",
                        "CACHE_FILTER" => "Y",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                    ),
                    $component
                ); ?>
            <? endforeach ?>
            <? endif ?>
        <? endif ?>
        <? if ($arParams["USE_REVIEW"] == "Y" && IsModuleInstalled("forum") && $ElementID): ?>
            <hr/>
            <? $APPLICATION->IncludeComponent(
                "bitrix:forum.topic.reviews",
                "",
                Array(
                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                    "MESSAGES_PER_PAGE" => $arParams["MESSAGES_PER_PAGE"],
                    "USE_CAPTCHA" => $arParams["USE_CAPTCHA"],
                    "PATH_TO_SMILE" => $arParams["PATH_TO_SMILE"],
                    "FORUM_ID" => $arParams["FORUM_ID"],
                    "URL_TEMPLATES_READ" => $arParams["URL_TEMPLATES_READ"],
                    "SHOW_LINK_TO_FORUM" => $arParams["SHOW_LINK_TO_FORUM"],
                    "DATE_TIME_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
                    "ELEMENT_ID" => $ElementID,
                    "AJAX_POST" => $arParams["REVIEW_AJAX_POST"],
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "URL_TEMPLATES_DETAIL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
                ),
                $component
            ); ?>
        <? endif ?>
        <? $arTempBudgetId = $arTempHomeId = $arTempRegionId = [];
        //Диапазон цены (вкладка по бюджету)
        $intPriceRange = 1000000;
        $res = \CIBlockElement::getList(
            [],
            [
                'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                'ACTIVE' => 'Y',
                'PROPERTY_POPULAR_VALUE' => 'Y',
                '!ID' => $GLOBALS['THIS_ELEM_ID'],
            ],
            false,
            false,
            [
                'ID',
                'PROPERTY_REGION',
                'PROPERTY_PRICE',
            ]
        );
        while ($ar_res = $res->Fetch()) {
            //По бюджету
            if ($ar_res['PROPERTY_PRICE_VALUE'] && $GLOBALS['PRICE_ELEM_VALUE']) {
                $minPrice = (int)$GLOBALS['PRICE_ELEM_VALUE'] - $intPriceRange;
                $maxPrice = (int)$GLOBALS['PRICE_ELEM_VALUE'] + $intPriceRange;
                if ((int)$ar_res['PROPERTY_PRICE_VALUE'] >= $minPrice && (int)$ar_res['PROPERTY_PRICE_VALUE'] <= $maxPrice) {
                    $arTempBudgetId[] = $ar_res['ID'];
                }
            }
            //По региону
            if (!empty($ar_res['PROPERTY_REGION_VALUE']) && $ar_res['PROPERTY_REGION_VALUE'] == $GLOBALS['REGION_ELEM_VALUE']) {
                $arTempRegionId[] = $ar_res['ID'];
            }
        }


        $resOffer = \CIBlockElement::getList(
            [],
            [
                'IBLOCK_ID' => \LIblock::getId('objects_offers'),
                'ACTIVE' => 'Y',
                'PROPERTY_POPULAR_VALUE' => 'Y',
                'PROPERTY_CML2_LINK' => $GLOBALS['THIS_ELEM_ID'],
                '!ID' => $GLOBALS['THIS_OFFER_ID'],
            ],
            false,
            false,
            [
                'ID',
                'PROPERTY_CML2_LINK',
            ]
        );
        while ($ar_res_offer = $resOffer->Fetch()) {
            //По дому
            $arTempHomeId[] = $ar_res_offer['ID'];
        }

        ?>
        <? if (!empty($arTempBudgetId) || !empty($arTempHomeId) || !empty($arTempRegionId)) { ?>
            <section class="popularoffer">
                <div class="container">
                    <h2>Популярные объекты</h2>
                    <div class="offer-tabs">
                        <div class="tabs">
                            <?
                            if (!empty($arTempBudgetId)) { ?>
                                <div class="tab active">По бюджету</div>
                            <? } ?>
                            <? if (!empty($arTempHomeId)) { ?>
                                <div class="tab <?if(empty($arTempBudgetId)){?>active<?}?>">В доме</div>
                            <? } ?>
                            <? if (!empty($arTempRegionId)) { ?>
                                <div class="tab <?if(empty($arTempBudgetId) && empty($arTempHomeId)){?>active<?}?>">В районе</div>
                            <? } ?>
                        </div>
                        <div class="content">

                            <? if (!empty($arTempBudgetId)) { ?>
                            <div class="tab-cont active">
                                <div class="newoffer-slider">
                                    <?
                                    $GLOBALS['arPopularFilterAll'] = array(
                                        '=ID' => $arTempBudgetId,
                                    );
                                    $APPLICATION->IncludeComponent(
                                        "bitrix:news.list",
                                        "detail_page_popular",
                                        Array(
                                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                            "NEWS_COUNT" => "",
                                            "SORT_BY1" => "PROPERTY_PRICE",
                                            "SORT_ORDER1" => "ASC",
                                            "SORT_BY2" => $arParams["SORT_BY2"],
                                            "SORT_ORDER2" => $arParams["SORT_ORDER2"],
                                            "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
                                            "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                                            "DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
                                            "SET_TITLE" => "N",
                                            "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                                            "MESSAGE_404" => $arParams["MESSAGE_404"],
                                            "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                                            "SHOW_404" => $arParams["SHOW_404"],
                                            "FILE_404" => $arParams["FILE_404"],
                                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                            "ADD_SECTIONS_CHAIN" => "N",
                                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                                            "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                                            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                            "DISPLAY_TOP_PAGER" => "N",
                                            "DISPLAY_BOTTOM_PAGER" => "N",
                                            "SET_TITLE" => "N",
                                            "SET_BROWSER_TITLE" => "N",
                                            "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                                            "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                                            "PAGER_SHOW_ALWAYS" => "N",
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
                                            "FILTER_NAME" => 'arPopularFilterAll',
                                            "HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
                                            "CHECK_DATES" => $arParams["CHECK_DATES"],
                                            "STRICT_SECTION_CHECK" => $arParams["STRICT_SECTION_CHECK"],

                                            "PARENT_SECTION" => '',
                                            "PARENT_SECTION_CODE" => '',
                                            "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
                                            "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                                            "IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
                                        ),
                                        $component
                                    ); ?>
                                </div>
                            </div>
                            <?}?>

                            <? if (!empty($arTempHomeId)) { ?>
                            <div class="tab-cont <?if(empty($arTempBudgetId)){?>active<?}?>">
                                <div class="newoffer-slider">
                                    <?
                                    $GLOBALS['arPopularFilterHome'] = array(
                                        '=ID' => $arTempHomeId,
                                    );
                                    $APPLICATION->IncludeComponent(
                                        "bitrix:news.list",
                                        "detail_page_popular",
                                        Array(
                                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                            "IBLOCK_ID" => \LIblock::getId('objects_offers'),
                                            "NEWS_COUNT" => "",
                                            "SORT_BY1" => $arParams["SORT_BY1"],
                                            "SORT_ORDER1" => $arParams["SORT_ORDER1"],
                                            "SORT_BY2" => $arParams["SORT_BY2"],
                                            "SORT_ORDER2" => $arParams["SORT_ORDER2"],
                                            "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
                                            "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                                            "DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
                                            "SET_TITLE" => "N",
                                            "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                                            "MESSAGE_404" => $arParams["MESSAGE_404"],
                                            "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                                            "SHOW_404" => $arParams["SHOW_404"],
                                            "FILE_404" => $arParams["FILE_404"],
                                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                            "ADD_SECTIONS_CHAIN" => "N",
                                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                                            "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                                            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                            "DISPLAY_TOP_PAGER" => "N",
                                            "DISPLAY_BOTTOM_PAGER" => "N",
                                            "SET_TITLE" => "N",
                                            "SET_BROWSER_TITLE" => "N",
                                            "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                                            "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                                            "PAGER_SHOW_ALWAYS" => "N",
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
                                            "FILTER_NAME" => 'arPopularFilterHome',
                                            "HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
                                            "CHECK_DATES" => $arParams["CHECK_DATES"],
                                            "STRICT_SECTION_CHECK" => $arParams["STRICT_SECTION_CHECK"],

                                            "PARENT_SECTION" => '',
                                            "PARENT_SECTION_CODE" => '',
                                            "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
                                            "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                                            "IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
                                        ),
                                        $component
                                    ); ?>
                                </div>
                            </div>
                            <?}?>
                            <? if (!empty($arTempRegionId)) { ?>
                            <div class="tab-cont <?if(empty($arTempBudgetId) && empty($arTempHomeId)){?>active<?}?>">
                                <div class="newoffer-slider">
                                    <?
                                    $GLOBALS['arPopularFilterRegion'] = array(
                                        '=ID' => $arTempRegionId,
                                    );
                                    $APPLICATION->IncludeComponent(
                                        "bitrix:news.list",
                                        "detail_page_popular",
                                        Array(
                                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                            "NEWS_COUNT" => "",
                                            "SORT_BY1" => $arParams["SORT_BY1"],
                                            "SORT_ORDER1" => $arParams["SORT_ORDER1"],
                                            "SORT_BY2" => $arParams["SORT_BY2"],
                                            "SORT_ORDER2" => $arParams["SORT_ORDER2"],
                                            "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
                                            "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                                            "DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
                                            "SET_TITLE" => "N",
                                            "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                                            "MESSAGE_404" => $arParams["MESSAGE_404"],
                                            "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                                            "SHOW_404" => $arParams["SHOW_404"],
                                            "FILE_404" => $arParams["FILE_404"],
                                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                            "CACHE_TYPE" => "N",
                                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                                            "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                                            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                            "DISPLAY_TOP_PAGER" => "N",
                                            "DISPLAY_BOTTOM_PAGER" => "N",
                                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                            "ADD_SECTIONS_CHAIN" => "N",
                                            "SET_TITLE" => "N",
                                            "SET_BROWSER_TITLE" => "N",
                                            "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                                            "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                                            "PAGER_SHOW_ALWAYS" => "N",
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
                                            "FILTER_NAME" => 'arPopularFilterRegion',
                                            "HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
                                            "CHECK_DATES" => $arParams["CHECK_DATES"],
                                            "STRICT_SECTION_CHECK" => $arParams["STRICT_SECTION_CHECK"],

                                            "PARENT_SECTION" => '',
                                            "PARENT_SECTION_CODE" => '',
                                            "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
                                            "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                                            "IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
                                        ),
                                        $component
                                    ); ?>
                                </div>
                            </div>
                            <?}?>
                        </div>
                    </div>
                </div>

            </section>
        <? } ?>

        <section class="catalog-text">
            <div class="container bhelp">
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
            <?/*
            $APPLICATION->IncludeComponent(
                "bitrix:catalog.section.list",
                "catalog-sections",
                Array(
                    "ADD_SECTIONS_CHAIN" => "N",
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
            ); */?>
            <div id="assign-view-form" style="display: none;">
                <section class="catalog-text assign-view-form">
                    <div class="container bhelp">
                        <div class="help-form">
                            <form method="post" class="ajax-form js-assign-view-form"
                                  action="<?= SITE_DIR ?>ajax/assign-view.php">
                                <h2 class="section-h2">
                                    Назначить просмотр
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
                                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/footer/personal_data_text.php'); ?>
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
        </section>
    </div>
</div>