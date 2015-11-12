<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="filter">
    <div class="top">
        <ul>
            <li<?if (CSite::InDir(SITE_DIR.'index.php')||(isset($_REQUEST['do_search'])&&in_array($_REQUEST['do_search'], array('tyres', 'tyres_auto')))) {?> class="selected"<?}?>><h4>Шины</h4></li>
            <li<?if (isset($_REQUEST['do_search'])&&in_array($_REQUEST['do_search'], array('wheels', 'wheels_auto'))) {?> class="selected"<?}?>><h4>Диски</h4></li>
        </ul>
    </div>

    <div class="bottom">
		<div class="brd">
        <? /*?<div class="banner">
            <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_TEMPLATE_PATH."/banners/banner-01.php"), false);?>
        </div> */?>

        <div class="params">
            <!-- TYRES -->
            <div class="fieldset">
                <div class="selector">
                    <label><input type="hidden" name="selector1" id="f1" value=""<?echo (!isset($_REQUEST['do_search'])||isset($_REQUEST['do_search'])&&$_REQUEST['do_search']!='tyres_auto'?' checked="checked"':'')?> /> <?=GetMessage("DVS_PARAMS");?></label>
                   
                   </div>

                <!-- TYRES.PARAMS -->
                <form id="tp_form" action="<?=SITE_DIR?>search.php" method="get" class="f1">
                    <fieldset>
           <table style="width:200px">
            <tr><td> Бренд</td></tr>
            <tr><td>  <select style="width:100%"  class="size3" name="brand"><option value="0"></option>
                                <?foreach($arResult['TYRES']['BRAND'] as $key => $value){
                                    if(isset($_REQUEST['brand'])&&$_REQUEST['brand']==$key)
                                        echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                    else
                                        echo '<option value="'.$key.'">'.$value.'</option>';
                                }?>
                            </select></td></tr>
                      
           <tr><td> Ширина</td></tr>
            <tr><td> <select style="width:100%" class="size1" id="tp_width" name="width"><option value="0"></option>
                            <?foreach($arResult['TYRES']['WIDTH'] as $key => $value){
                                if(isset($_REQUEST['width'])&&$_REQUEST['width']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                    </select>
                    </td></tr>
                <tr><td>Высота</td></tr>

                    <tr><td> <select style="width:100%"  class="size1" id="tp_height" name="height"><option value="0"></option>
                            <?foreach($arResult['TYRES']['HEIGHT'] as $key => $value){
                                if(isset($_REQUEST['height'])&&$_REQUEST['height']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select></td></tr>
            <tr><td> Диаметр  </td></tr>
            <tr><td>  <select style="width:100%"  class="size2" id="tp_diameter" name="diameter"><option value="0"></option>
                            <?foreach($arResult['TYRES']['DIAM'] as $key => $value){
                                if(isset($_REQUEST['diameter'])&&$_REQUEST['diameter']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select></td></tr>
            <tr><td> Сезон</td></tr>
            
                                  
                    <tr><td> 
                    <? if(isset($_REQUEST['season'])&&$_REQUEST['season']==leto)
                          echo '<input checked type="radio" name="season"  value="leto" ><span class="summer">Лето</span>';
                      else
                         echo '<input type="radio" name="season"  value="leto" ><span class="summer">Лето</span>';
                    ?>

                     <? if(isset($_REQUEST['season'])&&$_REQUEST['season']==winter)
                          echo '<input checked type="radio" name="season"  value="winter" ><span class="winter">Зима</span>';
                      else
                         echo '<input type="radio" name="season"  value="winter" ><span class="winter">Зима</span>';
                    ?>
                    
                     </td></tr>
            <tr><td>Шипованные</td></tr> 
                        <tr><td>  
                        <? if(isset($_REQUEST['pin'])&&$_REQUEST['pin']==156764)
                              echo '<input checked type="radio" name="pin"  value="156764" ><span class="pin">Да</span>';
                          else
                             echo '<input type="radio" name="pin"  value="156764" ><span class="pin">Да</span>';
                        ?>

                        <? if(isset($_REQUEST['pin'])&&$_REQUEST['pin']==156721)
                              echo '<input checked type="radio" name="pin"  value="156721" ><span class="pin">Да</span>';
                          else
                             echo '<input type="radio" name="pin"  value="156721" ><span class="pin">Нет</span>';
                        ?>

                        </td></tr>

              </table>
                        
                    </fieldset>
                    <fieldset>
                        <input type="hidden" name="do_search" value="tyres" />
                        <button type="submit" id="tp_submit" class="button1"><span><?=GetMessage("DVS_SEARCH");?></span></button> 
                        <button type="reset" class="button1"><span><?echo GetMessage("DVS_RESET");?></span></button>
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
                    
                        <?
                        echo '<select class="size3" id="ta_model" name="model"'.(!isset($arResult['AUTO']['curMODELS'])?' disabled':'').'><option value="0">'.GetMessage("DVS_MODEL").'</option>';
                        if(isset($arResult['AUTO']['curMODELS'])){
                            foreach($arResult['AUTO']['curMODELS'] as $key => $value){
                                 if(isset($_REQUEST['model'])&&$_REQUEST['model']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }
                        }
                        echo '</select>';
                        echo '<select class="size2" id="ta_year" name="year"'.(!isset($arResult['AUTO']['curYEARS'])?' disabled':'').'><option value="0">'.GetMessage("DVS_YEAR").'</option>';
                        if(isset($arResult['AUTO']['curYEARS'])){
                            foreach($arResult['AUTO']['curYEARS'] as $key => $value){
                                 if(isset($_REQUEST['year'])&&$_REQUEST['year']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }
                        }
                        echo '</select>';
                        echo '<select class="size4" id="ta_mod" name="mod"'.(!isset($arResult['AUTO']['curMOD'])?' disabled':'').'><option value="0">'.GetMessage("DVS_MOD").'</option>';
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
                    <label><input type="hidden" name="selector2" id="f3" value=""<?echo (!isset($_REQUEST['do_search'])||isset($_REQUEST['do_search'])&&$_REQUEST['do_search']!='wheels_auto'?' checked="checked"':'')?> /> <?echo GetMessage("DVS_PARAMS");?></label>
                    </div>

                <!-- WHEEL.PARAMS -->
                <form id="wp_form" action="<?=SITE_DIR?>search.php" method="get" class="f3">
                    <fieldset>
                    <table style="width:200px">

            <tr><td>Бренд</td></tr>
            <tr><td> <select style="width:100%" id="wp_brand" class="size2" name="brand">
                            <option value="0"></option>
                            <?foreach($arResult['WHEELS']['BRAND'] as $key => $value){
                                if(isset($_REQUEST['brand'])&&$_REQUEST['brand']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select></td></tr>
            <tr><td> Диаметр</td></tr>
            <tr><td> <select style="width:100%"  id="wp_diameter" class="size2" name="diameter">
                            <option value="0"></option>
                            <?foreach($arResult['WHEELS']['DIAM'] as $key => $value){
                                if(isset($_REQUEST['diameter'])&&$_REQUEST['diameter']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select></td></tr>
            <tr><td> Ширина</td></tr>
            <tr><td> <select style="width:100%"  id="wp_width" class="size2" name="width">
                            <option value="0"></option>
                            <?foreach($arResult['WHEELS']['WIDTH'] as $key => $value){
                                if(isset($_REQUEST['width'])&&$_REQUEST['width']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select></td></tr>
            <tr><td> PCD</td></tr>
            <tr><td> <select style="width:100%"  id="wp_apperture" class="size2" name="aperture">
                            <option value="0"></option>
                            <?foreach($arResult['WHEELS']['APERTURE'] as $key => $value){
                                if(isset($_REQUEST['aperture'])&&$_REQUEST['aperture']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select></td></tr>
            <tr><td> Диаметр ступицы</td></tr>
            <tr><td> <select style="width:100%"  id="wp_center" class="size2" name="center">
                            <option value="0"></option>
                            <?foreach($arResult['WHEELS']['CENTER'] as $key => $value){
                                if(isset($_REQUEST['center'])&&$_REQUEST['center']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select></td></tr>
            <tr><td>  Вылет</td></tr>
            <tr><td> <select  style="width:100%" id="wp_grab" class="size0" name="gab">
                            <option value="0"></option>
                            <?foreach($arResult['WHEELS']['GAB'] as $key => $value){
                                if(isset($_REQUEST['gab'])&&$_REQUEST['gab']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select></td></tr>
            </table>
                       
                    </fieldset>
                    <fieldset>
                        <input type="hidden" name="do_search" value="wheels" />
                        <button type="submit"  id="wp_submit" class="button1" disabled="disabled"><span><?echo GetMessage("DVS_SEARCH_W");?></span></button> <button type="reset" class="button1"><span><?echo GetMessage("DVS_RESET");?></span></button>
                    </fieldset>
                </form>

                <!-- WHEEL.AUTO -->
                <form id="wa_form" action="<?=SITE_DIR?>search.php" method="get" class="f4">
                    <fieldset>
                        <select class="size4" name="brand" id="wa_brand">
                            <option value="0"><?echo GetMessage("DVS_BRAND");?></option>
                            <?foreach($arResult['AUTO']['ITEMS'] as $key => $value){
                                if(isset($_REQUEST['brand'])&&$_REQUEST['brand']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>
                   
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
                        echo '<select class="size4" id="wa_mod" name="mod"'.(!isset($arResult['AUTO']['curMOD'])?' disabled':'').'><option value="0" selected>'.GetMessage("DVS_MOD").'</option>';
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
