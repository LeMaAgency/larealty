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
if ($arResult["SECTIONS_COUNT"] <= 0) {
    return;
}


$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
$arClasses =
    [
        0 => [
            'col-md' => '8',
            'realties' => 'first'
        ],
        1 => [
            'col-md' => '4',
            'realties' => 'second'
        ],
        2 => [
            'col-md' => '4',
            'realties' => 'third'
        ],
        3 => [
            'col-md' => '8',
            'realties' => 'fourth'
        ]

    ];
?>


<div class="row">
    <?
    $intCurrentDepth = 1;
    $boolFirst = true;
    foreach ($arResult['SECTIONS'] as $key => &$arSection) {
        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
        ?>
        <div class="col-md-<?= $arClasses[$key]['col-md']; ?>" id="<?= $this->GetEditAreaId($arSection['ID']); ?>">
            <div class="realties-item realties-<?= $arClasses[$key]['realties']; ?>">
                <div class="realties-overlay"></div>
                <div class="realties-title">
                    <?= $arSection['NAME']; ?>
                </div>

            </div>
        </div>

    <? } ?>
</div>


<!--<div class="row">
    <div class="col-md-8">
        <div class="realties-item realties-first">
            <div class="realties-overlay"></div>
            <div class="realties-title">Жилая в городе</div>
            <div class="realties-list">
                <ul>
                    <li><a href="#">Все жилые комплексы <span>163</span></a></li>
                    <li><a href="#">Дома <span>9</span></a></li>
                    <li><a href="#">Квартиры <span>3 149</span></a></li>
                </ul>
                <ul>
                    <li><a href="#">Пентхаусы <span>166</span></a></li>
                    <li><a href="#">Таунхаусы <span>27</span></a></li>
                    <li><a href="#">Новостройки <span>52</span></a></li>
                </ul>
                <ul>
                    <li><a href="#">Аренда <span>275</span></a></li>
                    <li><a href="#">Дисконты <span>27</span></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="realties-item realties-second">
            <div class="realties-overlay"></div>
            <div class="realties-title">Загородная</div>
            <div class="realties-list">
                <ul>
                    <li><a href="#">Дом <span>1 184</span></a></li>
                    <li><a href="#">Квартира <span>174</span></a></li>
                    <li><a href="#">Таунхаус <span>251</span></a></li>
                </ul>
                <ul>
                    <li><a href="#">Поселки <span>85</span></a></li>
                    <li><a href="#">Участок <span>526</span></a></li>
                    <li><a href="#">Аренда <span>277</span></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="realties-item realties-third">
            <div class="realties-overlay"></div>
            <div class="realties-title">Коммерческая</div>
            <div class="realties-list">
                <ul>
                    <li><a href="#">Аренда <span>764</span></a></li>
                    <li><a href="#">Продажа <span>100</span></a></li>
                    <li><a href="#">Арендный бизнес <span>33</span></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="realties-item realties-fourth">
            <div class="realties-overlay"></div>
            <div class="realties-title">Зарубежная</div>
            <div class="realties-list">
                <ul>
                    <li><a href="#">Вилла <span>214</span></a></li>
                    <li><a href="#">Апартаменты <span>124</span></a></li>
                    <li><a href="#">Пентхаус <span>27</span></a></li>
                </ul>
                <ul>
                    <li><a href="#">Таунхаус <span>18</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>-->
