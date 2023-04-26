<?php 

class AccountModel {

    private $database;
    public function __construct() {
        $this->database = new Database();
    }

    // method to validate credentials
    // takes two parameters
    public function verifyCredentials($usernameOrEmail, $password) {
        // query to check email or username
        $sql = "SELECT * FROM tbl_users WHERE username = :input OR email = :input";
        $this->database->prepareQuery($sql);
        // bind the input value
        $this->database->bindQuery(':input', $usernameOrEmail);
        $this->database->executeQuery();
        // count the result
        $count = $this->database->count();
        // print_r($count);
        
        if ($count > 0) {
            $records = $this->database->executeAndFetchAll();
            //print_r($records);
            $dbPassword = $records[0]['password'];
           
            // verify the given password with hashed password
            if ($password === $dbPassword) {
                // return success if verified
                return ['status' => 'success', 'records' => $records[0]];
            } else {
                return ['status' => 'passwordNotMatched'];
           }

        } else {
            return ['status' => 'usernameOrEmailNotFound'];
        }
        

    }

}
?>