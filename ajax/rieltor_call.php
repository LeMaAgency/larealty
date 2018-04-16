<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use \Lema\Common\Helper;

//Is POST data sent ?
empty($_POST) && exit;

//set rules & fields for form
$form = new \Lema\Forms\AjaxForm(array(
        array('phone', 'required', array('message' => 'Телефон обязателен к заполнению')),
        array('phone', 'phone', array('message' => 'Телефон должен быть в формате +7 (999) 666-33-11')),
        //array('element_id', 'required', array('message' => 'Не указан элемент')),
        //array('agreement', 'required', array('message' => 'Вы не согласились с условиями')),
    ),
    $_POST
);

//check form fields
if($form->validate())
{
    /**
     * @TODO make handler
     */
    echo json_encode($status ? array('success' => true) : array('errors' => $form->getErrors()));
}
else
    echo json_encode(array('errors' => $form->getErrors()));