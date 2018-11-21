<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>
<section class="catalog-text assign-view-form">
    <div class="container bhelp">
        <div class="help-form">
            <form method="post" <?= $component->getFormClass(); ?> <?= $component->getFormAction(); ?>>
            <h2 class="section-h2">
                <?= Loc::getMessage("LEMA_FEEDBACK_ORDER_CALL"); ?>
            </h2>
            <? foreach ($component->getFields() as $field): ?>
                <div class="form-row">
                    <div class="it-block">
                        <?= $component->getInput($field, array('class' => '')); ?>
                        <div class="it-error"></div>
                    </div>
                </div>
            <? endforeach; ?>

            <div class="help-consent">
                Нажимая на кнопку «Отправить», Вы даете согласие на обработку персональных данных<br>
                в соответствии с <a href="#">«Положением об обработке персональных данных»</a>
            </div>
            <div class="help-btn">
                <button class="hover-black">
                    <?= $component->getBtnTitle() ?>
                </button>
            </div>
            </form>


            <script type="text/javascript">
                $(function () {
                    formAjax.init(<?=\CUtil::PhpToJSObject($arParams);?>)
                })
            </script>
        </div>
    </div>
</section>