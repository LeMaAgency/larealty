<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

/**
 * Set filter by ID only
 */
if(!empty($arParams['FILTER_NAME']) && !empty($_GET['arrFilter_ff']['ID']))
{
    $GLOBALS[$arParams['FILTER_NAME']] = array('=ID' => (int) $_GET['arrFilter_ff']['ID']);
}
