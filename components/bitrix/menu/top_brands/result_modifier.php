<?
CModule::IncludeModule("iblock");

if (CSite::InDir(SITE_DIR.'product/')) {
    $res = CIBlockElement::GetList(
        array(),
        array('ACTIVE'=>'Y', 'CODE' => rtrim(str_replace('/product/', '', $APPLICATION->GetCurDir()), '/')),
        false,
        array('nTopCount' => 1),
        array('PROPERTY_model')
    );

    $leftMenuModelId = 0;
    if($arFields = $res->GetNext()){
        $leftMenuModelId = $arFields['PROPERTY_MODEL_VALUE'];
    }

    foreach($arResult as $key => $val){
        $rsElement = CIBlockElement::GetList(
            array(),
            array('ACTIVE'=>'Y', 'SECTION_CODE'=>ltrim(strrchr(rtrim($val['LINK'], '/'), '/'), '/')),
            false,
            false,
            array('ID')
        );
        while ($arFields = $rsElement->GetNext()) {
            if ($leftMenuModelId == $arFields['ID']) {
                $arResult[$key]['SELECTED'] = 1;
            }
        }
    }

}
?>