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
    /*array('email', 'required', array('message' => 'Email обязателен к заполнению')),
    array('email', 'email', array('message' => 'Email неверного формата')),*/
),
    $_POST
);


//проверка количества файлов
if(count($_FILES['files']['name']) > 10)
{
    echo json_encode(array('max_files'=>'max files count 10'));
    die();
}
//Валидация файлов
if(!empty($_FILES['files']['name'][0])){
    $types = '(?:jpe?g|png|doc?x)';
    $fileErrors = array();
    foreach ($_FILES['files']['name'] as $key=>$name)
    {
        if(!preg_match('~\\.' . $types . '$~iu', $name))
            $fileErrors['incorrect_files'][] = $name;
    }
//если есть файл с неправильным форматом, прерываем скрипт
    if($fileErrors)
    {
        echo json_encode($fileErrors);
        die();
    }
//Импорт файлов из временной папки php
    $picturesData = uploadFileData($_FILES['files']);
}




//check form fields
if($form->validate()){
    if (CModule::IncludeModule("iblock")){
        $ib_list = \CIBlock::GetList(Array(), Array("CODE" => 'zayavki','CHECK_PERMISSIONS'=>'N'));
        while($ar_res = $ib_list->Fetch())
            $iblockId = $ar_res['ID'];
    }
    $status = $form->formActionFull(
        $iblockId,
        array(
            'NAME' => $form->getField('name'),
            'PREVIEW_TEXT' => $form->getField('comment'),
            'PREVIEW_PICTURE'=> $_FILES['file'],
            'PROPERTY_VALUES' => array(
                'PHONE'=>$form->getField('phone'),
                'EMAIL' => $form->getField('email'),
                'FILES' => $picturesData['fileData']
            ),
        ),
        'FORM_ZAYAVKA',
        array(
            'NAME' => $form->getField('name'),
            'PHONE' => $form->getField('phone'),
            //'EMAIL' => $form->getField('email'),
            'COMMENT' => $form->getField('comment'),
        )
    );

    echo json_encode($status ? array('success' => true) : array('errors' => $form->getErrors()));
}
else
    echo json_encode(array('errors' => $form->getErrors()));

