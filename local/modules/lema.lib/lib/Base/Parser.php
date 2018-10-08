<?php

namespace Lema\Base;



use voku\helper\HtmlDomParser;
use voku\helper\SimpleHtmlDomNodeBlank;

class Parser extends StaticInstance
{
    protected $elements = [];
    protected $url = null;
    protected $data = null;

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }
    public function getElements()
    {
        return $this->getElements();
    }
    public function parse($headers=NULL, $body=NULL, $options=NULL)
    {
        error_reporting(-1);
        ini_set('display_errors', 1);

        $hostUrl = parse_url($this->url, PHP_URL_SCHEME) . '://' . parse_url($this->url, PHP_URL_HOST);

        $this->data = HtmlDomParser::file_get_html($this->url);

        $links = [];
        foreach($this->data->find('.object.teaser.city.buy.clearfix') as $item)
        {
            $links[] = $hostUrl . $item->findOne('a')->getAttribute('href');
        }
        $i = 0;
        $links = array_unique($links);

        foreach($links as $link)
        {
            if(++$i === 3)
                break;
            $data = HtmlDomParser::file_get_html($link);
            $props = [];
            foreach($data->find('.line.clearfix') as $prop)
            {
                $value = null;
                if(($value = $prop->findOne('.value > .ccy-option.ccy-rub')) instanceof SimpleHtmlDomNodeBlank)
                    if(($value = $prop->findOne('.value > a')) instanceof SimpleHtmlDomNodeBlank)
                        $value = $prop->findOne('.value');
                if(!empty($value))
                    $props[$prop->findOne('.title')->innerText()] = trim(strip_tags($value->innerText()));
            }
            var_dump($props);
            echo '<hr>';
        }
    }
}