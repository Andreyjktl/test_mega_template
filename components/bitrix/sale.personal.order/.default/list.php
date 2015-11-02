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
	<div class="tab tab-history" style="display:block">

<?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.order.list",
	"",
	array(
		"PATH_TO_DETAIL" => $arResult["PATH_TO_DETAIL"],
		"PATH_TO_CANCEL" => $arResult["PATH_TO_CANCEL"],
		"PATH_TO_COPY" => $arResult["PATH_TO_LIST"].'?ID=#ID#',
		"PATH_TO_BASKET" => $arParams["PATH_TO_BASKET"],
		"SAVE_IN_SESSION" => $arParams["SAVE_IN_SESSION"],
		"ORDERS_PER_PAGE" => $arParams["ORDERS_PER_PAGE"],
		"SET_TITLE" =>$arParams["SET_TITLE"],
		"ID" => $arResult["VARIABLES"]["ID"],
		"NAV_TEMPLATE" => $arParams["NAV_TEMPLATE"],
	),
	$component
);
?>
 </div>
        <!-- // tab-history -->

    </div>
        <!-- // Tabs Content -->
</div>
<!-- // Cabinet -->
