<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//print '<pre>';
//print_r($arResult);
//print '</pre>';
?>
	<div class="submenu2" style="width:937px !important;">

		

			<div>
				<h4>Подбор дисков</h4>
					<?$APPLICATION->IncludeComponent(
				"dvs:dvs.filter",
				"filter_wheels_gorisontal",
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

			<div>

					<?if (!empty($arResult)):?>
					<a href="<?=SITE_DIR?>wheels"><h4>Каталоги производителей дисков</h4></a>
									    <div class="table">
									    
									<?
									$cnt = count($arResult);
									$in_list = ceil($cnt/10);

									echo '<ul>';
									$i = 0;
									foreach($arResult as $arItem){
									    if($i%$in_list==0&&$i!=0){
									        echo '</ul><ul>';
									    }

									    if ($arItem["PERMISSION"] > "D"){
									            echo '<li><a href="'.$arItem["LINK"].'">'.($arItem["SELECTED"]?'<strong>':'').'<nobr>'.$arItem["TEXT"].'</nobr>'.($arItem["SELECTED"]?'</strong>':'').'</a></li>';
									    }
									    $i++;
									}
									echo '</ul>';
									?>
      		</div>
        	<div class="clear"></div>
	</div>

<?endif?>