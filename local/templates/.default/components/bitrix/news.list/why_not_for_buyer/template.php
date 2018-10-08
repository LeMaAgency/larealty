<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
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

if(empty($arResult["ITEMS"]))
    return;

$this->setFrameMode(true);
$data = new \Lema\Template\TemplateHelper($this);
?>
<div class="row">
    <? foreach ($data->items() as $key => $item):?>
    <div class="col-md-5 col-sm-6">
        <h4 class="why-not__h4 why-not__h4_<?=$key+1;?>">
            <?=$item->getName();?>
        </h4>
        <p class="why-not__text">
            <?=$item->previewText();?>
        </p>
    </div>
    <?endforeach;?>
</div>