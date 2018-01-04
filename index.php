<?php
require 'vendor/autoload.php';

use Slim\App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;
use Slim\Views\PhpRenderer;

$app = new App();


$app->add(function (\Slim\Http\Request $request, \Slim\Http\Response $response, callable $next) {

    $path = $request->getUri()->getPath();
    $path = (strtolower($path) == 'kevin') ? 'kevin' : $path;
    $uri = $request->getUri()->withPath($path);
    return $next($request->withUri($uri), $response);
});

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
$app->get('/{name}', function (Request $request, Response $response, $args): Response {
    return $this->view->render($response, 'index.php', [
        'name' => $args['name'],
    ]);
});

try {
    $app->run();
} catch (MethodNotAllowedException $e) {
} catch (NotFoundException $e) {
} catch (Exception $e) {
}
