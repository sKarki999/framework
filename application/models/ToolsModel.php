<?php 

class ToolsModel {

    private $database;
    public function __construct() {
        $this->database = new Database();
    }

    // Method to fetch all data from given table
    public function getAll($tableName) {
        try {
            if ($this->database->fetchAllByTablename($tableName)) {
                return $this->database->fetchAllByTablename($tableName);
            }
        } catch (PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // method to insert passed data into given table name
    public function insertData($tableName, $data) {
        
        // echo "<pre>" . print_r($data, true);
        try {
            // calling database method to insert data
            $this->database->insert($tableName, $data);
            return true;
        } catch (PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

}

?>