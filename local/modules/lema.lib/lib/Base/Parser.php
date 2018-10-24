<?php

namespace Lema\Base;


use GuzzleHttp\Client;
use function GuzzleHttp\Psr7\parse_query;

use Lema\Common\Helper;
use Lema\IBlock\Element;
use Lema\IBlock\Section;

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

    /**
     * Parser constructor.
     */
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

    /**
     * @param $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->hostUrl = parse_url($url, PHP_URL_SCHEME) . '://' . parse_url($url, PHP_URL_HOST);
        $this->url = $url;
        return $this;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function parse()
    {
        if(empty($this->url))
            throw new \Exception('You must to specify an url before run.');

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

        foreach($innerOffersLinks as $key => $innerOffersLink)
            $innerOffersNames[$key] = $this->loadHtml($innerOffersLink);

        //load element properties
        $props = $this->getProperties($crawler, $innerOffersNames);
        return $props;
    }

    /**
     * @return int
     */
    public function getLinksCount()
    {
        if(!is_file($this->storeDir . 'inner_offers_links_count.json'))
            return 0;
        return (int) file_get_contents($this->storeDir . 'inner_offers_links_count.json');
    }

    /**
     * @param Crawler|null $crawler
     * @param $fileName
     * @param bool $needUpdate
     * @return array|mixed
     */
    public function getRootLinks(Crawler $crawler = null, $fileName, $needUpdate = false)
    {
        if($needUpdate || !is_file($this->storeDir . 'links.json'))
        {
            if(empty($crawler))
                $crawler = new Crawler(null, $this->hostUrl);

            $crawler->addHtmlContent(file_get_contents($this->htmlStoreDir . $fileName), 'UTF-8');
            $links = array_unique($crawler->filter('.object.teaser.city.buy.clearfix .image a')->each(function (Crawler $node) {
                return $node->link()->getUri();
            }));
            $this->saveJsonArray($this->storeDir . 'links.json', $links);
        }
        else
            $links = $this->loadJsonArray($this->storeDir . 'links.json');

        return $links;
    }

    /**
     * @param Crawler|null $crawler
     * @param array $fileNames
     * @param bool $needUpdate
     * @return array|mixed
     */
    public function getOffersLinks(Crawler $crawler = null, array $fileNames, $needUpdate = false)
    {
        if($needUpdate || !is_file($this->storeDir . 'offers_links.json'))
        {
            if(empty($crawler))
                $crawler = new Crawler(null, $this->hostUrl);

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
            $this->saveJsonArray($this->storeDir . 'offers_links.json', $links);
        }
        else
            $links = $this->loadJsonArray($this->storeDir . 'offers_links.json');

        return $links;
    }

    /**
     * @param Crawler|null $crawler
     * @param array $fileNames
     * @param bool $needUpdate
     * @return array|mixed
     */
    public function getInnerOffers(Crawler $crawler = null, array $fileNames, $needUpdate = false)
    {
        if($needUpdate || !is_file($this->storeDir . 'inner_offers_links.json'))
        {
            if(empty($crawler))
                $crawler = new Crawler(null, $this->hostUrl);

            $links = [];
            foreach ($fileNames as $url => $fileName) {
                $crawler->clear();
                $crawler->addHtmlContent(file_get_contents($this->htmlStoreDir . $fileName), 'UTF-8');
                $links[$url] = array_unique($crawler->filter('tr.object.block-link a')->each(function (Crawler $node) {
                    return $node->link()->getUri();
                }));
            }
            $this->saveJsonArray($this->storeDir . 'inner_offers_links.json', $links);
        }
        else
            $links = $this->loadJsonArray($this->storeDir . 'inner_offers_links.json');

        if($needUpdate || !is_file($this->storeDir . 'inner_offers_links_count.json'))
            file_put_contents($this->storeDir . 'inner_offers_links_count.json', count(array_keys($links)));

        return $links;
    }

    /**
     * @param Crawler|null $crawler
     * @param array $offers
     * @param bool $needUpdate
     * @return array
     */
    public function getProperties(Crawler $crawler = null, array $offers = [], $needUpdate = false)
    {
        if($needUpdate || !is_file($this->storeDir . 'props.json'))
        {
            if(empty($crawler))
                $crawler = new Crawler(null, $this->hostUrl);

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

            foreach ($offers as $url => $fileNames)
            {
                $path = $this->propsStoreDir . md5($url) . '.json';

                if ($needUpdate || !is_file($path))
                {
                    $return[$url] = [];
                    foreach ($fileNames as $offerUrl => $fileName)
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
                            return trim(($value->text()));
                        });
                        $return[$url][$fileName] = array_combine($fields, $values);

                        foreach ($return[$url][$fileName] as $field => $value)
                        {
                            if (in_array($field, ['price', 'square']))
                            {
                                $return[$url][$fileName][$field] = preg_replace(
                                    '~[.,\\D]+~',
                                    '',
                                    mb_substr($value, 0, -2, 'UTF-8')
                                );
                            }
                        }

                        $descriptionSearch = $crawler->filter('.description > p');
                        $objectId = (int)preg_replace('~\\D+~', '', $crawler->filter('h1')->text());
                        $return[$url][$fileName]['ID'] = $objectId;
                        $return[$url][$fileName]['category'] = $this->getElementCategoryFromUrl($offerUrl);
                        $return[$url][$fileName]['elementUrl'] = $offerUrl;
                        $return[$url][$fileName]['description'] = $descriptionSearch->count() ? $descriptionSearch->text() : null;

                        $addressSearch = $crawler->filter('.description > .parent-link > a');

                        $return[$url][$fileName]['address'] = null;
                        if($addressSearch->count())
                        {
                            $return[$url][$fileName]['address'] = preg_replace(
                                '~Все предложения в ~ui',
                                '',
                                $crawler->filter('.description > .parent-link > a')->text()
                            );
                        }

                        //images
                        /*
                        if(!is_dir($this->imagesStoreDir . $objectId))
                            mkdir($this->imagesStoreDir . $objectId);
                        */
                        $return[$url][$fileName]['images'] = [];

                        $queryParams = parse_query($url);
                        $imageDir = isset($queryParams['id']) ? (int)$queryParams['id'] : $objectId;

                        if (!is_dir($this->imagesStoreDir . $imageDir))
                            mkdir($this->imagesStoreDir . $imageDir);

                        $images = array_unique($crawler->filter('a[rel="lightbox[a]"]')->each(function (Crawler $node) {
                            return $node->link()->getUri();
                        }));
                        foreach ($images as $image)
                        {
                            $imagePath = $imageDir . '/' . basename($image);
                            if ($needUpdate || !is_file($this->imagesStoreDir . $imagePath) || !filesize($this->imagesStoreDir . $imagePath))
                            {
                                if (file_put_contents($this->imagesStoreDir . $imagePath, file_get_contents($image)))
                                    $return[$url][$fileName]['images'][] = $imagePath;
                            }
                            else
                                $return[$url][$fileName]['images'][] = $imagePath;
                        }
                    }
                    $this->saveJsonArray($path, $return[$url]);
                }
                else
                    $return[$url] = $this->loadJsonArray($path);
            }
            $this->saveJsonArray($this->storeDir . 'props.json', $return);
        }
        else
            $return = $this->loadJsonArray($this->storeDir . 'props.json');

        return $return;
    }

    /**
     * @param $urls
     * @param bool $needUpdate
     * @return array
     */
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

    /**
     * @param bool $needUpdate
     * @return array|mixed
     * @throws \Exception
     */
    public function getCategories($needUpdate = false)
    {
        if($needUpdate || !is_file($this->storeDir . 'sections.json'))
        {
            if (!is_file($this->storeDir . 'inner_offers_links.json'))
                throw new \Exception('You must run parser before.');

            //get categories from files with links
            $categories = [];
            
            
            $linksList = $this->loadJsonArray($this->storeDir . 'inner_offers_links.json');
            foreach($linksList as $links)
            {
                foreach ($links as $link)
                    $categories[] = $this->getCategoriesFromUrl($link);
            }
            $links = $this->loadJsonArray($this->storeDir . 'links.json');
            foreach ($links as $link)
                $categories[] = $this->getCategoriesFromUrl($link);
            
            $result = [];

            $categories = array_map('unserialize', array_unique(array_map('serialize', $categories)));
            foreach($categories as $k => $category)
            {
                if(empty($category[1]))
                    unset($categories[$k]);
            }
            $categories = array_values($categories);

            foreach ($categories as $category) {
                $tmp = [];
                $this->combineArr($category, $tmp);
                $result = array_merge_recursive($result, $tmp);
            }
            $this->saveJsonArray($this->storeDir . 'sections.json', $result);
        }
        else
            $result = $this->loadJsonArray($this->storeDir . 'sections.json');
        return $result;
    }

    /**
     * @param array|null $arr
     * @param $res
     */
    public function combineArr(array $arr = null, &$res)
    {
        if(empty($arr))
            return ;
        $key = array_shift($arr);
        $res = [$key => []];
        return $this->combineArr($arr, $res[$key]);
    }

    /**
     * @param $iblockId
     * @param array $categories
     * @param null $parent
     * @throws \Exception
     */
    public function loadCategories($iblockId, array $categories = [], $parent = null)
    {
        foreach($categories as $category => $innerCategories)
        {
            if(!empty($parent))
                $sectionInfo = \LIblock::getSectionInfo('objects', $parent, 'XML_ID');
            $new = [
                'IBLOCK_SECTION_ID' => (empty($sectionInfo['ID']) ? false : $sectionInfo['ID']),
                'NAME' => $category,
                'CODE' => $category,
                'XML_ID' => $category,
            ];
            Section::addOrUpdateSection($iblockId, $new);
            if(is_array($innerCategories)) {
                $this->loadCategories($iblockId, $categories[$category], $category);
            }
        }
    }

    /**
     * @param $iblockId
     * @param array $elements
     * @throws \Exception
     */
    public function loadElements($iblockId, array $elements = [])
    {
        foreach($elements as $offers)
        {
            foreach ($offers as $element)
            {
                $props = $this->getInsertProperties($iblockId, $element);

                $props['MORE_PHOTO'] = [];
                foreach ($element['images'] as $image)
                {
                    if(is_file($this->imagesStoreDir . $image))
                        $props['MORE_PHOTO'][] = \CFile::MakeFileArray($this->imagesStoreDir . $image);
                }

                $section = \LIblock::getSectionInfo($iblockId, strtolower($element['category']), 'XML_ID');

                if (empty($section['ID']))
                {
                    continue;
                    //var_dump($element);
                    //throw new \Exception('Region must be specified. Value is ' . $element['category'] . ' - ' . $element['elementUrl']);
                }

                $data = [
                    'ACTIVE' => 'Y',
                    'IBLOCK_SECTION_ID' => $section['ID'],
                    'NAME' => $element['name'],
                    //'CODE' => \CUtil::translit($element['name'] . '_' . $element['ID'], 'ru'),
                    'CODE' => strtolower(trim(str_replace(' ', '_', Helper::translit($element['name'])), '_') . '_' . $element['ID']),
                    'XML_ID' => $element['ID'],
                    'PROPERTY_VALUES' => $props,
                    'PREVIEW_PICTURE' => current($props['MORE_PHOTO']),
                    'DETAIL_PICTURE' => current($props['MORE_PHOTO']),
                    'DETAIL_TEXT' => $element['description'],
                    'PREVIEW_TEXT' => $element['description'],
                ];
                Element::addOrUpdateElement($iblockId, $data);
            }
        }
    }

    /**
     * @param $iblockId
     * @param array $element
     * @param array $keys
     * @return array
     */
    public function getInsertProperties($iblockId, array $element, array $keys = [])
    {
        if(empty($keys))
        {
            $keys = [
                'price' => 'Стоимость',
                'metro' => 'Станция метро',
                'region' => 'Район',
                'stage' => 'Этаж',
                'square' => 'Площадь',
                'rooms_count' => 'Комнат',
                'height' => 'Высота потолков',
                'parking' => 'Парковка',
                'material' => 'Материал дома',
                'slabs' => 'Тип перекрытий',
                'finishing' => 'Отделка',
                'security' => 'Охрана',
                'infrastructure' => 'Инфраструктура',
                'landscaping' => 'Благоустройство территории',
                'windows' => 'Окна',
                'region_infrastructure' => 'Инфраструктура района',
                'address' => 'Адрес',
            ];
        }
        $return = [];
        foreach($keys as $key => $title)
        {
            if(!empty($element[$key]))
            {
                $propCode = mb_strtoupper($key, 'UTF-8');
                /**
                 * We will add all unknown properties as new string property, you can change it later
                 */
                if(!($propId = \LIblock::getPropId($iblockId, $propCode)))
                {
                    $ibp = new \CIBlockProperty;
                    $propId = $ibp->Add([
                        'NAME' => $title,
                        'ACTIVE' => 'Y',
                        'SORT' => '100',
                        'CODE' => $propCode,
                        'PROPERTY_TYPE' => 'S',
                        'IBLOCK_ID' => $iblockId
                    ]);
                }
                //we use property id instead property code because it will be faster
                //just for test u can use $propCode instead
                $return[$propCode] = $element[$key];
            }
        }
        return $return;
    }

    /**
     * @param $url
     * @return mixed
     */
    protected function getCategoriesFromUrl($url)
    {
        return array_slice(explode('/', trim(parse_url($url, PHP_URL_PATH), '/')), 1, -1);
    }

    /**
     * @param $url
     * @return mixed
     */
    protected function getElementCategoryFromUrl($url)
    {
        return end($this->getCategoriesFromUrl($url));
    }

    /**
     * @param $path
     * @param bool $assoc
     * @param int $depth
     * @param int $options
     * @return array|mixed
     */
    protected function loadJsonArray($path, $assoc = true, $depth = 512, $options = 0) {
        if(is_file($path))
            return json_decode(file_get_contents($path), $assoc, $depth, $options);
        return [];
    }

    /**
     * @param string $path
     * @param array $data
     * @param int $options
     * @param int $depth
     * @return bool|int
     */
    protected function saveJsonArray($path, array $data, $options = JSON_UNESCAPED_UNICODE, $depth = 512) {
        return file_put_contents($path, json_encode($data, $options, $depth));
    }
}