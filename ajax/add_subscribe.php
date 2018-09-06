<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use \Bitrix\Highloadblock as HL;

//Is POST data sent ?
empty($_POST) && exit;
$status = false;
$arProps = $arExtProps = $errors = $arTempSubscriptionTitle['PARAMS'] = $arTempSubscriptionTitle['EXT_PARAMS'] = array();
$expandedFields = array(
    'STAGE',
    'STAGES_COUNT',
    'LOT_HAVINGS_TYPE',
    'LOT_CATEGORIES',
    'HEATING',
    'WATER_SUPPLY',
    'SEWERAGE',
    'ELECTRIC',
);
//set rules & fields for form
$form = new \Lema\Forms\AjaxForm(
    array(
        array('email_subscription', 'required', array('message' => 'Email обязателен к заполнению')),
        array('email_subscription', 'email', array('message' => 'Email неверного формата')),
    ),
    $_POST
);

foreach ($_POST as $keyArray => $arProp) {
    foreach ($arProp as $keyProp => $prop) {
        if (!empty($prop)) {
            if (in_array($keyProp, $expandedFields)) {
                $arExtProps[$keyProp] = $prop;
            } else {
                $arProps[$keyProp] = $prop;
            }
        }
    }
}
if (explode('/', $_SERVER['HTTP_REFERER'])[3] == 'rent') {
    $arProps['RENT_TYPE'] = '29';
} else {
    $arProps['RENT_TYPE'] = '30';
}
ksort($arProps);


