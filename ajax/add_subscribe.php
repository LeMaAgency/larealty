<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use \Lema\Common\Helper,
    \Bitrix\Highloadblock as HL,
    \Bitrix\Main\Entity;


//Is POST data sent ?
empty($_POST) && exit;
$arProps = $arExtProps = $errors = array();
$expandedFields = array(
    'STAGE',
    'STAGES_COUNT',
    'LOT_HAVINGS_TYPE',
    'LOT_CATEGORIES',
    'HEATING',
    'WATER_SUPPLY',
    'SEWERAGE',
    'ELECTRIC',
);
//set rules & fields for form
$form = new \Lema\Forms\AjaxForm(array(
    array('email', 'required', array('message' => 'Email обязателен к заполнению')),
    array('email', 'email', array('message' => 'Email неверного формата')),
),
    $_POST
);

foreach ($_POST as $keyArray => $arProp) {
    foreach ($arProp as $keyProp => $prop) {
        if (!empty($prop)) {
            if (in_array($keyProp, $expandedFields)) {
                $arExtProps[$keyProp] = $prop;
            } else {
                $arProps[$keyProp] = $prop;
            }
        }
    }
}
ksort($arProps);

//check form fields
if ($form->validate()) {
    if (CModule::IncludeModule("highloadblock")) {
        $hlblock = HL\HighloadBlockTable::getById(6)->fetch();
        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();
        $result = $entity_data_class::add(
            array(
                'UF_USER_ID' => $USER->GetID(),
                'UF_FILTER_PARAMS' => json_encode($arProps),
                'UF_FREQUENCY_SEND' => '60',
                'UF_ENABLE_SEND' => 'Y',
                'UF_LINK' => $_SERVER['HTTP_REFERER'],
                'UF_EXT_FILTER_PARAMS' => json_encode($arExtProps),
                'UF_EMAIL' => $form->getField('email'),
            )
        );
        $status = (bool)$result->getId();
        if (!$status) {
            $errors['add'] = "Ошибка при добавлении элемента";
        }
    }
    echo json_encode($status ? array('success' => true) : array('errors' => array_merge($errors, $form->getErrors())));
} else
    echo json_encode(array('errors' => array_merge($errors, $form->getErrors())));
