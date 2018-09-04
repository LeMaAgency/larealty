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
if (!empty($arResult['ITEMS']) && CModule::IncludeModule("iblock")) {
    /*if (CModule::IncludeModule("iblock")) {
        $arSect = $arProp = array();
        $resSect = CIBlockSection::GetList(
            array(),
            array(
                'IBLOCK_ID' => 2,
                'SECTION_ID' => 23,
            ),
            false,
            array(
                'CODE',
                'NAME'
            )
        );
        while ($rowSect = $resSect->Fetch()) {
            $arSect[$rowSect['CODE']] = $rowSect['NAME'];
        }
        $resProp = CIBlockElement::GetProperty(2, false, array("sort" => "asc"));
        while ($rowProp = $resProp->Fetch()) {
        }
    }*/

    $arTitle = array(
        'ID' => 'объект №',
        'REALTY_TYPE' => 'купить',
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
    //Цикл по элементам
    foreach ($arResult['PARAMS'] as $keyItem => $itemParams) {
        $addTitle = '';
        //Добавление типа объекта в заголовок
        if (isset($itemParams['UF_FILTER_PARAMS']['REALTY_TYPE'])) {
            if (isset($arTitleRealtyType[$itemParams['UF_FILTER_PARAMS']['REALTY_TYPE']])) {
                $addTitle .= $arTitle['REALTY_TYPE'] . ' ' . $arTitleRealtyType[$itemParams['UF_FILTER_PARAMS']['REALTY_TYPE']];
            }
            unset($itemParams['UF_FILTER_PARAMS']['REALTY_TYPE']);
        }
        if (isset($itemParams['UF_FILTER_PARAMS']['ID'])) {
            if (isset($arTitle['ID'])) {
                $addTitle .= !empty($addTitle) ? ', ' : '';
                $addTitle .= $arTitle['ID'] . ' ' . $itemParams['UF_FILTER_PARAMS']['ID'];
            }
            unset($itemParams['UF_FILTER_PARAMS']['ID']);
        }
        if (isset($itemParams['UF_FILTER_PARAMS']['ROOMS_COUNT'])) {
            if (isset($arTitle['ROOMS_COUNT'])) {
                foreach ($itemParams['UF_FILTER_PARAMS']['ROOMS_COUNT']['LEFT'] as $room) {
                    $addTitle .= !empty($addTitle) ? ', ' : '';
                    $addTitle .= $room.$arTitle['ROOMS_COUNT'];
                }
            }
            unset($itemParams['UF_FILTER_PARAMS']['ID']);
        }
        //Цикл по параметрам фильтра
        foreach ($itemParams as $keyParam => $itemParam) {
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
                $arResult['ITEMS'][$keyItem][$keyParam . '_TITLE'] = !empty($title) ? $addTitle . ', ' . $title : $addTitle;
            } else {
                $arResult['ITEMS'][$keyItem][$keyParam . '_TITLE'] = !empty($title) ? $title : '';
            }
        }
    }
}