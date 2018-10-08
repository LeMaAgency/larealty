<?php
require_once $_SERVER['DOCUMENT_ROOT'] .'/bitrix/modules/main/include/prolog_before.php';

$yml = new \DomclickExport(\LIblock::getId('objects'),array(
    'storageDir' => '/bitrix/catalog_export/domclick',
    //'additionalData' => array('siteTitle' => 'KvOtvet'),
));

$rentAndRealtyTypes = array();
$tmp = LIblock::getPropEnumValues(LIblock::getPropId('objects', 'RENT_TYPE'));
foreach($tmp as $code => $data)
    $rentAndRealtyTypes[$data['ID']] = $code;
unset($tmp);

$sections = \LIblock::getSectionsByIblockCode('objects', false);

$yml->loadData(array(
    'arSelect' => array(
        '*', 'DETAIL_PAGE_URL',
        'PROPERTY_PRICE',
        'PROPERTY_MORE_PHOTO',
        'PROPERTY_STAGE',
        'PROPERTY_STAGES_COUNT',
        'PROPERTY_CITY',
        'PROPERTY_REGION',
        'PROPERTY_STREET',
        'PROPERTY_HOUSE_NUMBER',
        'PROPERTY_BUILDING_NUMBER',
        'PROPERTY_CADASTRAL_NUMBER',
        'PROPERTY_PROPOSED_ROOMS_COUNT',
        'PROPERTY_RENT_TYPE',
        'PROPERTY_MATERIAL',
        'PROPERTY_YEAR',
        'PROPERTY_LIFT',
        'PROPERTY_SEP_ENTRANCE',
        'PROPERTY_OWNER',
        'PROPERTY_LAYOUT_TYPE',
        'PROPERTY_BATHROOM',
        'PROPERTY_ROOMS_COUNT',
        'PROPERTY_OFFERED_ROOMS_COUNT',
        'PROPERTY_BATHROOM_COUNT',
        'PROPERTY_SQUARE',
        'PROPERTY_SQUARE_RESIDENT',
        'PROPERTY_SQUARE_KITCHEN',
        'PROPERTY_SQUARE_LAND',
        'PROPERTY_LAND_STATUS',
        'PROPERTY_BALCONIES_COUNT',
        'PROPERTY_LOGGIAS_COUNT',
        'PROPERTY_REPAIR_TYPE',
        'PROPERTY_SIDE',
        'PROPERTY_CLASS_TYPE',
        'PROPERTY_PARKING',
        'PROPERTY_SECURITY_CONCIERGE',
        'PROPERTY_PHONE',
        'PROPERTY_INTERNET',
        'PROPERTY_WATER_SUPPLY',
        'PROPERTY_HEATING',
        'PROPERTY_COLD_WATER',
        'PROPERTY_HOT_WATER',
        'PROPERTY_SEWERAGE',
        'PROPERTY_ELECTRIC',
        'PROPERTY_GAZ',
        'PROPERTY_SAUNA',
        'PROPERTY_GARAGE',
        'PROPERTY_CLOSED_TERRITORY',
        'PROPERTY_SECURITY_ALARM',
        'PROPERTY_FIRE_ALARM',
        'PROPERTY_FIRE_EXT_SYSTEM',
        'PROPERTY_SECURITY_VIDEO',
        'PROPERTY_HAVINGS_TYPE',
        'PROPERTY_USER_NAME',
        'PROPERTY_USER_PHONE',
        'PROPERTY_USER_EMAIL',
        'PROPERTY_TV',
        'PROPERTY_HYPOTHEC',
        'PROPERTY_LOT_CATEGORIES',
        'PROPERTY_LOT_HAVINGS_TYPE',
    ),
    'filter' => array('ACTIVE' => 'Y', 'SECTION_CODE' => 'active', 'INCLUDE_SUBSECTIONS' => 'Y'),
    'callback' => function($data) use($rentAndRealtyTypes, $sections) {
        foreach($data as $k => $v)
        {
            if($k[0] === '~' || false !== strpos($k, '_VALUE_ID'))
                unset($data[$k]);
        }
        if(in_array(mb_strtolower($data['PROPERTY_RENT_TYPE_VALUE'], 'UTF-8'), array('куплю', 'продам')))
            $data['type'] = 'продажа';
        else
            $data['type'] = 'аренда';
        $data['property-type'] = 'жилая';
        //Get rent type
        $rentType = null;
        if(empty($rentAndRealtyTypes[$data['PROPERTY_RENT_TYPE_ENUM_ID']]))
            $rentType = \CUtil::translit($data['PROPERTY_RENT_TYPE_VALUE'], 'ru');
        else
            $rentType = $rentAndRealtyTypes[$data['PROPERTY_RENT_TYPE_ENUM_ID']];

        $categories = array(
            'квартиры' => 'квартира',
            'дома' => 'дом',
            'дачи' => 'дом с участком',
            'комнаты' => 'комната',
            'земельный участок' => 'участок',
            //'офисы' => 'бизнес',
            //'торговые площади' => 'бизнес',
            //'здания' => 'бизнес',
        );

        if(isset($sections[$data['IBLOCK_SECTION_ID']]))
        {
            $category = mb_strtolower($sections[$data['IBLOCK_SECTION_ID']]['NAME'], 'UTF-8');
            $data['category'] = isset($categories[$category]) ? $categories[$category] : null;
        }
        else
        {
            unset($data);
            return ;
        }

        $data['areaTypeTag'] = 'area';
        switch($data['category'])
        {
            case 'участок':
                $data['areaTypeTag'] = 'land-space';
            break;
            case 'комната':
                $data['areaTypeTag'] = 'room-space';
            break;
        }

        $data['url'] = '/catalog/' . $sections[$data['IBLOCK_SECTION_ID']]['CODE'] . '/' . $rentType . '/' . $data['CODE'];

        $data['creation-date'] = date('c', $data['DATE_CREATE_UNIX']);
        $data['last-update-date'] = date('c', $data['TIMESTAMP_X_UNIX']);
        $data['country'] = 'Россия';
        $data['address'] = trim($data['PROPERTY_STREET_VALUE'] . ' ' . $data['PROPERTY_HOUSE_NUMBER_VALUE']);

        $data['images'] = array();
        if(!empty($data['DETAIL_PICTURE']))
            $data['images'][] = \CFile::GetPath($data['DETAIL_PICTURE']);
        if(!empty($data['PROPERTY_MORE_PHOTO_VALUE']))
        {
            foreach($data['PROPERTY_MORE_PHOTO_VALUE'] as $imgId)
                $data['images'][] = \CFile::GetPath($imgId);
        }
        unset($data['DETAIL_PICTURE'], $data['PROPERTY_MORE_PHOTO_VALUE']);

        return $data;
    },
));

