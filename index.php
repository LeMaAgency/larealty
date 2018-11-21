<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Карточка товара");
?>
<div class="item-card">
    <div class="container">
        <div class="breadcrumbs">
            <ul>
                <li><a href="#">Главная</a></li>
                <li><a href="#">Зарубежная недвижимость</a></li>
                <li><a href="#">Элитные квартиры</a></li>
                <li>Название объекта</li>
            </ul>
        </div>
        <h1 class="item-title">Новый Арбат, 27</h1>
        <div class="item-id">ID: 23639</div>
    </div>

    <div class="item-card_photo">
        <div><img src="/assets/img/photo1.png" alt=""></div>
        <div><img src="/assets/img/photo1.png" alt=""></div>
        <div><img src="/assets/img/photo1.png" alt=""></div>
    </div>

    <div class="container">
        <div class="item-card_info">
            <div class="item-card_left">
                <div class="item-card_price">
                    <div class="item-card_price-coutn"><span>361 977 000</span></div>
                    <div class="item-card_price-for"><span>853 368</span></div>
                </div>
                <div class="button-currency">
                    <div class="currency-item1"></div>
                    <div class="currency-item2"></div>
                    <div class="currency-item3"></div>
                    <div class="currency-item4"></div>
                    <div class="currency-item5"></div>
                </div>
            </div>
            <div class="item-card_right">
                <div class="item-card_button">
                    <a class="hover-black" href="#">Назначить просмотр</a>
                    <a class="hover-black" href="#">Предложить цену</a>
                </div>
                <div class="item-card_phone">
                    <span>Или позвоните нам: </span><a href="#">+7 (495) 151-90-00</a>
                </div>
            </div>
        </div>
        <div class="item-card_list-icon">
            <div class="item-card_icon"><img src="/assets/img/house.png" alt="">4 этаж</div>
            <div class="item-card_icon"><img src="/assets/img/room.png" alt="">4 комнаты</div>
            <div class="item-card_icon"><img src="/assets/img/valik.png" alt="">С отделкой</div>
            <div class="item-card_icon"><img src="/assets/img/area-icon.png" alt="">283 м²</div>
            <div class="item-card_icon"><img src="/assets/img/beds.png" alt="">3 спальни</div>
            <div class="item-card_icon"><img src="/assets/img/room.png" alt="">Продажа</div>
            <div class="item-card_icon"><img src="/assets/img/valik.png" alt="">С лифтом</div>
            <div class="item-card_icon"><img src="/assets/img/area-icon.png" alt="">Паркинг</div>
        </div>
    </div>
    <div class="card-characteristics">
        <div class="container">
            <h3>Характеристики</h3>
            <div class="characteristics-list">
                <div class="characteristics-item">
                    <div class="characteristics-name"><span>Станция метро:</span></div>
                    <div class="characteristics-info">Спортивная</div>
                </div>
                <div class="characteristics-item">
                    <div class="characteristics-name"><span>Название:</span></div>
                    <div class="characteristics-info">Вишневый сад</div>
                </div>
                <div class="characteristics-item">
                    <div class="characteristics-name"><span>Район:</span></div>
                    <div class="characteristics-info">ЗАО</div>
                </div>
                <div class="characteristics-item">
                    <div class="characteristics-name"><span>Парковка:</span></div>
                    <div class="characteristics-info">подземная</div>
                </div>
                <div class="characteristics-item">
                    <div class="characteristics-name"><span>Сдача ГК:</span></div>
                    <div class="characteristics-info">4-й квартал 2019 год</div>
                </div>
                <div class="characteristics-item">
                    <div class="characteristics-name"><span>Материал дома:</span></div>
                    <div class="characteristics-info">Монолит</div>
                </div>
                <div class="characteristics-item">
                    <div class="characteristics-name"><span>Тип перекрытий:</span></div>
                    <div class="characteristics-info">Ж/Б</div>
                </div>
                <div class="characteristics-item">
                    <div class="characteristics-name"><span>Охрана:</span></div>
                    <div class="characteristics-info">закрытая территория, круглосуточная охрана, видеонаблюдение, система контроля доступа</div>
                </div>
                <div class="characteristics-item">
                    <div class="characteristics-name"><span>Инфраструктура:</span></div>
                    <div class="characteristics-info">частный детский сад, детские и спортивные площадки, кафе, фитнес-зал с собственным бассейном и SPA</div>
                </div>
                <div class="characteristics-item">
                    <div class="characteristics-name"><span>Благоустройство территории:</span></div>
                    <div class="characteristics-info">ландшафтное озеленение</div>
                </div>
                <div class="characteristics-item">
                    <div class="characteristics-name"><span>Окна:</span></div>
                    <div class="characteristics-info">панорамные</div>
                </div>
                <div class="characteristics-item">
                    <div class="characteristics-name"><span>Инфраструктура района:</span></div>
                    <div class="characteristics-info">Воробьевы горы, МГУ. набережные Москвы-реки, Лужники, фитнес-клубы, магазины, школы, детские сады, аптеки, поликлиники, банки</div>
                </div>
            </div>
            <div class="characteristics-link">
                <a href="#" class="hover-black link-presentation">Презентация</a>
                <a href="#" class="hover-black link-plan">Планировки</a>
            </div>
        </div>
    </div>
    <div class="card-item_map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d25381.010557235022!2d37.54320767114695!3d55.78654223964656!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b54997e6b66aa1%3A0xa0f94d7b5f575b86!2z0KbQodCa0JA!5e0!3m2!1sru!2sus!4v1542443384427" width="100%" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
    <div class="item-card_desc">
        <div class="container">
            <h2>Золотые Ключи-1</h2>
            <p>Лот: 23639. - Панорамные виды на центр города
                Видовая пятикомнатная квартира под отделку площадью 251,5 кв м расположена на восьмом этаже фешенебельного жилого дома на Новом Арбате. Квартира обладает уникальными видовыми характеристиками: обширное панорамное остекление открывает потрясающий обзор города 300 градусов, в том числе роскошные виды на исторический центр столицы, Москву-реку, Дом Правительства и гостиницу "Украина". Планировка включает большую кухню-столовую-гостиную с видами на Новый Арбат и Белый Дом, три спальни, три санузла, две гардеробные комнаты и постирочную. Два машиноместа в подземном паркинге входят с стоимость.</p>
            <div class="desc-link">
                <a href="#" class="hover-black link-share">Поделиться</a>
                <a href="#" class="hover-black link-favorite">В избранное</a>
            </div>
        </div>
    </div>
