<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$srtTemporaryUrlParam = DeleteParam(array("PAGEN_" . $arResult["NavNum"]));

if (stripos($srtTemporaryUrlParam, "ROOMS_COUNT%5D%5BRIGHT")) {
    $strTemporaryNavQueryString = str_replace("ROOMS_COUNT%5D%5BRIGHT", "ROOMS_COUNT%5D%5BLEFT", $srtTemporaryUrlParam);
} else {
    $strTemporaryNavQueryString = $srtTemporaryUrlParam;
}
$strNavQueryString = ($strTemporaryNavQueryString != "" ? $strTemporaryNavQueryString . "&amp;" : "");

$strNavQueryStringFull = ($strTemporaryNavQueryString != "" ? "?" . $strTemporaryNavQueryString : "");

$uri = trim(\Lema\Common\Request::get()->getRequestedPageDirectory(), '/');
$arResult["sUrlPath"] = '/' . $uri . '/';
?>
<!--<div class="container">
    <div class="pagination">
        <a href="#" class="pag-left"><img src="/assets/img/pl.png" alt=""></a>
        <div class="pag-list">
            <a href="#">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">6</a>
            <a href="#">7</a>
            <a href="#">8</a>
            <a href="#">9</a>
            <a class="nav-dots">...</a>
            <a href="#">123</a>
        </div>
        <a href="#" class="pag-right"><img src="/assets/img/pr.png" alt=""></a>
    </div>

    <div class="mobile-pagination">
        <a href="#" class="pag-left"><img src="/assets/img/pl.png" alt=""></a>
        <div class="pag-list">
            <a href="#">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
        </div>
        <a href="#" class="pag-right"><img src="/assets/img/pr.png" alt=""></a>
    </div>
