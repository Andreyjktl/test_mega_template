<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(count($arParams["~AUTH_RESULT"]) > 0){?>
<div class="error-msg">
<p><?ShowMessage($arParams["~AUTH_RESULT"]);?></p>
</div>
<?}?>

<!-- Password Recovery -->
<div class="pwd-recovery">
        <p><?=GetMessage("AUTH_FORGOT_PASSWORD_1")?></p>
        <br/>
        <form action="<?=$arResult["AUTH_URL"]?>" method="post" name="bform">
        <?
        if (strlen($arResult["BACKURL"]) > 0)
        {
        ?>
                <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
        <?
        }
        ?>
                <input type="hidden" name="AUTH_FORM" value="Y">
                <input type="hidden" name="TYPE" value="SEND_PWD">

                <div class="form">
                        <div class="label">
                                <label><?=GetMessage("AUTH_EMAIL")?>:</label>
                        </div>
                        <div class="field">
                                <input type="text" class="text1" value="<?=$arResult["LAST_LOGIN"]?>" name="USER_LOGIN" />
                        </div>
                        <div class="submit">
                                <button type="submit" class="button1" name="send_account_info"><span><?=GetMessage("DVS_PASS_SEND")?></span></button>
                        </div>
                </div>
        </form>
</div>
<!-- // Password Recovery -->

<script type="text/javascript">
document.bform.USER_LOGIN.focus();
</script>
