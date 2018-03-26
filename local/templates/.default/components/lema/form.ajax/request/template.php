<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>

<form method="post" <?= $component->getFormClass(); ?> <?= $component->getFormAction(); ?>
      enctype="multipart/form-data">
    <? foreach ($component->getFields() as $field): ?>
        <div class="it-block feedback-input">
            <?= $component->getInput($field, array('class' => 'request__form__input')); ?>
            <div class="it-error"></div>
        </div>
    <? endforeach; ?>
    <div class="it-block it-buttons feedback-input">
        <input type="submit" value="<?= $component->getBtnTitle() ?>" class="request__form__button">
    </div>
    <div class="it-block checkbox feedback-checkbox" style="border:1px solid transparent">
        <label style="margin:5px 10px;">
            <input type="checkbox" value="1" class="checkbox-152-fz">
            <?= $component->get152FZ(); ?>
        </label>
    </div>
    </button>
</form>

<script type="text/javascript">
    $(function () {
        formAjax.init(<?=\CUtil::PhpToJSObject($arParams);?>)
    })
</script>