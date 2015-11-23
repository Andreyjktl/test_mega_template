<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!-- Item Details -->
<div class="item">
        <div class="preview" id="picture">
            <? if(is_array($arResult["DETAIL_PICTURE"])) {
                $picture = $arResult["DETAIL_PICTURE"]["SRC"];
                $width = $arResult["DETAIL_PICTURE"]["WIDTH"];
                $height = $arResult["DETAIL_PICTURE"]["HEIGHT"];
            } elseif(is_array($arResult["PREVIEW_PICTURE"])) {
                $picture = $arResult["PREVIEW_PICTURE"]["SRC"];
                $width = $arResult["PREVIEW_PICTURE"]["WIDTH"];
                $height = $arResult["PREVIEW_PICTURE"]["HEIGHT"];
            } else {
                $picture = "/images/photo.png";
                $width = 200;
                $height = 200;
            } ?>
            <img border="0" src="<?=$picture?>" width="<?=$width?>" height="<?=$height?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
            <br><br><br>
            <div class="adv">
                    <p><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/trunks.php"), false);?></p>
            </div>
            <p><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/adds/social.php"), false);?></p>

        </div>

        <!-- List Table -->
        <div class="list-table">
            <?
            $pin = false;

            $season_name = strtolower($arResult['PROPERTIES']['model_season']['VALUE_ENUM']);
            if($arResult['PROPERTIES']['model_season']['VALUE_XML_ID']=='leto'){
                $season_class = 'summer2';
            }elseif($arResult['PROPERTIES']['model_season']['VALUE_XML_ID']=='zima'){
                $season_class = 'winter2';
                $pin = $arResult['PROPERTIES']['model_pin']['VALUE_XML_ID']=='yes'?true:false;
            }else{
                $season_class = 'allseason2';
            }?>
                <?echo '<p class="type"><span class="'.$season_class.'">'.$season_name.($pin?', ':'').'</span>'.($pin?'<span class="spike">'.GetMessage("DVS_PIN").'</span>, ':', ').strtolower($arResult['PROPERTIES']['model_type']['VALUE']).'</p>';?>
                <?if(is_array($arResult["OFFERS"]) && !empty($arResult["OFFERS"])):?>
                <table class="list">
                        <tr>
                            <th><?=GetMessage("DVS_SIZE");?></th><th><?=GetMessage("DVS_AVAILABLE");?></th><th><?=GetMessage("DVS_PRICE");?></th><th> </th><th><?=GetMessage("DVS_QUANTITY");?></th>
                        </tr>

                        <?foreach($arResult["OFFERS"] as $arOffer):
                            $order = false;
                            $days = 0;
                            if ($arOffer['PROPERTIES']['order']['VALUE'] == 'Y') {
                                $order = true;
                                $days = intval($arOffer['PROPERTIES']['order']['DESCRIPTION']);
                            }
                            if($arOffer['CATALOG_QUANTITY']==0) {
                                $quantity = '<span class="absent">' . $arOffer['CATALOG_QUANTITY'] . dvsUNIT . '</span>';
                            } elseif($arOffer['CATALOG_QUANTITY'] > 4) {
                                $quantity = '<p>&gt;4' . dvsUNIT.'</p>';//***
                            } else {
                                $quantity = '<p>'.$arOffer['CATALOG_QUANTITY'] . dvsUNIT.'</p>';//***
                            }
                            if ($order) {
                                if ($days) {
                                    $quantity = '<span>' . GetMessage('DVS_ORDER_TO') . date(' j.m', strtotime("+$days days")) . '</span>';
                                } else {
                                    $quantity = '<span>' . GetMessage('DVS_ORDER') . '</span>';
                                }
                            }
                            $iPrice = $iDiscount = $iDiscountDiff = -1;
                            $sPrice = $sDiscount = $sDiscountDiff = "";
                            foreach($arOffer["PRICES"] as $code => $arPrice){
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

                        ?>
                        <tr>
                                <td class="title" id="name<?echo $arOffer['ID'];?>">
                                    <a href="<?echo $arOffer['DETAIL_PAGE_URL'];?>">
                                       <?echo str_replace("(","",str_replace(")","",str_replace(array($arResult['SECTION']['NAME']
                                       .' ', $arResult['NAME'].' '), array('', ''), $arOffer['NAME'])));?>
                                    </a>
                                    </td>
                                <td class="presence"><? echo $quantity; ?></td>
                                <td class="price"><?echo $iDiscount;?> <span class="rubl"><?=GetMessage("DVS_RUB");?></span></td>
                                <td class="fn">X</td>
                                <td class="number">
                                    <form action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="BUY">
                                        <input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arOffer["ID"]?>">
                                        <input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]."BUY"?>" value="Y">

                                        <div class="tocart buy-m" itemID="<?echo $arOffer['ID'];?>" offerStatus="<?echo ($arOffer['CATALOG_QUANTITY']==0)?'not-available':'available'?>">
                                                <input type="hidden" id="price<?echo $arOffer['ID'];?>" value="<?echo $iDiscount;?>" />
                                                <input type="text" onkeyup="validateRange(this,1);" id="count<?echo $arOffer['ID'];?>" name="<?echo $arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="<?echo $arOffer['CATALOG_QUANTITY']<4?$arOffer['CATALOG_QUANTITY']:4;?>" size="5" class="text2">
                                                <span class="pcs"><?echo dvsUNIT?></span>
                                                <button id="buybutton<?echo $arOffer['ID'];?>" data-in-basket="<? echo GetMessage("DVS_IN_BASKET"); ?>" type="submit" class="button2 buy"><span><? echo $order ? GetMessage("DVS_MAKE_ORDER") : GetMessage("CATALOG_ADD_TO_BASKET"); ?></span></button>
                                                <div class="clear"></div>
                                        </div>
                                    </form>
                                </td>
                        </tr>
                        <?endforeach;?>
                </table>

                <br/><br/>
            <?endif;?>
                <?/* <div class="txt">
                        <h4 class="trunks"><?=GetMessage("DVS_TRUNKS");?></h4>
                        <p><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/trunks.php"), false);?></p>
                        <br/>
                        <?if(count($arResult['DISPLAY_PROPERTIES']['wheels_more_photos']['VALUE'])>0)
                            echo '<p class="link"><a href="#photos">'.GetMessage("DVS_V_PHOTO").'</a></p>';
                        ?>
                </div> 
                <div class="adv">
                        <h4><?=GetMessage("DVS_AD");?></h4>
                        <p><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/ads.php"), false);?></p>
                </div>*/?>
                <div class="clear"></div>
        </div>
        <!-- // List Table -->

        <div class="clear"></div>
