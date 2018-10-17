<?php

namespace Lema\Base;


use GuzzleHttp\Client;
use function GuzzleHttp\Psr7\parse_query;
use Lema\Common\Helper;
use Symfony\Component\DomCrawler\Crawler;

class Parser extends StaticInstance
{
    protected $hostUrl = null;
    protected $url = null;

    protected $storeDir = null;
    protected $htmlStoreDir = null;
    protected $propsStoreDir = null;
    protected $imagesStoreDir = null;

    const DATA_DIRECTORY = '/local/import/';

    private $client = null;

    public function __construct()
    {
        $this->client = new Client();

        $this->storeDir = $_SERVER['DOCUMENT_ROOT'] . static::DATA_DIRECTORY;
        if(!is_dir($this->storeDir))
            mkdir($this->storeDir);

        $this->htmlStoreDir = $this->storeDir . 'html/';
        if(!is_dir($this->htmlStoreDir))
            mkdir($this->htmlStoreDir);

        $this->propsStoreDir = $this->storeDir . 'props/';
        if(!is_dir($this->propsStoreDir))
            mkdir($this->propsStoreDir);

        $this->imagesStoreDir = $this->storeDir . 'images/';
        if(!is_dir($this->imagesStoreDir))
            mkdir($this->imagesStoreDir);
    }

    public function setUrl($url)
    {
        $this->hostUrl = parse_url($url, PHP_URL_SCHEME) . '://' . parse_url($url, PHP_URL_HOST);
        $this->url = $url;
        return $this;
    }

    public function parse($step = 1)
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
        $i = 0;

        foreach($innerOffersLinks as $key => $innerOffersLink)
        {
            $innerOffersNames[$key] = $this->loadHtml($innerOffersLink);
        }
        $props = $this->getProperties($crawler, $innerOffersNames);
        return $props;
    }

    public function getLinksCount()
    {
        if(!is_file($this->storeDir . 'inner_offers_links_count.json'))
            return 0;
        return (int) file_get_contents($this->storeDir . 'inner_offers_links_count.json');
    }

    public function getRootLinks($crawler, $fileName, $needUpdate = false)
    {
        if($needUpdate || !is_file($this->storeDir . 'links.json'))
        {
            $crawler->addHtmlContent(file_get_contents($this->htmlStoreDir . $fileName), 'UTF-8');
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
                $crawler->addHtmlContent(file_get_contents($this->htmlStoreDir . $fileName), 'UTF-8');
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
                $crawler->addHtmlContent(file_get_contents($this->htmlStoreDir . $fileName), 'UTF-8');
                $links[$url] = array_unique($crawler->filter('tr.object.block-link a')->each(function (Crawler $node) {
                    return $node->link()->getUri();
                }));
            }
            file_put_contents($this->storeDir . 'inner_offers_links.json', json_encode($links));
        }
        else
            $links = json_decode(file_get_contents($this->storeDir . 'inner_offers_links.json'), 1);

        if($needUpdate || !is_file($this->storeDir . 'inner_offers_links_count.json'))
            file_put_contents($this->storeDir . 'inner_offers_links_count.json', count(array_keys($links)));

        return $links;
    }
    public function getProperties($crawler, $offers, $needUpdate = false)
    {
        $return = [];

        $replace = [
            'Стоимость' => 'price',
            'Станция метро' => 'metro',
            'Название' => 'name',
            'Район' => 'region',
            'Этаж' => 'stage',
            'Площадь' => 'square',
            'Комнат' => 'rooms_count',
            'Высота потолков' => 'height',
            'Парковка' => 'parking',
            'Материал дома' => 'material',
            'Тип перекрытий' => 'slabs',
            'Отделка' => 'finishing',
            'Охрана' => 'security',
            'Инфраструктура' => 'infrastructure',
            'Благоустройство территории' => 'landscaping',
            'Окна' => 'windows',
            'Инфраструктура района' => 'region_infrastructure',
        ];

        foreach($offers as $url => $fileNames)
        {
            $path = $this->propsStoreDir . md5($url) . '.json';
            if($needUpdate || !is_file($path))
            {
                $return[$url] = [];
                foreach ($fileNames as $fileName)
                {
                    $crawler->clear();
                    $crawler->addHtmlContent(file_get_contents($this->htmlStoreDir . $fileName), 'UTF-8');
                    $data = $crawler->filter('.line.clearfix');
                    $fields = $data->filter('.title')->each(function (Crawler $node) use ($replace) {
                        $key = mb_substr(trim(strip_tags($node->text())), 0, -1, 'UTF-8');
                        return isset($replace[$key]) ? $replace[$key] : Helper::translit($key);
                    });
                    $values = $data->filter('.value')->each(function (Crawler $node) {
                        if (!($value = $node->filter('.ccy-option.ccy-rub'))->count())
                            if (!($value = $node->filter('a'))->count())
                                $value = $node;
                        return trim(strip_tags($value->text()));
                    });
                    $return[$url][$fileName] = array_combine($fields, $values);
                    $descriptionSearch = $data->filter('.description > p');
                    $objectId = (int) preg_replace('~\\D+~', '', $crawler->filter('h1')->text());
                    $return[$url][$fileName]['ID'] = $objectId;
                    $return[$url][$fileName]['description'] = $descriptionSearch->count() ? $descriptionSearch->text() : null;
                    //images
                    /*
                    if(!is_dir($this->imagesStoreDir . $objectId))
                        mkdir($this->imagesStoreDir . $objectId);
                    */
                    $return[$url][$fileName]['images'] = [];

                    $queryParams = parse_query($url);
                    $imageDir = isset($queryParams['id']) ? (int) $queryParams['id'] : $objectId;

                    if(!is_dir($this->imagesStoreDir . $imageDir))
                        mkdir($this->imagesStoreDir . $imageDir);

                    $images = array_unique($crawler->filter('a[rel="lightbox[a]"]')->each(function(Crawler $node) {
                        return $node->link()->getUri();
                    }));
                    foreach($images as $image)
                    {
                        $imagePath = $imageDir . '/' . basename($image);
                        if($needUpdate || !is_file($this->imagesStoreDir . $imagePath))
                        {
                            if(file_put_contents($this->imagesStoreDir . $imagePath, file_get_contents($image)))
                                $return[$url][$fileName]['images'][] = $imagePath;
                        }
                    }

                    //var_dump($url, $fileName, $images, $return[$url][$fileName]);exit;
                }
                file_put_contents($path, json_encode($return[$url], JSON_UNESCAPED_UNICODE));
            }
            else
            {
                $return[$url] = json_decode(file_get_contents($path), 1);
            }
        }
        return $return;
    }
    public function loadHtml($urls, $needUpdate = false)
    {
        $urls = (array) $urls;
        $return = [];
        foreach($urls as $url)
        {
            $return[$url] = md5($url) . '.html';

            $fileName = $this->htmlStoreDir . $return[$url];

            if ($needUpdate || !is_file($fileName))
            {
                try
                {
                    $request = new \GuzzleHttp\Psr7\Request('GET', $url);
                    $promise = $this->client->sendAsync($request)->then(function ($response) use ($fileName) {
                        $content = $response->getBody()->getContents();
                        file_put_contents($fileName, $content);
                    });
                    $promise->wait();
                }
                catch(\Exception $e) {
                    echo $e->getMessage();
                }
            }
        }
        return $return;
    }
}