<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>

<div class="container-index">
    <div class="top-slider-mobile-form">
        <a data-fancybox data-src="#call-order-mobile-form" href="javascript:;" class="call-order-link">
            <?= Loc::getMessage("LEMA_FEEDBACK_ORDER_CALL"); ?>
        </a>
    </div>
    <div class="top-slider-form">
        <form method="post" <?= $component->getFormClass(); ?> <?= $component->getFormAction(); ?>
              enctype="multipart/form-data">
            <div class="call-order-title">
                <?= Loc::getMessage("LEMA_FEEDBACK_BACK_CALL"); ?>
            </div>
            <? foreach ($component->getFields() as $field): ?>
                <div class="it-block">
                    <div class="it-error"></div>
                </div>
            <? endforeach; ?>
            <div class="it-block checkbox" style="border:1px solid transparent">
                <label style="margin:5px 10px;">
                    <input type="checkbox" value="1" class="checkbox-152-fz">
                    <?=$component->get152FZ();?>
                </label>
            </div>
            <div class="it-block it-buttons">
                <input type="submit" value="<?= $component->getBtnTitle() ?>" class="green-btn">
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        formAjax.init(<?=\CUtil::PhpToJSObject($arParams);?>)
    })
</script>