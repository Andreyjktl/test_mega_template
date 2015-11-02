<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult["ITEMS"])>0){?>
<div class="catalog_left">
    <div class="overflow_left">
<!--noindex-->
<table class="selectors" width="100%" cellpadding="3" cellspacing="0" border="0">
<tr>
   <td align="left">
      <a<?if($view=="mega_filter_result") :?> style="font-weight:bold"<?endif?> href="<?=$APPLICATION->GetCurPageParam("view=mega_filter_result", Array("view", "sort", "count") )?>" rel="nofollow">Плитка</a> /
      <a<?if($view=="filter_result") :?> style="font-weight:bold"<?endif?> href="<?=$APPLICATION->GetCurPageParam("view=filter_result", Array("view", "sort", "count") )?>" rel="nofollow">таблица</a> 
      
   </td>
   <td align="center">
      <a<?if($count=="1") :?> style="font-weight:bold"<?endif?> href="<?=$APPLICATION->GetCurPageParam("count=1", Array("view", "sort", "count") )?>" rel="nofollow">1</a> / 
      <a<?if($count=="2") :?> style="font-weight:bold"<?endif?> href="<?=$APPLICATION->GetCurPageParam("count=2", Array("view", "sort", "count") )?>" rel="nofollow">2</a> / 
      <a<?if($count=="3") :?> style="font-weight:bold"<?endif?> href="<?=$APPLICATION->GetCurPageParam("count=3", Array("view", "sort", "count") )?>" rel="nofollow">3</a> / 
      <a<?if($count=="5") :?> style="font-weight:bold"<?endif?> href="<?=$APPLICATION->GetCurPageParam("count=5", Array("view", "sort", "count") )?>" rel="nofollow">5</a> / 
      <a<?if($count=="all") :?> style="font-weight:bold"<?endif?> href="<?=$APPLICATION->GetCurPageParam("count=all", Array("view", "sort", "count") )?>" rel="nofollow">все</a>
   </td>
   <td align="right">
      <a<?if($sort=="price_desc") :?> style="font-weight:bold"<?endif?> href="<?=$APPLICATION->GetCurPageParam("sort=price_desc", Array("view", "sort", "count") )?>" rel="nofollow">По цене вниз</a> / 
      <a<?if($sort=="price_asc") :?> style="font-weight:bold"<?endif?> href="<?=$APPLICATION->GetCurPageParam("sort=price_asc", Array("view", "sort", "count") )?>" rel="nofollow">по цене вверх</a> / 
      <a<?if($sort=="sort_asc") :?> style="font-weight:bold"<?endif?> href="<?=$APPLICATION->GetCurPageParam("sort=sort_asc", Array("view", "sort", "count") )?>" rel="nofollow">по порядку</a>
   </td>
</tr>
</table>
<!--/noindex-->

        <table class="catalog">
    <?foreach($arResult["ITEMS"] as $arLine):?>

            <?
            $arImgs = $arData = $arBuy = array();

            foreach($arLine as $arElement):?>
            <?// echo "<pre>";  print_r($arElement); echo "</pre>"; ?>
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

                if ($iPrice > $iDiscount) { $sale = true; }

                 $price = '';
                 foreach($arElement["PRICES"] as $code=>$arPrice){
                     if($arPrice["CAN_ACCESS"]){
                         if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]){
                             $price = '<p><span class="strike">'.$arPrice["VALUE"].' <span class="rubl">'.GetMessage("DVS_RUB").'</span></span> ('.($arPrice["DISCOUNT_VALUE"] - $arPrice["VALUE"]).' <span class="rubl">'.GetMessage("DVS_RUB").'</span>)</p>
                                      <p class="price">'.$arPrice["DISCOUNT_VALUE"].' <span class="rubl">'.GetMessage("DVS_RUB").'</span></p>';
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
                <h4 id="name'.$arElement['ID'].'"><a href="'.$arElement['DETAIL_PAGE_URL'].'">'.$arElement['NAME'].'</a></h4>'.

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
                            <input type="text" onkeyup="validateRange(this,1,'.$arElement['CATALOG_QUANTITY'].');" id="count'.$arElement['ID'].'" name="'.$arParams["PRODUCT_QUANTITY_VARIABLE"].'" value="'.($arElement['CATALOG_QUANTITY']<4?$arElement['CATALOG_QUANTITY']:4).'" size="5" class="text2">
                            <span class="pcs">'.dvsUNIT.'</span>
                            <button id="buybutton'.$arElement['ID'].'" data-in-basket="'.GetMessage("DVS_IN_BASKET").'" type="submit" class="button2 buy"><span>'.$buttonText.'</span></button>
                            <div class="clear"></div>
                    </div>

                </form>'


                ;
               

        ?>


            <?endforeach;?>
            <tr>
            <td class="img"><?echo implode('', $arImgs);?></td>
            <td class="txt"><?echo implode('', $arData);?><hr></td>
            <td class="buy"><?echo implode('', $arBuy);?></td>
            </tr>

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