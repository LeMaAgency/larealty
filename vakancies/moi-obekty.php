<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мои объекты");
?><div class="container ">
<div class="container-index">
        <div class="section-title  margin30"><span>* Мои объекты</span></div>
	</div>
		<form name="" class="filter-form form-objects" action="" method="">

            <div class="filter-form-row">
			
			
			
			
			<div class="filter-form-column objects-column">
                            <div class="filter-field-title">Тип недвижимости</div>
                            <div class="filter-select">
                                <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                                <ul class="filter-select-drop" >
                                    <li data-value="">Выбрать</li>
                                                                            <li data-value="1">Квартиры</li>
                                                                            <li data-value="2">Комнаты</li>
                                                                            <li data-value="3">Дома</li>
                                                                            <li data-value="4">Земельный участок</li>
                                                                            <li data-value="49">Офисы</li>
                                                                            <li data-value="50">Торговые площади</li>
                                                                            <li data-value="51">Здания</li>
                                                                            <li data-value="152">Дачи</li>
                                                                    </ul>
                                <input type="hidden" name="arrFilter_pf[REALTY_TYPE]" value="">
                            </div>
            </div>
			<div class="objects-column">
                                <div class="filter-field-title object-number">Кол-во комнат</div>
                                <div class="filter-num-rooms">
                                    <input name="" type="checkbox" id="n1" value="1" class="filter-input">
                                    <label for="n1" class="filter-label">1</label>
                                    <input name="" type="checkbox" id="n2" value="2" class="filter-input">
                                    <label for="n2" class="filter-label">2</label>
                                    <input name="" type="checkbox" id="n3" value="3" class="filter-input">
                                    <label for="n3" class="filter-label">3</label>
                                    <input name="" type="checkbox" id="n4" value="4x" class="filter-input">
                                    <label for="n4" class="filter-label">4+</label>
                                </div>
            </div>			
			
			
                                                                                <div class="objects-column">
                                                                                                <div class="filter-field-title">Общая площадь, м&sup2;</div>
                                    <div class="filter-price"  >
                                        <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Общая площадь, м&sup2;">
                                    </div>
                                                                                    </div>

                                <div class="objects-column">
                                    <div class="filter-field-title">Этаж</div>
                                    <div class="filter-price">
                                        <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Этаж">
                                    </div>
                                </div>
								<div class="objects-column">
                                    <div class="filter-field-title">Город</div>
                                    <div class="filter-price">
                                        <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Город">
                                    </div>
                                </div>
								<div class="objects-column">
                                    <div class="filter-field-title">Улица</div>
                                    <div class="filter-price">
                                        <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Улица">
                                    </div>
                                </div>
								<div class="objects-column">
                                    <div class="filter-field-title">№ дома</div>
                                    <div class="filter-price">
                                        <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="№ дома">
                                    </div>
                                </div>
								<div class="objects-column">
                                    <div class="filter-field-title">Стоимость недвижимости </div>
                                    <div class="filter-price">
                                        <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Стоимость недвижимости ">
                                    </div>
                                </div>
																					
                                                                              

                                                                     
                                                </div>
                        <button type="submit" name="" value="" class="filter-submit-btn">Сохранить объект</button>
            <div class="clb margin30"></div>
        </form>
		
    </div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>