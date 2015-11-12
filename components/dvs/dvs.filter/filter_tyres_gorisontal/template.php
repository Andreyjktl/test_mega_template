<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="filter">
<div class="top_filter" >
                <!-- TYRES.PARAMS -->
                <form id="tp_form" action="<?=SITE_DIR?>tyres/podbor-shin.php" method="get" class="f1">
                    <fieldset>
            <table style="float:left;" class="filter_table">
            <tr>
                <th>Ширина</th>
                <th></th>
                <th>Высота</th>
                <th></th>
                <th>Диаметр</th>
                <th>Бренд</th>
                <th>Сезон</th>
                <th>Шип.</th>
                
            </tr>
            <tr>
                <td><select class="size2" id="tp_width" name="width"><option value="0"><?=GetMessage("DVS_WIDTH");?></option>
                            <?foreach($arResult['TYRES']['WIDTH'] as $key => $value){
                                if(isset($_REQUEST['width'])&&$_REQUEST['width']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select></td>
                <td>/</td>
                <td><select class="size2" id="tp_height" name="height"><option value="0"><?=GetMessage("DVS_HEIGHT");?></option>
                            <?foreach($arResult['TYRES']['HEIGHT'] as $key => $value){
                                if(isset($_REQUEST['height'])&&$_REQUEST['height']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select></td>
                <td>R</td>
                <td><select class="size2" id="tp_diameter" name="diameter"><option value="0"><?=GetMessage("DVS_DIAM");?></option>
                            <?foreach($arResult['TYRES']['DIAM'] as $key => $value){
                                if(isset($_REQUEST['diameter'])&&$_REQUEST['diameter']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select></td>

                         <td><select class="size3" name="brand"><option value="0"><?=GetMessage('DVS_CHOICE');?></option>
                                <?foreach($arResult['TYRES']['BRAND'] as $key => $value){
                                    if(isset($_REQUEST['brand'])&&$_REQUEST['brand']==$key)
                                        echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                    else
                                        echo '<option value="'.$key.'">'.$value.'</option>';
                                }?>
                            </select></td>

                        <td><select class="size2" id="tp_season" name="season" id="season"><option value="0"><?=GetMessage("DVS_SEASON");?></option>
                            <?foreach($arResult['TYRES']['SEASON'] as $key => $value){
                                if(isset($_REQUEST['season'])&&$_REQUEST['season']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select></td>
                        <td><select class="size2" id="tp_pin" name="pin" id="pin"><option value="0"><?=GetMessage("DVS_PIN");?></option>
                            <?foreach($arResult['TYRES']['PIN'] as $key => $value){
                                if(isset($_REQUEST['pin'])&&$_REQUEST['pin']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select></td>

                        
            </tr>
            </table>                      

                        <input type="hidden" name="do_search" value="tyres" />
                       <div class="buttons"> 
                            <button type="submit" id="tp_submit" class="button1" disabled="disabled"><span><?=GetMessage("DVS_SEARCH");?></span></button> 
                        </div>
                    </fieldset>
                </form>
                </div>

                
                <div class="clear"></div>
		
</div>

