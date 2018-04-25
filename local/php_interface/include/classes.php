<?php

\Bitrix\Main\Loader::includeModule('lema.lib');

class HomeClickExport extends \Lema\Base\XmlExport
{
    /**
     * Show YML file
     *
     * @param array $params
     * @return mixed
     *
     * @access public
     */
    public function showData(array $params = array())
    {
        if(!empty($params['sendHeader']))
        {
            header('Content-type: text/xml; charset=' . SITE_CHARSET);
        }

        ?><<?php ?>?xml version="1.0" encoding="<?=SITE_CHARSET?>"?>
<realty-feed xmlns="http://webmaster.yandex.ru/schemas/feed/realty/2010-06">
    <generation-date><?=isset($this->time) ? date('c', $this->time) : date('c')?></generation-date>
    <?foreach($this->products as $id => $info):
        $alternateDescr = null;
        ?>

        <offer internal-id="<?=$id?>">
            <url><?=$this->serverUrl?><?=$info['url']?>/</url>
            <?foreach($params['fields'] as $name => $key):?>
                <<?=$name;?>><?=isset($info[$key]) ? htmlspecialcharsbx($info[$key]) : null;?></<?=$name?>>
            <?endforeach;?>
            <type><?=$info['type']?></type>
            <category><?=$info['category']?></category>
            <property-type><?=$info['property-type']?></property-type>
            <creation-date><?=$info['creation-date']?></creation-date>
            <last-update-date><?=$info['last-update-date']?></last-update-date>
            <location>
                <country><?=$info['country']?></country>
                <locality-name><?=$info['locality-name']?></locality-name>
                <sub-locality-name><?=$info['sub-locality-name']?></sub-locality-name>
                <address><?=$info['address']?></address>
            </location>
            <sales-agent>
                <name><?=$info['PROPERTY_USER_NAME_VALUE'];?></name>
                <phone><?=$info['PROPERTY_USER_PHONE_VALUE'];?></phone>
                <email><?=$info['PROPERTY_USER_EMAIL_VALUE'];?></email>
                <organization></organization>
                <url></url>
                <photo></photo>
                <category>owner</category>
            </sales-agent>
            <price>
                <value><?=$info['PROPERTY_PRICE_VALUE'];?></value>
                <currency>RUR</currency>
                <unit></unit>
            </price>
            <area>
                <value><?=$info['PROPERTY_SQUARE_VALUE'];?></value>
                <unit>кв. м</unit>
            </area>
            <?if(!empty($info['PROPERTY_SQUARE_LAND_VALUE'])):?>
                <living-space>
                    <value><?=$info['PROPERTY_SQUARE_RESIDENT_VALUE'];?></value>
                    <unit>кв. м</unit>
                </living-space>
            <?endif;?>
             <?if(!empty($info['PROPERTY_SQUARE_LAND_VALUE'])):?>
                <kitchen-space>
                    <value><?=$info['PROPERTY_SQUARE_KITCHEN_VALUE'];?></value>
                    <unit>кв. м</unit>
                </kitchen-space>
            <?endif;?>
            <?if(!empty($info['PROPERTY_SQUARE_LAND_VALUE'])):?>
                <lot-area>
                    <value><?=$info['PROPERTY_SQUARE_LAND_VALUE'];?></value>
                    <unit>кв. м</unit>
                </lot-area>
            <?endif;?>
            <?if(!empty($info['images'])):?>
                <?foreach($info['images'] as $src):?>
                    <image><?=$this->serverUrl . $src;?></image>
                <?endforeach;?>
            <?endif;?>
            <?if(!empty($info['PROPERTY_REPAIR_TYPE_VALUE'])):?>
                <renovation><?=$info['PROPERTY_REPAIR_TYPE_VALUE'];?></renovation>
            <?endif;?>
            <?if(!empty($info['PROPERTY_ROOMS_COUNT_VALUE'])):?>
                <rooms><?=$info['PROPERTY_ROOMS_COUNT_VALUE'];?></rooms>
            <?endif;?>
            <?if(!empty($info['PROPERTY_PROPOSED_ROOMS_COUNT_VALUE'])):?>
                <rooms-offered><?=$info['PROPERTY_PROPOSED_ROOMS_COUNT_VALUE'];?></rooms-offered>
            <?endif;?>
            <?if(!empty($info['PROPERTY_STAGE_VALUE'])):?>
                <floor><?=$info['PROPERTY_STAGE_VALUE'];?></floor>
            <?endif;?>
            <?if(!empty($info['PROPERTY_BATHROOM_VALUE'])):?>
                <bathroom-unit><?=$info['PROPERTY_BATHROOM_VALUE'];?></bathroom-unit>
            <?endif;?>
            <phone><?=(int) empty($info['PROPERTY_PHONE_VALUE']);?></phone>
            <television><?=(int) empty($info['PROPERTY_PHONE_VALUE']);?></television>
            <?if(!empty($params['params'])):?>
                    <?foreach($params['params'] as $data):
                        if(empty($info[$data[1]]))
                            continue;
                        $alternateDescr .= $data[0] . ': ' . $info[$data[1]] . ';' . PHP_EOL;
                        ?>
                        <param name="<?=$data[0];?>"<?if(isset($data['unit'])){?>
                            unit="<?=$data['unit']?>"<?}?>><?=htmlspecialcharsbx($info[$data[1]]);?></param>
                    <?endforeach;?>
                <?endif;?>
            <?
            $description = trim($info[(empty($info['DETAIL_TEXT']) ? 'PREVIEW' : 'DETAIL') . '_TEXT']);
            if(empty($description))
                $description = trim($alternateDescr);
            ?>
            <description><?=htmlspecialcharsbx($description);?></description>

        </offer>

    <?endforeach;?>
</realty-feed>
        <?php
    }
}