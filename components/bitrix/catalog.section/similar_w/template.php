<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$arImgs = $arData = array();
foreach($arResult["ITEMS"] as $arElement){
    $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));

    $sale = $hit = false;

    if (strtolower($arElement['PROPERTIES']['wheels_hit']['VALUE_XML_ID']) == 'yes'){
        $hit = true;
    }
    
    $iPrice = $iDiscount = $iDiscountDiff = -1;
    $sPrice = $sDiscount = $sDiscountDiff = "";
    foreach($arElement["PRICES"] as $code => $arPrice){
        if($arPrice["CAN_ACCESS"] == "Y") { // ѕользователь может видеть цену
            if ($arPrice["CAN_BUY"] == "Y") { // ѕользователь может покупать по этой цене
                if (($iPrice < 0) || ($iDiscount < 0) || ($iDiscount > $arPrice["DISCOUNT_VALUE"])) {

                    $iPrice = $arPrice["VALUE"];
                    $sPrice = $arPrice["PRINT_VALUE"];

                    $iDiscount = $arPrice["DISCOUNT_VALUE"];
                    $sDiscount = $arPrice["PRINT_DISCOUNT_VALUE"];

                    $iDiscountDiff = $arPrice["DISCOUNT_DIFF"];
                    $sDiscountDiff = $arPrice["PRINT_DISCOUNT_DIFF"];
                }
            }
        }
    }
    if($iDiscount < $iPrice){
        $price = '<p><span class="strike">'.$iPrice.' <span class="rubl">'.GetMessage("DVS_RUB").'</span></span> ('.($iDiscountDiff).' <span class="rubl">'.GetMessage("DVS_RUB").'</span>)</p>
                  <p class="price">'.$arPrice["DISCOUNT_VALUE"].' <span class="rubl">'.GetMessage("DVS_RUB").'</span></p>';
        $sale = true;
    } else {
        $price = '<p class="price">'.$iPrice.' <span class="rubl">'.GetMessage("DVS_RUB").'</span></p>';
    }

    $quantity = '';
    if($arElement['CATALOG_QUANTITY'] < 1){
        $quantity = '<p><span class="absent">'.dvsListABSENT.'</span></p>';//***
    } elseif($arElement['CATALOG_QUANTITY'] > 4){
        $quantity = '<p>&gt;4' . dvsListQUANTITY.'</p>';//***
    } else {
        $quantity = '<p>'.$arElement['CATALOG_QUANTITY'] . dvsListQUANTITY.'</p>';//***
    }

    $icons = '';
    if ($sale || $hit) {
        $icons = '<ul class="icons">'.
            ($sale ? '<li><span class="red">'.dvsSALE.'</span></li>' : '')//***
            .
            ($hit ? '<li><span class="green">'.dvsHIT.'</span></li>' : '')//***
        .'</ul>';
    }

    if (is_array($arElement['PREVIEW_PICTURE'])) {
        $picture = $arElement['PREVIEW_PICTURE']['SRC'];
        $width = $arElement['PREVIEW_PICTURE']['WIDTH'];
        $height = $arElement['PREVIEW_PICTURE']['HEIGHT'];
    } else {
        $picture = "/images/photo.png";
        $width = 100;
        $height = 100;
    }

    $arImgs[] = '<td><div><a href="'.$arElement['DETAIL_PAGE_URL'].'"><img id="i'.$arElement['ID'].'" src="'.$picture.'" width="'.$width.'" height="'.$height.'" alt="'.$arElement['NAME'].'" /></a>'.$icons.'</div></td>';

    $arData[] = '<td id="'.$this->GetEditAreaId($arElement['ID']).'">
        <h4 id="name'.$arElement['ID'].'"><a href="'.$arElement['DETAIL_PAGE_URL'].'">'.$arElement['NAME'].'</a></h4>
        '.$quantity.'
        '.$price.'
        <form action="'.POST_FORM_ACTION_URI.'" method="post" enctype="multipart/form-data">
            <input type="hidden" name="'.$arParams["ACTION_VARIABLE"].'" value="BUY">
            <input type="hidden" name="'.$arParams["PRODUCT_ID_VARIABLE"].'" value="'.$arElement["ID"].'">
            <input type="hidden" name="'.$arParams["ACTION_VARIABLE"].'BUY" value="Y">
            <div class="tocart buy-i" itemID="'.$arElement['ID'].'" offerStatus="'.($arElement['CATALOG_QUANTITY']==0?'not-available':'available').'">
                    <input type="hidden" id="price'.$arElement['ID'].'" value="'.$iDiscount.'" />
                    <input type="text" id="count'.$arElement['ID'].'" name="'.$arParams["PRODUCT_QUANTITY_VARIABLE"].'" value="'.($arElement['CATALOG_QUANTITY']<4?$arElement['CATALOG_QUANTITY']:4).'" size="5" class="text2">
                    <span class="pcs">'.dvsUNIT.'</span>
                    <button type="submit" class="button2 buy"><span>'.GetMessage("CATALOG_ADD_TO_BASKET").'</span></button>
                    <div class="clear"></div>
            </div>
        </form>';
}?>
<?if(count($arResult["ITEMS"])>0){?>
<div class="catalog" style="padding-top:30px;">
    <a name="similar" class="anchor"></a>
    <h2><?=GetMessage("DVS_SIMILAR");?></h2>
    <div class="overflow">
            <table class="catalog">
                    <tr class="img"><?=implode('', $arImgs)?></tr>
                    <tr class="txt"><?=implode('', $arData)?></tr>
            </table>
    </div>
</div>
<?}?>
