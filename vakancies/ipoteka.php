<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ипотека");
?><div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb breadcrumb-catalog">
			<li>
				<a href="/" title="Главная">
					Главная
				</a>
			</li>
			<li>
				<a href="/catalog/" title="Каталог">
					Каталог
				</a>
			</li>
			<li>
				<span class="breadcrumb-active">Квартиры</span>
			</li></ol>            </div>
        </div>
    </div>
	<div class="container">
		<form name="" class="filter-form form-admin anketa" action="" method="">
		<div class="container-index">
				<div class="section-title form-title"><span>Личная информация</span></div>
		</div>
		<div class="row">
			<div class="col-md-6">
			<div class="filter-field-title">Имя</div>
                        <div class="filter-price">
                            <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Ваше имя">
                        </div>
						<div class="filter-field-title">Отчество</div>
                        <div class="filter-price">
                            <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Ваше отчество">
                        </div>
						<div class="filter-field-title">Фамилия</div>
                        <div class="filter-price">
                            <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Введите свою фамилию">
                        </div>
			</div>
			<div class="col-md-6">						

				<div class="filter-field-title">Дата рождения</div>
                <div class="filter-price">
                                        <input type="date" value="" name="date" id="date" class="filter-price-input filter-max-value-input" placeholder="Дата рождения">
                </div>
				<div class="filter-field-title ">№ телефона</div>
                    <div class="filter-price">
                                        <input type="text" value="" name="" class="filter-price-input filter-max-value-input btn-accept" placeholder="№ телефона">
                </div>
				<div class="filter-field-title  ">Email</div>
                    <div class="filter-price">
                                        <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Email">
                </div>			
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="filter-field-title ">Уровень образования</div>
				<div class="filter-select">
                    <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                    <ul class="filter-select-drop" >
                        <li data-value="">Выбрать</li>
                        <li data-value="1">ниже среднего</li>
                        <li data-value="2">среднее</li>
                        <li data-value="3">средне специальное </li>
                        <li data-value="4">неоконченное высшее</li>
                        <li data-value="49">высшее</li>
                        <li data-value="50">несколько высших</li>
                        <li data-value="51">ученая степень/МВА</li>
                        <li data-value="152">аспирантура</li>
                    </ul>
                        <input type="hidden" name="" value="">
                </div>
				<div class="filter-field-title ">Семейное положение</div>
				<div class="filter-select">
                    <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                    <ul class="filter-select-drop" >
                        <li data-value="">Выбрать</li>
                        <li data-value="1">женат/замужем</li>
                        <li data-value="2">холост/не замужем</li>
                        <li data-value="3">вдовец/вдова</li>
                        <li data-value="4">гражданский брак</li>
                        <li data-value="49">разведен/разведена</li>
                    </ul>
                        <input type="hidden" name="" value="">
                </div>
			</div>
			<div class="col-md-6">
				<div class="filter-field-title object-number">Брачный договор</div>
                    <div class="filter-num-rooms">
                                    <input name="" type="checkbox" id="n1" value="1" class="filter-input">
                                    <label for="n1" class="filter-label">да</label>
                                    <input name="" type="checkbox" id="n2" value="2" class="filter-input">
                                    <label for="n2" class="filter-label">нет</label>
                    </div>
				<div class="filter-field-title">Количество детей до 18 лет</div>
                <div class="filter-price"  >
                    <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Количество детей до 18 лет">
                </div>	
			</div>
		</div>
		<div class="container-index">
				<div class="section-title form-title"><span>Место проживания</span></div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="filter-field-title">Область/Край </div>
                <div class="filter-price"  >
                    <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Область/Край ">
                </div>	
				
				<div class="filter-field-title">Город/Поселок</div>
                <div class="filter-price"  >
                    <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Город/Поселок">
                </div>
			</div>
			<div class="col-md-6">
				<div class="filter-field-title">Статус жилья </div>
                <div class="filter-select">
                    <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                    <ul class="filter-select-drop" >
                        <li data-value="">Выбрать</li>
                        <li data-value="1">Собственное жилье</li>
                        <li data-value="2">Аренда</li>
                        <li data-value="3">Социальный найм</li>
                        <li data-value="4">Жилье родственников</li>
                        <li data-value="49">Коммунальная квартира</li>
						<li data-value="4">Общежитие</li>
                        <li data-value="49">Воинская часть</li>
                    </ul>
                        <input type="hidden" name="" value="">
                </div>	

			</div>
		</div>
		
		<div class="container-index">
				<div class="section-title form-title"><span>Служебная информация</span></div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="filter-field-title">Тип занятости</div>
                <div class="filter-select">
                    <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                    <ul class="filter-select-drop" >
                        <li data-value="">Выбрать</li>
                        <li data-value="1">Наемный работник</li>
                        <li data-value="2">ИП</li>
                        <li data-value="3">Собственный бизнес</li>
                        <li data-value="4">Пенсионер</li>
                    </ul>
                        <input type="hidden" name="" value="">
                </div>	
				<div class="filter-field-title">Тип трудового договора</div>
                <div class="filter-select">
                    <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                    <ul class="filter-select-drop" >
                        <li data-value="">Выбрать</li>
                        <li data-value="1">срочный (на определенный срок/сезон)</li>
                        <li data-value="2">бессрочный (постоянная занятость)</li>
                    </ul>
                        <input type="hidden" name="" value="">
                </div>
				
			</div>
			<div class="col-md-6">
				<div class="filter-field-title">Стаж на текущем месте работы (в месяцах)</div>
                <div class="filter-price"  >
                    <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Стаж">
                </div>	
				<div class="filter-field-title">Общий трудовой стаж (месяцах)</div>
                <div class="filter-price"  >
                    <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Стаж общий">
                </div>	
			</div>
		</div>
		
		<div class="container-index">
				<div class="section-title form-title"><span>Информация о доходах</span></div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="filter-field-title">Зарплатный проект банка</div>
                <div class="filter-select">
                    <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                    <ul class="filter-select-drop" >
                        <li data-value="">Выбрать</li>
                        <li data-value="1">ПАО «Сбербанк»</li>
                        <li data-value="2">ПАО «Втб24»</li>
                        <li data-value="3">ПАО «Банк Москвы»</li>
                        <li data-value="4">АО «Россельхозбанк»</li>
						<li data-value="5">ПАО «Дальневосточный банк»</li>
                        <li data-value="6">АО «Газпромбанк»</li>
                        <li data-value="7">ПАО «Росбанк»</li>
                        <li data-value="8">ПАО «Азиатско-тихоокеанский банк»</li>
                    </ul>
                        <input type="hidden" name="" value="">
                </div>	
				<div class="filter-field-title">Основная заработная плата</div>
                <div class="filter-price"  >
                    <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Основная заработная плата">
                </div>
				
			</div>
			<div class="col-md-6">
				<div class="filter-field-title">Дополнительные доходы</div>
                <div class="filter-price"  >
                    <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Дополнительные доходы">
                </div>	
				<div class="filter-field-title">Доход семьи</div>
                <div class="filter-price"  >
                    <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Доход семьи">
                </div>	
			</div>
			<div class="col-md-6">
				<div class="filter-field-title">Способ подтверждения дохода</div>
                <div class="filter-select">
                    <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                    <ul class="filter-select-drop" >
                        <li data-value="">Выбрать</li>
                        <li data-value="1">Справка 2-НДФЛ</li>
                        <li data-value="2">Справка по форме банка</li>
                    </ul>
                        <input type="hidden" name="" value="">
                </div>	
					
			</div>
		</div>
		
		<div class="container-index">
				<div class="section-title form-title"><span>Информация о запрашиваемом ипотечном кредите</span></div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="filter-field-title">Программа кредитования</div>
                <div class="filter-select">
                    <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                    <ul class="filter-select-drop" >
                        <li data-value="">Выбрать</li>
                        <li data-value="1">приобретения готового жилья</li>
                        <li data-value="2">приобретение строящегося жилья</li>
                        <li data-value="3">кредит под залог недвижимости»</li>
                        <li data-value="4">строительство жилого дома</li>
						<li data-value="5">загородная недвижимость</li>
                    </ul>
                        <input type="hidden" name="" value="">
                </div>	
				<div class="filter-field-title">Запрашиваемая сумма</div>
                <div class="filter-price"  >
                    <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Запрашиваемая сумма">
                </div>
				
			</div>
			<div class="col-md-6">
				<div class="filter-field-title">Срок кредита</div>
                <div class="filter-price"  >
                    <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Срок кредита">
                </div>	
				<div class="filter-field-title">Стоимость объекта недвижимости</div>
                <div class="filter-price"  >
                    <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Стоимость объекта недвижимости">
                </div>	
			</div>
			<div class="col-md-6">
				<div class="filter-field-title">Сумма первоначального взноса</div>
                <div class="filter-price"  >
                    <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Сумма первоначального взноса">
                </div>	
				</div>
			
			<div class="col-md-6">	
			<div class="filter-field-title">Загрузить документ</div>
				<div class="file-upload">
					<label>
						<input type="file" name="file">
						<span>Выберите файл</span>
					</label>
				</div>	
				</div>
			
		</div>
		
		
		<div class="text-center margin30">
						<button type="submit" name="" value="" class="filter-submit-btn margin30 btn-reset">Отменить</button>
						<button type="submit" name="" value="" class="filter-submit-btn margin30 btn-save">Сохранить</button>
		</div>
		</form>
    </div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>