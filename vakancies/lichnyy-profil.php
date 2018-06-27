<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("личный профиль");
?>	<div class="container">
        <form name="" class="filter-form form-admin" action="" method="">
            <div class="filter-form-row">
			<div class="container-index">
				<div class="section-title"><span>* Персональные данные</span></div>
			</div>                
					<div class="filter-form-column">
                        <div class="filter-field-title">Имя</div>
                        <div class="filter-price">
                            <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Пользователь">
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
                    <div class="filter-form-column">
						<div class="filter-field-title">Пол</div>
						<div class="filter-select">
                            <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
								<ul class="filter-select-drop">
                                                                            <li data-value="1">Не определен</li>
                                                                            <li data-value="2">Женский</li>
                                                                            <li data-value="3">Мужской</li>
                                </ul>
                        </div>								

						<div class="filter-field-title">Дата рождения</div>
                        <div class="filter-price">
                                        <input type="date" value="" name="date" id="date" class="filter-price-input filter-max-value-input" placeholder="Дата рождения">
                        </div>
						<div class="filter-field-title " >Город</div>
                        <div class="filter-select">
                                        <a href="#" class="filter-select-link active filter-border-color">Выбрать</a>
                        </div>
                    </div>
	<div class="container-index">
        <div class="section-title"><span>* Контактная информация</span></div>
    </div>
                        
						<div class="filter-form-column">
                            <div class="filter-field-title form-contact-title">№ телефона</div>
                            <div class="filter-price contact-info">
                                        <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="№ телефона">
										<button type="submit" name="" value="" class="filter-submit-btn-admin">Подтвердить</button>
                            </div>
                        </div>
						<div class="filter-form-column">
                                    <div class="filter-field-title form-contact-title form-contact-email">Email</div>
                                    <div class="filter-price contact-info">
                                        <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Email">
										<button type="submit" name="" value="" class="filter-submit-btn-admin">Подтвердить</button>
                                    </div>
                                                                                </div>

                                                                              

                                                                     
                                                </div>
                        <div class="text-center">
						<button type="submit" name="" value="" class="filter-submit-btn margin30 btn-reset">Отменить</button>
						<button type="submit" name="" value="" class="filter-submit-btn margin30 btn-save">Сохранить</button>
						</div>
            <div class="clb"></div>
        </form>
		
		<div class="container-index">
        <div class="section-title margin30"><span>* Сменить пароль</span></div>
    </div>
	<form name="" class="filter-form form-admin" action="" method="">

            <div class="filter-form-row">
			
                                                                                <div class="filter-form-column">
                                                                                                <div class="filter-field-title">Старый пароль</div>
                                    <div class="filter-price">
                                        <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Старый пароль">
                                    </div>
                                                                                    </div>

                                                                                <div class="filter-form-column">
                                                                                                <div class="filter-field-title">Новый пароль</div>
                                    <div class="filter-price">
                                        <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Новый пароль">
                                    </div>
                                                                                    </div>
																					<div class="filter-form-column">
                                                                                                <div class="filter-field-title">Повторите пароль</div>
                                    <div class="filter-price">
                                        <input type="text" value="" name="" class="filter-price-input filter-max-value-input" placeholder="Повторите пароль">
                                    </div>
                                                                                    </div>

                                                                              

                                                                     
                                                </div>
                        <button type="submit" name="" value="" class="filter-submit-btn">Сменить пароль</button>
            <div class="clb margin30"></div>
        </form></div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>