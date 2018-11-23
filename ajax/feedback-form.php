<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use \Lema\Common\Helper;

//Is POST data sent ?
empty($_POST) && exit;

//set rules & fields for form
$form = new \Lema\Forms\AjaxForm(array(
    array('name', 'required', array('message' => 'Имя обязательно к заполнению')),
    array('phone', 'required', array('message' => 'Телефон обязателен к заполнению')),
    array('phone', 'phone', array('message' => 'Телефон должен быть в формате +7 (999) 666-33-11')),
    array('email', 'required', array('message' => 'Email обязателен к заполнению')),
    array('email', 'email', array('message' => 'Email неверного формата')),
),
    $_POST
);

//check form fields
if($form->validate()){

    $status = $form->formActionFull(
        LIblock::getId('feedbaсk_form'),
        array(
            'NAME' => $form->getField('name'),
            'PREVIEW_TEXT' => $form->getField('comment'),
            'PROPERTY_VALUES' => array(
                'PHONE'=>$form->getField('phone'),
                'EMAIL' => $form->getField('email'),
            ),
        ),
        'FEEDBACK_FORM_NEW',
        array(
            'NAME' => $form->getField('name'),
            'PHONE' => $form->getField('phone'),
            'EMAIL' => $form->getField('email'),
            'COMMENT' => $form->getField('comment'),

        )
    );

    echo json_encode($status ? array('success' => true) : array('errors' => $form->getErrors()));
}
else
    echo json_encode(array('errors' => $form->getErrors()));

