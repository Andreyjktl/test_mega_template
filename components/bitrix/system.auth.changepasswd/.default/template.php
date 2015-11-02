<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(count($arParams["~AUTH_RESULT"]) > 0){?>
<div class="error-msg">
<p><?ShowMessage($arParams["~AUTH_RESULT"]);?></p>
</div>
<?}?>

<div class="pwd-recovery">
        <form action="<?=$arResult["AUTH_URL"]?>" method="post" name="bform">
            <?if (strlen($arResult["BACKURL"]) > 0): ?>
            <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
            <? endif ?>
            <input type="hidden" name="AUTH_FORM" value="Y">
            <input type="hidden" name="TYPE" value="CHANGE_PWD">

            <div class="form">
                    <div class="label">
                        <label><?=GetMessage("AUTH_LOGIN")?> *</label>
                    </div>
                    <div class="field">
                            <input type="text" class="text1" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" />
                    </div>

                    <div class="label">
                        <label><?=GetMessage("AUTH_CHECKWORD")?> *</label>
                    </div>
                    <div class="field">
                            <input type="text" class="text1" name="USER_CHECKWORD" maxlength="50" value="<?=$arResult["USER_CHECKWORD"]?>" />
                    </div>

                    <div class="label">
                        <label><?=GetMessage("AUTH_NEW_PASSWORD_REQ")?> *</label>
                    </div>
                    <div class="field">
                            <input type="password" class="text1" name="USER_PASSWORD" maxlength="50" value="<?=$arResult["USER_PASSWORD"]?>" />
                    </div>

                    <div class="label">
                        <label><?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?> *</label>
                    </div>
                    <div class="field">
                            <input type="password" class="text1" name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" />
                    </div>


                    <div class="submit">
                            <button type="submit" class="button1" name="change_pwd"><span><?=GetMessage("DVS_PASS_SEND")?></span></button>
                    </div>
            </div>
        </form>
</div>
<br />
<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
<p><span class="starrequired">*</span><?=GetMessage("AUTH_REQ")?></p>

<script type="text/javascript">
document.bform.USER_LOGIN.focus();
</script>