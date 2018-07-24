<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

$basket = new \Lema\Basket\Basket();
$arResult['ADDRESS'] = array();
foreach($basket->getProducts() as $item){
        if(isset($item['CITY'])){
            $arResult['ADDRESS'][$item['PRODUCT_ID']] = "г.".$item['CITY'];
        }
        if(isset($item['REGION'])){
            if(!empty($arResult['ADDRESS'][$item['PRODUCT_ID']]))
                $arResult['ADDRESS'][$item['PRODUCT_ID']] .= ", ".$item['REGION'];
            else
                $arResult['ADDRESS'][$item['PRODUCT_ID']] = $item['REGION'];
        }
        if(isset($item['STREET'])){
            if(!empty($arResult['ADDRESS'][$item['PRODUCT_ID']]))
                $arResult['ADDRESS'][$item['PRODUCT_ID']] .= ", ул. ".$item['STREET'];
            else
                $arResult['ADDRESS'][$item['PRODUCT_ID']] = "ул. ". $item['STREET'];
        }
        if(isset($item['HOUSE_NUMBER'])){
            if(!empty($arResult['ADDRESS'][$item['PRODUCT_ID']]))
                $arResult['ADDRESS'][$item['PRODUCT_ID']] .= ", д. ".$item['HOUSE_NUMBER'];
            else
                $arResult['ADDRESS'][$item['PRODUCT_ID']] = "д. ".$item['HOUSE_NUMBER'];
        }
}
$arResult['RENT_TYPE'] = array();
foreach(\LIblock::getPropEnumValues(\LIblock::getPropId('objects', 'RENT_TYPE')) as $data){
    $arResult['RENT_TYPE'][$data['ID']] = $data;
}

$basket = new \Lema\Basket\Basket();
$arResult['IN_FAVORITES'] = array();
foreach ($basket->getProducts() as $data){
    $arResult['IN_FAVORITES'][$data['PRODUCT_ID']] = $data['ID'];
}