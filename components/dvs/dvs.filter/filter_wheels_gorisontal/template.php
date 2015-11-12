<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="filter">
   <div class="top_filter">
           <!-- WHEEL.PARAMS -->
                <form id="wp_form" action="<?=SITE_DIR?>search.php" method="get" class="f3">
                    <fieldset>
                    <table style="text-align:center; float:left;" class="filter_table">
                    <tr>
                    
                    <td>Диаметр</td>
                    <td>Ширина</td>
                    <td>PCD</td>
                    <td>Вылет</td>
                    <td>Бренд</td>
                    </tr>
                        <tr>
                        <td>
                         <select id="wp_diameter" class="size2" name="diameter">
                            <option value="0"><?echo GetMessage("DVS_POS_DIAM");?></option>
                            <?foreach($arResult['WHEELS']['DIAM'] as $key => $value){
                                if(isset($_REQUEST['diameter'])&&$_REQUEST['diameter']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>
                        </td><td>
                        <select id="wp_width" class="size2" name="width">
                            <option value="0"><?echo GetMessage("DVS_WIDTH_T");?></option>
                            <?foreach($arResult['WHEELS']['WIDTH'] as $key => $value){
                                if(isset($_REQUEST['width'])&&$_REQUEST['width']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>
                       </td><td>
                        <select id="wp_apperture" class="size2" name="aperture">
                            <option value="0"><?echo GetMessage("DVS_PCD");?></option>
                            <?foreach($arResult['WHEELS']['APERTURE'] as $key => $value){
                                if(isset($_REQUEST['aperture'])&&$_REQUEST['aperture']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>
                        </td>
                        <td>
                        <select id="wp_grab" class="size0" name="gab">
                            <option value="0"><?echo GetMessage("DVS_ET");?></option>
                            <?foreach($arResult['WHEELS']['GAB'] as $key => $value){
                                if(isset($_REQUEST['gab'])&&$_REQUEST['gab']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>
                       </td>
                       <td><select id="wp_brand" class="size2" name="brand">
                            <option value="0"><?echo GetMessage("DVS_PROPD");?></option>
                            <?foreach($arResult['WHEELS']['BRAND'] as $key => $value){
                                if(isset($_REQUEST['brand'])&&$_REQUEST['brand']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>
                        </td>
                       </tr>
                       </table>
                    
                        <input type="hidden" name="do_search" value="wheels" />
                        <div class="buttons">
                        <button type="submit"  id="wp_submit" class="button1" disabled="disabled"><span><?echo GetMessage("DVS_SEARCH_W");?></span></button>
                        </div>
                    </fieldset>
                </form>

            </div>
        <div class="clear"></div>
		

</div>

