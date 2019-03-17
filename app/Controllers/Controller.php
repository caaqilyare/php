<?php
namespace Caaqil\Controllers;

class Controller {
         protected $container;

    public function __construct($container) {

        $this->container = $container;
    }
    public function __get($prob) {

        if($this->container->{$prob}) {
            
            return $this->container->{$prob};
        } 
    }
}