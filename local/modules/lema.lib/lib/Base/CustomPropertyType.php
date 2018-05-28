<?php

namespace Lema\Base;


class CustomPropertyType extends StaticInstance
{
    protected $userTypeDescription = array (
        'PROPERTY_TYPE' => 'E',
        'USER_TYPE' => 'custom',
        'DESCRIPTION' => 'Custom property type',
        'GetPropertyFieldHtml' => array('CustomPropertyType', 'GetPropertyFieldHtml'),
        'ConvertToDB' => array('CustomPropertyType', 'ConvertToDB'),
        'ConvertFromDB' => array('CustomPropertyType', 'ConvertToDB'),
    );

    /**
     * CustomPropertyType constructor.
     */
    public function __construct()
    {
        $curClassName = get_class($this);
        foreach(array('GetPropertyFieldHtml', 'ConvertToDB', 'ConvertFromDB') as $key)
            $this->userTypeDescription[$key] = array($curClassName, $key);
    }

    /**
     * @return array
     */
    public function GetUserTypeDescription()
    {
        return $this->userTypeDescription;
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
        /**
         * Example
         */
        /*
        $rsSkills = CIBlockElement::GetList(array("SORT" => "ASC"), array(
                "IBLOCK_ID" => 1,
                "ACTIVE" => "Y",
            ), false, false, array("ID", "NAME"));

        $html = '<select name="' . $strHTMLControlName["VALUE"] . '">';
        $html .= '<option value="">(выберите квалификацию)</option>';
        while($arSkill = $rsSkills->GetNext())
        {
            $html .= '<option value="' . $arSkill["ID"] . '"';
            if($arSkill["ID"] == $value["VALUE"])
            {
                $html .= 'selected="selected"';
            }
            $html .= '>' . $arSkill["NAME"] . '</option>';
        }
        $html .= '</select>';
        echo $html;*/
    }

    /**
     * Save to DB
     *
     * @param $arProperty
     * @param $value
     *
     * @return mixed
     */
    public function ConvertToDB($arProperty, $value)
    {
        return $value;
    }

    /**
     * Get from DB
     *
     * @param $arProperty
     * @param $value
     *
     * @return mixed
     */
    public function ConvertFromDB($arProperty, $value)
    {
        return $value;
    }

    /**
     * @return array
     */
    public static function staticCall()
    {
        return static::get()->GetUserTypeDescription();
    }
}