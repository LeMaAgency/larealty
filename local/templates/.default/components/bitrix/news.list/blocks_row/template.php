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

use Lema\Common\Helper as H,
    Lema\Template\TemplateHelper as TH,
    Bitrix\Main\Localization\Loc;

if(empty($arResult['ITEMS']))
    return ;

Loc::loadMessages(__FILE__);

$this->setFrameMode(true);

$data = new TH($this);

?>
<?foreach ($data->items() as $item):?>
    <div class="col-xs-12 col-sm-4"  <?=$item->editId();?>>
        <div class="<?=$item->get("CODE");?>__item">
            <div class="<?=$item->get("CODE");?>__icon">
                <img src="<?=$item->previewPicture()?>">
            </div>
            <div class="<?=$item->get("CODE");?>__text"><?=$item->get('NAME')?></div>
        </div>
    </div>
<?endforeach;?>