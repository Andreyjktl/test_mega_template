<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<!-- Filter -->
<div class="filter">

    <div class="tab<?if(CSite::InDir(SITE_DIR.'index.php')||(isset($_REQUEST['do_search'])&&in_array($_REQUEST['do_search'], array('tyres', 'tyres_auto')))){echo ' selected expanded';}?>">
        <div class="top"><div class="pd"><h1><span><?=GetMessage('DVS_TYRES');?></span></h1></div></div>
        <div class="bottom">
            <div class="pd">
                <div class="type">
                    <label><input type="radio" name="type1" id="f1" value=""<?echo (!isset($_REQUEST['do_search'])||isset($_REQUEST['do_search'])&&$_REQUEST['do_search']!='tyres_auto'?' checked="checked"':'')?> /> <?=GetMessage('DVS_BY_PROD');?></label>
                    &nbsp; &nbsp;
                    <label><input type="radio" name="type1" id="f2" value=""<?echo (isset($_REQUEST['do_search'])&&$_REQUEST['do_search']=='tyres_auto'?' checked="checked"':'')?> /> <?=GetMessage('DVS_AUTO');?></label>
                </div>

                <form action="<?=SITE_DIR?>search.php" method="get">
                    <div class="form f1"<?echo (!isset($_REQUEST['do_search'])||isset($_REQUEST['do_search'])&&$_REQUEST['do_search']!='tyres_auto'?' style="display:block"':' style="display:none"')?>>
                        <fieldset>
                            <div class="label lb1"><label><?=GetMessage('DVS_PROD');?></label></div>
                            <div class="field fl1"><select name="brand"><option value="0"><?=GetMessage('DVS_CHOICE');?></option>
                                <?foreach($arResult['TYRES']['BRAND'] as $key => $value){
                                    if(isset($_REQUEST['brand'])&&$_REQUEST['brand']==$key)
                                        echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                    else
                                        echo '<option value="'.$key.'">'.$value.'</option>';
                                }?>
                            </select></div>
                            <div class="label lb2"><label><?=GetMessage('DVS_SIZE');?></label></div>
                            <div class="field fl2">
                            <select class="size" name="width"><option value="0"><?=GetMessage('DVS_CHOICE');?></option>
                                <?foreach($arResult['TYRES']['WIDTH'] as $key => $value){
                                    if(isset($_REQUEST['width'])&&$_REQUEST['width']==$key)
                                        echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                    else
                                        echo '<option value="'.$key.'">'.$value.'</option>';
                                }?>
                            </select><span class="sep">/</span><select class="size" name="height"><option value="0"><?=GetMessage('DVS_CHOICE');?></option>
                                <?foreach($arResult['TYRES']['HEIGHT'] as $key => $value){
                                    if(isset($_REQUEST['height'])&&$_REQUEST['height']==$key)
                                        echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                    else
                                        echo '<option value="'.$key.'">'.$value.'</option>';
                                }?>
                            </select>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="label lb1"><label><?=GetMessage('DVS_T_DIAM');?></label></div>
                            <div class="field fl1">
                                <select name="diameter">
                                    <option value="0"><?=GetMessage('DVS_CHOICE');?></option>
                                    <?foreach($arResult['TYRES']['DIAM'] as $key => $value){
                                        if(isset($_REQUEST['diameter'])&&$_REQUEST['diameter']==$key)
                                            echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                        else
                                            echo '<option value="'.$key.'">'.$value.'</option>';
                                    }?>
                                </select>
                            </div>
                            <div class="label lb2"><label><?=GetMessage('DVS_SEASON');?></label></div>
                            <div class="field fl2">
                                <select name="season" id="season">
                                    <option value="0"><?=GetMessage('DVS_CHOICE');?></option>
                                    <?foreach($arResult['TYRES']['SEASON'] as $key => $value){
                                        if(isset($_REQUEST['season'])&&$_REQUEST['season']==$key)
                                            echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                        else
                                            echo '<option value="'.$key.'">'.$value.'</option>';
                                    }?>
                                </select>
                            </div>
                        </fieldset>
                        <?$st_pin = (!isset($_REQUEST['season'])||isset($_REQUEST['season'])&&$_REQUEST['season']!='zima')?' disabled"':'';?>
                        <fieldset id="pin-fieldset"<?echo strlen($st_pin)>0?' style="display:none;"':'';?>>
                            <div class="label lb1">&nbsp;</div>
                            <div class="field fl1">&nbsp;</div>

                            <div class="label lb2"><label><?=GetMessage('DVS_PIN');?></label></div>
                            <div class="field fl2">
                                <select name="pin" id="pin"<?echo $st_pin;?>>
                                    <option value="0"><?=GetMessage('DVS_CHOICE');?></option>
                                     <?foreach($arResult['TYRES']['PIN'] as $key => $value){
                                        if(isset($_REQUEST['pin'])&&$_REQUEST['pin']==$key)
                                            echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                        else
                                            echo '<option value="'.$key.'">'.$value.'</option>';
                                    }?>
                                </select>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="buttons">
                                <input type="hidden" name="do_search" value="tyres" />
                                <button type="reset" class="button4"><span><?=GetMessage('DVS_RESET');?></span></button>&nbsp;<button type="submit" class="button4"><span><?=GetMessage('DVS_SEARCH');?></span></button>
                            </div>
                        </fieldset>
                        <div class="clear"></div>
                    </div>
                </form>

                <form action="<?=SITE_DIR?>search.php" method="get">
                    <div class="form f2"<?echo (isset($_REQUEST['do_search'])&&$_REQUEST['do_search']=='tyres_auto'?' style="display:block"':' style="display:none"')?>>
                        <fieldset>
                            <div class="label lb1"><label><?=GetMessage('DVS_BRAND');?></label></div>
                            <div class="field fl1">
                                <select name="brand" id="ta_brand">
                                    <option value="0"><?=GetMessage('DVS_CHOICE');?></option>
                                    <?foreach($arResult['AUTO']['ITEMS'] as $key => $value){
                                        if(isset($_REQUEST['brand'])&&$_REQUEST['brand']==$key)
                                            echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                        else
                                            echo '<option value="'.$key.'">'.$value.'</option>';
                                    }?>
                                </select>
                            </div>

                            <div class="label lb2"><label><?=GetMessage('DVS_MODEL');?></label></div>
                            <div class="field fl2">
                                <?echo '<select class="size4" id="ta_model" name="model"'.(!isset($arResult['AUTO']['curMODELS'])?' disabled':'').'><option value="0">'.GetMessage('DVS_CHOICE').'</option>';
                                if(isset($arResult['AUTO']['curMODELS'])){
                                    foreach($arResult['AUTO']['curMODELS'] as $key => $value){
                                         if(isset($_REQUEST['model'])&&$_REQUEST['model']==$key)
                                            echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                        else
                                            echo '<option value="'.$key.'">'.$value.'</option>';
                                    }
                                }
                                echo '</select>';?>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="label lb1"><label><?=GetMessage('DVS_YEAR');?></label></div>
                            <div class="field fl1">
                                <?echo '<select class="size1" id="ta_year" name="year"'.(!isset($arResult['AUTO']['curYEARS'])?' disabled':'').'><option value="0">'.GetMessage('DVS_CHOICE').'</option>';
                                if(isset($arResult['AUTO']['curYEARS'])){
                                    foreach($arResult['AUTO']['curYEARS'] as $key => $value){
                                         if(isset($_REQUEST['year'])&&$_REQUEST['year']==$key)
                                            echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                        else
                                            echo '<option value="'.$key.'">'.$value.'</option>';
                                    }
                                }
                                echo '</select>';?>
                            </div>
                            <div class="label lb2"><label><?=GetMessage('DVS_MOD');?></label></div>
                            <div class="field fl2">
                                <?echo '<select class="size6" id="ta_mod" name="mod"'.(!isset($arResult['AUTO']['curMOD'])?' disabled':'').'><option value="0">'.GetMessage('DVS_MOD').'</option>';
                                if(isset($arResult['AUTO']['curMOD'])){
                                    foreach($arResult['AUTO']['curMOD'] as $key => $value){
                                         if(isset($_REQUEST['mod'])&&$_REQUEST['mod']==$key)
                                            echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                        else
                                            echo '<option value="'.$key.'">'.$value.'</option>';
                                    }
                                }
                                echo '</select>';?>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="buttons">
                                <input type="hidden" name="do_search" value="tyres_auto" />
                                <button type="reset" class="button4"><span><?=GetMessage('DVS_RESET');?></span></button>&nbsp;<button type="submit" class="button4"><span><?=GetMessage('DVS_SEARCH');?></span></button>
                            </div>
                        </fieldset>
                        <div class="clear"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="tab<?if (isset($_REQUEST['do_search'])&&in_array($_REQUEST['do_search'], array('wheels', 'wheels_auto'))) {echo ' selected expanded';}?>">
        <div class="top"><div class="pd"><h1><span><?=GetMessage('DVS_WHEELS');?></span></h1></div></div>
        <div class="bottom">
            <div class="pd">
                <div class="type">
                    <label><input type="radio" name="type2" id="f3" value=""<?echo (!isset($_REQUEST['do_search'])||isset($_REQUEST['do_search'])&&$_REQUEST['do_search']!='wheels_auto'?' checked="checked"':'')?> /> <?=GetMessage('DVS_PARAMS');?></label>
                    &nbsp; &nbsp;
                    <label><input type="radio" name="type2" id="f4" value=""<?echo (isset($_REQUEST['do_search'])&&$_REQUEST['do_search']=='wheels_auto'?' checked="checked"':'')?> /> <?=GetMessage('DVS_AUTO');?></label>
                </div>
                <!-- по параметрам -->
                <form action="<?=SITE_DIR?>search.php" method="get">
                    <div class="form f3"<?echo (!isset($_REQUEST['do_search'])||isset($_REQUEST['do_search'])&&$_REQUEST['do_search']!='wheels_auto'?' style="display:block"':' style="display:none"')?>>
                        <fieldset>
                            <div class="label lb1"><label><?=GetMessage('DVS_PROD');?></label></div>
                            <div class="field fl1">
                                <select name="brand">
                                    <option value="0"><?=GetMessage('DVS_CHOICE');?></option>
                                    <?foreach($arResult['WHEELS']['BRAND'] as $key => $value){
                                        if(isset($_REQUEST['brand'])&&$_REQUEST['brand']==$key)
                                            echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                        else
                                            echo '<option value="'.$key.'">'.$value.'</option>';
                                    }?>
                                </select>
                            </div>
                            <div class="label lb2"><label><?=GetMessage('DVS_W_WIDTH');?></label></div>
                            <div class="field fl2">
                                <select name="width">
                                    <option value="0"><?=GetMessage('DVS_CHOICE');?></option>
                                    <?foreach($arResult['WHEELS']['WIDTH'] as $key => $value){
                                        if(isset($_REQUEST['width'])&&$_REQUEST['width']==$key)
                                            echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                        else
                                            echo '<option value="'.$key.'">'.$value.'</option>';
                                    }?>
                                </select>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="label lb1"><label><?=GetMessage('DVS_T_DIAM');?></label></div>
                            <div class="field fl1">
                                <select name="diameter">
                                    <option value="0"><?=GetMessage('DVS_CHOICE');?></option>
                                    <?foreach($arResult['WHEELS']['DIAM'] as $key => $value){
                                        if(isset($_REQUEST['diameter'])&&$_REQUEST['diameter']==$key)
                                            echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                        else
                                            echo '<option value="'.$key.'">'.$value.'</option>';
                                    }?>
                                </select>
                            </div>
                            <div class="label lb2"><label><?=GetMessage('DVS_FIX');?></label></div>
                            <div class="field fl2">
                                <select name="count">
                                    <option value="0"><?=GetMessage('DVS_CHOICE');?></option>
                                    <?foreach($arResult['WHEELS']['COUNT'] as $key => $value){
                                        if(isset($_REQUEST['count'])&&$_REQUEST['count']==$key)
                                            echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                        else
                                            echo '<option value="'.$key.'">'.$value.'</option>';
                                    }?>
                                </select>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="label lb1"><label><?=GetMessage('DVS_ET');?></label></div>
                            <div class="field fl1">
                                <select name="gab">
                                    <option value="0"><?=GetMessage('DVS_CHOICE');?></option>
                                    <?foreach($arResult['WHEELS']['GAB'] as $key => $value){
                                        if(isset($_REQUEST['gab'])&&$_REQUEST['gab']==$key)
                                            echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                        else
                                            echo '<option value="'.$key.'">'.$value.'</option>';
                                    }?>
                                </select>
                            </div>
                            <div class="buttons">
                                <input type="hidden" name="do_search" value="wheels" />
                                <button type="reset" class="button4"><span><?=GetMessage('DVS_RESET');?></span></button>&nbsp;<button type="submit" class="button4"><span><?=GetMessage('DVS_SEARCH');?></span></button>
                            </div>
                        </fieldset>
                        <div class="clear"></div>
                    </div>
                </form>

                <form action="<?=SITE_DIR?>search.php" method="get">
                    <div class="form f4"<?echo (isset($_REQUEST['do_search'])&&$_REQUEST['do_search']=='wheels_auto'?' style="display:block"':' style="display:none"')?>>
                        <fieldset>
                            <div class="label lb1"><label><?=GetMessage('DVS_BRAND');?></label></div>
                            <div class="field fl1">
                                <select name="brand" id="wa_brand">
                                    <option value="0"><?=GetMessage('DVS_CHOICE');?></option>
                                    <?foreach($arResult['AUTO']['ITEMS'] as $key => $value){
                                        if(isset($_REQUEST['brand'])&&$_REQUEST['brand']==$key)
                                            echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                        else
                                            echo '<option value="'.$key.'">'.$value.'</option>';
                                    }?>
                                </select>
                            </div>

                            <div class="label lb2"><label><?=GetMessage('DVS_MODEL');?></label></div>
                            <div class="field fl2">
                                <?echo '<select id="wa_model" name="model"'.(!isset($arResult['AUTO']['curMODELS'])?' disabled':'').'><option value="0" selected>'.GetMessage('DVS_CHOICE').'</option>';
                                if(isset($arResult['AUTO']['curMODELS'])){
                                    foreach($arResult['AUTO']['curMODELS'] as $key => $value){
                                         if(isset($_REQUEST['model'])&&$_REQUEST['model']==$key)
                                            echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                        else
                                            echo '<option value="'.$key.'">'.$value.'</option>';
                                    }
                                }
                                echo '</select>';?>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="label lb1"><label><?=GetMessage('DVS_YEAR');?></label></div>
                            <div class="field fl1">
                                <?echo '<select id="wa_year" name="year"'.(!isset($arResult['AUTO']['curYEARS'])?' disabled':'').'><option value="0" selected>'.GetMessage('DVS_CHOICE').'</option>';
                                if(isset($arResult['AUTO']['curYEARS'])){
                                    foreach($arResult['AUTO']['curYEARS'] as $key => $value){
                                         if(isset($_REQUEST['year'])&&$_REQUEST['year']==$key)
                                            echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                        else
                                            echo '<option value="'.$key.'">'.$value.'</option>';
                                    }
                                }
                                echo '</select>';?>
                            </div>
                            <div class="label lb2"><label><?=GetMessage('DVS_MOD');?></label></div>
                            <div class="field fl2">
                                <?echo '<select id="wa_mod" name="mod"'.(!isset($arResult['AUTO']['curMOD'])?' disabled':'').'><option value="0" selected>'.GetMessage('DVS_CHOICE').'</option>';
                                if(isset($arResult['AUTO']['curMOD'])){
                                    foreach($arResult['AUTO']['curMOD'] as $key => $value){
                                         if(isset($_REQUEST['mod'])&&$_REQUEST['mod']==$key)
                                            echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                        else
                                            echo '<option value="'.$key.'">'.$value.'</option>';
                                    }
                                }
                                echo '</select>';?>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="buttons">
                                <input type="hidden" name="do_search" value="wheels_auto" />
                                <button type="reset" class="button4"><span><?=GetMessage('DVS_RESET');?></span></button>&nbsp;<button type="submit" class="button4"><span><?=GetMessage('DVS_SEARCH');?></span></button>
                            </div>
                        </fieldset>
                        <div class="clear"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <span class="crn tl"></span><span class="crn tr"></span>
    <span class="crn bl"></span><span class="crn br"></span>
</div>
<!-- // Filter -->
<script type="text/javascript">
jQuery(document).ready(function(){
    ajaxurl = '<?=SITE_DIR?>ajax/auto.php';

    jQuery('#ta_brand, #wa_brand').change(function () {change_b(ajaxurl, this)});
    jQuery('#ta_model, #wa_model').change(function () {change_m(ajaxurl, this)});
    jQuery('#ta_year, #wa_year').change(function () {change_y(ajaxurl, this)});
});
</script>
