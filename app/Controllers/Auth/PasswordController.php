<?php
      namespace Caaqil\Controllers\Auth;
      use Slim\Views\Twig as View;
      use Caaqil\Models\User;
      use Caaqil\Controllers\Controller;
      use Respect\Validation\Validator as v;
      class PasswordController extends Controller {
            
        public function getChange($request , $response) {
            // $search = $req->getParam('search');
               // var_dump($request->getAttribute('csrf_value'));
            return $this->view->render($response , 'auth/password/change.html');
         }
         public function postChange($request , $response) {
            $validation = $this->validator->validate($request , [
                'password_old' => v::noWhitespace()->notEmpty()->MatchesPassword($this->auth->user()->password),
                'password' => v::noWhitespace()->notEmpty()
            ]);
            if($validation->fieled()) {
              return $response->withRedirect($this->router->pathFor('auth.password.change'));
            }
            $this->auth->user()->setPassword($request->getParam('password'));

            $this->flash->addMessage('info', 'Si sax ayaad u badhashay password ka');
           return $response->withRedirect($this->router->pathFor('home'));

           }

  }

  