<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(count($arResult["ITEMS"])>0){?>
<? //echo "<pre>";  print_r(count($arResult["ITEMS"])); echo "</pre>"; ?>
<div class="catalog_left">
    <div class="overflow_left">

    <? //echo "<pre>";  print_r($arResult); echo "</pre>"; ?>

        <div class="mega_result_table">
        <table class="catalog">
    <?foreach($arResult["ITEMS"] as $arLine):?>

            <?
            $arImgs = $arData = $arBuy = array();

            foreach($arLine as $arElement):?>
           <? //echo "<pre>";  print_r($arElement); echo "</pre>"; ?>
            
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

                //Г¶ГҐГ­Г»
                $iPrice = $iDiscount = $iDiscountDiff = -1;
                $sPrice = $sDiscount = $sDiscountDiff = "";
                foreach($arElement["PRICES"] as $code => $arPrice){
                    
                        if ($arPrice["CAN_BUY"] == "Y") { // ГЏГ®Г«ГјГ§Г®ГўГ ГІГҐГ«Гј Г¬Г®Г¦ГҐГІ ГЇГ®ГЄГіГЇГ ГІГј ГЇГ® ГЅГІГ®Г© Г¶ГҐГ­ГҐ
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
                             $price = '<p>Без скидки  <span class="strike">'.$arPrice["VALUE"].' <span class="rubl">'.GetMessage("DVS_RUB").'</span></span></p>
                                      <p>Со скидкой</p><p class="price">'.round($arPrice["DISCOUNT_VALUE"]).' <span class="rubl">'.GetMessage("DVS_RUB").'</span></p>';
                             $sale = true;
                         } else {
                             $price = '<p class="price">'.$arPrice["VALUE"].' <span class="rubl">'.GetMessage("DVS_RUB").'</span></p>';
                         }
                     }
                 }


                //ГЄГ®Г«-ГўГ®
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
                        $quantity = GetMessage('DVS_ORDER_TO') . date(' j.m', strtotime("$days days"));
                    } else {
                        $quantity = GetMessage('DVS_ORDER');
                    }
                }

                //шильды
               /* $icons = '';
                if ($sale || $hit) {
                    $icons = '<ul class="icons">'.
                        ($sale ? '<li><span class="red">Скидка</span></li>' : '')//***
                        .
                        ($hit ? '<li><span class="green">Хит</span></li>' : '')//***
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
                
                $arImgs[] = '<td class="mega_result_image">
                    <div><a href="'.$arElement['DETAIL_PAGE_URL'].'">
                        <img style="float:right; padding-top:20px;" src="'.$picture.'" max-width="150px;" max-width="150px;" "width="'.$width.'" height="'.$height.'" alt="'.$arElement['NAME'].'" id="i'.$arElement['ID'].'" /></a>'.$icons.'
                        
                        </div>
                        <div style="clear:both">

                        '.(($arElement['IBLOCK_ID']=='7')?
                    ('
                        <p style="font-size: 11px; color:grey;">
                        Цвет может отличаться
                        <img width="12px;" height="12px;" src="images/vopros_32.png" title="Цвет диска на картинке может отличаться от оригинала, смотрите описание в характеристиках или спрашивайте у менеджера."></img>
                        </p>
                         '):'').'
                        </div>
                        
                        </td>';

                $arData[] = '<td style="padding-left:7px;" class="txt" id="'.$this->GetEditAreaId($arElement['ID']).'">
                <h4 id="name'.$arElement['ID'].'"><a href="'.$arElement['DETAIL_PAGE_URL'].'">
                '.$str = str_replace("(","",str_replace(")","",$arElement['NAME'])) .'</a></h4>

               
                '.(($arElement['IBLOCK_ID']=='5')?
                    ('
                        <table class="param_table">
                <tr><td class="key"> Ширина............ '.$arElement['PROPERTIES']['tyre_width']['VALUE'].' мм</td></tr>
                <tr><td class="key"> Высота............. '.$arElement['PROPERTIES']['tyre_height']['VALUE'].' %</td></tr>
                <tr><td class="key"> Диаметр............ '.$arElement['PROPERTIES']['tyre_diameter']['VALUE'].'</td></tr>
                <tr><td class="key">Сезон...............
                                 '.(($arElement['PROPERTIES']['model_season']['VALUE'] == 'Зима')?
                                    (' <span class="winter"></span>'):'').'
                                 '.(($arElement['PROPERTIES']['model_season']['VALUE'] == 'Лето')?
                                    (' <span class="summer"></span>'):'').'
                                      '.$arElement['PROPERTIES']['model_season']['VALUE'].'
                </td></tr>

                <tr><td class="key">
                '.(($arElement['PROPERTIES']['model_season']['VALUE'] == 'Зима')?
                     (' Шипованный...'.$arElement['PROPERTIES']['model_pin']['VALUE'].''):'').'
                '.(($arElement['PROPERTIES']['model_pin']['VALUE']=='Шип.')?
                     ('<span class="spike"></span>'):'').'
                </td></tr>
                </table> 
                   '):'').'

                '.(($arElement['IBLOCK_ID']=='7')?
                    ('
                       <table class="param_table">
               <tr><td class="key">Ширина........ '.$arElement['PROPERTIES']['wheels_width']['VALUE'].' J</td></tr>
                <tr><td class="key">Диаметр....... '.$arElement['PROPERTIES']['wheels_diameter']['VALUE'].' &#8243;</td></tr>
                <tr><td class="key">PCD..............'.$arElement['PROPERTIES']['wheels_aperture']['VALUE'].' мм</td></tr>
                <tr><td class="key">Вылет (ET)...'.$arElement['PROPERTIES']['wheels_gab']['VALUE'].' мм</td></tr>
                <tr><td class="key">(DIA)..............'.$arElement['PROPERTIES']['wheels_center']['VALUE'].' мм</td></tr>
                 
                </table> 
                   '):'').'
                <p class="'.$class.'"></p>'
                   ;




               $arBuy[] = '<td class="buy" id="'.$this->GetEditAreaId($arElement['ID']).'">
                <h4 id="name'.$arElement['ID'].'"></h4>
                
                <p class="'.$class.'">'.$quantity.'</p>'.$price.'
                <form action="'.POST_FORM_ACTION_URI.'" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="'.$arParams["ACTION_VARIABLE"].'" value="BUY">
                    <input type="hidden" name="'.$arParams["PRODUCT_ID_VARIABLE"].'" value="'.$arElement["ID"].'">
                    <input type="hidden" name="'.$arParams["ACTION_VARIABLE"].'BUY" value="Y">
                    <div class="tocart buy-i" itemID="'.$arElement['ID'].'" offerStatus="'.($arElement['CATALOG_QUANTITY']==0?'not-available':'available').'">
                            <input type="hidden" id="price'.$arElement['ID'].'" value="'.$iDiscount.'" />
                            <span class="zakaz">Заказать </span>
                            <input type="text" onkeyup="validateRange(this,1,'.$arElement['CATALOG_QUANTITY'].');" id="count'.$arElement['ID'].'" name="'.$arParams["PRODUCT_QUANTITY_VARIABLE"].'" value="'.($arElement['CATALOG_QUANTITY']<4?$arElement['CATALOG_QUANTITY']:4).'" size="5" class="text2">
                            <span class="pcs">'.dvsUNIT.'</span>
                            <br> <br>
                            <button style=" width:100px;" id="buybutton'.$arElement['ID'].'" data-in-basket="'.GetMessage("DVS_IN_BASKET").'" type="submit" class="button2 buy"><span>'.$buttonText.'</span></button>
                            <div class="clear"></div>
                    </div>

                </form>'


                ;

        ?>



            <?endforeach;?>
            <tr style="border-bottom: 2px solid #F9F9F9;">
            <?echo implode('', $trimmed);?>
            <?echo implode('', $arImgs);?>
            <?echo implode('', $arData);?>
            <?echo implode('', $arBuy);?>
            </tr>

    <?endforeach;?>
        </table>
        </div>
    </div>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
   <br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
<?}else{
    echo GetMessage("DVS_NOT_FOUND");
}?>