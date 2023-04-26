<?php 

class UserModel {

    private $database;
    public function __construct() {
        $this->database = new Database();
    }

    // get all users
    public function getAll() {
        // query to select all users
        $sql = "SELECT * FROM tbl_users";
        // prepare query
        $this->database->prepareQuery($sql);
        // execute and fetch all , if no error
        try {
            if($this->database->executeAndFetchAll()) {
                return $this->database->executeAndFetchAll();
            }
        } catch (PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // method to count all users
    public function countAllUsers() {
        $this->getAll();
        // return the count
        try {
            return $this->database->count();
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // method to count users by given role
    public function countUsersByRole($role) {
        // query to select user based on role
        $sql = "SELECT * FROM tbl_users WHERE user_role = :role";
        // prepare query
        $this->database->prepareQuery($sql);
        // bind the values
        $this->database->bindQuery(':role', $role);
        // executing the query
        $this->database->executeAndFetchAll();
        try {   
            // return the count
            return $this->database->count();
        } catch (PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

     // Method to insert user
    // takes two parameters: tablename and all the records from the field 
    public function insertUser($data) {
        try {
            if ($this->database->insert('tbl_users', $data)) {
                return true;
            }
        } catch (PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // method to get user by id
    public function getUserById($id) {
        
        try {
            if($this->database->fetchById('tbl_users', 'user_id', $id)) {
                return $this->database->fetchById('tbl_users', 'user_id', $id);
            }
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // method to get user by id
    public function getUserByField($field, $value) {
        
        $this->database->fetchByField('tbl_users', $field, $value);
        try {
             return $this->database->count();
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // method to update user profile in the database
    public function updateUser($data, $id) {

        // get array values
        $values = array_values($data);
        // push the id in the array
        array_push($values, $id);
        // looping through the data to grab keys
        // concatenate with placeholder '?'
        $field = '';
        foreach($data as $key=>$value) {
            $field .= $key . " = ?,";
        }
        $field = rtrim($field, " ,");
        // query to update data
        $sql = "UPDATE tbl_users SET " .$field. " WHERE user_id = ?";
        $this->database->prepareQuery($sql);
        try {
            // execute the query with values passed as an array
            if($this->database->executeQuery($values)) {
                return true;
            }
        } catch (PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }



    // delete user based on id
    public function deleteUserById($id) {
        // check whether the id exists or not
        $this->database->fetchById('tbl_users', 'user_id', $id);
        if($this->database->count() > 0) {
            try {
                // call to delete method in database
                if($this->database->deleteById('tbl_users', 'user_id' , $id)) {
                    return true;    
                }
            } catch (PDOException $e) {
                die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
                Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
            }    
        } else {
            die("<h3>Error:</h3> Id doesnot exists.");
        }
    }

}
?>