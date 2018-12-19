<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>

<section class="catalog-text assign-view-form">
    <div class="container bhelp">
        <div class="help-form">
            <form method="post" <?= $component->getFormClass(); ?> <?= $component->getFormAction(); ?>
                  enctype="multipart/form-data">
                <h2 class="section-h2">
                    <?= Loc::getMessage("LEMA_CONSULTATION_FORM"); ?>
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
                    <div id="bx_incl_area_25" class="bx-context-toolbar-empty-area"
                         title="Двойной щелчок - Редактировать область как html" style="min-height: 12px;">
                        <?= Loc::getMessage("LEMA_AGREEMENT"); ?>
                    </div>
                </div>
                <input type="checkbox" checked value="1" class="checkbox-152-fz" style="display: none;">
                <div class="it-block it-buttons help-btn">
                    <input type="submit" value="<?= $component->getBtnTitle() ?>" class="green-btn hover-black">
                </div>

            </form>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(function () {
        formAjax.init(<?=\CUtil::PhpToJSObject($arParams);?>)
    })
</script>