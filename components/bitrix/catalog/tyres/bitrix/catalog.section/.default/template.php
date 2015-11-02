<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$i=0;
?>
<!-- Catalog -->
<div class="catalog">
<?foreach($arResult["ITEMS"] as $cell=>$arSeason):?>
    <?$i++;?>
    <div class="mode">
        <a name="seas<?echo $arSeason['ID']?>"></a>

        <h2><?echo $arSeason['NAME'];?> <?echo $arResult["NAME"];?></h2>
        <?if(count($arResult["ITEMS"])>1){?>
            <p class="mode"><?=GetMessage("DVS_OTHER_SEASON");?> &nbsp;
            <?foreach($arResult['SEASONS'] as $key => $name){
                if($key!=$cell){
                    echo '<a href="#seas'.$key.'">'.$name.'</a> &nbsp; &nbsp;';
                }
            }?>
        </p>
        <?}?>
        <div class="clear"></div>
    </div>
    <div class="overflow820">
        <table class="catalog">
    <?foreach($arSeason['ITEMS'] as $arLine):
            $iterator = 0;
            $arImgs = $arData = array();

            foreach($arLine as $arElement){
                $iterator++;
                $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));

                $hit = $sale = $pin = false;

                $season_name = $arElement['PROPERTIES']['model_season']['VALUE_ENUM'];
                if($arElement['PROPERTIES']['model_season']['VALUE_XML_ID']=='leto'){
                    $season_class = 'summer';
                }elseif($arElement['PROPERTIES']['model_season']['VALUE_XML_ID']=='zima'){
                    $season_class = 'winter';
                    $pin = $arElement['PROPERTIES']['model_pin']['VALUE_XML_ID']=='yes'?true:false;
                }else{
                    $season_class = 'allseason';
                }

                if (is_array($arElement['PREVIEW_PICTURE'])) {
                    $picture = $arElement['PREVIEW_PICTURE']['SRC'];
                    $width = $arElement['PREVIEW_PICTURE']['WIDTH'];
                    $height = $arElement['PREVIEW_PICTURE']['HEIGHT'];
                } else {
                    $picture = "/images/photo.png";
                    $width = 100;
                    $height = 100;
                }

                $arPrice = $arElement['PRICE'];
                if($arPrice["DISCOUNT_PRICE"] < $arPrice["PRICE"]['PRICE']){
                    $sale = true;
                }

                $CDBResult = CIBlockElement::GetProperty(
                    $arElement['IBLOCK_ID'],
                    $arElement['ID'],
                    array("SORT" => "ASC"),
                    array("CODE" => "tyre_hit")
                );
                $$properties = array();
                if ($properties = $CDBResult->Fetch()) {
                    if ($properties['VALUE_XML_ID'] == 'yes') {
                        $hit = true;
                    }
                }

                $icons = "";
                if ($sale || $hit) {
                    $icons = '<ul class="icons">'.
                        ($sale ? '<li><span class="red">'.dvsSALE.'</span></li>' : '')//***
                        .
                        ($hit ? '<li><span class="green">'.dvsHIT.'</span></li>' : '')//***
                    .'</ul>';
                }
                print_r($properties);

                $arImgs[] = '<td><div><a href="'.$arElement['DETAIL_PAGE_URL'].'"><img src="'.$picture.'" width="'.$width.'" height="'.$height.'" alt="'.$arElement['NAME'].'" /></a>' . $icons . '</div></td>';
                $arData[] = '<td id="'.$this->GetEditAreaId($arElement['ID']).'">
                    <h4><a href="'.$arElement['DETAIL_PAGE_URL'].'">'.$arElement['NAME'].'</a></h4>
                    <p><span class="'.$season_class.'">'.$season_name.($pin?', ':'').'</span>'.($pin?'<span class="spike">'.GetMessage("DVS_PIN").'</span>':'').'</p>
                    <p>'.$arElement['PROPERTIES']['model_type']['VALUE'].'</p>';
                if ($iterator >= 5) {
                    $iterator = 0;
                    ?>
                        <tr class="img"><?echo implode('', $arImgs);?></tr>
                        <tr class="txt"><?echo implode('', $arData);?></tr>
                    <?
                    $arImgs = $arData = array();
                }
            }
            while (count($arImgs) < 5) {
                $arImgs[] = "<td></td>";
                $arData[] = "<td></td>";
            }
            ?>
            <tr class="img"><?echo implode('', $arImgs);?></tr>
            <tr class="txt"><?echo implode('', $arData);?></tr>
            
    <?endforeach;?>
        </table>
    </div>
    <?if($i!=count($arResult["ITEMS"])){
        echo '<hr class="full" />';
    }?>

<?endforeach;?>
</div>
<!-- // Catalog -->