<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
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

if (empty($arResult["ITEMS"]))
    return;

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$this->setFrameMode(true);
$data = new \Lema\Template\TemplateHelper($this);
?>
<div class="phases">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="phases__h2">
                    <?= Loc::getMessage('LEMA_PHASES_TITLE'); ?>
                </h2>
            </div>

            <div class="col-xs-12 phases_wrapper">

                <? foreach ($data->items() as $key => $item): ?>
                    <div class="phases_wrapper__item nth<?= $key + 1; ?>" <?= $item->editId(); ?>>
                        <div class="phases_wrapper__item__img phases_wrapper__item__img_<?= $key + 1; ?>"></div>
                        <div class="phases__item__text">
                            <?= $item->previewText(); ?>
                        </div>
                    </div>
                    <? if ($key === 4) { ?>
                        <div class="clearfix hidden-xs hidden-sm"></div>
                    <? } ?>
                <? endforeach; ?>
            </div>

        </div>
    </div>
</div>