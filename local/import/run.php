<?php
$DOCUMENT_ROOT = realpath(__DIR__ . '/../../');
$_SERVER['DOCUMENT_ROOT'] = $DOCUMENT_ROOT;

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

\Bitrix\Main\Loader::includeModule('iblock');

$parser = \Lema\Base\Parser::get();
$properties = $parser->setUrl('http://blackwood.ru/catalog/city')->parse();

$parser->loadCategories(\LIblock::getId('objects'), $parser->getCategories());
$parser->loadElements(\LIblock::getId('objects'), $properties);

\Lema\Common\Dumper::dump('Done.');