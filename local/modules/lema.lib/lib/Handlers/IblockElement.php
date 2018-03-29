<?php

namespace Lema\Handlers;

use \Bitrix\Main\Localization\Loc;
use Lema\Common\Dumper;

Loc::loadMessages(__FILE__);

/**
 * Class IblockElement
 * @package Lema\Handlers
 */
class IblockElement
{
    /**
     * @param array $fields
     */
    public static function beforeAdd(array &$fields)
    {
        static::setElementRights($fields);
    }

    /**
     * @param array $fields
     */
    public static function beforeUpdate(array &$fields)
    {
        static::generateElementCode($fields);
        static::setElementRights($fields);
    }

    /**
     * @param int $id
     */
    public static function beforeDelete($id)
    {

    }

    /**
     * @param array $fields
     */
    public static function afterAdd(array &$fields)
    {
        static::generateElementCode($fields);
    }

    /**
     * @param array $fields
     */
    public static function afterUpdate(array &$fields)
    {

    }

    /**
     * @param array $fields
     */
    public static function afterDelete(array &$fields)
    {

    }

    /**
     * Generates element code from its name, square and element ID. Only for objects iblock
     *
     * @param array $fields
     */
    protected static function generateElementCode(array &$fields)
    {
        //check iblock number
        if(isset($fields['IBLOCK_ID']) && $fields['IBLOCK_ID'] === \LIblock::getId('objects'))
        {
            //get square property id
            $squareId = \LIblock::getPropId('objects', 'SQUARE');
            //get square property value
            if(empty($fields['PROPERTY_VALUES'][$squareId]))
                $square = 0;
            else
            {
                $tmp = current($fields['PROPERTY_VALUES'][$squareId]);
                $square = empty($tmp) || empty($tmp['VALUE']) ? 0 : $tmp['VALUE'];
            }

            //generate element code for URL
            $id = empty($fields['ID']) ? 0 : $fields['ID'];
            $fields['CODE'] = \CUtil::translit($fields['NAME'] . '_' . $square . '_m_2_' . $id, 'ru');
        }
    }

    /**
     * Set element rights for specified user (or clean it)
     *
     * @param array $fields
     */
    protected static function setElementRights(array &$fields)
    {
        //check iblock number
        if(isset($fields['IBLOCK_ID']) && $fields['IBLOCK_ID'] === \LIblock::getId('objects'))
        {
            //get rieltor property id
            $rieltorPropId = \LIblock::getPropId('objects', 'RIELTOR');
            //get rieltor property value
            if(empty($fields['PROPERTY_VALUES'][$rieltorPropId]))
                $rieltorId = 0;
            else
            {
                $tmp = current($fields['PROPERTY_VALUES'][$rieltorPropId]);
                $rieltorId = empty($tmp) || empty($tmp['VALUE']) ? 0 : (int) $tmp['VALUE'];
            }
            //rieltor not specified, clean rights
            if(empty($rieltorId))
            {
                $fields['RIGHTS'] = array();
            }
            else
            {
                //set rights for specified rieltor
                $fields['RIGHTS'] = array(
                    'n0' => array(
                        'GROUP_CODE' => 'U' . $rieltorId,
                        'DO_CLEAN' => 'N',
                        'TASK_ID' => 38
                    )
                );
            }
        }
    }
}