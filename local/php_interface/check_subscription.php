<?php
$_SERVER['DOCUMENT_ROOT'] = realpath(dirname(__FILE__).'/../..');

$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

@set_time_limit(0);
@ignore_user_abort(true);

use \Bitrix\Highloadblock as HL;
var_dump($argv);
if(!isset($argv[1])){
    return;
}
/*Входной параметр, для фильтрации по объектам, что были изменены/добавлены
 в указанный период назад от текущего времени
$frequency - это значение свойства "UF_FREQUENCY_SEND" у подписки, каждое
идентифицирует максимальную частоту рассылки 0- это 1 час,1- это 3 часа,..., 4-это 1 день и т.д.
*/
switch ($argv[1]):
    case hour_1:
        $date = new DateTime('-1 hour');
        $frequency = '0';
        break;
    case hour_3:
        $date = new DateTime('-3 hour');
        $frequency = '1';
        break;
    case hour_6:
        $date = new DateTime('-6 hour');
        $frequency = '2';
        break;
    case hour_12:
        $date = new DateTime('-12 hour');
        $frequency = '3';
        break;
    case day_1:
        $date = new DateTime('-1 day');
        $frequency = '4';
        break;
    case day_2:
        $date = new DateTime('-2 day');
        $frequency = '5';
        break;
    case day_3:
        $date = new DateTime('-3 day');
        $frequency = '6';
        break;
endswitch;

if (\CModule::IncludeModule("highloadblock") && \CModule::IncludeModule('iblock')) {
    $arSubscriptions = $arObjFilterParams = array();
    //Имя раздела (типа объекта) => ID раздела
    $arRealtyType = array(
        'kvartiry' => '26',
        'komnaty' => '27',
        'doma' => '28',
        'dachi' => '29',
        'zemelnyy_uchastok' => '30',
        'ofisy' => '31',
        'torgovye_ploshchadi' => '32',
        'zdaniya' => '49',
    );

    $hlblock = HL\HighloadBlockTable::getById(6)->fetch();
    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();
    $resSub = $entity_data_class::getList(
        array(
            'filter' => array(
                'UF_FREQUENCY_SEND' => (int)$frequency,//'0'
                'UF_ENABLE_SEND' => '0', //0 - включена отправка, 1 - отключена P.S. Так вышло =)
            ),
            'select' => array(
                'ID',
                'UF_LINK',
                'UF_EMAIL',
                'UF_FILTER_PARAMS',
                'UF_EXT_FILTER_PARAMS',
                'UF_TITLE',
                'UF_EXT_TITLE'
            )
        )
    );
    /*Забиваем массив подписок, как нам надо и одновременно забиваем массив фильтрации по объектам
     по общим для всех свойствам, скажем PRICE, RENT_TYPE, для уменьшения количества вывода объектов*/
    while ($rowSub = $resSub->fetch()) {
        $tempRowSub = array();
        $tempRowSub['ID'] = $rowSub['ID'];
        $tempRowSub['TITLE'] = $rowSub['UF_TITLE'];
        $tempRowSub['EXT_TITLE'] = $rowSub['UF_EXT_TITLE'];
        $tempRowSub['LINK'] = $rowSub['UF_LINK'];
        $tempRowSub['EMAIL'] = $rowSub['UF_EMAIL'];
        $tempRowSub['TEMP_FILTER_PARAM'] = array_merge(json_decode($rowSub['UF_FILTER_PARAMS'], true), json_decode($rowSub['UF_EXT_FILTER_PARAMS'], true));
        if (!empty($tempRowSub['TEMP_FILTER_PARAM']['ID'])) {
            $tempRowSub['OBJECT_ID'] = $tempRowSub['TEMP_FILTER_PARAM']['ID'];
            unset($tempRowSub['TEMP_FILTER_PARAM']['ID']);
        };
        if (!empty($tempRowSub['TEMP_FILTER_PARAM']['REALTY_TYPE'])) {
            $tempRowSub['REALTY_TYPE'] = $arRealtyType[$tempRowSub['TEMP_FILTER_PARAM']['REALTY_TYPE']];
            $arObjFilterParams['SECTION_CODE'][$tempRowSub['TEMP_FILTER_PARAM']['REALTY_TYPE']] = $tempRowSub['TEMP_FILTER_PARAM']['REALTY_TYPE'];
            unset($tempRowSub['TEMP_FILTER_PARAM']['REALTY_TYPE']);
        }

        if (!empty($tempRowSub['TEMP_FILTER_PARAM']['ROOMS_COUNT'])) {
            $tempRowSub['ROOMS_COUNT'] = $tempRowSub['TEMP_FILTER_PARAM']['ROOMS_COUNT'];
            unset($tempRowSub['TEMP_FILTER_PARAM']['ROOMS_COUNT']);
        };
        foreach ($tempRowSub['TEMP_FILTER_PARAM'] as $keyParam => $param) {
            if (is_array($param)) {
                if (!empty($param['LEFT'])) {
                    $tempRowSub['FILTER_PARAM'][$keyParam]['LEFT'] = $param['LEFT'];
                    if ($keyParam == 'PRICE' && (!isset($arObjFilterParams['>=PROPERTY_PRICE']) || $arObjFilterParams['>=PROPERTY_PRICE'] > $param['LEFT'])) {
                        $arObjFilterParams['>=PROPERTY_PRICE'] = $param['LEFT'];
                    }
                }
                if (!empty($param['RIGHT'])) {
                    $tempRowSub['FILTER_PARAM'][$keyParam]['RIGHT'] = $param['RIGHT'];
                    if ($keyParam == 'PRICE' && (!isset($arObjFilterParams['<=PROPERTY_PRICE']) || $arObjFilterParams['<=PROPERTY_PRICE'] > $param['RIGHT'])) {
                        $arObjFilterParams['<=PROPERTY_PRICE'] = $param['RIGHT'];
                    }
                }
            } else {
                $tempRowSub['FILTER_LIST_PARAM'][$keyParam] = $param;
            }
        }
        unset($tempRowSub['TEMP_FILTER_PARAM']);
        $arSubscriptions[$rowSub['ID']] = $tempRowSub;
    }
}


