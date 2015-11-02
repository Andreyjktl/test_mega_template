<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$arS = CSiteWheelsStore::TCatalogSectionRM($arResult['ITEMS']); // module function call
$arResult['ITEMS'] = $arS[0];
$arResult['SEASONS'] = $arS[1];
?>