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
<section class="benefits">

    <div class="container-index">
        <div class="section-title">
            <span>
                <? $APPLICATION->IncludeFile(SITE_DIR . 'include/old/main/benefits.php'); ?>
            </span>
        </div>
    </div>
    <div class="container-index benefits-list no-pad">
        <? foreach ($data->items() as $item): ?>
            <div class="benefits-item"
                 style="background-image: url('<?= $item->previewPicture(); ?>');"
                <?= $item->editId(); ?>
            >
                <div class="benefits-info">
                    <div class="benefits-title">
                        <?= $item->getName(); ?>
                    </div>
                    <div class="benefits-descr">
                        <?= $item->previewText(); ?>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</section>
