<?php 

class CategoryModel {

    private $database;

    public function __construct() {
        // instantiate Database class
        $this->database = new Database();
    }

    // count number of categories
    public function countCategory() {
        // fetch all data
        $this->database->fetchAllByTablename('categories');
        try {
            // count the fetched data and return value
            return $this->database->count();
        } catch (PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // method to fetch data for pagination    
    public function getCategoriesWithPagination($startPage, $perPage) {
        // LIMIT and OFFSET to determine the items per page and starting row
        $sql = "SELECT * FROM categories ORDER BY cat_title ASC 
                LIMIT ".$perPage. " OFFSET ". $startPage;
        // prepare query
        $this->database->prepareQuery($sql);
        try {
            // fetch all records
            if($this->database->executeAndFetchAll()) {
                return $this->database->executeAndFetchAll();
            }
        } catch (PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }

    }

    // method to insert data into database
    public function insertCategory($data = null) {
        try {
            // call insert method in database
            // passing two parameters, tablename and data
            if($this->database->insert('categories', $data)) {
                return true;
            }
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }

    }


    // method to get single category based on id
    public function getCategoryById($id) {
        try {
            // return the fetched category
            return $this->database->fetchById('categories', 'cat_id', $id);
        } catch (PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // method to get single category based on given field
    public function getCategoryByField($field) {
        // sql to get required field
        $sql = "SELECT * FROM categories WHERE cat_title = :title";
        $this->database->prepareQuery($sql);
        // binding the value
        $this->database->bindQuery(':title', $field);
        // execute and fetch all 
        $this->database->executeAndfetchAll();
        // count the fetched data and return the count
        try {
            return $this->database->count();
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }


    // method to update category
    public function updateCategory($data, $id) {
        // sql without binding values
        $sql = "UPDATE categories SET cat_title = :catTitle WHERE cat_id = :id";
        $this->database->prepareQuery($sql);
        // binding values seperately
        $this->database->bindQuery(':catTitle', $data);
        $this->database->bindQuery(':id', $id);
        try {
            // execute query
            if($this->database->executeQuery()) {
                return true;
            }
        } catch (PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // delete category based on id
    public function deleteCategoryById($id) {
        // check whether the id exists or not
        $this->database->fetchById('categories', 'cat_id', $id);
        if($this->database->count() > 0) {
            try {
                // call to delete method in database
                if($this->database->deleteById('categories', 'cat_id' , $id)) {
                    return true;    
                }
            } catch (PDOException $e) {
                die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
                Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
            }    
        } else {
            die("<h3>Error:</h3>Id doesnot exists.");
        }
    }
}

?>