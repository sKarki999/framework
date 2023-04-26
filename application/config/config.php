<?php


// default controllers, methods and parameters
define("defaultController", "Site");
define("defaultMethod", "index");
define("defaultParam", []);


// database parameters
define("Database", "MySQL");
switch(Database) {

    case 'MySQL':
        // database default parameters for mysql
        define("DSN", "mysql:host=localhost;dbname=db_cms");
        define("DB_USER", "root");
        define("DB_PASS", "");
    break;

    case 'PostgreSQL':
        // database default parameters for postgresql
        define("DSN", "pgsql:host=localhost;dbname=db_cms");
        define("DB_USER", "postgres");
        define("DB_PASS", "password");
    break;

    default:
    // can add other database 
    break;

}


// App Root
define("APPROOT", dirname(dirname(__FILE__)));


// URL Root
define("baseUrl", "http://localhost/Orion");

// Site Name
define("SITE_NAME", "Visit Nepal");

?>