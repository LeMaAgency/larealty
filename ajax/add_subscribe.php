<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use \Lema\Common\Helper;

//Is POST data sent ?
empty($_POST) && exit;

var_dump($_POST['URL']);
exit;
//set rules & fields for form
$form = new \Lema\Forms\AjaxForm(array(
    array('EMAIL', 'required', array('message' => 'Email обязателен к заполнению')),
    array('EMAIL', 'email', array('message' => 'Email неверного формата')),
),
    $_POST
);
//check form fields
if($form->validate())
{

    $status = $form->formActionFull(
        LIblock::getId('object_call_wait'),
        array(
            'NAME' => $form->getField('phone'),
            'PROPERTY_VALUES' => array(
                'OBJECT' => $form->getField('element_id'),
            ),
        ),
        'SUBSCRIBE',
        array(
            '#PHONE#' => $form->getField('phone'),
            '#OBJECT#' => $form->getField('element_name'),
            '#OBJECT_ID#' => $form->getField('element_id'),
        )
    );

    echo json_encode($status ? array('success' => true) : array('errors' => $form->getErrors()));
}
else
    echo json_encode(array('errors' => $form->getErrors()));
