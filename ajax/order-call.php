<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use \Lema\Common\Helper;

//Is POST data sent ?
empty($_POST) && exit;

//set rules & fields for form
$form = new \Lema\Forms\AjaxForm(
    array(
        array('name', 'required', array('message' => 'Имя обязательно к заполнению')),
        array('phone', 'required', array('message' => 'Телефон обязателен к заполнению')),
        array('phone', 'phone', array('message' => 'Телефон должен быть в формате +7 (999) 666-33-11')),
    ),
    $_POST
);

//check form fields
if ($form->validate()) {
    $status = $form->formActionFull(
        \LIblock::getId('order_call'),
        array(
            'NAME' => $form->getField('name'),
            'PROPERTY_VALUES' => array(
                'PHONE' => $form->getField('phone'),
            ),
        ),
        'ORDER_CALL_NEW',
        array(
            'NAME' => $form->getField('name'),
            'PHONE' => $form->getField('phone'),
        )
    );

    echo json_encode($status ? array('success' => true) : array('errors' => $form->getErrors()));
} else
    echo json_encode(array('errors' => $form->getErrors()));

