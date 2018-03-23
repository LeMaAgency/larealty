<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Покупателю");
?>

    <div class="content-page_color">

        <div class="why-not">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <h2 class="why-not__h2">
                            <? $APPLICATION->IncludeFile(SITE_DIR . 'include/main/why-not/title.php'); ?>
                        </h2>
                        <p class="why-not__title">
                            <? $APPLICATION->IncludeFile(SITE_DIR . 'include/main/why-not/subtitle.php'); ?>
                        </p>
                        <div class="row">
                            <div class="col-md-5 col-sm-6">
                                <h4 class="why-not__h4 why-not__h4_1">
                                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/main/why-not/block-1/title.php'); ?>
                                </h4>
                                <p class="why-not__text">
                                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/main/why-not/block-1/description.php'); ?>
                                </p>
                            </div>
                            <div class="col-md-5 col-sm-6">
                                <h4 class="why-not__h4 why-not__h4_2">
                                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/main/why-not/block-2/title.php'); ?>
                                </h4>
                                <p class="why-not__text">
                                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/main/why-not/block-2/description.php'); ?>
                                </p>
                            </div>
                            <div class="col-md-5 col-sm-6">
                                <h4 class="why-not__h4 why-not__h4_3">
                                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/main/why-not/block-3/title.php'); ?>
                                </h4>
                                <p class="why-not__text">
                                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/main/why-not/block-3/description.php'); ?>
                                </p>
                            </div>
                            <div class="col-md-5 col-sm-6">
                                <h4 class="why-not__h4 why-not__h4_4">
                                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/main/why-not/block-4/title.php'); ?>
                                </h4>
                                <p class="why-not__text">
                                    <? $APPLICATION->IncludeFile(SITE_DIR . 'include/main/why-not/block-4/description.php'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="service-package">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="service-package__h2">В пакет наших услуг входит:</h2>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="service-package__item">
                            <div class="service-package__item__img service-package__item__img_1"></div>
                            <div class="service-package__item__text">Подбор наиболее подходящих объектов согласно Вашим
                                потребностям;
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="service-package__item">
                            <div class="service-package__item__img service-package__item__img_2"></div>
                            <div class="service-package__item__text">Показы недвижимости в удобное для Вас время;</div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="service-package__item">
                            <div class="service-package__item__img service-package__item__img_3"></div>
                            <div class="service-package__item__text">Помощь в оформлении ипотеки в ведущих банках
                                города
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="service-package__item">
                            <div class="service-package__item__img service-package__item__img_4"></div>
                            <div class="service-package__item__text">Профессиональные рекомендации по соотношению
                                «цена-предложение»
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="service-package__item">
                            <div class="service-package__item__img service-package__item__img_5"></div>
                            <div class="service-package__item__text">Оценка юридической чистоты объекта</div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="service-package__item">
                            <div class="service-package__item__img service-package__item__img_6"></div>
                            <div class="service-package__item__text">Гарантии сделки</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="favorably">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-lg-7">
                        <h2 class="favorably__h2">Почему выгоднее покупать недвижимость через агентство «Квартирный
                            ответ»?</h2>
                    </div>
                    <div class="col-md-6">
                        <ol class="favorably__list">
                            <li class="favorably__list__item favorably__list__item_1">Агенты «Квартирного ответа» имеют
                                доступ к актуальным предложениям, которые обновляются в онлайн-режиме.
                            </li>
                            <li class="favorably__list__item favorably__list__item_2">Агентство на 100% защищает
                                покупателя от финансовых и юридических рисков.
                            </li>
                            <li class="favorably__list__item favorably__list__item_3">Риелтор полностью берет на себя
                                вопросы торга.
                            </li>
                            <li class="favorably__list__item favorably__list__item_4">Стоимость недвижимости через
                                агентство может быть выгоднее даже с учетом комиссии.
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="we-check-history">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="we-check-history__title">У каждой квартиры своя история, и мы готовы ее
                            проверить!</h2>
                        <p class="we-check-history__text">По статистике, в сделке купли-продажи недвижимости всегда
                            больше рискует покупатель. Обратившись к экспертам компании «Квартирный ответ», вы сможете
                            получить доступ к лучшим объектам по лучшим ценам. Мы ставим интересы клиентов на первое
                            место, а вы получаете очевидный результат<b> – юридически чистую квартиру по выгодной
                                стоимости без малейших рисков.</b></p>
                        <p class="we-check-history__text"><b>Самая большая сделка в Вашей жизни заслуживает того, чтобы
                                обратиться к профессионалам!</b></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="connect-consultant">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="connect-consultant__title">Свяжитесь с нашим представителем<br><span>чтобы получить подробную консультацию и начать поиск квартиры уже сегодня.</span>
                        </h3>
                        <form action="#" class="connect-consultant__form">
                            <input type="text" class="connect-consultant__form__input" name="name"
                                   placeholder="Ваше имя ">
                            <input type="tel" class="connect-consultant__form__input" name="tel"
                                   placeholder="Ваш телефон">
                            <button class="connect-consultant__form__button" type="submit">Получить консультацию
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <section class="realtors">
            <div class="realtor__title">
                <span> Наши специалисты готовы проконсультировать
                        Вас по любым вопросам</span>
            </div>
            <div class="container">
                <div class="realtors__carousel">
                    <div class="realtors__carousel__item">
                        <div class="realtors__carousel__item__wrap">
                            <div class="realtors__carousel__item__img">
                                <img src="/assets/img/ipothec-ava.jpg" alt="realtor">
                            </div>
                            <div class="realtors__carousel__item__description">
                                <div class="realtors__carousel__item__description__name">Медведева <br> Анастасия</div>
                                <div class="realtors__carousel__item__description__title">120 объектов</div>
                                <div class="realtors__carousel__item__description__tel__text">Связаться со мной!</div>
                                <div class="realtors__carousel__item__description__tel">8 (961) 991-09-11</div>
                                <div class="realtors__carousel__item__description__link">
                                    <a href="#">Жду звонка</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="realtors__carousel__item">
                        <div class="realtors__carousel__item__wrap">
                            <div class="realtors__carousel__item__img">
                                <img src="/assets/img/ipothec-ava.jpg" alt="realtor">
                            </div>
                            <div class="realtors__carousel__item__description">
                                <div class="realtors__carousel__item__description__name">Медведева <br> Анастасия</div>
                                <div class="realtors__carousel__item__description__title">120 объектов</div>
                                <div class="realtors__carousel__item__description__tel__text">Связаться со мной!</div>
                                <div class="realtors__carousel__item__description__tel">8 (961) 991-09-11</div>
                                <div class="realtors__carousel__item__description__link">
                                    <a href="#">Жду звонка</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="realtors__carousel__item">
                        <div class="realtors__carousel__item__wrap">
                            <div class="realtors__carousel__item__img">
                                <img src="/assets/img/ipothec-ava.jpg" alt="realtor">
                            </div>
                            <div class="realtors__carousel__item__description">
                                <div class="realtors__carousel__item__description__name">Медведева <br> Анастасия</div>
                                <div class="realtors__carousel__item__description__title">120 объектов</div>
                                <div class="realtors__carousel__item__description__tel__text">Связаться со мной!</div>
                                <div class="realtors__carousel__item__description__tel">8 (961) 991-09-11</div>
                                <div class="realtors__carousel__item__description__link">
                                    <a href="#">Жду звонка</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="realtors__carousel__item">
                        <div class="realtors__carousel__item__wrap">
                            <div class="realtors__carousel__item__img">
                                <img src="/assets/img/ipothec-ava.jpg" alt="realtor">
                            </div>
                            <div class="realtors__carousel__item__description">
                                <div class="realtors__carousel__item__description__name">Медведева <br> Анастасия</div>
                                <div class="realtors__carousel__item__description__title">120 объектов</div>
                                <div class="realtors__carousel__item__description__tel__text">Связаться со мной!</div>
                                <div class="realtors__carousel__item__description__tel">8 (961) 991-09-11</div>
                                <div class="realtors__carousel__item__description__link">
                                    <a href="#">Жду звонка</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="realtors__carousel__item">
                        <div class="realtors__carousel__item__wrap">
                            <div class="realtors__carousel__item__img">
                                <img src="/assets/img/ipothec-ava.jpg" alt="realtor">
                            </div>
                            <div class="realtors__carousel__item__description">
                                <div class="realtors__carousel__item__description__name">Медведева <br> Анастасия</div>
                                <div class="realtors__carousel__item__description__title">120 объектов</div>
                                <div class="realtors__carousel__item__description__tel__text">Связаться со мной!</div>
                                <div class="realtors__carousel__item__description__tel">8 (961) 991-09-11</div>
                                <div class="realtors__carousel__item__description__link">
                                    <a href="#">Жду звонка</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="realtors__carousel__item">
                        <div class="realtors__carousel__item__wrap">
                            <div class="realtors__carousel__item__img">
                                <img src="/assets/img/ipothec-ava.jpg" alt="realtor">
                            </div>
                            <div class="realtors__carousel__item__description">
                                <div class="realtors__carousel__item__description__name">Медведева <br> Анастасия</div>
                                <div class="realtors__carousel__item__description__title">120 объектов</div>
                                <div class="realtors__carousel__item__description__tel__text">Связаться со мной!</div>
                                <div class="realtors__carousel__item__description__tel">8 (961) 991-09-11</div>
                                <div class="realtors__carousel__item__description__link">
                                    <a href="#">Жду звонка</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="customer-reviews">
            <div class="container">
                <h2 class="customer-reviews__h2">«Отзывы наших клиентов»</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="customer-reviews__item">
                            <div class="customer-reviews__item__icon"></div>
                            <div class="customer-reviews__item__content">
                                <div class="customer-reviews__item__content__name">Дмитрий Иванов</div>
                                <span class="customer-reviews__item__content__time">27.09.2017</span>
                                <p class="customer-reviews__item__content__text">Свяжитесь с нашим представителем, чтобы
                                    получить бесплатную консультацию о продаже и пригласить риелтора на осмотр и
                                    оценку</p>
                                <a href="#" class="customer-reviews__item__content__detail"><span>Подробнее</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="customer-reviews__item">
                            <div class="customer-reviews__item__icon"></div>
                            <div class="customer-reviews__item__content">
                                <div class="customer-reviews__item__content__name">Дмитрий Иванов</div>
                                <span class="customer-reviews__item__content__time">27.09.2017</span>
                                <p class="customer-reviews__item__content__text">Свяжитесь с нашим представителем, чтобы
                                    получить бесплатную консультацию о продаже и пригласить риелтора на осмотр и
                                    оценку</p>
                                <a href="#" class="customer-reviews__item__content__detail"><span>Подробнее</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="customer-reviews__more icon-right-small" href="#">
                    <span>Показать еще</span>
                </a>
            </div>
        </div>

        <!-- end-  content-page_color      -->
    </div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>