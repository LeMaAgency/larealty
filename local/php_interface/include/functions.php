<?php

/**
 * Get element url
 *
 * @param \Lema\Template\Item $item
 * @param array $replace
 *
 * @return string
 */
function getElementDetailUrl(\Lema\Template\Item $item, array $replace = array())
{
    if(empty($replace))
    {
        $replace = array(
            '#RENT_TYPE#' => $item->propXmlId('RENT_TYPE'),
            '#REALTY_TYPE#' => $item->propXmlId('REALTY_TYPE'),
        );
    }

    return strtr($item->detailUrl(), $replace);
}

/**
 * @param $key
 * @param $value
 * @param array|null $data
 *
 * @return bool
 */
function isActive($key, $value, array $data = null)
{
    if(empty($data))
        $data = $_REQUEST;
    return isset($data[$key]) && $data[$key] == $value;
}

/**
 * @param $key
 * @param $value
 * @param string $returnClass
 * @param array|null $data
 *
 * @return null|string
 */
function activeClass($key, $value, $returnClass = ' active', array $data = null)
{
    return isActive($key, $value, $data) ? $returnClass : null;
}

/**
 * @param $key
 * @param $value
 * @param array|null $data
 *
 * @return null|string
 */
function checked($key, $value, array $data = null)
{
    return isActive($key, $value, $data) ? ' checked' : null;
}