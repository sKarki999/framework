<?php 

class Route {
    
    protected $currentController = defaultController;
    protected $currentMethod = defaultMethod;
    protected $params = defaultParam;

    public function __construct() {

        $url = $this->getUrl();

        if (!empty($url)) {

            // check if controller exists
            if (file_exists("../application/controllers/" .$url[0]. ".php")) {
                
                // if file exists, replace the pre-defined 'default controller'
                // capitalize first letter
                $this->currentController = ucwords($url[0]);
                unset($url[0]);
                
            } else {
                die("<h3>Error :</h3><pre style='font-size:20px;'> Controller '".$url[0]."' Not Found !!");
            }

            //Require and Instantiate the Controller
            require_once "../application/controllers/" . $this->currentController. ".php";
            $this->currentController = new $this->currentController;

            //check second index for the method
            if (isset($url[1])) {
                //if method exists then replace the pre-defined 'method'
                if (method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            } 

            //Check for arguments
            if (isset($url)) {
                $this->params = array_values($url);
            } else {
                $this->params = [];
            }
        } else {
            header("Location: " . $this->currentController);
        }
    
        //call the method finally using php built-in function
        call_user_func_array([$this->currentController,$this->currentMethod], $this->params);
    }


    // Funtion to get the url, sanitize url
    public function getUrl() {
        if(isset($_GET['url'])) {
            // store the url in a variable
            $url = $_GET['url'];
            // remove extra spaces from url
            $url = rtrim($url);
            // filter variables : remove illegal characters
            $url = filter_var($url, FILTER_SANITIZE_URL);
            //Breaking it into an array: using explode
            $url = explode("/", $url);
            return $url;    
        } 
    }

}

?>