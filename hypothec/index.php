<?
require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php';

$APPLICATION->SetTitle('Ипотека');
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?\Lema\Components\Breadcrumbs::inc('breadcrumbs');?>
            </div>
        </div>
    </div>
    <div class="content-page_color">

    <div class="chosen">
        <div class="container">
            <div class="chosen__wrap">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="chosen__h2"><? $APPLICATION->IncludeFile(SITE_DIR . 'include/hypothec/advantages/title.php'); ?></h2>
                        <ul class="chosen__list">
                            <li class="chosen__list__elem"><? $APPLICATION->IncludeFile(SITE_DIR . 'include/hypothec/advantages/advantage_1.php'); ?></li>
                            <li class="chosen__list__elem"><? $APPLICATION->IncludeFile(SITE_DIR . 'include/hypothec/advantages/advantage_2.php'); ?></li>
                            <li class="chosen__list__elem"> <? $APPLICATION->IncludeFile(SITE_DIR . 'include/hypothec/advantages/advantage_3.php'); ?></li>
                            <li class="chosen__list__elem"><? $APPLICATION->IncludeFile(SITE_DIR . 'include/hypothec/advantages/advantage_4.php'); ?></li>
                            <li class="chosen__list__elem"><? $APPLICATION->IncludeFile(SITE_DIR . 'include/hypothec/advantages/advantage_5.php'); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="calculator">
        <div class="container">
            <div class="calculator__wrap">

                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="calculator__h2"><? $APPLICATION->IncludeFile(SITE_DIR . 'include/hypothec/calculator/title.php'); ?></h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-md-9 form_wrapper">
                        <div class="form_wrapper__inner">
                            <form action="" class="row">

                                <div class="col-xs-12 col-sm-6 col-lg-4 input">
                                    <div class="table">
                                        <div class="cell"><label>Тип недвижимости</label></div>
                                    </div>
                                    <select name=""><option value="">Выбрать</option><option value="3">1</option></select>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-lg-4 input">
                                    <div class="table">
                                        <div class="cell"><label>Стоимость</label></div>
                                    </div>
                                    <select name=""><option value="">Выбрать</option><option value="3">1</option></select>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-lg-4 input">
                                    <div class="table">
                                        <div class="cell"><label>Первоначальный взнос (ЗУБ или %)</label></div>
                                    </div>
                                    <select name=""><option value="">Выбрать</option><option value="3">1</option></select>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-lg-4 input">
                                    <div class="table">
                                        <div class="cell"><label>Сумма кредита</label></div>
                                    </div>
                                    <select name=""><option value="">Выбрать</option><option value="3">1</option></select>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-lg-4 input">
                                    <div class="table">
                                        <div class="cell"><label>Срок кредита</label></div>
                                    </div>
                                    <select name=""><option value="">Выбрать</option><option value="3">1</option></select>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-lg-4 input">
                                    <div class="table">
                                        <div class="cell"><label>Средний доход</label></div>
                                    </div>
                                    <select name=""><option value="">Выбрать</option><option value="3">1</option></select>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-lg-4 input">
                                    <div class="table">
                                        <div class="cell"><label>Зарплатный проект</label></div>
                                    </div>
                                    <select name=""><option value="">Выбрать</option><option value="3">1</option></select>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-lg-4 input">
                                    <div class="table">
                                        <div class="cell"><label>Социальная программа</label></div>
                                    </div>
                                    <select name=""><option value="">Выбрать</option><option value="3">1</option></select>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-lg-4 input">
                                    <div class="table">
                                        <div class="cell"><label>Стаж на последнем месте работы</label></div>
                                    </div>
                                    <select name=""><option value="">Выбрать</option><option value="3">1</option></select>
                                </div>

                                <div class="col-xs-12 col-lg-8 confirmation">

                                    <h5>Способ подтверждения дохода</h5>

                                    <div class="checkbox_wrapper">
                                        <input type="checkbox" value="value1">
                                        <label for="styled-checkbox">2 - НДФЛ</label>
                                    </div>

                                    <div class="checkbox_wrapper">
                                        <input type="checkbox" value="value1">
                                        <label for="styled-checkbox">Справка по форме банка</label>
                                    </div>

                                </div>

                                <div class="col-xs-12 col-lg-4">
                                    <input class="submit" type="submit" value="Рассчитать">
                                </div>

                            </form>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-3 callback">
                        <div class="avatar"></div>
                        <h5>Иванова Юлия</h5>
                        <span>Ваш ипотечный брокер</span>
                        <a href="tel:+7 (922) 039-21-68">+7 (922) 039-21-68</a>
                        <label for="phone">заказать звонок</label>
                        <input type="text" placeholder="Ваш телефон" name="phone">
                        <button class="submit">Жду звонка</button>
                    </div>
                </div>

                <div class="row">
                    <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"hypothec_calc_result", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "10",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "MONTH_PAYMENT",
			1 => "BANK_BET",
			2 => "",
		),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "hypothec_calc_result"
	),
	false
);?>
                </div>
            </div>
        </div>
    </div>

    <div class="we-offer">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h3 class="we-offer__title"><? $APPLICATION->IncludeFile(SITE_DIR . 'include/hypothec/steps/title.php'); ?></h3>
                    <h4 class="we-offer__title_sub"><? $APPLICATION->IncludeFile(SITE_DIR . 'include/hypothec/steps/subtitle.php'); ?></h4>
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 ">
                            <div class="we-offer__item">
                                <div class="we-offer__icon">
                                    <img src="<?=SITE_DIR.'assets/img/icons/ipot-3.png'?>">
                                </div>
                                <div class="we-offer__text"><? $APPLICATION->IncludeFile(SITE_DIR . 'include/hypothec/steps/step_1.php'); ?></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 ">
                            <div class="we-offer__item">
                                <div class="we-offer__icon">
                                    <img src="<?=SITE_DIR.'assets/img/icons/ipot-2.png'?>">
                                </div>
                                <div class="we-offer__text"><? $APPLICATION->IncludeFile(SITE_DIR . 'include/hypothec/steps/step_2.php'); ?></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 ">
                            <div class="we-offer__item">
                                <div class="we-offer__icon">
                                    <img src="<?=SITE_DIR.'assets/img/icons/ipot-1.png'?>">
                                </div>
                                <div class="we-offer__text"><? $APPLICATION->IncludeFile(SITE_DIR . 'include/hypothec/steps/step_3.php'); ?></div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="tree">
        <div class="container">
            <div class="tree__wrap">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="tree__h2"><? $APPLICATION->IncludeFile(SITE_DIR . 'include/hypothec/notations/title.php'); ?></h2>

                        <p class="tree__description"><? $APPLICATION->IncludeFile(SITE_DIR . 'include/hypothec/notations/text.php'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--    END    content-page_color    -->
    </div>
<?
require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php';
?>