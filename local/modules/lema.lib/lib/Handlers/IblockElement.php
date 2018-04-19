<?php

namespace Lema\Handlers;

use \Bitrix\Main\Localization\Loc;
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
            //get square property id
            $squareId = \LIblock::getPropId('objects', 'SQUARE');
            //get realty property id
            $realtyId = \LIblock::getPropId('objects', 'REALTY_TYPE');

            if(empty($squareId) || empty($realtyId))
                return ;

            //get square property value
            if(empty($fields['PROPERTY_VALUES'][$squareId]))
                $square = 0;
            else
            {
                $tmp = current($fields['PROPERTY_VALUES'][$squareId]);
                $square = empty($tmp) || empty($tmp['VALUE']) ? 0 : $tmp['VALUE'];
            }

            //get realty property value
            if(empty($fields['PROPERTY_VALUES'][$realtyId]))
                $realty = 0;
            else
            {
                $tmp = current($fields['PROPERTY_VALUES'][$realtyId]);
                $realty = empty($tmp) || empty($tmp['VALUE']) ? 0 : $tmp['VALUE'];
            }

            //set name from choosen property value
            foreach(\LIblock::getPropEnumValues($realtyId) as $propData)
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
            //get realty property id
            $remindDateId = \LIblock::getPropId('objects', 'REMINDER_DATE');
            //get realty property value
            if(empty($fields['PROPERTY_VALUES'][$remindDateId]))
                $remindDate = 0;
            else
            {
                $tmp = current($fields['PROPERTY_VALUES'][$remindDateId]);
                $remindDate = empty($tmp) || empty($tmp['VALUE']) ? 0 : $tmp['VALUE'];
            }
            $agentName = '\\' . get_class() . '::remind(' . $fields['ID'] . ', ';


            if($remindDate == date('d.m.Y'))
            {
                $remindTimeStamp = strtotime('+1 hour');
                $remindDate = date('d.m.Y', $remindTimeStamp);
            }
            else
            {
                $remindTimeStamp = strtotime($remindDate);
            }

            //search existing agent
            $res = \CAgent::GetList(array('ID' => 'DESC'), array('NAME' => $agentName . '%'));
            if($row = $res->Fetch())
            {
                \CAgent::Update($row['ID'], array(
                    $agentName . '"' . $remindDate . '");',
                    '',
                    'N',
                    86400,
                    date('d.m.Y H:i:s', $remindTimeStamp),
                    'Y',
                    date('d.m.Y H:i:s', $remindTimeStamp),
                    30
                ));
            }

            //Agent is not exists, create it now
            \CAgent::AddAgent(
                $agentName . '"' . $remindDate . '");',
                '',
                'N',
                86400,
                date('d.m.Y H:i:s', $remindTimeStamp),
                'Y',
                date('d.m.Y H:i:s', $remindTimeStamp),
                30
            );
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
            //get rieltor property id
            $rieltorPropId = \LIblock::getPropId('objects', 'RIELTOR');

            /**
             * Administrator can change rieltor for object
             */
            if(\Lema\Common\User::isAdmin())
            {
                //get rieltor property value
                if(empty($fields['PROPERTY_VALUES'][$rieltorPropId]))
                {
                    $rieltorId = 0;
                }
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

    public static function remind($objectId, $date)
    {
        ?>
        <script>
            alert('OBJECT REMIND, ID: <?=$objectId;?>, DATE: <?=$date;?>');
        </script>
        <?exit;
    }
}