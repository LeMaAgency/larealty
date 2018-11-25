<?

$arResult['PRICE_ID'] = \LIblock::getPropId("objects", 'PRICE');
$arResult['CITY_ID'] = \LIblock::getPropId("objects", 'CITY');
$res = \CIBlockSection::getList(
    [
        'SORT' => 'ASC',
    ],
    [
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'DEPTH_LEVEL' => 1,
        'ACTIVE' => 'Y',
    ],
    false,
    [
        'NAME',
        'CODE',
    ]

);
$arResult['SECTIONS'] = [];
while ($ar_res = $res->Fetch()) {
    $arResult['SECTIONS'][] = $ar_res;
}