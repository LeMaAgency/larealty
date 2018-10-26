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

use Lema\Common\Helper as H,
    Lema\Template\TemplateHelper as TH,
    Bitrix\Main\Localization\Loc;

$data = new TH($this);

$item = $data->item();

?>

    <div class="flat-details">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <?if(!empty($arResult['SLIDER_IMAGES'])):?>
                        <div class="flat-details__slider_nav">
                            <?$first = true;
                            foreach($arResult['SLIDER_IMAGES'] as $src):?>
                                <div class="flat-details__slider_nav__item">
                                    <div class="flat-details__slider_nav__item__wrap<?if($first){$first=false;?> active<?}?>">
                                        <img src="<?=$src;?>" alt="<?=$item->getName();?>">
                                    </div>
                                </div>
                            <?endforeach;?>
                        </div>
                        <div class="flat-details__slider">
                            <?foreach($arResult['SLIDER_IMAGES'] as $src):?>
                                <div class="flat-details__slider__item">
                                    <img src="<?=$src;?>" alt="<?=$item->getName();?>">
                                </div>
                            <?endforeach;?>
                        </div>
                    <?endif;?>
                </div>
                <div class="col-md-5">
                    <div class="card-flat__content">
                        <div class="card-flat__content__head clearfix">
                            <h3 class="card-flat__content__head__title"><?=$item->getName();?></h3>
                            <div class="card-flat__content__head__price card-flat__content__head__price_details">
                                <b><?=H::formatPrice($item->propVal('PRICE'), null);?></b>
                                <?=Loc::getMessage('LEMA_APARTMENTS_RUB');?>
                            </div>
                        </div>
                        <a href="#"
                           class="card-flat__content__favorites elem-<?=$item->getId();?> <? if (isset($arResult['IN_FAVORITES'][$item->getId()])) { ?> js-favorites-delete active <? } else { ?> js-favorites-add <? } ?>"
                           data-item-id="<?=$item->getId();?>"
                           data-position-id="<?= $arResult['IN_FAVORITES'][$item->getId()];?>">
                            <span>
                                <? if (isset($arResult['IN_FAVORITES'][$item->getId()])) {
                                    echo Loc::getMessage('LEMA_DEL_TO_FAVORITE');
                                } else {
                                    echo Loc::getMessage('LEMA_ADD_TO_FAVORITE');
                                } ?>
                            </span>
                        </a>
                        <p class="card-flat__content__address icon-location"><?=$item->get('ADDRESS');?></p>
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
                                <?if($item->propFilled('STAGE')):?>
                                    <div class="item-info item-info_floor">
                                        <div class="item-info__inner">
                                            <div class="item-info__inner__img item-info__inner__img_floor"></div>
                                            <div class="item-info__inner__content">
                                                <div class="item-info-name"><?=$item->propName('STAGE');?></div>
                                                <div class="item-info-value">
                                                    <?=$item->propVal('STAGE');?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?endif;?>
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
                        <div class="card-flat__content__details">
                            <div class="card-flat__content__details__row">
                                <div class="card-flat__content__details__row__name">ID объекта</div>
                                <div class="card-flat__content__details__row__dots"></div>
                                <div class="card-flat__content__details__row__val auto-widht"><?=$item->getId();?></div>
                            </div>
                            <?php
                            $i = 0;
                            $foldedCnt = 3;
                            ?>
                            <?foreach($arResult['DISPLAY_PROPERTIES'] as $propCode => $propData):
                                if($item->propEmpty($propCode))
                                    continue;
                                if($item->prop($propCode, 'MULTIPLE') == 'Y')
                                    $value = join(', ', $item->propVal($propCode));
                                else
                                {
                                    $value = $item->propVal($propCode);
                                    $value = $value == 'Y' ? '✔' : $value;
                                }
                                $addStyle = mb_strlen($value) > 20;
                                ?>

                                <?if(++$i === $foldedCnt):?>
                                    <div class="js-collapsed" style="display: none;">
                                <?endif;?>

                                <div class="card-flat__content__details__row">
                                    <div class="card-flat__content__details__row__name"><?=$item->propName($propCode);?></div>
                                    <div class="card-flat__content__details__row__dots"></div>
                                    <div class="card-flat__content__details__row__val auto-widht"<?if($addStyle){?> style="position: static"<?}?>>
                                        <?
                                        echo $value;
                                        if(false !== strpos($propCode, 'SQUARE'))
                                            echo ' ' . Loc::getMessage('LEMA_SQUARE_M_SUP');
                                        ?>
                                    </div>
                                </div>

                            <?endforeach;?>

                            <?if($i >= $foldedCnt):?>
                                </div>
                                <a href="#" class="js-collapse-props">
                                    <span>Развернуть</span>
                                </a>
                            <?endif;?>

                        </div>
                        <div class="card-flat__content__buttons">
                            <a href="#"
                               class="card-flat__content__buttons__item js-order-viewing"
                               data-object="<?=$item->getId();?>">
                                <span><?=Loc::getMessage('LEMA_DETAIL_ORDER_VIEWING');?></span>
                            </a>
                            <a href="<?=SITE_DIR?>hypothec/#calc" class="card-flat__content__buttons__item">
                                <span><?=Loc::getMessage('LEMA_DETAIL_HYPOTHEC_BUY');?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flat-on-map">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="flat-on-map__nav">
                        <a href="#description-flat" class="flat-on-map__nav__item">
                            <span><?=Loc::getMessage('LEMA_DETAIL_DESCRIPTION_TAB_TITLE');?></span>
                        </a>
                        <a href="#location-flat" class="flat-on-map__nav__item active">
                            <span><?=Loc::getMessage('LEMA_DETAIL_MAP_TAB_TITLE');?></span>
                        </a>
                    </div>
                    <div class="flat-on-map__content" id="description-flat">
                        <p class="flat-on-map__content__text">
                            <?=$item->detailText();?>
                        </p>
                    </div>
                    <div class="flat-on-map__content active" id="location-flat">
                        <?if(!empty($arResult['PROPERTIES']['MAP']['VALUE'])):?>
                            <div class="flat-on-map__content__location" id="map-location-flat"
                                 data-coords="<?=$arResult['PROPERTIES']['MAP']['VALUE'];?>"></div>
                        <?endif;?>
                    </div>
                </div>
                <div class="col-md-4">
                    <?if(!empty($arResult['RIELTOR'])):?>
                        <div class="realtor-card">
                            <?if(!empty($arResult['RIELTOR']['IMG'])):?>
                                <div class="realtor-card__img">
                                    <img src="<?=$arResult['RIELTOR']['IMG'];?>" alt="<?=$arResult['RIELTOR']['NAME'];?>">
                                </div>
                            <?endif;?>
                            <div class="realtor-card__name"><?=$arResult['RIELTOR']['NAME'];?></div>
                            <div class="realtor-card__tagline"><?//=Loc::getMessage('LEMA_DETAIL_RIELTOR_CALL_TITLE');?></div>
                            <div class="realtor-card__tel"><?=$arResult['RIELTOR']['PHONE'];?></div>
                            <p class="realtor-card__text"><?=Loc::getMessage('LEMA_DETAIL_RIELTOR_RECALL_TITLE');?></p>
                            <form class="realtor-card__form js-rieltor-form" action="/ajax/rieltor_call.php" method="post">
                                <input type="hidden" name="element_id" value="<?=(int) $item->getId();?>">
                                <input type="hidden" name="element_name" value="<?=$item->getName();?>">
                                <input type="hidden" name="rieltor_id" value="<?=$item->propVal('RIELTOR');?>">
                                <div class="it-block">
                                    <input class="realtor-card__form__input" type="tel" name="phone"
                                           placeholder="<?=Loc::getMessage('LEMA_DETAIL_PHONE_PLACEHOLDER');?>">
                                    <div class="it-error"></div>
                                </div>
                                <button class="realtor-card__form__button" type="submit">
                                    <?=Loc::getMessage('LEMA_DETAIL_RECALL_WAIT_TITLE');?>
                                </button>
                            </form>
                        </div>
                    <?endif;?>
                </div>
            </div>
        </div>
    </div>

<?$GLOBALS['ELEM_ID_CATALOG'] = $arResult["PROPERTIES"]["RESEMBLING"]["VALUE"];?>

<?if(isset($arParams["USE_SHARE"]) && $arParams["USE_SHARE"] == "Y"):?>
    <div class="news-detail-share">
        <noindex>
        <?
        $APPLICATION->IncludeComponent("bitrix:main.share", "", array(
                "HANDLERS" => $arParams["SHARE_HANDLERS"],
                "PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
                "PAGE_TITLE" => $arResult["~NAME"],
                "SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
                "SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
                "HIDE" => $arParams["SHARE_HIDE"],
            ),
            $component,
            array("HIDE_ICONS" => "Y")
        );
        ?>
        </noindex>
    </div>
<?endif;?>