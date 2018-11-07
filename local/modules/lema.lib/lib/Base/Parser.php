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
    protected $currentUrl = null;

    protected $storeDir = null;
    protected $htmlStoreDir = null;
    protected $propsStoreDir = null;
    protected $imagesStoreDir = null;

    protected $currentSection = null;
    protected $currentPage = 1;

    const DATA_DIRECTORY = '/local/import/';

    private $client = null;

    /**
     * Parser constructor.
     */
    public function __construct()
    {
        $this->client = new Client([
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/70.0.3538.77 Chrome/70.0.3538.77 Safari/537.36',
            ]
        ]);
    }

    /**
     * @param string $section
     * @return $this
     */
    public function setCurrentSection($section)
    {
        $this->currentSection = $section;
        $this->currentUrl = $this->url . '/' . $section;

        $this->storeDir = $_SERVER['DOCUMENT_ROOT'] . static::DATA_DIRECTORY . $section . '/';
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

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrentSection()
    {
        return $this->currentSection;
    }

    /**
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @param string $url
     * @return $this
     * @throws \Exception
     */
    public function setUrl($url)
    {
        $this->hostUrl = parse_url($url, PHP_URL_SCHEME) . '://' . parse_url($url, PHP_URL_HOST);
        $this->url = $url;
        return $this;
    }

    /**
     * @param $count
     * @return $this
     */
    public function setObjectsCount($count)
    {
        $this->currentUrl = $this->url . '/' . $this->currentSection . '?count=' . $count;
        return $this;
    }

    /**
     * @param $page
     * @return $this
     * @throws \Exception
     */
    public function setPage($page)
    {
        if($page < 1)
            throw new \Exception('Empty page');

        $this->currentPage = (int) $page;
        $this->currentUrl = $this->url . '/' . $this->currentSection . '?count=84';
        if($page > 1)
            $this->currentUrl .= '&page=' . $page;
        return $this;
    }

    /**
     * @param int $page
     * @param bool $needUpdate
     * @return array
     * @throws \Exception
     */
    public function parse($needUpdate = false)
    {
        if(empty($this->currentUrl))
            throw new \Exception('You must to specify an url before run.');

        $crawler = new Crawler(null, $this->hostUrl);

        //first run
        $fileName = current($this->loadHtml($this->currentUrl, $needUpdate));
        $crawler->addHtmlContent(file_get_contents($this->htmlStoreDir . $fileName), 'UTF-8');
        $objectCount = $crawler->filter('.content .object-count');
        if(false&&$objectCount->count())
        {
            $objectCount = (int) current(explode(' ', trim($crawler->filter('.content .object-count')->text())));
            $this->setObjectsCount($objectCount);
            $fileName = current($this->loadHtml($this->currentUrl, $needUpdate));
        }
        $crawler->clear();
        //load root links
        $links = $this->getRootLinks($crawler, $fileName, $needUpdate);
        $fileNames = $this->loadHtml($links, $needUpdate);

        if($this->getCurrentSection() == 'city')
        {
            //load offers links
            $offerLinks = $this->getOffersLinks($crawler, $fileNames, $needUpdate);
            $offersNames = $this->loadHtml($offerLinks, $needUpdate);
            //load inner offers links
            $innerOffersLinks = $this->getInnerOffers($crawler, $offersNames, $needUpdate);
            $innerOffersNames = [];

            $innerOffersLinks = array_combine(array_keys($offerLinks), array_values($innerOffersLinks));
            foreach ($innerOffersLinks as $key => $innerOffersLink)
                $innerOffersNames[$key] = $this->loadHtml($innerOffersLink, $needUpdate);

            //load element properties
            $props = $this->getProperties($crawler, $innerOffersNames, $offersNames, $needUpdate);
        }
        else
        {
            //load element properties
            $props = $this->getProperties($crawler, $fileNames, [], $needUpdate);
        }

        return $props;
    }

    /**
     * @return int
     */
    public function getLinksCount()
    {
        if(!is_file($this->getFileNameWithPage($this->storeDir . 'inner_offers_links_count')))
            return 0;
        return (int) file_get_contents($this->getFileNameWithPage($this->storeDir . 'inner_offers_links_count'));
    }

    /**
     * @param Crawler|null $crawler
     * @param $fileName
     * @param bool $needUpdate
     * @return array|mixed
     */
    public function getRootLinks(Crawler $crawler = null, $fileName, $needUpdate = false)
    {
        if($needUpdate || !is_file($this->getFileNameWithPage($this->storeDir . 'links')))
        {
            if(empty($crawler))
                $crawler = new Crawler(null, $this->hostUrl);

            $crawler->addHtmlContent(file_get_contents($this->htmlStoreDir . $fileName), 'UTF-8');
            $links = array_unique($crawler->filter('.object.teaser.buy.clearfix .image a')->each(function (Crawler $node) {
                return $node->link()->getUri();
            }));
            $this->saveJsonArray($this->getFileNameWithPage($this->storeDir . 'links'), $links);
        }
        else
            $links = $this->loadJsonArray($this->getFileNameWithPage($this->storeDir . 'links'));

        return $links;
    }

    /**
     * @param Crawler|null $crawler
     * @param array $fileNames
     * @param bool $needUpdate
     * @return array|mixed
     */
    public function getOffersLinks(Crawler $crawler = null, array $fileNames = [], $needUpdate = false)
    {
        if($needUpdate || !is_file($this->getFileNameWithPage($this->storeDir . 'offers_links')))
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
            $this->saveJsonArray($this->getFileNameWithPage($this->storeDir . 'offers_links'), $links);
        }
        else
            $links = $this->loadJsonArray($this->getFileNameWithPage($this->storeDir . 'offers_links'));

        return $links;
    }

    /**
     * @param Crawler|null $crawler
     * @param array $fileNames
     * @param bool $needUpdate
     * @return array|mixed
     */
    public function getInnerOffers(Crawler $crawler = null, array $fileNames = [], $needUpdate = false)
    {
        if($needUpdate || !is_file($this->getFileNameWithPage($this->storeDir . 'inner_offers_links')))
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
            $this->saveJsonArray($this->getFileNameWithPage($this->storeDir . 'inner_offers_links'), $links);
        }
        else
            $links = $this->loadJsonArray($this->getFileNameWithPage($this->storeDir . 'inner_offers_links'));

        if($needUpdate || !is_file($this->getFileNameWithPage($this->storeDir . 'inner_offers_links_count')))
            file_put_contents($this->getFileNameWithPage($this->storeDir . 'inner_offers_links_count'), count(array_keys($links)));

        return $links;
    }

    /**
     * @param Crawler|null $crawler
     * @param array $offers
     * @param bool $needUpdate
     * @return array
     */
    public function getProperties(Crawler $crawler = null, array $offers = [], array $offersNames = [], $needUpdate = false)
    {
        if($needUpdate || !is_file($this->getFileNameWithPage($this->storeDir . 'props')))
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

            foreach ($offers as $url => $fileName)
            {
                $path = $this->propsStoreDir . md5($url) . '.json';

                $return[$url] = $this->getElementPropData($crawler, $url, $replace, (is_array($fileName) ? key($fileName) : $fileName), $needUpdate);

                if ($needUpdate || !is_file($path))
                {
                    $return[$url]['offers'] = [];
                    if(is_array($fileName))
                    {
                        foreach ($fileName as $offerUrl => $file)
                        {
                            $return[$url]['offers'][$file] = $this->getOfferPropData($crawler, $file, $url, $return[$url]['ID'], $replace, $needUpdate);
                        }
                        $this->saveJsonArray($path, $return[$url]);
                    }
                    else
                    {
                        $return[$url]['offers'][$fileName] = $this->getOfferPropData($crawler, $fileName, $url, $return[$url]['ID'], $replace, $needUpdate);
                    }
                }
                else
                    $return[$url] = $this->loadJsonArray($path);
            }
            $this->saveJsonArray($this->getFileNameWithPage($this->storeDir . 'props'), $return);
        }
        else
            $return = $this->loadJsonArray($this->getFileNameWithPage($this->storeDir . 'props'));

        return $return;
    }

    /**
     * @param Crawler $crawler
     * @param $fileName
     * @param $url
     * @param $parentId
     * @param array $replace
     * @param bool $needUpdate
     * @return array
     */
    protected function getOfferPropData(Crawler $crawler, $fileName, $url, $parentId, array $replace, $needUpdate = false)
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
        $return = array_combine($fields, $values);

        foreach ($return as $field => $value)
        {
            if (in_array($field, ['price', 'square']))
            {
                $return[$field] = preg_replace(
                    '~[.,\\D]+~',
                    '',
                    mb_substr($value, 0, -2, 'UTF-8')
                );
            }
        }

        $descriptionSearch = $crawler->filter('.description p');
        $objectId = (int)preg_replace('~\\D+~', '', $crawler->filter('h1')->text());
        $return['ID'] = $objectId;
        $return['parentId'] = $parentId;


        $return['category'] = $this->getElementCategoryFromUrl($offerUrl);
        $return['elementUrl'] = $offerUrl;
        $descriptionsCount = $descriptionSearch->count();
        $return['description'] = $descriptionsCount ? $descriptionSearch->first()->text() : null;
        if ($descriptionsCount > 1)
            $return['description2'] = $descriptionSearch->last()->text();


        $addressSearch = $crawler->filter('.description > .parent-link > a');

        $return['address'] = null;
        if ($addressSearch->count())
        {
            $return['address'] = preg_replace(
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
        $return['images'] = [];

        $imageDir = $parentId;


        if (!is_dir($this->imagesStoreDir . $imageDir))
            mkdir($this->imagesStoreDir . $imageDir);

        $images = array_unique($crawler->filter('a[rel="lightbox[a]"]')->each(function (Crawler $node) {
            return $node->link()->getUri();
        }));
        shuffle($images);
        foreach ($images as $image)
        {
            $imagePath = $imageDir . '/' . basename($image);
            if ($needUpdate || !is_file($this->imagesStoreDir . $imagePath) || !filesize($this->imagesStoreDir . $imagePath))
            {
                if (file_put_contents($this->imagesStoreDir . $imagePath, file_get_contents($image)))
                    $return['images'][] = $imagePath;
            }
            else
                $return['images'][] = $imagePath;
            /**
             * We will take only first image
             */
            break;
        }
        return $return;
    }

    /**
     * @param Crawler $crawler
     * @param $fileName
     * @param array $replace
     * @param $offerUrl
     * @param bool $needUpdate
     * @return array
     */
    protected function getElementPropData(Crawler $crawler, $fileName, array $replace, $offerUrl, $needUpdate = false)
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
        $return = array_combine($fields, $values);

        foreach ($return as $field => $value)
        {
            if (in_array($field, ['price', 'square']))
            {
                unset($return[$field]);
            }
        }

        $descriptionSearch = $crawler->filter('.description p');
        $objectId = (int)preg_replace('~\\D+~', '', $crawler->filter('.object-id')->text());
        $return['ID'] = $objectId;


        $return['category'] = $this->getElementCategoryFromUrl($offerUrl);
        $return['elementUrl'] = $offerUrl;
        if($descriptionSearch->count())
            $return['description'] = $descriptionSearch->text();


        $addressSearch = $crawler->filter('.description > .parent-link > a');

        $return['address'] = null;
        if ($addressSearch->count())
        {
            $return['address'] = preg_replace(
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
        $return['images'] = [];

        $imageDir = $objectId;


        if (!is_dir($this->imagesStoreDir . $imageDir))
            mkdir($this->imagesStoreDir . $imageDir);

        $images = array_unique($crawler->filter('a[rel="lightbox[a]"]')->each(function (Crawler $node) {
            return $node->link()->getUri();
        }));
        shuffle($images);
        foreach ($images as $image)
        {
            $imagePath = $imageDir . '/' . basename($image);
            if ($needUpdate || !is_file($this->imagesStoreDir . $imagePath) || !filesize($this->imagesStoreDir . $imagePath))
            {
                if (file_put_contents($this->imagesStoreDir . $imagePath, file_get_contents($image)))
                    $return['images'][] = $imagePath;
            }
            else
                $return['images'][] = $imagePath;
            /**
             * We will take only first image
             */
            break;
        }
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
        $return = $promises = $fileNames = [];
        foreach($urls as $url)
        {
            $return[$url] = md5($url) . '.html';
            if($needUpdate || !is_file($this->htmlStoreDir . $return[$url]))
            {
                $promises[] = $this->client->sendAsync(new \GuzzleHttp\Psr7\Request('GET', $url));
                $fileNames[] = $url;
            }
        }
        if(!empty($promises))
        {
            \GuzzleHttp\Promise\all($promises)->then(function (array $responses) use ($return, $fileNames) {
                foreach($responses as $k => $response)
                {
                    if(!empty($return[$fileNames[$k]]))
                        file_put_contents($this->htmlStoreDir . $return[$fileNames[$k]], $response->getBody()->getContents());
                }
            })->wait();
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
        if($needUpdate || !is_file($this->getFileNameWithPage($this->storeDir . 'sections')))
        {
            if (!is_file($this->getFileNameWithPage($this->storeDir . 'inner_offers_links')))
                throw new \Exception('You must run parser before.');

            //get categories from files with links
            $categories = [];
            
            
            $linksList = $this->loadJsonArray($this->getFileNameWithPage($this->storeDir . 'inner_offers_links'));
            foreach($linksList as $links)
            {
                foreach ($links as $link)
                    $categories[] = $this->getCategoriesFromUrl($link);
            }
            $links = $this->loadJsonArray($this->getFileNameWithPage($this->storeDir . 'links'));
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
            $this->saveJsonArray($this->getFileNameWithPage($this->storeDir . 'sections'), $result);
        }
        else
            $result = $this->loadJsonArray($this->getFileNameWithPage($this->storeDir . 'sections'));
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
     * @param $offersId
     * @param array $elements
     * @param array $elementsOffsets
     * @param array $offersOffsets
     * @return string
     * @throws \Exception
     */
    public function loadElements($iblockId, $offersId, array $elements = [], array $elementsOffsets = [0, 1], array $offersOffsets = [0, 10])
    {
        if(!isset($elementsOffsets[0], $elementsOffsets[1], $offersOffsets[0], $offersOffsets[1]))
            throw new \Exception('You must to specify offsets');

        if($elementsOffsets[0] > count($elements))
            return 'end_elements';

        $elements = array_slice($elements, $elementsOffsets[0], $elementsOffsets[1]);

        foreach($elements as $elementFilename => $item)
        {
            if(empty($item['offers']) || !is_array($item['offers']) || $offersOffsets[0] > count($item['offers']))
                return 'end_offers';

            $offers = array_slice($item['offers'], $offersOffsets[0], $offersOffsets[1]);

            unset($item['offers']);
            //add element
            $elementId = $this->addOrUpdateElement($iblockId, $item, false, true);
            if(empty($elementId))
                continue;
            //add element offers
            foreach ($offers as $element)
            {
                $this->addOrUpdateElement($offersId, $element, $elementId, true);
                //break;
            }
        }
    }

    /**
     * @param $iblockId
     * @param $element
     * @param bool $offerElementId
     * @param bool $doNotUpdateExisting
     * @return int|void
     * @throws \Exception
     */
    public function addOrUpdateElement($iblockId, $element, $offerElementId = false, $doNotUpdateExisting = false)
    {
        if (empty($element['name']))
            return;

        $props = $this->getInsertProperties($iblockId, $element);

        /**
         * Take only first element instead loading all element images
         */
        $image = null;
        if(!empty($element['images']))
        {
            $image = current($element['images']);
            if(empty($image) || !is_file($this->imagesStoreDir . $image))
                $image = null;
            else
                $image = $this->imagesStoreDir . $image;
        }
        /**
         * Old code for images is here..
         */
        /**
        $props['MORE_PHOTO'] = [];
        foreach ($element['images'] as $image)
        {
        if(is_file($this->imagesStoreDir . $image))
        $props['MORE_PHOTO'][] = \CFile::MakeFileArray($this->imagesStoreDir . $image);
        }*/

        $elementCode = strtolower(trim(preg_replace('~[^-_A-Za-z0-9]~u', '_', Helper::translit($element['name'])), '_') . '_' . $element['ID']);
        if($offerElementId)
        {
            $props['CML2_LINK'] = $offerElementId;
            $data = [
                'ACTIVE' => 'Y',
                'NAME' => $element['name'],
                //'CODE' => \CUtil::translit($element['name'] . '_' . $element['ID'], 'ru'),
                'CODE' => $elementCode,
                'XML_ID' => $element['ID'],
                'PROPERTY_VALUES' => $props,
                //'PREVIEW_PICTURE' => current($props['MORE_PHOTO']),
                //'DETAIL_PICTURE' => current($props['MORE_PHOTO']),
                'PREVIEW_PICTURE' => $image,
                'DETAIL_PICTURE' => $image,
                'DETAIL_TEXT' => $element['description'],
                'PREVIEW_TEXT' => $element['description'],
            ];
        }
        else
        {
            $section = \LIblock::getSectionInfo($iblockId, strtolower($element['category']), 'XML_ID');

            if (empty($section['ID']))
            {
                return;
                //var_dump($element);
                //throw new \Exception('Region must be specified. Value is ' . $element['category'] . ' - ' . $element['elementUrl']);
            }

            $data = [
                'ACTIVE' => 'Y',
                'IBLOCK_SECTION_ID' => $section['ID'],
                'NAME' => $element['name'],
                //'CODE' => \CUtil::translit($element['name'] . '_' . $element['ID'], 'ru'),
                'CODE' => $elementCode,
                'XML_ID' => $element['ID'],
                'PROPERTY_VALUES' => $props,
                //'PREVIEW_PICTURE' => current($props['MORE_PHOTO']),
                //'DETAIL_PICTURE' => current($props['MORE_PHOTO']),
                'PREVIEW_PICTURE' => $image,
                'DETAIL_PICTURE' => $image,
                'DETAIL_TEXT' => $element['description'],
                'PREVIEW_TEXT' => $element['description'],
            ];
        }
        //var_dump($iblockId);
        //\Lema\Common\Dumper::dump($data);
        return Element::addOrUpdateElement($iblockId, $data, $doNotUpdateExisting);
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
                        'XML_ID' => $propCode,
                        'ACTIVE' => 'Y',
                        'SORT' => '100',
                        'CODE' => $propCode,
                        'PROPERTY_TYPE' => 'S',
                        'IBLOCK_ID' => $iblockId
                    ]);
                }
                //we use property id instead property code because it will be faster
                //just for test u can use $propCode instead
                $return[$propCode] = mb_strimwidth($element[$key], 0, 257, '...', 'UTF-8');
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

    /**
     * @return bool
     */
    public function needRunParser()
    {
        return !is_file($this->getFileNameWithPage($this->storeDir . 'props'));
    }

    /**
     * @param $path
     * @param string $extension
     * @return string
     */
    protected function getFileNameWithPage($path, $extension = 'json')
    {
        if($this->currentPage === 1)
            return $path . '.' . $extension;
        return $path . '_' . $this->currentPage . '.' . $extension;
    }
}