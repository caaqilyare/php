<?php 

namespace Caaqil\Middleware;

class ValidationErrorsMiddleware extends Middleware {

    
    public function __invoke($request , $response , $next)   {
        $errors = isset($_SESSION['error']) ? $_SESSION['error'] : 'No Errors';
       // if (isset($_SESSION['error'])) {
            $this->container->view->getEnvironment()->addGlobal('errors', $errors);
            unset($_SESSION['errors']);
     //  }
        $response = $next($request , $response);
        return $response;
       // }   
     }

}