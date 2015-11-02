<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<?if (strlen($arParams["~AUTH_RESULT"]) > 0 || strlen($arResult['ERROR_MESSAGE']) > 0) {?>
<div class="error-msg">
<p><?ShowMessage($arParams["~AUTH_RESULT"]);?></p>
<p><?ShowMessage($arResult['ERROR_MESSAGE']);?></p>
</div>
<?}?>

<!-- Login -->
<div class="login">
    <form name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
        <input type="hidden" name="AUTH_FORM" value="Y" />
        <input type="hidden" name="TYPE" value="AUTH" />
        <?if (strlen($arResult["BACKURL"]) > 0):?>
        <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
        <?endif?>
        <?foreach ($arResult["POST"] as $key => $value):?>
        <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
        <?endforeach?>

        <div class="form">
            <div class="label">
                    <label><?=GetMessage("AUTH_LOGIN");?></label>
            </div>
            <div class="field">
                    <input type="text" class="text1" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" />
            </div>
            <div class="label">
                    <label><?=GetMessage("AUTH_PASSWORD");?></label>
                    <a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow" class="forgot"><?=GetMessage("DVS_REM");?></a>
            </div>
            <div class="field">
                    <input type="password" class="text1" type="password" name="USER_PASSWORD" />
            </div>
            <div class="cb">
                    <p><label><input type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y" />&nbsp; <?=GetMessage("DVS_REM_ME");?></label></p>
            </div>
            <div class="submit">
                    <button type="submit" class="button1"><span><?=GetMessage("AUTH_AUTHORIZE");?></span></button>
            </div>
        </div>
    </form>
</div>
<!-- // Login -->

<script type="text/javascript">
<?if (strlen($arResult["LAST_LOGIN"])>0):?>
try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
<?else:?>
try{document.form_auth.USER_LOGIN.focus();}catch(e){}
<?endif?>
</script>

