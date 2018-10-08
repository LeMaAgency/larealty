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
if (empty($arResult["ITEMS"]))
    return;
$data = new \Lema\Template\TemplateHelper($this);
?>
<div class="rent-feature">
    <div class="container">
        <div class="row">
            <? foreach ($data->items() as $key => $item): ?>
                <div class="col-sm-4" <?= $item->editId() ?>>
                    <div class="rent-feature__img rent-feature__img_<?= $key+1; ?>"></div>
                    <div class="rent-feature__content">
                        <div class="rent-feature__content__number">
                            0<?= $key+1; ?>
                        </div>
                        <div class="rent-feature__content__title">
                            <?=$item->getName(); ?>
                        </div>
                        <p class="rent-feature__content__text">
                            <?= $item->previewText(); ?>
                        </p>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</div>


