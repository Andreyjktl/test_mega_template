<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arResult["FORM_TYPE"] == "login"):?>

<div class="auth">
    <ul>
        <li><a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><span><?=GetMessage("DVS_REG")?></span></a></li>
        <li><a href="/auth/" class="signin"><span><?=GetMessage("AUTH_LOGIN_BUTTON")?></span></a></li>

    </ul>
    <div class="clear"></div>
    <div class="signin">
        <div class="close"></div>
        <p class="tab"><?=GetMessage("AUTH_LOGIN_BUTTON")?></p>
        <form method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
            <?if($arResult["BACKURL"] <> ''):?>
                    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
            <?endif?>
            <?foreach ($arResult["POST"] as $key => $value):?>
                    <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
            <?endforeach?>
            <input type="hidden" name="AUTH_FORM" value="Y" />
            <input type="hidden" name="TYPE" value="AUTH" />

            <p class="label"><label><?=GetMessage("AUTH_LOGIN")?></label></p>
            <input type="text" class="text1" value="<?=$arResult["USER_LOGIN"]?>" tabindex="2" name="USER_LOGIN" />
            <p class="label"><label><?=GetMessage("AUTH_PASSWORD")?></label> <a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow" class="forgot"><?=GetMessage("DVS_REM")?></a></p>
            <input type="password" class="text1" value="" tabindex="3" name="USER_PASSWORD" />
            <p class="remember"><label><input type="checkbox" name="USER_REMEMBER" value="Y" />&nbsp; <?=GetMessage("DVS_REM_ME")?></label></p>
            <div class="submit"><button type="submit" class="button3"><span><?=GetMessage("AUTH_LOGIN_BUTTON")?></span></button></div>
        </form>
    </div>
</div>
<?
//if($arResult["FORM_TYPE"] == "login")
else:
    $exit_lnk = $APPLICATION->GetCurPageParam("logout=yes", array("login", "logout", "register", "forgot_password", "change_password"));?>
<div class="auth">
<form action="<?=$arResult["AUTH_URL"]?>">
    <ul>
    <li><a href="<?=$arResult["PROFILE_URL"]?>" title="<?=GetMessage("AUTH_PROFILE")?>"><span><?=GetMessage("AUTH_PROFILE")?></span></a></li>
    <li><a href="<?echo $exit_lnk;?>" class="logout"><span><?=GetMessage("AUTH_LOGOUT_BUTTON")?></span></a></li>
    </ul>
</form>
</div>
<?endif?>