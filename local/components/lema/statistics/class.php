<?php

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

CJSCore::init(array('fx'));

class StatisticsComponent extends \CBitrixComponent
{

    public function executeComponent()
    {
        $this->includeComponentTemplate();
    }


    public function getTotalObjectsCount()
    {
        return \Bitrix\Iblock\ElementTable::getCount(array(
            'ACTIVE' => 'Y',
            'IBLOCK_ID' => $this->arParams['IBLOCK_ID']
        ));
    }

    public function getTotalWorkObjectsCount()
    {
        return \Bitrix\Iblock\ElementTable::getCount(array(
            'ACTIVE' => 'Y',
            'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
            'IBLOCK_SECTION.CODE' => 'active',
        ));
    }

    public function getTotalRieltorObjectsCount()
    {
        return $this->getObjectsCountByFilter(array('!PROPERTY_RIELTOR' => false));
    }

    public function getTotalDepositObjectsCount()
    {
        return $this->getObjectsCountByFilter(array('PROPERTY_DEPOSIT_VALUE' => 'Y'));
    }

    public function getTotalTodayObjectsCount()
    {
        return $this->getObjectsCountByFilter(array('>=DATE_CREATE' => date('d.m.Y', \strtotime('midnight'))));
    }

    public function getObjectsCount(array $filter = array())
    {
        return $this->getObjectsCountByFilter($filter);
    }

    protected function getObjectsCountByFilter(array $filter = array(), $active = 'Y')
    {
        if(empty($filter['IBLOCK_ID']))
            $filter['IBLOCK_ID'] = $this->arParams['IBLOCK_ID'];
        if(!empty($active))
            $filter['ACTIVE'] = $active;
        $res = \CIBlockElement::GetList(array(), $filter, false,false, array('ID'));
        return $res->SelectedRowsCount();
    }
}