if ($arSubscriptions) {
    $arSubscriptionsSend = array();
    $arFilter = array_merge(
        array(
            'IBLOCK_ID' => 2,
            'ACTIVE' => 'Y',
            'DATE_MODIFY_FROM' => $date->format('d.m.Y H:i:s'),
        ),
        $arObjFilterParams
    );

    $resObj = \CIBlockElement::GetList(
        array(),
        $arFilter,
        false,
        false,
        array(
            'ID',
            'IBLOCK_SECTION_ID',
            'PROPERTY_RENT_TYPE',
            'PROPERTY_ROOMS_COUNT',
            'PROPERTY_PRICE',
            'PROPERTY_REGION',
            'PROPERTY_SQUARE_LAND',
            'PROPERTY_SQUARE',
            'PROPERTY_STAGE',
            'PROPERTY_STAGES_COUNT',
            'PROPERTY_LOT_HAVINGS_TYPE',
            'PROPERTY_LOT_CATEGORIES',
            'PROPERTY_HEATING',
            'PROPERTY_WATER_SUPPLY',
            'PROPERTY_SEWERAGE',
            'PROPERTY_ELECTRIC',
        )
    );
    /* Проверяем подходит ли текущий объект под какую-нибудь из подписок, если объект не подходит хотябы
       под один из параметров, то переходим к следующей подписке */
    while ($rowObj = $resObj->fetch()) {
        foreach ($arSubscriptions as $subscription) {
            if (isset($subscription['REALTY_TYPE'])) {
                if ($subscription['REALTY_TYPE'] != $rowObj['IBLOCK_SECTION_ID']) {
                    continue;
                }
            }

            if (isset($subscription['OBJECT_ID'])) {
                if ($subscription['OBJECT_ID'] != $rowObj['ID']) {
                    continue;
                }
            }
            if (isset($subscription['FILTER_LIST_PARAM'])) {
                foreach ($subscription['FILTER_LIST_PARAM'] as $keyListParam => $listParam) {
                    if ($listParam != $rowObj['PROPERTY_' . $keyListParam . '_ENUM_ID']) {
                        continue(2);
                    }
                }
            }
            if (isset($subscription['FILTER_PARAM'])) {
                foreach ($subscription['FILTER_PARAM'] as $keyParam => $param) {
                    if (!($rowObj['PROPERTY_' . $keyParam . '_VALUE'] >= (int)$param['LEFT'] && $rowObj['PROPERTY_' . $keyParam . '_VALUE'] <= (int)$param['RIGHT'])) {
                        continue(2);
                    }
                }
            }

            if (isset($subscription['ROOMS_COUNT'])) {
                foreach ($subscription['ROOMS_COUNT'] as $room) {
                    if ($room == '4x') {
                        if ($rowObj['PROPERTY_ROOMS_COUNT_VALUE'] < 4) {
                            continue(2);
                        }
                    } else {
                        if ($rowObj['PROPERTY_ROOMS_COUNT_VALUE'] != $room) {
                            continue(2);
                        }
                    }
                }
            }
            //Подсчёт количества объектов найдённых по подписке
            $arSubscriptionsSend[$subscription['ID']]++;

        }
    }
    foreach ($arSubscriptionsSend as $key => $subscriptionSend){
        \CEvent::Send(
            'SUBSCTIPTION_MESSAGE',
            's1',
            array(
                "TITLE" => $arSubscriptions[$key]['TITLE'],
                "EXT_TITLE" => $arSubscriptions[$key]['EXT_TITLE'],
                "LINK" => $arSubscriptions[$key]['LINK'],
                "QUANTITY" => $subscriptionSend,
                "EMAIL_TO" => $arSubscriptions[$key]['EMAIL']
            )
        );
    }
}