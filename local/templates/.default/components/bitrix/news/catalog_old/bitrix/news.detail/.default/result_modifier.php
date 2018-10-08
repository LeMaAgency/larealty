<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Localization\Loc,
    Lema\Template\TemplateHelper as TH;

Loc::loadMessages(__FILE__);

$data = new TH($this);

$item = $data->item();


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
            'NAME' => htmlspecialcharsbx(trim($row['LAST_NAME'] . ' ' . $row['NAME'])),
            'IMG' => (empty($row['WORK_LOGO']) ? null : \CFile::GetPath($row['WORK_LOGO'])),
            'PHONE' => htmlspecialcharsbx($row['WORK_PHONE']),
        );
    }
}