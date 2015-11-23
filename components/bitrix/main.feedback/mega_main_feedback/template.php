<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div class="m_feedback">
<?if(!empty($arResult["ERROR_MESSAGE"]))
{
	foreach($arResult["ERROR_MESSAGE"] as $v)
		ShowError($v);
}
if(strlen($arResult["OK_MESSAGE"]) > 0)
{
	?><div class="m_f-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
}
?>

	<img style="float:left; padding-right: 10px;"  src="/bitrix/templates/main_template/images/phone.png"></img>
	<H4 class="m_f_header"><?=GetMessage("OAS_CALL_HEADER")?></H4> 
	<P class="m_f_data"><?=GetMessage("OAS_CALL_DATA")?></P>
	
<form action="<?=POST_FORM_ACTION_URI?>" method="POST">
<?=bitrix_sessid_post()?>
	<div class="m_f-name">
		<div class="m_f-text">
			<?=GetMessage("MFT_NAME")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?><span class="m_f-req">*</span><?endif?>
		</div>
		<input type="text" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>">
	</div>
	
	<div class="m_f-phone" style="padding-bottom: 20px;">
		<div class="m_f-text">
			<?=GetMessage("MFT_PHONE")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])):?><span class="m_f-req">*</span><?endif?>
		</div>
		<input type="text" name="MESSAGE" value="<?=$arResult["MESSAGE"]?>">
	</div>
		
	
	<?if($arParams["USE_CAPTCHA"] == "Y"):?>
	<div class="m_f-captcha">
		<div class="m_f-text"><?=GetMessage("MFT_CAPTCHA")?></div>
		<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
		<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
		<div class="m_f-text"><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="m_f-req">*</span></div>
		<input type="text" name="captcha_word" size="30" maxlength="50" value="">
	</div>
	<?endif;?>
	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
	<input type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>" style="background: #0F85C1;
    border: 0px;
    padding: 5px;
    color: white;">
</form>
</div>