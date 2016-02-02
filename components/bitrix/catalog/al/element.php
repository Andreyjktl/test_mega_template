<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);

$IS_POPUP = 'N';
if($_REQUEST['popup_detail']=='Y' && isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
	$APPLICATION->RestartBuffer();
	$IS_POPUP = 'Y';
}
$ElementID = $APPLICATION->IncludeComponent(
	'bitrix:catalog.element',
	'catalog',
	Array(
		'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
		'IBLOCK_ID' => $arParams['IBLOCK_ID'],
		'PROPERTY_CODE' => $arParams['DETAIL_PROPERTY_CODE'],
		'META_KEYWORDS' => $arParams['DETAIL_META_KEYWORDS'],
		'META_DESCRIPTION' => $arParams['DETAIL_META_DESCRIPTION'],
		'BROWSER_TITLE' => $arParams['DETAIL_BROWSER_TITLE'],
		'BASKET_URL' => $arParams['BASKET_URL'],
		'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
		'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
		'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],
		'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
		'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
		'CACHE_TYPE' => $arParams['CACHE_TYPE'],
		'CACHE_TIME' => $arParams['CACHE_TIME'],
		'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
		'SET_TITLE' => $arParams['SET_TITLE'],
		'SET_STATUS_404' => $arParams['SET_STATUS_404'],
		'PRICE_CODE' => $arParams['PRICE_CODE'],
		'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
		'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
		'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
		'PRICE_VAT_SHOW_VALUE' => $arParams['PRICE_VAT_SHOW_VALUE'],
		'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
		'PRODUCT_PROPERTIES' => $arParams['PRODUCT_PROPERTIES'],
		'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
		'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
		'QUANTITY_FLOAT' => $arParams['QUANTITY_FLOAT'],
		'LINK_IBLOCK_TYPE' => $arParams['LINK_IBLOCK_TYPE'],
		'LINK_IBLOCK_ID' => $arParams['LINK_IBLOCK_ID'],
		'LINK_PROPERTY_SID' => $arParams['LINK_PROPERTY_SID'],
		'LINK_ELEMENTS_URL' => $arParams['LINK_ELEMENTS_URL'],
		'OFFERS_CART_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],
		'OFFERS_FIELD_CODE' => $arParams['DETAIL_OFFERS_FIELD_CODE'],
		'OFFERS_PROPERTY_CODE' => $arParams['DETAIL_OFFERS_PROPERTY_CODE'],
		'OFFERS_SORT_FIELD' => $arParams['OFFERS_SORT_FIELD'],
		'OFFERS_SORT_ORDER' => $arParams['OFFERS_SORT_ORDER'],
		'OFFERS_SORT_FIELD2' => $arParams['OFFERS_SORT_FIELD2'],
		'OFFERS_SORT_ORDER2' => $arParams['OFFERS_SORT_ORDER2'],
		'ELEMENT_ID' => $arResult['VARIABLES']['ELEMENT_ID'],
		'ELEMENT_CODE' => $arResult['VARIABLES']['ELEMENT_CODE'],
		'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
		'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
		'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
		'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
		'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
		'CURRENCY_ID' => $arParams['CURRENCY_ID'],
		'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
		'USE_ELEMENT_COUNTER' => $arParams['USE_ELEMENT_COUNTER'],
		'PROP_CODE_MEN' => $arParams['PROP_CODE_MEN'],
		'PROP_CODE_WOMEN' => $arParams['PROP_CODE_WOMEN'],
		'PROP_NEW_ICON' => $arParams['PROP_NEW_ICON'],
		'PROP_DISCOUNT_ICON' => $arParams['PROP_DISCOUNT_ICON'],
		'PROP_ACTION_ICON' => $arParams['PROP_ACTION_ICON'],
		'DISPLAY_COMPARE' => $arParams['USE_COMPARE'],
		'USE_DELETE' => $arParams['USE_DELETE'],
		'USE_LIKES' => $arParams['USE_LIKES'],
		'USE_SHARE_BUTTONS' => $arParams['USE_SHARE_BUTTONS'],
		'PROPCODE_MORE_PHOTO' => $arParams['PROPCODE_MORE_PHOTO'],
		'PROPCODE_SKU_MORE_PHOTO' => $arParams['PROPCODE_SKU_MORE_PHOTO'],
		'PROPCODE_ARTIKUL' => $arParams['PROPCODE_ARTIKUL'],
		'PROPCODE_DOSTAVKA' => $arParams['PROPCODE_DOSTAVKA'],
		'PROPCODE_MAKER' => $arParams['PROPCODE_MAKER'],
		'MAKER_IBLOCK_ID' => $arParams['MAKER_IBLOCK_ID'],
		'MAKER_IBLOCK_PROPCODE_MAKER' => $arParams['MAKER_IBLOCK_PROPCODE_MAKER'],
		'PROPCODE_MAKER_LOGO' => $arParams['PROPCODE_MAKER_LOGO'],
		'PROPCODE_ACCESSORIES' => $arParams['PROPCODE_ACCESSORIES'],
		'POPUP_DETAIL_VARIABLE' => $arParams['POPUP_DETAIL_VARIABLE'],
		'USE_KREDIT' => $arParams['USE_KREDIT'],
		'KREDIT_URL' => $arParams['KREDIT_URL'],
		'SMART_FILTER_NAME' => $arParams['FILTER_NAME'],
		'USE_QUANTITY_AND_STORES' => $arParams['USE_QUANTITY_AND_STORES'],
		'IS_POPUP' => $IS_POPUP,
		'SIZE_TABLE_USER_FIELD_CODE' => $arParams['SIZE_TABLE_USER_FIELD_CODE'],
		'TAB_IBLOCK_PROPERTY' => $arParams['TAB_IBLOCK_PROPERTY'],
		'USE_REVIEW' => $arParams['USE_REVIEW'],
		'REVIEWS_URL_TEMPLATES_DETAIL' => $arParams['POST_FIRST_MESSAGE']==="Y"? $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'] :"",		
		'SHOW_LINK_TO_FORUM' => $arParams['SHOW_LINK_TO_FORUM'],
		'REVIEW_AJAX_POST' => $arParams['REVIEW_AJAX_POST'],
		'FORUM_ID' => $arParams['FORUM_ID'],
		'URL_TEMPLATES_READ' => $arParams['URL_TEMPLATES_READ'],
		'MESSAGES_PER_PAGE' => $arParams['MESSAGES_PER_PAGE'],
		'PATH_TO_SMILE' => $arParams['PATH_TO_SMILE'],
		'USE_CAPTCHA' => $arParams['USE_CAPTCHA'],
		'PAGE_NAVIGATION_TEMPLATE' => $arParams['PAGER_TEMPLATE'],

		'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
		'OFFER_TREE_COLOR_PROPS' => $arParams['OFFER_TREE_COLOR_PROPS'],
		'OFFER_TREE_BTN_PROPS' => $arParams['OFFER_TREE_BTN_PROPS'],
		'LINKED_ITEMS_PROPS' => $arParams['LINKED_ITEMS_PROPS'],

		// catalog.section
		"ALSO_BUY_ELEMENT_COUNT" => $arParams['ALSO_BUY_ELEMENT_COUNT'],
		"ELEMENT_SORT_FIELD" => $arParams['ELEMENT_SORT_FIELD'],
		"ELEMENT_SORT_FIELD" => $arParams['ELEMENT_SORT_FIELD'],
		"ELEMENT_SORT_ORDER" => $arParams['ELEMENT_SORT_ORDER'],
		"ELEMENT_SORT_FIELD2" => $arParams['ELEMENT_SORT_FIELD2'],
		"ELEMENT_SORT_ORDER2" => $arParams['ELEMENT_SORT_ORDER2'],
		"LIST_OFFERS_FIELD_CODE" => $arParams['LIST_OFFERS_FIELD_CODE'],
		"LIST_OFFERS_PROPERTY_CODE" => $arParams['LIST_OFFERS_PROPERTY_CODE'],
		"LIST_OFFERS_LIMIT" => $arParams['LIST_OFFERS_LIMIT'],
		"LIST_PROPERTY_CODE" => $arParams['LIST_PROPERTY_CODE'],
		
		// catalog.store.amount
		'USE_STORE' => $arParams['USE_STORE'],
		"STORE_PATH" => $arParams['STORE_PATH'],
		"MAIN_TITLE" => $arParams['MAIN_TITLE'],
		"USE_MIN_AMOUNT" =>  $arParams['USE_MIN_AMOUNT'],
		"MIN_AMOUNT" => $arParams['MIN_AMOUNT'],
		"STORES" => $arParams['STORES'],
		"SHOW_EMPTY_STORE" => $arParams['SHOW_EMPTY_STORE'],
		"SHOW_GENERAL_STORE_INFORMATION" => $arParams['SHOW_GENERAL_STORE_INFORMATION'],
		"USER_FIELDS" => $arParams['USER_FIELDS'],
		"FIELDS" => $arParams['FIELDS'],
	),
	$component
);
if($IS_POPUP=='Y'){
	die();
}

