<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?

$isTyre = $arResult["IBLOCK_CODE"] == "tyres";

if ($isTyre) {
    $arFeatures = array('tyre_diameter', 'tyre_width', 'tyre_height', 'tyre_load', 'tyre_speed');
    $season_name = $arResult['LINK_MODEL']['PROPERTIES']['model_season']['VALUE_ENUM'];
    if($arResult['LINK_MODEL']['PROPERTIES']['model_season']['VALUE_XML_ID']=='leto'){
        $season_class = 'summer';
    }elseif($arResult['LINK_MODEL']['PROPERTIES']['model_season']['VALUE_XML_ID']=='zima'){
        $season_class = 'winter';
        $pin = $arResult['LINK_MODEL']['PROPERTIES']['model_pin']['VALUE_XML_ID']=='yes'?true:false;
    }else{
        $season_class = 'allseason';
    }
} else {
    $arFeatures = array('wheels_width', 'wheels_diameter', 'wheels_gab', 'wheels_count', 'wheels_aperture', 'wheels_center');
}

$pin = $sale = $hit = $inStock = $outOfStock = $order = false;
if (strtolower($arResult['PROPERTIES']['hit']['VALUE_XML_ID']) == 'yes'){
    $hit = true;
}

//цены
$iPrice = $iDiscount = $iDiscountDiff = -1;
$sPrice = $sDiscount = $sDiscountDiff = "";
foreach($arResult["PRICES"] as $code => $arPrice){
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
if($iPrice > $iDiscount){
    $price = '<p><span class="strike">'.$iPrice.' <span class="rubl">'.GetMessage("DVS_RUB").'</span></span> ('.($iDiscountDiff).' <span class="rubl">'.GetMessage("DVS_RUB").'</span>)</p>
              <p class="price">'.$iDiscount.' <span class="rubl">'.GetMessage("DVS_RUB").'</span> ('.GetMessage("DVS_ONE_TYRES").')</p>';
    $sale = true;
} else {
    $price = '<p class="price">'.$iPrice.' <span class="rubl">'.GetMessage("DVS_RUB").'</span> ('.GetMessage("DVS_ONE_TYRES").')</p>';
}

//кол-во
$quantity = '';
if($arResult['CATALOG_QUANTITY'] < 1){
    $quantity = '<span class="absent">'.dvsListABSENT.'</span>';//***
    $outOfStock = true;
} else {
    $inStock = true;
    if($arResult['CATALOG_QUANTITY'] > 4) {
        $quantity = str_replace('#Q#','<strong class="blue">&gt;4</strong>', dvsListQUANTITY);//***
    } else {
        $quantity = str_replace('#Q#', '<strong class="blue">'.$arResult['CATALOG_QUANTITY'].'</strong>', dvsListQUANTITY);//***
    }
}

if ($arResult['PROPERTIES']['order']['VALUE'] == 'Y'){
    $order = true;
    $days = 0;
    $quantity = GetMessage("DVS_ORDER");
    if (is_numeric($arResult['PROPERTIES']['order']['DESCRIPTION']) && $arResult['PROPERTIES']['order']['DESCRIPTION'] > 0) {
        $days = $arResult['PROPERTIES']['order']['DESCRIPTION'];
        $quantity = GetMessage("DVS_ORDER_TO") . date(" j.m", strtotime("+$days days"));
        $inStock = false;
        $outOfStock = false;
    }
}


//шильды
$icons = '';
if ($sale || $hit) {
    $icons = '<ul class="icons left">'
        .
        ($sale ? '<li><span class="red">'.dvsSALE.'</span></li>' : '')
        .
        ($hit ? '<li><span class="green">'.dvsHIT.'</span></li>' : '')
        .
    '</ul>';
}
?>
<!-- Item Details -->
<div class="item">
        <?if(is_array($arResult['LINK_MODEL']['DETAIL_PICTURE'])){
            $picture = $arResult['LINK_MODEL']['DETAIL_PICTURE']['SRC'];
            $width   = $arResult['LINK_MODEL']['DETAIL_PICTURE']['WIDTH'];
            $height  = $arResult['LINK_MODEL']['DETAIL_PICTURE']['HEIGHT'];
        } else {
            $picture = "/images/camera.svg";
            $width   = 200;
            $height  = 200;
        }?>
        <div class="preview" id="picture">
                <img src="<?echo $picture?>" width="<?echo $width?>" height="<?echo $height?>" alt="<?echo $arResult['LINK_MODEL']['NAME']?>" />
                <?echo $icons;?>
        </div>

        <div class="item-info">
                <p><span class="<?echo $season_class;?>"><?echo $season_name.($pin?', ':'')?></span><?echo ($pin?'<span class="spike">'.GetMessage("DVS_PIN").'</span>':'');?></p>
                <p><?echo $arResult['LINK_MODEL']['PROPERTIES']['model_type']['VALUE'];?></p>
                <p><?
                    if ($order) {
                        echo dvsORDER;
                    } elseif ($inStock) {
                        echo dvsINSTOCK;
                    } elseif ($outOfStock) {
                        echo dvsOUTOFSTOCK;
                    }
                    echo $quantity;?>
                </p>
                <?echo $price;?>
                <form action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="BUY">
                    <input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arResult['ID'];?>">
                    <input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]."BUY"?>" value="Y">

                    <div class="tocart buy-m" itemID="<?echo $arResult['ID'];?>" offerStatus="<?echo ($arResult['CATALOG_QUANTITY']==0)?'not-available':'available'?>">
                            <input type="hidden" id="price<?echo $arResult['ID'];?>" value="<?echo $iPrice;?>" />
                            <input type="text" onkeyup="validateRange(this,1,<?echo $arResult['CATALOG_QUANTITY'];?>);" id="count<?echo $arResult['ID'];?>" name="<?echo $arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="<?echo $arResult['CATALOG_QUANTITY']<4?$arResult['CATALOG_QUANTITY']:4;?>" size="5" class="text2">
                            <span class="pcs"><?echo dvsUNIT?></span>
                            <button id="buybutton<?echo $arResult['ID'];?>" data-in-basket="<?=GetMessage("DVS_IN_BASKET")?>" type="submit" class="button4 buy"><span><?=($order ? GetMessage("DVS_MAKE_ORDER") : GetMessage("CATALOG_ADD_TO_BASKET"));?></span></button>
                            <div class="clear"></div>
                    </div>
                </form>
                <hr/>
                <?if(is_array($arResult['LINK_MODEL']['PROPERTIES']['model_more_photos']['VALUE'])>0)
                    echo '<p class="link"><a href="#photos">'.GetMessage("DVS_V_PHOTO").'</a></p>';
                if($arResult['SIMILAR_COUNT']>0)
                    echo '<p class="link"><a href="#similar">'.GetMessage("DVS_V_SIMILAR").'</a></p>';
                ?>
        </div>

        <div class="adv">
                <h4 class="trunks"><?=GetMessage("DVS_TRUNKS");?></h4>
                <p><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/trunks.php"), false);?></p>
        </div>
        <div class="clear"></div>
