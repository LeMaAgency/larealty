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

use Lema\Common\Helper as H,
    Lema\Template\TemplateHelper as TH,
    Bitrix\Main\Localization\Loc;

if(empty($arResult['ITEMS']))
    return ;

Loc::loadMessages(__FILE__);

$this->setFrameMode(true);

$data = new TH($this);

?>
    <div class="act__list">
        <?if($arParams["DISPLAY_TOP_PAGER"]):?>
            <?=$arResult["NAV_STRING"]?><br />
        <?endif;?>
        <?foreach($data->items() as $item):?>
            <div class="act__list__item">
                <div class="act__list__item__w">
                    <div class="act__list__item__w__l">
                        <div class="act__list__item__img">
                            <div class="act__list__item__img__сontrol" style="background-image: url(<?=$item->previewPicture();?>)"></div>
                        </div>
                    </div>
                    <div class="act__list__item__w__r">
                        <div class="act__list__item__name">
                            <a href="<?=$item->detailUrl()?>"><span><?=$item->getName();?></span></a>
                        </div>
                        <div class="act__list__item__inf">
                            <span>Акция продлится с 30 ян до 14 (уточнить)</span>
                        </div>
                        <div class="act__list__item__text">
                            <p><?=$item->previewText()?></p>
                        </div>

                    </div>
                </div>
            </div>
        <?endforeach;?>
    </div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?>
<?endif;?>