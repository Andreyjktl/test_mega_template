<?IncludeTemplateLangFile(__FILE__);?><!DOCTYPE html>
<?=GetMessage("DVS_COPY");?>
<?
	if(CModule::IncludeModuleEx('dvs.tyres') == 3) {
		echo GetMessage("TEST_END");
		return;
	}
?>
<html>
	<head>
		<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" />
		<title><?$APPLICATION->ShowTitle()?></title>
		<?$APPLICATION->ShowHead()?>
		<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/colors.css" type="text/css" />
		<!--[if IE 9]><link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/ie9.css" type="text/css" /><![endif]-->
		<!--[if IE 8]><link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/ie8.css" type="text/css" /><![endif]-->
		<!--[if IE 7]><link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/ie7.css" type="text/css" /><![endif]-->
		<?
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery-1.6.2.min.js');
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.easing.1.3.js');
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/common.js');
		?>
	</head>
	<body>
		<div style="position:absolute;left:-10000px;top:-10000px;"><div style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/arrow.gif)"></div><div style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/button1.gif)"></div><div style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/button2.gif)"></div><div style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/button3.gif)"></div><div style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/button4.gif)"></div><div style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/button-disabled.gif)"></div><div style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/dashed.gif)"></div><div style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/filter-params.gif)"></div><div style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/filter-tab.gif)"></div><div style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/hover.png)"></div><div style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/loading.gif)"></div><div style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/menu.gif)"></div><div style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/signin.gif)"></div><div style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/signin-close.png)"></div><div style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/tab1.gif)"></div><div style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/tab1-selected.gif)"></div><div style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/tab1-selected2.gif)"></div><div style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/tab2-selected.gif)"></div><div style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/title.gif)"></div></div>
		<?
		require_once $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/include_areas/general.php";
		?>

		<div id="panel"><?$APPLICATION->ShowPanel()?></div>
		<!-- Center -->
		<div class="top_panel">
		
		</div>

		<div class="top_nav">
		<div style="    min-width: 937px; width: 85%; margin: auto;">

		<!-- Navigation -->

					<?$APPLICATION->IncludeComponent('bitrix:menu', "top", array(
						"ROOT_MENU_TYPE" => "top",
						"MENU_CACHE_TYPE" => "Y",
						"MENU_CACHE_TIME" => "36000000",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => array(),
						"MAX_LEVEL" => "2",
						"USE_EXT" => "N",
						"ALLOW_MULTI_SELECT" => "N"
						)
					);?>

					<?
					$APPLICATION->IncludeComponent(
						"bitrix:system.auth.form",
						"",
						Array(
								"REGISTER_URL" => SITE_DIR."auth/",
								"FORGOT_PASSWORD_URL" => SITE_DIR."auth/",
								"PROFILE_URL" => SITE_DIR."personal/",
								"SHOW_ERRORS" => "N"
						),
					false
					);
					?>


		</div>
		</div>
					<!-- Header -->
			<header>
			<div class="bg_nav"></div>
				<!-- Top Block -->
				<div class="top-block">
				<div style="    min-width: 937px;    width: 85%;    margin: auto;">

					<div class="logo">
						<?if (CSite::InDir(SITE_DIR.'index.php')) {?>
							<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/company_logo_one_column.php"), false);?>
						<?} else {?>
							<a href="<?=SITE_DIR?>">
								<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/company_logo_one_column.php"), false);?>
							</a>
						<?}?>
						<p>
							<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/company_slogan.php"), false);?>
						</p>
					</div>

					<div style="float:left; width: 35%;  padding-top: 10px;">
					<?$APPLICATION->IncludeComponent("bitrix:search.title", "visual1", array(
							"NUM_CATEGORIES" => "1",
							"TOP_COUNT" => "5",
							"ORDER" => "date",
							"USE_LANGUAGE_GUESS" => "Y",
							"CHECK_DATES" => "N",
							"SHOW_OTHERS" => "N",
							"PAGE" => SITE_DIR."search/",
							"CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS"),
							"CATEGORY_0" => array(
								0 => "no",
							),
							"SHOW_INPUT" => "Y",
							"INPUT_ID" => "title-search-input",
							"CONTAINER_ID" => "search"
							),
							false
						);?>
						</div>


					<div class="sections">

						<div class="section">
							<div class="phone">
								<p class="phone">
									<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/telephone.php"), false);?>
								</p>
								<p>
									<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/schedule.php"), false);?>
								</p>
							</div>
						</div>
						<div class="section" id="cart-block">
							<?
							$APPLICATION->IncludeComponent(
								"bitrix:sale.basket.basket.small", 
								".default", 
								array(
									"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
									"PATH_TO_ORDER" => SITE_DIR."personal/order/",
									"COMPONENT_TEMPLATE" => ".default",
									"SHOW_DELAY" => "Y",
									"SHOW_NOTAVAIL" => "Y",
									"SHOW_SUBSCRIBE" => "Y"
								),
								false
							);
							?>
						</div>
						</div>
						<div class="clear"></div>
					</div>

				
				</div>

					<div class="panel">
						<div class="panel_inner">
						<div class="menu">
							<ul>
								
								<li<?echo CSite::InDir(SITE_DIR.'tyres/')?' class="selected"':'';?>>
									<a href="<?=SITE_DIR?>tyres/podbor-shin.php?width=0&height=0&diameter=0&season=0&do_search=tyres">
										<span><?=GetMessage("TYRES");?></span></a>
												
												<?$APPLICATION->IncludeComponent(
												"bitrix:menu", 
												"top_brands_tyre", 
												array(
													"ROOT_MENU_TYPE" => "top_tyres",
													"MENU_CACHE_TYPE" => "Y",
													"MENU_CACHE_TIME" => "36000000",
													"MENU_CACHE_USE_GROUPS" => "Y",
													"MENU_CACHE_GET_VARS" => array(
													),
													"MAX_LEVEL" => "1",
													"USE_EXT" => "Y",
													"ALLOW_MULTI_SELECT" => "N",
													"COMPONENT_TEMPLATE" => "top_brands_tyre",
													"CHILD_MENU_TYPE" => "left",
													"DELAY" => "N"
												),
												false
											);?>
								</li>

								<li<?echo CSite::InDir(SITE_DIR.'wheels/')?' class="selected"':'';?>>
									<a href="<?=SITE_DIR?>wheels/podbor-diskov.php?brand=0&diameter=0&width=0&aperture=0&center=0&gab=0&do_search=wheels">
										<span><?=GetMessage("WHEELS");?></span></a>
												
												<?$APPLICATION->IncludeComponent(
												"bitrix:menu", 
												"top_brands_wheel", 
												array(
													"ROOT_MENU_TYPE" => "top_wheels",
													"MENU_CACHE_TYPE" => "Y",
													"MENU_CACHE_TIME" => "36000000",
													"MENU_CACHE_USE_GROUPS" => "Y",
													"MENU_CACHE_GET_VARS" => array(
													),
													"MAX_LEVEL" => "1",
													"USE_EXT" => "Y",
													"ALLOW_MULTI_SELECT" => "N",
													"COMPONENT_TEMPLATE" => "top_brands_wheel",
													"CHILD_MENU_TYPE" => "left",
													"DELAY" => "N"
												),
												false
											);?>
								</li>
								<?/*<li><a href="<?=SITE_DIR?>special-offers/"><span><?=$MESS["ACTIONS"];?></span></a></li>
								<li><a href="<?=SITE_DIR?>tyres/podbor-shin.php"><span>Шины</span></a></li>
								<li><a href="<?=SITE_DIR?>wheels/podbor-diskov.php"><span>Диски</span></a></li>*/?>

								<li><a href="<?=SITE_DIR?>news/"><span>Новости</span></a></li>
								<li><a href="<?=SITE_DIR?>articles/"><span>Статьи</span></a></li>
								<li><a href="<?=SITE_DIR?>e-store/"><span>Покупателю</span></a></li>
								<li><a href="<?=SITE_DIR?>contacts/"><span>Контакты</span></a></li>
								<?/*<li><a href="<?=SITE_DIR?>contacts/"><span>Контакты</span></a></li>*/?>
							</ul>
						</div>

						
					</div>
						<div class="clear"></div>
					</div>
				<!-- // Top Block -->

			</header>
			<!-- // Header -->



		<div class="center">

			<!-- Content -->
			<div class="content">

				<?/* <?if (CSite::InDir(SITE_DIR.'index.php')) {?>
				<?$APPLICATION->IncludeComponent(
						"bitrix:news.list", 
						"promo_block", 
						array(
							"IBLOCK_TYPE" => "content",
							"IBLOCK_ID" => "1",
							"NEWS_COUNT" => "20",
							"SORT_BY1" => "SORT",
							"SORT_ORDER1" => "ASC",
							"SORT_BY2" => "SORT",
							"SORT_ORDER2" => "ASC",
							"FILTER_NAME" => "",
							"FIELD_CODE" => array(
								0 => "DETAIL_PICTURE",
								1 => "",
							),
							"PROPERTY_CODE" => array(
								0 => "",
								1 => "",
							),
							"CHECK_DATES" => "Y",
							"DETAIL_URL" => "",
							"AJAX_MODE" => "Y",
							"AJAX_OPTION_SHADOW" => "Y",
							"AJAX_OPTION_JUMP" => "N",
							"AJAX_OPTION_STYLE" => "Y",
							"AJAX_OPTION_HISTORY" => "N",
							"CACHE_TYPE" => "A",
							"CACHE_TIME" => "36000000",
							"CACHE_FILTER" => "N",
							"CACHE_GROUPS" => "Y",
							"PREVIEW_TRUNCATE_LEN" => "",
							"ACTIVE_DATE_FORMAT" => "d.m.Y",
							"SET_TITLE" => "N",
							"SET_STATUS_404" => "N",
							"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
							"ADD_SECTIONS_CHAIN" => "N",
							"HIDE_LINK_WHEN_NO_DETAIL" => "N",
							"PARENT_SECTION" => "",
							"PARENT_SECTION_CODE" => "",
							"DISPLAY_TOP_PAGER" => "N",
							"DISPLAY_BOTTOM_PAGER" => "N",
							"PAGER_TITLE" => "",
							"PAGER_SHOW_ALWAYS" => "N",
							"PAGER_TEMPLATE" => "",
							"PAGER_DESC_NUMBERING" => "N",
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
							"PAGER_SHOW_ALL" => "N",
							"DISPLAY_DATE" => "Y",
							"DISPLAY_NAME" => "Y",
							"DISPLAY_PICTURE" => "Y",
							"DISPLAY_PREVIEW_TEXT" => "Y",
							"AJAX_OPTION_ADDITIONAL" => "",
							"COMPONENT_TEMPLATE" => "promo_block",
							"SET_BROWSER_TITLE" => "Y",
							"SET_META_KEYWORDS" => "Y",
							"SET_META_DESCRIPTION" => "Y",
							"INCLUDE_SUBSECTIONS" => "Y"
						),
						false
					);?> 
				<?} 
				else {?>
				<!-- Promo Mini -->
				<!-- <div class="promo mini">
					
					<img src="<?echo SITE_TEMPLATE_PATH?>/images/promo-mini.jpg" width="939" height="129" alt="" />
					<div class="banner">
						<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_TEMPLATE_PATH."/banners/banner-02.php"), false);?>
					</div>
					
				</div> -->
				<!-- // Promo Mini -->
				

				<?}?> */?>

				<?/*<?if (CSite::InDir(SITE_DIR.'index.php')) {?>
				<br>
				 <?
				$APPLICATION->IncludeComponent(
	"dvs:dvs.filter", 
	"filter_wheels", 
	array(
		"IBLOCK_ID" => "5",
		"B_IBLOCK_ID" => "4",
		"W_IBLOCK_ID" => "7",
		"W_B_IBLOCK_ID" => "6",
		"A_IBLOCK_ID" => "8",
		"COMPONENT_TEMPLATE" => "filter_wheels",
		"USER_PROPERTY_NAME" => ""
	),
	false
);
				?> 
				<?}?> 

				<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array(
					"START_FROM" => "0",
					"PATH" => "",
					"SITE_ID" => "-"
					),
					false,
					Array()
				);?>

<?if (CSite::InDir(SITE_DIR.'index.php')) {?>
				<br>
				 <?
				$APPLICATION->IncludeComponent(
	"dvs:dvs.filter", 
	"filter_tyres", 
	array(
		"IBLOCK_ID" => "5",
		"B_IBLOCK_ID" => "4",
		"W_IBLOCK_ID" => "7",
		"W_B_IBLOCK_ID" => "6",
		"A_IBLOCK_ID" => "8",
		"COMPONENT_TEMPLATE" => "filter_wheels",
		"USER_PROPERTY_NAME" => ""
	),
	false
);
				?> 
				<?}?> */?>

				<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array(
					"START_FROM" => "0",
					"PATH" => "",
					"SITE_ID" => "-"
					),
					false,
					Array()
				);?>
				

				<?if (!CSite::InDir(SITE_DIR.'index.php')) {?><h1><?$APPLICATION->ShowTitle(false);?></h1><?}?>