<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="catalog">
    <div class="overflow">
        <table class="catalog">
    <?foreach($arResult['ITEMS'] as $arLine):
            $iterator = 0;
            $arImgs = $arData = array();

            foreach($arLine as $arElement){
                $iterator++;
                $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));

                if (is_array($arElement['PREVIEW_PICTURE'])) {
                    $picture = $arElement['PREVIEW_PICTURE']['SRC'];
                    $width = $arElement['PREVIEW_PICTURE']['WIDTH'];
                    $height = $arElement['PREVIEW_PICTURE']['HEIGHT'];
                } else {
                    $picture = "/images/photo.png";
                    $width   = 100;
                    $height  = 100;
                }
                $arImgs[] = '<td><div><a href="'.$arElement['DETAIL_PAGE_URL'].'"><img src="'.$picture.'" width="'.$width.'" height="'.$height.'" alt="'.$arElement['NAME'].'" /></a></div></td>';
                $arData[] = '<td id="'.$this->GetEditAreaId($arElement['ID']).'">
                    <h4><a href="'.$arElement['DETAIL_PAGE_URL'].'">'.$arElement['NAME'].'</a></h4>';
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
</div>