<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$realtyTypeId = \LIblock::getPropId("objects", 'REALTY_TYPE');
$priceId = \LIblock::getPropId("objects", 'PRICE');
$cityId = \LIblock::getPropId("objects", 'CITY');
$squareId = \LIblock::getPropId("objects", 'SQUARE');
$bedroomId = \LIblock::getPropId("objects", 'BEDROOM');

?>
<form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>" method="get">
    <? foreach ($arResult["ITEMS"] as $arItem):
        if (array_key_exists("HIDDEN", $arItem)):
            echo $arItem["INPUT"];
        endif;
    endforeach; ?>
    <div class="catalog-filter">
        <div class="container">
            <div class="filter-list">
                <div class="filter-row">
                    <input type="text" class="input-search" name="<?=$arResult['FILTER_NAME'];?>[SEARCH]" value="<?=!empty($_REQUEST[$arResult['FILTER_NAME']]['SEARCH'])?$_REQUEST[$arResult['FILTER_NAME']]['SEARCH']:'';?>" placeholder="Город или ID">
                    <?
                    $priceId = \LIblock::getPropId("objects", 'PRICE');
                    if (isset($arResult['ITEMS']['PROPERTY_'.$priceId])) { ?>
                        <div class="price-input">
                            <input type="text" name="<?= $arResult['ITEMS']['PROPERTY_'.$priceId]['INPUT_NAMES'][0]; ?>"
                                   value="<?= $arResult['ITEMS']['PROPERTY_'.$priceId]['INPUT_VALUES'][0]; ?>" class="price-min price"
                                   placeholder="Цена от">
                            <img src="/assets/img/line.png" alt="">
                            <input type="text" name="<?= $arResult['ITEMS']['PROPERTY_'.$priceId]['INPUT_NAMES'][1]; ?>"
                                   value="<?= $arResult['ITEMS']['PROPERTY_'.$priceId]['INPUT_VALUES'][1]; ?>" class="price-max price"
                                   placeholder="Цена до">
                        </div>
                    <? } ?>

                    <?
                    if (isset($arResult['ITEMS']['PROPERTY_'.$squareId])) { ?>
                        <input type="text" name="<?= $arResult['ITEMS']['PROPERTY_'.$squareId]['INPUT_NAME']; ?>" value="<?=$arResult['ITEMS']['PROPERTY_'.$squareId]['INPUT_VALUE'];?>" class="filter-area" placeholder="Площадь">
                    <? } ?>


                    <? if (isset($arResult['ITEMS']['PROPERTY_'.$cityId])) { ?>
                        <select name="<?= $arResult['ITEMS']['PROPERTY_'.$cityId]['INPUT_NAME']; ?>" class="city-filter">
                            <? foreach ($arResult['ITEMS']['PROPERTY_'.$cityId]['LIST'] as $key => $city) { ?>
                                <option value="<?= $key; ?>" <? if ($arResult['ITEMS']['PROPERTY_'.$cityId]['INPUT_VALUE'] == $key){ ?>selected<? } ?>>
                                    <? if (empty($key)) { ?>
                                        <?= $arResult['ITEMS']['PROPERTY_'.$cityId]['NAME']; ?>
                                    <? } else { ?>
                                        <?= $city; ?>
                                    <? } ?>
                                </option>
                            <? } ?>
                        </select>
                    <? } ?>

                    <!--<select name="ready" class="ready-filter tablet">
                        <option value="Готовность">Готовность</option>
                    </select>-->
                </div>
                <div class="filter-row">
                    <div>
                        <!--<select name="ready" class="ready-filter pc">
                            <option value="Готовность">Готовность</option>
                        </select>-->
                        <!-- <select name="view" class="view-filter">
                             <option value="Вид">Вид</option>
                         </select>-->
                        <!--<select name="infrastructure" class="infrastructure-filter">
                            <option value="Инфраструктура">Инфраструктура</option>
                        </select>-->
                        <br>
                    </div>
                    <button type="submit" value="Y" name="set_filter" class="filter-button">
                        Показать
                        <!--<span>(1 156)</span>-->
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
