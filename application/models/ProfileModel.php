<?php 

class ProfileModel {

    private $database;
    public function __construct() {
        $this->database = new Database();
    }

    // method to get all details 
    public function getAll($id) {
        // sql to select user's details based on id
        $sql = "SELECT * from tbl_users WHERE user_id = :id";
        $this->database->prepareQuery($sql);
        // bind value separately
        $this->database->bindQuery(':id', $id);
        try {
            return $this->database->executeAndFetchAll();
        } catch (PDOException $e) {
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

}
?>