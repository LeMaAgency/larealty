<?php

/**
 * Get element url
 *
 * @param \Lema\Template\Item $item
 * @param array $replace
 *
 * @return string
 */
function getElementDetailUrl(\Lema\Template\Item $item, array $replace = array(), $inCatalog = true)
{
    if(empty($replace))
    {
        $replace = array(
            '#RENT_TYPE#' => $item->propXmlId('RENT_TYPE'),
            '#REALTY_TYPE#' => $item->propXmlId('REALTY_TYPE'),
        );
    }
    if(!$inCatalog)
        $replace['catalog'] = 'rent';

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
/**
 * @param $key
 * @param $value
 * @param array|null $data
 *
 * @return null|string
 */
function selected($key, $value, array $data = null)
{
    return isActive($key, $value, $data) ? ' selected' : null;
}

function uploadFileData(array $files, $maxCount = null)
{
    $returnData = array(
        'fileIds' => array(),
        'fileData' => array(),
    );
    if(empty($files['tmp_name']))
        return $returnData;
    //one file
    if(!is_array($files['tmp_name']))
    {
        $fileId = \CFile::SaveFile($files,'iblock');
        if($fileId)
        {
            $returnData['fileIds'] = $fileId;
            $returnData['fileData'] = \CFile::MakeFileArray($fileId);
        }
        return $returnData;
    }
    //multiple files
    $pushData = array_flip(array_keys($files));
    //max count of uploaded files
    $cnt = count($files['tmp_name']);
    if(isset($maxCount))
    {
        if($maxCount < count($files['tmp_name']))
            $cnt = $maxCount;
    }
    for($i = 0; $i < $cnt; ++$i)
    {
        foreach($pushData as $key => $v)
            $pushData[$key] = $files[$key][$i];
        $fileId = \CFile::SaveFile($pushData,'iblock');
        if($fileId)
        {
            $returnData['fileIds'][] = $fileId;
            $returnData['fileData'][] = \CFile::MakeFileArray($fileId);
        }
    }
    return $returnData;
}