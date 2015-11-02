<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<!-- Order Details -->
<div id="order_form_div" class="order-details">
<?
if(!$USER->IsAuthorized() && $arParams["ALLOW_AUTO_REGISTER"] == "N")
{
    if(!empty($arResult["ERROR"]))
    {
        foreach($arResult["ERROR"] as $v)
            echo ShowError($v);
    }
    elseif(!empty($arResult["OK_MESSAGE"]))
    {
        foreach($arResult["OK_MESSAGE"] as $v)
            echo "<p class='sof-ok'>".$v."</p>";
    }

    include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/auth.php");
}
else
{
    if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y")
    {
        if(strlen($arResult["REDIRECT_URL"]) > 0)
        {
            ?>
            <script>
            <!--
            //top.location.replace = '<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';
            window.top.location.href='<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';
            //setInterval("window.top.location.href='<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';",2000);
            //-->
            </script>
            <?
            die();
        }
        else
            include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/confirm.php");
    }
    else
    {
        $FORM_NAME = 'ORDERFORM_'.RandString(5);
        if(!empty($arResult["ERROR"]) && $arResult["USER_VALS"]["FINAL_STEP"] == "Y"){?>
            <div class="error-msg">
            <?foreach($arResult["ERROR"] as $v)
                echo '<p>'.$v.'</p>';
            ?>
            </div>
            <script>
            top.location.hash = '#order_form';
            </script>
            <?
        }
        ?>
        
        <script>
        <!--
        function submitForm(val)
        {
            if(val != 'Y') 
                document.getElementById('confirmorder').value = 'N';
            
            var orderForm = document.getElementById('ORDER_FORM_ID_NEW');
            
            //jsAjaxUtil.InsertFormDataToNode(orderForm, 'order_form_div', false);
            orderForm.submit();
            return true;
        }
        //-->
        </script>
        <div style="display:none;">
            <div id="order_form_id">
                &nbsp;
                <?if (count($arResult["PERSON_TYPE"]) > 1) {?>
                
                <h4><?=GetMessage("SOA_TEMPL_PERSON_TYPE")?></h4>
                <p class="reg">
                <?$inputSep = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                foreach($arResult["PERSON_TYPE"] as $v) {?>
                    <label for="PERSON_TYPE_<?= $v["ID"] ?>"><input type="radio" id="PERSON_TYPE_<?= $v["ID"] ?>" name="PERSON_TYPE" value="<?= $v["ID"] ?>"<?if ($v["CHECKED"]=="Y") echo " checked=\"checked\"";?> onClick="submitForm()" />&nbsp; <?= $v["NAME"] ?></label><?=$inputSep?>
                    <?$inputSep = ''?>
                <?}?>
                <input type="hidden" name="PERSON_TYPE_OLD" value="<?=$arResult["USER_VALS"]["PERSON_TYPE_ID"]?>" />
                </p>
                
                <?} else {
                    if(IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"]) > 0) {
                        ?>
                        <input type="hidden" name="PERSON_TYPE" value="<?=IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"])?>" />
                        <input type="hidden" name="PERSON_TYPE_OLD" value="<?=IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"])?>" />
                        <?
                    } else {
                        foreach($arResult["PERSON_TYPE"] as $v) {
                            ?>
                            <input type="hidden" id="PERSON_TYPE" name="PERSON_TYPE" value="<?=$v["ID"]?>" />
                            <input type="hidden" name="PERSON_TYPE_OLD" value="<?=$v["ID"]?>" />
                            <?
                        }
                    }
                }?>
                <br /><h4><?=GetMessage("SOA_TEMPL_PROP_INFO")?></h4>
                <div class="block full">
                    <div class="lb">
                        <div class="form">
                            <?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props.php");?>
                        </div>
                    </div>
                    <div class="rb">
                        <div class="form">
                            <div class="label">
                                <label><?=GetMessage("SOA_TEMPL_SUM_COMMENTS")?></label>
                            </div>
                            <div class="field">
                                <textarea rows="4" cols="40" name="ORDER_DESCRIPTION"><?=$arResult["USER_VALS"]["ORDER_DESCRIPTION"]?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="block full">
                    <div class="lb">
                        <div class="form">
                            <?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");?>
                        </div>
                    </div>
                    <div class="rb">
                        <div class="form">
                            <?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");?>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                </div>
                <br />
                <?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/summary.php");?>
                <div class="buttons">
                    <input type="hidden" name="confirmorder" id="confirmorder" value="Y">
                    <button type="button" name="submitbutton" onClick="submitForm('Y');" class="button4"><span><?=GetMessage("SOA_TEMPL_BUTTON")?></span></button>
                </div>
            </div>
        </div>
        
        <div id="form_new">
            <div class="clear"></div>
        </div>
        <script>
        <!--
        var newform = document.createElement("FORM");
        newform.method = "POST";
        newform.action = "";
        newform.name = "<?=$FORM_NAME?>";
        newform.id = "ORDER_FORM_ID_NEW";
        var im = document.getElementById('order_form_id');
        document.getElementById("form_new").appendChild(newform);
        newform.appendChild(im);
        //-->
        </script>
        
        
        <!--div class="buttons">
            <input type="hidden" name="confirmorder" id="confirmorder" value="Y">
            <input type="button" name="submitbutton" onClick="submitForm('Y');" value="<?=GetMessage("SOA_TEMPL_BUTTON")?>">
            <button type="button" name="submitbutton" onClick="submitForm('Y');" class="button4"><span><?=GetMessage("SOA_TEMPL_BUTTON")?></span></button>
        </div-->
    <?}
}
?>
</div>
<!-- // Order Details -->
