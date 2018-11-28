<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use \Lema\Subscribe\Subscribe;

//Is POST data sent ?
empty($_POST) && exit;

//set rules & fields for form
$form = new \Lema\Forms\AjaxForm(array(
    array('sf_EMAIL', 'required', array('message' => 'E-mail обязателен к заполнению')),
    array('sf_EMAIL', 'email', array('message' => 'Неверный формат E-mail')),
),
    $_POST
);

$errors = array();

//check form fields
if($form->validate())
{

    if(Subscribe::hasSubscribe($form->getField('sf_EMAIL')))
    {
        $errors['sf_EMAIL'] = 'Вы уже подписались на рассылку';
        $status = false;
    }
    else
    {
        $status = Subscribe::addSubscribe($form->getField('sf_EMAIL'));
    }

    echo json_encode($status ? array('success' => true) : array('errors' => array_merge($errors, $form->getErrors())));
}
else
    echo json_encode(array('errors' => array_merge($errors, $form->getErrors())));

