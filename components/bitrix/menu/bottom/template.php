<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (file_exists($_SERVER["DOCUMENT_ROOT"] . '/sitemap/index.php')) {
    $arResult[] = array(
        'TEXT' => GetMessage("DVS_SITE_MAP"),
        'LINK' => '/sitemap/',
        'DEPTH_LEVEL' => 1,
        'IS_PARENT' => ''
    );
}?>
<?if (!empty($arResult)):?>
<ul>
<?
foreach($arResult as $key => $arItem):
    if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
        continue;
?>
    <li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
<?if (($key + 1) % 5 == 0) {?>
</ul><ul>
<?}?>
<?endforeach?>
</ul>
<?endif?>