</div>
<!-- // Item Details -->
<?$featureText = '';
foreach($arFeatures as $feature){
    if(isset($arResult['PROPERTIES'][$feature])&&strlen($arResult['PROPERTIES'][$feature]['VALUE_ENUM'])>0){
        $featureText .= '<tr><td class="key">'.$arResult['PROPERTIES'][$feature]['NAME'].'</td><td class="val">'.$arResult['PROPERTIES'][$feature]['VALUE_ENUM'].'</td></tr>';
    }
}
if(strlen($arResult['LINK_MODEL']['DETAIL_TEXT'])>0||strlen($featureText)>0){?>
<!-- Gray Block -->
<div class="block full">
        <!-- Tabs -->
        <div class="tabs full crop-top">
                <ul class="tabs size1">
                    <?
                    if($arResult['LINK_MODEL']['DETAIL_TEXT'])
                        echo '<li class="selected"><a href="#tab-overview"><span>'.GetMessage("DVS_DET").'</span></a></li>';
                    if(strlen($featureText)>0)
                        echo '<li'.(strlen($arResult['LINK_MODEL']['DETAIL_TEXT'])==0?' class="selected"':'').'><a href="#tab-features"><span>'.GetMessage("DVS_FEATURES").'</span></a></li>';
                    ?>
                </ul>
                <div class="clear"></div>
        </div>
        <!-- // Tabs -->

        <br/>

        <!-- Tabs Content -->
        <div class="tabs-content">
                <?if(strlen($arResult['LINK_MODEL']['DETAIL_TEXT'])>0){
                    echo '<div class="tab tab-overview">'.$arResult['LINK_MODEL']['DETAIL_TEXT'].'</div>';
                }?>

                <?if(strlen($featureText)>0){?>
                <div class="tab tab-features">
                    <div class="features">
                        <h3><?=GetMessage("DVS_FEATURES");?></h3>
                        <table class="features"><? echo $featureText;?></table>
                        <br/>
                    </div>
                </div>
                <?}?>
        </div>
        <!-- // Tabs Content -->

</div>
<!-- // Gray Block -->
<?}?>

