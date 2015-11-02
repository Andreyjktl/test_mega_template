<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script type="text/javascript">
	window.basket = [<?= implode(",", $_SESSION["TYRES"]["BASKET"][$_SESSION["SALE_USER_ID"]]); ?>];
</script>
<?
foreach($arResult["SECTION"]["PATH"] as $arPath){
    $APPLICATION->AddChainItem($arPath["NAME"], $arPath["~SECTION_PAGE_URL"]);
}

if(isset($arResult['DETAIL_PAGE_URL'])){
    $APPLICATION->AddChainItem($arResult['NAME'], $arResult['DETAIL_PAGE_URL']);
}
require_once $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/include_areas/popup.php";
?>