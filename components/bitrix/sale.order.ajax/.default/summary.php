<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<table class="order">
    <tr>
        <th><?=GetMessage("SOA_TEMPL_SUM_NAME")?></th>
        <th><?=GetMessage("SOA_TEMPL_SUM_DISCOUNT")?></th>
        <th><?=GetMessage("SOA_TEMPL_PRICE")?></th>
        <th>&nbsp;</th>
        <th><?=GetMessage("SOA_TEMPL_SUM_QUANTITY")?></th>
        <th>&nbsp;</th>
        <th><?=GetMessage("SOA_TEMPL_SUM_PRICE")?></th>
    </tr>
    <?
    foreach($arResult["BASKET_ITEMS"] as $arBasketItems)
    {
        ?>
        <tr>
            <td class="txt"><h4><?=$arBasketItems["NAME"]?></h4></td>
            <td class="old-price">
            <?if ($arBasketItems["PRICE"] < $arBasketItems["BASE_PRICE"]["PRICE"]) {?>
                <span class="strike"><?=$arBasketItems["BASE_PRICE"]["PRICE"]?> <span class="rubl"><?=GetMessage("DVS_RUB");?></span></span>&nbsp; (<?=$arBasketItems["PRICE"] - $arBasketItems["BASE_PRICE"]["PRICE"]?> <span class="rubl"><?=GetMessage("DVS_RUB");?></span>)
            <?}?>
            </td>
            <td class="price"><?=$arBasketItems["PRICE"]?> <span class="rubl"><?=GetMessage("DVS_RUB");?></span></td>
            <td class="fn">X</td>
            <td class="number"><?=$arBasketItems["QUANTITY"]?> <?=dvsUNIT?></td>
            <td class="fn">=</td>
            <td class="total-price"><?=$arBasketItems["TOTAL"]?> <span class="rubl"><?=GetMessage("DVS_RUB");?></span></td>
        </tr>
        <?
    }
    ?>
    <tr>
        <td colspan="6" align="right"><?=GetMessage("SOA_TEMPL_SUM_SUMMARY")?></td>
        <td><strong><?=$arResult["ORDER_PRICE"]?> <span class="rubl"><?=GetMessage("DVS_RUB");?></span></strong></td>
    </tr>

    <?if(!empty($arResult["arTaxList"])){
        foreach($arResult["arTaxList"] as $val){?>
    <tr>
        <td colspan="6" align="right"><?=$val["NAME"]?> <?=$val["VALUE_FORMATED"]?>:</td>
        <td><strong><?=$val["VALUE_MONEY"]?> <span class="rubl"><?=GetMessage("DVS_RUB");?></span></strong></td>
    </tr>
        <?}
    }?>

    <?if (doubleval($arResult["DELIVERY_PRICE"]) > 0){?>
    <tr>
        <td colspan="6" align="right"><?=GetMessage("SOA_TEMPL_SUM_DELIVERY")?></td>
        <td><strong><?=$arResult["DELIVERY_PRICE"]?> <span class="rubl"><?=GetMessage("DVS_RUB");?></span></strong></td>
    </tr>
    <?}?>

    <?if (strlen($arResult["PAYED_FROM_ACCOUNT_FORMATED"]) > 0){?>
    <tr>
        <td colspan="6" align="right"><?=GetMessage("SOA_TEMPL_SUM_PAYED")?></td>
        <td><strong><?=$arResult["PAYED_FROM_ACCOUNT_FORMATED"]?> <span class="rubl"><?=GetMessage("DVS_RUB");?></span></strong></td>
    </tr>
    <?}?>

    <?if($arResult['DISCOUNT_PERCENT']>0){?>
    <tr>
        <td colspan="6" align="right"><?=GetMessage("SOA_TEMPL_SUM_DISCOUNT")?> (<?echo $arResult['DISCOUNT_PERCENT_FORMATED'];?>):</td>
        <td><strong><?echo ceil($arResult['DISCOUNT_PRICE'])?> <span class="rubl"><?=GetMessage("DVS_RUB");?></span></strong></td>
    </tr>
    <?}?>
</table>

<div class="total">
    <p><?=GetMessage("SOA_TEMPL_SUM_IT")?> <?=number_format($arResult['ORDER_PRICE'] - ceil($arResult['DISCOUNT_PRICE']), 2, '.', ' ');?> <span class="rubl"><?=GetMessage("DVS_RUB");?></span></p>
</div>
<div class="clear"></div>