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
$codeItem = "";
$item = $data->item(); ?>
<?if($item->get("CODE") == '_landlord'){
    $codeItem = $item->get("CODE");
}?>
<div class="tenant<?=$codeItem;?>">
    <div class="container">
        <div class="tenant__wrap">
            <div class="tenant__wrap__bg<?=$codeItem;?>"></div>
            <div class="row">
                <div class="col-md-6 <?if(!empty($codeItem)){?>col-md-offset-6<?}?>">
                    <h2 class="tenant__h2">
                        <?= $item->previewText(); ?>
                    </h2>
                    <ul class="tenant__list">
                        <? foreach ($item->propVal("LIST_ELEMENTS") as $key => $propLE): ?>
                            <li class="tenant__list__elem">
                                <? if ($propLE['TYPE'] === "TEXT") {
                                    echo $propLE['TEXT'];
                                } else {
                                    echo htmlspecialcharsBack($propLE['TEXT']);
                                }
                                ?>
                            </li>
                        <? endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>