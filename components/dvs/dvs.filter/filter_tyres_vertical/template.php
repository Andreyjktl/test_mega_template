<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?CIBlockElement::GetList(false, array("IBLOCK_ID"=>$iIBLOCK_ID, ">=PRICE_CODE"=>"100")); ?>
<div class="filter">
    <div class="params_single">

		     
                <form style="display:block:" id="tp_form" action="<?=SITE_DIR?>tyres/podbor-shin.php" method="get">
                    <fieldset>
           <table style="width:200px">
            <tr><td><?=GetMessage("DVS_BREND");?> </td></tr>
            <tr><td>  <select style="width:100%"  class="size3" name="brand"><option value="0"></option>
                                <?foreach($arResult['TYRES']['BRAND'] as $key => $value){
                                    if(isset($_REQUEST['brand'])&&$_REQUEST['brand']==$key)
                                        echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                    else
                                        echo '<option value="'.$key.'">'.$value.'</option>';
                                }?>
                            </select></td></tr>

            <tr><td><?=GetMessage("DVS_DIAM");?> </td></tr>
            <tr><td>  <select style="width:100%"  class="size2" id="tp_diameter" name="diameter"><option value="0"></option>
                            <?foreach($arResult['TYRES']['DIAM'] as $key => $value){
                                if(isset($_REQUEST['diameter'])&&$_REQUEST['diameter']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select></td></tr>
                      
           <tr><td> <?=GetMessage("DVS_WIDTH");?></td></tr>
            <tr><td> <select style="width:100%" class="size1" id="tp_width" name="width"><option value="0"></option>
                            <?foreach($arResult['TYRES']['WIDTH'] as $key => $value){
                                if(isset($_REQUEST['width'])&&$_REQUEST['width']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                    </select>
                    </td></tr>
                <tr><td><?=GetMessage("DVS_HEIGHT");?></td></tr>

                    <tr><td> <select style="width:100%"  class="size1" id="tp_height" name="height"><option value="0"></option>
                            <?foreach($arResult['TYRES']['HEIGHT'] as $key => $value){
                                if(isset($_REQUEST['height'])&&$_REQUEST['height']==$key)
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                else
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                            }?>
                        </select></td></tr>
            
                 <tr><td>

                                        <table>
                                           <tr><td> <?=GetMessage("DVS_SEASON");?></td></tr>
                                
                                                      
                                        <tr><td> 
                                        <? if(isset($_REQUEST['season'])&&$_REQUEST['season']==leto)
                                              echo '<input checked type="radio" name="season"  value="leto" ><span class="summer">Лето</span>';
                                          else
                                             echo '<input type="radio" name="season"  value="leto" ><span class="summer">Лето</span>';
                                        ?>

                                         <? if(isset($_REQUEST['season'])&&$_REQUEST['season']==zima)
                                              echo '<input checked type="radio" name="season"  value="zima" ><span class="winter">Зима</span>';
                                          else
                                             echo '<input type="radio" name="season"  value="zima" ><span class="winter">Зима</span>';
                                        ?>
                                        
                                         </td></tr>
                                <tr><td><?=GetMessage("DVS_PIN");?></td></tr> 
                                            <tr><td>  
                                            <? if(isset($_REQUEST['pin'])&&$_REQUEST['pin']==156764)
                                                  echo '<input checked type="radio" name="pin"  value="156764" ><span class="pin">Да</span>';
                                              else
                                                 echo '<input type="radio" name="pin"  value="156764" ><span class="pin">Да</span>';
                                            ?>

                                            <? if(isset($_REQUEST['pin'])&&$_REQUEST['pin']==156721)
                                                  echo '<input checked type="radio" name="pin"  value="156721" ><span class="pin">Нет</span>';
                                              else
                                                 echo '<input type="radio" name="pin"  value="156721" ><span class="pin">Нет</span>';
                                            ?>

                                            </td></tr>

                                       
                                         </table>

                                    </td></tr>
                          
                                  </table>

                </td></tr>
      
              </table>
               <? //echo "<pre>";  print_r($arResult); echo "</pre>"; ?>
                        
                    </fieldset>
                    <fieldset>
                        <input type="hidden" name="do_search" value="tyres" />
                        <button type="submit" id="tp_submit" class="button1"><span style="padding:5px; background: #0090D0; color:white;"><?=GetMessage("DVS_SEARCH");?></span></button> 
                        
                    </fieldset>
                </form>

               

        <div class="clear"></div>
	
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
