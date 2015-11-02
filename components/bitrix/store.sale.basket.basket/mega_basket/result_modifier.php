<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
foreach($arResult["ITEMS"]["AnDelCanBuy"] as &$item){
    $ar_res = CCatalogProduct::GetByIDEx($item['PRODUCT_ID']);
    $item['DETAIL_PAGE_URL'] = $ar_res['DETAIL_PAGE_URL'];
    $item['TOTAL'] = $item['PRICE']*$item['QUANTITY'];

    $item['BASE_PRICE'] = CPrice::GetBasePrice($item['PRODUCT_ID']);
    $item["BASE_PRICE"]['PRICE'] = ceil($item["BASE_PRICE"]['PRICE']);
    $item['PRICE'] = ceil($item['PRICE']);
    if($ar_res['IBLOCK_CODE']=='tyres'){
        $rsProp = CIBlockProperty::GetByID('model', false, 'tyres');
        if($arProp = $rsProp->GetNext()){
            $rsElement = CIBlockElement::GetList(array(), array('IBLOCK_ID'=>$arProp['LINK_IBLOCK_ID'], 'ID'=>$ar_res['PROPERTIES']['model']['VALUE'], 'ACTIVE'=>'Y'), false, array('nTopCount'=>1), array('ID', 'IBLOCK_ID', 'PREVIEW_PICTURE'));
            if ($obElement = $rsElement->GetNextElement()) {
                $arFields = $obElement->GetFields();
                $arProps = $obElement->GetProperties(false, array('CODE'=>array('model_season', 'model_type', 'model_pin')));

                $item['IBLOCK_CODE']='tyres';
                $item['PREVIEW_PICTURE'] = CFile::ResizeImageGet($arFields['PREVIEW_PICTURE'], array('width'=>43, 'height'=>60), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                $item['PROPERTIES'] = $arProps;
            }
        }
    }elseif($ar_res['IBLOCK_CODE']=='wheels'){
        $rsProp = CIBlockProperty::GetByID('model', false, 'wheels');
        if($arProp = $rsProp->GetNext()){
            $rsElement = CIBlockElement::GetList(array(), array('IBLOCK_ID'=>$arProp['LINK_IBLOCK_ID'], 'ID'=>$ar_res['PROPERTIES']['model']['VALUE'], 'ACTIVE'=>'Y'), false, array('nTopCount'=>1), array('ID', 'IBLOCK_ID', 'PREVIEW_PICTURE'));
            if ($obElement = $rsElement->GetNextElement()) {
                $arFields = $obElement->GetFields();

                $item['IBLOCK_CODE']='wheels';
                $item['PREVIEW_PICTURE'] = CFile::ResizeImageGet($arFields['PREVIEW_PICTURE'], array('width'=>43, 'height'=>60), BX_RESIZE_IMAGE_PROPORTIONAL, true);
            }
        }
    }
}
?>