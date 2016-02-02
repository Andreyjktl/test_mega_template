<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

?><div class="clear"></div><?
global $alfaCTemplate, $alfaCSortType, $alfaCSortToo, $alfaCOutput;
$this->SetViewTarget('sorter');
$APPLICATION->IncludeComponent(
	'redsign:catalog.sorter',
	'catalog',
	Array(
		'ALFA_ACTION_PARAM_NAME' => 'alfaction',
		'ALFA_ACTION_PARAM_VALUE' => 'alfavalue',
		'ALFA_CHOSE_TEMPLATES_SHOW' => 'N',
		'ALFA_DEFAULT_TEMPLATE' => 'catalog_blocks',
		'ALFA_SORT_BY_SHOW' => 'Y',
		'ALFA_SORT_BY_NAME' => array(0=>'sort',1=>'name',2=>'PROPERTY_PROD_PRICE_FALSE',),
		'ALFA_SORT_BY_DEFAULT' => 'sort_asc',
		'ALFA_OUTPUT_OF_SHOW' => 'Y',
		'ALFA_OUTPUT_OF' => array(0=>'16',1=>'20',2=>'40',3=>'80',4=>'',),
		'ALFA_OUTPUT_OF_DEFAULT' => '16',
		'ALFA_OUTPUT_OF_SHOW_ALL' => 'N',
	),
	$component
);
$this->EndViewTarget();
$arElements = $APPLICATION->IncludeComponent(
	'bitrix:search.page',
	'catalog',
	Array(
		'RESTART' => 'N',
		'NO_WORD_LOGIC' => 'N',
		'CHECK_DATES' => 'Y',
		'USE_TITLE_RANK' => 'N',
		'DEFAULT_SORT' => 'rank',
		'FILTER_NAME' => '',
		'arrFILTER' => array(),
		'SHOW_WHERE' => 'N',
		'SHOW_WHEN' => 'N',
		'PAGE_RESULT_COUNT' => '500',
		'AJAX_MODE' => 'N',
		'AJAX_OPTION_JUMP' => 'N',
		'AJAX_OPTION_STYLE' => 'Y',
		'AJAX_OPTION_HISTORY' => 'N',
		'CACHE_TYPE' => 'A',
		'CACHE_TIME' => '3600',
		'DISPLAY_TOP_PAGER' => 'Y',
		'DISPLAY_BOTTOM_PAGER' => 'Y',
		'PAGER_TITLE' => 'Результаты поиска',
		'PAGER_SHOW_ALWAYS' => 'N',
		'PAGER_TEMPLATE' => 'al',
		'USE_LANGUAGE_GUESS' => 'N',
		'USE_SUGGEST' => 'N',
		'AJAX_OPTION_ADDITIONAL' => '',
		'CATALOG_IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
		'CATALOG_IBLOCK_ID' => $arParams['IBLOCK_ID'],
		'COUNT_RESULT_NOT_CATALOG' => $arParams['COUNT_RESULT_NOT_CATALOG'],
	),
	$component
);
global $arrFilter;
$arrFilter = array(
	'=ID' => $arElements,
);
?><!-- around_catalog --><?
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
	),
	$component
);


if($arParams['USE_FILTER']=='Y')
{
	$APPLICATION->IncludeComponent(
		'bitrix:catalog.smart.filter',
		'catalog',
		Array(
			'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
			'IBLOCK_ID' => $arParams['IBLOCK_ID'],
			'SECTION_ID' => false,
			'FILTER_NAME' => 'arrFilter',
			'PRICE_CODE' => $arParams['PRICE_CODE'],
			'CACHE_TYPE' => 'A',
			'CACHE_TIME' => '36000000',
			'CACHE_NOTES' => '',
			'CACHE_GROUPS' => 'Y',
			'SAVE_IN_SESSION' => 'N'
		),
		$component
	);
}

		?></div><?
	?></div><?
	?><!-- catalog --><?
	?><div class="catalog context-wrap"><?
		$APPLICATION->ShowViewContent('catalog_section_description');
		$APPLICATION->ShowViewContent('smart_filter_chosed');
if(is_array($arElements) && count($arElements)>0):
?><!-- sorted and navigation --><?
?><div class="around_sorter_and_navigation"><?
$APPLICATION->ShowViewContent('paginator');
$APPLICATION->ShowViewContent('sorter');
?><div class="clear"></div><?
?></div><?
?><!-- /sorted and navigation --><?
		?><div class="catalog_inner"><?
?><div id="ajaxpages_catalog_identifier_search"><?
$IS_AJAXPAGES = 'N';
if($_REQUEST['ajaxpages']=='Y' && $_REQUEST['ajaxpagesid']=='ajaxpages_catalog_identifier_search')
{
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
		'INCLUDE_SUBSECTIONS' => 'Y',
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
		'SET_TITLE' => 'N',
		'SET_STATUS_404' => 'N',
		'DISPLAY_COMPARE' => $arParams['USE_COMPARE'],
		'PAGE_ELEMENT_COUNT' => $alfaCOutput,//$arParams['PAGE_ELEMENT_COUNT'],
		'LINE_ELEMENT_COUNT' => $arParams['LINE_ELEMENT_COUNT'],
		'PRICE_CODE' => $arParams['PRICE_CODE'],
		'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
		'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
		'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
		'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
		'QUANTITY_FLOAT' => $arParams['QUANTITY_FLOAT'],
		'PRODUCT_PROPERTIES' => $arParams['PRODUCT_PROPERTIES'],
		'DISPLAY_TOP_PAGER' => 'Y',
		'DISPLAY_BOTTOM_PAGER' => 'N',
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
		'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
		'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
		'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
		'CURRENCY_ID' => $arParams['CURRENCY_ID'],
		'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
		'IS_AJAXPAGES' => $IS_AJAXPAGES,
		'AJAXPAGESID' => 'ajaxpages_catalog_identifier_search',
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
		'PROPCODE_ARTIKUL' => $arParams['PROPCODE_ARTIKUL'],
		'PROPCODE_DOSTAVKA' => $arParams['PROPCODE_DOSTAVKA'],
		'PROPCODE_MAKER_LOGO' => $arParams['PROPCODE_MAKER_LOGO'],
		'PROPCODE_MAKER' => $arParams['PROPCODE_MAKER'],
		'PROPCODE_ACCESSORIES' => $arParams['PROPCODE_ACCESSORIES'],
		'POPUP_DETAIL_VARIABLE' => $arParams['POPUP_DETAIL_VARIABLE'],
		'ERROR_EMPTY_ITEMS' => 'N',
		'SHOW_ALL_WO_SECTION' => 'Y',
		'ADD_SECTIONS_CHAIN' => 'N',
	),
	$component
);
if($IS_AJAXPAGES=='Y'){
	die();
}
			?></div><?
		?></div><?
	?></div><!-- /catalog --><?
	?><!-- catalog_search_other --><?
	$APPLICATION->ShowViewContent('catalog_search_other');
else:
	ShowError(getMessage('CATALOG_SEARCH_NO_RESULT'));
endif;
	?><!-- /catalog_search_other --><?
?></div><!-- /around_catalog --><?
$APPLICATION->AddChainItem(getMessage('SEARCH_PAGE_TITLE') , $APPLICATION->GetCurPage());