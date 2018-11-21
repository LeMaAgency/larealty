<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<form action="<?=SITE_DIR.$arParams["PAGE"]?>" method="post">
    <?echo bitrix_sessid_post();?>
    <input type="email" name="EMAIL" class="required" placeholder="Введите свой e-mail" value="<?=$arResult["USER_EMAIL"] ? $arResult["USER_EMAIL"] : ($arResult["SUBSCRIPTION"]["EMAIL"]!=""?$arResult["SUBSCRIPTION"]["EMAIL"]:$arResult["REQUEST"]["EMAIL"]);?>" size="30" maxlength="255" />

    <?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
        <input type="hidden" name="RUB_ID[]" value="<?=$itemValue["ID"]?>" />
    <?endforeach;?>

    <input type="hidden" name="FORMAT" value="html" />

    <button>Подписаться</button>

    <input type="hidden" name="PostAction" value="Add" />
    <input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
</form>
