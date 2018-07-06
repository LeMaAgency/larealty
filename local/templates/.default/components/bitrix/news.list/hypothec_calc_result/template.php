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
use Lema\Common\Helper as H,
Lema\Template\TemplateHelper as TH,
Bitrix\Main\Localization\Loc;

if(empty($arResult['ITEMS']))
return ;

Loc::loadMessages(__FILE__);

$this->setFrameMode(true);

$data = new TH($this);

?>
<h2 class="calculator__h2">Выберите программу для получения одобрения</h2>
<div class="result">
    <table>
        <thead>
        <tr>
            <th scope="col"><?=Loc::getMessage('LEMA_HYPOTHEC_CALC_RESULT_BANK');?></th>
            <th scope="col"><?=Loc::getMessage('LEMA_HYPOTHEC_CALC_RESULT_PROGRAM');?></th>
            <th scope="col"><?=Loc::getMessage('LEMA_HYPOTHEC_CALC_RESULT_BET');?></th>
            <th scope="col"><?=Loc::getMessage('LEMA_HYPOTHEC_CALC_RESULT_PAY');?></th>
            <th scope="col"><?=Loc::getMessage('LEMA_HYPOTHEC_CALC_RESULT_MORE');?></th>
        </tr>
        </thead>
        <tbody>
        <?foreach($data->items() as $item):?>
            <tr <?=$item->editId()?>>
                <td scope="row" data-label="<?=Loc::getMessage('LEMA_HYPOTHEC_CALC_RESULT_BANK');?>">
                    <img src="<?=(!empty($item->get("SVG_PICTURE")))?$item->get("SVG_PICTURE"):$item->get("BANK_PICTURE") ?>" alt="<?=$item->get("BANK_NAME")?>">
                </td>
                <td data-label="<?=Loc::getMessage('LEMA_HYPOTHEC_CALC_RESULT_PROGRAM');?>"><?=$item->getName()?></td>
                <td data-label="<?=Loc::getMessage('LEMA_HYPOTHEC_CALC_RESULT_BET');?>"><?=$item->propVal('BANK_BET')?> %</td>
                <td data-label="<?=Loc::getMessage('LEMA_HYPOTHEC_CALC_RESULT_PAY');?>"><?=$item->propVal('MONTH_PAYMENT')?> руб</td>
                <td data-label="<?=Loc::getMessage('LEMA_HYPOTHEC_CALC_RESULT_MORE');?>">
                    <?if($item->propFilled('URL')):?>
                        <a href="<?=$item->propVal('URL');?>"><?=Loc::getMessage('LEMA_HYPOTHEC_CALC_RESULT_MORE');?></a>
                    <?endif;?>
                </td>
            </tr>
        <?endforeach;?>
        </tbody>
    </table>

</div>
