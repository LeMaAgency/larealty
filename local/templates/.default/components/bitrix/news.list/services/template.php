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
if(empty($arResult["ITEMS"]))
    return;
$data = new \Lema\Template\TemplateHelper($this);
?>
<section class="services container-index no-pad">
    <? foreach ($data->items() as $item): ?>
        <div class="services-item" <?= $item->editId() ?>>
            <div class="services-item-img">
                <img alt="img" src="<?= $item->previewPicture(); ?>">
            </div>
            <div class="services-item-title">
                <?= $item->getName(); ?>
            </div>
            <div class="services-item-descr">
                <?= $item->previewText(); ?>
            </div>
        </div>
    <? endforeach; ?>
</section>
