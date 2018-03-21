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
?>
<form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>" method="get">
    <? foreach ($arResult["ITEMS"] as $arItem):
        if (array_key_exists("HIDDEN", $arItem)):
            echo $arItem["INPUT"];
        endif;
    endforeach; ?>
    <div class="fields">
        <? foreach ($arResult["ITEMS"] as $arItem):?>
            <? if (!array_key_exists("HIDDEN", $arItem)): ?>
                <div class="input">
                    <label><?= $arItem["NAME"] ?>:</label>
                    <?= $arItem["INPUT"] ?>
                </div>
            <? endif ?>
        <? endforeach; ?>
        <div class="submit">
            <input type="submit" name="set_filter" value="Подобрать тур"><input type="hidden" name="set_filter"
                                                                                value="Y">
        </div>
    </div>
</form>
