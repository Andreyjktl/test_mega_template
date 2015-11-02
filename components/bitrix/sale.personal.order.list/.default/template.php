<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//print '<pre>';
//print_r($arResult);
//print '</pre>';

if($_REQUEST["filter_canceled"] == "Y" && $_REQUEST["filter_history"] == "Y")
	$page = "canceled";
elseif($_REQUEST["filter_status"] == "F" && $_REQUEST["filter_history"] == "Y")
	$page = "completed";
elseif($_REQUEST["filter_history"] == "Y")
	$page = "all";
else
	$page = "active";
?>
<!-- Order History -->
<div class="inline-filter order-filter">
        <label><?=GetMessage("STPOL_F_NAME")?></label>
&nbsp;
        <?if($page != "active"):?><a href="<?=$arResult["CURRENT_PAGE"]?>?filter_history=N"><?else:?><b><?endif;?><?=GetMessage("STPOL_F_ACTIVE")?><?if($page != "active"):?></a><?else:?></b><?endif;?>
&nbsp;&nbsp;
        <?if($page != "all"):?><a href="<?=$arResult["CURRENT_PAGE"]?>?filter_history=Y"><?else:?><b><?endif;?><?=GetMessage("STPOL_F_ALL")?><?if($page != "all"):?></a><?else:?></b><?endif;?>
&nbsp;&nbsp;
        <?if($page != "completed"):?><a href="<?=$arResult["CURRENT_PAGE"]?>?filter_status=F&filter_history=Y"><?else:?><b><?endif;?><?=GetMessage("STPOL_F_COMPLETED")?><?if($page != "completed"):?></a><?else:?></b><?endif;?>
&nbsp;&nbsp;
        <?if($page != "canceled"):?><a href="<?=$arResult["CURRENT_PAGE"]?>?filter_canceled=Y&filter_history=Y"><?else:?><b><?endif;?><?=GetMessage("STPOL_F_CANCELED")?><?if($page != "canceled"):?></a><?else:?></b><?endif;?>
</div>
<?if(count($arResult["ORDERS"])>0){?>
<table class="history">
        <tr>
                <th><?=GetMessage("SPOL_T_ID")?></th>
                <th><?=GetMessage("SPOL_T_BASKET")?></th>
                <th><?=GetMessage("SPOL_T_PRICE")?></th>
                <th><?=GetMessage("SPOL_T_STATUS")?></th>
        </tr>

        <?foreach($arResult["ORDERS"] as $val):?>
        <tr>
                <td class="order"><h4><a href="<?=$val["ORDER"]["URL_TO_DETAIL"]?>"><b><?=GetMessage("STPOL_ORDER_NO")?><?=$val["ORDER"]["ID"]?></b><br /><?=GetMessage("SPOL_T_FROM")?> <?=$val["ORDER"]["DATE_INSERT_FORMAT"]?></a></h4></td>
                <td class="goods"><?
                            $bNeedComa = False;
                            foreach($val["BASKET_ITEMS"] as $vval)
                            {
                                    ?><p><?
                                    if (strlen($vval["DETAIL_PAGE_URL"])>0)
                                            echo '<a href="'.$vval["DETAIL_PAGE_URL"].'">';
                                    echo $vval["NAME"];
                                    if (strlen($vval["DETAIL_PAGE_URL"])>0)
                                            echo '</a>';
                                            echo ' - '.$vval["QUANTITY"].' '.GetMessage("STPOL_SHT");
                                    ?></p><?
                            }
                ?></td>
                <td class="price"><?=$val["ORDER"]["PRICE"]?> <span class="rubl"><?=GetMessage("DVS_RUB");?></span></td>
                <td class="status">
                    <?
//                  print $val["ORDER"]["STATUS_ID"];
                    $status = 'adopted';
                    if($val["ORDER"]["STATUS_ID"]=='F'){
                        $status = 'formed';
                    }elseif($val["ORDER"]["STATUS_ID"]=='N'){
                        $status = 'sent';
                    }
                    ?>
                    <?if ($val["ORDER"]["CANCELED"] == "Y"):?>
                        <h4 class="canceled"><?=GetMessage("STPOL_CANCELED");?></h4><br /><?=$val["ORDER"]["DATE_CANCELED"]?><br />
                    <?else:?>
                        <h4 class="<?echo $status;?>"><?=$arResult["INFO"]["STATUS"][$val["ORDER"]["STATUS_ID"]]["NAME"]?></h4><br /><?=$val["ORDER"]["DATE_STATUS"]?><br />
                    <?endif;?>

                    <br />
                    <a title="<?=GetMessage("SPOL_T_COPY_ORDER_DESCR")?>" class="button1" href="<?=$val["ORDER"]["URL_TO_COPY"]?>"><span><?=GetMessage("SPOL_T_COPY_ORDER")?></span></a>
                    <?if($val["ORDER"]["CAN_CANCEL"] == "Y"):?>
                            <a title="<?=GetMessage("SPOL_T_DELETE_DESCR")?>" class="button1" href="<?=$val["ORDER"]["URL_TO_CANCEL"]?>"><span><?=GetMessage("SPOL_T_DELETE")?></span></a>
                    <?endif;?>
                </td>
        </tr>
        <?endforeach;?>
</table>
<?}?>
<!-- // Order History -->