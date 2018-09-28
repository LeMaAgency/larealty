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
    array('agreement', 'required', array('message' => 'Вы не согласились с условиями')),
),
    $_POST
);

//check form fields
if($form->validate())
{

    $res = \CUser::GetById($form->getField('realtor_id'));
    $realtorEmail = ($row = $res->Fetch()) ? $row['EMAIL'] : false;

    $status = $form->formActionFull(
        LIblock::getId('object_call_wait'),
        array(
            'NAME' => $form->getField('name'),
            'PROPERTY_VALUES' => array(
                'PHONE'=>$form->getField('phone'),
                'RIELTOR' => $form->getField('realtor_id'),
            ),
        ),
        'REALTOR_CALL_WAIT',
        array(
            'NAME' => $form->getField('name'),
            'PHONE' => $form->getField('phone'),
            'EMAIL_TO' => $realtorEmail,
        )
    );

    echo json_encode($status ? array('success' => true) : array('errors' => $form->getErrors()));
}
else
    echo json_encode(array('errors' => $form->getErrors()));
