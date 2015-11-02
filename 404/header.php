<?IncludeTemplateLangFile(__FILE__);?><!DOCTYPE html>
<?=GetMessage("DVS_COPY");?>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?$APPLICATION->ShowTitle()?></title>
        <?$APPLICATION->ShowHead()?>
        <link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/colors.css" />
    </head>


    <body>
        <div id="panel"><?$APPLICATION->ShowPanel()?></div>

        <!-- Center -->
        <div class="center">


            <!-- Logo -->
            <div class="logo">
                <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/company_logo_one_column.php"), false);?>
                <p><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/company_name.php"), false);?></p>
            </div>
            <!-- // Logo -->


            <!-- Message -->
            <div class="msg">
