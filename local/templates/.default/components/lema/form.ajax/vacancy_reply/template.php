<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>
<form <?= $component->getFormClass(); ?> method="post" <?= $component->getFormAction(); ?> enctype="multipart/form-data">
        <? foreach ($component->getFields() as $field): ?>
            <div class="it-block vacancy_reply_form_input">
                <?= $component->getInput($field, array('class' => 'call-order-input')); ?>
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
<script type="text/javascript">
    $(function () {
        formAjax.init(<?=\CUtil::PhpToJSObject($arParams);?>)
    })
</script>