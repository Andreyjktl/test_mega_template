<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if(!Bitrix\Main\Loader::includeModule('iblock')
	|| !Bitrix\Main\Loader::includeModule('catalog')){
	return;
}

$arIBlock = array();
$rsIBlock = CIBlock::GetList(array('SORT' => 'ASC'), array('ACTIVE' => 'Y'));
while ($arr = $rsIBlock->Fetch()){
	$arIBlock[$arr['ID']] = '['.$arr['ID'].'] '.$arr['NAME'];
}

$arPopupDetailVariable = array(
	'ON_IMAGE' => getMessage('POPUP_DETAIL_VARIABLE_IMAGE'),
	'ON_LUPA' => getMessage('POPUP_DETAIL_VARIABLE_LUPA'),
	'ON_NONE' => getMessage('POPUP_DETAIL_VARIABLE_NONE'),
);
$arSectionDescrValues = array(
	'-' => getMessage('RS_SLINE.UNDEFINED'),
	'top' => getMessage('RS_SLINE.SHOW_SECTION_DESCRIPTION_TOP'),
	'bottom' => getMessage('RS_SLINE.SHOW_SECTION_DESCRIPTION_BOTTOM'),
);

$arPriceFor = array(
	'products' => getMessage('FILTER_PRICE_GROUPED_FOR_PRIDUCTS'),
	'sku' => getMessage('FILTER_PRICE_GROUPED_FOR_SKU'),
);

$defaultListValues = array('-' => getMessage('RS_SLINE.UNDEFINED'));

$IBLOCK_ID = intval($arCurrentValues['IBLOCK_ID']);
$arProperty = array();
if(0 < intval($IBLOCK_ID)){
	$rsProp = CIBlockProperty::GetList(Array('sort' => 'asc', 'name' => 'asc'), Array('IBLOCK_ID' => $IBLOCK_ID, 'ACTIVE' => 'Y'));
	while($arr = $rsProp->Fetch()){
		$arProperty[$arr['CODE']] = '['.$arr['CODE'].'] '.$arr['NAME'];
	}
}

$arPrice = array();
$rsPrice = CCatalogGroup::GetList($v1='sort', $v2='asc');
while($arr = $rsPrice->Fetch()){
	$arPrice[$arr['NAME']] = '['.$arr['NAME'].'] '.$arr['NAME_LANG'];
}

