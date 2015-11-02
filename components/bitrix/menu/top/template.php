<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<nav>
<ul>

<?
$previousLevel = 0;
foreach($arResult as $arItem):?>
    <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
        <?=str_repeat("</ul><div class=\"arrow\"></div></div></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
    <?endif?>
    <?if ($arItem["IS_PARENT"]):?>
        <?if ($arItem["DEPTH_LEVEL"] == 1):?>
            <li>
                <a href="<?=$arItem["LINK"]?>"<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><span><?=$arItem["TEXT"]?></span></a>
                <div class="submenu1">
                    <ul>
        <?endif?>
    <?else:?>
        <?if ($arItem["PERMISSION"] > "D"):?>
            <li><a href="<?=$arItem["LINK"]?>"<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><span><?=$arItem["TEXT"]?></span></a></li>
        <?else:?>
            <li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><span><?=$arItem["TEXT"]?></span></a></li>
        <?endif?>
    <?endif?>
    <?$previousLevel = $arItem["DEPTH_LEVEL"];?>
<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
    <?=str_repeat("</ul><div class=\"arrow\"></div></div></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<div class="clear"></div>
</nav>
<?endif?>