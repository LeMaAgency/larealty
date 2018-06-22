<?php

namespace Lema\Handlers;

use \Bitrix\Main\Localization\Loc;
use \Lema\Common\Request;

Loc::loadMessages(__FILE__);

/**
 * Class Main
 * @package Lema\Handlers
 */
class Main
{
    const ADMIN_NEW_LIST_FILENAME = '/bitrix/admin/la_iblock_list_admin.php';
    const ADMIN_DEFAULT_LIST_FILENAME = '/bitrix/admin/iblock_list_admin.php';
    /**
     * @param $list
     */
    public static function adminListDisplay(&$list)
    {
        if(isset($list->context, $list->context->additional_items))
        {
            //add custom group action
            $list->context->additional_items[] = array(
                'TEXT' => 'Печать', 'TITLE' => 'Распечатать страницу', 'ONCLICK' => 'window.print();',
                'GLOBAL_ICON' => 'adm-menu-copy',
            );
        }

        /**
         * Auto-Redirect to our new page
         */
        if(isset($_GET['IBLOCK_ID']) && $_GET['IBLOCK_ID'] == 2 && Request::get()->getPhpSelf() == static::ADMIN_DEFAULT_LIST_FILENAME)
        {
            LocalRedirect(static::ADMIN_NEW_LIST_FILENAME . '?' . http_build_query($_GET));
            exit;
        }
    }
}