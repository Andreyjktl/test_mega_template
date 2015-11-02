<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!$arResult["NavShowAlways"])
{
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}
?>
<div class="pager">
    <p><strong><?=$arResult["NavTitle"]?></strong></p>
    <ul>
<?

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

if($arResult["bDescPageNumbering"] === true):
    $bFirst = true;
    if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
        if ($arResult["nStartPage"] < $arResult["NavPageCount"]):
            $bFirst = false;
            if($arResult["bSavePage"]):
?>
            <li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><span>1</span></a></li>
<?
            else:
?>
            <li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><span>1</span></a></li>
<?
            endif;
            if ($arResult["nStartPage"] < ($arResult["NavPageCount"] - 1)):
?>    
            <li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=intVal($arResult["nStartPage"] + ($arResult["NavPageCount"] - $arResult["nStartPage"]) / 2)?>"><span>...</span></a></li>
<?
            endif;
        endif;
    endif;
    do
    {
        $NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;
        
        if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
?>
        <li class="selected"><span><?=$NavRecordGroupPrint?></span></li>
<?
        elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):
?>
        <li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><span><?=$NavRecordGroupPrint?></span></a></li>
<?
        else:
?>
        <li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"<?
            ?>><span><?=$NavRecordGroupPrint?></span></a></li>
<?
        endif;
        
        $arResult["nStartPage"]--;
        $bFirst = false;
    } while($arResult["nStartPage"] >= $arResult["nEndPage"]);
    
    if ($arResult["NavPageNomer"] > 1):
        if ($arResult["nEndPage"] > 1):
            if ($arResult["nEndPage"] > 2):
?>
        <li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=round($arResult["nEndPage"] / 2)?>"><span>...</span></a></li>
<?
            endif;
?>
        <li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><span><?=$arResult["NavPageCount"]?></span></a></li>
<?
        endif;

    endif; 

else:
    $bFirst = true;

    if ($arResult["NavPageNomer"] > 1):
        if ($arResult["nStartPage"] > 1):
            $bFirst = false;
            if($arResult["bSavePage"]):
?>
            <li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><span>1</span></a></li>
<?
            else:
?>
            <li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><span>1</span></a></li>
<?
            endif;
            if ($arResult["nStartPage"] > 2):
?>
            <li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=round($arResult["nStartPage"] / 2)?>"><span>...</span></a></li>
<?
            endif;
        endif;
    endif;

    do
    {
        if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
?>
        <lI class="selected"><span><?=$arResult["nStartPage"]?></span></li>
<?
        elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):
?>
        <li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="<?=($bFirst ? "modern-page-first" : "")?>"><span><?=$arResult["nStartPage"]?></span></a></li>
<?
        else:
?>
        <li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"<?
            ?> class="<?=($bFirst ? "modern-page-first" : "")?>"><span><?=$arResult["nStartPage"]?></span></a></li>
<?
        endif;
        $arResult["nStartPage"]++;
        $bFirst = false;
    } while($arResult["nStartPage"] <= $arResult["nEndPage"]);
    
    if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
        if ($arResult["nEndPage"] < $arResult["NavPageCount"]):
            if ($arResult["nEndPage"] < ($arResult["NavPageCount"] - 1)):
?>
        <li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=round($arResult["nEndPage"] + ($arResult["NavPageCount"] - $arResult["nEndPage"]) / 2)?>"><span>...</span></a></li>
<?
            endif;
?>
        <li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><span><?=$arResult["NavPageCount"]?></span></a></li>
<?
        endif;
    endif;
endif;
?>
    </ul>
    <div class="clear"></div>
</div>