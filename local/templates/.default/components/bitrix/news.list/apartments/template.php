<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$data = new \Lema\Template\TemplateHelper($this);

?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

<section class="cards-flat">
<?foreach($data->items() as $item):?>
    <div class="card-flat card-flat_bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <a class="card-flat__img">
                        <img alt="<?=$item->getName();?>"  src="<?=$item->previewPicture();?>">
                        <span class="card-flat__img__filter"></span>
                    </a>
                </div>
                <div class="col-sm-8">
                    <div class="card-flat__content">
                        <div class="card-flat__content__head clearfix">
                            <h3 class="card-flat__content__head__title"><?=$item->getName();?></h3>
                            <div class="card-flat__content__head__price"><b><?=$item->propVal('PRICE');?></b> руб</div>
                        </div>
                        <div class="offers-item-info clearfix">
                            <div class="item-info item-info_room">
                                <div class="item-info__inner">
                                    <div class="item-info__inner__img item-info__inner__img_room"></div>
                                    <div class="item-info__inner__content">
                                        <div class="item-info-name">Кол-во комнат</div>
                                        <div class="item-info-value"><?=$item->propVal('ROOMS_COUNT');?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-info item-info_floor">
                                <div class="item-info__inner">
                                    <div class="item-info__inner__img item-info__inner__img_floor"></div>
                                    <div class="item-info__inner__content">
                                        <div class="item-info-name">Этаж</div>
                                        <div class="item-info-value"><?=$item->propVal('STAGE');?>/<?=$item->propVal('STAGES_COUNT');?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-info item-info_area">
                                <div class="item-info__inner">
                                    <div class="item-info__inner__img item-info__inner__img_area"></div>
                                    <div class="item-info__inner__content">
                                        <div class="item-info-name">Площадь</div>
                                        <div class="item-info-value"><?=$item->propVal('SQUARE');?>м<sup>2</sup></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="" class="card-flat__content__favorites"><span>Добавить в избранное</span></a>
                        <p class="card-flat__content__address icon-location"><?=$item->propVal('ADDRESS');?></p>
                        <p class="card-flat__content__text"><?=$item->detailText();?></p>
                        <div class="offers-item-more offers-item-more_text-right">Подробнее<i class="more-icon"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?endforeach;?>
    <div class="pagination-catalog">
        <div class="container">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li>
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&#8249;</span>
                        </a>
                    </li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li>
                        <a href="#" aria-label="Next">
                            <span aria-hidden="true">&#8250;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</section>