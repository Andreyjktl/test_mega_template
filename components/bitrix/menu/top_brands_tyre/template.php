<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//print '<pre>';
//print_r($arResult);
//print '</pre>';
?>



<div class="submenu2" style="width:800px !important;">

			<?//<div class="submenu2_1"></div>?>

			<div class="submenu2_2">
				<h4>Подбор шин</h4>
			<?$APPLICATION->IncludeComponent(
				"dvs:dvs.filter",
				"filter_tyres_vertical",
				Array(
					"A_IBLOCK_ID" => "8",
					"B_IBLOCK_ID" => "4",
					"COMPONENT_TEMPLATE" => "filter",
					"IBLOCK_ID" => "5",
					"USER_PROPERTY_NAME" => "",
					"W_B_IBLOCK_ID" => "6",
					"W_IBLOCK_ID" => "7"
				)
			);?>

				
			</div>

			<div class="submenu2_3">
				<?if (!empty($arResult)):?>
					<a href="<?=SITE_DIR?>tyres"><h4>Каталог шин</h4></a>
			    	<div class="table">
							<?
							$cnt = count($arResult);
							$in_list = ceil($cnt/3);
							
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
					</div>
				<?endif?>

			</div>

			<div class="submenu2_4">
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

		




</div>
<div class="clear"></div>

