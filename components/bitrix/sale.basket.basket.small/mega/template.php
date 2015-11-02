<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(!function_exists("BasketNumberWordEndings"))
{
	function BasketNumberWordEndings($num, $lang = false, $arEnds = false)
	{
		if ($lang===false)
			$lang = LANGUAGE_ID;

		if ($arEnds===false)
			$arEnds = array(GetMessage("DVS_OV"), GetMessage("DVS_OV"), '', GetMessage("DVS_A"));

		if ($lang=="ru")
		{
			if (strlen($num)>1 && substr($num, strlen($num)-2, 1)=="1")
			{
				return $arEnds[0];
			}
			else
			{
				$c = IntVal(substr($num, strlen($num)-1, 1));
				if ($c==0 || ($c>=5 && $c<=9))
					return $arEnds[1];
				elseif ($c==1)
					return $arEnds[2];
				else
					return $arEnds[3];
			}
		}
		elseif ($lang=="en")
		{
			if (IntVal($num)>1)
			{
				return "s";
			}
			return "";
		}
		else
		{
			return "";
		}
	}
}
if(!empty($arResult["ITEMS"])){
    $arResult['END'] = BasketNumberWordEndings(count($arResult["ITEMS"]));
}
?>
<br>
    <div class="cart-info">
        <p class="cart"><a href="<?=$arParams["PATH_TO_BASKET"]?>"><?=GetMessage("DVS_INCART");?></a>
<?
$sum = 0;
$num = 0;
foreach ($arResult["ITEMS"] as $v)
{
        if ($v["DELAY"]=="N" && $v["CAN_BUY"]=="Y")
        {
            $sum += ($v["PRICE"]*$v["QUANTITY"]);
            $num++;
        }
}

if($num==0){
    echo ' '.GetMessage("DVS_EMPTY").'</p>'.'</a>';
}else{
	
?>
   <a href="<?=$arParams["PATH_TO_BASKET"]?>"><strong>(<?echo $num;?>)</a></p>

 <?/*  <p><a href="<?=$arParams["PATH_TO_BASKET"]?>"><strong><?echo $num;?> <?=GetMessage("DVS_ITEM");?><?echo $arResult['END'];?> <br/><?=GetMessage("DVS_SUMM");?> <?echo $sum;?> <span class="rubl"><?=GetMessage("DVS_RUB");?></span></strong></a></p>
*/?>
<?}?>
    </div>
