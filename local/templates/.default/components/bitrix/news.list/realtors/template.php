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

$checkElem5 = false;

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>
<section class="realtors text-center ">
    <div class="realtor__title">
        <span>
            <?= Loc::getMessage("LEMA_REALTORS_TITLE"); ?>
        </span>
    </div>
    <div class="container">
        <? foreach ($data->items() as $key => $item): ?>
        <? if ($key == 0 || $key % 5 == 0) { ?>
        <div class="realtors__carousel">
            <? } ?>
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

            <? if ((($key + 1) % 5 == 0 && $key > 3) || ($key + 1) == count($data->items())) { ?>
        </div>
        <? if ($checkElem5 && ($key + 1) == count($data->items())) { ?>
    </div>
    <? } ?>
    <? if ($key == 4 && ($key + 1) != count($data->items())) {
    $checkElem5 = true;
    ?>
    <div class="spoiler">
        <? } ?>
        <? } ?>

        <? endforeach; ?>

    </div>
    <button class="add-apartment__button js-all-realtors">
        <?= Loc::getMessage("LEMA_REALTORS_ALL_REALTORS"); ?>
    </button>
</section>