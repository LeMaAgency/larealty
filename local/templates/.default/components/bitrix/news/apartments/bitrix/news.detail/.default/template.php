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
                        <a href="" class="card-flat__content__favorites"><span>Добавить в избранное</span></a>
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
                        <div class="card-flat__content__details">
                            <?foreach($arResult['DISPLAY_PROPERTIES'] as $propCode => $propData):
                                if($item->propEmpty($propCode))
                                    continue;
                                ?>
                                <div class="card-flat__content__details__row">
                                    <div class="card-flat__content__details__row__name"><?=$item->propName($propCode);?></div>
                                    <div class="card-flat__content__details__row__dots"></div>
                                    <div class="card-flat__content__details__row__val"><?=$item->propVal($propCode);?></div>
                                </div>
                            <?endforeach;?>
                        </div>
                        <div class="card-flat__content__buttons">
                            <a href="#" class="card-flat__content__buttons__item"><span>Записаться на просмотр</span></a>
                            <a href="#" class="card-flat__content__buttons__item"><span>Купить в ипотеку</span></a>
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
                        <a href="#description-flat" class="flat-on-map__nav__item"><span>Описание</span></a>
                        <a href="#location-flat" class="flat-on-map__nav__item active"><span>Объект на карте</span></a>
                    </div>
                    <div class="flat-on-map__content" id="description-flat">
                        <p class="flat-on-map__content__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis est sit adipisci debitis, ipsa obcaecati eveniet laborum velit animi perspiciatis ex consectetur necessitatibus cum officiis quod iure dolor, vitae ad?</p>
                    </div>
                    <div class="flat-on-map__content active" id="location-flat">
                        <div class="flat-on-map__content__location" id="map-location-flat"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="realtor-card">
                        <div class="realtor-card__img"><img src="/assets/img/realtors/realtor.png" alt=""></div>
                        <div class="realtor-card__name">Иванова Юлия</div>
                        <div class="realtor-card__tagline">Связаться со мной!</div>
                        <div class="realtor-card__tel">+7922 039 - 21 -68</div>
                        <p class="realtor-card__text">или оставьте ваш номер, и я перезвонию вам в ближайшее время</p>
                        <form class="realtor-card__form" action="#">
                            <input class="realtor-card__form__input" type="tel" name="realtor-tel" placeholder="Ваш телефон">
                            <button class="realtor-card__form__button" type="submit">Жду звонка</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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