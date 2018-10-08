<?
defined('NEED_AUTH') or define('NEED_AUTH', true);

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$APPLICATION->SetTitle('Личный кабинет');
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <? \Lema\Components\Breadcrumbs::inc('breadcrumbs'); ?>
            </div>
        </div>
    </div>


    <div class="container">
        <h1><? $APPLICATION->ShowTitle(false); ?></h1>
        <br><br>
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
        <br><br>
    </div>
<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
?>