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
$this->addExternalCss("/bitrix/css/main/bootstrap.css");
$this->addExternalCss("/bitrix/css/main/font-awesome.css");

?>
<section class="filter filter_bg">
    <div class="overlay"></div>
    <div class="container">
        <form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" class="filter-form"
              action="<? echo $arResult["FORM_ACTION"] ?>" method="get">

            <? if (!empty($arParams['SHOW_BUTTON_TYPES'])): ?>
                <?php
                $first = true;
                $useSectionCode = !empty($arParams['SECTION_CODE']);
                ?>
                <div class="filter-form__type">
                    <div class="filter-field-title">Тип недвижимости</div>
                    <? foreach ($arParams['SHOW_BUTTON_TYPES'] as $code => $label):
                        if ($useSectionCode)
                            $active = $code === $arParams['SECTION_CODE'];
                        else {
                            $active = $first;
                            if ($first)
                                $first = false;
                        }
                        ?>
                        <input<? if ($active) {
                            ?> checked<? } ?> type="radio" id="type-<?= $code; ?>" data-code="<?= $code; ?>"
                                              class="filter-form__type__item" name="arrFilter_pf[REALTY_TYPE]"
                                              value="<?= $code; ?>">
                        <label for="type-<?= $code; ?>" class="filter-form__type__item-label"><?= $label; ?></label>
                    <? endforeach; ?>
                </div>
            <? endif; ?>

            <div class="filter-form-row">

                <? foreach ($arResult["ORDERED_ITEMS"] as $arItem): ?>
                    <?
                    $extendFilterClass = empty($arItem['EXPANDED']) ? null : ' js-extend-filter-block';
                    ?>
                    <? if (array_key_exists("HIDDEN", $arItem)): ?>
                        <?= $arItem["INPUT"] ?>
                    <? elseif (isset($arItem['CODE']) && $arItem["TYPE"] == "RANGE"):
                        $extendFilterClass = empty($arItem['EXPANDED']) ? null : ' js-extend-filter-block';

                        ?>
                        <div class="filter-form-column<?= $extendFilterClass; ?>">
                            <? if ($arItem['CODE'] == 'ROOMS_COUNT'):?>
                                <div class="filter-field-title"><?= $arItem["NAME"] ?></div>
                                <div class="filter-num-rooms">
                                    <input name="<?= $arItem["INPUT_NAMES"][0] ?>[0]" type="checkbox" id="n1" value="1"
                                           class="filter-input" <?if(!empty($arItem["INPUT_VALUES"][0])){?>checked<?}?>>
                                    <label for="n1" class="filter-label">1</label>
                                    <input name="<?= $arItem["INPUT_NAMES"][0] ?>[1]" type="checkbox" id="n2" value="2"
                                           class="filter-input" <?if(!empty($arItem["INPUT_VALUES"][1])){?>checked<?}?>>
                                    <label for="n2" class="filter-label">2</label>
                                    <input name="<?= $arItem["INPUT_NAMES"][0] ?>[2]" type="checkbox" id="n3" value="3"
                                           class="filter-input" <?if(!empty($arItem["INPUT_VALUES"][2])){?>checked<?}?>>
                                    <label for="n3" class="filter-label">3</label>
                                    <input name="<?= $arItem["INPUT_NAMES"][0] ?>[4]" type="checkbox" id="n4" value="4x"
                                           class="filter-input" <?if(!empty($arItem["INPUT_VALUES"][4])){?>checked<?}?>>
                                    <label for="n4" class="filter-label">4+</label>
                                </div>
                            <? elseif (isset($arItem['CODE']) && in_array($arItem['CODE'], array('PRICE', 'SQUARE', 'SQUARE_LAND'))):
                                $currentMin = $arItem[(empty($arItem['REQUEST_VALUES'][0]) ? 'INPUT' : 'REQUEST') . '_VALUES'][0];
                                $currentMax = $arItem[(empty($arItem['REQUEST_VALUES'][1]) ? 'INPUT' : 'REQUEST') . '_VALUES'][1];
                                ?>
                                <div class="filter-field-title"><?= $arItem["NAME"] ?></div>
                                <div class="filter-price">
                                    <input
                                            type="number"
                                            value="<?= $currentMin ?>"
                                            name="<?= $arItem["INPUT_NAMES"][0] ?>"
                                            class="filter-price-input filter-min-value-input"
                                            placeholder="<?= GetMessage("CT_BCF_FROM") ?>"
                                    />
                                    <input
                                            type="number"
                                            value="<?= $currentMax ?>"
                                            name="<?= $arItem["INPUT_NAMES"][1] ?>"
                                            class="filter-price-input filter-max-value-input"
                                            placeholder="<?= GetMessage("CT_BCF_TO") ?>"
                                    />
                                </div>
                                <div
                                        data-min="<?= $arItem['INPUT_VALUES'][0]; ?>"
                                        data-max="<?= $arItem['INPUT_VALUES'][1]; ?>"
                                        data-current-min="<?= $currentMin; ?>"
                                        data-current-max="<?= $currentMax; ?>"
                                        class="filter-price-slider"></div>
                                <div class="filter-price">
                                    <span class="filter-price-value filter-min-value"><?= $arItem['INPUT_VALUES'][0]; ?></span>
                                    <span class="filter-price-value filter-max-value"><?= $arItem['INPUT_VALUES'][1]; ?></span>
                                </div>
                            <? else:?>
                                <? if (!empty($arItem['INPUT_VALUES'][0]) && !empty($arItem['INPUT_VALUES'][1])):?>
                                    <div class="filter-field-title"><?= $arItem["NAME"] ?></div>
                                    <div class="filter-select">
                                        <a href="#" class="filter-select-link">Выбрать</a>
                                        <ul class="filter-select-drop">
                                            <? for ($i = $arItem['INPUT_VALUES'][0]; $i <= $arItem['INPUT_VALUES'][1]; ++$i):?>
                                                <li data-value="<?= $i; ?>"
                                                    <? if ($i == $arItem["INPUT_VALUE"]) echo ' class="selected"' ?>
                                                ><?= $i ?></li>
                                            <? endfor; ?>
                                        </ul>
                                    </div>
                                <? else:?>
                                    <div class="filter-field-title"><?= $arItem["NAME"] ?></div>
                                    <div class="filter-price">
                                        <input
                                                type="text"
                                                value="<?= $arItem["INPUT_VALUE"] ?>"
                                                name="<?= $arItem["INPUT_NAME"] ?>"
                                                class="filter-price-input filter-max-value-input"
                                                placeholder="<?= $arItem['NAME'] ?>"
                                        />
                                    </div>
                                <? endif; ?>
                            <? endif; ?>
                        </div>

                    <? elseif ($arItem["TYPE"] == "DATE_RANGE"): ?>
                        <div class="col-sm-6 col-md-4 bx-filter-parameters-box active<?= $extendFilterClass; ?>">
                            <div class="bx-filter-parameters-box-title"><span><?= $arItem["NAME"] ?></span></div>
                            <div class="bx-filter-block">
                                <div class="row bx-filter-parameters-box-container">
                                    <div class="col-xs-6 bx-filter-parameters-box-container-block  bx-left">
                                        <div class="bx-filter-input-container bx-filter-calendar-container">
                                            <? $APPLICATION->IncludeComponent(
                                                'bitrix:main.calendar',
                                                '',
                                                array(
                                                    'FORM_NAME' => $arResult["FILTER_NAME"] . "_form",
                                                    'SHOW_INPUT' => 'Y',
                                                    'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="' . FormatDate("SHORT", $arItem["VALUES"]["MIN"]["VALUE"]) . '"',
                                                    'INPUT_NAME' => $arItem["INPUT_NAMES"][0],
                                                    'INPUT_VALUE' => $arItem["INPUT_VALUES"][0],
                                                    'SHOW_TIME' => 'N',
                                                    'HIDE_TIMEBAR' => 'Y',
                                                ),
                                                null,
                                                array('HIDE_ICONS' => 'Y')
                                            ); ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 bx-filter-parameters-box-container-block  bx-right">
                                        <div class="bx-filter-input-container bx-filter-calendar-container">
                                            <? $APPLICATION->IncludeComponent(
                                                'bitrix:main.calendar',
                                                '',
                                                array(
                                                    'FORM_NAME' => $arResult["FILTER_NAME"] . "_form",
                                                    'SHOW_INPUT' => 'Y',
                                                    'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="' . FormatDate("SHORT", $arItem["VALUES"]["MAX"]["VALUE"]) . '"',
                                                    'INPUT_NAME' => $arItem["INPUT_NAMES"][1],
                                                    'INPUT_VALUE' => $arItem["INPUT_VALUES"][1],
                                                    'SHOW_TIME' => 'N',
                                                    'HIDE_TIMEBAR' => 'Y',
                                                ),
                                                null,
                                                array('HIDE_ICONS' => 'Y')
                                            ); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <? elseif ($arItem["TYPE"] == "SELECT"):
                        ?>
                        <?php
                        if (isset($arItem['CODE']) && $arItem['CODE'] == 'REGION')
                            $arItem['NAME'] = 'Месторасположение';
                        ?>
                        <div class="filter-form-column<?= $extendFilterClass; ?>">
                            <div class="filter-field-title"><?= $arItem["NAME"] ?></div>
                            <div class="filter-select">
                                <a href="#" class="filter-select-link">Выбрать</a>
                                <ul class="filter-select-drop">
                                    <li data-value="">Выбрать</li>
                                    <? foreach ($arItem["LIST"] as $key => $value):?>
                                        <li data-value="<?= htmlspecialcharsBx($key) ?>"
                                            <? if ($key == $arItem["INPUT_VALUE"]) echo ' class="selected"' ?>
                                        ><?= htmlspecialcharsEx($value) ?></li>
                                    <? endforeach; ?>
                                </ul>
                                <input type="hidden" name="<?= $arItem["INPUT_NAME"] ?>"
                                       value="<?= empty($arItem["INPUT_VALUE"]) ? null : $arItem["INPUT_VALUE"]; ?>">
                            </div>
                        </div>
                    <? elseif ($arItem["TYPE"] == "CHECKBOX"):
                        ?>
                        <div class="col-sm-6 col-md-4 bx-filter-parameters-box active<?= $extendFilterClass; ?>">
                            <div class="bx-filter-parameters-box-title"><span><?= $arItem["NAME"] ?></span></div>
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
                                                            value="<?= htmlspecialcharsBx($key) ?>"
                                                            name="<? echo $arItem["INPUT_NAME"] ?>[]"
                                                        <? if (in_array($key, $arListValue)) echo 'checked="checked"' ?>
                                                    >
                                                    <span class="bx-filter-param-text"><?= htmlspecialcharsEx($value) ?></span>
                                                </label>
                                            </div>
                                        <? endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <? elseif ($arItem["TYPE"] == "RADIO"):
                        ?>
                        <div class="col-sm-6 col-md-4 bx-filter-parameters-box active<?= $extendFilterClass; ?>">
                            <div class="bx-filter-parameters-box-title"><span><?= $arItem["NAME"] ?></span></div>
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
                                                            value="<?= htmlspecialcharsBx($key) ?>"
                                                            name="<? echo $arItem["INPUT_NAME"] ?>"
                                                        <? if (in_array($key, $arListValue)) echo 'checked="checked"' ?>
                                                    >
                                                    <span class="bx-filter-param-text"><?= htmlspecialcharsEx($value) ?></span>
                                                </label>
                                            </div>
                                        <? endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <? else: ?>
                        <div class="col-sm-6 col-md-4 bx-filter-parameters-box active<?= $extendFilterClass; ?>">
                            <div class="bx-filter-parameters-box-title"><span><?= $arItem["NAME"] ?></span></div>
                            <div class="bx-filter-block">
                                <div class="row bx-filter-parameters-box-container">
                                    <div class="col-xs-12 bx-filter-parameters-box-container-block">
                                        <div class="bx-filter-input-container">
                                            <?= $arItem["INPUT"] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <? endif ?>
                <? endforeach; ?>
            </div>
            <? if (!empty($arResult['HAS_EXPANDED'])): ?>
                <a href="#" class="filter-extend-link js-extend-filter">Расширенный поиск <b>+</b></a>
            <? endif; ?>
            <button type="submit" name="set_filter" value="Y" class="filter-submit-btn">Поиск</button>
            <div class="clb"></div>
        </form>
    </div>
    <form action="/ajax/add_subscribe.php" method="POST" class="ajax-form subscribe__form js-subscribe-form">
        <div class="subscribe">
            <div class="it-block feedback-input">
                <input required="" type="text" id="form_field_email" name="EMAIL" placeholder="Email"
                       class="request__form__input margin_auto">
                <div class="it-error"></div>
            </div>
            <input type="hidden" name="URL" value="<?=$APPLICATION->GetCurUri();?>">
            <div class="it-block it-buttons feedback-input">
                <input type="submit" value="Подписаться" class="request__form__button margin_auto">
            </div>
        </div>
    </form>
</section>