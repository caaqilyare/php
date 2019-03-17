<?php
      namespace Caaqil\Controllers\Auth;
      use Slim\Views\Twig as View;
      use Caaqil\Models\User;
      use Caaqil\Controllers\Controller;
      use Respect\Validation\Validator as v;
      class AuthController extends Controller {
            
        public function getLogin($request , $response) {
            // $search = $req->getParam('search');
               // var_dump($request->getAttribute('csrf_value'));
            return $this->view->render($response , 'auth/login.html');
         }
         public function postSingOut($request , $response) {
             $this->auth->kabax();
             return $response->withRedirect($this->router->pathFor('home'));

           }

         public function postLogin($request , $response) {
          $auth = $this->auth->iskuday(
              $request->getParam('email'),
              $request->getParam('password')
           );

           if(!$auth) {
               $this->flash->addMessage('error', 'Ciwaanka ama Password ka mid ayaa qaldan');
            return $response->withRedirect($this->router->pathFor('auth.login'));
           }
           $this->flash->addMessage('info', 'Si sax ayaad u gashay ciwaan kaaga '.$request->getParam('email'));
           return $response->withRedirect($this->router->pathFor('home'));
         }

          public function getSingUp($request , $response) {
             // $search = $req->getParam('search');
                // var_dump($request->getAttribute('csrf_value'));
              return $this->view->render($response , 'auth/create.html');
          }
          public function postSingUp($request , $response) {
              $validation = $this->validator->validate($request , [
                  'name' => v::notEmpty()->alpha(),
                  'email' => v::noWhitespace()->notEmpty()->email()->EmailAvailable(),
                  'password' => v::noWhitespace()->notEmpty()
              ]);
              if($validation->fieled()) {
                return $response->withRedirect($this->router->pathFor('auth.singup'));
              }

           $user =   User::create([
                    'name' => $request->getParam('name'),
                    'email' => $request->getParam('email'),
                    'password' => password_hash($request->getParam('password') , PASSWORD_DEFAULT ) 
                ]);
           $this->flash->addMessage('info', 'Si sax ayaad isu diiwaan galisay waana ku jirta  '.$request->getParam('email'));
                $this->auth->iskuday($user->email , $request->getParam('password'));
                return $response->withRedirect($this->router->pathFor('home'));
         }
  }

  