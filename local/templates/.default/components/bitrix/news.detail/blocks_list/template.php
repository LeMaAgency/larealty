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
        <div class="<?=$item->get("CODE");?>__wrap">
            <div class="row">
                <div class="col-md-9 col-lg-7">
                    <h2 class="favorably__h2">
                        <?=$item->previewText();?>
                    </h2>
                </div>
                <div class="col-md-6">
                    <ol class="<?=$item->get("CODE");?>__list">
                        <?foreach ($item->propVal("LIST_ELEMENTS") as $key => $propLE):?>
                        <li class="<?=$item->get("CODE");?>__list__item <?=$item->get("CODE");?>__list__item_<?=$key+1;?>">
                            <?if($propLE['TYPE'] === "TEXT"){
                                echo $propLE['TEXT'];
                            }else{
                                echo htmlspecialcharsBack($propLE['TEXT']);
                            }
                            ?>
                        </li>
                        <?endforeach;?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

