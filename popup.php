<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?IncludeTemplateLangFile(__FILE__);?>
<?$BASKET_URL = SITE_DIR.'personal/cart';?>
<!-- Popup: Order Added -->
<div class="popup added">
	<div class="close"></div>
	<div class="title"><h3><?=GetMessage("DVS_ADD")?></h3></div>
	<div class="padding">
		<div class="item-preview">
			<img id="buyForm-img" />
		</div>
		<div class="item-details">
				<h4 id="buyForm-itemName"></h4>
				<p><span id="summ-detail"><span class="summ-detail-count"></span> <?=GetMessage("DVS_PIECES")?> õ <span class="summ-detail-price"></span></span> <span class="rubl"><?=GetMessage("DVS_RUB")?></span></p>
				<p class="total"><span id="total"><?=GetMessage("DVS_TOTAL")?>: <span></span></span> <span class="rubl"><?=GetMessage("DVS_RUB")?></span></p>
				<div class="buttons">
					<button type="button" class="button1" onclick="location.replace('<?echo $BASKET_URL;?>');"><span><?=GetMessage("DVS_2CART")?></span></button>
					<button type="button" class="button1 close-button"><span><?=GetMessage("DVS_2BACK")?></span></button>
					<div class="clear"></div>
				</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<!-- // Popup: Order Added -->

<!-- Popup: Order Warning -->
<div class="popup warning">
	<div class="close"></div>
	<div class="title"><h3><?=GetMessage("DVS_NOT_AV")?></h3></div>
	<div class="padding">
		<div class="item-preview"><img src="" width="" height="" alt="" id="buyForm-img-w" /></div>
		<div class="item-details">
			<h4 id="buyForm-itemName-w"></h4>
			<p><?=GetMessage("DVS_CONTACT")?></p>
			<div class="buttons">
				<button type="button" class="button1 close-button"><span><?=GetMessage("DVS_2BACK")?></span></button>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<!-- // Popup: Order Warning -->