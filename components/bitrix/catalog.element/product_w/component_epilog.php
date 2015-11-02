<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script type="text/javascript">
	window.basket = [<?= implode(",", $_SESSION["TYRES"]["BASKET"][$_SESSION["SALE_USER_ID"]]); ?>];
</script>
<?
$res = CIBlock::GetByID($arResult['IBLOCK_ID']);
if($ar_res = $res->GetNext()){
	$ar_res['LIST_PAGE_URL'] = str_replace('#SITE_DIR#', SITE_DIR, $ar_res['LIST_PAGE_URL']);
    $APPLICATION->AddChainItem($ar_res['NAME'], $ar_res['LIST_PAGE_URL']);
}

if(isset($arResult['LINK_MODEL']['SECTION']['NAME'])){
    $APPLICATION->AddChainItem($arResult['LINK_MODEL']['SECTION']['NAME'], $arResult['LINK_MODEL']['SECTION']['SECTION_PAGE_URL']);
}

if(isset($arResult['LINK_MODEL']['NAME'])&&isset($arResult['LINK_MODEL']['DETAIL_PAGE_URL'])){
    $APPLICATION->AddChainItem($arResult['LINK_MODEL']['NAME'], $arResult['LINK_MODEL']['DETAIL_PAGE_URL']);
}

$APPLICATION->AddChainItem($arResult['NAME'], $arResult['DETAIL_PAGE_URL']);
require_once $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/include_areas/popup.php";
?>