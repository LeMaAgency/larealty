<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Localization\Loc,
    Lema\Template\TemplateHelper as TH;

Loc::loadMessages(__FILE__);

$data = new TH($this);

$item = $data->item();

/**
 * Check URL
 */
/*if($APPLICATION->GetCurDir() != getElementDetailUrl($item))
{
    \Bitrix\Iblock\Component\Tools::process404(
        ""
        ,($arParams["SET_STATUS_404"] === "Y")
        ,($arParams["SET_STATUS_404"] === "Y")
        ,($arParams["SHOW_404"] === "Y")
        ,$arParams["FILE_404"]
    );
    return ;
}*/

/**
 * Slider images (detail picture + more photo
 */
$arResult['SLIDER_IMAGES'] = array();

if (!empty($arResult['DETAIL_PICTURE']))
    $arResult['SLIDER_IMAGES'][] = $arResult['DETAIL_PICTURE']['SRC'];

if (!empty($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'])) {
    foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $imgId)
        $arResult['SLIDER_IMAGES'][] = \CFile::GetPath($imgId);
}


$arResult['ADDRESS'] = $arResult['PROPERTIES']['ADDRESS']['VALUE'];

$sections = \Lema\IBlock\Section::getAllD7($arParams['IBLOCK_ID'], array(
    'filter' => array('=ID' => $arResult['IBLOCK_SECTION_ID']),
    'select' => array('ID', 'CODE'),
));

$arResult['IS_HOUSE_OR_LOT'] = false;
if (isset($sections[$arResult['IBLOCK_SECTION_ID']]['CODE']))
    $arResult['IS_HOUSE_OR_LOT'] = in_array($sections[$arResult['IBLOCK_SECTION_ID']]['CODE'], array('doma', 'dachi'));


$basket = new \Lema\Basket\Basket();
$arResult['IN_FAVORITES'] = array();
foreach ($basket->getProducts() as $data) {
    $arResult['IN_FAVORITES'][$data['PRODUCT_ID']] = $data['ID'];
}

$arResult['OFFERS'] = \Lema\IBlock\Element::getList(LIblock::getId('objects_offers'), array(
    'filter' => array('PROPERTY_CML2_LINK' => $arResult['ID']),
    'arSelect' => array(
        'ID',
        'NAME',
        'DETAIL_TEXT',
        'PROPERTY_PRICE',
        'PROPERTY_REALTY_TYPE',
        'PROPERTY_ROOMS_COUNT',
        'PROPERTY_STAGE',
        'PROPERTY_SQUARE',
        'PROPERTY_REGION',
        'PROPERTY_SLABS',
        'PROPERTY_FINISHING',
        'PROPERTY_SECURITY',
        'PROPERTY_INFRASTRUCTURE',
        'PROPERTY_LANDSCAPING',
        'PROPERTY_WINDOWS',
        'PROPERTY_REGION_INFRASTRUCTURE',
        'PROPERTY_ADDRESS',
        'PROPERTY_METRO',
        'PROPERTY_PARKING',
        'PROPERTY_MATERIAL'
    ),
));
$res = \CIBlockProperty::GetList(
    array(),
    array(
        'IBLOCK_ID' => \LIblock::getId('objects_offers'),
    )
);
$arResult['OFFER_PROP_NAME'] = [];
while ($ar_res = $res->Fetch()) {
    $arResult['OFFER_PROP_NAME'][$ar_res['CODE']] = $ar_res['NAME'];
}
/*
$images = [];
foreach($arResult['OFFERS'] as $k => $arOffer)
{
    if(!empty($arOffer['PREVIEW_PICTURE']))
    {
        if(!isset($images[$arOffer['PREVIEW_PICTURE']]))
            $images[$arOffer['PREVIEW_PICTURE']] = \CFile::GetPath($arOffer['PREVIEW_PICTURE']);
        $arResult['OFFERS'][$k]['PREVIEW_PICTURE_SRC'] = $images[$arOffer['PREVIEW_PICTURE']];
    }
}*/