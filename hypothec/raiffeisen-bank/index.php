<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Raiffeisen BANK");
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <? \Lema\Components\Breadcrumbs::inc('breadcrumbs'); ?>
            </div>
        </div>
    </div>
    <div class="container-fluid contacts_data">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="contacts_data__title">
                        <h2> <? $APPLICATION->ShowTitle(); ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <? $APPLICATION->IncludeFile(SITE_DIR . '/include/contacts/raiffeisen.php'); ?>
            </div>

        </div>
    </div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>