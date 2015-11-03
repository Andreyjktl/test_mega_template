<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="filter" style="width:250px;">
   
                <!-- WHEEL.PARAMS -->
                <form id="wp_form" action="<?=SITE_DIR?>search.php" method="get" class="f3">
                    <fieldset style="
    border: 0px;
"><table class="filter_table">
<tr>
	<td>Диаметр диска</td><td style="width:10px;"></td><td>Ширина диска</td></tr><tr>
	<td>      <select id="wp_diameter" style="width:100px;" name="diameter">
                            <option value="0">-</option>
                            <?foreach($arResult['WHEELS']['DIAM'] as $key => $value){
                                if(isset($_REQUEST['diameter'])&&$_REQUEST['diameter']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                             </select>
</td><td></td><td>
                               <select id="wp_width" style="width:100px;" name="width">
                            <option value="0">-</option>
                            <?foreach($arResult['WHEELS']['WIDTH'] as $key => $value){
                                if(isset($_REQUEST['width'])&&$_REQUEST['width']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>
	</td></tr>
<tr><td>Крепление</td>
	<td></td><td>Производитель</td></tr>
              <tr> <td>      
                      <select id="wp_apperture"  style="width:100px;" name="aperture">
                            <option value="0">-</option>
                            <?foreach($arResult['WHEELS']['APERTURE'] as $key => $value){
                                if(isset($_REQUEST['aperture'])&&$_REQUEST['aperture']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>
	</td><td></td><td>
                     <select id="wp_brand"  style="width:100px;" name="brand">
                            <option value="0">-</option>
                            <?foreach($arResult['WHEELS']['BRAND'] as $key => $value){
                                if(isset($_REQUEST['brand'])&&$_REQUEST['brand']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                            </select>
	</td></tr>
</table>
                   
                    
                        
                    </fieldset>
                    <fieldset style="
    border: 0px;
">
                        <input type="hidden" name="do_search" value="wheels" />
                        <button type="submit"  id="wp_submit" class="button1" disabled="disabled"><span><?echo GetMessage("DVS_SEARCH_W");?></span></button> <button type="reset" class="button1"><span><?echo GetMessage("DVS_RESET");?></span></button>
                    </fieldset>
                </form>

                
           
        <div class="clear"></div>
		
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
