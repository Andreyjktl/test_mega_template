<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$arImgs = $arData = array();
foreach($arResult["ITEMS"] as $arElement){
    $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));

    $pin = $sale = $hit = false;

    if($arElement['IBLOCK_ID']=='5'){

            $season_name = $arElement['PROPERTIES']['model_season']['VALUE_ENUM'];
            if($arElement['PROPERTIES']['model_season']['VALUE_XML_ID']=='leto'){
                $season_class = 'summer';
            }elseif($arElement['PROPERTIES']['model_season']['VALUE_XML_ID']=='zima'){
                $season_class = 'winter';
                $pin = $arElement['PROPERTIES']['model_pin']['VALUE_XML_ID']=='yes'?true:false;
            }else{
                $season_class = 'allseason';
            }

            if (strtolower($arElement['PROPERTIES']['tyre_hit']['VALUE_XML_ID']) == 'yes'){
                $hit = true;
            }
    }else{
                
            }


    $iPrice = $iDiscount = $iDiscountDiff = -1;
    $sPrice = $sDiscount = $sDiscountDiff = "";
    foreach($arElement["PRICES"] as $code => $arPrice){
        if($arPrice["CAN_ACCESS"] == "Y") { // Пользователь может видеть цену
            if ($arPrice["CAN_BUY"] == "Y") { // Пользователь может покупать по этой цене
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
        $price = '<p>Без скидки <span class="strike">'.$iPrice.' <span class="rubl">'.GetMessage("DVS_RUB").'</span></span></p>
                  <p>Со скидкой </p><p class="price">'.round($arPrice["DISCOUNT_VALUE"]).' <span class="rubl">'.GetMessage("DVS_RUB").'</span></p>';
        $sale = true;
    } else {
        $price = '<p class="price">'.$iPrice.' <span class="rubl">'.GetMessage("DVS_RUB").'</span></p>';
    }

    $quantity = '';
    if($arElement['CATALOG_QUANTITY'] < 1){
        $quantity = '<p><span class="absent">'.dvsListABSENT.'</span></p>';//***
    } elseif($arElement['CATALOG_QUANTITY'] > 4) {
        $quantity = '<p>&gt;4' . dvsListQUANTITY.'</p>';//***
    } else {
        $quantity = '<p>'.$arElement['CATALOG_QUANTITY'] . dvsListQUANTITY.'</p>';//***
    }

   /* 
   $icons = '';
    if ($sale || $hit) {
        $icons = '<ul class="icons">'.
            ($sale ? '<li><span class="red">'.dvsSALE.'</span></li>' : '')//***
            .
            ($hit ? '<li><span class="green">'.dvsHIT.'</span></li>' : '')//***
        .'</ul>';
    }
    */

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
        <p><span class="'.$season_class.'">'.$season_name.($pin?', ':'').'</span>'.($pin?'<span class="spike">'.GetMessage("DVS_PIN").'</span>':'').'</p>
        <p>'.$arElement['PROPERTIES']['model_type']['VALUE'].'</p>
        '.$quantity.'
        '.$price.'
        <form action="'.POST_FORM_ACTION_URI.'" method="post" enctype="multipart/form-data">
            <input type="hidden" name="'.$arParams["ACTION_VARIABLE"].'" value="BUY">
            <input type="hidden" name="'.$arParams["PRODUCT_ID_VARIABLE"].'" value="'.$arElement["ID"].'">
            <input type="hidden" name="'.$arParams["ACTION_VARIABLE"].'BUY" value="Y">
            <div class="tocart buy-i" itemID="'.$arElement['ID'].'" offerStatus="'.($arElement['CATALOG_QUANTITY']==0?'not-available':'available').'">
                    <input type="hidden" id="price'.$arElement['ID'].'" value="'.$iDiscount.'" />
                    <span class="zakaz">Заказать </span>
                    <input type="text" id="count'.$arElement['ID'].'" name="'.$arParams["PRODUCT_QUANTITY_VARIABLE"].'" value="'.($arElement['CATALOG_QUANTITY']<4?$arElement['CATALOG_QUANTITY']:4).'" size="5" class="text2">
                    <span class="pcs">'.dvsUNIT.'</span> <br>
                    <button type="submit" class="button2 buy"><span>'.GetMessage("CATALOG_ADD_TO_BASKET").'</span></button>
                    <div class="clear"></div>
            </div>
        </form>';
}?>
<?if(count($arResult["ITEMS"])>0){?>
<div class="catalog" style="padding-top:30px;">
    <a name="similar" class="anchor"></a>
    <h2><?=GetMessage("DVS_SIMILAR");?></h2>
    <div class="overflow100">
            <table class="catalog">
                    <tr class="img"><?=implode('', $arImgs)?></tr>
                    <tr class="txt"><?=implode('', $arData)?></tr>
            </table>
    </div>
</div>
<?}?>
