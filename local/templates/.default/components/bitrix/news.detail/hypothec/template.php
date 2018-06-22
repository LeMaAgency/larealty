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

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$data = new \Lema\Template\TemplateHelper($this);
$item = $data->item();
?>
<section class="slider-services">
    <div class="container">
        <H2 class="slider-services__title">
            <?= $item->getName(); ?>
        </H2>
        <div class="slider-services__img">
            <? foreach ($item->propVal("LIST_ELEMENTS") as $key => $element): ?>
                <div class="slider-services__img__item active"
                     data-img="<?= $key + 1; ?>">
                </div>
                <? if ($key + 1 != count($item->propVal("LIST_ELEMENTS"))) { ?>
                    <div class="slider-services__img__between"></div>
                <? } ?>
            <? endforeach; ?>
        </div>
    </div>
    <div class="container">
        <div class="slider-services__slider">
            <? foreach ($item->propVal("LIST_ELEMENTS") as $key => $element): ?>
                <div class="slider-services__slider__item" data-slider="<?= $key + 1; ?>">
                    <p class="slider-services__slider__item__text">
                        <? if ($element["TYPE"] == "HTML") {
                            echo htmlspecialcharsbx($element["TEXT"]);
                        } else {
                            echo $element["TEXT"];
                        } ?>
                    </p>
                </div>
            <? endforeach; ?>
        </div>
        <div class="slider-services__btn-wrap">
            <a href="#" class="slider-services__btn">
                <?= Loc::getMessage("LEMA_HYPOTHEC_CALCULATE"); ?>
            </a>
        </div>
    </div>
</section>