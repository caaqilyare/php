<?php
    use Caaqil\Middleware\AuthMiddleware;
    use Caaqil\Middleware\GuestMiddleware;
    use Caaqil\Middleware\AdminMiddleware;
    use Caaqil\Middleware\SubMiddleware;

$app->get('/' , 'HomeController:index')->setName('home');
$app->get('/pages/{slug}' , 'HomeController:pages')->setName('pages');
$app->get('/search/' , 'HomeController:search')->setName('raadi');
$app->get('/raadin/{slug}' , 'HomeController:raadin')->setName('raadin');

// $app->group('' , function () {

//     $this->get('/dashboard/admin' , 'Admin:index')->setName('admin');  
    
//     })->add(new AdminMiddleware($container));

//     $app->group('' , function () {

//         $this->get('/dashboard/subscriber' , 'Sub:index')->setName('subscriber');   

//         })->add(new SubMiddleware($container));

// $app->group('' , function () {

//     $this->get('/auth/singup' , 'AuthController:getSingUp')->setName('auth.singup');
//     $this->post('/auth/singup' , 'AuthController:postSingUp');
    
//     $this->get('/auth/login' , 'AuthController:getLogin')->setName('auth.login');
//     $this->post('/auth/login' , 'AuthController:postLogin');    
    
//     })->add(new GuestMiddleware($container));

// $app->group('' , function () {

// $this->get('/auth/password/change' , 'PasswordController:getChange')->setName('auth.password.change');
// $this->post('/auth/password/change' , 'PasswordController:postChange');
// $this->get('/auth/logout' , 'AuthController:postSingOut')->setName('auth.logout');

// })->add(new AuthMiddleware($container));


