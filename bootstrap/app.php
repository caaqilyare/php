<?php 

require __DIR__. '/../vendor/autoload.php';
session_start();

use Respect\Validation\Validator as v;
use Caaqil\View\Factory;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;


LengthAwarePaginator::viewFactoryResolver(function () {
    return new Factory;
});

LengthAwarePaginator::defaultView('pagination/page.twig');

Paginator::currentPathResolver(function () {
    return isset($_SERVER['REQUEST_URI']) ? strtok($_SERVER['REQUEST_URI'], '?') : '/';
});

Paginator::currentPageResolver(function () {
    return $_GET['page'] ?? 1;
});

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
        'db' => [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'cms',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ],
]);



$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;

$capsule->addConnection($container['settings']['db']);

$capsule->setAsGlobal();

$capsule->bootEloquent();

$container['db'] = function () {
    return new PDO('mysql:host=localhost;dbname=cms', 'root', '');
};

// $container['auth'] = function ($container) {
//     return new \Caaqil\Auth\Auth;
// };
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig( __DIR__. '/../resource/views', [
        'cache' => false,
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));
    
    // $view->getEnvironment()->addGlobal('auth',[
    //     'check' =>$container->auth->check(),
    //     'user' =>$container->auth->user()
    // ]);
    $view->getEnvironment()->addGlobal('flash',$container->flash);
    $view = Factory::getEngine();
    
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

$container['HomeController'] = function ($container) {
    return new \Caaqil\Controllers\HomeController($container);
};

// $container['Admin'] = function ($container) {
//     return new \Caaqil\Controllers\Dashboard\Admin($container);
// };

// $container['Sub'] = function ($container) {
//     return new \Caaqil\Controllers\Dashboard\Sub($container);
// };

$container['validator'] = function ($container) {
    return new Caaqil\Validation\Validator;
};

$container['AuthController'] = function ($container) {
    return new \Caaqil\Controllers\Auth\AuthController($container);
};
$container['PasswordController'] = function ($container) {
    return new \Caaqil\Controllers\Auth\PasswordController($container);
};

$container['csrf'] = function ($container) {
    return new \Slim\Csrf\Guard;
};


$app->add(new Caaqil\Middleware\ValidationErrorsMiddleware($container));
$app->add(new Caaqil\Middleware\OldInputMiddleware($container));
$app->add(new Caaqil\Middleware\CsrfViewMiddleware($container));
$app->add($container->csrf);
v::with('Caaqil\\Validation\\Rules\\');
require __DIR__ . '/../app/routes.php';