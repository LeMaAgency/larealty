<?php

namespace Lema\Handlers;

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

/**
 * Class Main
 * @package Lema\Handlers
 */
class Main
{
    /**
     * @param $list
     */
    public static function adminListDisplay(&$list)
    {
        \Lema\Common\Dumper::dump($list->context);
        //add custom group action
        $list->context->additional_items[] =(array(
            'TEXT' => 'Excel 2',
            'TITLE' => 'Выгрузить данные из списка в Excel',
            'ONCLICK' => 'alert("FOO");',
            'GLOBAL_ICON' => 'adm-menu-excel',
        ));
    }
}