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
if($APPLICATION->GetCurDir() != getElementDetailUrl($item))
{
    \Bitrix\Iblock\Component\Tools::process404(
        ""
        ,($arParams["SET_STATUS_404"] === "Y")
        ,($arParams["SET_STATUS_404"] === "Y")
        ,($arParams["SHOW_404"] === "Y")
        ,$arParams["FILE_404"]
    );
    return ;
}

/**
 * Slider images (detail picture + more photo
 */
$arResult['SLIDER_IMAGES'] = array();

if(!empty($arResult['DETAIL_PICTURE']))
    $arResult['SLIDER_IMAGES'][] = $arResult['DETAIL_PICTURE']['SRC'];

if(!empty($arResult['PROPERTIES']['MORE_PHOTO']['VALUE']))
{
    foreach($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $imgId)
        $arResult['SLIDER_IMAGES'][] = \CFile::GetPath($imgId);
}


/**
 * Collect address from parts:
 * City, Region, Street, House number and building number
 */
$props = array(
    'CITY' => array(
        'prefix' => Loc::getMessage('LEMA_CITY_PREFIX'),
        'postfix' => Loc::getMessage('LEMA_CITY_POSTFIX')
    ),
    'REGION' => array(
        'prefix' => Loc::getMessage('LEMA_REGION_PREFIX'),
        'postfix' => Loc::getMessage('LEMA_REGION_POSTFIX')
    ),
    'STREET' => array(
        'prefix' => Loc::getMessage('LEMA_STREET_PREFIX'),
        'postfix' => Loc::getMessage('LEMA_STREET_POSTFIX')
    ),
    'HOUSE_NUMBER' => array(
        'prefix' => Loc::getMessage('LEMA_HOUSE_NUMBER_PREFIX'),
        'postfix' => Loc::getMessage('LEMA_HOUSE_NUMBER_POSTFIX')
    ),
);

$splitSymbol = ', ';

/**
 * Set address for item
 */

$arResult['ADDRESS'] = null;
foreach($props as $propCode => $propData)
{
    if($item->propFilled($propCode))
    {
        if(!empty($arResult['ADDRESS']))
            $arResult['ADDRESS'] .= $splitSymbol;
        $arResult['ADDRESS'] .= $propData['prefix'] . $item->propVal($propCode) . $propData['postfix'];
    }
}
if($item->propFilled('BUILDING_NUMBER'))
{
    if(0 !== strpos($item->propVal('BUILDING_NUMBER'), '/'))
        $arResult['ADDRESS'] .= $splitSymbol;
    $arResult['ADDRESS'] .= $item->propVal('BUILDING_NUMBER');
}

$arResult['RIELTOR'] = array();
if($item->propFilled('RIELTOR'))
{
    $res = \CUser::GetByID($item->propVal('RIELTOR'));
    if($row = $res->Fetch())
    {
        $arResult['RIELTOR'] = array(
            'NAME' => htmlspecialcharsbx(trim($row['LAST_NAME'] . ' ' . $row['SECOND_NAME'] . ' ' . $row['NAME'])),
            'IMG' => (empty($row['WORK_LOGO']) ? null : \CFile::GetPath($row['WORK_LOGO'])),
            'PHONE' => htmlspecialcharsbx($row[empty($row['WORK_PHONE']) ? 'PERSONAL_PHONE' : 'WORK_PHONE']),
        );
    }
}

$sections = \Lema\IBlock\Section::getAllD7($arParams['IBLOCK_ID'], array(
    'filter' => array('=ID' => $arResult['IBLOCK_SECTION_ID']),
    'select' => array('ID', 'CODE'),
));

$arResult['IS_HOUSE_OR_LOT'] = false;
if(isset($sections[$arResult['IBLOCK_SECTION_ID']]['CODE']))
    $arResult['IS_HOUSE_OR_LOT'] = in_array($sections[$arResult['IBLOCK_SECTION_ID']]['CODE'], array('doma', 'dachi'));