<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>

        <ul class="mobile-menu">
            <?
            $previousLevel = 0;
            foreach ($arResult as $arItem): ?>

            <? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
                <?= str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"])); ?>
            <? endif ?>

            <? if ($arItem["IS_PARENT"]): ?>

            <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
                    <li class="first_level have_submenu"><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
                        <span class="open_submenu"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
                        <ul class="submenu">
                            <? else: ?>
                            <li><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
                                <ul>
                            <? endif ?>

                            <? else:?>

                                <? if ($arItem["PERMISSION"] > "D"):?>

                                    <? if ($arItem["DEPTH_LEVEL"] == 1):?>
                                        <li class="first_level"><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>

                                    <? else:?>
                                        <li class="second_level submenu_item"><a
                                                    href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
                                    <? endif ?>

                                <? else:?>

                                    <? if ($arItem["DEPTH_LEVEL"] == 1):?>
                                        <li><a href="<?= $arItem["LINK"] ?>"
                                               title="<?= GetMessage("MENU_ITEM_ACCESS_DENIED") ?>"><?= $arItem["TEXT"] ?></a>
                                        </li>
                                    <? else:?>
                                        <li><a href="" class="denied"
                                               title="<?= GetMessage("MENU_ITEM_ACCESS_DENIED") ?>"><?= $arItem["TEXT"] ?></a>
                                        </li>
                                    <? endif ?>

                                <? endif ?>

                            <? endif ?>

                            <? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>

                            <? endforeach ?>

                            <? if ($previousLevel > 1)://close last item tags?>
                                <?= str_repeat("</ul></li>", ($previousLevel - 1)); ?>
                            <? endif ?>


                        </ul>


<? endif ?>