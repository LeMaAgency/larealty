<?php
$DOCUMENT_ROOT = realpath(__DIR__ . '/../../');
$_SERVER['DOCUMENT_ROOT'] = $DOCUMENT_ROOT;

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

$data = \Lema\Base\Parser::get()->setUrl('http://blackwood.ru/catalog/city')->parse();
\Lema\Common\Dumper::dump($data);