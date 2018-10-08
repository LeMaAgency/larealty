<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<nav class="header-menu">

<?
foreach($arResult as $arItem):
	if($arParams['MAX_LEVEL'] == 1 && $arItem['DEPTH_LEVEL'] > 1)
		continue;
?>
	<?if($arItem['SELECTED']):?>
		<a href="<?=$arItem['LINK']?>" class="header-menu-link hvr-sweep-to-top selected"><?=$arItem['TEXT']?></a>
	<?else:?>
		<a class="header-menu-link hvr-sweep-to-top" href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a>
	<?endif?>

<?endforeach?>

</nav>
<?endif?>