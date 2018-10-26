<?php

namespace Lema\IBlock;

use Bitrix\Iblock\ElementTable;

\Bitrix\Main\Loader::includeModule('iblock');

/**
 * Class Element
 * @package Lema\IBlock
 */
class Element
{
    const CLASS_NAME = '\\Bitrix\\IBlock\\ElementTable';
    const OLD_CLASS_NAME = '\\CIBlockElement';

    /**
     * @param $name
     * @param $arguments
     * @return bool
     *
     * @access public
     */
    public static function __callStatic($name, $arguments)
    {
        if(method_exists(static::CLASS_NAME, $name))
            return call_user_func_array(array(static::CLASS_NAME, $name), $arguments);
        return false;
    }

    /**
     * Get element by id
     *
     * @param $elementId
     * @param array $params
     * @return mixed
     *
     * @access public
     */
    public static function getByIdD7($elementId, array $params = array())
    {
        return \Bitrix\Iblock\ElementTable::getByPrimary($elementId, $params)->fetch();
    }

    /**
     * Get element by id
     *
     * @param $elementId
     * @param array $params
     * @return mixed
     *
     * @access public
     */
    public static function getById($iblockId, $elementId, array $params = array())
    {
        $params['filter']['ID'] = (int) $elementId;
        return current(static::getAll($iblockId, $params));
    }

    /**
     * Get array of products (with D7)
     *
     * @param $iblockId
     * @param array $params
     * @return array
     *
     * @access public
     */
    public static function getListD7($iblockId, array $params = array())
    {
        $params['filter']['IBLOCK_ID'] = $iblockId;
        $params['filter']['ACTIVE'] = 'Y';
        $className = static::CLASS_NAME;
        $res = $className::getList($params);
        $ret = array();
        while($row = $res->fetch())
            $ret[$row['ID']] = $row;
        return $ret;
    }

    /**
     * Get array of products (without D7)
     *
     * @param $iblockId
     * @param array $params
     * @return array
     *
     * @access public
     */
    public static function getList($iblockId, array $params = array())
    {
        $arOrder            = static::getData($params, 'order',             array('SORT' => 'ASC'));
        $arFilter           = static::getData($params, 'filter',            array('IBLOCK_ID' => $iblockId, 'ACTIVE' => 'Y'));
        $arGroupBy          = static::getData($params, 'bIncCnt',           false);
        $arNavStartParams   = static::getData($params, 'arNavStartParams',  false);
        $arSelect           = static::getData($params, 'arSelect',          array());

        if(empty($arFilter['IBLOCK_ID']))
            $arFilter['IBLOCK_ID'] = $iblockId;

        $ret = array();
        $className = static::OLD_CLASS_NAME;
        $res = $className::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelect);
        while($row = $res->GetNext())
            $ret[$row['ID']] = $row;

        return $ret;
    }

    /**
     * Get count of products
     *
     * @param $iblockId
     * @param array $params
     * @return mixed
     *
     * @access public
     */
    public static function getCount($iblockId, array $params = array())
    {
        $params['IBLOCK_ID'] = $iblockId;
        $className = static::CLASS_NAME;
        return $className::getCount($params);
    }

    /**
     * Get array of products with pagination
     *
     * @param $iblockId
     * @param array $params
     * @return array
     *
     * @access public
     */
    public static function getListPagination($iblockId, array $params = array())
    {
        $arOrder            = static::getData($params, 'order',             array('SORT' => 'ASC'));
        $arFilter           = static::getData($params, 'filter',            array('IBLOCK_ID' => $iblockId, 'ACTIVE' => 'Y'));
        $arGroupBy          = static::getData($params, 'bIncCnt',           false);
        $arNavStartParams   = static::getData($params, 'arNavStartParams',  false);
        $arSelect           = static::getData($params, 'arSelect',          array());

        $ret = array();
        $className = static::OLD_CLASS_NAME;
        $res = $className::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelect);
        $res->NavStart($arNavStartParams['nPageSize']);
        while($row = $res->NavNext(true))
            $ret[$row['ID']] = $row;

        //$ret['navPrint'] = $res->NavPrint($params['navPrintTitle']);

        return $ret;
    }

    /**
     * Returns array of products (with D7)
     *
     * @param $iblockId
     * @param array $params
     * @return array
     *
     * @access public
     */
    public static function getAllD7($iblockId, array $params = array())
    {
        $params['filter']['IBLOCK_ID'] = $iblockId;
        $className = static::CLASS_NAME;
        $res = $className::getList($params);
        $ret = array();
        while($row = $res->fetch())
            $ret[$row['ID']] = $row;
        return $ret;
    }

    /**
     * Returns array of products (without D7)
     *
     * @param $iblockId
     * @param array $params
     * @param bool $pagination
     * @return array
     *
     * @access public
     */
    public static function getAll($iblockId, array $params = array(), $pagination = false)
    {
        $params['filter']['IBLOCK_ID'] = $iblockId;
        return $pagination ? static::getListPagination($iblockId, $params) : static::getList($iblockId, $params);
    }

    /**
     * @param array $params
     * @param $key
     * @param null $defValue
     * @return mixed|null
     *
     * @access protected
     */
    protected static function getData(array $params = array(), $key, $defValue = null)
    {
        return isset($params[$key]) ? $params[$key] : $defValue;
    }

    /**
     * @param $iblockId
     * @param array $data
     * @return int
     * @throws \Exception
     */
    public static function addElement($iblockId, array $data = array())
    {
        $el = new \CIBlockElement();

        $data['IBLOCK_ID'] = $iblockId;
        if(!($elementId = $el->Add($data)))
            throw new \Exception($el->LAST_ERROR);
        return $elementId;
    }
    /**
     * @param $iblockId
     * @param array $data
     * @return int
     * @throws \Exception
     */
    public static function addOrUpdateElement($iblockId, array $data = array())
    {
        if(empty($data['XML_ID']))
            throw new \Exception('XML_ID must be specified.');

        $el = new \CIBlockElement;

        if(!empty($data['PROPERTY_VALUES']['MORE_PHOTO']))
        {
            $images = $data['PROPERTY_VALUES']['MORE_PHOTO'];
            //$data['PROPERTY_VALUES']['MORE_PHOTO'] = ['VALUE' => ['del' => 'Y']];
            $data['PROPERTY_VALUES']['MORE_PHOTO'] = [];
        }

        $res = ElementTable::getList(array(
            'filter' => array('IBLOCK_ID' => $iblockId, 'XML_ID' => $data['XML_ID']),
            'select' => array('ID'),
            'limit' => 1,
        ));
        $data['IBLOCK_ID'] = $iblockId;

        if(($row = $res->fetch()))
        {
            $elementId = $row['ID'];
            if(!$el->Update($elementId, $data))
                throw new \Exception($el->LAST_ERROR);
        }
        else
        {
            if(!($elementId = $el->Add($data)))
                throw new \Exception($el->LAST_ERROR);
        }
        if(!empty($images))
            \CIBlockElement::SetPropertyValuesEx($elementId, $iblockId, ['MORE_PHOTO' => $images]);

        return $elementId;
    }
}