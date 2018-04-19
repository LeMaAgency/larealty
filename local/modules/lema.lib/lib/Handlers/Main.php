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
        //add custom group action
        $list->context->additional_items[] = array(
            'TEXT' => 'Печать',
            'TITLE' => 'Распечатать страницу',
            'ONCLICK' => 'window.print();',
            'GLOBAL_ICON' => 'adm-menu-copy',
        );
    }
}