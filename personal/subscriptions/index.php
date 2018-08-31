<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Подписки");
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <? \Lema\Components\Breadcrumbs::inc('breadcrumbs'); ?>
            </div>
        </div>
    </div>
    <div class="container">
        <? $APPLICATION->IncludeComponent('bitrix:menu', 'personal_buttons', array(
            'ALLOW_MULTI_SELECT' => 'N',
            'ROOT_MENU_TYPE' => 'personal',
            'CHILD_MENU_TYPE' => 'left',
            'DELAY' => 'N',
            'MAX_LEVEL' => '1',
            'MENU_CACHE_GET_VARS' => array(),
            'MENU_CACHE_TIME' => '3600',
            'MENU_CACHE_TYPE' => 'A',
            'MENU_CACHE_USE_GROUPS' => 'N',
            'USE_EXT' => 'Y',
            'COMPONENT_TEMPLATE' => 'personal'
        )); ?>

        <?
        $APPLICATION->IncludeComponent(
            'lema:basket',
            'subscriptions',
            array(
                'AJAX_MODE' => 'Y',
                "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
                "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
                "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
                "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
                'CACHE_TYPE' => 'N'
            )); ?>
    </div>
<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");