<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="filter">


                   <!-- TYRES.PARAMS -->
         <form id="tp_form" action="<?=SITE_DIR?>tyres/podbor-shin.php" method="get">
                    <fieldset style="border: 0px;">
            <table class="filter_table">
                <tr>
                    <th>Ширина</th>
                    <th></th>
                    <th>Высота</th>
                    <th></th>
                    <th>Диаметр</th>
                </tr>

                <tr>
                    <td>
                        <select class="size0" id="tp_width" name="width"><option value="0">-</option>
                                <?foreach($arResult['TYRES']['WIDTH'] as $key => $value){
                                    if(isset($_REQUEST['width'])&&$_REQUEST['width']==$key)
                                        echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                    else
                                        echo '<option value="'.$key.'">'.$value.'</option>';
                                }?>
                            </select>
                    </td>
                    <td>
                        <span>/</span>
                    </td>
                    <td>
                        <select class="size0" id="tp_height" name="height"><option value="0">-</option>
                                <?foreach($arResult['TYRES']['HEIGHT'] as $key => $value){
                                    if(isset($_REQUEST['height'])&&$_REQUEST['height']==$key)
                                        echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                    else
                                        echo '<option value="'.$key.'">'.$value.'</option>';
                                }?>
                         </select>
                    </td>
                    <td>
                        <span>R</span>
                    </td>
                    <td><select class="size0" id="tp_diameter" name="diameter"><option value="0">-</option>
                                <?foreach($arResult['TYRES']['DIAM'] as $key => $value){
                                    if(isset($_REQUEST['diameter'])&&$_REQUEST['diameter']==$key)
                                        echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                    else
                                        echo '<option value="'.$key.'">'.$value.'</option>';
                                }?>
                            </select>
                    </td>
                </tr>

                <tr>
                    <td>Сезон</td><td></td><td>Шип.</td>
                </tr>
                <tr>
                    <td><select class="size2" id="tp_season" name="season" id="season"><option value="0">-</option>
                            <?foreach($arResult['TYRES']['SEASON'] as $key => $value){
                                if(isset($_REQUEST['season'])&&$_REQUEST['season']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>
                    </td>

                    <td></td>

                    <td>
                            <select class="size2" id="tp_pin" name="pin" id="pin" ><option value="0"></option>
                            <?foreach($arResult['TYRES']['PIN'] as $key => $value){
                                if(isset($_REQUEST['pin'])&&$_REQUEST['pin']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select>
                    </td>
                </tr>

            </table>                      

                    </fieldset>

                    <fieldset style="border: 0px;">
                        <input type="hidden" name="do_search" value="tyres" />
                        <button type="submit" id="tp_submit" class="button1"><span><?=GetMessage("DVS_SEARCH");?></span></button> <button type="reset" class="button1"><span><?echo GetMessage("DVS_RESET");?></span></button>
                    </fieldset>
                </form>

               
        <div class="clear"></div>
		
</div>
