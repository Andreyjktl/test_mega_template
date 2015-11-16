<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult["ITEMS"])>0){?>
<div class="catalog">
    <div class="overflow_left">
        <table class="catalog">
    <?foreach($arResult["ITEMS"] as $arLine):?>
            <?
            $arImgs = $arData = array();

            foreach($arLine as $arElement):?>
                <?

                $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));

                $order = $inStock = $pin = $sale = $hit = false;

                if($arElement['IBLOCK_CODE']=='tyres'){
                    $season_name = $arElement['PROPERTIES']['model_season']['VALUE_ENUM'];
                    if($arElement['PROPERTIES']['model_season']['VALUE_XML_ID']=='leto'){
                        $season_class = 'summer';
                    }elseif($arElement['PROPERTIES']['model_season']['VALUE_XML_ID']=='zima'){
                        $season_class = 'winter';
                        $pin = $arElement['PROPERTIES']['model_pin']['VALUE_XML_ID']=='yes'?true:false;
                    }else{
                        $season_class = 'allseason';
                    }
                }
                
                if (strtolower($arElement['PROPERTIES']['hit']['VALUE_XML_ID']) == 'yes'){
                    $hit = true;
                }

                //цены
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
        if ($iPrice > $iDiscount) { $sale = true; }


                 $price = '';
                foreach($arElement["PRICES"] as $code=>$arPrice){
                     if($arPrice["CAN_ACCESS"]){
                         if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]){
                             $price = '<p>Без скидки  <span class="strike">'.$arPrice["VALUE"].' <span class="rubl">'.GetMessage("DVS_RUB").'</span></span></p>
                                      <p>Со скидкой</p><p class="price">'.round($arPrice["DISCOUNT_VALUE"]).' <span class="rubl">'.GetMessage("DVS_RUB").'</span></p>';
                             $sale = true;
                         } else {
                             $price = '<p class="price">'.$arPrice["VALUE"].' <span class="rubl">'.GetMessage("DVS_RUB").'</span></p>';
                         }
                }
                }


                //кол-во
                $quantity = '';
                if($arElement['CATALOG_QUANTITY'] < 1){
                    $quantity = '<span class="absent">'.dvsListABSENT.'</span>';//***
                } else {
                    $inStock = true;
                    if($arElement['CATALOG_QUANTITY'] > 4) {
                        $quantity = '>4' . dvsListQUANTITY;
                    } else {
                        $quantity = $arElement['CATALOG_QUANTITY'] . dvsListQUANTITY;
                    }
                }

                $buttonText = GetMessage("CATALOG_ADD_TO_BASKET");
                if ($arElement['PROPERTIES']['order']['VALUE'] == 'Y') {
                    $order = true;
                    $buttonText = GetMessage("DVS_MAKE_ORDER");
                    if ((is_numeric($arElement['PROPERTIES']['order']['DESCRIPTION'])) && ($arElement['PROPERTIES']['order']['DESCRIPTION'] > 0)) {
                        $days = $arElement['PROPERTIES']['order']['DESCRIPTION'];
                        $quantity = GetMessage('DVS_ORDER_TO') . date(' j.m', strtotime("+$days days"));
                    } else {
                        $quantity = GetMessage('DVS_ORDER');
                    }
                }

                //шильды
               /* $icons = '';
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

                $class = "";

                if ($order) {
                    // $quantity = dvsORDER . $quantity;
                    $class = "order";
                } elseif ($inStock) {
                    // $quantity = dvsINSTOCK . $quantity;
                    $class = "instock";
                } else {
                    // $quantity = dvsOUTOFSTOCK . $quantity;
                    $class = "outofstock";
                }

                $arImgs[] = '<td><div><a href="'.$arElement['DETAIL_PAGE_URL'].'"><img src="'.$picture.'" width="'.$width.'" height="'.$height.'" alt="'.$arElement['NAME'].'" id="i'.$arElement['ID'].'" /></a>'.$icons.'</div></td>';

                $arData[] = '<td id="'.$this->GetEditAreaId($arElement['ID']).'">
                <h4 id="name'.$arElement['ID'].'">
                    <a href="'.$arElement['DETAIL_PAGE_URL'].'">
                    '.$str = str_replace("(","",str_replace(")","",$arElement['NAME'])) .'
                    </a></h4>'.

                (($arElement['IBLOCK_CODE']=='tyres')?('<p><span class="'.$season_class.'">'.$season_name.($pin?', ':'').'</span>'.($pin?'<span class="spike">'.GetMessage("DVS_PIN").'</span>':'').'</p>
                <p>'.$arElement['PROPERTIES']['model_type']['VALUE'].'</p>'):'')

                .'<p class="'.$class.'">'.$quantity.'</p>
                '.$price.'
                <form action="'.POST_FORM_ACTION_URI.'" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="'.$arParams["ACTION_VARIABLE"].'" value="BUY">
                    <input type="hidden" name="'.$arParams["PRODUCT_ID_VARIABLE"].'" value="'.$arElement["ID"].'">
                    <input type="hidden" name="'.$arParams["ACTION_VARIABLE"].'BUY" value="Y">
                    <div class="tocart buy-i" itemID="'.$arElement['ID'].'" offerStatus="'.($arElement['CATALOG_QUANTITY']==0?'not-available':'available').'">
                            <input type="hidden" id="price'.$arElement['ID'].'" value="'.$iDiscount.'" />
                            <span class="zakaz">Заказать </span>
                            <input type="text" onkeyup="validateRange(this,1,'.$arElement['CATALOG_QUANTITY'].');" id="count'.$arElement['ID'].'" name="'.$arParams["PRODUCT_QUANTITY_VARIABLE"].'" value="'.($arElement['CATALOG_QUANTITY']<4?$arElement['CATALOG_QUANTITY']:4).'" size="5" class="text2">
                            <span class="pcs">'.dvsUNIT.'</span>
                            <button id="buybutton'.$arElement['ID'].'" data-in-basket="'.GetMessage("DVS_IN_BASKET").'" type="submit" class="button2 buy"><span>'.$buttonText.'</span></button>
                            <div class="clear"></div>
                    </div>
                </form>';
        ?>
            <?endforeach;?>
            <tr class="img"><?echo implode('', $arImgs);?></tr>
            <tr class="txt"><?echo implode('', $arData);?></tr>
    <?endforeach;?>
        </table>
    </div>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
<?}else{
    echo GetMessage("DVS_NOT_FOUND");
}?>