</div>
<!-- // Item Details -->

<?if(strlen($arResult['DETAIL_TEXT'])>0){?>
<!-- Gray Block -->
<div class="block full">
        <div class="tabs full crop-top">
                <ul class="tabs size1">
                    <li class="selected"><span><?=GetMessage("DVS_DET");?></span></li>

                </ul>
                <div class="clear"></div>
        </div>
        <br/>
        <div class="tabs-content">
            <div class="tab-overview"><?echo $arResult['DETAIL_TEXT'];?></div>


        </div>
</div>
<!-- // Gray Block -->
<?}?>

<?if(count($arResult['DISPLAY_PROPERTIES']['model_more_photos']['VALUE'])>0){?>
<!-- Photos -->
<div class="photos">
        <a name="photos" class="anchor"></a>
        <h2><?=GetMessage("DVS_M_PHOTO");?></h2>
        <ul>
            <?foreach($arResult['DISPLAY_PROPERTIES']['model_more_photos']['FILE_VALUE'] as $arPhoto){
                $arPhoto_tmp = CFile::ResizeImageGet($arPhoto, array('width'=>140, 'height'=>140), BX_RESIZE_IMAGE_EXACT, true);
                echo '<li><a href="'.$arPhoto['SRC'].'" rel="gallery"><img src="'.$arPhoto_tmp['src'].'" alt="" /></a></li>';
            }?>
        </ul>
        <div class="clear"></div>
</div>
<!-- // Photos -->
<?}?>