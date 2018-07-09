<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use \Lema\Common\Helper;

//Is POST data sent ?
empty($_POST) && exit;

$arrObjectValidate = array(
    array('REALTY_TYPE', 'required', array('message' => 'Тип недвижимости обязателен к заполнению')),
    array('SQUARE', 'required', array('message' => 'Общая площадь обязательна к заполнению')),
    array('SQUARE', 'numerical', array('message' => 'Общая площадь должна быть числом')),
    array('CITY', 'required', array('message' => 'Город обязателен к заполнению')),
    array('STREET', 'required', array('message' => 'Улица обязательна к заполнению')),
    array('PRICE', 'required', array('message' => 'Стоимость обязательна к заполнению')),
    array('PRICE', 'numerical', array('message' => 'Стоимость должна быть числом')),

);

$rulesData = array(
    'HOUSE_NUMBER' => array(
        array('HOUSE_NUMBER', 'required', array('message' => 'Номер дома обязателен к заполнению')),
        array('HOUSE_NUMBER', 'numerical', array('message' => 'Номер дома должна быть числом')),
    ),
    'ROOMS_COUNT' => array(
        array('ROOMS_COUNT', 'required', array('message' => 'Кол-во комнат обязательно к заполнению')),
        array('ROOMS_COUNT', 'numerical', array('message' => 'Кол-во комнат должно быть числом')),
    ),
    'STAGE' => array(
        array('STAGE', 'required', array('message' => 'Этаж обязателен к заполнению')),
        array('STAGE', 'numerical', array('message' => 'Этаж должен быть числом')),
    ),
);
$realtyTypesRules = array(
    1   => array('HOUSE_NUMBER', 'ROOMS_COUNT', 'STAGE'),
    2   => array('HOUSE_NUMBER', 'ROOMS_COUNT', 'STAGE'),
    3   => array('HOUSE_NUMBER', 'ROOMS_COUNT'),
    4   => array('HOUSE_NUMBER', 'ROOMS_COUNT', 'STAGE'),
    49  => array('HOUSE_NUMBER', 'STAGE'),
    50  => array('HOUSE_NUMBER', 'STAGE'),
    51  => array('HOUSE_NUMBER'),
    152 => array('HOUSE_NUMBER', 'ROOMS_COUNT'),
);

$fields = array();
if(isset($_POST['REALTY_TYPE'], $realtyTypesRules[$_POST['REALTY_TYPE']]))
{
    foreach($realtyTypesRules[$_POST['REALTY_TYPE']] as $field)
    {
        if(isset($realtyData[$field]))
            $arrObjectValidate = array_merge($arrObjectValidate, $rulesData[$field]);
    }
    $fields = $realtyTypesRules[$_POST['REALTY_TYPE']];
}
else
{
    //Unknown realty type!
}
/**
 * Switch теперь не нужен вообще. Оставляю его на всякий
 */
