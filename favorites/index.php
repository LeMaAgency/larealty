<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Избранное");
?>
<?
 $APPLICATION->IncludeComponent('lema:basket', '', array(
     'AJAX_MODE' => 'Y',
     "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
     "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
     "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
     "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
    'CACHE_TYPE' => 'N'
)); ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>