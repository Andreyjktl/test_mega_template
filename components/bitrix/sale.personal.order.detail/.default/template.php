<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//print '<pre>';
//print_r($arResult);
//print '</pre>';
?>
<!-- Order Details -->
<div class="order-details">
        <table class="order">
                <tr>
                        <th><?=GetMessage("DVS_I_NAME");?></th>
                        <th><?=GetMessage("DVS_OLD_PRICE");?></th>
                        <th><?=GetMessage("DVS_PRICE4ONE");?></th>
                        <th>&nbsp;</th>
                        <th><?=GetMessage("DVS_QUANTITY");?></th>
                        <th>&nbsp;</th>
                        <th><?=GetMessage("DVS_PRICE");?></th>
                </tr>
                <?
                foreach($arResult["BASKET"] as $val)
		{?>
                <tr>
                        <td class="txt"><h4><?
                        if (strlen($val["DETAIL_PAGE_URL"])>0)
                                echo "<a href=\"".$val["DETAIL_PAGE_URL"]."\">";
                        echo htmlspecialcharsEx($val["NAME"]);
                        if (strlen($val["DETAIL_PAGE_URL"])>0)
                                echo "</a>";
                        ?></h4></td>
                        <td class="old-price">
                            <?if($val["DISCOUNT_PRICE"]>0){?>
                            <span class="strike"><?=$val["PRICE"]?> <span class="rubl"><?=GetMessage("DVS_RUB");?></span></span>&nbsp; (-<?=$val["DISCOUNT_PRICE"]?> <span class="rubl"><?=GetMessage("DVS_RUB");?></span>)
                            <?}?>
                        </td>
                        <td class="price"><?=($val["PRICE"]-$val["DISCOUNT_PRICE"])?> <span class="rubl"><?=GetMessage("DVS_RUB");?></span></td>
                        <td class="fn">X</td>
                        <td class="number"><?=$val["QUANTITY"]?> <?=dvsUNIT?></td>
                        <td class="fn">=</td>
                        <td class="total-price"><?=(($val["PRICE"]-$val["DISCOUNT_PRICE"])*$val["QUANTITY"]);?> <span class="rubl"><?=GetMessage("DVS_RUB");?></span></td>
                </tr>
                <?}?>
        </table>

        <div class="total">
                <p><?=GetMessage("DVS_SUMM");?>: <?echo $arResult['PRICE'];?> <span class="rubl"><?=GetMessage("DVS_RUB");?></span></p>
        </div>
        <div class="clear"></div>

        <div class="block full">
                <div class="lb">
                        <div class="form">
                            <?foreach($arResult['ORDER_PROPS'] as $oneProp){?>
                                <div class="label">
                                        <label><?echo $oneProp['NAME'];?></label>
                                </div>
                                <div class="field">
                                    <?if($oneProp['TYPE']=='TEXTAREA'){?>
                                        <textarea cols="30" rows="5" disabled="disabled"><?echo $oneProp['VALUE'];?></textarea>
                                    <?}else{?>
                                        <input type="text" class="text1" value="<?echo $oneProp['VALUE'];?>" disabled="disabled" />
                                    <?}?>
                                </div>
                            <?}?>
                        </div>
                </div>
                <div class="rb">
                        <div class="form">
                                <div class="label">
                                        <label><?=GetMessage("DVS_COMM");?>:</label>
                                </div>
                                <div class="field">
                                        <textarea disabled="disabled"><?echo $arResult['ADDITIONAL_INFO'];?></textarea>
                                </div>
                        </div>
                </div>
                <div class="clear"></div>
        </div>
</div>
<!-- // Order Details -->