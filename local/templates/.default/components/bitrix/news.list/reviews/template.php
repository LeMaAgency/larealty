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
$bxAjaxId = CAjax::GetComponentID($component->__name, $component->__template->__name,$component->randString());

$sCode = $arResult['CODE'];
?>
<div class="ajax_load">

    <div class="customer-reviews <?= $sCode; ?>">

        <? if ($_REQUEST['showMore_' . $sCode] == '1')
            $GLOBALS['APPLICATION']->RestartBuffer(); ?>
        <div class="container">
            <? if (!$_REQUEST['showMore_' . $sCode] == '1') { ?>
                <h2 class="customer-reviews__h2">
                    <?= Loc::getMessage("LEMA_REVIEWS_TITLE"); ?>
                </h2>
            <? } ?>

            <div class="row">
                <? foreach ($data->items() as $item): ?>
                    <div class="col-md-6" <?= $item->editId(); ?>>
                        <div class="customer-reviews__item">
                            <div class="customer-reviews__item__icon"></div>
                            <div class="customer-reviews__item__content">
                                <div class="customer-reviews__item__content__name">
                                    <?= $item->getName(); ?>
                                </div>
                                <span class="customer-reviews__item__content__time">
                                    <?= $item->get("ACTIVE_FROM"); ?>
                                </span>
                                <p class="customer-reviews__item__content__text">
                                    <?= $item->previewText(); ?>
                                </p>
                                <a href="#" class="customer-reviews__item__content__detail">
                                <span>
                                    <?= Loc::getMessage("LEMA_REVIEWS_MORE_INFO"); ?>
                                </span>
                                </a>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>


            </div>
            <? if ($arResult["NAV_RESULT"]->NavPageNomer != $arResult["NAV_RESULT"]->nEndPage): ?>
                <div class="css_text-center <?= $sCode; ?>">
                    <a class="customer-reviews__more icon-right-small ajax_load_btn_new"
                       href="#"
                       data-ajax-id="<?= $bxAjaxId ?>"
                       data-show-more="<?= $arResult["NAV_RESULT"]->NavNum ?>"
                       data-next-page="<?= ($arResult["NAV_RESULT"]->NavPageNomer + 1) ?>"
                       data-max-page="<?= $arResult["NAV_RESULT"]->nEndPage ?>"
                       data-section-code="<?= $sCode; ?>">
                            <span>
                                <?= Loc::getMessage("LEMA_REVIEWS_SHOW_MORE"); ?>
                            </span>
                    </a>
                </div>
            <? endif; ?>
        </div>
        <div class="bottom_nav" style="display: none;">
            <? if ($arParams["DISPLAY_BOTTOM_PAGER"] == "Y") { ?>
                <?= $arResult["NAV_STRING"]; ?>
            <? } ?>
        </div>
        <? if ($_REQUEST['showMore_' . $sCode] == '1')
            die(); ?>
    </div>
</div>

<script>

    $(document).ready(function () {
        $(document).off('click').on('click', '[data-show-more]', function (e) {

            e.preventDefault();

            var btn = $(this);
            var waitElement = btn.parent().get(0);
            var page = btn.attr('data-next-page');
            var id = btn.attr('data-show-more');
            var max = btn.attr('data-max-page');
            var code = btn.attr('data-section-code');

            var data = {};

            data['showMore_' + code] = 1;
            data['PAGEN_' + id] = page;

            BX.showWait(waitElement);
            btn.find('[data-show-more]').off('click');

            $.ajax({
                type: "GET",
                url: window.location.href,
                data: data,
                //timeout: 3000,
                success: function (data) {
                    BX.closeWait(waitElement);
                    btn.attr('data-next-page', page * 1 + 1);
                    //btn.remove();
                    $.when($('.ajax_load .customer-reviews.' + code).first().append(data)).then(function () {
                        $('.ajax_load_btn_new').html($('.ajax_load_btn_new').eq(-2).html());
                        $('.ajax_load_btn_new').first().remove();
                        if (max == (page * 1))
                            $('.css_text-center.' + code).hide();
                    });
                }
            });
        });

    });

</script>