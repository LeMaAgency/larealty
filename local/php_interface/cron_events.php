<?php

$_SERVER['DOCUMENT_ROOT'] = realpath(dirname(__FILE__).'/../..');

$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];

define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS',true);
define('CHK_EVENT', true);

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

@set_time_limit(0);
@ignore_user_abort(true);

CAgent::CheckAgents();
define('BX_CRONTAB_SUPPORT', true);
define('BX_CRONTAB', true);

CEvent::CheckEvents();

if (CModule::IncludeModule('subscribe'))
{
    $cPosting = new CPosting;
    $cPosting->AutoSend();
}

file_put_contents($DOCUMENT_ROOT . '/cron_run.txt', date('d.m.Y H:i:s'). PHP_EOL, FILE_APPEND);