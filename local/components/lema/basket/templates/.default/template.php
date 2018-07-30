<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Lema\Common\Helper as H,
    Lema\Template\TemplateHelper as TH,
    Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$this->setFrameMode(true);

$data = new TH($this);

$data->setShowMoreScript();

$basket = new \Lema\Basket\Basket();
if ($basket->hasProducts()):?>

    <section class="offers">
        <div class="container-index">
            <div class="section-title"><span>Избранное</span></div>
        </div>
        <div class="container-index no-pad">
            <div class="offers-filter">
                <div class="offers-filter-btn hvr-shutter-out-vertical" data-realty-type="26">Квартиры</div>
                <div class="offers-filter-btn hvr-shutter-out-vertical" data-realty-type="28, 29, 30">Загородная
                    недвижимость
                </div>
                <div class="offers-filter-btn hvr-shutter-out-vertical" data-rent-type="29">Аренда</div>
            </div>

            <div class="offers-list js-favorites-list" data-ajax-block-id="<?= $arParams['AJAX_ID']; ?>">
                <? if (\Lema\Common\Request::get()->isAjaxRequest())
                    $APPLICATION->RestartBuffer(); ?>
                <? foreach ($basket->getProducts() as $item): ?>
                    <div class="card-flat add-bg-on-hover js-elem-favorites favorites-elem-<?= $item['PRODUCT_ID']; ?>"
                         data-rent-type="<?= (int)$item['RENT_TYPE']['ENUM_ID']; ?>"
                         data-realty-type="<?= (int)$item['IBLOCK_SECTION_ID']; ?>">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-4">
                                    <a href="<?= str_replace(
                                        '#RENT_TYPE#',
                                        $arResult['RENT_TYPE'][$item['RENT_TYPE']['ENUM_ID']]['XML_ID'],
                                        $item['DETAIL_PAGE_URL']
                                    ); ?>"
                                       class="card-flat__img">
                                        <img alt="<?= $item['NAME']; ?>"
                                             src="<?= \CFile::GetPath($item['PREVIEW_PICTURE']); ?>">
                                        <span class="card-flat__img__filter"></span>
                                    </a>
                                </div>
                                <div class="col-sm-8">
                                    <div class="card-flat__content">
                                        <div class="card-flat__content__head clearfix">
                                            <h3 class="card-flat__content__head__title"><?= $item['NAME']; ?></h3>
                                            <? if (isset($item['PRICE'])): ?>
                                                <div class="card-flat__content__head__price">
                                                    <b><?= H::formatPrice($item['PRICE'], null); ?></b>
                                                    <?= Loc::getMessage('LEMA_FAVORITES_RUB'); ?>
                                                </div>
                                            <? endif; ?>
                                        </div>
                                        <div class="offers-item-info clearfix">
                                            <? if (!empty($item['ROOMS_COUNT'])): ?>
                                                <div class="item-info item-info_room">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_room"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name"><?= Loc::getMessage('LEMA_FAV_ROOMS_COUNT'); ?></div>
                                                            <div class="item-info-value"><?= $item['ROOMS_COUNT']; ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <? endif; ?>
                                            <? if (isset($item['IS_HOUSE_OR_LOT'])): ?>
                                                <? if (!empty($item['STAGES_COUNT'])): ?>
                                                    <div class="item-info item-info_floor">
                                                        <div class="item-info__inner">
                                                            <div class="item-info__inner__img item-info__inner__img_floor"></div>
                                                            <div class="item-info__inner__content">
                                                                <div class="item-info-name">Этажность</div>
                                                                <div class="item-info-value">
                                                                    <?= $item['STAGES_COUNT']; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <? endif; ?>
                                            <? else: ?>
                                                <? if (!empty($item['STAGE']) && !empty($item['STAGES_COUNT'])): ?>
                                                    <div class="item-info item-info_floor">
                                                        <div class="item-info__inner">
                                                            <div class="item-info__inner__img item-info__inner__img_floor"></div>
                                                            <div class="item-info__inner__content">
                                                                <div class="item-info-name"><?= Loc::getMessage('LEMA_FAV_STAGE'); ?></div>
                                                                <div class="item-info-value">
                                                                    <?= $item['STAGE']; ?>/<?= $item['STAGES_COUNT']; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <? endif; ?>
                                            <? endif; ?>
                                            <? if (!empty($item['SQUARE'])): ?>
                                                <div class="item-info item-info_area">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_area"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name"><?= Loc::getMessage('LEMA_FAV_SQUARE'); ?></div>
                                                            <div class="item-info-value">
                                                                <?= $item['SQUARE']; ?>
                                                                <?= Loc::getMessage('LEMA_SQUARE_M_SUP'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <? endif; ?>
                                            <? if (isset($item['IS_HOUSE_OR_LOT']) && !empty($item['SQUARE_LAND'])): ?>
                                                <div class="item-info item-info_world">
                                                    <div class="item-info__inner">
                                                        <div class="item-info__inner__img item-info__inner__img_world"></div>
                                                        <div class="item-info__inner__content">
                                                            <div class="item-info-name"><?= Loc::getMessage('LEMA_FAV_SQUARE_LAND'); ?></div>
                                                            <div class="item-info-value">
                                                                <?= $item['SQUARE_LAND']; ?>
                                                                <?= Loc::getMessage('LEMA_SQUARE_M_SUP'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <? endif; ?>
                                        </div>
                                        <a href=""
                                           class="card-flat__content__favorites js-favorites-delete active elem-<?= $item['PRODUCT_ID']; ?>"
                                           data-item-id="<?= $item['PRODUCT_ID']; ?>"
                                           data-position-id="<?= $arResult['IN_FAVORITES'][$item['PRODUCT_ID']]; ?>">
                                            <span>
                                                <?= Loc::getMessage('LEMA_DEL_TO_FAVORITE'); ?>
                                            </span>
                                        </a>
                                        <? if (isset($arResult['ADDRESS'][$item['PRODUCT_ID']])): ?>
                                            <p class="card-flat__content__address icon-location">
                                                <?= $arResult['ADDRESS'][$item['PRODUCT_ID']]; ?>
                                            </p>
                                        <? endif; ?>
                                        <p class="card-flat__content__text"><?= $item['PREVIEW_TEXT']; ?></p>
                                        <a href="<?= $item['DETAIL_PAGE_URL']; ?>"
                                           class="element-detail-link offers-item-more offers-item-more_text-right">
                                            <?= Loc::getMessage('LEMA_FAVORITES_MORE_BTN'); ?>
                                            <i class="more-icon"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
                <? if (\Lema\Common\Request::get()->isAjaxRequest())
                    exit; ?>
            </div>


            <? /* if ($data->hasPagination()): */
            ?><!--
                    <a href="#"
                       class="offers-show-more js-th-show-more"
                        <? /*= $data->getShowMoreDataAttribs(); */
            ?>>
                        <span class="link-hvr">Показать больше</span>
                        <i class="offers-show-more-icon"></i>
                    </a>
                --><? /* endif; */
            ?>

        </div>
    </section>

<? else: ?>
    <section class="offers">
    <div class="container-index">
        <div style="padding: 15px">
            <?= Loc::getMessage('BASKET_EMPTY_BASKET'); ?>
        </div>
    </div>
    </section>
<? endif; ?>