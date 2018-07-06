<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use \Lema\Common\Helper;

//Is POST data sent ?
empty($_POST) && exit;

//set rules & fields for form
$form = new \Lema\Forms\AjaxForm(array(
    array('NAME', 'required', array('message' => 'Имя обязательно к заполнению')),
    array('PATRONUMIC', 'required', array('message' => 'Отчество обязательно к заполнению')),
    array('SURNAME', 'required', array('message' => 'Фамилия обязательна к заполнению')),
    array('date', 'required', array('message' => 'Дата рождения обязателена к заполнению')),
    array('PHONE', 'required', array('message' => 'Телефон обязателен к заполнению')),
    array('PHONE', 'phone', array('message' => 'Телефон должен быть в формате +7 (999) 666-33-11')),
    array('EMAIL', 'required', array('message' => 'Email обязателен к заполнению')),
    array('EMAIL', 'email', array('message' => 'Неверный формат E-mail')),
    array('EDUCATION_LEVEL', 'required', array('message' => 'Уровень образования обязателен к заполнению')),
    array('MARITAL_STATUS', 'required', array('message' => 'Семейное положение обязательно к заполнению')),
    array('MARRIAGE_CONTRACT', 'required', array('message' => 'Брачный договор обязателен к заполнению')),
    array('QUANTITY_MINOR_CHILDREN', 'required', array('message' => 'Количество детей обязательно к заполнению')),
    array('REGION', 'required', array('message' => 'Область/Край обязателны к заполнению')),
    array('CITY', 'required', array('message' => 'Город/Поселок обязательны к заполнению')),
    array('STATUS_HOUSING', 'required', array('message' => 'Статус жилья обязателен к заполнению')),
    array('EMPLOYMENT_TYPE', 'required', array('message' => 'Тип занятости обязателен к заполнению')),
    array('TYPE_LABOR_CONTRACT', 'required', array('message' => 'Тип трудового договора обязателен к заполнению')),
    array('EXPERIENCE_CURRENT_WORK', 'required', array('message' => 'Стаж на текущем месте работы обязателен к заполнению')),
    array('EXPERIENCE_TOTAL', 'required', array('message' => 'Общий трудовой стаж обязателен к заполнению')),
    array('SALARY_PROJECT_BANK', 'required', array('message' => 'Зарплатный проект банка обязателен к заполнению')),
    array('BASIC_SALARY', 'required', array('message' => 'Основная заработная плата обязателена к заполнению')),
    array('ADDITIONAL_INCOME', 'required', array('message' => 'Дополнительные доходы обязательны к заполнению')),
    array('FAMILY_INCOME', 'required', array('message' => 'Доход семьи обязателен к заполнению')),
    array('METHOD_INCOME_CONFIRMATION', 'required', array('message' => 'Способ подтверждения дохода обязателен к заполнению')),
    array('PROGRAM_CREDIT', 'required', array('message' => 'Программа кредитования обязателена к заполнению')),
    array('REQUESTED_AMOUNT', 'required', array('message' => 'Запрашиваемая сумма обязателена к заполнению')),
    array('CREDIT_TERM', 'required', array('message' => 'Срок кредита обязателен к заполнению')),
    array('PRICE_REAL_ESTATE_OBJECT', 'required', array('message' => 'Стоимость объекта недвижимости обязателена к заполнению')),
    array('AMOUNT_INITIAL_CONTRIBUTION', 'required', array('message' => 'Сумма первоначального взноса обязателена к заполнению')),
    /*array('file', 'required', array('message' => 'Документ обязателен к заполнению')),*/
    //array('agreement', 'required', array('message' => 'Вы не согласились с условиями')),
),
    $_POST
);

//check form fields
if($form->validate())
{
    $user = \CUser::GetID();

    $status = $form->formActionFull(
        LIblock::getId('hypothec'),
        array(
            'NAME' => $form->getField('SURNAME').' '.$form->getField('NAME').' '.$form->getField('PATRONUMIC'),
            'PROPERTY_VALUES' => array(
                'USER' => $user,
                'SURNAME' => $form->getField('SURNAME'),
                'NAME' => $form->getField('NAME'),
                'PATRONUMIC' => $form->getField('PATRONUMIC'),
                'DATE_BIRTH' => $form->getField('date'),
                'PHONE' => $form->getField('PHONE'),
                'EMAIL' => $form->getField('EMAIL'),
                'EDUCATION_LEVEL' => $form->getField('EDUCATION_LEVEL'),
                'MARITAL_STATUS' => $form->getField('MARITAL_STATUS'),
                'MARRIAGE_CONTRACT' => $form->getField('MARRIAGE_CONTRACT'),
                'QUANTITY_MINOR_CHILDREN' => $form->getField('QUANTITY_MINOR_CHILDREN'),
                'REGION' => $form->getField('REGION'),
                'CITY' => $form->getField('CITY'),
                'STATUS_HOUSING' => $form->getField('STATUS_HOUSING'),
                'EMPLOYMENT_TYPE' => $form->getField('EMPLOYMENT_TYPE'),
                'TYPE_LABOR_CONTRACT' => $form->getField('TYPE_LABOR_CONTRACT'),
                'EXPERIENCE_CURRENT_WORK' => $form->getField('EXPERIENCE_CURRENT_WORK'),
                'EXPERIENCE_TOTAL' => $form->getField('EXPERIENCE_TOTAL'),
                'SALARY_PROJECT_BANK' => $form->getField('SALARY_PROJECT_BANK'),
                'BASIC_SALARY' => $form->getField('BASIC_SALARY'),
                'ADDITIONAL_INCOME' => $form->getField('ADDITIONAL_INCOME'),
                'FAMILY_INCOME' => $form->getField('FAMILY_INCOME'),
                'METHOD_INCOME_CONFIRMATION' => $form->getField('METHOD_INCOME_CONFIRMATION'),
                'PROGRAM_CREDIT' => $form->getField('PROGRAM_CREDIT'),
                'REQUESTED_AMOUNT' => $form->getField('REQUESTED_AMOUNT'),
                'CREDIT_TERM' => $form->getField('CREDIT_TERM'),
                'PRICE_REAL_ESTATE_OBJECT' => $form->getField('PRICE_REAL_ESTATE_OBJECT'),
                'AMOUNT_INITIAL_CONTRIBUTION' => $form->getField('AMOUNT_INITIAL_CONTRIBUTION'),
                'DOWNLOAD_DOCUMENT' => $form->getField('file')
            ),
        ),
        "",
        array()
    );

    echo json_encode($status ? array('success' => true) : array('errors' => $form->getErrors()));
}
else
    echo json_encode(array('errors' => $form->getErrors()));
