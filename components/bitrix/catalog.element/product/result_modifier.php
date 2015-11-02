<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
global $APPLICATION;
$cp = $this->__component;


$rsElement = CIBlockElement::GetList(array(), array('IBLOCK_ID'=>$arResult['PROPERTIES']['model']['LINK_IBLOCK_ID'], 'ID'=>$arResult['PROPERTIES']['model']['VALUE'], 'ACTIVE'=>'Y'), false, array('nTopCount'=>1), array('ID', 'IBLOCK_ID', 'NAME', 'DETAIL_PICTURE', 'PROPERTY_*', 'DETAIL_TEXT', 'DETAIL_TEXT_TYPE', "IBLOCK_SECTION_ID", "DETAIL_PAGE_URL"));
if ($obElement = $rsElement->GetNextElement()) {
    $arFields = $obElement->GetFields();

    $rsBrand = CIBlockSection::GetByID($arFields['IBLOCK_SECTION_ID']);
    if($arBrand = $rsBrand->GetNext())
        $arResult['LINK_MODEL']['SECTION'] = $arBrand;

    $arResult['LINK_MODEL']['DETAIL_PAGE_URL'] = $arFields['DETAIL_PAGE_URL'];
    $arResult['LINK_MODEL']['DETAIL_PICTURE'] = CFile::GetFileArray($arFields['DETAIL_PICTURE']);
    $arResult['LINK_MODEL']['PROPERTIES'] = $obElement->GetProperties();
    $arResult['LINK_MODEL']['NAME'] = $arFields['NAME'];
    $arResult['LINK_MODEL']['DETAIL_TEXT'] = $arFields['DETAIL_TEXT'];

    if(isset($arResult['LINK_MODEL']['PROPERTIES']['more_photos'])){
        $arResult['LINK_MODEL']["PROPERTIES"]['more_photos'] = CIBlockFormatProperties::GetDisplayValue($arResult, $arResult['LINK_MODEL']['PROPERTIES']['more_photos'], "catalog_out");
    }

    $cp->arResult['LINK_MODEL'] = $arResult['LINK_MODEL'];
    $cp->arResult['DETAIL_PAGE_URL'] = $arResult['DETAIL_PAGE_URL'];
    $cp->SetResultCacheKeys(array('LINK_MODEL', 'DETAIL_PAGE_URL'));
}


if ($arResult["IBLOCK_CODE"] == "tyres") {
    $arFeatures = array('tyre_diameter', 'tyre_width', 'tyre_height', 'tyre_load', 'tyre_speed');
} else {
    $arFeatures = array('wheels_width', 'wheels_diameter', 'wheels_count', 'wheels_aperture', 'wheels_center');
}
$arSim = array();
foreach($arFeatures as $feature){
    if(isset($arResult['PROPERTIES'][$feature]['VALUE_ENUM_ID'])){
        $arSim['PROPERTY_'.$feature] = $arResult['PROPERTIES'][$feature]['VALUE_ENUM_ID'];
    }
}

$arResult['SIMILAR_FILTER'] = $arSim;

global $arrFilter;
$arrFilter = array_merge(
    array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], '!ID'=>$arResult['ID']),
    $arResult['SIMILAR_FILTER']
);

$arResult['SIMILAR_COUNT'] = CIBlockElement::GetList(Array(), $arrFilter, array());
?>