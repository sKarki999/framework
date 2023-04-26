<?php 

abstract class BaseController {

    use Session;
    use Validation;

    public function __construct() {
        
        $this->startSession();
        // load helper if exists
        if(file_exists('../application/helpers/Redirect.php')) {
            require_once('../application/helpers/Redirect.php');
        } else {
            die("<div style='background-color:papayawhip; border:2px solid black; 
                padding:15px;'><h3>Error :</h3><pre style='font-size:20px;'> Redirect Helper Not Found !! Please provide valid File name.</pre></div>");
        }
        if(file_exists('../application/helpers/Template.php')) {
            require_once('../application/helpers/Template.php');
        } else {
            die("<div style='background-color:papayawhip; border:2px solid black; 
                padding:15px;'><h3>Error :</h3><pre style='font-size:20px;'> Redirect Helper Not Found !! Please provide valid File name.</pre></div>");
        }
    }

    //if view exists, require once
    public function view($viewName, $data = []) {

        if(file_exists("../application/views/".$viewName.".php")) {
            require_once "../application/views/".$viewName. ".php";
        }        
    }

   
    //if model exists, require and instantiate 
    public function model($modelName) {

        if(file_exists("../application/models/".$modelName. ".php")) {
            require_once "../application/models/".$modelName. ".php";
            $modelName = ucwords($modelName);
            return new $modelName;
        } else {
            echo "Model not found";
        }
    }
}

?>