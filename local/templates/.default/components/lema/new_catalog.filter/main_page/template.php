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

?>
<div class="main">
    <div class="container">
        <div class="main-form">
            <form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<?= SITE_DIR; ?>catalog/" method="get">
                <div class="form-row">
                    <? if (!empty($arResult['SECTIONS'])) { ?>
                        <select name="<?=$arResult['FILTER_NAME'];?>[SECTION]" class="type-select form-select js-select-sections">
                            <option value="">Тип недвижимости</option>
                            <? foreach ($arResult['SECTIONS'] as $arSection) { ?>
                                <option value="<?= $arSection['CODE']; ?>">
                                    <?= $arSection['NAME']; ?>
                                </option>
                            <? } ?>
                        </select>
                    <? } ?>

                    <? if (isset($arResult['ITEMS']['PROPERTY_' . $arResult['CITY_ID']])) { ?>
                        <select name="<?= $arResult['ITEMS']['PROPERTY_' . $arResult['CITY_ID']]['INPUT_NAME']; ?>" class="city-select form-select">
                            <? foreach ($arResult['ITEMS']['PROPERTY_' . $arResult['CITY_ID']]['LIST'] as $key => $city) { ?>
                                <option value="<?= $key; ?>">
                                    <? if (empty($key)) { ?>
                                        <?= $arResult['ITEMS']['PROPERTY_' . $arResult['CITY_ID']]['NAME']; ?>
                                    <? } else { ?>
                                        <?= $city; ?>
                                    <? } ?>
                                </option>
                            <? } ?>
                        </select>
                    <? } ?>

                    <? if (isset($arResult['ITEMS']['PROPERTY_' . $arResult['PRICE_ID']])) { ?>
                        <input type="text" name="<?= $arResult['ITEMS']['PROPERTY_' . $arResult['PRICE_ID']]['INPUT_NAMES'][0]; ?>"
                               value=""
                               class="min-price price-input"
                               placeholder="Цена от">
                        <input type="text" name="<?= $arResult['ITEMS']['PROPERTY_' . $arResult['PRICE_ID']]['INPUT_NAMES'][1]; ?>"
                               value=""
                               class="max-price price-input"
                               placeholder="Цена до">
                    <? } ?>

                </div>

                <div class="form-row">
                    <input type="text" class="search-input" name="<?= $arResult['FILTER_NAME']; ?>[MAIN_SEARCH]" value=""
                           placeholder="Поиск по названию, адресу или id">
                    <button type="submit" value="Y" name="set_filter" class="result-button">
                        Показать
                        <!-- <span>(1 156)</span>-->
                    </button>
                    <? foreach ($arResult["ITEMS"] as $arItem):
                        if (array_key_exists("HIDDEN", $arItem)):
                            echo $arItem["INPUT"];
                        endif;
                    endforeach; ?>
                </div>

            </form>
        </div>
    </div>
</div>
