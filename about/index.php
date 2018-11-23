<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("О компании");
?>

    <div class="item-card">
        <div class="container">
            <? \Lema\Components\Breadcrumbs::inc('catalog'); ?>
        </div>
    </div>
    <section class="catalog-text">
        <div class="container bhelp">
            <h1><?=$APPLICATION->ShowTitle();?></h1>
            <p>
                <? $APPLICATION->IncludeFile(SITE_DIR . 'include/about/text.php'); ?>
            </p>
        </div>

    </section>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>