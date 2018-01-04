<?php
require 'vendor/autoload.php';

use Slim\App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
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

/**
 * Return home page
 * method GET
 * url /
 */
$app->get('/', function (Request $request, Response $response): Response {
    return $response;
});

/**
 * Display a page which says Kevin will pay
 * method GET
 * url /{name}
 */
$app->get('/kevin', function (Request $request, Response $response): Response {
    return $this->view->render($response, 'nope.php');
});


/**
 * Display a page which says Kevin will pay
 * method GET
 * url /{name}
 */
$app->get('/{name}', function (Request $request, Response $response, $args): Response {
    return $this->view->render($response, 'index.php', [
        'name' => $args['name']
    ]);
});


try {
    $app->run();
} catch (MethodNotAllowedException $e) {
} catch (NotFoundException $e) {
} catch (Exception $e) {
}