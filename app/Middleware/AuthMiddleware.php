<?php 

namespace Caaqil\Middleware;

class AuthMiddleware extends Middleware {

    
    public function __invoke($request , $response , $next)   {
        
        if(!$this->container->auth->check()) {
            $this->container->flash->addMessage('error' , 'Fadlan Ciwaan kaag soo gali marka hore');
            return $response->withRedirect($this->container->router->pathFor('auth.login'));
        }
        
        $response = $next($request , $response);
        return $response;
       // }
    }

}