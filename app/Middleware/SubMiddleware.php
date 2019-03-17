<?php 

namespace Caaqil\Middleware;

class SubMiddleware extends Middleware {

    
    public function __invoke($request , $response , $next)   {

        if($this->container->auth->check()) {
            $user = $this->container->auth->user()->role;
            if($user == 'admin') {
                $this->container->flash->addMessage('error' , 'Meeshaan Shaqaalaha ayaa loogu tala galay fadlan haku soo laabanin');
                return $response->withRedirect($this->container->router->pathFor('home'));
            }
        } else {
            $this->container->flash->addMessage('error' , 'Fadlan Ciwaan kaag soo gali marka hore');
            return $response->withRedirect($this->container->router->pathFor('auth.login'));
        }
        
        $response = $next($request , $response);
        return $response;
       // }
    }

}