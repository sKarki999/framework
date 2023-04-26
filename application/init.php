<?php

require_once "config/config.php";
// autoload all the libraries file
spl_autoload_register(function($className) {
    include "libraries/$className.php";
     
 });
 
$route = new Route();

?>