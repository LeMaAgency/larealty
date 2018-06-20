<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->addExternalCss("/bitrix/css/main/bootstrap.css");
$this->addExternalCss("/bitrix/css/main/font-awesome.css");
?>
<section class="filter filter_bg">
    <div class="overlay"></div>
    <div class="container">
        <form name="<?echo $arResult["FILTER_NAME"]."_form"?>" class="filter-form" action="<?echo $arResult["FORM_ACTION"]?>" method="get">

            <div class="filter-form__choose">
                <input type="radio"<?
                if(isset($_GET['arrFilter_pf']))
                    echo checked('RENT_TYPE', 29, $_GET['arrFilter_pf']);
                else
                    echo ' checked';
                ?>
                       id="rent-id" class="filter-form__choose__item" name="arrFilter_pf[RENT_TYPE]" value="29">
                <label for="rent-id" class="filter-form__choose__item-label">снять</label>
                <input type="radio"<? if(isset($_GET['arrFilter_pf'])) echo checked('RENT_TYPE', 28, $_GET['arrFilter_pf']);?>
                       id="rent-out-id" class="filter-form__choose__item" name="arrFilter_pf[RENT_TYPE]" value="28">
                <label for="rent-out-id" class="filter-form__choose__item-label">сдать</label>
            </div>
            <div class="filter-form__type">
                <div class="filter-field-title">Тип недвижимости</div>
                <input type="radio"<?
                if(isset($_GET['arrFilter_pf']))
                    echo checked('REALTY_TYPE', 2, $_GET['arrFilter_pf']);
                else
                    echo ' checked';
                ?>
                       id="type-room" class="filter-form__type__item" name="arrFilter_pf[REALTY_TYPE]" value="2">
                <label for="type-room" class="filter-form__type__item-label">комната</label>
                <input type="radio"<? if(isset($_GET['arrFilter_pf'])) echo checked('REALTY_TYPE', 1, $_GET['arrFilter_pf']);?>
                       id="type-apartment" class="filter-form__type__item" name="arrFilter_pf[REALTY_TYPE]" value="1">
                <label for="type-apartment" class="filter-form__type__item-label">квартира</label>
                <input type="radio"<? if(isset($_GET['arrFilter_pf'])) echo checked('REALTY_TYPE', 3, $_GET['arrFilter_pf']);?>
                       id="type-house" class="filter-form__type__item" name="arrFilter_pf[REALTY_TYPE]" value="3">
                <label for="type-house" class="filter-form__type__item-label">дом/коттедж</label>
                <input type="radio"<? if(isset($_GET['arrFilter_pf'])) echo checked('REALTY_TYPE', 49, $_GET['arrFilter_pf']);?>
                       id="type-office" class="filter-form__type__item" name="arrFilter_pf[REALTY_TYPE]" value="49">
                <label for="type-office" class="filter-form__type__item-label">офис</label>
            </div>

            <div class="filter-form-row">

                <?foreach($arResult["ORDERED_ITEMS"] as $arItem):
                    if(isset($arItem['CODE']) && in_array($arItem['CODE'], array('RENT_TYPE', 'REALTY_TYPE')))
                        continue;
                    ?>
                    <?if(array_key_exists("HIDDEN", $arItem)):?>
                        <?=$arItem["INPUT"]?>
                    <?elseif ($arItem["TYPE"] == "RANGE"):
                    $extendFilterClass = null;
                    if(isset($arItem['CODE']) && in_array($arItem['CODE'], array('STAGE', 'STAGES_COUNT')))
                        $extendFilterClass = ' js-extend-filter-block';

                        ?>
                    <div class="filter-form-column<?=$extendFilterClass;?>">
                        <?if($arItem['CODE'] == 'ROOMS_COUNT'):?>
                            <div class="filter-field-title"><?=$arItem["NAME"]?></div>
                            <div class="filter-num-rooms">
                                <input name="<?=$arItem["INPUT_NAMES"][0]?>[0]" type="checkbox" id="n1" value="1" class="filter-input">
                                <label for="n1" class="filter-label">1</label>
                                <input name="<?=$arItem["INPUT_NAMES"][0]?>[1]" type="checkbox" id="n2" value="2" class="filter-input">
                                <label for="n2" class="filter-label">2</label>
                                <input name="<?=$arItem["INPUT_NAMES"][0]?>[2]" type="checkbox" id="n3" value="3" class="filter-input">
                                <label for="n3" class="filter-label">3</label>
                                <input name="<?=$arItem["INPUT_NAMES"][0]?>[4]" type="checkbox" id="n4" value="4x" class="filter-input">
                                <label for="n4" class="filter-label">4+</label>
                            </div>
                        <?elseif($arItem['CODE'] == 'PRICE'):?>
                            <div class="filter-field-title"><?=$arItem["NAME"]?></div>
                            <div class="filter-price">
                                <input
                                    type="number"
                                    value="<?=$arItem["INPUT_VALUES"][0]?>"
                                    name="<?=$arItem["INPUT_NAMES"][0]?>" class="filter-price-input filter-min-value-input"
                                    placeholder="<?=GetMessage("CT_BCF_FROM")?>"
                                />
                                <input
                                    type="number"
                                    value="<?=$arItem["INPUT_VALUES"][1]?>"
                                    name="<?=$arItem["INPUT_NAMES"][1]?>" class="filter-price-input filter-max-value-input"
                                    placeholder="<?=GetMessage("CT_BCF_TO")?>"
                                />
                            </div>
                            <div class="filter-price-slider"></div>
                            <div class="filter-price">
                                <span class="filter-price-value filter-min-value"></span>
                                <span class="filter-price-value filter-max-value"></span>
                            </div>
                        <?else:?>
                            <?if(!empty($arItem['INPUT_VALUES'][0]) && !empty($arItem['INPUT_VALUES'][1])):?>
                                <div class="filter-field-title"><?=$arItem["NAME"]?></div>
                                <div class="filter-select">
                                    <a href="#" class="filter-select-link">Выбрать</a>
                                    <ul class="filter-select-drop">
                                        <?for($i = $arItem['INPUT_VALUES'][0]; $i <= $arItem['INPUT_VALUES'][1]; ++$i):?>
                                            <li data-value="<?=$i;?>"
                                                <?if ($i == $arItem["INPUT_VALUE"]) echo ' class="selected"'?>
                                            ><?=$i?></li>
                                        <?endfor;?>
                                    </ul>
                                </div>
                            <?else:?>
                                <div class="filter-field-title"><?=$arItem["NAME"]?></div>
                                <div class="filter-price">
                                    <input
                                            type="text"
                                            value="<?=$arItem["INPUT_VALUE"]?>"
                                            name="<?=$arItem["INPUT_NAME"]?>" class="filter-price-input filter-max-value-input"
                                            placeholder="<?=$arItem['NAME']?>"
                                    />
                                </div>
                            <?endif;?>
                        <?endif;?>
                    </div>

                <?elseif ($arItem["TYPE"] == "DATE_RANGE"):?>
                    <div class="col-sm-6 col-md-4 bx-filter-parameters-box active">
                        <div class="bx-filter-parameters-box-title"><span><?=$arItem["NAME"]?></span></div>
                        <div class="bx-filter-block">
                            <div class="row bx-filter-parameters-box-container">
                                <div class="col-xs-6 bx-filter-parameters-box-container-block  bx-left"><div class="bx-filter-input-container bx-filter-calendar-container">
                                        <?$APPLICATION->IncludeComponent(
                                            'bitrix:main.calendar',
                                            '',
                                            array(
                                                'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
                                                'SHOW_INPUT' => 'Y',
                                                'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MIN"]["VALUE"]).'"',
                                                'INPUT_NAME' => $arItem["INPUT_NAMES"][0],
                                                'INPUT_VALUE' => $arItem["INPUT_VALUES"][0],
                                                'SHOW_TIME' => 'N',
                                                'HIDE_TIMEBAR' => 'Y',
                                            ),
                                            null,
                                            array('HIDE_ICONS' => 'Y')
                                        );?>
                                </div></div>
                                <div class="col-xs-6 bx-filter-parameters-box-container-block  bx-right"><div class="bx-filter-input-container bx-filter-calendar-container">
                                        <?$APPLICATION->IncludeComponent(
                                            'bitrix:main.calendar',
                                            '',
                                            array(
                                                'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
                                                'SHOW_INPUT' => 'Y',
                                                'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MAX"]["VALUE"]).'"',
                                                'INPUT_NAME' => $arItem["INPUT_NAMES"][1],
                                                'INPUT_VALUE' => $arItem["INPUT_VALUES"][1],
                                                'SHOW_TIME' => 'N',
                                                'HIDE_TIMEBAR' => 'Y',
                                            ),
                                            null,
                                            array('HIDE_ICONS' => 'Y')
                                        );?>
                                </div></div>
                            </div>
                        </div>
                    </div>
                <?elseif ($arItem["TYPE"] == "SELECT"):
                    ?>
                    <?php
                    if(isset($arItem['CODE']) && $arItem['CODE'] == 'REGION')
                        $arItem['NAME'] = 'Месторасположение';
                    ?>
                    <div class="filter-form-column">
                        <div class="filter-field-title"><?=$arItem["NAME"]?></div>
                        <div class="filter-select">
                            <a href="#" class="filter-select-link">Выбрать</a>
                            <ul class="filter-select-drop">
                                <li data-value="">Выбрать</li>
                                <?foreach ($arItem["LIST"] as $key => $value):?>
                                    <li data-value="<?=htmlspecialcharsBx($key)?>"
                                        <?if ($key == $arItem["INPUT_VALUE"]) echo ' class="selected"'?>
                                    ><?=htmlspecialcharsEx($value)?></li>
                                <?endforeach;?>
                            </ul>
                            <input type="hidden" name="<?=$arItem["INPUT_NAME"]?>"
                                   value="<?=empty($arItem["INPUT_VALUE"]) ? null : $arItem["INPUT_VALUE"];?>">
                        </div>
                    </div>
                <?elseif ($arItem["TYPE"] == "CHECKBOX"):
                    ?>
                    <div class="col-sm-6 col-md-4 bx-filter-parameters-box active">
                        <div class="bx-filter-parameters-box-title"><span><?=$arItem["NAME"]?></span></div>
                        <div class="bx-filter-block">
                            <div class="row bx-filter-parameters-box-container">
                                <div class="col-xs-12 bx-filter-parameters-box-container-block">
                                <?
                                $arListValue = (is_array($arItem["~INPUT_VALUE"]) ? $arItem["~INPUT_VALUE"] : array($arItem["~INPUT_VALUE"]));
                                foreach ($arItem["LIST"] as $key => $value):?>
                                <div class="checkbox">
                                    <label class="bx-filter-param-label">
                                        <input
                                            type="checkbox"
                                            value="<?=htmlspecialcharsBx($key)?>"
                                            name="<?echo $arItem["INPUT_NAME"]?>[]"
                                            <?if (in_array($key, $arListValue)) echo 'checked="checked"'?>
                                        >
                                        <span class="bx-filter-param-text"><?=htmlspecialcharsEx($value)?></span>
                                    </label>
                                </div>
                                <?endforeach?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?elseif ($arItem["TYPE"] == "RADIO"):
                    ?>
                    <div class="col-sm-6 col-md-4 bx-filter-parameters-box active">
                        <div class="bx-filter-parameters-box-title"><span><?=$arItem["NAME"]?></span></div>
                        <div class="bx-filter-block">
                            <div class="row bx-filter-parameters-box-container">
                                <div class="col-xs-12 bx-filter-parameters-box-container-block">
                                    <?
                                    $arListValue = (is_array($arItem["~INPUT_VALUE"]) ? $arItem["~INPUT_VALUE"] : array($arItem["~INPUT_VALUE"]));
                                    foreach ($arItem["LIST"] as $key => $value):?>
                                    <div class="radio">
                                        <label class="bx-filter-param-label">
                                            <input
                                                type="radio"
                                                value="<?=htmlspecialcharsBx($key)?>"
                                                name="<?echo $arItem["INPUT_NAME"]?>"
                                                <?if (in_array($key, $arListValue)) echo 'checked="checked"'?>
                                            >
                                            <span class="bx-filter-param-text"><?=htmlspecialcharsEx($value)?></span>
                                        </label>
                                    </div>
                                    <?endforeach?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?else:?>
                    <div class="col-sm-6 col-md-4 bx-filter-parameters-box active">
                        <div class="bx-filter-parameters-box-title"><span><?=$arItem["NAME"]?></span></div>
                        <div class="bx-filter-block">
                            <div class="row bx-filter-parameters-box-container">
                                <div class="col-xs-12 bx-filter-parameters-box-container-block">
                                    <div class="bx-filter-input-container">
                                        <?=$arItem["INPUT"]?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?endif?>
            <?endforeach;?>
                <?if(!empty($item)):?>
                    <div class="filter-form-column">
                        <div class="filter-field-title"><?=$item["NAME"]?></div>
                        <div class="filter-select">
                            <a href="#" class="filter-select-link">Выбрать</a>
                            <ul class="filter-select-drop">
                                <li data-value="">Выбрать</li>
                                <?foreach ($item["LIST"] as $key => $value):?>
                                    <li data-value="<?=htmlspecialcharsBx($key)?>"
                                        <?if ($key == $item["INPUT_VALUE"]) echo ' class="selected"'?>
                                    ><?=htmlspecialcharsEx($value)?></li>
                                <?endforeach;?>
                            </ul>
                            <input type="hidden" name="<?=$item["INPUT_NAME"]?>"
                                   value="<?=empty($item["INPUT_VALUE"]) ? null : $item["INPUT_VALUE"];?>">
                        </div>
                    </div>
                <?endif;?>
            </div>
            <?if(!empty($arResult['HAS_EXPANDED'])):?>
                <a href="#" class="filter-extend-link js-extend-filter">Расширенный поиск <b>+</b></a>
            <?endif;?>
            <button type="submit" name="set_filter" value="Y" class="filter-submit-btn">Поиск</button>
            <div class="clb"></div>
        </form>
    </div>
</section>