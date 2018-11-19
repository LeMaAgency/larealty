<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

global $APPLICATION;

?><!DOCTYPE html>
<html lang="<?=LANGUAGE_ID;?>">

<head>

    <?php
    $APPLICATION->ShowHead();

    \Lema\Common\AssetManager::get()
        ->init(array('fx'))
        ->addCssArray(array(
            '//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i&amp;subset=cyrillic',
            '/assets/old/css/fonts/fonts.css',
            '/assets/old/css/normalize.css',
            '/assets/old/css/bootstrap.min.css',
            '/assets/old/css/cs-select.css',
            '/assets/old/css/cs-skin-border.css',
            '/assets/old/css/owl.carousel.min.css',
            '/assets/old/css/slick.css',
            '/assets/old/css/jquery.fancybox.min.css',
            '/assets/old/css/nouislider.css',
            '/assets/old/css/main.css',
            '/assets/old/css/media.css',
            '/assets/old/css/custom.css',
        ))
        ->addJsArray(array(
            '/assets/old/js/jquery-3.2.1.min.js',
            '/assets/old/js/jquery.fancybox.min.js',
            '/assets/old/js/owl.carousel.min.js',
            '/assets/old/js/nouislider.min.js',
            '/assets/old/js/slick.min.js',
            '/assets/old/js/selectFx.js',
            '/assets/old/js/classie.js',
            '/assets/old/js/main.js',
            '/assets/old/js/custom.js',
        ));
    ?>

    <link href="/assets/old/css/imports.css" rel="stylesheet" media="all">

    <title><?$APPLICATION->ShowTitle();?></title>

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBr4vuLpC6apKgl5YdtNOgYqjiRerk8X_I&callback=initMap" async defer></script>

</head>

<body class="catalog">

    <? $APPLICATION->ShowPanel(); ?>

    <header class="header">
        <div class="header-top-line">
            <div class="container">
                <? $APPLICATION->IncludeComponent('bitrix:menu', 'top_menu', array(
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
                    'COMPONENT_TEMPLATE' => 'top_menu'
                )); ?>
            </div>
        </div>
        <div class="header-contacts container-index">
            <div class="header-logo"><img src="/assets/old/img/logo.png"></div>
            <div class="header-contacts-block">
                <div class="header-phone"><? $APPLICATION->IncludeFile(SITE_DIR . 'include/old/header/phone.php'); ?></div>
                <div class="header-account">
                    <?if(\Lema\Common\User::isGuest()):?>
                        <a href="<?=SITE_DIR;?>auth/?login=yes" class="header-account-link signin-link link-hvr">
                            <?=Loc::getMessage('LEMA_HEADER_SIGNIN_LINK');?>
                        </a>
                        <span class="header-account-border"></span>
                        <a href="<?=SITE_DIR;?>auth/?register=yes" class="header-account-link signup-link link-hvr">
                            <?=Loc::getMessage('LEMA_HEADER_SIGNUP_LINK');?>
                        </a>
                    <?else:?>
                        <a href="<?=SITE_DIR;?>personal/" class="header-account-link signin-link link-hvr">
                            <?=Loc::getMessage('LEMA_HEADER_PERSONAL_LINK');?>
                        </a>
                        <span class="header-account-border"></span>
                        <a href="?logout=yes" class="header-account-link signin-link link-hvr">
                            <?=Loc::getMessage('LEMA_HEADER_LOGOUT_LINK');?>
                        </a>
                    <?endif;?>
                </div>
            </div>
        </div>
        <div class="header-main-menu">
            <div class="container">
                <div class="mobile-menu"></div>
                <? $APPLICATION->IncludeComponent('bitrix:menu', 'header_menu', array(
                    'ALLOW_MULTI_SELECT' => 'N',
                    'ROOT_MENU_TYPE' => 'header',
                    'CHILD_MENU_TYPE' => 'header',
                    'DELAY' => 'N',
                    'MAX_LEVEL' => '1',
                    'MENU_CACHE_GET_VARS' => array(),
                    'MENU_CACHE_TIME' => '3600',
                    'MENU_CACHE_TYPE' => 'A',
                    'MENU_CACHE_USE_GROUPS' => 'N',
                    'USE_EXT' => 'Y',
                    'COMPONENT_TEMPLATE' => 'header_menu'
                )); ?>
            </div>
        </div>
    </header>