<?php
      namespace Caaqil\Controllers\Dashboard;
      use Slim\Views\Twig as View;
      use Caaqil\Models\User;
      use Caaqil\Controllers\Controller as Controller;
      class Admin extends Controller {
            

          public function index($request , $response) {
            //  $this->flash->addMessage('info' , 'test message');
            // $user = $this->auth->user()->role;
            // var_dump($user);
            // die();
              return $this->view->render($response , 'home.html');

          }
  }
  