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
                             $price = '<p>'.GetMessage("OAS_NO_SALE").'  <span class="strike">'.$arPrice["VALUE"].' <span class="rubl">'.GetMessage("DVS_RUB").'</span></span></p>
                                      <p>'.GetMessage("OAS_WITH_SALE").'</p><p class="price">'.round($arPrice["DISCOUNT_VALUE"]).' <span class="rubl">'.GetMessage("DVS_RUB").'</span></p>';
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
                        $quantity = dvsListQUANTITY . '>4';
                    } else {
                        $quantity = dvsListQUANTITY . $arElement['CATALOG_QUANTITY'];
                    }
                }

                $quantity1 = '';
                if($arElement['CATALOG_QUANTITY'] < 1){
                    $quantity1 = '<span class="absent">'.dvsListABSENT.'</span>';//***
                } else {
                    $inStock = true;
                    if($arElement['CATALOG_QUANTITY'] > 4) {
                        $quantity1 = '>4 шт.';
                    } else {
                        $quantity1 =  $arElement['CATALOG_QUANTITY'] . 'шт.';
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
                        <img style="float:right; padding-top:5px; padding-bottom:5px;" src="'.$picture.'" max-width="150px;" max-width="150px;" "width="'.$width.'" height="'.$height.'" alt="'.$arElement['NAME'].'" id="i'.$arElement['ID'].'" /></a>'.$icons.'
                        
                        </div>
                        <div style="clear:both">

                        '.(($arElement['IBLOCK_ID']=='7')?
                    ('
                        <p style="font-size: 11px; color:grey;">
                        '.GetMessage("OAS_COLOR_ALERT").'
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
                <tr><td class="key"> '.GetMessage("OAS_TYRE_WIDTH").'............ '.$arElement['PROPERTIES']['tyre_width']['VALUE'].' мм</td></tr>
                <tr><td class="key"> '.GetMessage("OAS_TYRE_HEIGHT").'............. '.$arElement['PROPERTIES']['tyre_height']['VALUE'].' %</td></tr>
                <tr><td class="key"> '.GetMessage("OAS_TYRE_DIAMETR").'............ '.$arElement['PROPERTIES']['tyre_diameter']['VALUE'].'</td></tr>
                <tr><td class="key">'.GetMessage("OAS_TYRE_SEASON").'...............
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
               <tr><td class="key">'.GetMessage("OAS_WHEEL_WIDTH").'........ '.$arElement['PROPERTIES']['wheels_width']['VALUE'].'J</td></tr>
                <tr><td class="key">'.GetMessage("OAS_WHEEL_DIAMETR").'....... '.$arElement['PROPERTIES']['wheels_diameter']['VALUE'].'&#8243;</td></tr>
                <tr><td class="key">'.GetMessage("OAS_WHEEL_PCD").'..............'.$arElement['PROPERTIES']['wheels_aperture']['VALUE'].' мм</td></tr>
                <tr><td class="key">'.GetMessage("OAS_WHEEL_ET").'...'.$arElement['PROPERTIES']['wheels_gab']['VALUE'].' мм</td></tr>
                <tr><td class="key">'.GetMessage("OAS_WHEEL_DIA").'..............'.$arElement['PROPERTIES']['wheels_center']['VALUE'].' мм</td></tr>
                 <tr><td class="key">'.GetMessage("OAS_WHEEL_TYPE").'.........'.$arElement['PROPERTIES']['TIPDISKI']['VALUE'].'</td></tr>
                
                </table> 
                   '):'').'
                <table class="info_table">
                    <tr><td>
                    </td></tr>
                    <tr><td>
                    <span> В наличии:</span> '.$quantity1.'
                    </td></tr>
                </table> 
                <p class="'.$class.'"></p>'
                   ;




               $arBuy[] = '<td class="buy" id="'.$this->GetEditAreaId($arElement['ID']).'">
                <h4 id="name'.$arElement['ID'].'"></h4>
                
                '.$price.'
                <form action="'.POST_FORM_ACTION_URI.'" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="'.$arParams["ACTION_VARIABLE"].'" value="BUY">
                    <input type="hidden" name="'.$arParams["PRODUCT_ID_VARIABLE"].'" value="'.$arElement["ID"].'">
                    <input type="hidden" name="'.$arParams["ACTION_VARIABLE"].'BUY" value="Y">
                    <div class="tocart buy-i" itemID="'.$arElement['ID'].'" offerStatus="'.($arElement['CATALOG_QUANTITY']==0?'not-available':'available').'">
                            <input type="hidden" id="price'.$arElement['ID'].'" value="'.$iDiscount.'" />
                            <span class="zakaz">'.GetMessage("OAS_ZAKAZ").' </span>
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
    
     echo GetMessage("DVS_NOT_FOUND") ; 
     echo "<br>";
    echo GetMessage("OAS_CALL");
    echo "<h3>8 (351) 751 09 19</h3>";


   $APPLICATION->IncludeComponent(
    "bitrix:catalog.bigdata.products", 
    "main_template", 
    array(
        "COMPONENT_TEMPLATE" => "main_template",
        "RCM_TYPE" => "bestsell",
        "ID" => $_REQUEST["PRODUCT_ID"],
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => "",
        "SHOW_FROM_SECTION" => "N",
        "SECTION_ID" => "",
        "SECTION_CODE" => "",
        "SECTION_ELEMENT_ID" => "",
        "SECTION_ELEMENT_CODE" => "",
        "DEPTH" => "",
        "HIDE_NOT_AVAILABLE" => "Y",
        "SHOW_DISCOUNT_PERCENT" => "N",
        "PRODUCT_SUBSCRIPTION" => "N",
        "SHOW_NAME" => "Y",
        "SHOW_IMAGE" => "Y",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_DETAIL" => "Подробнее",
        "MESS_BTN_SUBSCRIBE" => "Подписаться",
        "PAGE_ELEMENT_COUNT" => "5",
        "LINE_ELEMENT_COUNT" => "5",
        "TEMPLATE_THEME" => "blue",
        "DETAIL_URL" => "",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_GROUPS" => "Y",
        "SHOW_OLD_PRICE" => "Y",
        "PRICE_CODE" => array(
            0 => "Продажи через сайт",
        ),
        "SHOW_PRICE_COUNT" => "1",
        "PRICE_VAT_INCLUDE" => "Y",
        "CONVERT_CURRENCY" => "N",
        "BASKET_URL" => "/personal/cart/",
        "ACTION_VARIABLE" => "action",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_QUANTITY_VARIABLE" => "",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PARTIAL_PRODUCT_PROPERTIES" => "Y",
        "USE_PRODUCT_QUANTITY" => "Y",
        "SHOW_PRODUCTS_4" => "Y",
        "PROPERTY_CODE_4" => array(
            0 => "model_season",
            1 => "model_pin",
            2 => "",
        ),
        "CART_PROPERTIES_4" => array(
            0 => "model_season",
            1 => "model_pin",
            2 => "",
        ),
        "ADDITIONAL_PICT_PROP_4" => "model_more_photos",
        "LABEL_PROP_4" => "-",
        "SHOW_PRODUCTS_6" => "Y",
        "PROPERTY_CODE_6" => array(
            0 => "CML2_ATTRIBUTES",
            1 => "",
        ),
        "CART_PROPERTIES_6" => array(
            0 => "KOL_VO_OTVERSTIY",
            1 => "",
        ),
        "ADDITIONAL_PICT_PROP_6" => "wheels_more_photos",
        "LABEL_PROP_6" => "-",
        "PROPERTY_CODE_5" => array(
            0 => "tyre_width",
            1 => "tyre_height",
            2 => "tyre_diameter",
            3 => "model_season",
            4 => "model_pin",
            5 => "",
        ),
        "CART_PROPERTIES_5" => array(
            0 => "tyre_width",
            1 => "tyre_height",
            2 => "tyre_diameter",
            3 => "model_season",
            4 => "model_pin",
            5 => "",
        ),
        "ADDITIONAL_PICT_PROP_5" => "MORE_PHOTO",
        "OFFER_TREE_PROPS_5" => array(
            0 => "tyre_width",
            1 => "tyre_height",
            2 => "tyre_diameter",
            3 => "model_season",
            4 => "model_pin",
        ),
        "PROPERTY_CODE_7" => array(
            0 => "wheels_diameter",
            1 => "wheels_width",
            2 => "wheels_aperture",
            3 => "wheels_gab",
            4 => "wheels_center",
            5 => "",
        ),
        "CART_PROPERTIES_7" => array(
            0 => "wheels_diameter",
            1 => "wheels_width",
            2 => "wheels_aperture",
            3 => "wheels_gab",
            4 => "wheels_center",
            5 => "",
        ),
        "ADDITIONAL_PICT_PROP_7" => "MORE_PHOTO",
        "OFFER_TREE_PROPS_7" => array(
            0 => "wheels_diameter",
            1 => "wheels_width",
            2 => "wheels_aperture",
            3 => "wheels_gab",
            4 => "wheels_center",
        )
    ),
    false
    );
}?>