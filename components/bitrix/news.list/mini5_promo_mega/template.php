<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


    <div class="promo5">
<?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <div class="promo5_1">

        <?if(is_array($arItem["PREVIEW_PICTURE"])):?>
            <div class="tires">
                <a href="<?=$arItem['PROPERTIES']['promo_link']['VALUE']?>">
                 <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                 width= "100%"
                 alt="<?=$arItem["NAME"]?>" 
                 title="<?=$arItem["NAME"]?>" />
                 </a>
            </div>
        <?endif?>
    
    </div>
    
<?endforeach;?>
   
</div>
<!-- // Promo -->