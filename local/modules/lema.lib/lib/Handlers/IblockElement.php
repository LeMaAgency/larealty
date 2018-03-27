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

    }

    /**
     * @param array $fields
     */
    public static function beforeUpdate(array &$fields)
    {
        static::generateElementCode($fields);
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

    protected static function generateElementCode(array &$fields)
    {
        if(isset($fields['IBLOCK_ID']) && $fields['IBLOCK_ID'] === \LIblock::getId('objects'))
        {
            $squareId = \LIblock::getPropId('objects', 'SQUARE');

            if(empty($fields['PROPERTY_VALUES'][$squareId]))
                $square = 0;
            else
            {
                $tmp = current($fields['PROPERTY_VALUES'][$squareId]);
                $square = empty($tmp) || empty($tmp['VALUE']) ? 0 : $tmp['VALUE'];
            }

            $id = empty($fields['ID']) ? 0 : $fields['ID'];
            $fields['CODE'] = \CUtil::translit($fields['NAME'] . '_' . $square . '_m_2_' . $id, 'ru');
        }
    }
}