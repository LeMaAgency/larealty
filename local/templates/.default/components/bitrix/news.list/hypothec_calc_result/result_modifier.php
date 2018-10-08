<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Lema\Common\Helper as H,
    Lema\Template\TemplateHelper as TH,
    Bitrix\Main\Localization\Loc;
if(empty($arResult['ITEMS']))
    return ;
Loc::loadMessages(__FILE__);
$this->setFrameMode(true);
$data = new TH($this);


//Добавление элементам картинки родительского раздела
    //Получаем массив разделов
    $sectionIdList = array();
    foreach($data->items() as $item)
    {
        $sectionIdList[] = $item->get("IBLOCK_SECTION_ID");
    }

    if(CModule::IncludeModule("iblock")) {
        if (!empty($sectionIdList))
        {
            $arOrder = Array();
            $arSelect = Array("ID", "NAME", "IBLOCK_ID","PICTURE","UF_SVG_PICTURE",);
            $arFilter = Array("IBLOCK_ID" => 10,"ID"=>$sectionIdList, "ACTIVE" => "Y");
            $res = CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect, false);
            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $sectionsInfo[] = $arFields;
            }
        }
    }
    if (!empty($sectionsInfo)){
        foreach ($sectionsInfo as $section)
        {
            foreach($data->items() as $key=>$item)
            {
                if ($item->get("IBLOCK_SECTION_ID") == $section["ID"])
                {
                    $arResult["ITEMS"][$key]['BANK_NAME'] = $section["NAME"];
                    $arResult["ITEMS"][$key]['SVG_PICTURE'] = CFile::GetPath($section['UF_SVG_PICTURE']);
                    $arResult["ITEMS"][$key]['BANK_PICTURE'] = CFile::GetPath($section["PICTURE"]);
                }
            }
        }
    }
