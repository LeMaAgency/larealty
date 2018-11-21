<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

global $APPLICATION;

?><!DOCTYPE html>
<html lang="<?= LANGUAGE_ID; ?>">

<head>

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
            '/assets/js/custom.js',
        ));
    ?>

    <title><? $APPLICATION->ShowTitle(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<body>
<? $APPLICATION->ShowPanel(); ?>
<header>
    <div class="container desc-header">
        <div class="row">
            <div class="col-lg-3 col-md-4">

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
                <div class="header-menu">
                    <? $APPLICATION->IncludeComponent(
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
                        )); ?>
                </div>
            </div>
            <div class="col-lg-5 col-md-4">
                <div class="header-contact">
                    <div class="header-phone">
                        <? $APPLICATION->IncludeFile(SITE_DIR . 'include/header/phone.php'); ?>
                    </div>
                    <div class="header-callback">
                        <a class="hlink" href="#">
                            <? $APPLICATION->IncludeFile(SITE_DIR . 'include/header/phone-text.php'); ?>
                        </a>
                    </div>
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
            <ul class="mobile-menu"></ul>
            <div class="header-contact">
                <div class="header-phone">
                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/header/phone.php'); ?>
                </div>
                <div class="header-callback">
                    <a class="hlink" href="#">
                        <? $APPLICATION->IncludeFile(SITE_DIR . 'include/header/phone-text.php'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
<nav class="main-menu">
    <div class="container">
        <? $APPLICATION->IncludeComponent(
            'bitrix:menu',
            'top__menu',
            array(
                'ALLOW_MULTI_SELECT' => 'N',
                'ROOT_MENU_TYPE' => 'main',
                'CHILD_MENU_TYPE' => 'main',
                'DELAY' => 'N',
                'MAX_LEVEL' => '1',
                'MENU_CACHE_GET_VARS' => array(),
                'MENU_CACHE_TIME' => '3600',
                'MENU_CACHE_TYPE' => 'A',
                'MENU_CACHE_USE_GROUPS' => 'N',
                'USE_EXT' => 'Y',
                'COMPONENT_TEMPLATE' => 'top__menu'
            )); ?>
    </div>
</nav>