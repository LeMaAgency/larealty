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
if (empty($arResult["ITEMS"]))
    return;
$data = new \Lema\Template\TemplateHelper($this);

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>
<section class="realtors">
    <div class="realtor__title">
        <span>
            <?= Loc::getMessage("LEMA_REALTORS_TITLE"); ?>
        </span>
    </div>
    <div class="container">
        <div class="realtors__carousel">

            <? foreach ($data->items() as $item): ?>
                <div class="realtors__carousel__item">
                    <div class="realtors__carousel__item__wrap">
                        <div class="realtors__carousel__item__img">
                            <img src="<?= CFile::getPath($item->get("PERSONAL_PHOTO")); ?>" alt="realtor">
                        </div>
                        <div class="realtors__carousel__item__description">
                            <div class="realtors__carousel__item__description__name">
                                <?= $item->getName(); ?>
                                <br>
                                <?= $item->get("LAST_NAME"); ?>
                            </div>
                            <div class="realtors__carousel__item__description__title">
                                120 объектов
                            </div>
                            <div class="realtors__carousel__item__description__tel__text">
                                <?= Loc::getMessage("LEMA_REALTORS_CONTACT"); ?>
                            </div>
                            <div class="realtors__carousel__item__description__tel">
                                <?= $item->get("PERSONAL_PHONE"); ?>
                            </div>
                            <div class="realtors__carousel__item__description__link">
                                <a href="#">
                                    <?= Loc::getMessage("LEMA_REALTORS_CALL"); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>

        </div>
    </div>
</section>