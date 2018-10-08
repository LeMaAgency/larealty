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
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$this->setFrameMode(true);
$data = new \Lema\Template\TemplateHelper($this);
?>
<section class="advantages">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="h2"><span><?=Loc::getMessage('LEMA_ADVANTAGES_APARTMENTS_TITLE');?></span></h2>
            </div>
            <? foreach($data->items() as $item): ?>
                <div class="col-sm-4 col-md-2" <?=$item->editId()?>>
                    <figure>
                        <div class="advant-img">
                            <img src="<?=$item->previewPicture();?>"
                                 alt="<?=$item->getName();?>"><?=$item->previewText();?></div>
                        <figcaption><?=$item->getName();?></figcaption>
                    </figure>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</section>