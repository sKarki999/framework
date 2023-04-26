<?php 

class DashboardModel {

    private $database;

    public function __construct() {
        // instantiate database class
        $this->database = new Database();
    }

    // method to count total records in a table
    public function count($tableName) {
        // query to select all
        $sql = "SELECT * FROM " .$tableName;
        // preparing query
        $this->database->prepareQuery($sql);
        // execute and return the count
        $this->database->executeQuery();
        try {
            return $this->database->count();
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // method to count records by passed field name
    public function countField($tableName, $field, $status) {

        $sql = "SELECT * FROM " .$tableName. " WHERE " .$field. " = :status";
        //echo "<pre>" . print_r($sql, true);
        $this->database->prepareQuery($sql);
        // bind values, execute and return
        $this->database->bindQuery(':status', $status);
        $this->database->executeQuery();
        try {
            return $this->database->count();
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }


}


?>