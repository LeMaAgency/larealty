<?php

namespace Lema\IBlock;

use \Lema\Base\CustomPropertyType;

class TimePropertyType extends CustomPropertyType
{

    /**
     * CustomPropertyType constructor.
     */
    public function __construct()
    {
        $this->userTypeDescription['USER_TYPE'] = 'time';
        $this->userTypeDescription['DESCRIPTION'] = 'Время';

        return parent::__construct();
    }
    
    /**
     * Build property data array
     *
     * @param $arProperty
     * @param $value
     * @param $strHTMLControlName
     */
    public function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName)
    {
        global $APPLICATION;
        $APPLICATION->IncludeComponent('bitrix:main.clock','',Array(
                'INPUT_ID' => '',
                'INPUT_NAME' => $strHTMLControlName['VALUE'],
                'INPUT_TITLE' => 'Время',
                'INIT_TIME' => (empty($value['VALUE']) ? '00:00' : $value['VALUE']),
                'STEP' => '0'
            )
        );
    }
}