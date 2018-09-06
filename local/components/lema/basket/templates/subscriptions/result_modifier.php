<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Highloadblock as HL;

$arResult['ITEMS'] = $arResult['PARAMS'] = array();
if (CModule::IncludeModule("highloadblock")) {
    $hlblock = HL\HighloadBlockTable::getById(6)->fetch();
    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();
    $res = $entity_data_class::getList(
        array(
            'select' => array(
                'ID',
                'UF_EMAIL',
                'UF_FILTER_PARAMS',
                'UF_EXT_FILTER_PARAMS',
                'UF_LINK',
                'UF_ENABLE_SEND',
                'UF_FREQUENCY_SEND',
                'UF_TITLE',
                'UF_EXT_TITLE',
            ),
            'filter' => array(
                'UF_USER_ID' => $USER->GetID(),
            )
        ));
    while ($row = $res->fetch()) {
        $arResult['ITEMS'][$row['ID']] = $row;
        $arResult['PARAMS'][$row['ID']]['UF_FILTER_PARAMS'] = json_decode($row['UF_FILTER_PARAMS'], true);
        $arResult['PARAMS'][$row['ID']]['UF_EXT_FILTER_PARAMS'] = json_decode($row['UF_EXT_FILTER_PARAMS'], true);
    }
}