$APPLICATION->ShowViewContent('rs_detail-linked_items');

$arRecomData = array();
$recomCacheID = array('IBLOCK_ID' => $arParams['IBLOCK_ID']);
$obCache = new CPHPCache();
if ($obCache->InitCache(36000, serialize($recomCacheID), "/catalog/recommended"))
{
	$arRecomData = $obCache->GetVars();
}
elseif ($obCache->StartDataCache())
{
	if (Bitrix\Main\Loader::includeModule('catalog'))
	{
		$arSKU = CCatalogSKU::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
		$arRecomData['OFFER_IBLOCK_ID'] = (!empty($arSKU) ? $arSKU['IBLOCK_ID'] : 0);
		$arRecomData['IBLOCK_LINK'] = '';
		$arRecomData['ALL_LINK'] = '';
		$rsProps = CIBlockProperty::GetList(
			array('SORT' => 'ASC', 'ID' => 'ASC'),
			array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'PROPERTY_TYPE' => 'E', 'ACTIVE' => 'Y')
		);
		$found = false;
		while ($arProp = $rsProps->Fetch())
		{
			if ($found)
			{
				break;
			}
			if ($arProp['CODE'] == '')
			{
				$arProp['CODE'] = $arProp['ID'];
			}
			$arProp['LINK_IBLOCK_ID'] = intval($arProp['LINK_IBLOCK_ID']);
			if ($arProp['LINK_IBLOCK_ID'] != 0 && $arProp['LINK_IBLOCK_ID'] != $arParams['IBLOCK_ID'])
			{
				continue;
			}
			if ($arProp['LINK_IBLOCK_ID'] > 0)
			{
				if ($arRecomData['IBLOCK_LINK'] == '')
				{
					$arRecomData['IBLOCK_LINK'] = $arProp['CODE'];
					$found = true;
				}
			}
			else
			{
				if ($arRecomData['ALL_LINK'] == '')
				{
					$arRecomData['ALL_LINK'] = $arProp['CODE'];
				}
			}
		}
		if ($found)
		{
			if(defined("BX_COMP_MANAGED_CACHE"))
			{
				global $CACHE_MANAGER;
				$CACHE_MANAGER->StartTagCache("/catalog/recommended");
				$CACHE_MANAGER->RegisterTag("iblock_id_".$arParams['IBLOCK_ID']);
				$CACHE_MANAGER->EndTagCache();
			}
		}
	}
	$obCache->EndDataCache($arRecomData);
}
if (!empty($arRecomData) && ($arRecomData['IBLOCK_LINK'] != '' || $arRecomData['ALL_LINK'] != '')){
	if (Bitrix\Main\ModuleManager::isModuleInstalled('sale') && (!isset($arParams['USE_BIG_DATA']) || $arParams['USE_BIG_DATA'] != 'N')){
		?><div class="clearfix"><?
		?><?$APPLICATION->IncludeComponent("bitrix:catalog.bigdata.products", "al", array(
				"DETAIL_URL" => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
				"BASKET_URL" => $arParams['BASKET_URL'],
				"ACTION_VARIABLE" => (!empty($arParams['ACTION_VARIABLE']) ? $arParams['ACTION_VARIABLE'] : "action")."_cbdp",
				"PRODUCT_ID_VARIABLE" => $arParams['PRODUCT_ID_VARIABLE'],
				"PRODUCT_QUANTITY_VARIABLE" => $arParams['PRODUCT_QUANTITY_VARIABLE'],
				"ADD_PROPERTIES_TO_BASKET" => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
				"PRODUCT_PROPS_VARIABLE" => $arParams['PRODUCT_PROPS_VARIABLE'],
				"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
				"SHOW_OLD_PRICE" => $arParams['SHOW_OLD_PRICE'],
				"SHOW_DISCOUNT_PERCENT" => $arParams['SHOW_DISCOUNT_PERCENT'],
				"PRICE_CODE" => $arParams['PRICE_CODE'],
				"SHOW_PRICE_COUNT" => $arParams['SHOW_PRICE_COUNT'],
				"PRODUCT_SUBSCRIPTION" => $arParams['PRODUCT_SUBSCRIPTION'],
				"PRICE_VAT_INCLUDE" => $arParams['PRICE_VAT_INCLUDE'],
				"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
				"SHOW_NAME" => "Y",
				"SHOW_IMAGE" => "Y",
				"MESS_BTN_BUY" => $arParams['MESS_BTN_BUY'],
				"MESS_BTN_DETAIL" => $arParams['MESS_BTN_DETAIL'],
				"MESS_BTN_SUBSCRIBE" => $arParams['MESS_BTN_SUBSCRIBE'],
				"MESS_NOT_AVAILABLE" => $arParams['MESS_NOT_AVAILABLE'],
				"PAGE_ELEMENT_COUNT" => 5,
				"SHOW_FROM_SECTION" => "N",
				"IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
				"IBLOCK_ID" => $arParams['IBLOCK_ID'],
				"DEPTH" => "2",
				"CACHE_TYPE" => $arParams['CACHE_TYPE'],
				"CACHE_TIME" => $arParams['CACHE_TIME'],
				"CACHE_GROUPS" => $arParams['CACHE_GROUPS'],
				"SHOW_PRODUCTS_".$arParams['IBLOCK_ID'] => "Y",
				"ADDITIONAL_PICT_PROP_".$arParams['IBLOCK_ID'] => $arParams['PROPCODE_MORE_PHOTO'],
				"MAKER_PROP_".$arParams['IBLOCK_ID'] => $arParams['PROPCODE_MAKER'],
				"ICON_NOVELTY_PROP_".$arParams['IBLOCK_ID'] => $arParams['PROP_NEW_ICON'],
				"ICON_DEALS_PROP_".$arParams['IBLOCK_ID'] => $arParams['PROP_ACTION_ICON'],
				"ICON_DISCOUNT_PROP_".$arParams['IBLOCK_ID'] => $arParams['PROP_DISCOUNT_ICON'],
				"ICON_MEN_PROP_".$arParams['IBLOCK_ID'] => $arParams['PROP_CODE_MEN'],
				"ICON_WOMEN_PROP_".$arParams['IBLOCK_ID'] => $arParams['PROP_CODE_WOMEN'],
				//"LABEL_PROP_".$arParams['IBLOCK_ID'] => "-",
				"HIDE_NOT_AVAILABLE" => $arParams['HIDE_NOT_AVAILABLE'],
				"CONVERT_CURRENCY" => $arParams['CONVERT_CURRENCY'],
				"CURRENCY_ID" => $arParams['CURRENCY_ID'],
				"SECTION_ID" => $arResult['VARIABLES']['SECTION_ID'],
				"SECTION_CODE" => $arResult['VARIABLES']['SECTION_CODE'],
				"SECTION_ELEMENT_ID" => $arResult['VARIABLES']['SECTION_ID'],
				"SECTION_ELEMENT_CODE" => $arResult['VARIABLES']['SECTION_CODE'],
				"ID" => $ElementID,
				"PROPERTY_CODE_".$arParams['IBLOCK_ID'] => $arParams['LIST_PROPERTY_CODE'],
				"CART_PROPERTIES_".$arParams['IBLOCK_ID'] => $arParams['PRODUCT_PROPERTIES'],
				"RCM_TYPE" => (isset($arParams['BIG_DATA_RCM_TYPE']) ? $arParams['BIG_DATA_RCM_TYPE'] : ''),
				"OFFER_TREE_PROPS_".$arRecomData['OFFER_IBLOCK_ID'] => $arParams['OFFER_TREE_PROPS'],
				"OFFER_TREE_COLOR_PROPS_".$arRecomData['OFFER_IBLOCK_ID'] => $arParams['OFFER_TREE_COLOR_PROPS'],
				"ADDITIONAL_PICT_PROP_".$arRecomData['OFFER_IBLOCK_ID'] => $arParams['PROPCODE_SKU_MORE_PHOTO'],
				'USE_DELETE' => $arParams['USE_DELETE'],
				'USE_LIKES' => $arParams['USE_LIKES'],
				'USE_SHARE_BUTTONS' => $arParams['USE_SHARE_BUTTONS'],
				'POPUP_DETAIL_VARIABLE' => $arParams['POPUP_DETAIL_VARIABLE'],
				'COMPOSITE_MODE_REQUEST' => 'N',
			),
			$component
		);
		?></div><?
	}
}

