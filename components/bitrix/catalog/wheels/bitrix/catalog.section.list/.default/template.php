<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="brands">
    <ul>
    <?foreach($arResult["SECTIONS"] as $arSection):?>
    <?
    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
        <li id="<?=$this->GetEditAreaId($arSection['ID']);?>">
            <div class="img">
                <a href="<?echo $arSection['SECTION_PAGE_URL'];?>" class="lnk"></a>
                <table><tr><td><img src="<?echo $arSection['PICTURE']['SRC'];?>" width="<?echo $arSection['PICTURE']['WIDTH'];?>" height="<?echo $arSection['PICTURE']['HEIGHT'];?>" alt="<?echo $arSection['NAME'];?>" /></td></tr></table>
            </div>
            <h4><a href="<?echo $arSection['SECTION_PAGE_URL'];?>"><?echo $arSection['NAME'];?></a></h4>
        </li>
    <?endforeach;?>
    </ul>
    <div class="clear"></div>
</div>