$yml->showData(array(
    'sendHeader' => true,
    'fields' => array(
        'url' => 'url',
        'type' => 'type',
        'property-type' => 'property-type',
        'category' => 'category',
        'creation-date' => 'creation-date',
        'last-update-date' => 'last-update-date',
        'expire-date' => 'expire-date',
        'location' => array(
            'country' => 'country',
            'locality-name' => 'PROPERTY_CITY_VALUE',
            'district' => 'PROPERTY_REGION_VALUE',
            'address' => 'address',
        ),
        'sales-agent' => array(
            'name' => 'PROPERTY_USER_NAME_VALUE',
            'phone' => 'PROPERTY_USER_PHONE_VALUE',
            'email' => 'PROPERTY_USER_EMAIL_VALUE',
            'category' => 'владелец',
        ),
        'cadastral-number' => 'PROPERTY_CADASTRAL_NUMBER_VALUE',
        'apartment' => 'PROPERTY_FLAT_NUMBER_VALUE',
        'renovation' => 'PROPERTY_REPAIR_TYPE_VALUE',
        'rooms' => 'PROPERTY_ROOMS_COUNT_VALUE',
        'rooms-offered' => 'PROPERTY_OFFERED_ROOMS_COUNT_VALUE',
        'floor' => 'PROPERTY_STAGE_VALUE',
        'floors-total' => 'PROPERTY_STAGES_COUNT_VALUE',
        'bathroom-unit' => 'PROPERTY_BATHROOM_VALUE',
    ),
    'checkValueFields' => array(
        'price' => array(
            'value' => 'PROPERTY_PRICE_VALUE',
            'currency' => 'RUR',
            //'unit' => '',
        ),
        'lot-area' => array(
            'value' => 'PROPERTY_SQUARE_LAND_VALUE',
            'unit' => 'кв. м',
        ),
        'living-space' => array(
            'value' => 'PROPERTY_SQUARE_RESIDENT_VALUE',
            'unit' => 'кв. м',
        ),
        'kitchen-space' => array(
            'value' => 'PROPERTY_SQUARE_KITCHEN_VALUE',
            'unit' => 'кв. м',
        ),
    ),
    'boolListFields' => array(
        'mortgage' => 'PROPERTY_HYPOTHEC_VALUE',
        /*'phone' => 'PROPERTY_PHONE_VALUE',
        'internet' => 'PROPERTY_INTERNET_VALUE',
        'television' => 'PROPERTY_TV_VALUE',
        'alarm' => 'alarm',
        'gas' => 'PROPERTY_GAZ_VALUE',*/
    ),
    /*'params' => array(
        array('Поставщик', 'PROPERTY_PROVIDER_VALUE'),
        array('Материал', 'PROPERTY_MATERIAL_VALUE'),
        array('Количество штук в упаковке', 'PROPERTY_COUNT_IN_BOX_VALUE', 'unit' => 'шт.'),
        array('Артикул', 'PROPERTY_ARTNUMBER_VALUE'),
        array('Цвет', 'PROPERTY_COLOR_VALUE'),
        array('Категория одежды', 'PROPERTY_CATEGORY_VALUE'),
    ),*/
));