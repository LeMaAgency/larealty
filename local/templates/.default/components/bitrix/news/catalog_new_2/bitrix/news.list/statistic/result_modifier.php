<?
$arResult['STATISTICS'] = $arResult['STATISTICS_INFO'] = [];
$counter = 0;
foreach ($arResult['ITEMS'] as $arItem) {
    if (!empty($arItem['PROPERTIES']['REGION']['VALUE_ENUM_ID'])) {
        $region = $arItem['PROPERTIES']['REGION'];
        if (!isset($arResult['STATISTICS'][$region['ENUM_ID']])) {
            $arResult['STATISTICS'][$region['VALUE_ENUM_ID']]['NAME'] = $region['VALUE'];
            $arResult['STATISTICS'][$region['VALUE_ENUM_ID']]['COUNT'] = 1;
        } else {
            $arResult['STATISTICS'][$region['VALUE_ENUM_ID']]['COUNT']++;
        }
        $counter++;
    }
}
$arResult['STATISTICS_INFO']['ALL_COUNT'] = $counter;
$arResult['STATISTICS_INFO']['ELEM_IN_BLOCK'] = ceil(count($arResult['STATISTICS'])/2);
$arResult['STATISTICS_INFO']['LAST_REGION_ID'] = $region['VALUE_ENUM_ID'];

