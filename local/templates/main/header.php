<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

global $APPLICATION;

?><!DOCTYPE html>
<html lang="<?= LANGUAGE_ID; ?>">

<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-T9WCHR2');</script>
<!-- End Google Tag Manager -->
    <?php
    $APPLICATION->ShowHead();

    \Lema\Common\AssetManager::get()
        ->init(array('fx'))
        ->addCssArray(array(
            '/assets/css/jquery.fancybox.min.css',
            '/assets/css/libs.min.css',
            '/assets/css/slick.css',
            '/assets/css/slick-theme.css',
            '/assets/css/main.css',
            '/assets/fonts/stylesheet.css',
            '/assets/css/custom.css',
        ))
        ->addJsArray(array(
            '/assets/js/jquery-3.2.1.min.js',
            '/assets/js/libs.min.js',
            '/assets/js/jquery.fancybox.min.js',
            '/assets/js/slick.min.js',
            '//use.fontawesome.com/acae6499e9.js',
            '/assets/js/common.js',
            '/assets/js/jquery.mask.min.js',
            '/assets/js/custom.js',
        ));
    ?>

    <title><? $APPLICATION->ShowTitle(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC13YDGbR523RNjDydlddANioNBMMFSRkg&callback=initMap" async defer></script>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=4a23621a-c827-4cb9-af68-a5062ae93b06&lang=ru_RU" type="text/javascript"></script>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T9WCHR2"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<? $APPLICATION->ShowPanel(); ?>
<div class="pre_header">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-3">
                <div class="city_selector pre_header_item">
                    <div class="geo_icon">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                    </div>
                    <div class="city_name">
                        Москва
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-9 pre_header_menu_and_button">
                <div class="pre_header_menu pre_header_item">
                    <? $APPLICATION->IncludeComponent("bitrix:menu", "pre_header_menu", Array(
                        "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                        "ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
                        "CHILD_MENU_TYPE" => "top",	// Тип меню для остальных уровней
                        "DELAY" => "N",	// Откладывать выполнение шаблона меню
                        "MAX_LEVEL" => "1",	// Уровень вложенности меню
                        "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                        "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                        "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                        "MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
                        "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                        "COMPONENT_TEMPLATE" => "pre_header_menu"
                    ),
                        false
                    ); ?>
                </div>

                <div class="pre_header_item">
                    <a class="zayavka_button" href="/ostavit-zayavku-na-prodazhu-pokupku/">Оставить заявку</a>
                </div>
            </div>
        </div>
    </div>

</div>
<header>
    <div class="container desc-header">
        <div class="row">
            <div class="col-lg-4 col-md-4">

                <div class="logo">
                    <? if ($APPLICATION->GetCurDir() == SITE_DIR): ?>
                        <img src="/assets/img/logo.png" alt="logo">
                    <? else: ?>
                        <a href="/">
                            <img src="/assets/img/logo.png" alt="logo">
                        </a>
                    <? endif; ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="slogan">
                    Недвижимость. Инвестиции. Консалтинг.
                </div>
                <!--<div class="header-menu">
                    <?/* $APPLICATION->IncludeComponent(
                        'bitrix:menu',
                        'top__menu',
                        array(
                            'ALLOW_MULTI_SELECT' => 'N',
                            'ROOT_MENU_TYPE' => 'top',
                            'CHILD_MENU_TYPE' => 'top',
                            'DELAY' => 'N',
                            'MAX_LEVEL' => '1',
                            'MENU_CACHE_GET_VARS' => array(),
                            'MENU_CACHE_TIME' => '3600',
                            'MENU_CACHE_TYPE' => 'A',
                            'MENU_CACHE_USE_GROUPS' => 'N',
                            'USE_EXT' => 'Y',
                            'COMPONENT_TEMPLATE' => 'top__menu'
                        )); */?>
                </div>-->
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="header-contact">
                    <div class="header-phone">
                        <? $APPLICATION->IncludeFile(SITE_DIR . 'include/header/phone.php'); ?>
                    </div>
                    <!--<div class="header-callback">
                        <a class="hlink js-order-call" href="#">
                            <?/* $APPLICATION->IncludeFile(SITE_DIR . 'include/header/phone-text.php'); */?>
                        </a>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-header">
        <div class="top-header">
            <div class="logo">
                <a href="/">
                    <img src="/assets/img/logo.png" alt="logo">
                </a>
            </div>
            <div class="btn-menu">
                <a href="#">
                    <img src="/assets/img/menu.png" alt="open-menu">
                </a>
            </div>
        </div>
        <div class="open-menu">
            <div class="open-head">
                <div class="logo">
                    <a href="/">
                        <img src="/assets/img/small-logo.png" alt="logo">
                    </a>
                </div>
                <div class="header-list">
                    <div class="header-item">
                        <a href="#">
                            <img src="/assets/img/phone.png" alt="phone">
                        </a>
                    </div>
                    <div class="header-item">
                        <a href="#">
                            <img src="/assets/img/star.png" alt="star">
                        </a>
                    </div>
                    <div class="header-item close">
                        <a class="close-menu" href="#">
                            <img src="/assets/img/close-menu.png"
                                 alt="close-menu">
                        </a>
                    </div>
                </div>
            </div>
<!--            <ul class="mobile-menu"></ul>-->
            <div class="main-menu_mobile">
                <? $APPLICATION->IncludeComponent("bitrix:menu", "top_menu_iblock_mobile", Array(
                    "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                    "ROOT_MENU_TYPE" => "main",	// Тип меню для первого уровня
                    "CHILD_MENU_TYPE" => "main",	// Тип меню для остальных уровней
                    "DELAY" => "N",	// Откладывать выполнение шаблона меню
                    "MAX_LEVEL" => "1",	// Уровень вложенности меню
                    "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                    "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                    "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                    "MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
                    "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                    "COMPONENT_TEMPLATE" => "top_menu_iblock_mobile"
                ),
                    false
                ); ?>
                <? $APPLICATION->IncludeComponent("bitrix:menu", "top_menu_iblock_mobile", Array(
                    "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                    "ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
                    "CHILD_MENU_TYPE" => "top",	// Тип меню для остальных уровней
                    "DELAY" => "N",	// Откладывать выполнение шаблона меню
                    "MAX_LEVEL" => "1",	// Уровень вложенности меню
                    "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                    "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                    "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                    "MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
                    "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                    "COMPONENT_TEMPLATE" => "top_menu_iblock_mobile"
                ),
                    false
                ); ?>
            </div>
            <div class="header-contact">
                <div class="header-phone">
                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/header/phone.php'); ?>
                </div>
                <div class="header-callback">
                    <a class="hlink js-order-call" href="#">
                        <? $APPLICATION->IncludeFile(SITE_DIR . 'include/header/phone-text.php'); ?>
                    </a>
                    <a class="hlink zayavka" href="/ostavit-zayavku-na-prodazhu-pokupku/">
                        Оставить заявку
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
<nav class="main-menu">
    <div class="container">
        <? $APPLICATION->IncludeComponent("bitrix:menu", "top_menu_iblock", Array(
	"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
		"ROOT_MENU_TYPE" => "main",	// Тип меню для первого уровня
		"CHILD_MENU_TYPE" => "main",	// Тип меню для остальных уровней
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"MAX_LEVEL" => "1",	// Уровень вложенности меню
		"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
		"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"MENU_CACHE_TYPE" => "A",	// Тип кеширования
		"MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
		"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
		"COMPONENT_TEMPLATE" => "top__menu"
	),
	false
); ?>
    </div>
</nav>