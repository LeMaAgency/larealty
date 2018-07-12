<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use \Lema\Common\User;

//Is POST data sent ?
empty($_POST) && exit;

$realtyTypesRules = $rulesData = $arrFields = $errors = array();

if (isset($_POST['FORM_DATA'])) {

    if (!empty($_POST['PERSONAL_BIRTHDAY'])) {
        $_POST['PERSONAL_BIRTHDAY'] = date("d.m.Y", strtotime($_POST['PERSONAL_BIRTHDAY']));
    }
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
    $rulesData = array_merge($rulesData, array(
        array('WORK_PHONE', 'phone', array('message' => 'Телефон должен быть в формате +7 (999) 666-33-11')),
    ));
    //Array of adding fields to the user data
    $realtyTypesRules = array(
        'WORK_PHONE'
    );

} elseif (isset($_POST['FORM_EMAIL'])) {
    //Array for checking individual fields for validity
    $rulesData = array_merge($rulesData, array(
        array('EMAIL', 'required', array('message' => 'Email обязателен к заполнению')),
        array('EMAIL', 'email', array('message' => 'Неверный формат E-mail')),
    ));
    //Array of adding fields to the user data
    $realtyTypesRules = array(
        'EMAIL'
    );
} elseif (isset($_POST['FORM_PASS'])) {

    //Array for checking individual fields for validity
    $rulesData = array_merge($rulesData, array(
        array('OLD_PASSWORD', 'required', array('message' => 'Старый пароль обязателен к заполнению')),
        array('OLD_PASSWORD', 'regex', array('pattern' => '~^[-\\w\\d]{6,}$~', 'message' => 'Старый пароль неверного формата')),
        array('PASSWORD', 'required', array('message' => 'Новый пароль обязателен к заполнению')),
        array('PASSWORD', 'regex', array('pattern' => '~^[-\\w\\d]{6,}$~', 'message' => 'Новый пароль неверного формата')),
        array('CONFIRM_PASSWORD', 'required', array('message' => 'Повторный ввод нового пароля обязателен')),
    ));

    //Checking the old password
    $user = \CUser::GetID();
    $password = $_POST['OLD_PASSWORD'];
    $userData = CUser::GetByID($user)->Fetch();
    $salt = substr($userData['PASSWORD'], 0, (strlen($userData['PASSWORD']) - 32));
    $realPassword = substr($userData['PASSWORD'], -32);
    $password = md5($salt . $password);
    if ($password != $realPassword) {
        $errors['OLD_PASSWORD'] = "Старый пароль введён неверно";
    }

    if ($_POST['PASSWORD'] !== $_POST['CONFIRM_PASSWORD']) {
        $errors['CONFIRM_PASSWORD'] = "Пароли не соответствуют";
    }

    //Array of adding fields to the user data
    $realtyTypesRules = array(
        'PASSWORD',
        'CONFIRM_PASSWORD',
    );
} else {
    $errors['ERROR'] = "Ошибка обработки формы";
}

$status = empty($errors);
//set rules & fields for form
$form = new \Lema\Forms\AjaxForm($rulesData, $_POST);

foreach ($realtyTypesRules as $field) {
    $arrFields[$field] = $form->getField($field);
}
//check form fields
if ($form->validate()) {
    if ($status) {
        \Bitrix\Main\Loader::includeModule('iblock');
        $user = new \CUser();

        $status = $user->Update(User::get()->GetId(), $arrFields);
    }
    if($status){
        $user = \CUser::GetID();
        $userData = CUser::GetByID($user)->Fetch();

        $status = $form->sendMessage('PERSONAL_OFFICE_FORM', array(
            'LAST_NAME' => $userData['LAST_NAME'],
            'NAME' => $userData['NAME'],
            'SECOND_NAME' => $userData['SECOND_NAME'],
            'DATE' => date("m.d.y"),
            'TIME' => date("H:i:s"),
            'MAIL_TO' => $userData['EMAIL'],
        ));
    }
    echo json_encode($status ? array('success' => true) : array('errors' => array_merge($errors, $form->getErrors())));
} else
    echo json_encode(array('errors' => array_merge($errors, $form->getErrors())));