<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>
<?
$tmpArr = array();

foreach($arResult['ITEMS'] as $key => &$item){
    $rsElement = CIBlockElement::GetList(
        array(),
        array('IBLOCK_ID'=>$item['PROPERTIES']['model']['LINK_IBLOCK_ID'], 'ID'=>$item['PROPERTIES']['model']['VALUE'], 'ACTIVE'=>'Y'),
        false,
        false,
        array('ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_PICTURE', 'PROPERTY_*')
    );
    if ($obElement = $rsElement->GetNextElement()) {
        $arFields = $obElement->GetFields();
        
        $item['TAB_NAME'] = $item['PROPERTIES']['tyre_on_index']['VALUE_ENUM'];
        $item['PREVIEW_PICTURE'] = CFile::GetFileArray($arFields['PREVIEW_PICTURE']);
        $item['PROPERTIES'] = array_merge($item['PROPERTIES'], $obElement->GetProperties());
        
        if (count($tmpArr[$item['PROPERTIES']['tyre_on_index']['VALUE_ENUM']]) >= $arParams["LINE_ELEMENT_COUNT"]) {
            continue;
        }
        
        $tmpArr[$item['PROPERTIES']['tyre_on_index']['VALUE_ENUM']][] = $item;
    }
}

$arResult['ITEMS'] = $tmpArr;
?>