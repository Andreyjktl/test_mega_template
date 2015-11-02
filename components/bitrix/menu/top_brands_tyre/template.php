<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//print '<pre>';
//print_r($arResult);
//print '</pre>';
?>


<?if (!empty($arResult)):?>
<div class="submenu2">

		<a href="<?=SITE_DIR?>tyres"><h4>Каталог шин</h4></a>
    	<div class="table">
		<?
		$cnt = count($arResult);
		$in_list = ceil($cnt/6);
		
		echo '<ul>';
		$i = 0;
		foreach($arResult as $arItem){
			if($i%$in_list==0&&$i!=0){
				echo '</ul><ul>';
			}
		
			if ($arItem["PERMISSION"] > "D"){
					echo '<li><a href="'.$arItem["LINK"].'">
					'.($arItem["SELECTED"]?'<strong>':'').'<nobr>'.$arItem["TEXT"].'</nobr>
					'.($arItem["SELECTED"]?'</strong>':'').'
					</a></li>';
			}
			$i++;
		}
		echo '</ul>';
		?>


 <div class="clear"></div>


	<h4 style="align:center;">Случайные товары</h4>
  <div class="menu_photo" >		
	<?$APPLICATION->IncludeComponent(
	"bitrix:photo.random",
	"",
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCKS" => array("4"),
		"DETAIL_URL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "180",
		"CACHE_GROUPS" => "Y",
		"PARENT_SECTION" => ""
	)
	);?> 
	</div>

</div>
<?endif?>
