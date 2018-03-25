<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>
<form method="post" <?= $component->getFormAction(); ?> enctype="multipart/form-data">
    <div class="row">
        <? foreach ($component->getFields() as $field): ?>
            <div class="col-xs-12 input it-block">
                <?= $component->getInput($field, array()); ?>
                <div class="it-error"></div>
            </div>
        <? endforeach; ?>
        <div class="col-xs-12 input it-block">
            <textarea name="message" id="form_field_message" placeholder="Текст сообщения" required></textarea>
            <div class="it-error"></div>
        </div>
    </div>
    <div class="it-block checkbox" style="border:1px solid transparent">
        <label style="margin:5px 10px;">
            <input type="checkbox" value="1" class="checkbox-152-fz">
            <?=$component->get152FZ();?>
        </label>
    </div>
    <div class="it-block it-buttons">
        <input type="submit" value="<?= $component->getBtnTitle() ?>">
    </div>
</form>
<script type="text/javascript">
    $(function () {
        formAjax.init(<?=\CUtil::PhpToJSObject($arParams);?>)
    })
</script>