</div>-->
<div class="container">
    <? $tempResult = $arResult; ?>
    <? if ($arResult["NavPageCount"] > 1) { ?>

        <div class="pagination">
            <?
            if ($arResult["bDescPageNumbering"] === true) {
                $bFirst = true;
                if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) {
                    if ($arResult["bSavePage"]) {
                        ?>
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"
                           class="pag-left">
                            <img src="/assets/img/pl.png" alt="">
                        </a>
                        <?
                    } else {
                        if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"] + 1)) {
                            ?>
                            <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"
                               class="pag-left">
                                <img src="/assets/img/pl.png" alt="">
                            </a>
                            <?
                        } else {
                            ?>
                            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"
                               class="pag-left">
                                <img src="/assets/img/pl.png" alt="">
                            </a>
                            <?
                        }
                    }
                    ?>
                    <div class="pag-list">
                    <?

                    if ($arResult["nStartPage"] < $arResult["NavPageCount"]) {
                        $bFirst = false;
                        if ($arResult["bSavePage"]) {
                            ?>
                            <a class=""
                               href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>">1</a>
                            <?
                        } else {
                            ?>
                            <a class="" href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>">1</a>
                            <?
                        }
                        ?>
                        <?
                        if ($arResult["nStartPage"] < ($arResult["NavPageCount"] - 1)) {
                            ?>
                            <a class="nav-dots">...</a>
                            <?
                        }
                    }
                }
                do {
                    $NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;
                    if ($arResult["nStartPage"] == $arResult["NavPageNomer"]) {
                        ?>
                        <a class="nav-dots"><?= $arResult['NavPageNomer']; ?></a>
                        <?
                    } elseif ($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false) {
                        ?>
                        <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= $NavRecordGroupPrint ?></a>
                        <?
                    } else {
                        ?>
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><?= $NavRecordGroupPrint ?></a>
                        <?
                    }

                    $arResult["nStartPage"]--;
                    $bFirst = false;
                } while ($arResult["nStartPage"] >= $arResult["nEndPage"]);

                if ($arResult["NavPageNomer"] > 1) {
                    if ($arResult["nEndPage"] > 1) {
                        if ($arResult["nEndPage"] > 2) {
                            ?>
                            <a class="nav-dots">...</a>
                            <?
                        }
                        ?>
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1"><?= $arResult["NavPageCount"] ?></a>
                        <?
                    }
                    ?>
                    </div>
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"
                       class="pag-right 1">
                        <img src="/assets/img/pr.png" alt="">
                    </a>
                    <?
                }
            } else {
                $bFirst = true;
                if ($arResult["NavPageNomer"] > 1) {
                    if ($arResult["bSavePage"]) {
                        ?>
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"
                           class="pag-left">
                            <img src="/assets/img/pl.png" alt="">
                        </a>
                        <?
                    } else {
                        if ($arResult["NavPageNomer"] > 2) {
                            ?>
                            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"
                               class="pag-left">
                                <img src="/assets/img/pl.png" alt="">
                            </a>
                            <?
                        } else {
                            ?>
                            <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>" class="pag-left">
                                <img src="/assets/img/pl.png" alt="">
                            </a>
                            <?
                        }
                    }
                    ?>
                    <div class="pag-list">
                    <?
                    if ($arResult["nStartPage"] > 1) {
                        $bFirst = false;
                        if ($arResult["bSavePage"]) {
                            ?>
                            <a class=""
                               href="<?= $arResult["sUrlPath"]
                               ?><?= $strNavQueryStringFull
                               ?>">1</a>
                        <? } else { ?>
                            <a class="" href="<?= $arResult["sUrlPath"]
                            ?><?= $strNavQueryStringFull
                            ?>">1</a>
                            <?
                        }
                        ?>
                        <?
                        if ($arResult["nStartPage"] > 2) {
                            ?>
                            <a class="nav-dots">...</a>
                            <?
                        }
                    }
                }
            if ($arResult["NavPageNomer"] == 1){
                ?>
                <div class="pag-list">
                <?
            }
                do {
                    if ($arResult["nStartPage"] == $arResult["NavPageNomer"]) {
                        ?>
                        <a class="active"><?= $arResult['nStartPage']; ?></a>
                        <?
                    } elseif ($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false) {
                        ?>
                        <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= $arResult["nStartPage"] ?></a>
                        <?
                    } else {
                        ?>
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><?= $arResult["nStartPage"] ?></a>
                        <?
                    }
                    ?>
                    <?
                    $arResult["nStartPage"]++;
                    $bFirst = false;
                } while ($arResult["nStartPage"] <= $arResult["nEndPage"]);

                if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) {
                    if ($arResult["nEndPage"] < $arResult["NavPageCount"]) {
                        if ($arResult["nEndPage"] < ($arResult["NavPageCount"] - 1)) {
                            ?>
                            <a class="nav-dots">...</a>
                            <?
                        }
                        ?>
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>">
                            <?= $arResult["NavPageCount"] ?>
                        </a>
                        <?
                    }
                    ?>
                    </div>
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"
                       class="pag-right 2">
                        <img src="/assets/img/pr.png" alt="">
                    </a>
                    <?
                } else {
                    ?>
                    </div>
                    <?
                }
            }
            ?>
        </div>

        <? $arResult = $tempResult;
        if ($arResult['NavPageNomer'] != $arResult['nEndPage'] && $arResult['NavPageNomer'] != $arResult['nStartPage']) {
            $arResult['nEndPage']--;
            $arResult['nStartPage']++;
        } ?>
        <div class="mobile-pagination">
            <?
            if ($arResult["bDescPageNumbering"] === true) {
                $bFirst = true;
                if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) {
                    if ($arResult["bSavePage"]) {
                        ?>
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"
                           class="pag-left">
                            <img src="/assets/img/pl.png" alt="">
                        </a>
                        <?
                    } else {
                        if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"] + 1)) {
                            ?>
                            <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"
                               class="pag-left">
                                <img src="/assets/img/pl.png" alt="">
                            </a>
                            <?
                        } else {
                            ?>
                            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"
                               class="pag-left">
                                <img src="/assets/img/pl.png" alt="">
                            </a>
                            <?
                        }
                    }
                    ?>
                    <div class="pag-list">
                    <?

                    if ($arResult["nStartPage"] < $arResult["NavPageCount"]) {
                        $bFirst = false;
                        if ($arResult["bSavePage"]) {
                            ?>
                            <a class=""
                               href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>">1</a>
                            <?
                        } else {
                            ?>
                            <a class="" href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>">1</a>
                            <?
                        }
                        ?>
                        <?
                        if ($arResult["nStartPage"] < ($arResult["NavPageCount"] - 1)) {
                            ?>
                            <a class="nav-dots">...</a>
                            <?
                        }
                    }
                }
                do {
                    $NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;
                    if ($arResult["nStartPage"] == $arResult["NavPageNomer"]) {
                        ?>
                        <a class="nav-dots"><?= $arResult['NavPageNomer']; ?></a>
                        <?
                    } elseif ($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false) {
                        ?>
                        <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= $NavRecordGroupPrint ?></a>
                        <?
                    } else {
                        ?>
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><?= $NavRecordGroupPrint ?></a>
                        <?
                    }

                    $arResult["nStartPage"]--;
                    $bFirst = false;
                } while ($arResult["nStartPage"] >= $arResult["nEndPage"]);

                if ($arResult["NavPageNomer"] > 1) {
                    if ($arResult["nEndPage"] > 1) {
                        if ($arResult["nEndPage"] > 2) {
                            ?>
                            <a class="nav-dots">...</a>
                            <?
                        }
                        ?>
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1"><?= $arResult["NavPageCount"] ?></a>
                        <?
                    }
                    ?>
                    </div>
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"
                       class="pag-right 1">
                        <img src="/assets/img/pr.png" alt="">
                    </a>
                    <?
                }
            } else {
                $bFirst = true;
                if ($arResult["NavPageNomer"] > 1) {
                    if ($arResult["bSavePage"]) {
                        ?>
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"
                           class="pag-left">
                            <img src="/assets/img/pl.png" alt="">
                        </a>
                        <?
                    } else {
                        if ($arResult["NavPageNomer"] > 2) {
                            ?>
                            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"
                               class="pag-left">
                                <img src="/assets/img/pl.png" alt="">
                            </a>
                            <?
                        } else {
                            ?>
                            <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>" class="pag-left">
                                <img src="/assets/img/pl.png" alt="">
                            </a>
                            <?
                        }
                    }
                    ?>
                    <div class="pag-list">
                    <?
                    if ($arResult["nStartPage"] > 1) {
                        $bFirst = false;
                        if ($arResult["bSavePage"]) {
                            ?>
                            <a class=""
                               href="<?= $arResult["sUrlPath"]
                               ?><?= $strNavQueryStringFull
                               ?>">1</a>
                        <? } else { ?>
                            <a class="" href="<?= $arResult["sUrlPath"]
                            ?><?= $strNavQueryStringFull
                            ?>">1</a>
                            <?
                        }
                        ?>
                        <?
                        if ($arResult["nStartPage"] > 2) {
                            ?>
                            <a class="nav-dots">...</a>
                            <?
                        }
                    }
                }
            if ($arResult["NavPageNomer"] == 1){
                ?>
                <div class="pag-list">
                <?
            }
                do {
                    if ($arResult["nStartPage"] == $arResult["NavPageNomer"]) {
                        ?>
                        <a class="active"><?= $arResult['nStartPage']; ?></a>
                        <?
                    } elseif ($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false) {
                        ?>
                        <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= $arResult["nStartPage"] ?></a>
                        <?
                    } else {
                        ?>
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><?= $arResult["nStartPage"] ?></a>
                        <?
                    }
                    ?>
                    <?
                    $arResult["nStartPage"]++;
                    $bFirst = false;
                } while ($arResult["nStartPage"] <= $arResult["nEndPage"]);

                if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) {
                    if ($arResult["nEndPage"] < $arResult["NavPageCount"]) {
                        if ($arResult["nEndPage"] < ($arResult["NavPageCount"] - 1)) {
                            ?>
                            <a class="nav-dots">...</a>
                            <?
                        }
                        ?>
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>">
                            <?= $arResult["NavPageCount"] ?>
                        </a>
                        <?
                    }
                    ?>
                    </div>
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"
                       class="pag-right 2">
                        <img src="/assets/img/pr.png" alt="">
                    </a>
                    <?
                } else {
                    ?>
                    </div>
                    <?
                }
            }
            ?>
        </div>


    <? } ?>
</div>