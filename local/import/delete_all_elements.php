<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

\Bitrix\Main\Loader::includeModule('iblock');

$iblockId = isset($_GET['iblockId']) ? (int) $_GET['iblockId'] : 0;
$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 100;

if(empty($iblockId))
    throw new \Exception('You must to specify iblock');

$res = \Bitrix\Iblock\ElementTable::getList(array(
    'filter' => array('IBLOCK_ID' => $iblockId),
    'select' => array('ID'),
    'limit' => 100,
));

if(($hasElements = (bool) $res->getSelectedRowsCount()))
{
    while ($row = $res->fetch())
    {
        if (\CIBlockElement::Delete($row['ID']))
            echo '<div>Удален элемент ', $row['ID'], '</div>';
        else
            echo '<div>Ошибка удаления элемента ', $row['ID'], '</div>';
    }
    exit('<div>Удаление элементов... </div> <script>document.location="?iblockId=' . $iblockId . '&limit=' . $limit .'";</script>');
}
else
    echo '<div>Все элементы удалены</div>';