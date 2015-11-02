<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?
//print '<pre>';
//print_r($arResult);
//print '</pre>';
?>

<?if($USER->IsAuthorized()):?>
<div class="reg"><div class="success-msg"><p><?=GetMessage("DVS_TEXT");?></p></div></div>
<?else:?>
<div class="reg">
        <form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
                <?if (strlen($arResult["BACKURL"]) > 0){?>
                        <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                <?}?>
                <?if (count($arResult["ERRORS"]) > 0){?>
                <div class="error-msg"><p><?echo GetMessage("DVS_ERRORS");?></p></div>
                <?}?>

                <div class="individual">
                        <div class="form">
                                <div class="label<?if(isset($arResult["ERRORS"]['LOGIN'])) echo ' error'?>">
                                        <label><?=GetMessage("REGISTER_FIELD_LOGIN");?>:</label>
                                </div>
                                <div class="field<?if(isset($arResult["ERRORS"]['LOGIN'])) echo ' error'?>">
                                        <input type="text" class="text1" name="REGISTER[LOGIN]" maxlength="50" value="<?=$arResult["VALUES"]["LOGIN"]?>" />
                                        <?if(isset($arResult["ERRORS"]['LOGIN'])) echo '<p>'.str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_LOGIN")."&quot;", $arResult["ERRORS"]['LOGIN']).'</p>';
                                        else echo '<p>'.GetMessage("DVS_FIELD_LOGIN_DES").'</p>';
                                        ?>

                                </div>


                                <div class="label<?if(isset($arResult["ERRORS"]['EMAIL'])) echo ' error'?>">
                                        <label><?=GetMessage("REGISTER_FIELD_EMAIL");?>:</label>
                                </div>
                                <div class="field<?if(isset($arResult["ERRORS"]['EMAIL'])) echo ' error'?>">
                                        <input type="text" class="text1" name="REGISTER[EMAIL]" maxlength="50" value="<?=$arResult["VALUES"]["EMAIL"]?>" />
                                        <?if(isset($arResult["ERRORS"]['EMAIL'])) echo '<p>'.str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_EMAIL")."&quot;", $arResult["ERRORS"]['EMAIL']).'</p>';
                                        else echo '<p>'.GetMessage("DVS_FIELD_EMAIL_DES").'</p>';
                                        ?>

                                </div>


                                <div class="label<?if(isset($arResult["ERRORS"]['PASSWORD'])) echo ' error'?>">
                                        <label><?=GetMessage("REGISTER_FIELD_PASSWORD");?>:</label>
                                </div>
                                <div class="field<?if(isset($arResult["ERRORS"]['PASSWORD'])) echo ' error'?>">
                                        <input type="password" name="REGISTER[PASSWORD]" maxlength="50" value="" class="text1" />

                                        <?if(isset($arResult["ERRORS"]['PASSWORD'])) echo '<p>'.str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_PASSWORD")."&quot;", $arResult["ERRORS"]['PASSWORD']).'</p>';
                                        else echo '<p>'.$arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"].'</p>'?>
                                </div>


                                <div class="label<?if(isset($arResult["ERRORS"]['CONFIRM_PASSWORD'])) echo ' error'?>">
                                        <label><?=GetMessage("REGISTER_FIELD_CONFIRM_PASSWORD");?>:</label>
                                </div>
                                <div class="field<?if(isset($arResult["ERRORS"]['CONFIRM_PASSWORD'])) echo ' error'?>">
                                        <input type="password" class="text1" name="REGISTER[CONFIRM_PASSWORD]" maxlength="50" value="" />

                                        <?if(isset($arResult["ERRORS"]['CONFIRM_PASSWORD'])) echo '<p>'.str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_CONFIRM_PASSWORD")."&quot;", $arResult["ERRORS"]['CONFIRM_PASSWORD']).'</p>';
                                        else echo '<p>'.GetMessage("DVS_FIELD_CONF_PASS_DES").'</p>'?>

                                </div>
                        </div>

                        <br/><br/>

                        <div class="block full">
                                <div class="form">
                                        <div class="label<?if(isset($arResult["ERRORS"]['NAME'])) echo ' error'?>">
                                                <label><?=GetMessage("REGISTER_FIELD_NAME");?>:</label>
                                        </div>
                                        <div class="field<?if(isset($arResult["ERRORS"]['NAME'])) echo ' error'?>">
                                                <input type="text" class="text1" name="REGISTER[NAME]" maxlength="50" value="<?=$arResult["VALUES"]["NAME"]?>" />

                                                <?if(isset($arResult["ERRORS"]['NAME'])) echo '<p>'.str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_NAME")."&quot;", $arResult["ERRORS"]['NAME']).'</p>';
                                                else echo '<p>'.GetMessage("DVS_FIELD_NAME_DES").'</p>'?>
                                        </div>

                                        <div class="label<?if(isset($arResult["ERRORS"]['LAST_NAME'])) echo ' error'?>">
                                                <label><?=GetMessage("REGISTER_FIELD_LAST_NAME");?>:</label>
                                        </div>
                                        <div class="field<?if(isset($arResult["ERRORS"]['LAST_NAME'])) echo ' error'?>">
                                                <input type="text" class="text1" name="REGISTER[LAST_NAME]" maxlength="50" value="<?=$arResult["VALUES"]["LAST_NAME"]?>" />
                                                <?if(isset($arResult["ERRORS"]['LAST_NAME'])) echo '<p>'.str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_LAST_NAME")."&quot;", $arResult["ERRORS"]['LAST_NAME']).'</p>';
                                                else echo '<p>'.GetMessage("DVS_FIELD_LAST_NAME_DES").'</p>'?>
                                        </div>
                                </div>
                        </div>
                </div>
<?
/* CAPTCHA */
if ($arResult["USE_CAPTCHA"] == "Y")
{
	?>
                <br/><br/>
                <div class="form">
                        <div class="captcha">
                            <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
                        </div>
                        <div class="label<?if(isset($arResult["ERRORS"]['CAPTCHA'])) echo ' error'?>">
                                <label><?echo GetMessage("DVS_REP_CODE");?>:</label>
                        </div>
                        <div class="field<?if(isset($arResult["ERRORS"]['CAPTCHA'])) echo ' error'?>">
                                <input type="text" name="captcha_word" maxlength="50" value="" class="text1" />
                                <?if(isset($arResult["ERRORS"]['CAPTCHA'])) echo '<p>'.GetMessage("DVS_FIELD_ERROR_CAPTCHA").'</p>';
                                else echo '<p>'.GetMessage("DVS_FIELD_CAPTCHA_DES").'</p>'?>
                        </div>
                        <div class="submit">
                            <button type="submit" class="button1" name="register_submit_button"><span><?echo GetMessage("DVS_REG");?></span></button>
                        </div>
                </div>
                <?
}
/* !CAPTCHA */
?>
        </form>
</div>
<?endif?>