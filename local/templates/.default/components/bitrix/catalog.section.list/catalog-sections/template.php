<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

$counter = $countBlock = 0;
$lastBlock = false;
?>
    <div class="container">
        <div class="row">
<?
foreach ($arResult['SECTIONS'] as &$arSection) {
    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

    if ($arSection['DEPTH_LEVEL'] == $arParams['TOP_DEPTH']) {
        if ($counter <= $arResult['COUNT']) {
            ++$counter;
            switch ($counter):
                case 1:
                    ?>
                    <div class="col-lg-3 col-md-<?=$lastBlock?"none":"4";?> col-6">
                        <div class="catalog-menu">
                            <ul>
                                <li>
                                    <a href="<?= $arSection['SECTION_PAGE_URL'];?>">
                                        <?=$arSection['NAME'];?>
                                    </a>
                                </li>

                    <?
                    break;
                case $arResult['COUNT']:
                ?>
                                <li>
                                    <a href="<?= $arSection['SECTION_PAGE_URL'];?>">
                                        <?=$arSection['NAME'];?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                <?
                    $countBlock++;
                    if($countBlock == 3){
                        $lastBlock = true;
                    }
                break;
                default:
                    ?>
                    <li>
                        <a href="<?= $arSection['SECTION_PAGE_URL'];?>">
                            <?=$arSection['NAME'];?>
                        </a>
                    </li>
                    <?
                    break;
            endswitch;
            if($arResult['LAST_COUNT_ID'] == $arSection['ID']){
                ?>
                        </ul>
                    </div>
                </div>
                <?
            }
            if($counter == $arResult['COUNT']){
                $counter = 0;
            }
        }
    }
}?>
    </div>
</div>
