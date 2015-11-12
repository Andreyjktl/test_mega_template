<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="filter">
    <div class="params_single">

                <form id="wp_form" action="<?=SITE_DIR?>wheels/podbor-diskov.php" method="get">
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
                        <button type="submit"  id="wp_submit" class="button1"><span><?echo GetMessage("DVS_SEARCH_W");?></span></button> <button type="reset" class="button1"><span><?echo GetMessage("DVS_RESET");?></span></button>
                    </fieldset>
                </form>

        <div class="clear:both;"></div>
		
    </div>
</div>

<br>
<br>
