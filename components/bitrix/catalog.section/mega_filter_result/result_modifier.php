<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
foreach($arResult['ITEMS'] as $items){
    $rsElement = CIBlockElement::GetList(
        array(),
        array('IBLOCK_ID'=>$items['PROPERTIES']['model']['LINK_IBLOCK_ID'], 'ID'=>$items['PROPERTIES']['model']['VALUE'], 'ACTIVE'=>'Y'),
        false,
        false,
        array('ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_PICTURE', 'PROPERTY_*')
    );

    if ($obElement = $rsElement->GetNextElement()) {
        $arFields = $obElement->GetFields();

        $items['PREVIEW_PICTURE'] = CFile::GetFileArray($arFields['PREVIEW_PICTURE']);
        $items['PROPERTIES'] = array_merge($items['PROPERTIES'], $obElement->GetProperties());
    }

   /*$index_tmp = count($arTempResult); // сколько строк; 0 если первый
    if($index_tmp!=0){
        if(count($arTempResult[($index_tmp-1)])==$arParams['LINE_ELEMENT_COUNT']){
            $arTempResult[$index_tmp][] = $items;
        }else{
            $arTempResult[$index_tmp-1][] = $items;
        }
    }else{
        $arTempResult[0][0] = $items;
        }
}

$arResult['ITEMS'] = $arTempResult;
?>*/

    $index_tmp = count($arTempResult); // сколько строк; 0 если первый
    if($index_tmp!=0){
        if(count($arTempResult[($index_tmp-1)])==1){
            $arTempResult[$index_tmp][] = $items;
        }else{
            $arTempResult[$index_tmp-1][] = $items;
        }
    }else{
        $arTempResult[0][0] = $items;
    }
}

$arResult['ITEMS'] = $arTempResult;
?>
