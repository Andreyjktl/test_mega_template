<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<form name="<?echo $arResult['FILTER_NAME']."_form"?>" action="<?echo $arResult['FORM_ACTION']?>" method="get" class="ts-form ts-filter">
	<?foreach($arResult['ITEMS'] as $arItem):
		if(array_key_exists("HIDDEN", $arItem)):
			echo $arItem['INPUT'];
		endif;
	endforeach;?>
		<div class="ts-items">
		<?foreach($arResult['ITEMS'] as $arItem):?>
			<?if(!array_key_exists("HIDDEN", $arItem)):?>
					<div class="ts-item" style="width: <?=intval(100 / $arParams['ELEMENT_IN_ROW']);?>%;">
						<span class="ts-name" style="color:black; width: <?=$arParams['NAME_WIDTH'];?>px;"><?=$arItem['NAME'];?>:</span> <?=$arItem['INPUT'];?>
					</div>
			<?endif?>
		<?endforeach;?>
	</div>
	<div class="ts-buttons" style="text-align: <?=$arParams['BUTTON_ALIGN'];?>">
		<button type="submit" name="set_filter" value="<?=GetMessage("IBLOCK_SET_FILTER")?>"><?=GetMessage("IBLOCK_SET_FILTER");?></button>  
		<button type="submit" name="del_filter" value="<?=GetMessage("IBLOCK_DEL_FILTER")?>"><?=GetMessage("IBLOCK_DEL_FILTER");?></button>
	</div>
</form>