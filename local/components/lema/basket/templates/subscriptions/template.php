<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$this->setFrameMode(true);
if (!empty($arResult)):?>
    <div class="container-index">
        <div class="section-title form-title form-title"><span>Мои подписки</span></div>
    </div>
    <section class="subscription-list">
        <div class="title">
            <div class="block-left filter-field-title">Подписки и настройки</div>
            <div class="block-right filter-field-title">Почта</div>
        </div>
        <hr>
    <? foreach ($arResult as $subcription):?>
            <form action="" class="js-subscription-user" method="POST">
                <div class="it-block">
                    <div class="title">Test</div>
                    <div class="it-buttons feedback-input">
                        <input type="text" id="form_field_email" name="email" placeholder="Email"
                               class="request__form__input margin_auto">
                    </div>
                    <div class="title">Test 1</div>
                    <div class="it-buttons feedback-input">
                        <input type="text" id="form_field_email" name="email" placeholder="Email"
                               class="request__form__input margin_auto">
                    </div>
                </div>
            </form>
    <? endforeach; ?>
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