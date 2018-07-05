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

global $arrResemblingFilter;
if(empty($arParams['THE_BEST']) && !($arrResemblingFilter['ID']))
    return;

use Lema\Common\Helper as H,
    Lema\Template\TemplateHelper as TH,
    Bitrix\Main\Localization\Loc;

$data = new TH($this);

?>

<section class="offers offers_padding">
    <div class="container-index">
        <div class="section-title<?=empty($arParams['IS_RENT']) ? '' : ' section-title_rent';?>">
            <span>
                <?= Loc::getMessage(empty($arParams['THE_BEST']) ? 'LEMA_RESEMBLING_TITLE' : 'LEMA_THE_BEST_TITLE'); ?>
            </span>
        </div>
    </div>
    <div class="container-index no-pad">
        <div class="offers-list">
            <? foreach ($data->items() as $item): ?>
                <a href="<?= $item->detailUrl(); ?>"
                   class="offers-item">
                    <h3 class="offers-item__h3">
                        <?= $item->getName(); ?>
                    </h3>
                    <div class="offers-item-img">
                        <img src="<?= $item->previewPicture("SRC"); ?>" alt="img">
                    </div>
                    <div class="offers-item-price">
                        <b>
                            <?= H::formatPrice($item->propVal('PRICE'), null); ?>
                        </b>
                        <?= Loc::getMessage('LEMA_RESEMBLING_APARTMENTS_RUB'); ?>
                    </div>

                    <? if ($item->propFilled('ROOMS_COUNT')): ?>
                    <div class="offers-item-info clearfix">
                        <div class="item-info item-info_room">
                            <div class="item-info__inner">
                                <div class="item-info__inner__img item-info__inner__img_room"></div>
                                <div class="item-info__inner__content">
                                    <div class="item-info-name">
                                        <?= $item->propName("ROOMS_COUNT"); ?>
                                    </div>
                                    <div class="item-info-value">
                                        <?= $item->propVal("ROOMS_COUNT"); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <? endif; ?>
                        <?if($item->get('IS_HOUSE_OR_LOT')):?>
                            <?if($item->propFilled('STAGES_COUNT')):?>
                                <div class="item-info item-info_floor">
                                    <div class="item-info__inner">
                                        <div class="item-info__inner__img item-info__inner__img_floor"></div>
                                        <div class="item-info__inner__content">
                                            <div class="item-info-name">Этажность</div>
                                            <div class="item-info-value">
                                                <?=$item->propVal('STAGES_COUNT');?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?endif;?>
                        <?else:?>
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
                        <?endif;?>
                        <? if ($item->propFilled('SQUARE')): ?>
                            <div class="item-info item-info_area">
                                <div class="item-info__inner">
                                    <div class="item-info__inner__img item-info__inner__img_area"></div>
                                    <div class="item-info__inner__content">
                                        <div class="item-info-name">
                                            <?= Loc::getMessage("LEMA_RESEMBLING_SQUARE"); ?>
                                        </div>
                                        <div class="item-info-value">
                                            <?= $item->propVal('SQUARE'); ?>
                                            <?= Loc::getMessage('LEMA_RESEMBLING_SQUARE_M_SUP'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <? endif; ?>

                        <?if($item->get('IS_HOUSE_OR_LOT') && $item->propFilled('SQUARE_LAND')):?>
                            <div class="item-info item-info_world">
                                <div class="item-info__inner">
                                    <div class="item-info__inner__img item-info__inner__img_world"></div>
                                    <div class="item-info__inner__content">
                                        <div class="item-info-name"><?=$item->propName('SQUARE_LAND');?></div>
                                        <div class="item-info-value">
                                            <?=$item->propVal('SQUARE_LAND');?>
                                            <?=Loc::getMessage('LEMA_SQUARE_M_SUP');?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?endif;?>
                    </div>
                    <div class="offers-item-location">
                        <?= $item->get('ADDRESS'); ?>
                    </div>
                    <div class="offers-item-more">
                        <?= Loc::getMessage("LEMA_RESEMBLING_APARTMENTS_MORE_BTN"); ?>
                        <i class="more-icon"></i>
                    </div>
                </a>
            <? endforeach; ?>
        </div>
    </div>
</section>