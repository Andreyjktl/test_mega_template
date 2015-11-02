<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="cabinet">
    <!-- Tabs -->
    <div class="tabs full">
            <ul class="tabs size2">
                    <li><a href="<?=SITE_DIR?>personal/"><span><?=GetMessage("DVS_PERSONAL");?></span></a></li>
                    <li class="selected">
<!--                        <a href="<?=SITE_DIR?>personal/orders.php">-->
                            <span><?=GetMessage("DVS_ORDERS");?></span>
<!--                        </a>-->
                    </li>
            </ul>
            <div class="clear"></div>
    </div>
    <!-- // Tabs -->

    <br/><br/>

    <!-- Tabs Content -->
    <div class="tabs-content">
        <!-- tab-history -->
	<div class="tab tab-history" style="display:block"><?
$arDetParams = array(
		"PATH_TO_LIST" => $arResult["PATH_TO_LIST"],
		"PATH_TO_CANCEL" => $arResult["PATH_TO_CANCEL"],
		"PATH_TO_PAYMENT" => $arParams["PATH_TO_PAYMENT"],
		"SET_TITLE" =>$arParams["SET_TITLE"],
		"ID" => $arResult["VARIABLES"]["ID"],
	);
foreach($arParams as $key => $val)
{
	if(strpos($key, "PROP_") !== false)
		$arDetParams[$key] = $val;
}

$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.order.detail",
	"",
	$arDetParams,
	$component
);
?>
</div>
        <!-- // tab-history -->

    </div>
        <!-- // Tabs Content -->
</div>
<!-- // Cabinet -->
