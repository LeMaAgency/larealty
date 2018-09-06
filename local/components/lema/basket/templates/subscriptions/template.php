<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$this->setFrameMode(true);
if (!empty($arResult['ITEMS'])):?>
    <div class="container-index">
        <div class="section-title form-title form-title"><span>Мои подписки</span></div>
    </div>
    <section class="subscription-list">
        <div class="title col-md-12">
            <div class="col-md-10 filter-field-title">Подписки и настройки</div>
            <div class="col-md-2 filter-field-title">Почта</div>
        </div>
        <? foreach ($arResult['ITEMS'] as $key => $arItem): ?>
            <div class="js-subscribe-block">
                <hr class="col-md-12">
                <div class="subscription-user col-md-12" data-id="<?= $arItem['ID']; ?>">
                    <div class="left-block col-md-10">
                        <div class="title">
                            <a href="<?= $arItem['UF_LINK']; ?>">
                                Объявления:<span> <?= $arItem['UF_TITLE']; ?></span>
                            </a>
                        </div>
                        <div class="title ext-title">
                            <?= $arItem['UF_EXT_TITLE']; ?>
                        </div>
                        <div class="settings js-settings" data-id="#setting_<?= $arItem['ID']; ?>">
                            <a href="#">
                                Настройки
                            </a>
                        </div>
                        <div class="settings-popup" id="setting_<?= $arItem['ID']; ?>" style="display: none;">
                            <div class="setting-title-block">
                                <p class="title">
                                    Настройка уведомлений для подписки
                                </p>
                                <p class="params">
                                    Объявления:<span> <?= $arItem['UF_TITLE']; ?></span>
                                </p>
                                <p class="ext-params">
                                    <?= $arItem['UF_EXT_TITLE']; ?>
                                </p>
                            </div>
                            <hr>
                            <div class="setting-input-block">
                                <div class="it-block mail-block col-md-6">
                                    <p>Почта</p>
                                    <input type="text"
                                           placeholder="Введите почту"
                                           data-default="<?= $arItem['UF_EMAIL']; ?>"
                                           value="<?= $arItem['UF_EMAIL']; ?>"
                                            name="EMAIL">
                                    <div class="it-error">
                                    </div>
                                </div>
                                <div class="frequency-block col-md-6">
                                    <p>Присылать не чаще, чем раз в
                                        <span class="js-frequency-block-value"
                                              data-value="<?= $arItem['UF_FREQUENCY_SEND']; ?>"
                                              data-default="<?= $arItem['UF_FREQUENCY_SEND']; ?>">
                                        </span>
                                    </p>
                                    <div class="js-frequency-send">
                                    </div>
                                </div>
                                <div class="button-block">
                                    <button class="green-btn cancel">Отмена</button>
                                    <button type="submit"
                                            class="green-btn js-subscribe-settings-save"
                                            name="save"
                                            data-id="<?=$arItem['ID'];?>">
                                        Сохранить
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="right-block col-md-2">
                        <div class="tumbler-block">
                            <p class="js-subscribe-tumbler-value">
                                <?= $arItem['UF_ENABLE_SEND'] ? 'Откл.' : 'Вкл.'; ?>
                            </p>
                            <div class="tumbler js-subscribe-tumbler" data-default="<?= $arItem['UF_ENABLE_SEND']; ?>">
                            </div>
                        </div>
                        <div class="del js-subscribe-delete-popup">
                            <a href="#">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
        <div id="del-popup">
            Вы действительно хотите удалить данную подписку?
            <div class="button-block">
                <button class="green-btn cancel">Отмена</button>
                <button class="green-btn delete js-subscribe-delete">
                    Удалить
                </button>
            </div>
        </div>
    </section>
<? else: ?>
    <section class="offers">
        <div class="container-index">
            <div style="padding: 15px">
                У Вас пока нет подписок. Сохраняйте свой поисковый запрос во время поиска недвижимости на сайте.
            </div>
        </div>
    </section>
<? endif; ?>