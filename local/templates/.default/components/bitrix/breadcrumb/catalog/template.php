<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//delayed function must return a string
if(empty($arResult))
	return '';

$strReturn = '<div class="breadcrumbs"><ul>';

for($index = 0, $itemSize = count($arResult), $last = $itemSize - 1; $index < $itemSize; ++$index)
{
	$title = htmlspecialcharsEx($arResult[$index]['TITLE']);

	if(!empty($arResult[$index]['LINK']) && $index !== $last)
	{
		$strReturn .= '
			<li>
				<a href="'.$arResult[$index]['LINK'].'" title="'.$title.'">
					'.$title.'
				</a>
			</li>';
	}
	else
	{
		$strReturn .= '
			<li>
				<span class="breadcrumb-active">'.$title.'</span>
			</li>';
	}
}

$strReturn .= '</ul></div>';

return $strReturn;


?>