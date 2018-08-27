<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use \Lema\Common\Helper;

//Is POST data sent ?
empty($_POST) && exit;

//set rules & fields for form
$form = new \Lema\Forms\AjaxForm(array(
    array('phone', 'required', array('message' => 'Телефон обязателен к заполнению')),
    array('phone', 'phone', array('message' => 'Телефон должен быть в формате +7 (999) 666-33-11')),
),
    $_POST
);
//check form fields
if($form->validate())
{
    $status = $form->formActionFull(
        LIblock::getId('hypothec_form'),
        array(
            'NAME' => $form->getField('phone'),
        ),
        'HYPOTHEC_FORM',
        array(
            '#PHONE#' => $form->getField('phone'),
            '#EMAIL_TO#' => $form->getField('email'),
        )
    );

    echo json_encode($status ? array('success' => true) : array('errors' => $form->getErrors()));
}
else
    echo json_encode(array('errors' => $form->getErrors()));
