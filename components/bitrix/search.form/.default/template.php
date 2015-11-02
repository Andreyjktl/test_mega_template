<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="search">
    <form action="<?=$arResult["FORM_ACTION"]?>" method="post">
            <div class="field"><input type="text" name="q" class="text1 autolabel" value="Поиск" tabindex="1" /></div>
            <div class="button"><button type="submit" class="button1"><span><?=GetMessage("DVS_SEARCH");?></span></button></div>
            <div class="clear"></div>
            <input type="hidden" name="s" value="Y" />
    </form>
</div>