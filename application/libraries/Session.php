<?php 

trait Session {

    // start session
    public function startSession() {
        session_start();
    }


    // set session
    public function setSession($name, $value='') {
        // if data passed as an array -> set values in keys using loop
        if (!empty($name)) {
            
            if (is_array($name) && empty($value)) {
                foreach ($name as $key => $sessionValue) {
                    $_SESSION[$key] = $sessionValue;
                }
            } else if (!is_array($name) && !empty($value)) {

                $_SESSION[$name] = $value; 
            }

        }
    }

    // get session
    public function getSession($name){

        if(!empty($name)) {
            return $_SESSION[$name];
        }
    }


    // set flash
    public function setFlash($name, $message) {
        if(!empty($name) && !empty($message)) {
            $_SESSION[$name] = $message;
        }
    }


    // get flash
    public function getFlash($name, $class = '') {

        if(!empty($name) && isset($_SESSION[$name])) {
            
            echo '<div class="mt-3" id="sessionMessage">    
                            <div class="card-header alert ' .$class.'">
                                <h6 class="d-inline-block card-title">' .
                                    $_SESSION[$name].
                                '</h6>
                            </div>
                        </div>';
            unset($_SESSION[$name]);
        }
    }


    // unset session
    public function unsetSession($name) {

        if(!empty($name)) {
            if(is_array($name)) {
                foreach($name as $key) {
                    unset($_SESSION[$name]);
                }
            } else {
                unset($_SESSION[$name]);
            }
        }
    }

    // destroy session
    public function destroySession() {
        session_destroy();
    }
}

?>