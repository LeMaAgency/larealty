<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = array(
    'NAME' => Loc::getMessage('STATISTICS_COMPONENT_NAME'),
    'DESCRIPTION' => Loc::getMessage('STATISTICS_COMPONENT_DESCRIPTION'),
    'PATH' => array(
        'ID' => 'lema_statistics',
    ),
    'ICON' => '/images/icon.gif',
);