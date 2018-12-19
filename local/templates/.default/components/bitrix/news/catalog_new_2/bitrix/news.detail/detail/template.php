<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
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
$isOffer = false;
if (isset($_GET['offerId'], $arResult['OFFERS'][$_GET['offerId']])) {
    $isOffer = true;
    $item = new \Lema\Template\Item($arResult['OFFERS'][$_GET['offerId']]);
} elseif (!empty($arResult['OFFERS'])) {
    $offer = new \Lema\Template\Item(current($arResult['OFFERS']));
}


?>

    <h1 class='item-title'><?= $item->getName(); ?></h1>
    <div class='item-id'>ID: <?= $item->getId(); ?></div>
    </div>

    <div class='item-card_photo'>
        <? if (!empty($item->detailPicture()) || !empty($item->propVal('MORE_PHOTO'))) { ?>
            <? if (!empty($item->detailPicture())) { ?>
                <div>
                    <img src='<?= $item->detailPicture(); ?>' alt=''>
                </div>
                <?
            }
            if (!empty($item->propVal('MORE_PHOTO'))) {
                ?>
                <? foreach ($item->propVal('MORE_PHOTO') as $photoId): ?>
                    <div>
                        <img src='<?= \CFile::GetPath($photoId); ?>' alt=''>
                    </div>
                <? endforeach;
            }
        }elseif($isOffer){
            ?>
            <? foreach ($arResult['SLIDER_IMAGES'] as $imageSrc): ?>
                <div>
                    <img src='<?= $imageSrc; ?>' alt=''>
                </div>
            <? endforeach;
        } ?>
    </div>

    <div class='container'>
        <div class='item-card_info'>
            <div class='item-card_left'>
                <div class='item-card_price'>
                    <? if ($item->propVal('PRICE') || (!empty($offer) && $offer->propVal('PRICE'))) { ?>
                        <div class='item-card_price-coutn'>
                            <? if ($item->propVal('PRICE')) { ?>
                                <span>
                                <?= $item->propVal('PRICE'); ?>
                            </span>
                            <? } else { ?>
                                <span>
                                <?= $offer->propVal('PRICE'); ?>
                            </span>
                            <? } ?>
                        </div>
                        <div class='item-card_price-for'>
                            <? if (!empty($item->propVal('PRICE')) && !empty($item->propVal('SQUARE'))) { ?>
                                <span>
                                <?= intdiv($item->propVal('PRICE'), $item->propVal('SQUARE')); ?>
                            </span>
                            <? } ?>
                        </div>
                    <? } ?>
                </div>
                <!--<div class='button-currency'>
                    <div class='currency-item1'></div>
                    <div class='currency-item2'></div>
                    <div class='currency-item3'></div>
                    <div class='currency-item4'></div>
                    <div class='currency-item5'></div>
                </div>-->
            </div>
            <div class='item-card_right'>
                <div class='item-card_button'>
                    <!--<a class='hover-black' href='#'>Предложить цену</a>-->
                    <a class='hover-black js-assign-view'
                       href='#' <?= $isOffer ? 'data-offer-id=\'' . $item->getId() . '\'' : 'data-id=\'' . $item->getId() . '\''; ?>>
                        Назначить просмотр
                    </a>
                </div>
                <div class='item-card_phone'>
                    <span>Или позвоните нам: </span>
                    <a href='tel:+74954775450'>+7 (495) 477-54-50</a>
                </div>
            </div>
        </div>
        <div class='item-card_list-icon'>
            <? if (!empty($item->propVal('STAGE'))) { ?>
                <div class='item-card_icon'>
                    <img src='/assets/img/house.png' alt=''>
                    <?= $item->propVal('STAGE') ?>
                    <?= Loc::getMessage('LEMA_DETAIL_STAGE_NEW_ONE_OBJECT'); ?>
                </div>
            <? } ?>
            <? if (!empty($item->propVal('ROOMS_COUNT'))) { ?>
                <div class='item-card_icon'>
                    <img src='/assets/img/room.png' alt=''>
                    <?= \Lema\Common\Helper::pluralizeN(
                        $item->propVal('ROOMS_COUNT'),
                        array(
                            Loc::getMessage('LEMA_DETAIL_ROOMS_COUNT_NEW_ONE_OBJECT'),
                            Loc::getMessage('LEMA_DETAIL_ROOMS_COUNT_NEW_TWO_OBJECTS'),
                            Loc::getMessage('LEMA_DETAIL_ROOMS_COUNT_NEW_MANY_OBJECTS'),
                        )
                    ); ?>
                </div>
            <? } ?>
            <? if (!empty($item->propVal('FINISHING'))) { ?>
                <div class='item-card_icon'>
                    <img src='/assets/img/valik.png' alt=''>
                    <?= $item->propVal('FINISHING'); ?>
                </div>
            <? } ?>
            <? if (!empty($item->propVal('SQUARE'))) { ?>
                <div class='item-card_icon'>
                    <img src='/assets/img/area-icon.png' alt=''>
                    <?= $item->propVal('SQUARE'); ?> м²
                </div>
            <? } ?>
            <? if (!empty($item->propVal('BEDROOM'))) { ?>
                <div class='item-card_icon'>
                    <img src='/assets/img/beds.png' alt=''>
                    <?= \Lema\Common\Helper::pluralizeN(
                        $item->propVal('BEDROOM'),
                        array(
                            Loc::getMessage('LEMA_DETAIL_BEDROOM_NEW_ONE_OBJECT'),
                            Loc::getMessage('LEMA_DETAIL_BEDROOM_NEW_TWO_OBJECTS'),
                            Loc::getMessage('LEMA_DETAIL_BEDROOM_NEW_MANY_OBJECTS'),
                        )
                    ); ?>
                </div>
            <? } ?>
            <? if (!empty($item->propVal('RENT_TYPE'))) { ?>
                <div class='item-card_icon'>
                    <img src='/assets/img/room.png' alt=''>
                    <?= $item->propVal('RENT_TYPE'); ?>
                </div>
            <? } ?>
            <? if (!empty($item->propVal('LIFT_FLAG'))) { ?>
                <div class='item-card_icon'>
                    <img src='/assets/img/valik.png' alt=''>
                    С лифтом
                </div>
            <? } ?>
            <? if (!empty($item->propVal('PARKING'))) { ?>
                <div class='item-card_icon'>
                    <img src='/assets/img/area-icon.png' alt=''>
                    Паркинг
                </div>
            <? } ?>
        </div>
    </div>
    <div class='card-characteristics'>
        <div class='container'>
            <h3>Характеристики</h3>
            <div class='characteristics-list'>
                <? foreach ($arResult['PROPERTIES'] as $property) {
                    $arNotShowProp=[
                        'MAP',
                        'CML2_LINK',
                        'POPULAR',
                        'MORE_PHOTO',
                        'USER_PHONE',
                        'USER_NAME',
                        'USER_EMAIL',
                        'USER_HIDDEN_TEXT',
                        'REMINDER_DATE',
                        'REMINDER_TEXT',
                        'RIELTOR',
                        'ADD_OBJECT_TO_EXPORT',
                    ];?>
                    <? if (!empty($property['VALUE']) && !(in_array($property['CODE'],$arNotShowProp))) { ?>
                        <div class='characteristics-item'>
                            <div class='characteristics-name'>
                                <? if (!empty($property['NAME'])) { ?>
                                    <span><?= $property['NAME']; ?>:</span>
                                <? } else { ?>
                                    <span><?= $arResult['OFFER_PROP_NAME'][$property['CODE']]; ?></span>
                                <? } ?>
                            </div>
                            <div class='characteristics-info'>
                                <?= $property['VALUE']; ?>
                            </div>
                        </div>
                    <? } ?>
                <? } ?>

            </div>
            <div class='characteristics-link'>
                <!--<a href='#' class='hover-black link-presentation'>Презентация</a>
                <a href='#' class='hover-black link-plan'>Планировки</a>-->
            </div>
        </div>
    </div>
    <div class='card-item_map'>
        <? if (!empty($item->propVal('MAP'))): ?>
            <div class='flat-on-map__content__location' id='map-location-flat'
                 data-coords='<?= $item->propVal('MAP'); ?>'
                 data-address='<?= $item->propVal('ADDRESS'); ?>'>
            </div>
        <? endif; ?>

    </div>
    <div class='item-card_desc'>
        <div class='container'>
            <h2><?= $item->getName(); ?></h2>
            <p>
                <?= $item->detailText(); ?>
            </p>
            <div class='desc-link'>
                <!--<a href='#' class='hover-black link-share'>Поделиться</a>
                <a href='#' class='hover-black link-favorite'>В избранное</a>-->
            </div>
        </div>
    </div>
    </div>
    <div class='more-offer'>
        <?
        if (!empty($arResult['OFFERS']) && !$isOffer) { ?>
            <div class='container'>
                <h2>Другие предложения в <?= $item->getName(); ?></h2>
                <table class='offer-table'>
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Тип</td>
                        <td>Этаж</td>
                        <td>Кол-во комнат</td>
                        <td>Площадь, кв.м.</td>
                        <td>Цена</td>
                    </tr>
                    </thead>
                    <tbody>
                    <? $countShow = 10;
                    $i = 1;
                    foreach ($arResult['OFFERS'] as $arOffer) { ?>

                        <tr <? if ($i > $countShow){ ?>style="display:none;"<? } ?>>
                            <td>
                                <span class='dn'>
                                    ID:
                                </span>
                                <a href='<?= $APPLICATION->GetCurPageParam('offerId=' . $arOffer['ID'], ['offerId']); ?>'
                                   class='table-link'>
                                    <?= $arOffer['ID']; ?>
                                </a>
                            </td>
                            <td>
                                <span class='dn'>
                                    Тип:
                                </span>
                                <?= $arOffer['PROPERTY_REALTY_TYPE_VALUE'] ? $arOffer['PROPERTY_REALTY_TYPE_VALUE'] : '-'; ?>
                            </td>
                            <td>
                                <span class='dn'>
                                    Этаж:
                                </span>
                                <?= $arOffer['PROPERTY_STAGE_VALUE'] ? $arOffer['PROPERTY_STAGE_VALUE'] : '-'; ?>
                            </td>
                            <td>
                                <span class='dn'>
                                    Кол-во комнат:
                                </span>
                                <?= $arOffer['PROPERTY_ROOMS_COUNT_VALUE'] ? $arOffer['PROPERTY_ROOMS_COUNT_VALUE'] : '-'; ?>
                            </td>
                            <td>
                                <span class='dn'>
                                    Площадь, кв.м.:
                                </span>
                                <?= $arOffer['PROPERTY_SQUARE_VALUE'] ? $arOffer['PROPERTY_SQUARE_VALUE'] : '-'; ?>
                            </td>
                            <td>
                                <span class='dn'>
                                    Цена:
                                </span>
                                <span class='table-price'>
                                    <?= $arOffer['PROPERTY_PRICE_VALUE'] ? $arOffer['PROPERTY_PRICE_VALUE'] : '-'; ?>
                                </span>
                            </td>
                        </tr>
                        <? $i++; ?>
                    <? } ?>
                    </tbody>
                </table>
                <? if (count($arResult['OFFERS']) > $countShow) { ?>
                    <div class='more-offer_link js-show-offer'>
                        <a class='hover-black' href='#'>
                            Показать все
                            <span>
                            (
                                <?= \Lema\Common\Helper::pluralizeN(
                                    count($arResult['OFFERS']),
                                    array(
                                        Loc::getMessage('LEMA_ELEM_NEW_ONE_OBJECT'),
                                        Loc::getMessage('LEMA_ELEM_NEW_TWO_OBJECTS'),
                                        Loc::getMessage('LEMA_ELEM_NEW_MANY_OBJECTS'),
                                    )
                                ); ?>
                                )
                        </span>
                        </a>
                    </div>
                <? } ?>
            </div>
        <? } ?>
    </div>

    <!--<div class='flat-details'>
        <div class='container'>
            <div class='row'>
                <div class='col-md-7'>
                    <? /* if (!empty($arResult['SLIDER_IMAGES'])): */ ?>
                        <div class='flat-details__slider_nav'>
                            <? /* $first = true;
                            foreach ($arResult['SLIDER_IMAGES'] as $src):*/ ?>
                                <div class='flat-details__slider_nav__item'>
                                    <div class='flat-details__slider_nav__item__wrap<? /* if ($first) {
                                        $first = false; */ ?> active<? /* } */ ?>'>
                                        <img src='<? /*= $src; */ ?>' alt='<? /*= $item->getName(); */ ?>'>
                                    </div>
                                </div>
                            <? /* endforeach; */ ?>
                        </div>
                        <div class='flat-details__slider'>
                            <? /* foreach ($arResult['SLIDER_IMAGES'] as $src): */ ?>
                                <div class='flat-details__slider__item'>
                                    <img src='<? /*= $src; */ ?>' alt='<? /*= $item->getName(); */ ?>'>
                                </div>
                            <? /* endforeach; */ ?>
                        </div>
                    <? /* endif; */ ?>
                </div>
                <div class='col-md-5'>
                    <div class='card-flat__content'>
                        <div class='card-flat__content__head clearfix'>
                            <h3 class='card-flat__content__head__title'><? /*= $item->getName(); */ ?></h3>
                            <div class='card-flat__content__head__price card-flat__content__head__price_details'>
                                <? /* if (!empty($item->propVal('PRICE'))): */ ?>
                                    <b><? /*= H::formatPrice($item->propVal('PRICE'), null); */ ?></b>
                                <? /* else: */ ?>
                                    <b><? /*= H::formatPrice($offer->propVal('PRICE'), null); */ ?></b>
                                <? /* endif; */ ?>
                                <? /*= Loc::getMessage('LEMA_APARTMENTS_RUB'); */ ?>
                            </div>
                        </div>
                        <a href='#'
                           class='card-flat__content__favorites elem-<? /*= $item->getId(); */ ?> <? /* if (isset($arResult['IN_FAVORITES'][$item->getId()])) { */ ?> js-favorites-delete active <? /* } else { */ ?> js-favorites-add <? /* } */ ?>'
                           data-item-id='<? /*= $item->getId(); */ ?>'
                           data-position-id='<? /*= $arResult['IN_FAVORITES'][$item->getId()]; */ ?>'>
                            <span>
                                <? /* if (isset($arResult['IN_FAVORITES'][$item->getId()])) {
                                    echo Loc::getMessage('LEMA_DEL_TO_FAVORITE');
                                } else {
                                    echo Loc::getMessage('LEMA_ADD_TO_FAVORITE');
                                } */ ?>
                            </span>
                        </a>
                        <p class='card-flat__content__address icon-location'><? /*= $item->get('ADDRESS'); */ ?></p>
                        <div class='offers-item-info clearfix'>
                            <? /* if ($item->propFilled('ROOMS_COUNT')): */ ?>
                                <div class='item-info item-info_room'>
                                    <div class='item-info__inner'>
                                        <div class='item-info__inner__img item-info__inner__img_room'></div>
                                        <div class='item-info__inner__content'>
                                            <div class='item-info-name'><? /*= $item->propName('ROOMS_COUNT'); */ ?></div>
                                            <div class='item-info-value'><? /*= $item->propVal('ROOMS_COUNT'); */ ?></div>
                                        </div>
                                    </div>
                                </div>
                            <? /* endif; */ ?>
                            <? /* if ($item->get('IS_HOUSE_OR_LOT')): */ ?>
                                <? /* if ($item->propFilled('STAGES_COUNT')): */ ?>
                                    <div class='item-info item-info_floor'>
                                        <div class='item-info__inner'>
                                            <div class='item-info__inner__img item-info__inner__img_floor'></div>
                                            <div class='item-info__inner__content'>
                                                <div class='item-info-name'>Этажность</div>
                                                <div class='item-info-value'>
                                                    <? /*= $item->propVal('STAGES_COUNT'); */ ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <? /* endif; */ ?>
                            <? /* else: */ ?>
                                <? /* if ($item->propFilled('STAGE')): */ ?>
                                    <div class='item-info item-info_floor'>
                                        <div class='item-info__inner'>
                                            <div class='item-info__inner__img item-info__inner__img_floor'></div>
                                            <div class='item-info__inner__content'>
                                                <div class='item-info-name'><? /*= $item->propName('STAGE'); */ ?></div>
                                                <div class='item-info-value'>
                                                    <? /*= $item->propVal('STAGE'); */ ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <? /* endif; */ ?>
                            <? /* endif; */ ?>
                            <? /* if ($item->propFilled('SQUARE')): */ ?>
                                <div class='item-info item-info_area'>
                                    <div class='item-info__inner'>
                                        <div class='item-info__inner__img item-info__inner__img_area'></div>
                                        <div class='item-info__inner__content'>
                                            <div class='item-info-name'><? /*= $item->propName('SQUARE'); */ ?></div>
                                            <div class='item-info-value'>
                                                <? /*= $item->propVal('SQUARE'); */ ?>
                                                <? /*= Loc::getMessage('LEMA_SQUARE_M_SUP'); */ ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <? /* endif; */ ?>
                            <? /* if ($item->get('IS_HOUSE_OR_LOT') && $item->propFilled('SQUARE_LAND')): */ ?>
                                <div class='item-info item-info_world'>
                                    <div class='item-info__inner'>
                                        <div class='item-info__inner__img item-info__inner__img_world'></div>
                                        <div class='item-info__inner__content'>
                                            <div class='item-info-name'><? /*= $item->propName('SQUARE_LAND'); */ ?></div>
                                            <div class='item-info-value'>
                                                <? /*= $item->propVal('SQUARE_LAND'); */ ?>
                                                <? /*= Loc::getMessage('LEMA_SQUARE_M_SUP'); */ ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <? /* endif; */ ?>
                        </div>
                        <div class='card-flat__content__details'>
                            <div class='card-flat__content__details__row'>
                                <div class='card-flat__content__details__row__name'>ID объекта</div>
                                <div class='card-flat__content__details__row__dots'></div>
                                <div class='card-flat__content__details__row__val auto-widht'><? /*= $item->getId(); */ ?></div>
                            </div>
                            <?php
    /*                            $i = 0;
                                $foldedCnt = 3;
                                */ ?>
                            <? /* foreach ($arResult['DISPLAY_PROPERTIES'] as $propCode => $propData):
                            if ($item->propEmpty($propCode))
                                continue;
                            if ($item->prop($propCode, 'MULTIPLE') == 'Y')
                                $value = join(', ', $item->propVal($propCode));
                            else {
                                $value = $item->propVal($propCode);
                                $value = $value == 'Y' ? '✔' : $value;
                            }
                            $addStyle = mb_strlen($value) > 20;
                            */ ?>

                        <? /* if (++$i === $foldedCnt): */ ?>
                            <div class='js-collapsed' style='display: none;'>
                                <? /* endif;
                                */ ?>

                                <div class='card-flat__content__details__row'>
                                    <div class='card-flat__content__details__row__name'><? /*= $item->propName($propCode); */ ?></div>
                                    <div class='card-flat__content__details__row__dots'></div>
                                    <div class='card-flat__content__details__row__val auto-widht'<? /* if ($addStyle) {
                                        */ ?> style='position: static'<? /* } */ ?>>
                                        <? /*
                                        echo $value;
                                        if (false !== strpos($propCode, 'SQUARE'))
                                            echo ' ' . Loc::getMessage('LEMA_SQUARE_M_SUP');
                                        */ ?>
                                    </div>
                                </div>

                                <? /* endforeach; */ ?>

                                <? /* if ($i >= $foldedCnt): */ ?>
                            </div>
                            <a href='#' class='js-collapse-props'>
                                <span>Развернуть</span>
                            </a>
                        <? /* endif; */ ?>

                        </div>
                        <div class='card-flat__content__buttons'>
                            <a href='#'
                               class='card-flat__content__buttons__item js-order-viewing'
                               data-object='<? /*= $item->getId(); */ ?>'>
                                <span><? /*= Loc::getMessage('LEMA_DETAIL_ORDER_VIEWING'); */ ?></span>
                            </a>
                            <a href='<? /*= SITE_DIR */ ?>hypothec/#calc' class='card-flat__content__buttons__item'>
                                <span><? /*= Loc::getMessage('LEMA_DETAIL_HYPOTHEC_BUY'); */ ?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='flat-on-map'>
        <div class='container'>
            <div class='row'>
                <div class='col-md-8'>
                    <div class='flat-on-map__nav'>
                        <a href='#description-flat' class='flat-on-map__nav__item'>
                            <span><? /*= Loc::getMessage('LEMA_DETAIL_DESCRIPTION_TAB_TITLE'); */ ?></span>
                        </a>
                        <a href='#location-flat' class='flat-on-map__nav__item active'>
                            <span><? /*= Loc::getMessage('LEMA_DETAIL_MAP_TAB_TITLE'); */ ?></span>
                        </a>
                    </div>
                    <div class='flat-on-map__content' id='description-flat'>
                        <p class='flat-on-map__content__text'>
                            <? /*= $item->detailText(); */ ?>
                        </p>
                    </div>
                    <div class='flat-on-map__content active' id='location-flat'>
                        <? /* if (!empty($arResult['PROPERTIES']['MAP']['VALUE'])): */ ?>
                            <div class='flat-on-map__content__location' id='map-location-flat'
                                 data-coords='<? /*= $arResult['PROPERTIES']['MAP']['VALUE']; */ ?>'></div>
                        <? /* endif; */ ?>
                    </div>
                </div>
                <div class='col-md-4'>
                    <? /* if (!empty($arResult['RIELTOR'])): */ ?>
                        <div class='realtor-card'>
                            <? /* if (!empty($arResult['RIELTOR']['IMG'])): */ ?>
                                <div class='realtor-card__img'>
                                    <img src='<? /*= $arResult['RIELTOR']['IMG']; */ ?>' alt='<? /*= $arResult['RIELTOR']['NAME']; */ ?>'>
                                </div>
                            <? /* endif; */ ?>
                            <div class='realtor-card__name'><? /*= $arResult['RIELTOR']['NAME']; */ ?></div>
                            <div class='realtor-card__tagline'><? /* //=Loc::getMessage('LEMA_DETAIL_RIELTOR_CALL_TITLE');*/ ?></div>
                            <div class='realtor-card__tel'><? /*= $arResult['RIELTOR']['PHONE']; */ ?></div>
                            <p class='realtor-card__text'><? /*= Loc::getMessage('LEMA_DETAIL_RIELTOR_RECALL_TITLE'); */ ?></p>
                            <form class='realtor-card__form js-rieltor-form' action='/ajax/rieltor_call.php' method='post'>
                                <input type='hidden' name='element_id' value='<? /*= (int)$item->getId(); */ ?>'>
                                <input type='hidden' name='element_name' value='<? /*= $item->getName(); */ ?>'>
                                <input type='hidden' name='rieltor_id' value='<? /*= $item->propVal('RIELTOR'); */ ?>'>
                                <div class='it-block'>
                                    <input class='realtor-card__form__input' type='tel' name='phone'
                                           placeholder='<? /*= Loc::getMessage('LEMA_DETAIL_PHONE_PLACEHOLDER'); */ ?>'>
                                    <div class='it-error'></div>
                                </div>
                                <button class='realtor-card__form__button' type='submit'>
                                    <? /*= Loc::getMessage('LEMA_DETAIL_RECALL_WAIT_TITLE'); */ ?>
                                </button>
                            </form>
                        </div>
                    <? /* endif; */ ?>
                </div>
            </div>
            <div class='row'>
                <div class='container'>
                    <? /* if (!empty($arResult['OFFERS'])): */ ?>
                        <h3>Другие предложения в <? /*= $item->getName(); */ ?></h3>
                        <hr>
                        <br><br>
                        <? /* foreach ($arResult['OFFERS'] as $arOffer): */ ?>
                            <div class='row'>
                                <a href='<? /*= $APPLICATION->GetCurPageParam('offerId=' . $arOffer['ID'], ['offerId']); */ ?>'>
                                    <div class='col-md-2'><img src='<? /*= $arOffer['PREVIEW_PICTURE_SRC']; */ ?>'></div>
                                    <div class='col-md-2'>ID: <? /*= $arOffer['ID']; */ ?>/<? /*= $arOffer['XML_ID']; */ ?></div>
                                    <div class='col-md-2'><? /*= $arOffer['NAME']; */ ?></div>
                                    <div class='col-md-2'>
                                        <? /*= H::formatPrice($arOffer['PROPERTY_PRICE_VALUE'], null); */ ?>
                                        <? /*= Loc::getMessage('LEMA_APARTMENTS_RUB'); */ ?>
                                    </div>
                                </a>
                            </div>
                            <hr>
                        <? /* endforeach; */ ?>
                    <? /* endif; */ ?>
                </div>
            </div>
        </div>
    </div>-->
