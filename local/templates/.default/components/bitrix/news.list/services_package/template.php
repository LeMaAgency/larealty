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
<div class="service-package">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="service-package__h2">
                    <?=Loc::getMessage('LEMA_SERVICES_PACKAGE_TITLE');?>
                </h2>
            </div>
            <? foreach($data->items() as $key => $item): ?>
            <div class="col-lg-2 col-md-4 col-sm-6" <?=$item->editId();?>>
                <div class="service-package__item">
                    <div class="service-package__item__img service-package__item__img_<?=$key+1;?>"></div>
                    <div class="service-package__item__text">
                        <?=$item->getName();?>
                    </div>
                </div>
            </div>
            <? endforeach; ?>
        </div>
    </div>
</div>