if($arParams['USE_ALSO_BUY'] == 'Y' && Bitrix\Main\ModuleManager::isModuleInstalled('sale') && !empty($arRecomData)){
	?><div class="clearfix"><?
	?><?$APPLICATION->IncludeComponent("bitrix:sale.recommended.products", "al", array(
		"ID" => $ElementID,
		"MIN_BUYES" => $arParams['ALSO_BUY_MIN_BUYES'],
		"ELEMENT_COUNT" => $arParams['ALSO_BUY_ELEMENT_COUNT'],
		"LINE_ELEMENT_COUNT" => $arParams['ALSO_BUY_ELEMENT_COUNT'],
		"DETAIL_URL" => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
		"BASKET_URL" => $arParams['BASKET_URL'],
		"ACTION_VARIABLE" => $arParams['ACTION_VARIABLE'],
		"PRODUCT_ID_VARIABLE" => $arParams['PRODUCT_ID_VARIABLE'],
		"SECTION_ID_VARIABLE" => $arParams['SECTION_ID_VARIABLE'],
		"PAGE_ELEMENT_COUNT" => $arParams['ALSO_BUY_ELEMENT_COUNT'],
		"CACHE_TYPE" => $arParams['CACHE_TYPE'],
		"CACHE_TIME" => $arParams['CACHE_TIME'],
		"PRICE_CODE" => $arParams['PRICE_CODE'],
		"USE_PRICE_COUNT" => $arParams['USE_PRICE_COUNT'],
		"SHOW_PRICE_COUNT" => $arParams['SHOW_PRICE_COUNT'],
		"PRICE_VAT_INCLUDE" => $arParams['PRICE_VAT_INCLUDE'],
		'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
		'CURRENCY_ID' => $arParams['CURRENCY_ID'],
		'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
		"SHOW_PRODUCTS_".$arParams['IBLOCK_ID'] => "Y",
		"PROPERTY_CODE_".$arParams['IBLOCK_ID'] => $arParams['LIST_PROPERTY_CODE'],
		"ADDITIONAL_PICT_PROP_".$arParams['IBLOCK_ID'] => $arParams['PROPCODE_MORE_PHOTO'],
		"MAKER_PROP_".$arParams['IBLOCK_ID'] => $arParams['PROPCODE_MAKER'],
		"ICON_NOVELTY_PROP_".$arParams['IBLOCK_ID'] => $arParams['PROP_NEW_ICON'],
		"ICON_DEALS_PROP_".$arParams['IBLOCK_ID'] => $arParams['PROP_ACTION_ICON'],
		"ICON_DISCOUNT_PROP_".$arParams['IBLOCK_ID'] => $arParams['PROP_DISCOUNT_ICON'],
		"ICON_MEN_PROP_".$arParams['IBLOCK_ID'] => $arParams['PROP_CODE_MEN'],
		"ICON_WOMEN_PROP_".$arParams['IBLOCK_ID'] => $arParams['PROP_CODE_WOMEN'],
		"OFFER_TREE_PROPS_".$arRecomData['OFFER_IBLOCK_ID'] => $arParams['OFFER_TREE_PROPS'],
		"OFFER_TREE_COLOR_PROPS_".$arRecomData['OFFER_IBLOCK_ID'] => $arParams['OFFER_TREE_COLOR_PROPS'],
		"ADDITIONAL_PICT_PROP_".$arRecomData['OFFER_IBLOCK_ID'] => $arParams['PROPCODE_SKU_MORE_PHOTO'],
		'USE_DELETE' => $arParams['USE_DELETE'],
		'USE_LIKES' => $arParams['USE_LIKES'],
		'USE_SHARE_BUTTONS' => $arParams['USE_SHARE_BUTTONS'],
		'POPUP_DETAIL_VARIABLE' => $arParams['POPUP_DETAIL_VARIABLE'],
		'COMPOSITE_MODE_REQUEST' => 'N',
		),
		$component
	);
	?></div><?
}
?><div class="clearfix"><?
$APPLICATION->IncludeComponent(
	"bitrix:catalog.viewed.products", 
	"al", 
	array(
		"DETAIL_URL" => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
		"BASKET_URL" => $arParams['BASKET_URL'],
		"ACTION_VARIABLE" => (!empty($arParams['ACTION_VARIABLE']) ? $arParams['ACTION_VARIABLE'] : "action")."_cbdp",
		"PRODUCT_ID_VARIABLE" => $arParams['PRODUCT_ID_VARIABLE'],
		"PRODUCT_QUANTITY_VARIABLE" => $arParams['PRODUCT_QUANTITY_VARIABLE'],
		"ADD_PROPERTIES_TO_BASKET" => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
		"PRODUCT_PROPS_VARIABLE" => $arParams['PRODUCT_PROPS_VARIABLE'],
		"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
		"SHOW_OLD_PRICE" => $arParams['SHOW_OLD_PRICE'],
		"SHOW_DISCOUNT_PERCENT" => $arParams['SHOW_DISCOUNT_PERCENT'],
		"PRICE_CODE" => $arParams['PRICE_CODE'],
		"SHOW_PRICE_COUNT" => $arParams['SHOW_PRICE_COUNT'],
		"PRODUCT_SUBSCRIPTION" => $arParams['PRODUCT_SUBSCRIPTION'],
		"PRICE_VAT_INCLUDE" => $arParams['PRICE_VAT_INCLUDE'],
		"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
		"SHOW_NAME" => "Y",
		"SHOW_IMAGE" => "Y",
		"MESS_BTN_BUY" => $arParams['MESS_BTN_BUY'],
		"MESS_BTN_DETAIL" => $arParams['MESS_BTN_DETAIL'],
		"MESS_BTN_SUBSCRIBE" => $arParams['MESS_BTN_SUBSCRIBE'],
		"MESS_NOT_AVAILABLE" => $arParams['MESS_NOT_AVAILABLE'],
		"PAGE_ELEMENT_COUNT" => 5,
		"SHOW_FROM_SECTION" => "N",
		"IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
		"IBLOCK_ID" => $arParams['IBLOCK_ID'],
		"DEPTH" => "2",
		"CACHE_TYPE" => $arParams['CACHE_TYPE'],
		"CACHE_TIME" => $arParams['CACHE_TIME'],
		"CACHE_GROUPS" => $arParams['CACHE_GROUPS'],
		"SHOW_PRODUCTS_".$arParams['IBLOCK_ID'] => "Y",
		"ADDITIONAL_PICT_PROP_".$arParams['IBLOCK_ID'] => $arParams['PROPCODE_MORE_PHOTO'],
		//"LABEL_PROP_".$arParams['IBLOCK_ID'] => "-",
		"MAKER_PROP_".$arParams['IBLOCK_ID'] => $arParams['PROPCODE_MAKER'],
		"ICON_NOVELTY_PROP_".$arParams['IBLOCK_ID'] => $arParams['PROP_NEW_ICON'],
		"ICON_DEALS_PROP_".$arParams['IBLOCK_ID'] => $arParams['PROP_ACTION_ICON'],
		"ICON_DISCOUNT_PROP_".$arParams['IBLOCK_ID'] => $arParams['PROP_DISCOUNT_ICON'],
		"ICON_MEN_PROP_".$arParams['IBLOCK_ID'] => $arParams['PROP_CODE_MEN'],
		"ICON_WOMEN_PROP_".$arParams['IBLOCK_ID'] => $arParams['PROP_CODE_WOMEN'],
		
		"HIDE_NOT_AVAILABLE" => $arParams['HIDE_NOT_AVAILABLE'],
		"CONVERT_CURRENCY" => $arParams['CONVERT_CURRENCY'],
		"CURRENCY_ID" => $arParams['CURRENCY_ID'],
		"SECTION_ID" => $arResult['VARIABLES']['SECTION_ID'],
		"SECTION_CODE" => $arResult['VARIABLES']['SECTION_CODE'],
		"SECTION_ELEMENT_ID" => $arResult['VARIABLES']['SECTION_ID'],
		"SECTION_ELEMENT_CODE" => $arResult['VARIABLES']['SECTION_CODE'],
		"ID" => $ElementID,
		"PROPERTY_CODE_".$arParams['IBLOCK_ID'] => $arParams['LIST_PROPERTY_CODE'],
		"CART_PROPERTIES_".$arParams['IBLOCK_ID'] => $arParams['PRODUCT_PROPERTIES'],
		"OFFER_TREE_PROPS_".$arRecomData['OFFER_IBLOCK_ID'] => $arParams['OFFER_TREE_PROPS'],
		"OFFER_TREE_COLOR_PROPS_".$arRecomData['OFFER_IBLOCK_ID'] => $arParams['OFFER_TREE_COLOR_PROPS'],
		"ADDITIONAL_PICT_PROP_".$arRecomData['OFFER_IBLOCK_ID'] => $arParams['PROPCODE_SKU_MORE_PHOTO'],
		"DEPTH" => "2",
		'USE_DELETE' => $arParams['USE_DELETE'],
		'USE_LIKES' => $arParams['USE_LIKES'],
		'USE_SHARE_BUTTONS' => $arParams['USE_SHARE_BUTTONS'],
		'POPUP_DETAIL_VARIABLE' => $arParams['POPUP_DETAIL_VARIABLE'],
		'COMPOSITE_MODE_REQUEST' => 'N',
	),
	$component
);
?></div><?