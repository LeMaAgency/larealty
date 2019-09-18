<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Кредитование");
?>
<div class="container">
    <blockquote>
    </blockquote>
    <h2>&nbsp; &nbsp; Кредитование</h2>
    <hr>
    <p style="margin: 0px 0px 0px 40px; border: none; padding: 0px;">
        Предложение об установлении лимита на объект коммерческой недвижимости.
    </p>
    <p style="margin: 0px 0px 0px 40px; border: none; padding: 0px;">
        Если вы брокер или владелец объекта коммерческой недвижимости, желающий продать объект, то благодаря нашим услугам, вы можете под ваш объект предложить кредит. Мы устанавливаем кредитные лимиты от ведущих от банков.<br>
        Для предварительного расчета суммы кредита необходимы данные по арендным платежам и расходам, плюс карточка 51 счета за 12 последних месяцев. Лимит равен примерно один месяц арендного потока с учётом вычета расходов и до налога умноженное на 50.<br>
        Если предварительно рассчитанная сумма вас устраивает, проводится оценка со стороны банка с предоставлением расширенного списка документов.<br>
        Расчет кредитного лимита - 60 000 руб.<br>
        Преимущества при продаже вашего объекта с помощью кредита:<br>
        Расширение круга возможных покупателей объекта, так как данный лимит позволит потенциальным покупателям оплатить только разницу между стоимостью продажи объекта и кредитным лимитом. Количество покупателей с меньшим количеством денег в кармане, желающих купить готовый арендный бизнес значительно больше, чем с суммой наличных на всю стоимость объекта.<br>
        Сокращение времени на сделку купли-продажи. Если каждый из потенциальных покупателей будет самостоятельно пытаться взять кредит для приобретения объекта, это превратится в головную боль для продавца, потому что каждому их них надо будет выдать по одинаковому пакету документов. Лучше это сделать один раз.<br>
        Данный лимит может также может позволить повысить стоимость объекта. Повышение конечной стоимости объекта может быть воспринята покупателем спокойно, так как сумма собственных средств все равно меньше стоимости объекта на сумму кредита банка.
    </p>
    &nbsp;
    <h2></h2>
    <br>
    <br>
</div>
    <section class="help">
        <div class="container">
            <div class="help-form">
                <form action="<?= SITE_DIR; ?>ajax/feedback-form.php" class="js-feedback-form" method="POST">
                    <h2 class="section-h2">
                        <? $APPLICATION->IncludeFile(SITE_DIR . 'include/footer/feedback_title.php'); ?>
                    </h2>
                    <div class="form-row">
                        <div class="it-block">
                            <input type="text" placeholder="Имя *" name="name" required>
                            <div class="it-error"></div>
                        </div>
                        <div class="it-block">
                            <input type="text" placeholder="Телефон *" name="phone" required>
                            <div class="it-error"></div>
                        </div>
                        <div class="it-block">
                            <input type="text" placeholder="E-mail *" name="email" required>
                            <div class="it-error"></div>
                        </div>
                    </div>
                    <div class="help-consent">
                        <? $APPLICATION->IncludeFile(SITE_DIR . 'include/footer/personal_data_text.php'); ?>
                    </div>
                    <div class="help-btn">
                        <button class="hover-black">
                            Отправить заявку
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>