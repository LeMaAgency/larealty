<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

//Фильрация по свойству SHOW_IN_NEW_OBJ_BLOCK
$newsOnMainPage = array();
foreach ($arResult['ITEMS'] as $arItem)
{
    if($arItem['PROPERTIES']['SHOW_IN_NEWS_BLOCK']['VALUE'])
    {
        $newsOnMainPage[] = $arItem;
    }
}
$arResult['ITEMS'] = $newsOnMainPage;