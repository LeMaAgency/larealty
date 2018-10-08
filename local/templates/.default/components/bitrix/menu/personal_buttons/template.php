<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
    <nav class="personal-menu">
        <?
        foreach ($arResult as $arItem):
            if ($arParams['MAX_LEVEL'] == 1 && $arItem['DEPTH_LEVEL'] > 1)
                continue;
            ?>
            <? if ($arItem['SELECTED']):?>

            <a href="<?= $arItem['LINK'] ?>" class="card-flat__content__buttons__item selected">
                <span>
                    <?= $arItem['TEXT'] ?>
                </span>
            </a>
        <? else:?>
            <a class="card-flat__content__buttons__item" href="<?= $arItem['LINK'] ?>">
                <span>
                    <?= $arItem['TEXT'] ?>
                </span>
            </a>
        <? endif ?>

        <? endforeach ?>
    </nav>
<? endif ?>