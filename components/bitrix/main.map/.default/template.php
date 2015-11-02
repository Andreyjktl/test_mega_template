<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!is_array($arResult["arMap"]) || count($arResult["arMap"]) < 1)
    return;
?>

<div class="sitemap">
    <div class="col last">
        <ul>
        <?foreach($arResult["arMap"] as $index => $arItem):?>
            <li><a href="<?=$arItem["FULL_PATH"]?>"><?=$arItem["NAME"]?></a><?if ($arParams["SHOW_DESCRIPTION"] == "Y" && strlen($arItem["DESCRIPTION"]) > 0) {?><div><?=$arItem["DESCRIPTION"]?></div><?}?>
        <?endforeach?>
        </ul>
    </div>
    <div class="clear"></div>
</div>