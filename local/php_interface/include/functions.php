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