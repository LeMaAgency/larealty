<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Lema\Template\TemplateHelper as TH,
    Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$data = new TH($this);

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


$sections = \LIblock::getSectionsByIblockId($arParams['IBLOCK_ID'], false);

$splitSymbol = ', ';

/**
 * Set address for item
 */
foreach($data->items() as $k => $item)
{
    $arResult['ITEMS'][$k]['DETAIL_PAGE_URL'] = getElementDetailUrl($item);

    $arResult['ITEMS'][$k]['ADDRESS'] = null;
    foreach($props as $propCode => $propData)
    {
        if($item->propFilled($propCode))
        {
            if(!empty($arResult['ITEMS'][$k]['ADDRESS']))
            {
                $arResult['ITEMS'][$k]['ADDRESS'] .= $splitSymbol;
            }
            $arResult['ITEMS'][$k]['ADDRESS'] .= $propData['prefix'] . $item->propVal($propCode) . $propData['postfix'];
        }
    }
    if($item->propFilled('BUILDING_NUMBER'))
    {
        if(0 !== strpos($item->propVal('BUILDING_NUMBER'), '/'))
        {
            $arResult['ITEMS'][$k]['ADDRESS'] .= $splitSymbol;
        }
        $arResult['ITEMS'][$k]['ADDRESS'] .= $item->propVal('BUILDING_NUMBER');
    }

    /**
     * Set realty type
     */
    $arResult['ITEMS'][$k]['IS_HOUSE_OR_LOT'] = $arResult['ITEMS'][$k]['IS_LOT'] = false;
    if(isset($sections[$item->get('IBLOCK_SECTION_ID')]['CODE']))
    {
        $arResult['ITEMS'][$k]['IS_HOUSE_OR_LOT'] = in_array($sections[$item->get('IBLOCK_SECTION_ID')]['CODE'], array(
            'doma', 'dachi', 'zemelnyy_uchastok',
        ));
        $arResult['ITEMS'][$k]['IS_LOT'] = $sections[$item->get('IBLOCK_SECTION_ID')]['CODE'] == 'zemelnyy_uchastok';
    }
}
$arResult['PREVIEW_PICTURES'] = array();
foreach ($arResult['ITEMS'] as $item){

    $arResult['PREVIEW_PICTURES'][$item['ID']] =\CFile::ResizeImageGet($item['PREVIEW_PICTURE'], array('width'=>540, 'height'=>330), BX_RESIZE_IMAGE_EXACT, true);
}