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
?>
<div class="subscribe-form"  id="subscribe-form">
    <?
    var_dump($arResult);
    $frame = $this->createFrame("subscribe-form", false)->begin();
    ?>
    <form action="<?=$arResult["FORM_ACTION"]?>" class="js-subscribe-form">
        <input type="text"
               name="sf_EMAIL"
               class="required"
               value="<?=$arResult["EMAIL"]?>"
               title="<?=GetMessage("subscr_form_email_title")?>" />
        <button>
            <?=GetMessage("subscr_form_button")?>
        </button>
    </form>
    <?
    $frame->beginStub();
    ?>
    <form action="<?=$arResult["FORM_ACTION"]?>" class="js-subscribe-form">

        <form action="<?=$arResult["FORM_ACTION"]?>">
            <input type="text"
                   name="sf_EMAIL"
                   class="required"
                   value=""
                   title="<?=GetMessage("subscr_form_email_title")?>" />
            <button>
                <?=GetMessage("subscr_form_button")?>
            </button>
        </form>
    </form>
    <?
    $frame->end();
    ?>
</div>

