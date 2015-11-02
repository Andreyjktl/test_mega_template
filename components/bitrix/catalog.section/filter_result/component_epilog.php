<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script type="text/javascript">
	window.basket = [<?= implode(",", $_SESSION["TYRES"]["BASKET"][$_SESSION["SALE_USER_ID"]]); ?>];
</script>
<?require_once $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/include_areas/popup.php";?>
