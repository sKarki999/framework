<?php 

class SettingsModel {

    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    // get all data from the table
    public function selectAll($tableName) {
        // query to select all from given table
        $sql = "SELECT * FROM " .$tableName;
        // preparing query
        $this->database->prepareQuery($sql);
        try {
            // execute and fetch all, if no error
            if ($this->database->executeAndFetchAll()) {
                return $this->database->executeAndFetchAll();
            }
        } catch (PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }


    //update the settings in the table
    public function updateSettings($tableName, $data, $id) {
        // get array values
        $values = array_values($data);
        // push the id in the array
        array_push($values, $id);
        // looping through the data to grab keys
        // concatenate with placeholder '?'
        $field = '';
        foreach($data as $key=>$value) {
            $field .= $key . " = ? ,";
        }
        $field = rtrim($field, " ,");
        // query to update data
        $sql = "UPDATE ". $tableName. " SET " .$field. " WHERE id = ?";
        $this->database->prepareQuery($sql);
        try {
            // execute the query with values passed as an array
            if ($this->database->executeQuery($values)) {
                return true;
            }
        } catch (PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }
}
?>