<?

defined('NEED_AUTH') or define('NEED_AUTH', true);

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$APPLICATION->SetTitle('Оформить ипотеку');
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <? \Lema\Components\Breadcrumbs::inc('breadcrumbs'); ?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row new-rieltor">
            <div class="col-md-9">
                <div class="add-apartment">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="add-apartment__title"><? $APPLICATION->IncludeFile(SITE_DIR . 'include/hypothec/consultation_title.php'); ?></h3>
                            <span><? $APPLICATION->IncludeFile(SITE_DIR . 'include/hypothec/consultation_text.php'); ?></span>

                            <a href="#" class="add-apartment__button js-feedback-form"><? $APPLICATION->IncludeFile(SITE_DIR . 'include/vakancies/consultation_button_text.php'); ?></a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 calculator__wrap">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "one-realtor",
                    array(
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "ADD_SECTIONS_CHAIN" => "N",
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
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "N",
                        "DISPLAY_PICTURE" => "N",
                        "DISPLAY_PREVIEW_TEXT" => "N",
                        "DISPLAY_TOP_PAGER" => "N",
                        "FIELD_CODE" => array(
                            0 => "NAME",
                            1 => "PREVIEW_TEXT",
                            2 => "PREVIEW_PICTURE",
                            3 => "",
                        ),
                        "FILTER_NAME" => "",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "IBLOCK_ID" => "",
                        "IBLOCK_TYPE" => "-",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "INCLUDE_SUBSECTIONS" => "N",
                        "MESSAGE_404" => "",
                        "NEWS_COUNT" => "1",
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
                            0 => "",
                            1 => "",
                        ),
                        "SET_BROWSER_TITLE" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_STATUS_404" => "N",
                        "SET_TITLE" => "N",
                        "SHOW_404" => "N",
                        "SORT_BY1" => "SORT",
                        "SORT_BY2" => "ACTIVE_FROM",
                        "SORT_ORDER1" => "ASC",
                        "SORT_ORDER2" => "ASC",
                        "STRICT_SECTION_CHECK" => "N",
                        "COMPONENT_TEMPLATE" => "realtors"
                    ),
                    false
                ); ?>
            </div>
        </div>
        <form class="filter-form form-admin anketa js-hypothec-form"
              action="<?=SITE_DIR."ajax/personal_hypothec_form.php";?>"
              method="POST"
              enctype="multipart/form-data">
            <div class="container-index">
                <div class="section-title form-title">
                    <span>
                        Личная информация
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="filter-field-title">Имя</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="NAME" class="filter-price-input filter-max-value-input"
                               placeholder="Ваше имя">
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title">Отчество</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="PATRONUMIC" class="filter-price-input filter-max-value-input"
                               placeholder="Ваше отчество">
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title">Фамилия</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="SURNAME" class="filter-price-input filter-max-value-input"
                               placeholder="Введите свою фамилию">
                        <div class="it-error"></div>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="filter-field-title">Дата рождения</div>
                    <div class="filter-price it-block">
                        <input type="date" value="" name="date" id="date"
                               class="filter-price-input filter-max-value-input" placeholder="Дата рождения">
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title">№ телефона</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="PHONE" class="filter-price-input filter-max-value-input btn-accept"
                               placeholder="№ телефона">
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title">Email</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="EMAIL" class="filter-price-input filter-max-value-input"
                               placeholder="Email">
                        <div class="it-error"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="filter-field-title">Уровень образования</div>
                    <div class="filter-select it-block">
                        <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                        <ul class="filter-select-drop">
                            <li data-value="">Выбрать</li>
                            <?foreach(\LIblock::getPropEnumValues(\LIblock::getPropId('hypothec', 'EDUCATION_LEVEL')) as $data):?>
                                <li data-value="<?= (int) $data['ID'];?>">
                                    <?=htmlspecialcharsbx($data['VALUE']);?>
                                </li>
                            <?endforeach;?>
                        </ul>
                        <input type="hidden" name="EDUCATION_LEVEL" value="">
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title">Семейное положение</div>
                    <div class="filter-select it-block">
                        <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                        <ul class="filter-select-drop">
                            <li data-value="">Выбрать</li>
                            <?foreach(\LIblock::getPropEnumValues(\LIblock::getPropId('hypothec', 'MARITAL_STATUS')) as $data):?>
                                <li data-value="<?= (int) $data['ID'];?>">
                                    <?=htmlspecialcharsbx($data['VALUE']);?>
                                </li>
                            <?endforeach;?>
                        </ul>
                        <input type="hidden" name="MARITAL_STATUS" value="">
                        <div class="it-error"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="filter-field-title object-number">Брачный договор</div>
                    <div class="filter-num-rooms it-block">
                        <?foreach(\LIblock::getPropEnumValues(\LIblock::getPropId('hypothec', 'MARRIAGE_CONTRACT')) as $data):?>
                            <input name="MARRIAGE_CONTRACT"
                                   type="radio"
                                   id="n<?=$key+1;?>"
                                   value="<?= (int) $data['ID'];?>"
                                   class="filter-input">
                            <label for="n1" class="filter-label">
                                <?=htmlspecialcharsbx($data['VALUE']);?>
                            </label>
                        <?endforeach;?>
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title">Количество детей до 18 лет</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="QUANTITY_MINOR_CHILDREN" class="filter-price-input filter-max-value-input"
                               placeholder="Количество детей до 18 лет">
                        <div class="it-error"></div>
                    </div>
                </div>
            </div>
            <div class="container-index">
                <div class="section-title form-title">
                    <span>
                        Место проживания
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="filter-field-title">Область/Край</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="REGION" class="filter-price-input filter-max-value-input"
                               placeholder="Область/Край ">
                        <div class="it-error"></div>
                    </div>

                    <div class="filter-field-title">Город/Поселок</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="CITY" class="filter-price-input filter-max-value-input"
                               placeholder="Город/Поселок">
                        <div class="it-error"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="filter-field-title">Статус жилья</div>
                    <div class="filter-select it-block">
                        <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                        <ul class="filter-select-drop">
                            <li data-value="">Выбрать</li>
                            <?foreach(\LIblock::getPropEnumValues(\LIblock::getPropId('hypothec', 'STATUS_HOUSING')) as $data):?>
                                <li data-value="<?= (int) $data['ID'];?>">
                                    <?=htmlspecialcharsbx($data['VALUE']);?>
                                </li>
                            <?endforeach;?>
                        </ul>
                        <input type="hidden" name="STATUS_HOUSING" value="">
                        <div class="it-error"></div>
                    </div>
                </div>
            </div>

            <div class="container-index">
                <div class="section-title form-title">
                    <span>
                        Служебная информация
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="filter-field-title">Тип занятости</div>
                    <div class="filter-select it-block">
                        <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                        <ul class="filter-select-drop">
                            <li data-value="">Выбрать</li>
                            <?foreach(\LIblock::getPropEnumValues(\LIblock::getPropId('hypothec', 'EMPLOYMENT_TYPE')) as $data):?>
                                <li data-value="<?= (int) $data['ID'];?>">
                                    <?=htmlspecialcharsbx($data['VALUE']);?>
                                </li>
                            <?endforeach;?>
                        </ul>
                        <input type="hidden" name="EMPLOYMENT_TYPE" value="">
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title">Тип трудового договора</div>
                    <div class="filter-select it-block">
                        <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                        <ul class="filter-select-drop">
                            <li data-value="">Выбрать</li>
                            <?foreach(\LIblock::getPropEnumValues(\LIblock::getPropId('hypothec', 'TYPE_LABOR_CONTRACT')) as $data):?>
                                <li data-value="<?= (int) $data['ID'];?>">
                                    <?=htmlspecialcharsbx($data['VALUE']);?>
                                </li>
                            <?endforeach;?>
                        </ul>
                        <input type="hidden" name="TYPE_LABOR_CONTRACT" value="">
                        <div class="it-error"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="filter-field-title">Стаж на текущем месте работы (в месяцах)</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="EXPERIENCE_CURRENT_WORK" class="filter-price-input filter-max-value-input"
                               placeholder="Стаж">
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title">Общий трудовой стаж (месяцах)</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="EXPERIENCE_TOTAL" class="filter-price-input filter-max-value-input"
                               placeholder="Стаж общий">
                        <div class="it-error"></div>
                    </div>
                </div>
            </div>
            <div class="container-index">
                <div class="section-title form-title">
                    <span>
                        Информация о доходах
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="filter-field-title">Зарплатный проект банка</div>
                    <div class="filter-select it-block">
                        <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                        <ul class="filter-select-drop">
                            <li data-value="">Выбрать</li>
                            <?foreach(\LIblock::getPropEnumValues(\LIblock::getPropId('hypothec', 'SALARY_PROJECT_BANK')) as $data):?>
                                <li data-value="<?= (int) $data['ID'];?>">
                                    <?=htmlspecialcharsbx($data['VALUE']);?>
                                </li>
                            <?endforeach;?>
                        </ul>
                        <input type="hidden" name="SALARY_PROJECT_BANK" value="">
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title">Основная заработная плата</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="BASIC_SALARY" class="filter-price-input filter-max-value-input"
                               placeholder="Основная заработная плата">
                        <div class="it-error"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="filter-field-title">Дополнительные доходы</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="ADDITIONAL_INCOME" class="filter-price-input filter-max-value-input"
                               placeholder="Дополнительные доходы">
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title">Доход семьи</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="FAMILY_INCOME" class="filter-price-input filter-max-value-input"
                               placeholder="Доход семьи">
                        <div class="it-error"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="filter-field-title">Способ подтверждения дохода</div>
                    <div class="filter-select it-block">
                        <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                        <ul class="filter-select-drop">
                            <li data-value="">Выбрать</li>
                            <?foreach(\LIblock::getPropEnumValues(\LIblock::getPropId('hypothec', 'METHOD_INCOME_CONFIRMATION')) as $data):?>
                                <li data-value="<?= (int) $data['ID'];?>">
                                    <?=htmlspecialcharsbx($data['VALUE']);?>
                                </li>
                            <?endforeach;?>
                        </ul>
                        <input type="hidden" name="METHOD_INCOME_CONFIRMATION" value="">
                        <div class="it-error"></div>
                    </div>
                </div>
            </div>
            <div class="container-index">
                <div class="section-title form-title">
                    <span>
                        Информация о запрашиваемом ипотечном кредите
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="filter-field-title">Программа кредитования</div>
                    <div class="filter-select it-block">
                        <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                        <ul class="filter-select-drop">
                            <li data-value="">Выбрать</li>
                            <?foreach(\LIblock::getPropEnumValues(\LIblock::getPropId('hypothec', 'PROGRAM_CREDIT')) as $data):?>
                                <li data-value="<?= (int) $data['ID'];?>">
                                    <?=htmlspecialcharsbx($data['VALUE']);?>
                                </li>
                            <?endforeach;?>
                        </ul>
                        <input type="hidden" name="PROGRAM_CREDIT" value="">
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title">Запрашиваемая сумма</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="REQUESTED_AMOUNT" class="filter-price-input filter-max-value-input"
                               placeholder="Запрашиваемая сумма">
                        <div class="it-error"></div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="filter-field-title">Срок кредита</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="CREDIT_TERM" class="filter-price-input filter-max-value-input"
                               placeholder="Срок кредита">
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title">Стоимость объекта недвижимости</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="PRICE_REAL_ESTATE_OBJECT" class="filter-price-input filter-max-value-input"
                               placeholder="Стоимость объекта недвижимости">
                        <div class="it-error"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="filter-field-title">Сумма первоначального взноса</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="AMOUNT_INITIAL_CONTRIBUTION" class="filter-price-input filter-max-value-input"
                               placeholder="Сумма первоначального взноса">
                        <div class="it-error"></div>
                    </div>
                </div>

                <div class="col-md-6 it-block">
                    <div class="filter-field-title">Загрузить документ</div>
                    <div class="file-upload it-block">
                        <label>
                            <input type="file" name="file">
                            <span>Выберите файл</span>
                            <div class="it-error"></div>
                        </label>
                    </div>
                </div>

            </div>
            <div class="it-block checkbox" style="border:1px solid transparent">
                <label style="margin:5px 10px;">
                    <input type="checkbox" value="1" name="agreement" class="checkbox-152-fz">
                    Я ознакомлен <a target="_blank" href="/contacts/apply.pdf">c положением об обработке и защите персональных данных.</a>
                </label>
            </div>


            <div class="text-center margin30">
                <button type="submit" name="" value="" class="filter-submit-btn margin30 btn-reset">Отменить</button>
                <button type="submit" name="" value="" class="filter-submit-btn margin30 btn-save">Сохранить</button>
            </div>
        </form>
    </div>
<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
?>