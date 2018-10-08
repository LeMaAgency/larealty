<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

$arResult['ORDERED_ITEMS'] = array();

$arResult['HAS_EXPANDED'] = false;

/**
 * Sort props as specified
 */
if(!empty($arResult['ITEMS']) && !empty($arParams['FILTER_ORDER']))
{
    /**
     * Resort items by type
     */
    $items = array(
        'props' => array(),
        'fields' => array(),
        'hidden' => array(),
        'other' => array(),
    );
    foreach($arResult["ITEMS"] as $arItem)
    {
        if(isset($arItem['CODE']))
            $items['props'][$arItem['CODE']] = $arItem;
        elseif(array_key_exists('HIDDEN', $arItem))
            $items['hidden'][] = $arItem;
        elseif(!empty($arItem['INPUT_NAME']))
            $items['fields'][$arItem['INPUT_NAME']] = $arItem;
        else
            $items['other'][] = $arItem;
    }


    foreach($arParams['FILTER_ORDER'] as $itemData)
    {
        $item = null;
        switch($itemData['type'])
        {
            case 'property':
                if(!empty($items['props'][$itemData['key']]))
                    $item = $items['props'][$itemData['key']];
            break;
            case 'field':
                if(!empty($items['fields']['arrFilter_ff[' . $itemData['key'] . ']']))
                    $item = $items['fields']['arrFilter_ff[' . $itemData['key'] . ']'];
            break;
            default:
                if(!empty($items['other'][$itemData['key']]))
                    $item = $items['other'][$itemData['key']];
            break;
        }

        /**
         * Is this item for expanded search ?
         */
        $item['EXPANDED'] = (bool) $itemData['expanded'];

        /**
         * Is filter has expanded search ?
         */
        if(!$arResult['HAS_EXPANDED'] && $item['EXPANDED'])
            $arResult['HAS_EXPANDED'] = true;

        /**
         * Add non-empty items to filter
         */
        if(!empty($item))
            $arResult['ORDERED_ITEMS'][] = $item;
    }

    /**
     * Add hidden items to filter
     */
    foreach($items['hidden'] as $item)
        $arResult['ORDERED_ITEMS'][] = $item;
}
else
    $arResult['ORDERED_ITEMS'] = $arResult['ITEMS'];