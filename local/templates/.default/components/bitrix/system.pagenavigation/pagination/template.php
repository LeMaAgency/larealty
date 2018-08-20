<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$srtTemporaryUrlParam = DeleteParam(array("PAGEN_" . $arResult["NavNum"]));

if (stripos($srtTemporaryUrlParam, "ROOMS_COUNT%5D%5BRIGHT")) {
    $strTemporaryNavQieryString = str_replace("ROOMS_COUNT%5D%5BRIGHT", "ROOMS_COUNT%5D%5BLEFT", $srtTemporaryUrlParam);
} else {
    $strTemporaryNavQieryString = $srtTemporaryUrlParam;
}
$strNavQueryString = ($strTemporaryNavQieryString != "" ? $strTemporaryNavQieryString . "&amp;" : "");

$strNavQueryStringFull = ($strTemporaryNavQieryString != "" ? "?" . $strTemporaryNavQieryString : "");

$uri = trim(\Lema\Common\Request::get()->getRequestedPageDirectory(), '/');
$arResult["sUrlPath"] = '/' . $uri . '/';
?>
<div class="pagination-catalog">
    <nav class="container">
        <? if ($arResult["NavPageCount"] > 1) {
            ?>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?
                    if ($arResult["bDescPageNumbering"] === true):
                        $bFirst = true;
                        if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
                            if ($arResult["bSavePage"]):

                                ?>
                                <li><a aria-label="Previous"
                                       href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"><?= GetMessage("lema_nav_prev") ?></a>
                                </li>
                                <?
                            else:
                                if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"] + 1)):
                                    ?>
                                    <li><a aria-label="Previous"
                                           href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= GetMessage("lema_nav_prev") ?></a>
                                    </li>
                                    <?
                                else:
                                    ?>
                                    <li><a aria-label="Previous"
                                           href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"><?= GetMessage("lema_nav_prev") ?></a>
                                    </li>
                                    <?
                                endif;
                            endif;
                            ?>
                            <?

                            if ($arResult["nStartPage"] < $arResult["NavPageCount"]):
                                $bFirst = false;
                                /*if($arResult["bSavePage"]):
                                    ?>
                                    <li><a class="blog-page-first"
                                           href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>">1</a>
                                    </li>
                                    <?
                                else:
                                    ?>
                                    <li><a class="blog-page-first" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">1</a></li>
                                    <?
                                endif;*/
                                ?>
                                <?
                                if ($arResult["nStartPage"] < ($arResult["NavPageCount"] - 1)):
                                    ?>
                                    <li><span class="pagination__elem-deactive">...</span></li>
                                    <?
                                endif;
                            endif;
                        endif;
                        do {
                            $NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;

                            if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
                                ?>
                                <li><span class="pagination__elem-active"><?= $arResult['NavPageNomer']; ?></span></li>
                                <?
                            elseif ($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):
                                ?>
                                <li>
                                    <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= $NavRecordGroupPrint ?></a>
                                </li>
                                <?
                            else:
                                ?>
                                <li>
                                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><?= $NavRecordGroupPrint ?></a>
                                </li>

                                <?
                            endif;
                            ?>
                            <?

                            $arResult["nStartPage"]--;
                            $bFirst = false;
                        } while ($arResult["nStartPage"] >= $arResult["nEndPage"]);

                        if ($arResult["NavPageNomer"] > 1):
                            if ($arResult["nEndPage"] > 1):
                                if ($arResult["nEndPage"] > 2):
                                    ?>
                                    <li><span class="pagination__elem-deactive">...</span></li>
                                    <?
                                endif;
                                ?>
                                <li>
                                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1"><?= $arResult["NavPageCount"] ?></a>
                                </li>
                                <?
                            endif;


                            ?>
                            <li><a aria-label="Next"
                                   href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"><?= GetMessage("lema_nav_next") ?></a>
                            </li>
                            <?
                        endif;

                    else:
                        $bFirst = true;

                        if ($arResult["NavPageNomer"] > 1):
                            if ($arResult["bSavePage"]):
                                ?>
                                <li><a aria-label="Previous"
                                       href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"><?= GetMessage("lema_nav_prev") ?></a>
                                </li>
                                <?
                            else:
                                if ($arResult["NavPageNomer"] > 2):
                                    ?>
                                    <li><a aria-label="Previous"
                                           href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"><?= GetMessage("lema_nav_prev") ?></a>
                                    </li>
                                    <?
                                else:
                                    ?>
                                    <li><a aria-label="Previous"
                                           href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= GetMessage("lema_nav_prev") ?></a>
                                    </li>
                                    <?
                                endif;

                            endif;
                            ?>
                            <?

                            if ($arResult["nStartPage"] > 1):
                                $bFirst = false;
                                /*if($arResult["bSavePage"]):
                                    */
                                ?><!--
                                <li><a class="blog-page-first"
                                       href="<?/*=$arResult["sUrlPath"]*/
                                ?><?/*=$strNavQueryStringFull*/
                                ?>">1</a>
                                </li>
                                <?/*
                            else:
                                */
                                ?>
                                <li><a class="blog-page-first" href="<?/*=$arResult["sUrlPath"]*/
                                ?><?/*=$strNavQueryStringFull*/
                                ?>">1</a></li>
                                --><?/*
                            endif;*/
                                ?>
                                <?
                                if ($arResult["nStartPage"] > 2):
                                    ?>
                                    <li><span class="pagination__elem-deactive">...</span></li>
                                    <?
                                endif;
                            endif;
                        endif;

                        do {
                            if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
                                ?>
                                <li><span class="pagination__elem-active"><?= $arResult['nStartPage']; ?></span></li>
                                <?
                            elseif ($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):
                                ?>
                                <li>
                                    <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= $arResult["nStartPage"] ?></a>
                                </li>
                                <?
                            else:
                                ?>
                                <li>
                                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><?= $arResult["nStartPage"] ?></a>
                                </li>
                                <?
                            endif;
                            ?>
                            <?
                            $arResult["nStartPage"]++;
                            $bFirst = false;
                        } while ($arResult["nStartPage"] <= $arResult["nEndPage"]);

                        if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
                            if ($arResult["nEndPage"] < $arResult["NavPageCount"]):
                                if ($arResult["nEndPage"] < ($arResult["NavPageCount"] - 1)):
                                    ?>
                                    <li><span class="pagination__elem-deactive">...</span></li>
                                    <?
                                endif;
                                ?>
                                <li>
                                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>">
                                        <?= $arResult["NavPageCount"] ?>
                                    </a>
                                </li>
                                <?
                            endif;

                            ?>
                            <li><a aria-label="Next"
                                   href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"><?= GetMessage("lema_nav_next") ?></a>
                            </li>
                            <?
                        endif;
                    endif;
                    ?>
                </ul>
            </nav>
            <?
        }
        ?>
        <? /* if($arResult['NavShowAll'] || $arResult['NavRecordCount'] > $arResult['NavPageSize']): */ ?><!--

            <div class="col-5 col-xl-7 col-lg-24 css-right">
                <div class="button">
                    <? /*
                    if($arResult["NavShowAll"]):*/ ?>
                        <a href="<? /*=$arResult["sUrlPath"]*/ ?>?<? /*=$strNavQueryString*/ ?>SHOWALL_<? /*=$arResult["NavNum"]*/ ?>=0"><span><? /*=Loc::getMessage('nav_paged');*/ ?></span></a>
                    <? /* else: */ ?>
                        <a href="<? /*=$arResult["sUrlPath"]*/ ?>?<? /*=$strNavQueryString*/ ?>SHOWALL_<? /*=$arResult["NavNum"]*/ ?>=1"><span><? /*=Loc::getMessage('nav_all');*/ ?></span></a>
                    <? /* endif; */ ?>
                </div>
            </div>
        --><? /* endif;*/ ?>
</div>