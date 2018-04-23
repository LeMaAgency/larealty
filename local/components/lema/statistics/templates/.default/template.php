<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

/**
 * @param $component StatisticsComponent
 */

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

?>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Общее количество объектов</th>
            <th>Количество объектов на сотрудниках</th>
            <th>Объекты с задатками</th>
            <th>Количество успешных сделок</th>
            <th>Количество объектов, добавленных сегодня</th>
            <th>Количество пришедших заявок</th>
            <th>Количество объектов в работе</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?=$component->getTotalObjectsCount();?></td>
            <td><?=$component->getTotalRieltorObjectsCount();?></td>
            <td><?=$component->getTotalDepositObjectsCount();?></td>
            <td>-</td>
            <td><?=$component->getTotalTodayObjectsCount();?></td>
            <td>-</td>
            <td><?=$component->getTotalWorkObjectsCount();?></td>
        </tr>
    </tbody>
</table>
