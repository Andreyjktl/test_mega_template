<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//print '<pre>';
//print_r($arResult);
//print '</pre>';
?>
<!-- Cart -->
<div class="cart">
    <?echo ShowError($arResult["ERROR_MESSAGE"]);?>
    <p><?echo GetMessage("STB_ORDER_PROMT");?></p>
    <br/>

    <table class="cart">
        <tr>
            <th> </th>
        <?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
            <th colspan="2"><?= GetMessage("SALE_NAME")?></th>
        <?endif;?>
        <?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
            <th><?= GetMessage("SALE_DISCOUNT")?></th>
        <?endif;?>
            <th><?= GetMessage("SALE_PRICE_QUANTITY")?></th>
            <th> </th>
        <?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
            <th><?= GetMessage("SALE_QUANTITY")?></th>
        <?endif;?>
            <th> </th>
        <?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
            <th><?= GetMessage("SALE_PRICE")?></th>
        <?endif;?>
        </tr>
        <?
        $i=0;
        foreach($arResult["ITEMS"]["AnDelCanBuy"] as $arBasketItems)
        {?>
        <tr>
            <?if (in_array("DELETE", $arParams["COLUMNS_LIST"])):?>
                <td class="del"><a href="?id=<?=$arBasketItems["ID"] ?>&action=delete" id="DELETE_<?=$i?>"><img src="<?=SITE_TEMPLATE_PATH?>/images/icons/delete.gif" width="22" height="22" alt="" /></a></td>
            <?endif;?>
            <?

            if (is_array($arBasketItems['PREVIEW_PICTURE'])) {
                $picture = $arBasketItems['PREVIEW_PICTURE']['src'];
                $width = $arBasketItems['PREVIEW_PICTURE']['width'];
                $height = $arBasketItems['PREVIEW_PICTURE']['height'];
            } else {
                $picture = "/images/camera.svg";
                $width = 60;
                $height = 60;
            }

            ?>
            <td class="img"><a href="<?echo $arBasketItems['DETAIL_PAGE_URL'];?>"><img src="<?echo $picture;?>" width="<?echo $width;?>" height="<?echo $height;?>" alt="<?=$arBasketItems["NAME"] ?>" /></a></td>

            <?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
                <td class="txt"><h4><?
                if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0):
                    ?><a href="<?=$arBasketItems["DETAIL_PAGE_URL"] ?>"><?
                endif;
                ?><?=$arBasketItems["NAME"] ?><?
                if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0):
                    ?></a><?
                endif;
                ?></h4>

                <?if($arBasketItems['IBLOCK_CODE']=='tyres'){
                    $pin = false;

                    $season_name = $arBasketItems['PROPERTIES']['model_season']['VALUE_ENUM'];
                    if($arBasketItems['PROPERTIES']['model_season']['VALUE_XML_ID']=='leto'){
                        $season_class = 'summer';
                    }elseif($arBasketItems['PROPERTIES']['model_season']['VALUE_XML_ID']=='zima'){
                        $season_class = 'winter';
                        $pin = $arBasketItems['PROPERTIES']['model_pin']['VALUE_XML_ID']=='yes'?true:false;
                    }else{
                        $season_class = 'allseason';
                    }
                    echo '<p><span class="'.$season_class.'">'.$season_name.',</span> '.strtolower($arBasketItems['PROPERTIES']['model_type']['VALUE']).'</p>';
                }?>
                </td>
            <?endif;?>

            <?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
                <td class="old-price">
                <?if($arBasketItems["PRICE"]<$arBasketItems["BASE_PRICE"]['PRICE']){
                    echo '<span class="strike">'.($arBasketItems["BASE_PRICE"]['PRICE']).'<span class="rubl">'.GetMessage("DVS_RUB").'</span></span>  (-'.($arBasketItems["BASE_PRICE"]['PRICE']-$arBasketItems["PRICE"]).' <span class="rubl">'.GetMessage("DVS_RUB").'</span>)';
                }
                ?>
                </td>
            <?endif;?>

            <?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
                <td class="price"><?=$arBasketItems["PRICE"]?> <span class="rubl"><?=GetMessage("DVS_RUB")?></span></td>
            <?endif;?>

            <td class="fn">X</td>

            <?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
                <td class="number"><input maxlength="18" class="text2" type="text" name="QUANTITY_<?=$arBasketItems["ID"] ?>" value="<?=$arBasketItems["QUANTITY"]?>"/><span> <?=dvsUNIT?></span></td>
            <?endif;?>

            <td class="fn">=</td>

            <td class="total-price"><?=round($arBasketItems["TOTAL"])?> <span class="rubl"><?=GetMessage("DVS_RUB")?></span></td>
        </tr>
        <?$i++;
        }
        ?>
    </table>
<?if($arResult['DISCOUNT_PERCENT']>0){?>
    <div class="total">
        <p class="fonter"><?=GetMessage("DVS_DIS")?>: <strong><?echo ceil($arResult['DISCOUNT_PRICE'])?> <span class="rubl"><?=GetMessage("DVS_RUB")?></span> (<?echo $arResult['DISCOUNT_PERCENT_FORMATED'];?>)</strong></p>
    </div>
    <div style="clear:both;"></div>
<?}?>
    <div class="total">
        <span class="button1-span"><input class="button1" type="submit" value="<?echo GetMessage("SALE_REFRESH")?>" name="BasketRefresh" /></span>
        <p><?echo GetMessage("DVS_SUMM")?>: <?echo number_format(ceil($arResult['allSum']), 2, '.', ' ');?> <span class="rubl"><?=GetMessage("DVS_RUB")?></span></p>
    </div>
    <div class="clear"></div>

    <div class="buttons">
        <span class="button4-span"><input class="button4" type="submit" value="<?echo GetMessage("SALE_ORDER")?>" name="BasketOrder"  id="basketOrderButton2" /></span>
    </div>
    <div class="clear"></div>
</div>
<!-- // Cart -->