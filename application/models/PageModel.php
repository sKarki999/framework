<?php 

class PageModel {

    private $database;

    public function __construct() {
        // instantiate the Database class
        $this->database = new Database();
    }

    // method to count all pages
    public function countAllPages() {
        $this->database->fetchAllByTablename('pages');
        try {
            return $this->database->count();
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    //  method to fetch data for pagination
    public function getPagesWithPagination($start, $perPage) {
        // LIMIT and OFFSET to determine items per page and starting row
        $sql = "SELECT * FROM pages ORDER BY page_date DESC LIMIT " .$perPage. " OFFSET " .$start;
        
        $this->database->prepareQuery($sql);
        try {
            // fetch records as an array
            if($this->database->executeAndFetchAll()) {
                return $this->database->executeAndFetchAll();
            }
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // method to count the number of draft or published pages
    public function statusCount($value) {
        $sql = "SELECT * FROM pages WHERE page_status = :status";
        $this->database->prepareQuery($sql);
        // bind the status value
        $this->database->bindQuery(':status', $value);
        $this->database->executeAndFetchAll();
        try {
            return $this->database->count();
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // insert page
    // takes two parameters: tablename and all the records from the field 
    public function insertPage($data) {
        try {
            if ($this->database->insert('pages', $data)) {
                return true;
            }
        } catch (PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // method to update post status
    public function updatePageStatus($data, $id) {
        $sql = "UPDATE pages SET page_status = :status WHERE page_id = :id";
        // preparing sql without passing values
        $this->database->prepareQuery($sql);
        // binding the values seperately
        $this->database->bindQuery(':status', $data);
        $this->database->bindQuery(':id', $id);
        try {
            // execute query and return true, if true
            if($this->database->executeQuery()) {
                return true;
            }
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // get single record based on id
    public function getSingleRecordById($id) {
        try {
            // fetch single record
            if($this->database->fetchById('pages', 'page_id', $id)) {
                return $this->database->fetchById('pages', 'page_id', $id);
            }
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }


    // method to update page 
    public function updatePage($data, $id) {
        // get array values
        $values = array_values($data);
        // push id in the array
        array_push($values, $id);
        // looping through the data to grab keys
        // concatenate with placeholder '?'
        $field = '';
        foreach($data as $key=>$value) {
            $field .= $key . " = ?,";
        }
        $field = rtrim($field, " ,");
        // sql query to update data
        $sql = "UPDATE pages SET " .$field. " WHERE page_id = ?";
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

    // delete based on id
    public function deletePageById($id) {
        // check whether the id exists or not
        $this->database->fetchById('pages', 'page_id', $id);
        if($this->database->count() > 0) {
            try {
                // call to delete method in database
                if($this->database->deleteById('pages', 'page_id' , $id)) {
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