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
?>
<div class="newoffer-slider">
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

        if (!empty($arItem['PROPERTIES']['PRICE']['VALUE']) || (isset($arResult['OFFERS'][$arItem['ID']]) && ($arResult['OFFERS'][$arItem['ID']]['MIN_PRICE'] > 0))) {
            ?>

            <div class="new-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <div class="offer-item">
                    <div class="offer-title">
                        <a href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
                            <span><?= $arItem['NAME']; ?></span>
                            <i class="click-area"></i>
                        </a>
                    </div>
                    <div class="offer-adress">
                        <? if (!empty($arItem['PROPERTIES']['REGION']['VALUE'])) { ?>
                            <img src="<?= SITE_DIR; ?>assets/img/location-icon.png" alt="">
                            <span>
                                <?= $arItem['PROPERTIES']['REGION']['VALUE']; ?>
                            </span>
                        <? } ?>
                    </div>
                    <div class="offer-img">
                        <img src="<?= isset($arItem['PREVIEW_PICTURE']['SRC']) ? $arItem['PREVIEW_PICTURE']['SRC'] : SITE_DIR . "assets/img/no-photo.jpg"; ?>"
                             alt="offer-img">
                    </div>
                    <? if (!empty($arItem['PROPERTIES']['METRO']['VALUE'])) { ?>
                    <div class="offer-detail">
                        <div class="detail detail-metro">
                            <img src="/assets/img/metro-icon.png" alt="metro">
                            <span><?= $arItem['PROPERTIES']['METRO']['VALUE']; ?></span>
                        </div>
                        <? } ?>
                        <? if (!empty($arItem['PROPERTIES']['SQUARE']['VALUE'])) { ?>
                            <div class="detail detail-area">
                                <img src="/assets/img/area-icon.png" alt="area">
                                <span><?= $arItem['PROPERTIES']['SQUARE']['VALUE']; ?> м²</span>
                            </div>
                        <? } ?>
                        <? if (!empty($arItem['PROPERTIES']['CLASS_TYPE']['VALUE'])) { ?>
                            <div class="detail detail-class">
                                <img src="/assets/img/class-icon.png" alt="class">
                                <span>Класс <?= $arItem['PROPERTIES']['CLASS_TYPE']['VALUE']; ?></span>
                            </div>
                        <? } ?>
                    </div>
                    <div class="offer-price">
                        <? if (isset($arResult['OFFERS'][$arItem['ID']])) {
                            ?>
                            От
                            <span>
                                        <?= $arResult['OFFERS'][$arItem['ID']]['MIN_PRICE']; ?>
                                    </span>
                            за объект
                            <?
                        } else {
                            ?>
                            <span>
                                        <?= $arItem['PROPERTIES']['PRICE']['VALUE']; ?>
                                    </span>
                        <? } ?>
                    </div>
                </div>
            </div>
        <? } ?>

    <? endforeach; ?>
</div>
<div class="new-link"><a class="hlink" href="#">ВСЕ ПРЕДЛОЖЕНИЯ <span>(<?=$arResult['NEW_OBJ_COUNT']?>)</span></a></div>