$arTemplateParameters = array(
	//PAGER_SETTINGS
	'AJAXPAGESID' => array(
		'PARENT' => 'PAGER_SETTINGS',
		'NAME' => getMessage('MSG_AJAXPAGESID'),
		'TYPE' => 'STRING',
		'DEFAULT' => 'ajaxpages_catalog_identifier',
	),
	'USE_AJAXPAGES' => array(
		'PARENT' => 'PAGER_SETTINGS',
		'NAME' => getMessage('RS_SLINE.USE_AJAXPAGES'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'Y',
	),
	//LIST_SETTINGS
	'SHOW_SECTION_PICTURE' => array(
		'PARENT' => 'LIST_SETTINGS',
		'NAME' => getMessage('RS_SLINE.SHOW_SECTION_PICTURE'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'N',
		'REFRESH' => 'Y'
	),
	'POPUP_DETAIL_VARIABLE' => array(
		'PARENT' => 'LIST_SETTINGS',
		'NAME' => getMessage('MSG_POPUP_DETAIL_VARIABLE'),
		'TYPE' => 'LIST',
		'MULTIPLE' => 'N',
		'VALUES' => $arPopupDetailVariable,
		'REFRESH' => 'N',
	),
	'ERROR_EMPTY_ITEMS' => array(
		'PARENT' => 'LIST_SETTINGS',
		'NAME' => getMessage('MSG_ERROR_EMPTY_ITEMS'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'N',
	),
	'SHOW_SECTION_DESCRIPTION' => array(
		'PARENT' => 'LIST_SETTINGS',
		'NAME' => getMessage('RS_SLINE.SHOW_SECTION_DESCRIPTION'),
		'TYPE' => 'LIST',
		'VALUES' => $arSectionDescrValues,
		'DEFAULT' => '-',
	),
	//DETAIL_SETTINGS
	'LINKED_ITEMS_PROPS' => array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => getMessage('RS_SLINE.LINKED_ITEMS_PROPS'),
		'TYPE' => 'LIST',
		'VALUES' => array_merge($defaultListValues, $arProperty),
		'DEFAULT' => '-',
		'MULTIPLE' => 'Y',
	),
	'TAB_IBLOCK_PROPERTY' => array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => getMessage('TAB_IBLOCK_PROPERTY'),
		'TYPE' => 'LIST',
		'MULTIPLE' => 'Y',
		'VALUES' => $arProperty,
		'DEFAULT' => '',
		'ADDITIONAL_VALUES' => 'Y',
	),
	'SIZE_TABLE_USER_FIELD_CODE' => array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => getMessage('MSG_SIZE_TABLE_USER_FIELD_CODE'),
		'TYPE' => 'STRING',
		'DEFAULT' => 'UF_SIZE_TABLE',
	),
	'USE_KREDIT' => array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => getMessage('MSG_USE_KREDIT'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'Y',
	),
	'KREDIT_URL' => array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => getMessage('MSG_KREDIT_URL'),
		'TYPE' => 'STRING',
		'DEFAULT' => '',
	),
	//FILTER_SETTINGS
	'FILTER_SCROLL_PROPS' => array(
		'PARENT' => 'FILTER_SETTINGS',
		'NAME' => getMessage('RS_SLINE.FILTER_SCROLL_PROPS'),
		'TYPE' => 'LIST',
		'MULTIPLE' => 'Y',
		'VALUES' => array_merge($defaultListValues, $arProperty),
		'DEFAULT' => '-',
	),
	'FILTER_SEARCH_PROPS' => array(
		'PARENT' => 'FILTER_SETTINGS',
		'NAME' => getMessage('RS_SLINE.FILTER_SEARCH_PROPS'),
		'TYPE' => 'LIST',
		'MULTIPLE' => 'Y',
		'VALUES' => array_merge($defaultListValues, $arProperty),
		'DEFAULT' => '-',
	),
	'FILTER_PRICE_GROUPED' => array(
		'PARENT' => 'FILTER_SETTINGS',
		'NAME' => getMessage('FILTER_PRICE_GROUPED'),
		'TYPE' => 'LIST',
		'MULTIPLE' => 'Y',
		'VALUES' => $arPrice,
	),
	'FILTER_PRICE_GROUPED_FOR' => array(
		'PARENT' => 'FILTER_SETTINGS',
		'NAME' => getMessage('FILTER_PRICE_GROUPED_FOR'),
		'TYPE' => 'LIST',
		'MULTIPLE' => 'N',
		'DEFAULT' => 'products',
		'VALUES' => $arPriceFor,
	),
	// OTHER
	'PROP_CODE_MEN' => array(
		'NAME' => getMessage('MSG_PROP_CODE_MEN'),
		'TYPE' => 'LIST',
		'VALUES' => array_merge($defaultListValues, $arProperty),
		'DEFAULT' => '-',
	),
	'PROP_CODE_WOMEN' => array(
		'NAME' => getMessage('MSG_PROP_CODE_WOMEN'),
		'TYPE' => 'LIST',
		'VALUES' => array_merge($defaultListValues, $arProperty),
		'DEFAULT' => '-',
	),
	'PROP_NEW_ICON' => array(
		'NAME' => getMessage('MSG_PROP_NEW_ICON'),
		'TYPE' => 'LIST',
		'VALUES' => array_merge($defaultListValues, $arProperty),
		'DEFAULT' => '-',
	),
	'PROP_DISCOUNT_ICON' => array(
		'NAME' => getMessage('MSG_PROP_DISCOUNT_ICON'),
		'TYPE' => 'LIST',
		'VALUES' => array_merge($defaultListValues, $arProperty),
		'DEFAULT' => '-',
	),
	'PROP_ACTION_ICON' => array(
		'NAME' => getMessage('MSG_PROP_ACTION_ICON'),
		'TYPE' => 'LIST',
		'VALUES' => array_merge($defaultListValues, $arProperty),
		'DEFAULT' => '-',
	),
	'PROPCODE_MORE_PHOTO' => array(
		'NAME' => getMessage('MSG_PROPCODE_MORE_PHOTO'),
		'TYPE' => 'LIST',
		'VALUES' => array_merge($defaultListValues, $arProperty),
		'DEFAULT' => '-',
	),
	'PROPCODE_ARTIKUL' => array(
		'NAME' => getMessage('MSG_PROPCODE_ARTIKUL'),
		'TYPE' => 'LIST',
		'VALUES' => array_merge($defaultListValues, $arProperty),
		'DEFAULT' => '-',
	),
	'PROPCODE_DOSTAVKA' => array(
		'NAME' => getMessage('MSG_PROPCODE_DOSTAVKA'),
		'TYPE' => 'LIST',
		'VALUES' => array_merge($defaultListValues, $arProperty),
		'DEFAULT' => '-',
	),
	'PROPCODE_MAKER' => array(
		'NAME' => getMessage('MSG_PROPCODE_MAKER'),
		'TYPE' => 'LIST',
		'VALUES' => array_merge($defaultListValues, $arProperty),
		'DEFAULT' => '-',
		'REFRESH' => 'Y'
	),
	'PROPCODE_MAKER_LOGO' => array(
		'NAME' => getMessage('MSG_PROPCODE_MAKER_LOGO'),
		'TYPE' => 'LIST',
		'VALUES' => array_merge($defaultListValues, $arProperty),
		'DEFAULT' => '-',
	),
	'PROPCODE_ACCESSORIES' => array(
		'NAME' => getMessage('MSG_PROPCODE_ACCESSORIES'),
		'TYPE' => 'LIST',
		'VALUES' => array_merge($defaultListValues, $arProperty),
		'DEFAULT' => '-',
	),
	'USE_QUANTITY_AND_STORES' => array(
		'NAME' => getMessage('MSG_USE_QUANTITY_AND_STORES'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'Y',
	),
	'USE_DELETE' => array(
		'NAME' => getMessage('MSG_USE_DELETE'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => '',
	),
	'USE_LIKES' => array(
		'NAME' => getMessage('MSG_USE_LIKES'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'Y',
	),
	'USE_SHARE_BUTTONS' => array(
		'NAME' => getMessage('MSG_USE_SHARE_BUTTONS'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'Y',
	),
	// SEARCH -> 
	'COUNT_RESULT_NOT_CATALOG' => array(
		'NAME' => getMessage('MSG_COUNT_RESULT_NOT_CATALOG'),
		'TYPE' => 'STRING',
		'DEFAULT' => '10',
	),
);

if('' != $arCurrentValues['PROPCODE_MAKER']){
	$arTemplateParameters['MAKER_IBLOCK_ID'] = array(
		'NAME' => getMessage('RS_SLINE.MAKER_IBLOCK_ID'),
		'TYPE' => 'LIST',
		'VALUES' => $arIBlock,
		'DEFAULT' => '',
	);
	$MAKER_IBLOCK_ID = intval($arCurrentValues['MAKER_IBLOCK_ID']);
	if($MAKER_IBLOCK_ID){
		$arMakerProperty = array();
		if(0 < intval($IBLOCK_ID)){
			$rsMakerProp = CIBlockProperty::GetList(Array('sort' => 'asc', 'name' => 'asc'), Array('IBLOCK_ID' => $MAKER_IBLOCK_ID, 'ACTIVE' => 'Y'));
			while($arr = $rsMakerProp->Fetch()){
				$arMakerProperty[$arr['CODE']] = '['.$arr['CODE'].'] '.$arr['NAME'];
			}
		}
		$arTemplateParameters['MAKER_IBLOCK_PROPCODE_MAKER'] = array(
			'NAME' => getMessage('RS_SLINE.MAKER_IBLOCK_PROPCODE_MAKER'),
			'TYPE' => 'LIST',
			'VALUES' => array_merge($defaultListValues, $arMakerProperty),
			'DEFAULT' => '-',
		);
	}
}
if('Y' == $arCurrentValues['SHOW_SECTION_PICTURE']){
	$arTemplateParameters['SECTION_PICTURE_WIDTH'] = array(
		'PARENT' => 'LIST_SETTINGS',
		'NAME' => getMessage('RS_SLINE.SECTION_PICTURE_WIDTH'),
		'TYPE' => 'STRING',
		'DEFAULT' => '',
	);
	$arTemplateParameters['SECTION_PICTURE_HEIGHT'] = array(
		'PARENT' => 'LIST_SETTINGS',
		'NAME' => getMessage('RS_SLINE.SECTION_PICTURE_HEIGHT'),
		'TYPE' => 'STRING',
		'DEFAULT' => '',
	);
}

$arOffers = CIBlockPriceTools::GetOffersIBlock($IBLOCK_ID);
$OFFERS_IBLOCK_ID = is_array($arOffers) ? $arOffers['OFFERS_IBLOCK_ID']: 0;

if($OFFERS_IBLOCK_ID){
	$arProperty_Offers = array();
	$rsProp = CIBlockProperty::GetList(array('sort'=>'asc', 'name'=>'asc'), array('IBLOCK_ID'=>$OFFERS_IBLOCK_ID, 'ACTIVE'=>'Y'));
	while($arr=$rsProp->Fetch()){
		$arr['ID'] = intval($arr['ID']);
		if ($arOffers['OFFERS_PROPERTY_ID'] == $arr['ID'])
			continue;
		$strPropName = '['.$arr['ID'].']'.('' != $arr['CODE'] ? '['.$arr['CODE'].']' : '').' '.$arr['NAME'];
		if ('' == $arr['CODE'])
			$arr['CODE'] = $arr['ID'];
		$arProperty_Offers[$arr['CODE']] = $strPropName;
	}

	$arTemplateParameters['PROPCODE_SKU_MORE_PHOTO'] = array(
		'PARENT' => 'OFFERS_SETTINGS',
		'NAME' => getMessage('RS_SLINE.OFFER_ADDITIONAL_PICT_PROP'),
		'TYPE' => 'LIST',
		'VALUES' => array_merge($defaultListValues, $arProperty_Offers),
		'DEFAULT' => '-',
	);
	/*
	$arTemplateParameters['OFFER_ARTICLE_PROP'] = array(
		'PARENT' => 'OFFERS_SETTINGS',
		'NAME' => getMessage('RS_SLINE.OFFER_ARTICLE_PROP'),
		'TYPE' => 'LIST',
		'VALUES' => array_merge($defaultListValues, $arProperty_Offers),
		'DEFAULT' => '-',
	);*/
	$arTemplateParameters['OFFER_TREE_PROPS'] = array(
		'PARENT' => 'OFFERS_SETTINGS',
		'NAME' => getMessage('RS_SLINE.OFFER_TREE_PROPS'),
		'TYPE' => 'LIST',
		'VALUES' => array_merge($defaultListValues, $arProperty_Offers),
		'MULTIPLE' => 'Y',
		'DEFAULT' => '-',
	);
	$arTemplateParameters['OFFER_TREE_COLOR_PROPS'] = array(
		'PARENT' => 'OFFERS_SETTINGS',
		'NAME' => getMessage('RS_SLINE.OFFER_TREE_COLOR_PROPS'),
		'TYPE' => 'LIST',
		'VALUES' => array_merge($defaultListValues, $arProperty_Offers),
		'MULTIPLE' => 'Y',
		'DEFAULT' => '-',
	);
	$arTemplateParameters['OFFER_TREE_BTN_PROPS'] = array(
		'PARENT' => 'OFFERS_SETTINGS',
		'NAME' => getMessage('RS_SLINE.OFFER_TREE_BTN_PROPS'),
		'TYPE' => 'LIST',
		'VALUES' => array_merge($defaultListValues, $arProperty_Offers),
		'MULTIPLE' => 'Y',
		'DEFAULT' => '-',
	);
	$arTemplateParameters['OFFER_FILTER_SCROLL_PROPS'] = array(
		'PARENT' => 'FILTER_SETTINGS',
		'NAME' => getMessage('RS_SLINE.OFFER_FILTER_SCROLL_PROPS'),
		'TYPE' => 'LIST',
		'VALUES' => array_merge($defaultListValues, $arProperty_Offers),
		'MULTIPLE' => 'Y',
		'DEFAULT' => '-',
	);
	$arTemplateParameters['OFFER_FILTER_SEARCH_PROPS'] = array(
		'PARENT' => 'FILTER_SETTINGS',
		'NAME' => getMessage('RS_SLINE.OFFER_FILTER_SEARCH_PROPS'),
		'TYPE' => 'LIST',
		'VALUES' => array_merge($defaultListValues, $arProperty_Offers),
		'MULTIPLE' => 'Y',
		'DEFAULT' => '-',
	);
}

if (Bitrix\Main\ModuleManager::isModuleInstalled("sale")){
	/*$arTemplateParameters['USE_SALE_BESTSELLERS'] = array(
		'NAME' => getMessage('RS_SLINE.USE_SALE_BESTSELLERS'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y'
	);*/

	$arTemplateParameters['USE_BIG_DATA'] = array(
		'PARENT' => 'BIG_DATA_SETTINGS',
		'NAME' => getMessage('RS_SLINE.USE_BIG_DATA'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
		'REFRESH' => 'Y'
	);
	if (!isset($arCurrentValues['USE_BIG_DATA']) || $arCurrentValues['USE_BIG_DATA'] == 'Y'){
		$rcmTypeList = array(
			'bestsell' => getMessage('RS_SLINE.RCM_BESTSELLERS'),
			'personal' => getMessage('RS_SLINE.RCM_PERSONAL'),
			'similar_sell' => getMessage('RS_SLINE.RCM_SOLD_WITH'),
			'similar_view' => getMessage('RS_SLINE.RCM_VIEWED_WITH'),
			'similar' => getMessage('RS_SLINE.RCM_SIMILAR'),
			'any_similar' => getMessage('RS_SLINE.RCM_SIMILAR_ANY'),
			'any_personal' => getMessage('RS_SLINE.RCM_PERSONAL_WBEST'),
			'any' => getMessage('RS_SLINE.RCM_RAND')
		);
		$arTemplateParameters['BIG_DATA_RCM_TYPE'] = array(
			'PARENT' => 'BIG_DATA_SETTINGS',
			'NAME' => getMessage('RS_SLINE.BIG_DATA_RCM_TYPE'),
			'TYPE' => 'LIST',
			'VALUES' => $rcmTypeList
		);
		unset($rcmTypeList);
	}
}