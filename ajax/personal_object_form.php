<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use \Lema\Common\Helper;

//Is POST data sent ?
empty($_POST) && exit;

$errors = array();
//Array to check common fields for validity
$arrObjectValidate = array(
    array('REALTY_TYPE', 'required', array('message' => 'Тип недвижимости обязателен к заполнению')),
    array('SQUARE', 'required', array('message' => 'Общая площадь обязательна к заполнению')),
    array('SQUARE', 'numerical', array('message' => 'Общая площадь должна быть числом')),
    array('CITY', 'required', array('message' => 'Город обязателен к заполнению')),
    array('STREET', 'required', array('message' => 'Улица обязательна к заполнению')),
    array('PRICE', 'required', array('message' => 'Стоимость обязательна к заполнению')),
    array('PRICE', 'numerical', array('message' => 'Стоимость должна быть числом')),

);
//Array for checking individual fields for validity
$rulesData = array(
    'HOUSE_NUMBER' => array(
        array('HOUSE_NUMBER', 'required', array('message' => 'Номер дома обязателен к заполнению')),
        array('HOUSE_NUMBER', 'numerical', array('message' => 'Номер дома должен быть числом')),
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
//Array of adding fields to the information block element
$realtyTypesRules = array(
    41 => array('HOUSE_NUMBER', 'ROOMS_COUNT', 'STAGE'),
    42 => array('HOUSE_NUMBER', 'ROOMS_COUNT', 'STAGE'),
    43 => array('HOUSE_NUMBER', 'ROOMS_COUNT'),
    44 => array(),
    45 => array('HOUSE_NUMBER', 'STAGE'),
    46 => array('HOUSE_NUMBER', 'STAGE'),
    47 => array('HOUSE_NUMBER'),
    48 => array('HOUSE_NUMBER', 'ROOMS_COUNT'),
);

$fields = $folderRealty = array();
if (isset($_POST['REALTY_TYPE'], $realtyTypesRules[$_POST['REALTY_TYPE']])) {
    foreach ($realtyTypesRules[$_POST['REALTY_TYPE']] as $field) {
        if (isset($rulesData[$field]))
            $arrObjectValidate = array_merge($arrObjectValidate, $rulesData[$field]);
    }
    $fields = $realtyTypesRules[$_POST['REALTY_TYPE']];
} else {
    $errors['REALTY_TYPE'] = "Некорректный тип недвижимости";
}
$status = empty($errors);
//set rules & fields for form
$form = new \Lema\Forms\AjaxForm($arrObjectValidate, $_POST);

$arrObjectAddRecord = array(
    'SQUARE' => $form->getField('SQUARE'),
    'CITY' => $form->getField('CITY'),
    'STREET' => $form->getField('STREET'),
    'PRICE' => $form->getField('PRICE'),
);
foreach ($fields as $field)
    $arrObjectAddRecord[$field] = $form->getField($field);

//check form fields
if ($form->validate()) {
    if ($status) {
        $elementId = $form->addRecord(
            \LIblock::getId('objects'),
            array(
                'IBLOCK_SECTION_ID' => $form->getField('REALTY_TYPE'),
                'NAME' => $form->getField('REALTY_TYPE'),
                'PROPERTY_VALUES' => $arrObjectAddRecord,
                'ACTIVE' => 'N',
            ));
        $status = (bool)$elementId;
        $requestEditLink = null;

    }
    if ($status) {
        //Output current user data
        $rsUser = \CUser::GetByID($USER->GetID());
        $arUser = $rsUser->Fetch();

        $requestEditLink = Helper::getFullUrl(
            '/bitrix/admin/iblock_element_edit.php?IBLOCK_ID='
            . \LIblock::getId('objects')
            . '&type=realty&ID='
            . $elementId
            . '&lang=ru&find_section_section='
            . $form->getField('REALTY_TYPE')
        );
        //send message
        $status = $form->sendMessage('PERSONAL_OBJECT_FORM', array(
            'NAME' => $arUser['NAME'],
            'LAST_NAME' => $arUser['LAST_NAME'],
            'SECOND_NAME' => $arUser['SECOND_NAME'],
            'REALTY_TYPE' => $form->getField('REALTY_TYPE_NAME'),
            'REQUEST_EDIT_LINK' => $requestEditLink,
        ));
    }
    echo json_encode($status ? array('success' => true) : array('errors' => array_merge($errors, $form->getErrors())));
} else
    echo json_encode(array('errors' => array_merge($errors, $form->getErrors())));
