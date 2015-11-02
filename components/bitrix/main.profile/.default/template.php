<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="cabinet">
    <p><?=GetMessage("DVS_PROFILE_TEXT");?></p>
    <br/><br/>

    <!-- Tabs -->
    <div class="tabs full">
            <ul class="tabs size2">
                    <li class="selected">
<!--                        <a href="#tab-settings">-->
                            <span><?=GetMessage("USER_PERSONAL_INFO");?></span>
<!--                        </a>-->
                    </li>
                    <li><a href="<?=SITE_DIR?>personal/orders.php"><span><?=GetMessage("DVS_ORDERS");?></span></a></li>
            </ul>
            <div class="clear"></div>
    </div>
    <!-- // Tabs -->

    <br/><br/>

    <!-- Tabs Content -->
    <div class="tabs-content">
        <!-- tab-settings -->
        <div class="tab tab-settings" style="display:block">
<?
//echo "<pre>"; print_r($arResult); echo "</pre>";
//exit();
//echo "<pre>"; print_r($_SESSION); echo "</pre>";

?>
<?if(!empty($arResult["strProfileError"]) > 0){?>
<div class="error-msg">
<?=ShowError($arResult["strProfileError"]);?>
</div>
<?}?>

<?
if ($arResult['DATA_SAVED'] == 'Y'){
	echo ShowNote(GetMessage('PROFILE_DATA_SAVED'));
        echo '<br />';
}
?>

<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>?" enctype="multipart/form-data">
    <?=$arResult["BX_SESSION_CHECK"]?>
    <input type="hidden" name="lang" value="<?=LANG?>" />
    <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />

    <div class="form">
            <div class="label">
                    <label><?=GetMessage('EMAIL')?></label>
            </div>
            <div class="field">
                    <input type="text" class="text1" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>" />
                    <p><?=GetMessage('DVS_DES_EMAIL')?></p>
            </div>
            <div class="label">
                    <label><?=GetMessage('LOGIN')?></label>
            </div>
            <div class="field">
                    <input type="text" class="text1" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" />
                    <p><?=GetMessage('DVS_DES_LOGIN')?></p>
            </div>
            <div class="label">
                    <label><?=GetMessage('NEW_PASSWORD_REQ')?></label>
            </div>
            <div class="field">
                   <input type="password" class="text1" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" />
                    <p><?=GetMessage('DVS_DES_PASS')?></p>
            </div>
            <div class="label">
                    <label><?=GetMessage('NEW_PASSWORD_CONFIRM')?></label>
            </div>
            <div class="field">
                    <input type="password" class="text1" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" />
                    <p><?=GetMessage('DVS_DES_PASS2')?></p>
            </div>
    </div>

    <br/><br/>

    <div class="block full">
            <div class="form">
                    <div class="label">
                            <label><?=GetMessage('NAME')?></label>
                    </div>
                    <div class="field">
                            <input type="text" class="text1" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" />
                            <p><?=GetMessage('DVS_DES_NAME')?></p>
                    </div>
                    <div class="label">
                            <label><?=GetMessage('LAST_NAME')?></label>
                    </div>
                    <div class="field">
                            <input type="text" class="text1" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" />
                            <p><?=GetMessage('DVS_DES_TRUE')?></p>
                    </div>
                    <div class="label">
                            <label><?=GetMessage('SECOND_NAME')?></label>
                    </div>
                    <div class="field">
                            <input type="text" class="text1" name="SECOND_NAME" maxlength="50" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" />
                            <p><?=GetMessage('DVS_DES_TRUE')?></p>
                    </div>




                    <div class="label">
                            <label><?=GetMessage('USER_PHONE')?></label>
                    </div>
                    <div class="field">
                            <input type="text" class="text1" name="PERSONAL_PHONE" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" />
                            <p><?=GetMessage('DVS_DES_PHONE')?></p>
                    </div>
                    <div class="label">
                            <label><?=GetMessage('USER_CITY')?></label>
                    </div>
                    <div class="field">
                            <input type="text" class="text1" name="PERSONAL_CITY" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_CITY"]?>" />
                            <p><?=GetMessage('DVS_DES_CITY')?></p>
                    </div>
                    <div class="label">
                            <label><?=GetMessage("USER_STREET")?></label>
                    </div>
                    <div class="field">
                            <textarea cols="30" rows="5" name="PERSONAL_STREET"><?=$arResult["arUser"]["PERSONAL_STREET"]?></textarea>
                            <p><?=GetMessage('DVS_DES_ADDRESS')?></p>
                    </div>
            </div>
    </div>

    <br/><br/>

    <div class="form">
            <div class="submit">
                <input type="hidden" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>" />
                <button type="submit" class="button1"><span><?=GetMessage("SAVE")?></span></button>
            </div>
    </div>
</form>

</div>
        <!-- // tab-settings -->

    </div>
        <!-- // Tabs Content -->
</div>
<!-- // Cabinet -->
