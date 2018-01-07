<?php
session_start();
require '../vendor/autoload.php';
require '../DBHandeler.php';

use DavidePastore\Slim\Validation\Validation;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Slim\App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Csrf\Guard;
use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;
use Slim\Views\PhpRenderer;
use Respect\Validation\Validator;

$config = [
    'settings' => [
        'displayErrorDetails' => false,
    ],
];

$app = new App($config);

// Get container
$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {
    return new PhpRenderer('../templates/');
};

$container['csrf'] = function ($c) {
    return new Guard;
};

try {
    $app->add($container->get('csrf'));
} catch (NotFoundExceptionInterface $e) {
} catch (ContainerExceptionInterface $e) {
}

//Create the validators
$textValidator = Validator::alnum()->length(1, 999);
$numberValidator = Validator::numeric()->positive()->between(1, 2147483647);
$validators = [
    'name' => $textValidator,
    'geld' => $numberValidator,
    'wat' => $textValidator,
];

if (strpos(strtolower($_SERVER['HTTP_HOST']), 'kevin') !== false) {
    $paying_user = 'kevin';
} else {
    $paying_user = strtolower(explode('.', $_SERVER['HTTP_HOST'])[0]);
    if ($paying_user == 'betaaltalles' || $paying_user == 'rens') {
        $paying_user = 'kevin';
    }
}

/**
 * Make sure kevin always reaches the correct route
 */
$app->add(function (Request $request, Response $response, callable $next) {
    $path = $request->getUri()->getPath();
    $path = (strtolower($path) == '/kevin') ? '/kevin' : $path;
    $uri = $request->getUri()->withPath($path);
    return $next($request->withUri($uri), $response);
});

/**
 * Return home page
 * method GET
 * url /
 */
$app->get('/', function (Request $request, Response $response) use ($paying_user): Response {
    $db = new DBHandeler($paying_user);
    $data = $db->totalPayments();
    return $this->view->render($response, 'home.php', [
        'total' => $data->amount,
        'count' => $data->payments,
        'payer' => $paying_user,
    ]);
});

/**
 * Display a page which says Kevin will pay for him self off course he will.
 * method GET
 * url /kevin
 */
$app->get('/kevin', function (Request $request, Response $response): Response {
    return $this->view->render($response, 'nope.php');
});

/**
 * Display a page which says Kevin will pay
 * method GET
 * url /{name}
 */
$app->get('/{name}', function (Request $request, Response $response, array $args) use ($paying_user): Response {
    return $this->view->render($response, 'index.php', [
        'name' => $args['name'],
        'payer' => $paying_user,
    ]);
});

/**
 * Get the form page to add a payment
 * method GET
 * url /add/payment
 */
$app->get('/add/payment', function (Request $request, Response $response) use ($paying_user): Response {
    $nameKey = $this->csrf->getTokenNameKey();
    $valueKey = $this->csrf->getTokenValueKey();
    $name = $request->getAttribute($nameKey);
    $value = $request->getAttribute($valueKey);

    return $this->view->render($response, 'payment.php', [
        'nameKey' => $nameKey,
        'valueKey' => $valueKey,
        'name' => $name,
        'value' => $value,
        'payer' => $paying_user,
    ]);
});

/**
 * Add a payment to the database and validate user input on error an error page is shown else a succes page
 * method POST
 * url /add/payment
 */
$app->post('/add/payment', function (Request $request, Response $response) use ($paying_user): Response {
    if ($request->getAttribute('has_errors')) {
        return $this->view->render($response, 'fail.php');
    } else {
        $allPostPutVars = $request->getParsedBody();

        $db = new DBHandeler($paying_user);
        $db->addPayment($allPostPutVars['name'], (int)$allPostPutVars['geld'], $allPostPutVars['wat']);

        return $this->view->render($response, 'succes.php', [
            'cost' => $allPostPutVars['geld'],
            'name' => $allPostPutVars['name'],
            'payer' => $paying_user,
        ]);
    }
})->add(new Validation($validators));

try {
    $app->run();
} catch (MethodNotAllowedException $e) {
} catch (NotFoundException $e) {
} catch (Exception $e) {
}
