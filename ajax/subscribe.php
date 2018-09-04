<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

isset($_GET['action']) && in_array($_GET['action'], array('tumbler', 'delete', 'setting_save')) || exit(json_encode(array('status' => false)));

use \Bitrix\Highloadblock as HL;

$errors = array();
$status = false;

$form = new \Lema\Forms\AjaxForm(
    array(
        array('ID', 'required'),
        array('ID', 'numerical'),
    ),
    $_GET
);
if ($form->validate() && CModule::IncludeModule("highloadblock")) {
    $hlblock = HL\HighloadBlockTable::getById(6)->fetch();
    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();
    $res = $entity_data_class::getById($form->getField('ID'));
    if ($row = $res->fetch()) {
        if ($row['UF_USER_ID'] == \CUser::GetID()) {
            $status = true;
        } else {
            $errors['FOREIGN_ELEM'] = 'Элемент с таким ID не принадлежит этому пользователю';
        }
    } else {
        $errors['NOT_EXIST'] = 'Не существует элемента с таким идентификатором';
    }
}
if ($status) {
    $status = false;
    switch ($_GET['action']) {
        case 'tumbler':
            $formTumbler = new \Lema\Forms\AjaxForm(
                array(
                    array('STATUS', 'required'),
                ),
                $_GET
            );
            if ($formTumbler->validate()) {
                $status = (bool)$entity_data_class::update(
                    $form->getField('ID'),
                    array(
                        'UF_ENABLE_SEND' => $formTumbler->getField('STATUS')
                    )
                );
            } else {
                $errors = $formTumbler->getErrors();
            }
            break;

        case 'delete':
            $status = (bool)$entity_data_class::delete($form->getField('ID'));
            break;

        case 'setting_save':
            $mailError = false;
            $formFrequencySend = new \Lema\Forms\AjaxForm(
                array(
                    array('EMAIL', 'required'),
                    array('EMAIL', 'email'),
                    array('FREQUENCY', 'required'),
                ),
                $_GET
            );
            if ($formFrequencySend->validate()) {
                $status = (bool)$entity_data_class::update(
                    $form->getField('ID'),
                    array(
                        'UF_EMAIL' => $formFrequencySend->getField('EMAIL'),
                        'UF_FREQUENCY_SEND' => $formFrequencySend->getField('FREQUENCY')
                    )
                );
            } else {
                $errors = $formFrequencySend->getErrors();
            }
            break;
    }
} else {
    $errors = array_merge($errors, $form->getErrors());
}
echo json_encode(
    array(
        'status' => $status,
        'errors' => $errors,
    )
);

exit;