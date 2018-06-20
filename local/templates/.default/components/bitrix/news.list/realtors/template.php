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
                        <div class="realtors__carousel__item__description__link js-realtors-feedback"
                             data-id="<?= $item->getId(); ?>">
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
    <div id="realtors-feedback-form" class="fancybox-feedback" style="display: none;">.
        <div class="top-slider-form">
            <form method="post" class="ajax-form realtor-card__form js-rieltor-form call-order" action="/ajax/realtor_form.php" method="post"
                  enctype="multipart/form-data">
                <div class="call-order-title">
                    Обратный звонок
                </div>
                <div class="it-block">
                    <input type="text" id="form_field_name" name="name" placeholder="Имя" class="call-order-input">
                    <div class="it-error"></div>
                </div>
                <div class="it-block">
                    <input type="tel" id="form_field_phone" name="phone" placeholder="Телефон" class="call-order-input">
                    <div class="it-error"></div>
                </div>
                <div class="it-block">
                    <input type="hidden" id="form_field_realtor_id" name="realtor_id" placeholder=""
                           class="call-order-input" value="">
                    <div class="it-error"></div>
                </div>
                <div class="it-block checkbox" style="border: 1px solid transparent;">
                    <label style="margin:5px 10px;">
                        <input type="checkbox" value="1" name="agreement" class="checkbox-152-fz">
                        Я ознакомлен <a target="_blank" href="/contacts/apply.pdf">c положением об обработке и защите
                            персональных данных.</a> </label>
                    <div class="it-error"></div>
                </div>
                <div class="it-block it-buttons">
                    <input type="submit" value="Отправить" class="green-btn">
                </div>
            </form>
        </div>
        <? /* $APPLICATION->IncludeComponent(
            "lema:form.ajax",
            "feedback",
            Array(
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "EVENT_TYPE" => "57",
                "FORM_152_FZ" => "Я ознакомлен <a target=\"_blank\" href=\"/contacts/apply.pdf\">c положением об обработке и защите персональных данных.</a>",
                "FORM_ACTION" => "",
                "FORM_BTN_TITLE" => "Отправить",
                "FORM_CLASS" => "ajax-form call-order",
                "FORM_FIELDS" => "[{\"name\":\"name\",\"type\":\"text\",\"title\":\"\",\"placeholder\":\"Имя\",\"default\":\"\",\"required\":\"N\"},{\"name\":\"phone\",\"type\":\"tel\",\"title\":\"\",\"placeholder\":\"Телефон\",\"default\":\"\",\"required\":\"N\"},{\"name\":\"rieltor_id\",\"type\":\"hidden\",\"title\":\"\",\"placeholder\":\"\",\"default\":\"\",\"required\":\"N\"}]",
                "FORM_SUCCESS_FUNCTION" => "\$.fancybox.open(\"Ваше сообщение успешно отправлено\")",
                "FORM_SUCCESS_FUNCTION_CORRECT_JSON" => "Y",
                "IBLOCK_ID" => "15",
                "IBLOCK_TYPE" => "realty",
                "NEED_SAVE_TO_IBLOCK" => "Y",
                "NEED_SEND_EMAIL" => "Y"
            )
        ); */ ?>
    </div>
</section>