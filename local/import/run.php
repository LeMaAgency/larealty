<?php
$DOCUMENT_ROOT = realpath(__DIR__ . '/../../');
$_SERVER['DOCUMENT_ROOT'] = $DOCUMENT_ROOT;

@set_time_limit(0);
ignore_user_abort(true);

defined('NO_KEEP_STATISTIC') or define('NO_KEEP_STATISTIC', true);
defined('NOT_CHECK_PERMISSIONS') or define('NOT_CHECK_PERMISSIONS', true);
defined('CHK_EVENT') or define('CHK_EVENT', true);

defined('ELEMENTS_BLOCK_COUNT') or define('ELEMENTS_BLOCK_COUNT', 1);
defined('OFFERS_BLOCK_COUNT')   or define('OFFERS_BLOCK_COUNT',  50);

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

\Bitrix\Main\Loader::includeModule('iblock');

$siteUrl = 'http://blackwood.ru/catalog';

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

$parser = \Lema\Base\Parser::get()->setUrl($siteUrl)->setCurrentSection('city')->setPage($page);

$pagesCount = $parser->getPagesCount();
if(empty($pagesCount))
{
    $parser->parse();
    $pagesCount = $parser->getPagesCount();
}


if ($parser->needRunParser())
{
    $properties = $parser->parse();
    $parser->loadCategories(\LIblock::getId('objects'), $parser->getCategories());
}
else
    $properties = $parser->getProperties();

$scriptPath = '/local/import/run.php';

$elementsIndex = isset($_GET['elementsIndex']) ? (int) $_GET['elementsIndex'] : 0;
$offersIndex = isset($_GET['offersIndex']) ? (int) $_GET['offersIndex'] : 0;
$stepCount = $parser->getLinksCount();


$elementsOffset = [$elementsIndex, ELEMENTS_BLOCK_COUNT];
$offersOffset = [$offersIndex, OFFERS_BLOCK_COUNT];

if(!empty($_GET['AJAX']))
{
    $result = $parser->loadElements(\LIblock::getId('objects'), \LIblock::getId('objects_offers'), $properties, $elementsOffset, $offersOffset);

    if(empty($result))
    {
        $offersOffset[0] += OFFERS_BLOCK_COUNT;
    }
    else
    {
        if($result == 'end_offers')
        {
            ++$elementsOffset[0];
            $offersOffset[0] = 0;
        }
    }
    echo(json_encode([
        'elementsOffset' => $elementsOffset[0],
        'offersOffset' => $offersOffset[0],
        'stepCount' => $parser->getLinksCount(),
        'pluralStepCount' => \Lema\Common\Helper::pluralizeN($parser->getLinksCount(), ['шага', 'шагов', 'шагов']),
    ]));
    exit;
}
?>
<div id="answer"></div>
<script src="/assets/js/jquery-3.2.1.min.js"></script>
<script>
    $(function()
    {
        (function sendRequest(elementsIndex, offersIndex, stepCount, page, pluralStepCount)
        {
            //history.pushState(null, document.title, '<?=$scriptPath;?>?AJAX=true');

            if(!$('[data-page="1"]').length)
                $('#answer').append('<div data-page="1"><hr>Страница 1 из <?=$pagesCount?><hr></div>');

            if(elementsIndex + 1 > stepCount)
            {
                if(page < <?=$pagesCount?>)
                {
                    ++page;
                    elementsIndex = offersIndex = 0;

                    $('#answer').append('<div data-page="' + page + '"><hr>Страница ' + page + ' из <?=$pagesCount?><hr></div>');
                }
                else
                {
                    $('#answer').append('<h3>Выгрузка товаров успешно завершена</h3>');
                    return;
                }
            }
            let msg = 'Шаг ' + (elementsIndex + 1) +' (' + offersIndex + ' - ' + (offersIndex + 10) + ') из ' + pluralStepCount + '...';

            if($('[data-step="' + (elementsIndex + 1) + '"][data-page="' + page + '"]').length)
                $('[data-step="' + (elementsIndex + 1) + '"][data-page="' + page + '"]').text(msg);
            else
                $('#answer').append('<div data-step="' + (elementsIndex + 1) + '" data-page="' + page + '">' + msg + '</div>');

            $.get('<?=$scriptPath;?>', {AJAX: 1, elementsIndex: elementsIndex, offersIndex: offersIndex, page: page}, function(ans) {
                if(typeof ans['elementsOffset'] !== 'undefined' && typeof ans['offersOffset'] !== 'undefined')
                    sendRequest(ans.elementsOffset, ans.offersOffset, ans.stepCount, page, ans.pluralStepCount);
            }, 'json');
        })(<?=$elementsIndex?>, <?=$offersIndex?>, <?=$stepCount?>, <?=$page?>, '<?=\Lema\Common\Helper::pluralizeN($stepCount, ['шага', 'шагов', 'шагов'])?>');
    })
</script>
