<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

foreach ($arResult["ITEMS"] as $key => $arItem)
{
    $parentSection = GetIBlockSection($arItem["IBLOCK_SECTION_ID"]);
    $parentSectionCode = $parentSection['CODE'];
    if( $parentSectionCode== 'main_page_stocks')
    {
        $stocksOnMainPage[] = $arItem;
    }
}
$arResult["ITEMS"] = $stocksOnMainPage;