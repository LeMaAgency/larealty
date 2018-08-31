<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Highloadblock as HL;

$arResult = array();
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
        $arResult[] = $row;
    }
}
if (!empty($arResult)) {
    if (CModule::IncludeModule("iblock")) {
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
    }

    $arTitle = array(
        'REALTY_TYPE' => 'купить',
        'ROOMS_COUNT' => '- комнатные',
        'PRICE' => 'цена',
        'REGION' => 'месторасположение',
        'ID' => 'объект №',
        'SQUARE_LAND' => 'площадь участка',
        'SQUARE' => 'площадь',
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
    foreach ($arResult as $keyItem => $item) {
        $title = '';
        $arFilterParams = json_decode($item['UF_FILTER_PARAMS'], true);
        if (isset($arFilterParams['REALTY_TYPE'])) {
            if (isset($arSect[$arFilterParams['REALTY_TYPE']])) {
                $title .= $arTitle['REALTY_TYPE'] . ' ' . $arSect[$arFilterParams['REALTY_TYPE']];
            }
            unset($arFilterParams['REALTY_TYPE']);
        }

        foreach ($arFilterParams as $key => $itemValue) {
            if (is_array($itemValue)) {

            } else {
                if (is_numeric($itemValue)) {
                    $rowItem = CIBlockPropertyEnum::GetByID((int)$itemValue);
                    $title .= $rowItem['VALUE'] ? ', ' . $arTitle[$key] . ' ' . $rowItem['VALUE'] : '';
                }
            }
        }
            var_dump($title);
        $arResult[$keyItem]['TITLE'] = $title;
    }
}