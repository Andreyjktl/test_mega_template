<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="filter">
    <div class="top">
        <ul>
            <li<?if (CSite::InDir(SITE_DIR.'index.php')||(isset($_REQUEST['do_search'])&&in_array($_REQUEST['do_search'], array('tyres', 'tyres_auto')))) {?> class="selected"<?}?>><h4><?=GetMessage("DVS_TYRES");?></h4></li>
            <li<?if (isset($_REQUEST['do_search'])&&in_array($_REQUEST['do_search'], array('wheels', 'wheels_auto'))) {?> class="selected"<?}?>><h4><?=GetMessage("DVS_WHEELS");?></h4></li>
        </ul>
    </div>

    <div class="bottom">
		<div class="brd">
        <div class="banner">
            <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_TEMPLATE_PATH."/banners/banner-01.php"), false);?>
        </div>

        <div class="params">
            <!-- TYRES -->
            <div class="fieldset">
                <div class="selector">
                    <label><input type="radio" name="selector1" id="f1" value=""<?echo (!isset($_REQUEST['do_search'])||isset($_REQUEST['do_search'])&&$_REQUEST['do_search']!='tyres_auto'?' checked="checked"':'')?> /> <?=GetMessage("DVS_PARAMS");?></label>
                    &nbsp; &nbsp;
                    <label><input type="radio" name="selector1" id="f2" value=""<?echo (isset($_REQUEST['do_search'])&&$_REQUEST['do_search']=='tyres_auto'?' checked="checked"':'')?> /> <?=GetMessage("DVS_AUTO");?></label>
                </div>

                <!-- TYRES.PARAMS -->
                <form id="tp_form" action="<?=SITE_DIR?>search.php" method="get" class="f1">
                    <fieldset>
                        <select class="size5" id="tp_brand" name="brand"><option value="0"><?=GetMessage("DVS_PROPD");?></option>
                            <?foreach($arResult['TYRES']['BRAND'] as $key => $value){
                                if(isset($_REQUEST['brand'])&&$_REQUEST['brand']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>

                        <select class="size2" id="tp_width" name="width"><option value="0"><?=GetMessage("DVS_WIDTH");?></option>
                            <?foreach($arResult['TYRES']['WIDTH'] as $key => $value){
                                if(isset($_REQUEST['width'])&&$_REQUEST['width']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>

                        <select class="size2" id="tp_height" name="height"><option value="0"><?=GetMessage("DVS_HEIGHT");?></option>
                            <?foreach($arResult['TYRES']['HEIGHT'] as $key => $value){
                                if(isset($_REQUEST['height'])&&$_REQUEST['height']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>

                        <select class="size2" id="tp_diameter" name="diameter"><option value="0"><?=GetMessage("DVS_DIAM");?></option>
                            <?foreach($arResult['TYRES']['DIAM'] as $key => $value){
                                if(isset($_REQUEST['diameter'])&&$_REQUEST['diameter']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>
                    </fieldset>
                    <fieldset>
                        <select class="size5" id="tp_season" name="season" id="season"><option value="0"><?=GetMessage("DVS_SEASON");?></option>
                            <?foreach($arResult['TYRES']['SEASON'] as $key => $value){
                                if(isset($_REQUEST['season'])&&$_REQUEST['season']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>
                        <select class="size2" id="tp_pin" name="pin" id="pin" <?if(!isset($_REQUEST['season'])||isset($_REQUEST['season'])&&$_REQUEST['season']!='zima') echo 'style="display:none;" disabled';?>><option value="0"><?=GetMessage("DVS_PIN");?></option>
                            <?foreach($arResult['TYRES']['PIN'] as $key => $value){
                                if(isset($_REQUEST['pin'])&&$_REQUEST['pin']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>
                    </fieldset>
                    <fieldset>
                        <input type="hidden" name="do_search" value="tyres" />
                        <button type="submit" id="tp_submit" class="button1" disabled="disabled"><span><?=GetMessage("DVS_SEARCH");?></span></button> <button type="reset" class="button1"><span><?echo GetMessage("DVS_RESET");?></span></button>
                    </fieldset>
                </form>

                <!-- TYRES.AUTO -->
                <form id="ta_form" action="<?=SITE_DIR?>search.php" method="get" class="f2">
                    <fieldset>
                        <select class="size7" name="brand" id="ta_brand">
                            <option value="0"><?=GetMessage("DVS_BRAND");?></option>
                            <?foreach($arResult['AUTO']['ITEMS'] as $key => $value){
                                if(isset($_REQUEST['brand'])&&$_REQUEST['brand']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>
                    </fieldset>
                    <fieldset>
                        <?
                        echo '<select class="size4" id="ta_model" name="model"'.(!isset($arResult['AUTO']['curMODELS'])?' disabled':'').'><option value="0">'.GetMessage("DVS_MODEL").'</option>';
                        if(isset($arResult['AUTO']['curMODELS'])){
                            foreach($arResult['AUTO']['curMODELS'] as $key => $value){
                                 if(isset($_REQUEST['model'])&&$_REQUEST['model']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }
                        }
                        echo '</select>';
                        echo '<select class="size1" id="ta_year" name="year"'.(!isset($arResult['AUTO']['curYEARS'])?' disabled':'').'><option value="0">'.GetMessage("DVS_YEAR").'</option>';
                        if(isset($arResult['AUTO']['curYEARS'])){
                            foreach($arResult['AUTO']['curYEARS'] as $key => $value){
                                 if(isset($_REQUEST['year'])&&$_REQUEST['year']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }
                        }
                        echo '</select>';
                        echo '<select class="size6" id="ta_mod" name="mod"'.(!isset($arResult['AUTO']['curMOD'])?' disabled':'').'><option value="0">'.GetMessage("DVS_MOD").'</option>';
                        if(isset($arResult['AUTO']['curMOD'])){
                            foreach($arResult['AUTO']['curMOD'] as $key => $value){
                                 if(isset($_REQUEST['mod'])&&$_REQUEST['mod']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }
                        }
                        echo '</select>';
                        ?>
                    </fieldset>
                    <fieldset>
                        <input type="hidden" name="do_search" value="tyres_auto" />
                        <button id="ta_submit" type="submit" class="button1" disabled="disabled"><span><?echo GetMessage("DVS_SEARCH");?></span></button> <button type="reset" class="button1"><span><?echo GetMessage("DVS_RESET");?></span></button>
                    </fieldset>
                </form>
            </div>

            <!-- WHEEL -->
            <div class="fieldset">
                <div class="selector">
                    <label><input type="radio" name="selector2" id="f3" value=""<?echo (!isset($_REQUEST['do_search'])||isset($_REQUEST['do_search'])&&$_REQUEST['do_search']!='wheels_auto'?' checked="checked"':'')?> /> <?echo GetMessage("DVS_PARAMS");?></label>
                    &nbsp; &nbsp;
                    <label><input type="radio" name="selector2" id="f4" value=""<?echo (isset($_REQUEST['do_search'])&&$_REQUEST['do_search']=='wheels_auto'?' checked="checked"':'')?> /> <?echo GetMessage("DVS_AUTO");?></label>
                </div>

                <!-- WHEEL.PARAMS -->
                <form id="wp_form" action="<?=SITE_DIR?>search.php" method="get" class="f3">
                    <fieldset>
                        <select id="wp_brand" class="size5" name="brand">
                            <option value="0"><?echo GetMessage("DVS_PROPD");?></option>
                            <?foreach($arResult['WHEELS']['BRAND'] as $key => $value){
                                if(isset($_REQUEST['brand'])&&$_REQUEST['brand']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>
                        <select id="wp_apperture" class="size3" name="aperture">
                            <option value="0"><?echo GetMessage("DVS_PCD");?></option>
                            <?foreach($arResult['WHEELS']['APERTURE'] as $key => $value){
                                if(isset($_REQUEST['aperture'])&&$_REQUEST['aperture']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>
                        <select id="wp_center" class="size3" name="center">
                            <option value="0"><?echo GetMessage("DVS_DIAM_C");?></option>
                            <?foreach($arResult['WHEELS']['CENTER'] as $key => $value){
                                if(isset($_REQUEST['center'])&&$_REQUEST['center']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>
                    </fieldset>
                    <fieldset>
                        <select id="wp_width" class="size3" name="width">
                            <option value="0"><?echo GetMessage("DVS_WIDTH_T");?></option>
                            <?foreach($arResult['WHEELS']['WIDTH'] as $key => $value){
                                if(isset($_REQUEST['width'])&&$_REQUEST['width']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>
                        <select id="wp_diameter" class="size3" name="diameter">
                            <option value="0"><?echo GetMessage("DVS_POS_DIAM");?></option>
                            <?foreach($arResult['WHEELS']['DIAM'] as $key => $value){
                                if(isset($_REQUEST['diameter'])&&$_REQUEST['diameter']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>
                        <select id="wp_grab" class="size3" name="gab">
                            <option value="0"><?echo GetMessage("DVS_ET");?></option>
                            <?foreach($arResult['WHEELS']['GAB'] as $key => $value){
                                if(isset($_REQUEST['gab'])&&$_REQUEST['gab']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>
                        <select id="wp_count" class="size3" name="count">
                            <option value="0"><?echo GetMessage("DVS_COUNT");?></option>
                            <?foreach($arResult['WHEELS']['COUNT'] as $key => $value){
                                if(isset($_REQUEST['count'])&&$_REQUEST['count']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>
                    </fieldset>
                    <fieldset>
                        <input type="hidden" name="do_search" value="wheels" />
                        <button type="submit"  id="wp_submit" class="button1" disabled="disabled"><span><?echo GetMessage("DVS_SEARCH_W");?></span></button> <button type="reset" class="button1"><span><?echo GetMessage("DVS_RESET");?></span></button>
                    </fieldset>
                </form>

                <!-- WHEEL.AUTO -->
                <form id="wa_form" action="<?=SITE_DIR?>search.php" method="get" class="f4">
                    <fieldset>
                        <select class="size7" name="brand" id="wa_brand">
                            <option value="0"><?echo GetMessage("DVS_BRAND");?></option>
                            <?foreach($arResult['AUTO']['ITEMS'] as $key => $value){
                                if(isset($_REQUEST['brand'])&&$_REQUEST['brand']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>
                    </fieldset>
                    <fieldset>
                        <?
                        echo '<select class="size4" id="wa_model" name="model"'.(!isset($arResult['AUTO']['curMODELS'])?' disabled':'').'><option value="0" selected>'.GetMessage("DVS_MODEL").'</option>';
                        if(isset($arResult['AUTO']['curMODELS'])){
                            foreach($arResult['AUTO']['curMODELS'] as $key => $value){
                                 if(isset($_REQUEST['model'])&&$_REQUEST['model']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }
                        }
                        echo '</select>';
                        echo '<select class="size1" id="wa_year" name="year"'.(!isset($arResult['AUTO']['curYEARS'])?' disabled':'').'><option value="0" selected>'.GetMessage("DVS_YEAR").'</option>';
                        if(isset($arResult['AUTO']['curYEARS'])){
                            foreach($arResult['AUTO']['curYEARS'] as $key => $value){
                                 if(isset($_REQUEST['year'])&&$_REQUEST['year']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }
                        }
                        echo '</select>';
                        echo '<select class="size6" id="wa_mod" name="mod"'.(!isset($arResult['AUTO']['curMOD'])?' disabled':'').'><option value="0" selected>'.GetMessage("DVS_MOD").'</option>';
                        if(isset($arResult['AUTO']['curMOD'])){
                            foreach($arResult['AUTO']['curMOD'] as $key => $value){
                                 if(isset($_REQUEST['mod'])&&$_REQUEST['mod']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }
                        }
                        echo '</select>';
                        ?>
                    </fieldset>
                    <fieldset>
                        <input type="hidden" name="do_search" value="wheels_auto" />
                        <button id="wa_submit" type="submit" class="button1" disabled="disabled"><span><?echo GetMessage("DVS_SEARCH_W");?></span></button> <button type="reset" class="button1"><span><?echo GetMessage("DVS_RESET");?></span></button>
                    </fieldset>
                </form>
            </div>

        </div>
        <div class="clear"></div>
		</div>
    </div>
</div>

<script type="text/javascript">
jQuery(document).ready(function(){
    ajaxurl = '<?=SITE_DIR?>ajax/auto.php';

    jQuery('#ta_brand, #wa_brand').change(function () {change_b(ajaxurl, this)});
    jQuery('#ta_model, #wa_model').change(function () {change_m(ajaxurl, this)});
    jQuery('#ta_year, #wa_year').change(function () {change_y(ajaxurl, this)});
    jQuery('#ta_mod, #wa_mod').change(function () {change_mod(ajaxurl, this)});
});
</script>
