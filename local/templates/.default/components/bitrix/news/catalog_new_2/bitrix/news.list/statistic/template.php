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

<div class="catalog-head">
    <div class="container">
        <h1><?= $APPLICATION->ShowTitle(); ?></h1>
        <div class="catalog-head_list">
            <div class="flex-list">
                <?
                $count = 0;
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
                        if ($arResult['STATISTICS_INFO']['LAST_COUNT_ID'] == $key) {
                            ?>
                            </ul>
                            <?
                        }
                        if ($count == $arResult['STATISTICS_INFO']['ELEM_IN_BLOCK']) {
                            $count = 0;
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
            <!--<div class="catalog-head_link"><a href="#"><img src="/assets/img/plus.png" alt="plus"><span>Все районы</span></a></div>-->
        <? } ?>
    </div>
</div>