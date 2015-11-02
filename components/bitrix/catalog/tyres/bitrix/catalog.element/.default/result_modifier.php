<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
global $APPLICATION;
$cp = $this->__component;

$cp->arResult['DETAIL_PAGE_URL'] = $arResult['DETAIL_PAGE_URL'];
$cp->arResult['SECTION'] = $arResult['SECTION'];
$cp->SetResultCacheKeys(array('DETAIL_PAGE_URL', 'SECTION'));
?>