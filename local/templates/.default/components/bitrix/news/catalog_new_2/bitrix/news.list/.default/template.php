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

use \Lema\Common\Helper,
    \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
if (!empty($arResult['ITEMS'])) {
    foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>

        <!-- Вывод товаров -->
        <div class="catalog-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div class="col-md-4">
                <div class="catalog-item_photo">
                    <img src="<?= !empty($arItem['PREVIEW_PICTURE']['SRC']) ? $arItem['PREVIEW_PICTURE']['SRC'] : SITE_DIR . "assets/img/no-photo.jpg"; ?>"
                         alt="photo">
                </div>
            </div>
            <div class="col-md-8">
                <div class="catalog-item_info">
                    <div class="catalog-item_left">
                        <div class="catalog-item_title">
                            <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="name">
                                <span>
                                    <?= $arItem['NAME']; ?>
                                </span>
                                <i class="click-area"></i>
                            </a>
                            <div class="id">ID: <?= $arItem['ID']; ?></div>
                        </div>
                        <? if (!empty($arItem['PROPERTIES']['REALTY_TYPE']['VALUE']) || !empty($arItem['PROPERTIES']['ADDRESS']['VALUE'])) { ?>
                            <div class="catalog-item_adress">
                                <img src="/assets/img/location-icon.png" alt="">
                                <?= !empty($arItem['PROPERTIES']['REALTY_TYPE']['VALUE']) ? $arItem['PROPERTIES']['REALTY_TYPE']['VALUE'] : ''; ?>
                                <?= !empty($arItem['PROPERTIES']['REALTY_TYPE']['VALUE']) && !empty($arItem['PROPERTIES']['ADDRESS']['VALUE']) ? ', ' : ''; ?>
                                <?= !empty($arItem['PROPERTIES']['ADDRESS']['VALUE']) ? $arItem['PROPERTIES']['ADDRESS']['VALUE'] : ''; ?>
                            </div>
                        <? } ?>
                        <div class="catalog-item_icon-list">

                            <? if (!empty($arItem['PROPERTIES']['STAGE']['VALUE'])) { ?>
                                <div class="catalog-item_icon">
                                    <img src="/assets/img/house.png" alt="">
                                    <?= \Lema\Common\Helper::pluralizeN(
                                        $arItem['PROPERTIES']['STAGE']['VALUE'],
                                        array(
                                            Loc::getMessage('LEMA_STAGE_NEW_ONE_OBJECT'),
                                            Loc::getMessage('LEMA_STAGE_NEW_TWO_OBJECTS'),
                                            Loc::getMessage('LEMA_STAGE_NEW_MANY_OBJECTS'),
                                        )
                                    ); ?>
                                </div>
                            <? } ?>
                            <? if (!empty($arItem['PROPERTIES']['ROOMS_COUNT']['VALUE'])) { ?>
                                <div class="catalog-item_icon">
                                    <img src="/assets/img/room.png" alt="">
                                    <?= \Lema\Common\Helper::pluralizeN(
                                        $arItem['PROPERTIES']['ROOMS_COUNT']['VALUE'],
                                        array(
                                            Loc::getMessage('LEMA_ROOMS_COUNT_NEW_ONE_OBJECT'),
                                            Loc::getMessage('LEMA_ROOMS_COUNT_NEW_TWO_OBJECTS'),
                                            Loc::getMessage('LEMA_ROOMS_COUNT_NEW_MANY_OBJECTS'),
                                        )
                                    ); ?>
                                </div>
                            <? } ?>
                            <? if (!empty($arItem['PROPERTIES']['FINISHING']['VALUE'])) { ?>
                                <div class="catalog-item_icon">
                                    <img src="/assets/img/valik.png" alt="">
                                    <?= $arItem['PROPERTIES']['FINISHING']['VALUE']; ?>
                                </div>
                            <? } ?>
                            <? if (!empty($arItem['PROPERTIES']['SQUARE']['VALUE'])) { ?>
                                <div class="catalog-item_icon">
                                    <img src="/assets/img/area-icon.png" alt="">
                                    <?= $arItem['PROPERTIES']['SQUARE']['VALUE']; ?> м²
                                </div>
                            <? } ?>
                            <? if (!empty($arItem['PROPERTIES']['BEDROOM']['VALUE'])) { ?>
                                <div class="catalog-item_icon">
                                    <img src="/assets/img/beds.png" alt="">
                                    <?= \Lema\Common\Helper::pluralizeN(
                                        $arItem['PROPERTIES']['BEDROOM']['VALUE'],
                                        array(
                                            Loc::getMessage('LEMA_BEDROOM_NEW_ONE_OBJECT'),
                                            Loc::getMessage('LEMA_BEDROOM_NEW_TWO_OBJECTS'),
                                            Loc::getMessage('LEMA_BEDROOM_NEW_MANY_OBJECTS'),
                                        )
                                    ); ?>
                                </div>
                            <? } ?>
                        </div>
                        <div class="catalog-item_desc">
                            <?= $arItem['PREVIEW_TEXT']; ?>
                        </div>
                    </div>
                    <div class="catalog-item_right">
                        <div class="catalog-item_label">
                            <? if (!empty($arItem['PROPERTIES']['RENT_TYPE']['VALUE'])) { ?>
                                <span class="type-label">
                                    <?= $arItem['PROPERTIES']['RENT_TYPE']['VALUE']; ?>
                                </span>
                            <? } ?>
                        </div>

                        <? if (!empty($arItem['PROPERTIES']['PRICE']['VALUE'])) { ?>
                            <div class="fdc">
                                <div class="catalog-item_price">
                                    <span>
                                        <?= $arItem['PROPERTIES']['PRICE']['VALUE']; ?>
                                    </span>
                                </div>
                                <? if (!empty($arItem['PROPERTIES']['SQUARE']['VALUE'])) { ?>
                                    <div class="catalog-item_price-for">
                                        <span>
                                            <?= intdiv($arItem['PROPERTIES']['PRICE']['VALUE'], $arItem['PROPERTIES']['SQUARE']['VALUE']); ?>
                                        </span>
                                    </div>
                                <? } ?>
                            </div>
                        <? } ?>
                        <div class="catalog-item_link">
                            <a class="hover-black" href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
                                <?= Loc::getMessage('LEMA_MORE_INFO_NEW'); ?>
                            </a>
                        </div>
                    </div>
                    <a class="favorite-catalog"
                       href="#">
                        <img src="/assets/img/favorite.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    <? endforeach; ?>


    <div class="mobile-catalog">
        <div class="row">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="col-xl-4 col-md-6" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <div class="offer-item">
                        <div class="offer-title">
                            <a href="<?=$arItem['DETAIL_PAGE_URL'];?>">
                            <span>
                                <?= $arItem['NAME']; ?>
                            </span>
                                <i class="click-area"></i>
                            </a>
                        </div>
                        <div class="offer-adress">
                            <? if (!empty($arItem['PROPERTIES']['ADDRESS']['VALUE'])) { ?>
                                <img src="/assets/img/location-icon.png" alt="">
                                <span>
                                <?= $arItem['PROPERTIES']['ADDRESS']['VALUE']; ?>
                            </span>
                            <? } ?>
                        </div>
                        <div class="offer-img">
                            <img src="<?= !empty($arItem['PREVIEW_PICTURE']['SRC']) ? $arItem['PREVIEW_PICTURE']['SRC'] : SITE_DIR . "assets/img/no-photo.jpg"; ?>"
                                 alt="offer-img">
                        </div>
                        <div class="offer-detail">
                            <? if (!empty($arItem['PROPERTIES']['METRO']['VALUE'])) { ?>
                                <div class="detail detail-metro">
                                    <img src="/assets/img/metro-icon.png" alt="metro">
                                    <span>
                                <?= $arItem['PROPERTIES']['METRO']['VALUE']; ?>
                            </span>
                                </div>
                            <? } ?>
                            <? if (!empty($arItem['PROPERTIES']['SQUARE']['VALUE'])) { ?>
                                <div class="detail detail-area">
                                    <img src="/assets/img/area-icon.png" alt="area">
                                    <span>
                                <?= $arItem['PROPERTIES']['SQUARE']['VALUE']; ?> м²
                            </span>
                                </div>
                            <? } ?>
                            <? if (!empty($arItem['PROPERTIES']['CLASS_TYPE']['VALUE'])) { ?>
                                <div class="detail detail-class">
                                    <img src="/assets/img/class-icon.png" alt="class">
                                    <span>
                                Класс <?= $arItem['PROPERTIES']['CLASS_TYPE']['VALUE']; ?>
                            </span>
                                </div>
                            <? } ?>
                        </div>
                        <div class="offer-price">
                            <? if (!empty($arItem['PROPERTIES']['PRICE']['VALUE'])) { ?>
                                <span>
                            <?= $arItem['PROPERTIES']['PRICE']['VALUE']; ?>
                        </span>
                            <? } ?>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    </div>
<? } else {
    ?>
    <p>
        На текущий момент в этом разделе нет активных объектов
    </p>
<? } ?>
<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <br/><?= $arResult["NAV_STRING"] ?>
<? endif; ?>


