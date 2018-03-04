<?php
session_start();
require '../vendor/autoload.php';
require '../DBHandeler.php';

use DavidePastore\Slim\Validation\Validation;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Respect\Validation\Validator;
use Slim\App;
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
    return new PhpRenderer('../templates/');
};

$container['csrf'] = function ($container) {
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
    $payingUser = 'kevin';
} else {
    $payingUser = strtolower(explode('.', $_SERVER['HTTP_HOST'])[0]);
    if ($payingUser == 'betaaltalles' || $payingUser == 'www') {
        $payingUser = '';
    }
}

/**
 * Make sure explanation page is shown.
 */
$app->add(function (Request $request, Response $response, callable $next) use ($payingUser) {
    if ($payingUser == '') {
        return $next($request->withUri($request->getUri()->withPath('/explanation/')), $response);
    } else {
        return $next($request, $response);
    }
});

/**
 * Explanation page
 */
$app->get('/explanation/', function (Request $request, Response $response) use ($payingUser): Response {
    $db = new DBHandeler($payingUser);
    $data = $db->totalPayments();
    return $this->view->render($response, 'explanation.php', [
        'payments' => $data,
    ]);
});

/**
 * Return home page
 * method GET
 * url /
 */
$app->get('/', function (Request $request, Response $response) use ($payingUser): Response {
    $db = new DBHandeler($payingUser);
    $data = $db->totalUserPayments();
    return $this->view->render($response, 'home.php', [
        'payments' => $data,
        'payer' => $payingUser,
    ]);
});

/**
 * Display a page which says Kevin will pay
 * method GET
 * url /{name}
 */
$app->get('/{name}', function (Request $request, Response $response, array $args) use ($payingUser): Response {
    if (strtolower($args['name']) == $payingUser) {
        return $this->view->render($response, 'nope.php', [
            'payer' => $payingUser,
        ]);
    } else {
        $db = new DBHandeler($payingUser);
        $data = $db->totalUserPaymentsForUser($args['name']);
        return $this->view->render($response, 'index.php', [
            'name' => capitalize($args['name']),
            'payments' => $data,
            'payer' => $payingUser,
        ]);
    }
});

/**
 * Get the form page to add a payment
 * method GET
 * url /add/payment
 */
$app->get('/add/payment[/{who}]',
    function (Request $request, Response $response, array $args) use ($payingUser): Response {
        if (strtolower($args['who']) == $payingUser) {
            return $this->view->render($response, 'nope.php', [
                'payer' => $payingUser,
            ]);
        }
        $nameKey = $this->csrf->getTokenNameKey();
        $valueKey = $this->csrf->getTokenValueKey();
        $name = $request->getAttribute($nameKey);
        $value = $request->getAttribute($valueKey);

        return $this->view->render($response, 'payment.php', [
            'nameKey' => $nameKey,
            'valueKey' => $valueKey,
            'name' => $name,
            'value' => $value,
            'payer' => $payingUser,
            'who' => $args['who'] ? capitalize($args['who']) : '',
        ]);
    });

/**
 * Add a payment to the database and validate user input on error an error page is shown else a succes page
 * method POST
 * url /add/payment
 */
$app->post('/add/payment[/{who}]', function (Request $request, Response $response) use ($payingUser): Response {
    if ($request->getAttribute('has_errors')) {
        return $this->view->render($response, 'fail.php');
    } else {
        $allPostPutVars = $request->getParsedBody();

        $db = new DBHandeler($payingUser);
        $db->addPayment($allPostPutVars['name'], (int)$allPostPutVars['geld'], $allPostPutVars['wat']);

        return $this->view->render($response, 'succes.php', [
            'cost' => $allPostPutVars['geld'],
            'name' => capitalize($allPostPutVars['name']),
            'payer' => $payingUser,
        ]);
    }
})->add(new Validation($validators));

$app->get('/wordcount/', function (Request $request, Response $response): Response {
    $nameKey = $this->csrf->getTokenNameKey();
    $valueKey = $this->csrf->getTokenValueKey();
    $name = $request->getAttribute($nameKey);
    $value = $request->getAttribute($valueKey);
    return $this->view->render($response, 'wordForm.php', [
        'nameKey' => $nameKey,
        'valueKey' => $valueKey,
        'name' => $name,
        'value' => $value,
    ]);
});

$app->post('/wordcount/', function (Request $request, Response $response): Response {
    $text = $request->getParsedBody()['text'];
    $text = preg_replace('/[^A-Za-z\ ]/', ' ', $text);
    $words = explode(' ', $text);
    usort($words, function ($wordA, $wordB) {
        return strcmp($wordA, $wordB);
    });
    $result = [];
    foreach ($words as $word) {
        if (array_key_exists($word, $result)) {
            $result[$word]++;
        } elseif ($word) {
            $result[$word] = 1;
        }
    }
    return $this->view->render($response, 'wordCount.php', [
        'words' => $result,
    ]);
});

function capitalize(string $user): string
{
    if (strpos($user, ' ') === false) {
        return ucfirst($user);
    }
    return $user;
}

try {
    $app->run();
} catch (MethodNotAllowedException $e) {
} catch (NotFoundException $e) {
} catch (Exception $e) {
}
