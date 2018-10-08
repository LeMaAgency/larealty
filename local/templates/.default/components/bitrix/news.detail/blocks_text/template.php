<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

$item =$data->item();?>
<div class="<?=$item->get("CODE");?>">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2 class="we-check-history__title">
                    <?=$item->previewText();?>
                </h2>
                <p class="we-check-history__text">
                    <?=$item->detailText();?>
                </p>
            </div>
        </div>
    </div>
</div>
