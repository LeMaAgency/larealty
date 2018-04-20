<?php

namespace Lema\Handlers;

use \Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Type\DateTime;
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
        static::setReminders($fields);
    }

    /**
     * @param array $fields
     */
    public static function beforeUpdate(array &$fields)
    {
        static::generateElementNameAndCode($fields);
        static::setElementRights($fields);
        static::setReminders($fields);
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
        static::generateElementNameAndCode($fields);
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
    protected static function generateElementNameAndCode(array &$fields)
    {
        //check iblock number
        if(isset($fields['IBLOCK_ID']) && $fields['IBLOCK_ID'] === \LIblock::getId('objects') && !empty($fields['PROPERTY_VALUES']))
        {
            //get square property value
            $square = static::getPropValue($fields, 'SQUARE');
            //get realty property value
            $realty = static::getPropValue($fields, 'REALTY_TYPE');

            //set name from choosen property value
            foreach(\LIblock::getPropEnumValues(\LIblock::getPropId('objects', 'REALTY_TYPE')) as $propData)
            {
                if($propData['ID'] == $realty)
                {
                    $fields['NAME'] = $propData['VALUE'];
                    break;
                }
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
        if(isset($fields['IBLOCK_ID']) && $fields['IBLOCK_ID'] === \LIblock::getId('objects') && !empty($fields['PROPERTY_VALUES']))
        {
            /**
             * Administrator can change rieltor for object
             */
            if(\Lema\Common\User::isAdmin())
            {

                //get rieltor property value
                $rieltorId = static::getPropValue($fields, 'RIELTOR', 0);

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
            else
            {
                /**
                 * New object, set special section to it and clear access rights
                 */
                if(empty($fields['ID']))
                {
                    $fields['IBLOCK_SECTION'] = array(23);
                    $fields['ACTIVE'] = 'Y';
                    $fields['RIGHTS'] = array();
                }
                else
                {
                    $fields['RIGHTS'] = array(
                        'n0' => array(
                            'GROUP_CODE' => 'U' . \Lema\Common\User::get()->GetId(),
                            'DO_CLEAN' => 'N',
                            'TASK_ID' => 38
                        )
                    );
                }
            }

        }
    }

    /**
     * @param array $fields
     *
     * @return bool
     */
    protected static function setReminders(array $fields)
    {
        if(empty($fields['ID']))
            return false;

        if(isset($fields['IBLOCK_ID']) && $fields['IBLOCK_ID'] === \LIblock::getId('objects') && !empty($fields['PROPERTY_VALUES']))
        {
            //get remind date property value
            $remindDate = static::getPropValue($fields, 'REMINDER_DATE', null);

            //get rieltor property value
            $rieltor = static::getPropValue($fields, 'RIELTOR', false);


            $agentName = '\\' . get_class() . '::remind(' . $fields['ID'] . ');';

            $remindTimeStamp = strtotime($remindDate == date('d.m.Y') ? '+1 hour' : $remindDate);

            $remindDate = date('d.m.Y H:i:s', $remindTimeStamp);

            //search existing agent
            $res = \CAgent::GetList(array('ID' => 'DESC'), array('NAME' => $agentName));
            if($row = $res->Fetch())
            {
                \CAgent::Update($row['ID'], array(
                    'NAME' => $agentName,
                    'USER_ID' => $rieltor,
                    'NEXT_EXEC' => $remindDate,
                    'ACTIVE' => 'Y'
                ));
            }

            //Agent is not exists, create it now
            \CAgent::AddAgent(
                $agentName,
                '',
                'N',
                60,
                $remindDate,
                'Y',
                $remindDate,
                30,
                $rieltor
            );
        }
    }

    /**
     * @param $objectId
     *
     * @return string
     */
    public static function remind($objectId)
    {
        $agentName = '\\' . get_class() . '::remind(' . $objectId . ');';

        if(!\CModule::includeModule('iblock'))
            return $agentName;

        $res = \CIBlockElement::GetList(
                array(),
                array('IBLOCK_ID' => \LIblock::getId('objects'), '=ID' => $objectId),
                false,
                false,
                array('NAME', 'PROPERTY_RIELTOR', 'PROPERTY_REMINDER_TEXT')
        );
        if(!($row = $res->Fetch()))
            return $agentName;

        /**
         * This variables are used in modal template and should be defined
         */
        $objectName = $row['NAME'];
        $text = $row['PROPERTY_REMINDER_TEXT_VALUE'];
        if(!empty($text['TEXT']))
            $text = $text['TEXT'];

        /**
         * include modal template
         */
        require_once $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/include/modal_agent_template.php';

        $res = \CAgent::GetList(array('ID' => 'DESC'), array('NAME' => $agentName));
        if($row = $res->Fetch())
            \CAgent::Delete($row['ID']);

        exit;
    }

    protected static function getPropValue(array $fields = array(), $propCode, $defValue = 0, $iblockCode = 'objects')
    {
        //get property id
        $propId = \LIblock::getPropId($iblockCode, $propCode);

        //get property value
        if(empty($fields['PROPERTY_VALUES'][$propId]))
        {
            return $defValue;
        }
        else
        {
            $tmp = current($fields['PROPERTY_VALUES'][$propId]);
            return empty($tmp) || empty($tmp['VALUE']) ? $defValue : $tmp['VALUE'];
        }
    }
}