<?if(is_array($arResult['LINK_MODEL']['PROPERTIES']['model_more_photos']['VALUE'])){?>
<div class="photos">
    <a name="photos" class="anchor"></a>
    <h2><?=GetMessage("DVS_M_PHOTO");?></h2>
    <ul>
    <?foreach($arResult['LINK_MODEL']['PROPERTIES']['model_more_photos']['FILE_VALUE'] as $arPhoto){
        $arPhoto_tmp = CFile::ResizeImageGet($arPhoto, array('width'=>140, 'height'=>140), BX_RESIZE_IMAGE_EXACT, true);
        echo '<li><a href="'.$arPhoto['SRC'].'" rel="gallery"><img src="'.$arPhoto_tmp['src'].'" alt="" /></a></li>';
    }?>
    </ul>
    <div class="clear"></div>
</div>
<?}?>

<?
global $arrFilter;
$arrFilter = array_merge(
    array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], '!ID'=>$arResult['ID']),
    $arResult['SIMILAR_FILTER']
);
$APPLICATION->IncludeComponent("bitrix:catalog.section", "similar_t", Array(
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => $arParams['IBLOCK_ID'],
	"SECTION_ID" => "",
	"SECTION_CODE" => "",
	"SECTION_USER_FIELDS" => array(
		0 => "",
		1 => "",
	),
	"ELEMENT_SORT_FIELD" => "rand",
	"ELEMENT_SORT_ORDER" => "asc",
	"FILTER_NAME" => "arrFilter",
	"INCLUDE_SUBSECTIONS" => "N",
	"SHOW_ALL_WO_SECTION" => "Y",
	"PAGE_ELEMENT_COUNT" => "5",
	"LINE_ELEMENT_COUNT" => "5",
	"PROPERTY_CODE" => array(
		0 => "model",
		1 => "tyre_diameter",
		2 => "tyre_width",
		3 => "tyre_height",
		4 => "tyre_load",
		5 => "tyre_speed",
		6 => "tyre_on_index",
		7 => "",
	),
	"SECTION_URL" => "",
	"DETAIL_URL" => "",
	"BASKET_URL" => "/personal/basket.php",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"PRODUCT_PROPS_VARIABLE" => "prop",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_SHADOW" => "Y",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "Y",
	"META_KEYWORDS" => "-",
	"META_DESCRIPTION" => "-",
	"BROWSER_TITLE" => "-",
	"ADD_SECTIONS_CHAIN" => "N",
	"DISPLAY_COMPARE" => "N",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"CACHE_FILTER" => "N",
	"PRICE_CODE" => array(
		0 => "BASE",
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "",
	"PRICE_VAT_INCLUDE" => "N",
	"PRODUCT_PROPERTIES" => "",
	"USE_PRODUCT_QUANTITY" => "Y",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"AJAX_OPTION_ADDITIONAL" => "",
	),
	false
);?>