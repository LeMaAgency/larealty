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
<div class="row">
    <? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <?if($arItem['SORT'] == '1'):?>
            <div class="col-lg-3">
                <div class="stock-item stock-1">
                    <div class="stock-title"><?=$arItem['NAME']?></div>
                    <div class="stock-link"><a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>">Подробнее</a></div>
                    <div class="stock-overlay" style="background: transparent url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>) 0 0 repeat-x;"></div>
                </div>
            </div>
        <?endif;?>
        <?if($arItem['SORT'] == '2'):?>
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-4">
                    <div class="stock-item stock-2">
                        <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" class="stock-title"><?=$arItem['NAME']?></a>
                        <div class="stock-overlay"></div>
                        <div class="<?=$arItem['PROPERTIES']['PHOTOS']['VALUE'] ? 'small_stock-slide':''?> stock-slide">
                            <?if ($arItem['PREVIEW_PICTURE']['SRC']):?>
                                <div><img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>"></div>
                            <?endif;?>
                            <?if($arItem['PROPERTIES']['PHOTOS']):?>
                                <?foreach ($arItem['PROPERTIES']['PHOTOS']['VALUE'] as $photo):?>
                                    <div><img src="<?=CFile::GetPath($photo)?>" alt="<?=$arItem['NAME']?>"></div>
                                <?endforeach;?>
                            <? endif;?>
                        </div>
                    </div>
                </div>
            <?endif;?>
            <?if($arItem['SORT'] == '3'):?>
                <div class="col-lg-8">
                    <div class="stock-item stock-3">
                        <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" class="stock-title"><?=$arItem['NAME']?></a>
                        <? if($arItem['PREVIEW_TEXT']):?>
                            <div class="stock-txt"><?=$arItem['PREVIEW_TEXT']?></div>
                        <?endif;?>
                        <div class="stock-overlay"></div>
                        <div class="<?=$arItem['PROPERTIES']['PHOTOS']['VALUE'] ? 'big_stock-slide':''?> stock-slide">
                            <?if ($arItem['PREVIEW_PICTURE']['SRC']):?>
                                <div><img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>"></div>
                            <?endif;?>
                            <?if($arItem['PROPERTIES']['PHOTOS']):?>
                                <?foreach ($arItem['PROPERTIES']['PHOTOS']['VALUE'] as $photo):?>
                                    <div><img src="<?=CFile::GetPath($photo)?>" alt="<?=$arItem['NAME']?>"></div>
                                <?endforeach;?>
                            <? endif;?>
                        </div>
                    </div>
                </div>
            <?endif;?>
            <?if($arItem['SORT'] == '4'):?>
                <div class="col-lg-8">
                    <div class="stock-item stock-4">
                        <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" class="stock-title"><?=$arItem['NAME']?></a>
                        <? if($arItem['PREVIEW_TEXT']):?>
                            <div class="stock-txt"><?=$arItem['PREVIEW_TEXT']?></div>
                        <?endif;?>
                        <div class="stock-overlay"></div>
                        <div class="<?=$arItem['PROPERTIES']['PHOTOS']['VALUE'] ? 'big_stock-slide':''?> stock-slide">
                            <?if ($arItem['PREVIEW_PICTURE']['SRC']):?>
                                <div><img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>"></div>
                            <?endif;?>
                            <?if($arItem['PROPERTIES']['PHOTOS']):?>
                                <?foreach ($arItem['PROPERTIES']['PHOTOS']['VALUE'] as $photo):?>
                                    <div><img src="<?=CFile::GetPath($photo)?>" alt="<?=$arItem['NAME']?>"></div>
                                <?endforeach;?>
                            <? endif;?>
                        </div>
                    </div>
                </div>
            <?endif;?>
            <?if($arItem['SORT'] == '5'):?>
                    <div class="col-lg-4">
                        <div class="stock-item stock-2">
                            <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" class="stock-title"><?=$arItem['NAME']?></a>
                            <div class="stock-overlay"></div>
                            <div class="<?=$arItem['PROPERTIES']['PHOTOS']['VALUE'] ? 'small_stock-slide':''?> stock-slide">
                                <?if ($arItem['PREVIEW_PICTURE']['SRC']):?>
                                    <div><img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>"></div>
                                <? endif;?>
                                <?if($arItem['PROPERTIES']['PHOTOS']):?>
                                    <?foreach ($arItem['PROPERTIES']['PHOTOS']['VALUE'] as $photo):?>
                                        <div><img src="<?=CFile::GetPath($photo)?>" alt="<?=$arItem['NAME']?>"></div>
                                    <?endforeach;?>
                                <? endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?endif;?>
        <? endforeach; ?>
</div>

