<?php

namespace Lema\Base;


use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class Parser extends StaticInstance
{
    protected $hostUrl = null;
    protected $url = null;

    protected $storeDir = null;
    protected $htmlStoreDir = null;

    const DATA_DIRECTORY = '/local/import/';

    private $client = null;

    public function __construct()
    {
        $this->client = new Client();
        $this->storeDir = $_SERVER['DOCUMENT_ROOT'] . static::DATA_DIRECTORY;
        $this->htmlStoreDir = $_SERVER['DOCUMENT_ROOT'] . static::DATA_DIRECTORY . 'html/';
    }

    public function setUrl($url)
    {
        $this->hostUrl = parse_url($url, PHP_URL_SCHEME) . '://' . parse_url($url, PHP_URL_HOST);
        $this->url = $url;
        return $this;
    }

    public function parse()
    {
        $crawler = new Crawler(null, $this->hostUrl);

        //first run
        $fileName = current($this->loadHtml($this->url));

        //load root links
        $links = $this->getRootLinks($crawler, $fileName);
        $fileNames = $this->loadHtml($links);
        //load offers links
        $offerLinks = $this->getOffersLinks($crawler, $fileNames);
        $offersNames = $this->loadHtml($offerLinks);
        //load inner offers links
        $innerOffersLinks = $this->getInnerOffers($crawler, $offersNames);
        $innerOffersNames = [];
        foreach($innerOffersLinks as $innerOffersLink)
        {
            $innerOffersNames[$innerOffersLink] = $this->loadHtml($innerOffersLink);
            //break;
        }
        //$innerOffersNames = $this->loadHtml(current($innerOffersLinks));
        //$props = $this->getProperties($crawler, $innerOffersNames);
    }
    public function getRootLinks($crawler, $fileName, $needUpdate = false)
    {
        if($needUpdate || !is_file($this->storeDir . 'links.json'))
        {
            $crawler->addHtmlContent(file_get_contents($fileName), 'UTF-8');
            $links = array_unique($crawler->filter('.object.teaser.city.buy.clearfix .image a')->each(function (Crawler $node) {
                return $node->link()->getUri();
            }));
            file_put_contents($this->storeDir . 'links.json', json_encode($links));
        }
        else
            $links = json_decode(file_get_contents($this->storeDir . 'links.json'), 1);

        return $links;
    }
    public function getOffersLinks($crawler, $fileNames, $needUpdate = false)
    {
        if($needUpdate || !is_file($this->storeDir . 'offers_links.json'))
        {
            $links = [];
            foreach ($fileNames as $url => $fileName)
            {
                $crawler->clear();
                $crawler->addHtmlContent(file_get_contents($fileName), 'UTF-8');
                $data = $crawler->filter('.object-offers-ajax');
                if ($data->count()) {
                    $links[$fileName] = rtrim(
                        $this->hostUrl . '/ajax/blackwood/offers?limit=all&' .
                        $data->attr('data-params'),
                        '&'
                    );
                }
            }
            file_put_contents($this->storeDir . 'offers_links.json', json_encode($links));
        }
        else
            $links = json_decode(file_get_contents($this->storeDir . 'offers_links.json'), 1);

        return $links;
    }
    public function getInnerOffers($crawler, $fileNames, $needUpdate = false)
    {
        if($needUpdate || !is_file($this->storeDir . 'inner_offers_links.json')) {
            $links = [];
            foreach ($fileNames as $url => $fileName) {
                $crawler->clear();
                $crawler->addHtmlContent(file_get_contents($fileName), 'UTF-8');
                $links[$url] = array_unique($crawler->filter('tr.object.block-link a')->each(function (Crawler $node) {
                    return $node->link()->getUri();
                }));
            }
            file_put_contents($this->storeDir . 'inner_offers_links.json', json_encode($links));
        }
        else
            $links = json_decode(file_get_contents($this->storeDir . 'inner_offers_links.json'), 1);

        return $links;
    }
    public function getProperties($crawler, $fileNames)
    {
        $props = [];

        foreach($fileNames as $fileName)
        {
            $crawler->clear();
            $crawler->addHtmlContent(file_get_contents($fileName), 'UTF-8');
            $data = $crawler->filter('.line.clearfix');
            $fields = $data->filter('.title')->each(function(Crawler $node) {
                return trim(strip_tags($node->text()));
            });
            $values = $data->filter('.value')->each(function (Crawler $node) {
                if(!($value = $node->filter('.ccy-option.ccy-rub'))->count())
                    if(!($value = $node->filter('a'))->count())
                        $value = $node;
                return trim(strip_tags($value->text()));
            });
            $props[$fileName] = array_combine($fields, $values);
        }
        return $props;
    }
    public function loadHtml($urls, $needUpdate = false)
    {
        $urls = (array) $urls;
        $return = [];
        foreach($urls as $url)
        {
            $fileName = $this->htmlStoreDir . md5($url) . '.html';

            $return[$url] = $fileName;

            if ($needUpdate || !is_file($fileName))
            {
                $request = new \GuzzleHttp\Psr7\Request('GET', $url);
                $promise = $this->client->sendAsync($request)->then(function ($response) use ($fileName) {
                    $content = $response->getBody()->getContents();
                    file_put_contents($fileName, $content);
                });
                $promise->wait();
            }
        }
        return $return;
    }
}