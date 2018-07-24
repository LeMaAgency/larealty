<?php

namespace Lema\Basket;

/*
 * include modules
 */
use Lema\IBlock\Element;

\Bitrix\Main\Loader::includeModule('iblock');
\Bitrix\Main\Loader::includeModule('highloadblock');

/**
 * Class BasketPosition
 * @package Lema\Basket
 */
class BasketPosition extends HighloadBlock
{

    /**
     * Returns array of positions with product data from IBLOCK
     *
     * @param array $searchIds
     *
     * @return array
     *
     * @access public
     */
    public function getAllPositions(array $searchIds)
    {
        $dataClass = $this->getEntityDataClass(Settings::POSITIONS_HLBLOCK_ID);

        //get positions
        $res = $dataClass::getList(array(
            'select' => array('*'),
            'filter' => array('ID' => array_map('intval', $searchIds)),
        ));
        $return = $products = array();
        while($row = $res->fetch())
        {
            //collect product ids for search
            $products[$row['UF_PRODUCT']] = null;
            //collect positions
            $return[$row['ID']] = $row;
        }

        //get product data from IBLOCK
        $res = \CIBlockElement::GetList(
            array(),
            array('IBLOCK_ID' => Settings::PRODUCTS_IBLOCK_ID, 'ACTIVE' => 'Y', 'ID' => array_keys($products)),
            false,
            false,
            array(
                'ID',
                'NAME',
                'IBLOCK_SECTION_ID',
                'PREVIEW_PICTURE',
                'PREVIEW_TEXT',
                'DETAIL_PAGE_URL',
                'PROPERTY_RENT_TYPE',
                'PROPERTY_VALUE_ENUM_ID',
                'PROPERTY_IS_EXCLUSIVE',
                'PROPERTY_PRICE',
                'PROPERTY_ROOMS_COUNT',
                'PROPERTY_IS_HOUSE_OR_LOT',
                'PROPERTY_STAGES_COUNT',
                'PROPERTY_STAGE',
                'PROPERTY_SQUARE',
                'PROPERTY_ADDRESS',
                'PROPERTY_SQUARE_LAND',
                'PROPERTY_ADDRESS',
                'PROPERTY_CITY',
                'PROPERTY_REGION',
                'PROPERTY_STREET',
                'PROPERTY_HOUSE_NUMBER',
            )
        );

        while($row = $res->GetNext())
        {
            $row['PRODUCT_ID'] = $row['ID'];
            unset($row['ID']);
            $products[$row['PRODUCT_ID']] = $row;
        }

        foreach($return as $k => $v)
        {
            //set product data
            if(isset($products[$v['UF_PRODUCT']]))
            {
                $res = \CIBlockElement::GetProperty(Settings::PRODUCTS_IBLOCK_ID, $v['UF_PRODUCT'], array(), array('CODE' => 'HEADER_TEXT'));
                $text = array();
                while($row = $res->fetch())
                    $text[] = $row['VALUE'];

                $product = $products[$v['UF_PRODUCT']];

                $price = (double) $product['PROPERTY_PRICE_VALUE'];
                $sum = (double) $v['UF_QUANTITY'] * $product['PROPERTY_PRICE_VALUE'];
                if(($brand = Element::getById($product['PROPERTY_BRAND_VALUE'], array('select' => array('NAME')))) && isset($brand['NAME']))
                    $brand = $brand['NAME'];
                else
                    $brand = null;
                $return[$k] = array(

                    'ID' => $k,
                    'PRODUCT_ID' => $v['UF_PRODUCT'],
                    'NAME' =>$product['NAME'],
                    'IBLOCK_SECTION_ID' =>$product['IBLOCK_SECTION_ID'],
                    'PREVIEW_PICTURE'=>$product['PREVIEW_PICTURE'],
                    'PREVIEW_TEXT'=>$product['PREVIEW_TEXT'],
                    'DETAIL_PAGE_URL'=>$product['DETAIL_PAGE_URL'],
                    'RENT_TYPE'=>array(
                        'VALUE'=>$product['PROPERTY_RENT_TYPE_VALUE'],
                        'ENUM_ID'=>$product['PROPERTY_RENT_TYPE_ENUM_ID'],
                    ),
                    'IS_EXCLUSIVE'=>$product['PROPERTY_IS_EXCLUSIVE_VALUE'],
                    'ROOMS_COUNT'=>$product['PROPERTY_ROOMS_COUNT_VALUE'],
                    'IS_HOUSE_OR_LOT'=>$product['PROPERTY_IS_HOUSE_OR_LOT_VALUE'],
                    'STAGES_COUNT'=>$product['PROPERTY_STAGES_COUNT_VALUE'],
                    'STAGE'=>$product['PROPERTY_STAGE_VALUE'],
                    'SQUARE'=>$product['PROPERTY_SQUARE_VALUE'],
                    'SQUARE_LAND'=>$product['PROPERTY_SQUARE_LAND_VALUE'],
                    'CITY'=>$product['PROPERTY_CITY_VALUE'],
                    'REGION'=>$product['PROPERTY_REGION_VALUE'],
                    'STREET'=>$product['PROPERTY_STREET_VALUE'],
                    'HOUSE_NUMBER'=>$product['PROPERTY_HOUSE_NUMBER_VALUE'],
                    'PRICE' => $price,
                    'PRICE_FORMATTED' => $this->formatPrice($price),

                );
            }
        }
        return $return;
    }

    /**
     * Returns full data (positions & product data) for basket
     *
     * @param array $data
     *
     * @return array
     *
     * @access public
     */
    public function getBasketPositions(array $data)
    {
        //collect id of positions for search
        $searchIds = array();
        foreach($data as $v)
            $searchIds = array_merge($searchIds, $v['UF_PRODUCT_POSITION']);

        //get product data for collected positions
        $basketPositions = $this->getAllPositions($searchIds);

        //set product data for collected positions
        foreach($data as $k => $v)
        {
            foreach($v['UF_PRODUCT_POSITION'] as $positionId)
            {
                if(isset($basketPositions[$positionId]))
                    $data[$k]['PRODUCTS'][$positionId] = $basketPositions[$positionId];
            }
        }

        return $data;
    }
}