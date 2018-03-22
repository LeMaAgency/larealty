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
$data = new \Lema\Template\TemplateHelper($this);
?>
<div class="top-slider owl-carousel">
    <? foreach ($data->items() as $item): ?>
        <div class="top-slide" style="background-image: url('<?= $item->previewPicture(); ?>');"
            <?= $item->editId() ?>>
            <div class="top-slide__banner <? if ($item->propXmlId('SHARE') === 'Y') { ?>top-slide__banner_action<? } ?>">
                <div class="top-slide__banner__bg"></div>
                <div class="top-slide__banner__title"><?= $item->getName(); ?></div>
                <div class="top-slide__banner__text">
                    <?= $item->previewText(); ?>
                </div>
            </div>
        </div>
    <? endforeach; ?>
</div>