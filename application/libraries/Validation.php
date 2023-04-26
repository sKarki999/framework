<?php 

trait Validation {

    public $error = [];

    // method for validation
    // takes 3 parameters: fieldname, form label name, rules
    public function validation($fieldName, $label, $rules) {

        // check form 'method' - GET or POST
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST' || $method == 'post') {
            if (isset($_POST[$fieldName])) {
                // store the field value
                $value = trim($_POST[$fieldName]);
            }
        } else if ($method == 'GET' || $method="get") {
            if(isset($_GET[$fieldName])) {
                $value = trim($_GET[$fieldName]);
            }
        }

        // check for passed rules
        // explode the rules into array
        $rules = explode("|", $rules);
        //print_r($rules);
        // search for specific rule in array
        // using PHP built-in function: in_array
        if (in_array('required', $rules)) {
            // check if value is empty
            if (empty($value)) {
                return $this->error[$fieldName] = $label . ' is required';
            }
        }

        // check for min length error
        // check if 'min_len' rule is present
        if(in_array('min_len', $rules)) {
            // get the index of 'min_len'
            $min_len_index = array_search("min_len", $rules);
            // next index from min_len is the actual required min length value's index
            $min_len_value_index = $min_len_index + 1;
            // get the value from the index
            $min_len_value = $rules[$min_len_value_index];
            // check for minimum length
            if(strlen($value) < $min_len_value) {
                return $this->error[$fieldName] = $label . ' should be atleast ' .$min_len_value. ' characters long';
            }
        }
    }

    // method to check for errors in the fields passed
    public function noError() {
        // if no errors, return true else false
        if (empty($this->error)) {
            return true;
        } else {
            return false;
        }
    }

    // simple password hashing method
    public function hashPassword($password) {
        if(!empty($password)) {
            return password_hash($password, PASSWORD_DEFAULT);
        }
    }

}

?>