switch ($_POST['REALTY_TYPE']):
    case 1:
        $arrObjectValidate = array_merge($arrObjectValidate, array(
            array('HOUSE_NUMBER', 'required', array('message' => 'Номер дома обязателен к заполнению')),
            array('HOUSE_NUMBER', 'numerical', array('message' => 'Номер дома должна быть числом')),
            array('ROOMS_COUNT', 'required', array('message' => 'Кол-во комнат обязательно к заполнению')),
            array('ROOMS_COUNT', 'numerical', array('message' => 'Кол-во комнат должно быть числом')),
            array('STAGE', 'required', array('message' => 'Этаж обязателен к заполнению')),
            array('STAGE', 'numerical', array('message' => 'Этаж должен быть числом')),
        ));
        $arrObjectAddRecord = array_merge($arrObjectAddRecord, array(
            'HOUSE_NUMBER' => $form->getField('HOUSE_NUMBER'),
            'ROOMS_COUNT' => $form->getField('ROOMS_COUNT'),
            'STAGE' => $form->getField('STAGE'),
        ));
        $fields = array('HOUSE_NUMBER', 'ROOMS_COUNT', 'STAGE');
        break;
    case 2:
        $arrObjectValidate = array_merge($arrObjectValidate, array(
            array('HOUSE_NUMBER', 'required', array('message' => 'Номер дома обязателен к заполнению')),
            array('HOUSE_NUMBER', 'numerical', array('message' => 'Номер дома должна быть числом')),
            array('ROOMS_COUNT', 'required', array('message' => 'Кол-во комнат обязательно к заполнению')),
            array('ROOMS_COUNT', 'numerical', array('message' => 'Кол-во комнат должно быть числом')),
            array('STAGE', 'required', array('message' => 'Этаж обязателен к заполнению')),
            array('STAGE', 'numerical', array('message' => 'Этаж должен быть числом')),
        ));
        $arrObjectAddRecord = array_merge($arrObjectAddRecord, array(
            'HOUSE_NUMBER' => $form->getField('HOUSE_NUMBER'),
            'ROOMS_COUNT' => $form->getField('ROOMS_COUNT'),
            'STAGE' => $form->getField('STAGE'),
        ));
        $fields = array('HOUSE_NUMBER', 'ROOMS_COUNT', 'STAGE');
        break;
    case 3:
        $arrObjectValidate = array_merge($arrObjectValidate, array(
            array('HOUSE_NUMBER', 'required', array('message' => 'Номер дома обязателен к заполнению')),
            array('HOUSE_NUMBER', 'numerical', array('message' => 'Номер дома должна быть числом')),
            array('ROOMS_COUNT', 'required', array('message' => 'Кол-во комнат обязательно к заполнению')),
            array('ROOMS_COUNT', 'numerical', array('message' => 'Кол-во комнат должно быть числом')),
        ));
        $arrObjectAddRecord = array_merge($arrObjectAddRecord, array(
            'HOUSE_NUMBER' => $form->getField('HOUSE_NUMBER'),
            'ROOMS_COUNT' => $form->getField('ROOMS_COUNT'),
        ));
        $fields = array('HOUSE_NUMBER', 'ROOMS_COUNT');
        break;
    case 4:
        $arrObjectValidate = array_merge($arrObjectValidate, array());
        $arrObjectAddRecord = array_merge($arrObjectAddRecord, array());
        $fields = array('HOUSE_NUMBER', 'ROOMS_COUNT', 'STAGE');
        break;
    case 49:
        $arrObjectValidate = array_merge($arrObjectValidate, array(
            array('HOUSE_NUMBER', 'required', array('message' => 'Номер дома обязателен к заполнению')),
            array('HOUSE_NUMBER', 'numerical', array('message' => 'Номер дома должна быть числом')),
            array('STAGE', 'required', array('message' => 'Этаж обязателен к заполнению')),
            array('STAGE', 'numerical', array('message' => 'Этаж должен быть числом')),
        ));
        $arrObjectAddRecord = array_merge($arrObjectAddRecord, array(
            'HOUSE_NUMBER' => $form->getField('HOUSE_NUMBER'),
            'STAGE' => $form->getField('STAGE'),
        ));
        $fields = array('HOUSE_NUMBER', 'STAGE');
        break;
    case 50:
        $arrObjectValidate = array_merge($arrObjectValidate, array(
            array('HOUSE_NUMBER', 'required', array('message' => 'Номер дома обязателен к заполнению')),
            array('HOUSE_NUMBER', 'numerical', array('message' => 'Номер дома должна быть числом')),
            array('STAGE', 'required', array('message' => 'Этаж обязателен к заполнению')),
            array('STAGE', 'numerical', array('message' => 'Этаж должен быть числом')),
        ));
        $arrObjectAddRecord = array_merge($arrObjectAddRecord, array(
            'HOUSE_NUMBER' => $form->getField('HOUSE_NUMBER'),
            'STAGE' => $form->getField('STAGE'),
        ));
        $fields = array('HOUSE_NUMBER', 'STAGE');
        break;
    case 51:
        $arrObjectValidate = array_merge($arrObjectValidate, array(
            array('HOUSE_NUMBER', 'required', array('message' => 'Номер дома обязателен к заполнению')),
            array('HOUSE_NUMBER', 'numerical', array('message' => 'Номер дома должна быть числом')),
        ));
        $arrObjectAddRecord = array_merge($arrObjectAddRecord, array(
            'HOUSE_NUMBER' => $form->getField('HOUSE_NUMBER'),
        ));
        $fields = array('HOUSE_NUMBER');
        break;
    case 152:
        $arrObjectValidate = array_merge($arrObjectValidate, array(
            array('HOUSE_NUMBER', 'required', array('message' => 'Номер дома обязателен к заполнению')),
            array('HOUSE_NUMBER', 'numerical', array('message' => 'Номер дома должна быть числом')),
            array('ROOMS_COUNT', 'required', array('message' => 'Кол-во комнат обязательно к заполнению')),
            array('ROOMS_COUNT', 'numerical', array('message' => 'Кол-во комнат должно быть числом')),
        ));
        $arrObjectAddRecord = array_merge($arrObjectAddRecord, array(
            'HOUSE_NUMBER' => $form->getField('HOUSE_NUMBER'),
            'ROOMS_COUNT' => $form->getField('ROOMS_COUNT'),
        ));
        $fields = array('HOUSE_NUMBER', 'ROOMS_COUNT');
        break;
endswitch;

//set rules & fields for form
$form = new \Lema\Forms\AjaxForm($arrObjectValidate, $_POST);

$arrObjectAddRecord = array(
    'REALTY_TYPE' => array('VALUE' => $form->getField('REALTY_TYPE')),
    'SQUARE' => $form->getField('SQUARE'),
    'CITY' => $form->getField('CITY'),
    'STREET' => $form->getField('STREET'),
    'PRICE' => $form->getField('PRICE'),
);
foreach($fields as $field)
    $arrObjectAddRecord[$field] = $form->getField($field);

//check form fields
if ($form->validate()) {
        $elementId = $form->addRecord(
            \LIblock::getId('objects'),
            array(
                'NAME' => $form->getField('REALTY_TYPE'),
                'PROPERTY_VALUES' => $arrObjectAddRecord,
                'ACTIVE' => 'N',
            ));
        $status = (bool)$elementId;
        $requestEditLink = null;
        $requestEditLink = Helper::getFullUrl(
            '/bitrix/admin/iblock_element_edit.php?IBLOCK_ID='
            . \LIblock::getId('objects')
            . '&type=realty&ID='
            . $elementId
            . '&lang=ru&find_section_section=-1'
        );
        //send message
        $status = $form->sendMessage('FEEDBACK', array(
            'REALTY_TYPE' => $form->getField('REALTY_TYPE'),
            'REQUEST_EDIT_LINK' => $requestEditLink,
        ));

    echo json_encode($status ? array('success' => true) : array('errors' => array_merge($errors, $form->getErrors())));
} else
    echo json_encode(array('errors' => array_merge($errors, $form->getErrors())));