</div>

<div class="more-offer">
    <div class="container">
        <h2>Другие предложения в этом ЖК</h2>
        <table class="offer-table">
            <thead>
            <tr>
                <td>ID</td>
                <td>Тип</td>
                <td>Этаж</td>
                <td>Кол-во комнат</td>
                <td>Площадь, кв.м.	</td>
                <td>Цена</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><span class="dn">ID:</span><a href="#" class="table-link">51734</a></td>
                <td><span class="dn">Тип:</span>Квартира</td>
                <td><span class="dn">Этаж:</span>2</td>
                <td><span class="dn">Кол-во комнат:</span>1</td>
                <td><span class="dn">Площадь, кв.м.:</span>60</td>
                <td><span class="dn">Цена:</span><span class="table-price">23 126 700 000</span></td>
            </tr>
            <tr>
                <td><span class="dn">ID:</span><a href="#" class="table-link">51734</a></td>
                <td><span class="dn">Тип:</span>Квартира</td>
                <td><span class="dn">Этаж:</span>2</td>
                <td><span class="dn">Кол-во комнат:</span>1</td>
                <td><span class="dn">Площадь, кв.м.:</span>60</td>
                <td><span class="dn">Цена:</span><span class="table-price">23 126 700 000</span></td>
            </tr>
            <tr>
                <td><span class="dn">ID:</span><a href="#" class="table-link">51734</a></td>
                <td><span class="dn">Тип:</span>Квартира</td>
                <td><span class="dn">Этаж:</span>2</td>
                <td><span class="dn">Кол-во комнат:</span>1</td>
                <td><span class="dn">Площадь, кв.м.:</span>60</td>
                <td><span class="dn">Цена:</span><span class="table-price">23 126 700 000</span></td>
            </tr>
            <tr>
                <td><span class="dn">ID:</span><a href="#" class="table-link">51734</a></td>
                <td><span class="dn">Тип:</span>Квартира</td>
                <td><span class="dn">Этаж:</span>2</td>
                <td><span class="dn">Кол-во комнат:</span>1</td>
                <td><span class="dn">Площадь, кв.м.:</span>60</td>
                <td><span class="dn">Цена:</span><span class="table-price">23 126 700 000</span></td>
            </tr>
            <tr>
                <td><span class="dn">ID:</span><a href="#" class="table-link">51734</a></td>
                <td><span class="dn">Тип:</span>Квартира</td>
                <td><span class="dn">Этаж:</span>2</td>
                <td><span class="dn">Кол-во комнат:</span>1</td>
                <td><span class="dn">Площадь, кв.м.:</span>60</td>
                <td><span class="dn">Цена:</span><span class="table-price">23 126 700 000</span></td>
            </tr>
            <tr>
                <td><span class="dn">ID:</span><a href="#" class="table-link">51734</a></td>
                <td><span class="dn">Тип:</span>Квартира</td>
                <td><span class="dn">Этаж:</span>2</td>
                <td><span class="dn">Кол-во комнат:</span>1</td>
                <td><span class="dn">Площадь, кв.м.:</span>60</td>
                <td><span class="dn">Цена:</span><span class="table-price">23 126 700 000</span></td>
            </tr>
            <tr>
                <td><span class="dn">ID:</span><a href="#" class="table-link">51734</a></td>
                <td><span class="dn">Тип:</span>Квартира</td>
                <td><span class="dn">Этаж:</span>2</td>
                <td><span class="dn">Кол-во комнат:</span>1</td>
                <td><span class="dn">Площадь, кв.м.:</span>60</td>
                <td><span class="dn">Цена:</span><span class="table-price">23 126 700 000</span></td>
            </tr>
            <tr>
                <td><span class="dn">ID:</span><a href="#" class="table-link">51734</a></td>
                <td><span class="dn">Тип:</span>Квартира</td>
                <td><span class="dn">Этаж:</span>2</td>
                <td><span class="dn">Кол-во комнат:</span>1</td>
                <td><span class="dn">Площадь, кв.м.:</span>60</td>
                <td><span class="dn">Цена:</span><span class="table-price">23 126 700 000</span></td>
            </tr>
            <tr>
                <td><span class="dn">ID:</span><a href="#" class="table-link">51734</a></td>
                <td><span class="dn">Тип:</span>Квартира</td>
                <td><span class="dn">Этаж:</span>2</td>
                <td><span class="dn">Кол-во комнат:</span>1</td>
                <td><span class="dn">Площадь, кв.м.:</span>60</td>
                <td><span class="dn">Цена:</span><span class="table-price">23 126 700 000</span></td>
            </tr>
            <tr>
                <td><span class="dn">ID:</span><a href="#" class="table-link">51734</a></td>
                <td><span class="dn">Тип:</span>Квартира</td>
                <td><span class="dn">Этаж:</span>2</td>
                <td><span class="dn">Кол-во комнат:</span>1</td>
                <td><span class="dn">Площадь, кв.м.:</span>60</td>
                <td><span class="dn">Цена:</span><span class="table-price">23 126 700 000</span></td>
            </tr>
            </tbody>
        </table>
        <div class="more-offer_link"><a class="hover-black" href="#">Показать все <span>(130 предложений)</span></a></div>
    </div>
