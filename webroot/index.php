<?php
session_start();
require '../vendor/autoload.php';
require '../DBHandeler.php';

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Slim\App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Csrf\Guard;
use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;
use Slim\Views\PhpRenderer;

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
    return new PhpRenderer('templates/');
};

$container['csrf'] = function ($c) {
    return new Guard;
};

try {
    $app->add($container->get('csrf'));
} catch (NotFoundExceptionInterface $e) {
} catch (ContainerExceptionInterface $e) {
}

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
$app->get('/', function (Request $request, Response $response): Response {
    return $this->view->render($response, 'home.php');
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
$app->get('/{name}', function (Request $request, Response $response, array $args): Response {
    return $this->view->render($response, 'index.php', [
        'name' => $args['name'],
    ]);
});

$app->get('/add/payment', function (Request $request, Response $response): Response {
    $nameKey = $this->csrf->getTokenNameKey();
    $valueKey = $this->csrf->getTokenValueKey();
    $name = $request->getAttribute($nameKey);
    $value = $request->getAttribute($valueKey);

    return $this->view->render($response, 'payment.php', [
        'nameKey' => $nameKey,
        'valueKey' => $valueKey,
        'name' => $name,
        'value' => $value,
    ]);
});

$app->post('/add/payment', function (Request $request, Response $response): Response {
    $allPostPutVars = $request->getParsedBody();

    $db = new DBHandeler();
    $db->addPayment($allPostPutVars['name'], (int)$allPostPutVars['geld']);

    return $this->view->render($response, 'succes.php', [
        'cost' => $allPostPutVars['geld'],
        'name' => $allPostPutVars['name'],
    ]);
});

try {
    $app->run();
} catch (MethodNotAllowedException $e) {
} catch (NotFoundException $e) {
} catch (Exception $e) {
}
