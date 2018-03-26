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

$this->setFrameMode(true);
$data = new \Lema\Template\TemplateHelper($this);
?>
<div class="row">
    <? foreach ($data->items() as $key => $item): ?>
        <div class="col-xs-12 col-sm-6 col-md-3" <?=$item->editId();?>>
            <h4 class="seller_main__h4 seller_main__h4_<?=$key+1;?>">
                <?=$item->getName();?>
            </h4>
            <div class="seller_main__text">
                <?=$item->previewText();?>
            </div>
        </div>
    <? endforeach; ?>
</div>