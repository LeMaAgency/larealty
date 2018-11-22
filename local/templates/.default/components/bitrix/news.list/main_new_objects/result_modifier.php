<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

$arItemID = [];
foreach ($arResult['ITEMS'] as $arItem) {
    $arItemID[] = $arItem['ID'];
}
$arResult['TEMP_OFFERS'] = \Lema\IBlock\Element::getList(
    LIblock::getId('objects_offers'),
    array(
        'filter' => array('PROPERTY_CML2_LINK' => $arItemID),
        'arSelect' => array('ID', 'PROPERTY_PRICE', 'PROPERTY_CML2_LINK'),
    )
);
$arResult['OFFERS'] = [];
foreach ($arResult['TEMP_OFFERS'] as $k => $arOffer) {
    $arResult['OFFERS'][$arOffer['PROPERTY_CML2_LINK_VALUE']][] = $arOffer;
}
foreach ($arResult['OFFERS'] as $keyArOffers => $arOffer) {
    $minPrice = 0;
    foreach ($arOffer as $keyOffer => $offer) {
        if (!$keyOffer || ($minPrice > $offer['PROPERTY_PRICE_VALUE'])) {
            $arResult['OFFERS'][$keyArOffers]['MIN_PRICE'] = $offer['PROPERTY_PRICE_VALUE'];
        }
    }
}

//Фильрация по свойству SHOW_IN_NEW_OBJ_BLOCK
$newObjects = array();
$arResult['NEW_OBJ_COUNT'] = 0;
foreach ($arResult['ITEMS'] as $arItem)
{
    if($arItem['PROPERTIES']['SHOW_IN_NEW_OBJ_BLOCK']['VALUE'])
    {
        $newObjects[] = $arItem;
        $arResult['NEW_OBJ_COUNT']++;
    }
}
$arResult['ITEMS'] = $newObjects;
?>