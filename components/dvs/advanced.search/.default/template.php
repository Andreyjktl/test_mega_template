<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?if(count($arResult["ITEMS"])>0||count($arResult['SEARCH_RESULT']["CONTENT"])>0){?>
<?if(count($arResult["ITEMS"])>0){?>
<div class="catalog">
    <?if(isset($_REQUEST['area'])||$_REQUEST['area']=='catalog'){?>
    <h2><a href="<?echo $arResult['PURE_URL'];?>"><?=GetMessage("DVS_ALL_RESULTS")?></a> <?=GetMessage("DVS_SITE")?></h2>
    <?}else{?>
    <h2><a href="<?echo $arResult['CATALOG_URL'];?>"><?=GetMessage("DVS_ALL_RESULTS")?></a> <?=GetMessage("DVS_CATALOG")?></h2>
    <?}?>
    <div class="overflow">
        <table class="catalog">
    <?foreach($arResult["ITEMS"] as $arLine):?>
            <?
            $arImgs = $arData = array();

            foreach($arLine as $arElement):

                $order = false;
                $days = 0;
                // print_r($arElement);
                $db_props = CIBlockElement::GetProperty($arElement["IBLOCK_ID"], $arElement['ID'], array("sort" => "asc"), Array("CODE"=>"ORDER"));
                if($ar_props = $db_props->Fetch()) {
                    // print_r($ar_props);
                    if ($ar_props['VALUE'] == 'Y') {
                        $order = true;
                        if ($desc = intval($ar_props['DESCRIPTION'])) {
                            $days = $desc;
                        }
                    }
                }

                $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));

                $pin = $sale = $hit = false;

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

                $arPrice = $arElement['PRICE'];
                $price = '';
//                foreach($arElement["PRICES"] as $code=>$arPrice){
//                    if($arPrice["CAN_ACCESS"]){
                        if($arPrice["DISCOUNT_PRICE"] < $arPrice["PRICE"]['PRICE']){
                            $price = '<p><span class="strike">'.$arPrice["PRICE"]['PRICE'].' <span class="rubl">'.GetMessage("DVS_RUB").'</span></span> ('.($arPrice["PRICE"]['PRICE'] - $arPrice["DISCOUNT_PRICE"]).' <span class="rubl">'.GetMessage("DVS_RUB").'</span>)</p>
                                      <p class="price">'.$arPrice["DISCOUNT_PRICE"].' <span class="rubl">'.GetMessage("DVS_RUB").'</span></p>';
                            $sale = true;
                        } else {
                            $price = '<p class="price">'.$arPrice["PRICE"]['PRICE'].' <span class="rubl">'.GetMessage("DVS_RUB").'</span></p>';
                        }
//                    }
//                }
                $CDBResult = CIBlockElement::GetProperty(
                    $arElement['IBLOCK_ID'],
                    $arElement['ID'],
                    array("SORT" => "ASC"),
                    array("CODE" => "tyre_hit")
                );
                if ($properties = $CDBResult->Fetch()) {
                    if ($properties['VALUE_XML_ID'] == 'yes') {
                        $hit = true;
                    }
                }

                $quantity = '';
                if($arElement['CATALOG_QUANTITY'] < 1){
                    $quantity = '<span class="absent">'.dvsListABSENT.'</span>';//***
                } elseif($arElement['CATALOG_QUANTITY'] > 4) {
                    $quantity = '&gt;4' . dvsListQUANTITY.'';//***
                    $inStock = true;
                } else {
                    $quantity = ''.$arElement['CATALOG_QUANTITY'] . dvsListQUANTITY.'';//***
                    $inStock = true;
                }
                if ($order) {
                    if ($days) {
                        $quantity = '' . GetMessage('DVS_ORDER_TO') . date(' j.m', strtotime("+$days days")) . '';
                    } else {
                        $quantity = '' . GetMessage('DVS_ORDER') . '';
                    }
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
                    $picture = "/images/camera.svg";
                    $width   = 128;
                    $height  = 128;
                }

                if ($order) {
                    $class = "order";
                } elseif ($inStock) {
                    $class = "instock";
                } else {
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
                            <input type="hidden" id="price'.$arElement['ID'].'" value="'.$arElement['PRICE']['PRICE']['PRICE'].'" />
                            <input type="text" onkeyup="validateRange(this,1,'.$arElement['CATALOG_QUANTITY'].');" id="count'.$arElement['ID'].'" name="'.$arParams["PRODUCT_QUANTITY_VARIABLE"].'" value="'.($arElement['CATALOG_QUANTITY']<4?$arElement['CATALOG_QUANTITY']:4).'" size="5" class="text2">
                            <span class="pcs">'.dvsUNIT.'</span>
                            <button id="buybutton'.$arElement['ID'].'" data-in-basket="'.GetMessage("DVS_IN_BASKET").'" type="submit" class="button2 buy"><span>'.($order ? GetMessage("DVS_MAKE_ORDER") : GetMessage("DVS_ADD_B")).'</span></button>
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
<?echo $arResult['NAV_CHAIN'];?>
<?}?>

<?if(count($arResult['SEARCH_RESULT']["CONTENT"])>0){?>
<!-- Search Results -->
<style>
    div.results p b{
        color: white;
        background: #333;
        font-weight:normal;
    }
</style>
<div class="block full crop-bottom">
        <div class="results">
                <?if(isset($_REQUEST['area'])||$_REQUEST['area']=='catalog'){?>
                <h3><a href="<?echo $arResult['PURE_URL'];?>"><?=GetMessage("DVS_ALL_RESULTS")?></a> <?=GetMessage("DVS_SITE")?></h3>
                <?}else{?>
                <h3><a href="<?echo $arResult['CONTENT_URL'];?>"><?=GetMessage("DVS_ALL_RESULTS")?></a> <?=GetMessage("DVS_CONTENT")?></h3>
                <?}?>
                <ol>
                <?foreach($arResult['SEARCH_RESULT']["CONTENT"] as $content){?>
                        <li>
                                <p><a href="<?echo $content['URL_WO_PARAMS']?>"><?echo $content['TITLE'];?></a></p>
                                <p><?echo $content['BODY_FORMATED'];?></p>
                        </li>
                <?}?>
                </ol>
        </div>
</div>
<!-- // Search Results -->
<?}?>
<?}else{
    echo GetMessage("DVS_NOTHING");
}?>
<?
require_once $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/include_areas/popup.php";
global $APPLICATION;

if(!isset($_REQUEST['q'])||(isset($_REQUEST['q'])&&strlen($_REQUEST['q'])==0))
	$APPLICATION->SetTitle(GetMessage("DVS_EMPTY"));
else
	$APPLICATION->SetTitle(GetMessage("DVS_TEXT").' &laquo;'.$_REQUEST['q'].'&raquo;');
?>