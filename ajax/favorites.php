<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

isset($_GET['action']) && in_array($_GET['action'], array('add', 'delete')) || exit(json_encode(array('status' => false)));

$favorites = new \Lema\Basket\Basket();

$errors = array();
$status = false;
$inFavorites = false;

switch ($_GET['action']) {
    case 'add':
        $form = new \Lema\Forms\AjaxForm(
            array(
                array('ID', 'required'),
                array('ID', 'numerical'),
            ),
            $_GET
        );
        foreach ($favorites->getProducts() as $product) {
            if ($product['PRODUCT_ID'] == $form->getField('ID')) {
                $inFavorites = true;
                $errors['inFavorites'] = 'Объект уже находится в избранном';
            } else {
                continue;
            }
        }
        $status = empty($errors);
        if ($form->validate() && $status) {
            $status = $favorites->add(array(
                'UF_PRODUCT' => $form->getField('ID')
            ));
        } else {
            $errors = array_merge($errors, $form->getErrors());
        }

        break;
    case 'delete':

        $form = new \Lema\Forms\AjaxForm(
            array(
                array('ID', 'required'),
                array('ID', 'numerical'),
            ),
            $_GET
        );

        if ($form->validate()) {
            $status = $favorites->delete($form->getField('ID'));
        } else {
            $errors = $form->getErrors();
        }
        break;
}

echo json_encode(array(
    'inFavorites' => $inFavorites,
    'status' => $status,
    'errors' => $errors,
    'products' => $favorites->getProducts(),
    'positionsCount' => $favorites->getPositionsCount(),
    'totalSum' => $favorites->getTotalPrice(),
    'totalSumFormatted' => $favorites->getTotalPrice(true),
));

exit;