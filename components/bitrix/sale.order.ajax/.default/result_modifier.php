<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
foreach($arResult["BASKET_ITEMS"] as &$item){
    $ar_res = CCatalogProduct::GetByIDEx($item['PRODUCT_ID']);
    $item['DETAIL_PAGE_URL'] = $ar_res['DETAIL_PAGE_URL'];
    $item['TOTAL'] = $item['PRICE']*$item['QUANTITY'];
    
    $item['BASE_PRICE'] = CPrice::GetBasePrice($item['PRODUCT_ID']);
    $item["BASE_PRICE"]['PRICE'] = ceil($item["BASE_PRICE"]['PRICE']);
    $item['PRICE'] = ceil($item['PRICE']);
}
?>