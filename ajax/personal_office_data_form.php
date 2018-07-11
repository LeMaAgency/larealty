<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use \Lema\Common\Helper,
    \Lema\Common\User;

//Is POST data sent ?
empty($_POST) && exit;

$arrFields = $errors = array();

if (isset($_POST['FORM_DATA'])) {

    if (!empty($_POST['PERSONAL_BIRTHDAY'])) {
        $_POST['PERSONAL_BIRTHDAY'] = date("d.m.Y", strtotime($_POST['PERSONAL_BIRTHDAY']));
    }
    //Array for checking individual fields for validity
    $rulesData = array();

    //Array of adding fields to the user data
    $realtyTypesRules = array(
        'NAME',
        'SECOND_NAME',
        'LAST_NAME',
        'PERSONAL_GENDER',
        'PERSONAL_BIRTHDAY',
        'WORK_CITY'
    );

} elseif (isset($_POST['FORM_PHONE'])) {

    //Array for checking individual fields for validity
    $rulesData = array();

    //Array of adding fields to the user data
    $realtyTypesRules = array(
        'WORK_PHONE'
    );

} elseif (isset($_POST['FORM_EMAIL'])) {
    //Array for checking individual fields for validity
    $rulesData = array(
        array('EMAIL', 'required', array('message' => 'Email обязателен к заполнению')),
        array('EMAIL', 'email', array('message' => 'Неверный формат E-mail')),
    );
    //Array of adding fields to the user data
    $realtyTypesRules = array(
        'EMAIL'
    );
} elseif (isset($_POST['FORM_PASS'])) {

    //Array for checking individual fields for validity
    $rulesData = array(
        array('PASSWORD', 'required', array('message' => 'Старый пароль обязателен к заполнению')),
        array('PASSWORD', 'regex', array('pattern' => '~^[-\\w\\d]{6,}$~', 'message' => 'Старый пароль неверного формата')),
        array('NEW_PASS', 'required', array('message' => 'Новый пароль обязателен к заполнению')),
        array('NEW_PASS', 'regex', array('pattern' => '~^[-\\w\\d]{6,}$~', 'message' => 'Новый пароль неверного формата')),
        array('NEW_PASS_REPEAT', 'required', array('message' => 'Повторный ввод нового пароля обязателен')),
    );

    //Array of adding fields to the user data
    $realtyTypesRules = array('PASSWORD');
    if ($_POST['NEW_PASS'] !== $_POST['NEW_PASS_REPEAT']) {
        $errors['NEW_PASS_REPEAT'] = "Пароли не соответствуют";
    }
}else{
    $errors['ERROR'] = "Ошибка обработки формы";
}

//set rules & fields for form
$form = new \Lema\Forms\AjaxForm($rulesData, $_POST);

foreach ($realtyTypesRules as $field) {
    $arrFields[$field] = $form->getField($field);
}

$status = empty($errors);
//check form fields
if ($form->validate()) {
    if ($status) {
        \Bitrix\Main\Loader::includeModule('iblock');
        $user = new \CUser();

        $status = $user->Update(User::get()->GetId(), $arrFields);
    }
    echo json_encode($status ? array('success' => true) : array('errors' => $form->getErrors()));
} else
    echo json_encode(array('errors' => $form->getErrors()));