<? $GLOBALS['ELEM_ID_CATALOG'] = $arResult['PROPERTIES']['RESEMBLING']['VALUE'];
$GLOBALS['THIS_ELEM_ID'] = $item->getId();
$GLOBALS['THIS_OFFER_ID'] = '';
if($isOffer){
    $GLOBALS['THIS_ELEM_ID'] = $item->propVal('CML2_LINK');
    $GLOBALS['THIS_OFFER_ID'] = $item->getId();
}
$GLOBALS['REGION_ELEM_VALUE'] = $item->propVal('REGION');
$GLOBALS['PRICE_ELEM_VALUE'] = $item->propVal('PRICE') ? $item->propVal('PRICE') : (!empty($offer)?$offer->propVal('PRICE'):'');
?>

<? if (isset($arParams['USE_SHARE']) && $arParams['USE_SHARE'] == 'Y'): ?>
    <div class='news-detail-share'>
        <noindex>
            <?
            $APPLICATION->IncludeComponent('bitrix:main.share', '', array(
                'HANDLERS' => $arParams['SHARE_HANDLERS'],
                'PAGE_URL' => $arResult['~DETAIL_PAGE_URL'],
                'PAGE_TITLE' => $arResult['~NAME'],
                'SHORTEN_URL_LOGIN' => $arParams['SHARE_SHORTEN_URL_LOGIN'],
                'SHORTEN_URL_KEY' => $arParams['SHARE_SHORTEN_URL_KEY'],
                'HIDE' => $arParams['SHARE_HIDE'],
            ),
                $component,
                array('HIDE_ICONS' => 'Y')
            );
            ?>
        </noindex>
    </div>
<? endif; ?>