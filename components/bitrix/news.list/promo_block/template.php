<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="promo">
<?if (count($arResult["ITEMS"]) > 1) {?>
    <div class="arrow prev"></div>
    <div class="arrow next"></div>
<?}?>
    <ul class="promo">
<?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <li style="width:20%"> id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <?if(is_array($arItem["PREVIEW_PICTURE"])):?>
            <div class="tires">
            <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
            </div>
        <?endif?>
        <?if(is_array($arItem["DETAIL_PICTURE"])):?>
            <div class="image">
            <img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arItem["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arItem["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
            </div>
        <?endif?>
        <div class="sticker">
            <div class="bg"><div>
            <h3><?if(strlen($arItem['PROPERTIES']['promo_link']['VALUE']) > 0):?>
                <a href="<?=$arItem['PROPERTIES']['promo_link']['VALUE']?>"><?=$arItem["NAME"]?></a>
                <?else:?>
                <?=$arItem["NAME"]?>
            <?endif?></h3>
            <?if(strlen($arItem["DETAIL_TEXT"]) > 0):?>
                <?=$arItem["DETAIL_TEXT"];?>
            <?endif;?>
            </div></div>
        </div>
    </li>
    
<?endforeach;?>
    </ul>
</div>
<!-- // Promo -->