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
?>
<?
    $bannerSrc = '/assets/css/../img/banners/';
    switch ($APPLICATION->GetCurPage()) {
        case '/catalog/city/':
            $bannerSrc .='1-jilaya.jpg';
            break;
        case '/catalog/cottage/':
            $bannerSrc .='2-zagorod.jpg';
            break;
        case '/catalog/commercial/':
            $bannerSrc .='3-kommerciya.jpg';
            break;
        case '/catalog/foreign/':
            $bannerSrc .='4-zarubejnaya.jpg';
            break;
        default:
            $bannerSrc .='1-jilaya.jpg';
            break;
    }
?>
<div class="catalog-head" style="background-image:  url(<?=$bannerSrc?>);">
    <div class="container">
        <h1><?= $APPLICATION->ShowTitle(); ?></h1>
        <?if (!empty($arResult["STATISTICS"])) { ?>
            <div class="catalog-head_list">
                <div class="flex-list">
                    <?
                    $count = $countColumn = 0;
                    $maxCount = 3;
                    foreach ($arResult["STATISTICS"] as $key => $arRegion):
                        if ($count <= $arResult['STATISTICS_INFO']['ELEM_IN_BLOCK']) {
                            $count++;
                            switch ($count):
                                case 1:
                                    ?>
                                    <ul>
                                    <li>
                                        <a href="<?= $APPLICATION->GetCurPageParam('region=' . $key, array('region')); ?>">
                                    <span>
                                        <?= $arRegion['NAME']; ?>
                                    </span>
                                            <img src="/assets/img/d1.png" alt="">
                                            <span class="count">
                                        <?= $arRegion['COUNT']; ?>
                                    </span>
                                        </a>
                                    </li>
                                    <?
                                    break;
                                case $arResult['STATISTICS_INFO']['ELEM_IN_BLOCK']:
                                    ?>
                                    <li>
                                        <a href="<?= $APPLICATION->GetCurPageParam('region=' . $key, array('region')); ?>">
                                        <span>
                                            <?= $arRegion['NAME']; ?>
                                        </span>
                                            <img src="/assets/img/d1.png" alt="">
                                            <span class="count">
                                            <?= $arRegion['COUNT']; ?>
                                        </span>
                                        </a>
                                    </li>
                                    </ul>
                                    <?
                                    break;
                                default:
                                    ?>
                                    <li>
                                        <a href="<?= $APPLICATION->GetCurPageParam('region=' . $key, array('region')); ?>">
                                    <span>
                                        <?= $arRegion['NAME']; ?>
                                    </span>
                                            <img src="/assets/img/d1.png" alt="">
                                            <span class="count">
                                        <?= $arRegion['COUNT']; ?>
                                    </span>
                                        </a>
                                    </li>
                                    <?
                                    break;
                            endswitch;
                            if ($arResult['STATISTICS_INFO']['LAST_COUNT_ID'] == $key || $count == $maxCount) {
                                ?>
                                </ul>
                                <?
                            }
                            if ($count == $arResult['STATISTICS_INFO']['ELEM_IN_BLOCK'] || $count == $maxCount) {
                                $countColumn++;
                                $count = 0;
                            }
                            if($countColumn == 2){
                                break;
                            }
                        }

                    endforeach; ?>
                </div>
                <div class="count-object">
                <span>
                <?= \Lema\Common\Helper::pluralizeN(
                    $arResult['STATISTICS_INFO']['ALL_COUNT'],
                    array(
                        Loc::getMessage('LEMA_OBJECTS_NEW_ONE_OBJECT'),
                        Loc::getMessage('LEMA_OBJECTS_NEW_TWO_OBJECTS'),
                        Loc::getMessage('LEMA_OBJECTS_NEW_MANY_OBJECTS'),
                    )
                ); ?>
                </span>
                </div>
            </div>
            <? if ($arResult['STATISTICS_INFO']['ALL_COUNT'] > 6) { ?>
                <div class="catalog-head_link"><a href="#" class="js-statistic-list"><img src="/assets/img/plus.png" alt="plus"><span>Все районы</span></a></div>
            <? } ?>
        <? } ?>

    </div>
</div>
<div id="statistic-list" class="statistic-list-block" style="display: none;">
    <h2>Все районы</h2>
    <div class="catalog-head_list">
        <div class="flex-list">
            <?
            $count = $countColumn = 0;
            foreach ($arResult["STATISTICS"] as $key => $arRegion):
                if ($count <= $arResult['STATISTICS_INFO']['ELEM_IN_BLOCK']) {
                    $count++;
                    switch ($count):
                        case 1:
                            ?>
                            <ul>
                            <li>
                                <a href="<?= $APPLICATION->GetCurPageParam('region=' . $key, array('region')); ?>">
                                    <span class="feature-left">
                                        <?= $arRegion['NAME']; ?>
                                    </span>
                                    <span class="count feature-right">
                                        <?= $arRegion['COUNT']; ?>
                                    </span>
                                </a>
                            </li>
                            <?
                            break;
                        case $arResult['STATISTICS_INFO']['ELEM_IN_BLOCK']:
                            ?>
                            <li>
                                <a href="<?= $APPLICATION->GetCurPageParam('region=' . $key, array('region')); ?>">
                                        <span class="feature-left">
                                            <?= $arRegion['NAME']; ?>
                                        </span>
                                        <span class="count feature-right">
                                            <?= $arRegion['COUNT']; ?>
                                        </span>
                                </a>
                            </li>
                            </ul>
                            <?
                            break;
                        default:
                            ?>
                            <li>
                                <a href="<?= $APPLICATION->GetCurPageParam('region=' . $key, array('region')); ?>">
                                    <span class="feature-left">
                                        <?= $arRegion['NAME']; ?>
                                    </span>
                                    <span class="count feature-right">
                                        <?= $arRegion['COUNT']; ?>
                                    </span>
                                </a>
                            </li>
                            <?
                            break;
                    endswitch;
                    if ($arResult['STATISTICS_INFO']['LAST_COUNT_ID'] == $key) {
                        ?>
                        </ul>
                        <?
                    }
                    if ($count == $arResult['STATISTICS_INFO']['ELEM_IN_BLOCK']) {
                        $countColumn++;
                        $count = 0;
                    }
                    if($countColumn == 2){
                        break;
                    }
                }

            endforeach; ?>
        </div>
    </div>
</div>