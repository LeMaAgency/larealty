<?

defined('NEED_AUTH') or define('NEED_AUTH', true);

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$APPLICATION->SetTitle("Мои объекты");
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <? \Lema\Components\Breadcrumbs::inc('breadcrumbs'); ?>
            </div>
        </div>
    </div>

    <div class="container ">
        <? $APPLICATION->IncludeComponent('bitrix:menu', 'personal_buttons', array(
            'ALLOW_MULTI_SELECT' => 'N',
            'ROOT_MENU_TYPE' => 'personal',
            'CHILD_MENU_TYPE' => 'left',
            'DELAY' => 'N',
            'MAX_LEVEL' => '1',
            'MENU_CACHE_GET_VARS' => array(),
            'MENU_CACHE_TIME' => '3600',
            'MENU_CACHE_TYPE' => 'A',
            'MENU_CACHE_USE_GROUPS' => 'N',
            'USE_EXT' => 'Y',
            'COMPONENT_TEMPLATE' => 'personal'
        )); ?>
        <form class="filter-form form-admin js-object-form"
              action="<?= SITE_DIR . "ajax/personal_object_form.php"; ?>"
              method="POST">
            <div class="container-index">
                <div class="section-title form-title form-title"><span>* Мои объекты</span></div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="filter-field-title">Тип недвижимости</div>
                    <div class="filter-select it-block">
                        <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                        <ul class="filter-select-drop js-filter-select-drop-realty-type">
                            <li data-value="">Выбрать</li>
                            <? foreach(\LIblock::getSectionsByIblockCode('objects') as $code => $data):
                                if(false === strpos($code, '-new'))
                                    continue;
                                ?>
                                <li data-name="<?= htmlspecialcharsbx($data['NAME']); ?>"
                                    data-value="<?=(int)$data['ID']; ?>">
                                    <?= htmlspecialcharsbx($data['NAME']); ?>
                                </li>
                            <?endforeach;?>
                        </ul>
                        <input type="hidden" name="REALTY_TYPE" value="">
                        <input type="hidden" class="js-realty-type-name" name="REALTY_TYPE_NAME" value="">
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title object-number">Кол-во комнат</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="ROOMS_COUNT" class="filter-price-input filter-max-value-input"
                               placeholder="Кол-во комнат">
                        <div class="it-error"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="filter-field-title">Город</div>
                    <div class="filter-select it-block">
                        <a href="#" class="filter-select-link filter-border-color">
                            Выбрать
                        </a>
                        <ul class="filter-select-drop">
                            <li data-value="">Выбрать</li>
                            <? foreach (\LIblock::getPropEnumValues(\LIblock::getPropId('objects', 'CITY')) as $data): ?>
                                <li data-value="<?= htmlspecialcharsbx($data['VALUE']); ?>">
                                    <?= htmlspecialcharsbx($data['VALUE']); ?>
                                </li>
                            <? endforeach; ?>
                        </ul>
                        <input type="hidden" name="CITY" value="">
                        <div class="it-error"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="filter-field-title">Улица</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="STREET" class="filter-price-input filter-max-value-input" placeholder="Улица">
                        <div class="it-error"></div>
                    </div>
                </div>

                <div class="col-md-6 wrap-field-price">
                    <div class="filter-field-title">Общая площадь, м²</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="SQUARE" class="filter-price-input filter-max-value-input" placeholder="Общая площадь, м²">
                        <div class="it-error"></div>
                    </div>
                </div>

                <div class="all-properties-object">
                    <div class="col-md-6 js-type js-type-41 js-type-42 js-type-43 js-type-45 js-type-46 js-type-47 js-type-48" style="display: none;">
                        <div class="filter-field-title">№ дома</div>
                        <div class="filter-price it-block">
                            <input type="text" value="" name="HOUSE_NUMBER" class="filter-price-input filter-max-value-input" placeholder="№ дома">
                            <div class="it-error"></div>
                        </div>
                    </div>
                    <div class="col-md-6 js-type js-type-41 js-type-42 js-type-43 js-type-48" style="display: none;">
                        <div class="filter-field-title">Этаж</div>
                        <div class="filter-price it-block">
                            <input type="text" value="" name="STAGE" class="filter-price-input filter-max-value-input" placeholder="Этаж">
                            <div class="it-error"></div>
                        </div>
                    </div>
                    <div class="col-md-6 js-type js-type-41 js-type-42 js-type-45 js-type-46" style="display: none;">
                        <div class="filter-field-title field-price">Стоимость недвижимости</div>
                        <div class="filter-price it-block">
                            <input type="text" value="" name="PRICE" class="filter-price-input filter-max-value-input"
                                   placeholder="Стоимость недвижимости ">
                            <div class="it-error"></div>
                        </div>
                    </div>
                </div>

            </div>
            <button type="submit" name="" value="" class="filter-submit-btn btn-object">Сохранить объект</button>
            <div class="clb margin30"></div>
        </form>
    </div>
<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
?>