<?php 

class MessageModel {

    private $database;
    public function __construct() {
        $this->database = new Database();
        
    }

    // method to get all message details from 'contact' table
    public function getAllMessages() {
        try {
            return $this->database->fetchAllByTablename('contact');
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // method to get message based on id
    public function getMessageById($id) {

        $sql = "SELECT * from contact WHERE id = :id";
        $this->database->prepareQuery($sql);
        $this->database->bindQuery(':id', $id);
        try {
            return $this->database->executeAndFetchAll();
        } catch (PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
        
    }

    // method to delete message based on id
    public function deleteMessageById($id) {
        try {
            if($this->database->deleteById('contact', 'id', $id)) {
                return true;
            }
        } catch (PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
        
    }
}

?>