//check form fields
if ($form->validate()) {
    if (CModule::IncludeModule("iblock")) {
        $arSubscriptionParams['UF_FILTER_PARAMS'] = $arProps;
        $arSubscriptionParams['UF_EXT_FILTER_PARAMS'] = $arExtProps;
        $arTitle = array(
            'ID' => 'объект №',
            'RENT_TYPE' => array(
                29 => 'снять',
                30 => 'купить',
            ),
            'ROOMS_COUNT' => '-комнатные',
            'PRICE' => 'цена',
            'PRICE_UNIT' => 'руб.',
            'REGION' => 'месторасположение',
            'SQUARE_LAND' => 'площадь участка',
            'SQUARE' => 'площадь',
            'SQUARE_UNIT' => 'м²',
            'SQUARE_LAND_UNIT' => 'м²',
            'STAGE' => 'этаж',
            'STAGES_COUNT' => 'этажей в доме',
            'LOT_HAVINGS_TYPE' => 'тип собственности',
            'LOT_CATEGORIES' => 'категория земель',
            'HEATING' => 'отопление',
            'WATER_SUPPLY' => 'водоснабжение',
            'SEWERAGE' => 'канализация',
            'ELECTRIC' => 'электроснабжение',
            'LEFT' => 'от',
            'RIGHT' => 'до',
        );
        $arTitleRealtyType = array(
            'kvartiry' => 'квартиру',
            'komnaty' => 'комнату',
            'doma' => 'дом',
            'dachi' => 'дачу',
            'zemelnyy_uchastok' => 'земельный участок',
            'ofisy' => 'офис',
            'torgovye_ploshchadi' => 'торговую площадь',
            'zdaniya' => 'здание',
        );
        //Добавление типа объекта в заголовок
        if (isset($arSubscriptionParams['UF_FILTER_PARAMS']['REALTY_TYPE'], $arSubscriptionParams['UF_FILTER_PARAMS']['RENT_TYPE'])) {
            if (isset($arTitleRealtyType[$arSubscriptionParams['UF_FILTER_PARAMS']['REALTY_TYPE']])) {
                $addTitle .= $arTitle['RENT_TYPE'][$arSubscriptionParams['UF_FILTER_PARAMS']['RENT_TYPE']] . ' ' . $arTitleRealtyType[$arSubscriptionParams['UF_FILTER_PARAMS']['REALTY_TYPE']];
            }
            unset($arSubscriptionParams['UF_FILTER_PARAMS']['REALTY_TYPE']);
            unset($arSubscriptionParams['UF_FILTER_PARAMS']['RENT_TYPE']);
        }
        if (isset($arSubscriptionParams['UF_FILTER_PARAMS']['ID'])) {
            if (isset($arTitle['ID'])) {
                $addTitle .= !empty($addTitle) ? ', ' : '';
                $addTitle .= $arTitle['ID'] . ' ' . $arSubscriptionParams['UF_FILTER_PARAMS']['ID'];
            }
            unset($arSubscriptionParams['UF_FILTER_PARAMS']['ID']);
        }
        if (isset($arSubscriptionParams['UF_FILTER_PARAMS']['ROOMS_COUNT'])) {
            if (isset($arTitle['ROOMS_COUNT'])) {
                foreach ($arSubscriptionParams['UF_FILTER_PARAMS']['ROOMS_COUNT']['LEFT'] as $room) {
                    $addTitle .= !empty($addTitle) ? ', ' : '';
                    $addTitle .= $room . $arTitle['ROOMS_COUNT'];
                }
            }
            unset($arSubscriptionParams['UF_FILTER_PARAMS']['ID']);
        }
        //Цикл по параметрам фильтра
        foreach ($arSubscriptionParams as $keyParam => $itemParam) {
            $title = '';
            //Цикл по типам параметра фильтра (Основные и Доп. свойства)
            foreach ($itemParam as $keyParamValue => $itemTypeParamValue) {
                if (is_array($itemTypeParamValue) && ($itemTypeParamValue['RIGHT'] > 0)) {
                    $title .= !empty($title) ? ', ' . $arTitle[$keyParamValue] : $arTitle[$keyParamValue];
                    $title .= (!empty($itemTypeParamValue['LEFT']) && $itemTypeParamValue['LEFT'] > 0) ? ' ' . $arTitle['LEFT'] . ' ' . +$itemTypeParamValue['LEFT'] : '';
                    $title .= (!empty($itemTypeParamValue['RIGHT'])) ? ' ' . $arTitle['RIGHT'] . ' ' . +$itemTypeParamValue['RIGHT'] : '';
                    $title .= ' ' . $arTitle[$keyParamValue . '_UNIT'];
                } else {
                    if (is_numeric($itemTypeParamValue)) {
                        $rowItem = CIBlockPropertyEnum::GetByID((int)$itemTypeParamValue);
                        $title .= !empty($title) ? ', ' : '';
                        $title .= $rowItem['VALUE'] ? $arTitle[$keyParamValue] . ' ' . $rowItem['VALUE'] : '';
                    }
                }
            }
            //Запись заголовка в элемент
            if ($keyParam == 'UF_FILTER_PARAMS') {
                $arTempSubscriptionTitle['PARAMS'] = !empty($title) ? $addTitle . ', ' . $title : $addTitle;
            } else {
                $arTempSubscriptionTitle['EXT_PARAMS'] = !empty($title) ? $title : '';
            }
        }
    }
    if (!empty($arTempSubscriptionTitle['PARAMS']) || !empty($arTempSubscriptionTitle['EXT_PARAMS'])) {
        $status = true;
    } else {
        $errors['EMPTY_TITLE'] = "Заголовок не смог сформироваться";
    }
    if ($status && \CModule::IncludeModule("highloadblock")) {
        $hlblock = HL\HighloadBlockTable::getById(6)->fetch();
        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();
        $result = $entity_data_class::add(
            array(
                'UF_USER_ID' => $USER->GetID(),
                'UF_FILTER_PARAMS' => json_encode($arProps),
                'UF_FREQUENCY_SEND' => '0',
                'UF_LINK' => $_SERVER['HTTP_REFERER'],
                'UF_EXT_FILTER_PARAMS' => json_encode($arExtProps),
                'UF_EMAIL' => $form->getField('email_subscription'),
                'UF_TITLE' => $arTempSubscriptionTitle['PARAMS'],
                'UF_EXT_TITLE' => $arTempSubscriptionTitle['EXT_PARAMS'],
            )
        );
        $status = (bool)$result->getId();
        if (!$status) {
            $errors['add'] = "Ошибка при добавлении элемента";
        }
    }
    echo json_encode($status ? array('success' => true) : array('errors' => array_merge($errors, $form->getErrors())));
} else
    echo json_encode(array('errors' => array_merge($errors, $form->getErrors())));
