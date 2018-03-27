<?php

$eventManager = \Bitrix\Main\EventManager::getInstance();

//page start
AddEventHandler('main', 'OnPageStart', 'loadLemaLib', 1);
function loadLemaLib()
{
    \Bitrix\Main\Loader::includeModule('lema.lib');
}

$events = array('Add', 'Update', 'Delete');


foreach($events as $event)
{
    /**
     * IBlock element events
     */
    $eventManager->addEventHandler(
        'iblock',
        'OnBeforeIBlockElement' . $event,
        array('\\Lema\\Handlers\\IblockElement', 'before' . $event)
    );
    $eventManager->addEventHandler(
        'iblock',
        'OnAfterIBlockElement' . $event,
        array('\\Lema\\Handlers\\IblockElement', 'after' . $event)
    );
}