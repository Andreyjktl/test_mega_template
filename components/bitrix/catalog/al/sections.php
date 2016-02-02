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

?><div class="clear"></div><?
if ('get_element_json' == $_REQUEST['ajax_action']) {// get element json
	global $APPLICATION,$JSON;
	$APPLICATION->RestartBuffer();
	$ELEMENT_ID = IntVal( $_REQUEST['element_id'] );
	if ($ELEMENT_ID < 1) {
		$arJson = array( 'TYPE' => 'ERROR', 'MESSAGE' => 'Element id is empty' );
		echo json_encode($arJson);
		die();
	}
	$ElementID=$APPLICATION->IncludeComponent(
		'bitrix:catalog.element',
		'json',
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
			'ELEMENT_ID' => $ELEMENT_ID,
			'ELEMENT_CODE' => '',
			'SECTION_ID' => '',
			'SECTION_CODE' => '',
			'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
			'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
			'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
			'CURRENCY_ID' => $arParams['CURRENCY_ID'],
			'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
			'USE_ELEMENT_COUNTER' => $arParams['USE_ELEMENT_COUNTER'],
			
			'PROPCODE_MORE_PHOTO' => $arParams['PROPCODE_MORE_PHOTO'],
			'PROPCODE_SKU_MORE_PHOTO' => $arParams['PROPCODE_SKU_MORE_PHOTO'],
			'PROPCODE_ARTIKUL' => $arParams['PROPCODE_ARTIKUL'],
			'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
			'OFFER_TREE_COLOR_PROPS' => $arParams['OFFER_TREE_COLOR_PROPS'],
			'OFFER_TREE_BTN_PROPS' => $arParams['OFFER_TREE_BTN_PROPS'],
			
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
		$component,
		array('HIDE_ICONS' => 'Y')
	);
	$APPLICATION->RestartBuffer();
	if (SITE_CHARSET != 'utf-8') {
		$data = $APPLICATION->ConvertCharsetArray($JSON, SITE_CHARSET, 'utf-8');
		$json_str_utf = json_encode($data);
		$json_str = $APPLICATION->ConvertCharset($json_str_utf, 'utf-8', SITE_CHARSET);
		echo $json_str;
	}
	else {
		echo json_encode($JSON);
	}
	die();
}
elseif ('add2basket' == $_REQUEST['ajax_action']) {
	// +++++++++++++++++++++++++++++++ add2basket +++++++++++++++++++++++++++++++ //
		$APPLICATION->RestartBuffer();
	$APPLICATION->IncludeComponent(
		'bitrix:catalog.section',
		'catalog',
		Array(
			'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
			'IBLOCK_ID' => $arParams['IBLOCK_ID'],
			'ELEMENT_SORT_FIELD' => $arParams['ELEMENT_SORT_FIELD'],
			'ELEMENT_SORT_ORDER' => $arParams['ELEMENT_SORT_ORDER'],
			'ELEMENT_SORT_FIELD2' => $arParams['ELEMENT_SORT_FIELD2'],
			'ELEMENT_SORT_ORDER2' => $arParams['ELEMENT_SORT_ORDER2'],
			'PROPERTY_CODE' => $arParams['LIST_PROPERTY_CODE'],
			'META_KEYWORDS' => $arParams['LIST_META_KEYWORDS'],
			'META_DESCRIPTION' => $arParams['LIST_META_DESCRIPTION'],
			'BROWSER_TITLE' => $arParams['LIST_BROWSER_TITLE'],
			'INCLUDE_SUBSECTIONS' => $arParams['INCLUDE_SUBSECTIONS'],
			'BASKET_URL' => $arParams['BASKET_URL'],
			'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
			'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
			'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],
			'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
			'FILTER_NAME' => $arParams['FILTER_NAME'],
			'CACHE_TYPE' => $arParams['CACHE_TYPE'],
			'CACHE_TIME' => $arParams['CACHE_TIME'],
			'CACHE_FILTER' => $arParams['CACHE_FILTER'],
			'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
			'SET_TITLE' => $arParams['SET_TITLE'],
			'SET_STATUS_404' => $arParams['SET_STATUS_404'],
			'DISPLAY_COMPARE' => $arParams['USE_COMPARE'],
			'PAGE_ELEMENT_COUNT' => $arParams['PAGE_ELEMENT_COUNT'],
			'LINE_ELEMENT_COUNT' => $arParams['LINE_ELEMENT_COUNT'],
			'PRICE_CODE' => $arParams['PRICE_CODE'],
			'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
			'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
			'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
			'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
			'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
			'QUANTITY_FLOAT' => $arParams['QUANTITY_FLOAT'],
			'PRODUCT_PROPERTIES' => $arParams['PRODUCT_PROPERTIES'],
			'DISPLAY_TOP_PAGER' => $arParams['DISPLAY_TOP_PAGER'],
			'DISPLAY_BOTTOM_PAGER' => $arParams['DISPLAY_BOTTOM_PAGER'],
			'PAGER_TITLE' => $arParams['PAGER_TITLE'],
			'PAGER_SHOW_ALWAYS' => $arParams['PAGER_SHOW_ALWAYS'],
			'PAGER_TEMPLATE' => $arParams['PAGER_TEMPLATE'],
			'PAGER_DESC_NUMBERING' => $arParams['PAGER_DESC_NUMBERING'],
			'PAGER_DESC_NUMBERING_CACHE_TIME' => $arParams['PAGER_DESC_NUMBERING_CACHE_TIME'],
			'PAGER_SHOW_ALL' => $arParams['PAGER_SHOW_ALL'],
			'OFFERS_CART_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],
			'OFFERS_FIELD_CODE' => $arParams['LIST_OFFERS_FIELD_CODE'],
			'OFFERS_PROPERTY_CODE' => $arParams['LIST_OFFERS_PROPERTY_CODE'],
			'OFFERS_SORT_FIELD' => $arParams['OFFERS_SORT_FIELD'],
			'OFFERS_SORT_ORDER' => $arParams['OFFERS_SORT_ORDER'],
			'OFFERS_SORT_FIELD2' => $arParams['OFFERS_SORT_FIELD2'],
			'OFFERS_SORT_ORDER2' => $arParams['OFFERS_SORT_ORDER2'],
			'OFFERS_LIMIT' => $arParams['LIST_OFFERS_LIMIT'],
			'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
			'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
			'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
			'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
			'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
			'CURRENCY_ID' => $arParams['CURRENCY_ID'],
			'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
			'IS_AJAXPAGES' => $IS_AJAXPAGES,
			'AJAXPAGESID' => $arParams['AJAXPAGESID'],
			'USE_AJAXPAGES' => $arParams['USE_AJAXPAGES'],
			'PROP_CODE_MEN' => $arParams['PROP_CODE_MEN'],
			'PROP_CODE_WOMEN' => $arParams['PROP_CODE_WOMEN'],
			'PROP_NEW_ICON' => $arParams['PROP_NEW_ICON'],
			'PROP_DISCOUNT_ICON' => $arParams['PROP_DISCOUNT_ICON'],
			'PROP_ACTION_ICON' => $arParams['PROP_ACTION_ICON'],
			'USE_DELETE' => $arParams['USE_DELETE'],
			'USE_LIKES' => $arParams['USE_LIKES'],
			'USE_SHARE_BUTTONS' => $arParams['USE_SHARE_BUTTONS'],
			'PROPCODE_MORE_PHOTO' => $arParams['PROPCODE_MORE_PHOTO'],
			'PROPCODE_SKU_MORE_PHOTO' => $arParams['PROPCODE_SKU_MORE_PHOTO'],
			'PROPCODE_MAKER_LOGO' => $arParams['PROPCODE_MAKER_LOGO'],
			'PROPCODE_MAKER' => $arParams['PROPCODE_MAKER'],
			'POPUP_DETAIL_VARIABLE' => $arParams['POPUP_DETAIL_VARIABLE'],
			'ERROR_EMPTY_ITEMS' => $arParams['ERROR_EMPTY_ITEMS'],
			'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
			'OFFER_TREE_COLOR_PROPS' => $arParams['OFFER_TREE_COLOR_PROPS'],
			'OFFER_TREE_BTN_PROPS' => $arParams['OFFER_TREE_BTN_PROPS'],
		),
		$component,
		array('HIDE_ICONS' => 'Y')
	);
	$APPLICATION->RestartBuffer();
	global $APPLICATION, $JSON;
	$APPLICATION->IncludeComponent('bitrix:sale.basket.basket.small','json',array());
	$APPLICATION->RestartBuffer();
	if (SITE_CHARSET != 'utf-8') {
		$data = $APPLICATION->ConvertCharsetArray($JSON, SITE_CHARSET, 'utf-8');
		$json_str_utf = json_encode($data);
		$json_str = $APPLICATION->ConvertCharset($json_str_utf, 'utf-8', SITE_CHARSET);
		echo $json_str;
	}
	else{
		echo json_encode($JSON);
	}
	die();
}
elseif ('add2compare' == $_REQUEST['ajax_action']) {
	// +++++++++++++++++++++++++++++++ add2compare +++++++++++++++++++++++++++++++ //
	$APPLICATION->RestartBuffer();
	if ('Y' == $arParams['USE_COMPARE']) {
		$APPLICATION->IncludeComponent(
			'bitrix:catalog.compare.list',
			'al',
			Array(
				'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
				'IBLOCK_ID' => $arParams['IBLOCK_ID'],
				'NAME' => $arParams['COMPARE_NAME'],
				'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
				'COMPARE_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
				'IS_AJAX_REQUEST' => 'Y',
			),
			$component,
			array('HIDE_ICONS' => 'Y')
		);
	}
	die();
}
else {
// +++++++++++++++++++++++++++++++ simple +++++++++++++++++++++++++++++++ //
?><!-- catalog --><?
?><div class="around_catalog"><?
	?><div class="catalog_sidebar"><?
		?><div class="catalog_sidebar_inner"><?
		$APPLICATION->IncludeComponent(
			'bitrix:catalog.section.list',
			'catalog',
			Array(
				'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
				'IBLOCK_ID' => $arParams['IBLOCK_ID'],
				'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
				'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
				'CACHE_TYPE' => $arParams['CACHE_TYPE'],
				'CACHE_TIME' => $arParams['CACHE_TIME'],
				'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
				'COUNT_ELEMENTS' => $arParams['SECTION_COUNT_ELEMENTS'],
				'TOP_DEPTH' => '2',
				'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
				'SHOW_SECTION_PICTURE' => $arParams['SHOW_SECTION_PICTURE'],
				'SECTION_PICTURE_WIDTH' => $arParams['SECTION_PICTURE_WIDTH'],
				'SECTION_PICTURE_HEIGHT' => $arParams['SECTION_PICTURE_HEIGHT']
			),
			$component
		);
		if ($arParams['USE_FILTER'] == 'Y'){
			?><?$APPLICATION->IncludeComponent(
				"bitrix:catalog.smart.filter",
				"al",
				array(
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"SECTION_ID" => $arCurSection['ID'],
					"FILTER_NAME" => $arParams["FILTER_NAME"],
					"PRICE_CODE" => $arParams["FILTER_PRICE_CODE"],
					"CACHE_TYPE" => $arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
					"SAVE_IN_SESSION" => "N",
					"FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
					"XML_EXPORT" => "Y",
					"SECTION_TITLE" => "NAME",
					"SECTION_DESCRIPTION" => "DESCRIPTION",
					'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
					
					'FILTER_PRICE_GROUPED' => $arParams['FILTER_PRICE_GROUPED'],
					'FILTER_PRICE_GROUPED_FOR' => $arParams['FILTER_PRICE_GROUPED_FOR'],
					'FILTER_SCROLL_PROPS' => $arParams['FILTER_SCROLL_PROPS'],
					'OFFER_FILTER_SCROLL_PROPS' => $arParams['OFFER_FILTER_SCROLL_PROPS'],
					'FILTER_SEARCH_PROPS' => $arParams['FILTER_SEARCH_PROPS'],
					'OFFER_FILTER_SEARCH_PROPS' => $arParams['OFFER_FILTER_SEARCH_PROPS'],
					'OFFER_TREE_COLOR_PROPS' => $arParams['OFFER_TREE_COLOR_PROPS'],
					'OFFER_TREE_BTN_PROPS' => $arParams['OFFER_TREE_BTN_PROPS'],
				),
				$component,
				array('HIDE_ICONS' => 'Y')
			);?><?
		}
		?></div><?
	?></div><?
	?><div class="catalog context-wrap"><?
		?><div class="catalog_section_description clearfix"><?
			?><h1><?$APPLICATION->ShowTitle(false)?></h1><?
			$APPLICATION->ShowViewContent('catalog_section_description');
		?></div><?
		$APPLICATION->ShowViewContent('smart_filter_chosed');
?><!-- sorted and navigation --><?
?><div class="around_sorter_and_navigation"><?
$APPLICATION->ShowViewContent('paginator');
global $alfaCTemplate, $alfaCSortType, $alfaCSortToo, $alfaCOutput;
$APPLICATION->IncludeComponent(
	"redsign:catalog.sorter",
	"catalog",
	Array(
		"ALFA_ACTION_PARAM_NAME" => "alfaction",
		"ALFA_ACTION_PARAM_VALUE" => "alfavalue",
		"ALFA_CHOSE_TEMPLATES_SHOW" => "N",
		"ALFA_DEFAULT_TEMPLATE" => "catalog_blocks",
		"ALFA_SORT_BY_SHOW" => "Y",
		"ALFA_SORT_BY_NAME" => array(
			0 => "sort",
			1 => "name",
			2 => "PROPERTY_PROD_PRICE_FALSE",
			3 => "",
		),
		"ALFA_SORT_BY_DEFAULT" => "sort_asc",
		"ALFA_OUTPUT_OF_SHOW" => "Y",
		"ALFA_OUTPUT_OF" => array(
			0 => "20",
			1 => "16",
			2 => "40",
			3 => "80",
			4 => "",
		),
		"ALFA_OUTPUT_OF_DEFAULT" => "16",
		"ALFA_OUTPUT_OF_SHOW_ALL" => "N",
		"ALFA_SHORT_SORTER" => "N"
	),
	null
);
?></div><?
?><!-- /sorted and navigation --><?
		?><div class="catalog_inner"><?
?><div id="<? echo $arParams['AJAXPAGESID']; ?>" class="clearfix"><?
$IS_AJAXPAGES = 'N';
if('Y' == $_REQUEST['ajaxpages'] && $arParams['AJAXPAGESID'] == $_REQUEST['ajaxpagesid']){
	$APPLICATION->RestartBuffer();
	$IS_AJAXPAGES = 'Y';
}
$APPLICATION->IncludeComponent(
	'bitrix:catalog.section',
	'catalog',
	Array(
		'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
		'IBLOCK_ID' => $arParams['IBLOCK_ID'],
		'ELEMENT_SORT_FIELD' => $alfaCSortType,//$arParams['ELEMENT_SORT_FIELD'],
		'ELEMENT_SORT_ORDER' => $alfaCSortToo,//$arParams['ELEMENT_SORT_ORDER'],
		'ELEMENT_SORT_FIELD2' => $arParams['ELEMENT_SORT_FIELD2'],
		'ELEMENT_SORT_ORDER2' => $arParams['ELEMENT_SORT_ORDER2'],
		'PROPERTY_CODE' => $arParams['LIST_PROPERTY_CODE'],
		'META_KEYWORDS' => $arParams['LIST_META_KEYWORDS'],
		'META_DESCRIPTION' => $arParams['LIST_META_DESCRIPTION'],
		'BROWSER_TITLE' => $arParams['LIST_BROWSER_TITLE'],
		'INCLUDE_SUBSECTIONS' => $arParams['INCLUDE_SUBSECTIONS'],
		'BASKET_URL' => $arParams['BASKET_URL'],
		'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
		'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
		'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],
		'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
		'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
		'FILTER_NAME' => $arParams['FILTER_NAME'],
		'CACHE_TYPE' => $arParams['CACHE_TYPE'],
		'CACHE_TIME' => $arParams['CACHE_TIME'],
		'CACHE_FILTER' => $arParams['CACHE_FILTER'],
		'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
		'SET_TITLE' => $arParams['SET_TITLE'],
		'SET_STATUS_404' => $arParams['SET_STATUS_404'],
		'DISPLAY_COMPARE' => $arParams['USE_COMPARE'],
		'PAGE_ELEMENT_COUNT' => $alfaCOutput,//$arParams['PAGE_ELEMENT_COUNT'],
		'LINE_ELEMENT_COUNT' => $arParams['LINE_ELEMENT_COUNT'],
		'PRICE_CODE' => $arParams['PRICE_CODE'],
		'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
		'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
		'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
		'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
		'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
		'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
		'QUANTITY_FLOAT' => $arParams['QUANTITY_FLOAT'],
		'PRODUCT_PROPERTIES' => $arParams['PRODUCT_PROPERTIES'],
		'DISPLAY_TOP_PAGER' => $arParams['DISPLAY_TOP_PAGER'],
		'DISPLAY_BOTTOM_PAGER' => $arParams['DISPLAY_BOTTOM_PAGER'],
		'PAGER_TITLE' => $arParams['PAGER_TITLE'],
		'PAGER_SHOW_ALWAYS' => $arParams['PAGER_SHOW_ALWAYS'],
		'PAGER_TEMPLATE' => $arParams['PAGER_TEMPLATE'],
		'PAGER_DESC_NUMBERING' => $arParams['PAGER_DESC_NUMBERING'],
		'PAGER_DESC_NUMBERING_CACHE_TIME' => $arParams['PAGER_DESC_NUMBERING_CACHE_TIME'],
		'PAGER_SHOW_ALL' => $arParams['PAGER_SHOW_ALL'],
		'OFFERS_CART_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],
		'OFFERS_FIELD_CODE' => $arParams['LIST_OFFERS_FIELD_CODE'],
		'OFFERS_PROPERTY_CODE' => $arParams['LIST_OFFERS_PROPERTY_CODE'],
		'OFFERS_SORT_FIELD' => $arParams['OFFERS_SORT_FIELD'],
		'OFFERS_SORT_ORDER' => $arParams['OFFERS_SORT_ORDER'],
		'OFFERS_SORT_FIELD2' => $arParams['OFFERS_SORT_FIELD2'],
		'OFFERS_SORT_ORDER2' => $arParams['OFFERS_SORT_ORDER2'],
		'OFFERS_LIMIT' => $arParams['LIST_OFFERS_LIMIT'],
		'SECTION_ID' => '',
		'SECTION_CODE' => '',
		'SECTION_URL' => '',
		'DETAIL_URL' => '',
		'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
		'CURRENCY_ID' => $arParams['CURRENCY_ID'],
		'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
		'IS_AJAXPAGES' => $IS_AJAXPAGES,
		'AJAXPAGESID' => $arParams['AJAXPAGESID'],
		'USE_AJAXPAGES' => $arParams['USE_AJAXPAGES'],
		'PROP_CODE_MEN' => $arParams['PROP_CODE_MEN'],
		'PROP_CODE_WOMEN' => $arParams['PROP_CODE_WOMEN'],
		'PROP_NEW_ICON' => $arParams['PROP_NEW_ICON'],
		'PROP_DISCOUNT_ICON' => $arParams['PROP_DISCOUNT_ICON'],
		'PROP_ACTION_ICON' => $arParams['PROP_ACTION_ICON'],
		'USE_DELETE' => $arParams['USE_DELETE'],
		'USE_LIKES' => $arParams['USE_LIKES'],
		'USE_SHARE_BUTTONS' => $arParams['USE_SHARE_BUTTONS'],
		'PROPCODE_MORE_PHOTO' => $arParams['PROPCODE_MORE_PHOTO'],
		'PROPCODE_SKU_MORE_PHOTO' => $arParams['PROPCODE_SKU_MORE_PHOTO'],
		'PROPCODE_MAKER_LOGO' => $arParams['PROPCODE_MAKER_LOGO'],
		'PROPCODE_MAKER' => $arParams['PROPCODE_MAKER'],
		'PROPCODE_ACCESSORIES' => $arParams['PROPCODE_ACCESSORIES'],
		'ERROR_EMPTY_ITEMS' => $arParams['ERROR_EMPTY_ITEMS'],
		'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
		'OFFER_TREE_COLOR_PROPS' => $arParams['OFFER_TREE_COLOR_PROPS'],
		'OFFER_TREE_BTN_PROPS' => $arParams['OFFER_TREE_BTN_PROPS'],
		
	),
	$component
);
if('Y' == $IS_AJAXPAGES){
	die();
}
?></div><?
		?></div><?
	?></div><?
?></div><!-- /catalog --><?
}