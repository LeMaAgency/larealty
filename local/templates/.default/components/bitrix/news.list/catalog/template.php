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


Loc::loadMessages(__FILE__);

$this->setFrameMode(true);

$data = new TH($this);

?>

<section class="cards-flat">

    <?if($data->itemCount()):?>
        <?if($arParams["DISPLAY_TOP_PAGER"]):?>
            <?=$arResult["NAV_STRING"]?><br />
        <?endif;?>
        <?foreach($data->items() as $item):?>
            <div class="card-flat card-flat_bg" <?=$item->editId();?> >
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <a href="<?=$item->detailUrl();?>" class="card-flat__img">
                                <img alt="<?=$item->getName();?>" src="<?=$item->previewPicture();?>">
                                <span class="card-flat__img__filter"></span>
                            </a>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-flat__content">
                                <div class="card-flat__content__head clearfix">
                                    <h3 class="card-flat__content__head__title"><?=$item->getName();?></h3>
                                    <?if($item->propFilled('PRICE')):?>
                                        <div class="card-flat__content__head__price">
                                            <b><?=H::formatPrice($item->propVal('PRICE'), null);?></b>
                                            <?=Loc::getMessage('LEMA_APARTMENTS_RUB');?>
                                        </div>
                                    <?endif;?>
                                </div>
                                <div class="offers-item-info clearfix">
                                    <?if($item->propFilled('ROOMS_COUNT')):?>
                                        <div class="item-info item-info_room">
                                            <div class="item-info__inner">
                                                <div class="item-info__inner__img item-info__inner__img_room"></div>
                                                <div class="item-info__inner__content">
                                                    <div class="item-info-name"><?=$item->propName('ROOMS_COUNT');?></div>
                                                    <div class="item-info-value"><?=$item->propVal('ROOMS_COUNT');?></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?endif;?>
                                    <?if($item->propFilled('STAGE') && $item->propFilled('STAGES_COUNT')):?>
                                        <div class="item-info item-info_floor">
                                            <div class="item-info__inner">
                                                <div class="item-info__inner__img item-info__inner__img_floor"></div>
                                                <div class="item-info__inner__content">
                                                    <div class="item-info-name"><?=$item->propName('STAGE');?></div>
                                                    <div class="item-info-value">
                                                        <?=$item->propVal('STAGE');?>/<?=$item->propVal('STAGES_COUNT');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?endif;?>
                                    <?if($item->propFilled('SQUARE')):?>
                                        <div class="item-info item-info_area">
                                            <div class="item-info__inner">
                                                <div class="item-info__inner__img item-info__inner__img_area"></div>
                                                <div class="item-info__inner__content">
                                                    <div class="item-info-name"><?=$item->propName('SQUARE');?></div>
                                                    <div class="item-info-value">
                                                        <?=$item->propVal('SQUARE');?>
                                                        <?=Loc::getMessage('LEMA_SQUARE_M_SUP');?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?endif;?>
                                </div>
                                <a href="" class="card-flat__content__favorites"><span><?=Loc::getMessage('LEMA_ADD_TO_FAVORITE');?></span></a>
                                <?if($item->get('ADDRESS')):?>
                                    <p class="card-flat__content__address icon-location">
                                        <?=$item->get('ADDRESS');?>
                                    </p>
                                <?endif;?>
                                <p class="card-flat__content__text"><?=$item->previewText();?></p>
                                <a href="<?=$item->detailUrl();?>" class="element-detail-link offers-item-more offers-item-more_text-right">
                                    <?=Loc::getMessage('LEMA_APARTMENTS_MORE_BTN');?>
                                    <i class="more-icon"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?endforeach;?>
        <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
            <?=$arResult["NAV_STRING"]?>
        <?endif;?>
    <?else:?>
        <div class="empty-section">
            <?=Loc::getMessage('LEMA_NO_OBJECTS_FOUND');?>
        </div>
    <?endif;?>
</section>