</div>
<section class="popularoffer">
    <div class="container">
        <h2>Популярные объекты</h2>
        <div class="offer-tabs">
            <div class="tabs">
                <div class="tab active">По бюджету</div>
                <div class="tab">В доме</div>
                <div class="tab">В районе</div>
            </div>
            <div class="content">
                <div class="tab-cont active">
                    <div class="newoffer-slider">
                        <div class="new-item">
                            <div class="offer-item">
                                <div class="offer-title"><a href="#"><span>Дом — Новахово</span><i class="click-area"></i></a></div>
                                <div class="offer-adress"><img src="/assets/img/location-icon.png" alt=""><span>Новорижское шоссе</span></div>
                                <div class="offer-img"><img src="/assets/img/o7.png" alt="offer-img"></div>
                                <div class="offer-detail">
                                    <div class="detail detail-metro"><img src="/assets/img/metro-icon.png" alt="metro"><span>Тульская</span></div>
                                    <div class="detail detail-area"><img src="/assets/img/area-icon.png" alt="area"><span>68-6912 м2</span></div>
                                    <div class="detail detail-class"><img src="/assets/img/class-icon.png" alt="class"><span>Класс А</span></div>
                                </div>
                                <div class="offer-price"><span>184 279 200</span></div>
                            </div>
                        </div>
                        <div class="new-item">
                            <div class="offer-item">
                                <div class="offer-title"><a href="#"><span>Офис — ЖК Онегин</span><i class="click-area"></i></a></div>
                                <div class="offer-adress"><img src="/assets/img/location-icon.png" alt=""><span>ЦАО, Якиманка, Полянка М. улица, д.2</span></div>
                                <div class="offer-img"><img src="/assets/img/o8.png" alt="offer-img"></div>
                                <div class="offer-detail">
                                    <div class="detail detail-metro"><img src="/assets/img/metro-icon.png" alt="metro"><span>Тульская</span></div>
                                    <div class="detail detail-area"><img src="/assets/img/area-icon.png" alt="area"><span>68-6912 м2</span></div>
                                    <div class="detail detail-class"><img src="/assets/img/class-icon.png" alt="class"><span>Класс А</span></div>
                                </div>
                                <div class="offer-price"><span>182 350 000</span>за объект</div>
                            </div>
                        </div>
                        <div class="new-item">
                            <div class="offer-item">
                                <div class="offer-title"><a href="#"><span>Дом — Новоалександрово</span><i class="click-area"></i></a></div>
                                <div class="offer-adress"><img src="/assets/img/location-icon.png" alt=""><span>Дмитровское шоссе</span></div>
                                <div class="offer-img"><img src="/assets/img/o6.png" alt="offer-img"></div>
                                <div class="offer-detail">
                                    <div class="detail detail-metro"><img src="/assets/img/metro-icon.png" alt="metro"><span>Тульская</span></div>
                                    <div class="detail detail-area"><img src="/assets/img/area-icon.png" alt="area"><span>68-6912 м2</span></div>
                                    <div class="detail detail-class"><img src="/assets/img/class-icon.png" alt="class"><span>Класс А</span></div>
                                </div>
                                <div class="offer-price"><span>361 977 000</span></div>
                            </div>
                        </div>
                        <div class="new-item">
                            <div class="offer-item">
                                <div class="offer-title"><a href="#"><span>Дом — Новоалександрово</span><i class="click-area"></i></a></div>
                                <div class="offer-adress"><img src="/assets/img/location-icon.png" alt=""><span>Дмитровское шоссе</span></div>
                                <div class="offer-img"><img src="/assets/img/o6.png" alt="offer-img"></div>
                                <div class="offer-detail">
                                    <div class="detail detail-metro"><img src="/assets/img/metro-icon.png" alt="metro"><span>Тульская</span></div>
                                    <div class="detail detail-area"><img src="/assets/img/area-icon.png" alt="area"><span>68-6912 м2</span></div>
                                    <div class="detail detail-class"><img src="/assets/img/class-icon.png" alt="class"><span>Класс А</span></div>
                                </div>
                                <div class="offer-price"><span>361 977 000</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-cont">
                    <div class="newoffer-slider">
                        <div class="new-item">
                            <div class="offer-item">
                                <div class="offer-title"><a href="#"><span>Дом — Новахово</span><i class="click-area"></i></a></div>
                                <div class="offer-adress"><img src="/assets/img/location-icon.png" alt=""><span>Новорижское шоссе</span></div>
                                <div class="offer-img"><img src="/assets/img/o7.png" alt="offer-img"></div>
                                <div class="offer-detail">
                                    <div class="detail detail-metro"><img src="/assets/img/metro-icon.png" alt="metro"><span>Тульская</span></div>
                                    <div class="detail detail-area"><img src="/assets/img/area-icon.png" alt="area"><span>68-6912 м2</span></div>
                                    <div class="detail detail-class"><img src="/assets/img/class-icon.png" alt="class"><span>Класс А</span></div>
                                </div>
                                <div class="offer-price"><span>184 279 200</span></div>
                            </div>
                        </div>
                        <div class="new-item">
                            <div class="offer-item">
                                <div class="offer-title"><a href="#"><span>Офис — ЖК Онегин</span><i class="click-area"></i></a></div>
                                <div class="offer-adress"><img src="/assets/img/location-icon.png" alt=""><span>ЦАО, Якиманка, Полянка М. улица, д.2</span></div>
                                <div class="offer-img"><img src="/assets/img/o8.png" alt="offer-img"></div>
                                <div class="offer-detail">
                                    <div class="detail detail-metro"><img src="/assets/img/metro-icon.png" alt="metro"><span>Тульская</span></div>
                                    <div class="detail detail-area"><img src="/assets/img/area-icon.png" alt="area"><span>68-6912 м2</span></div>
                                    <div class="detail detail-class"><img src="/assets/img/class-icon.png" alt="class"><span>Класс А</span></div>
                                </div>
                                <div class="offer-price"><span>182 350 000</span>за объект</div>
                            </div>
                        </div>
                        <div class="new-item">
                            <div class="offer-item">
                                <div class="offer-title"><a href="#"><span>Дом — Новоалександрово</span><i class="click-area"></i></a></div>
                                <div class="offer-adress"><img src="/assets/img/location-icon.png" alt=""><span>Дмитровское шоссе</span></div>
                                <div class="offer-img"><img src="/assets/img/o6.png" alt="offer-img"></div>
                                <div class="offer-detail">
                                    <div class="detail detail-metro"><img src="/assets/img/metro-icon.png" alt="metro"><span>Тульская</span></div>
                                    <div class="detail detail-area"><img src="/assets/img/area-icon.png" alt="area"><span>68-6912 м2</span></div>
                                    <div class="detail detail-class"><img src="/assets/img/class-icon.png" alt="class"><span>Класс А</span></div>
                                </div>
                                <div class="offer-price"><span>361 977 000</span></div>
                            </div>
                        </div>
                        <div class="new-item">
                            <div class="offer-item">
                                <div class="offer-title"><a href="#"><span>Дом — Новоалександрово</span><i class="click-area"></i></a></div>
                                <div class="offer-adress"><img src="/assets/img/location-icon.png" alt=""><span>Дмитровское шоссе</span></div>
                                <div class="offer-img"><img src="/assets/img/o6.png" alt="offer-img"></div>
                                <div class="offer-detail">
                                    <div class="detail detail-metro"><img src="/assets/img/metro-icon.png" alt="metro"><span>Тульская</span></div>
                                    <div class="detail detail-area"><img src="/assets/img/area-icon.png" alt="area"><span>68-6912 м2</span></div>
                                    <div class="detail detail-class"><img src="/assets/img/class-icon.png" alt="class"><span>Класс А</span></div>
                                </div>
                                <div class="offer-price"><span>361 977 000</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-cont">
                    <div class="newoffer-slider">
                        <div class="new-item">
                            <div class="offer-item">
                                <div class="offer-title"><a href="#"><span>Дом — Новахово</span><i class="click-area"></i></a></div>
                                <div class="offer-adress"><img src="/assets/img/location-icon.png" alt=""><span>Новорижское шоссе</span></div>
                                <div class="offer-img"><img src="/assets/img/o7.png" alt="offer-img"></div>
                                <div class="offer-detail">
                                    <div class="detail detail-metro"><img src="/assets/img/metro-icon.png" alt="metro"><span>Тульская</span></div>
                                    <div class="detail detail-area"><img src="/assets/img/area-icon.png" alt="area"><span>68-6912 м2</span></div>
                                    <div class="detail detail-class"><img src="/assets/img/class-icon.png" alt="class"><span>Класс А</span></div>
                                </div>
                                <div class="offer-price"><span>184 279 200</span></div>
                            </div>
                        </div>
                        <div class="new-item">
                            <div class="offer-item">
                                <div class="offer-title"><a href="#"><span>Офис — ЖК Онегин</span><i class="click-area"></i></a></div>
                                <div class="offer-adress"><img src="/assets/img/location-icon.png" alt=""><span>ЦАО, Якиманка, Полянка М. улица, д.2</span></div>
                                <div class="offer-img"><img src="/assets/img/o8.png" alt="offer-img"></div>
                                <div class="offer-detail">
                                    <div class="detail detail-metro"><img src="/assets/img/metro-icon.png" alt="metro"><span>Тульская</span></div>
                                    <div class="detail detail-area"><img src="/assets/img/area-icon.png" alt="area"><span>68-6912 м2</span></div>
                                    <div class="detail detail-class"><img src="/assets/img/class-icon.png" alt="class"><span>Класс А</span></div>
                                </div>
                                <div class="offer-price"><span>182 350 000</span>за объект</div>
                            </div>
                        </div>
                        <div class="new-item">
                            <div class="offer-item">
                                <div class="offer-title"><a href="#"><span>Дом — Новоалександрово</span><i class="click-area"></i></a></div>
                                <div class="offer-adress"><img src="/assets/img/location-icon.png" alt=""><span>Дмитровское шоссе</span></div>
                                <div class="offer-img"><img src="/assets/img/o6.png" alt="offer-img"></div>
                                <div class="offer-detail">
                                    <div class="detail detail-metro"><img src="/assets/img/metro-icon.png" alt="metro"><span>Тульская</span></div>
                                    <div class="detail detail-area"><img src="/assets/img/area-icon.png" alt="area"><span>68-6912 м2</span></div>
                                    <div class="detail detail-class"><img src="/assets/img/class-icon.png" alt="class"><span>Класс А</span></div>
                                </div>
                                <div class="offer-price"><span>361 977 000</span></div>
                            </div>
                        </div>
                        <div class="new-item">
                            <div class="offer-item">
                                <div class="offer-title"><a href="#"><span>Дом — Новоалександрово</span><i class="click-area"></i></a></div>
                                <div class="offer-adress"><img src="/assets/img/location-icon.png" alt=""><span>Дмитровское шоссе</span></div>
                                <div class="offer-img"><img src="/assets/img/o6.png" alt="offer-img"></div>
                                <div class="offer-detail">
                                    <div class="detail detail-metro"><img src="/assets/img/metro-icon.png" alt="metro"><span>Тульская</span></div>
                                    <div class="detail detail-area"><img src="/assets/img/area-icon.png" alt="area"><span>68-6912 м2</span></div>
                                    <div class="detail detail-class"><img src="/assets/img/class-icon.png" alt="class"><span>Класс А</span></div>
                                </div>
                                <div class="offer-price"><span>361 977 000</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
