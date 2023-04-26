<?php 

class PostModel {

    private $database;
    public function __construct() {
        // instantiate Database class
        $this->database = new Database();
    }

    // method to count number of posts
    public function countAllPosts() {
        $this->database->fetchAllByTablename('posts');
        try {
            return $this->database->count();
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // method to fetch data for pagination
    public function getPostsWithPagination($start, $perPage) {
        
        // join query to join two tables based on foreign key
        // LIMIT and OFFSET to determine the post per page and starting row
        $sql = "SELECT * FROM posts INNER JOIN categories ON posts.post_category_id = categories.cat_id 
                ORDER BY post_date DESC LIMIT ".$perPage. " OFFSET " .$start;
        $this->database->prepareQuery($sql);
        try {
            // fetch records as an array
            if($this->database->executeAndFetchAll()) {
                return $this->database->executeAndFetchAll();
            }
        } catch (PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
        
    }

    // method to count the number of draft and published posts 
    public function statusCount($status) {
        $sql = "SELECT * FROM posts WHERE post_status = :status";
        $this->database->prepareQuery($sql);
        // bind the status value
        $this->database->bindQuery(':status', $status);
        // fetch all the records which satisfies the query condition
        $this->database->executeAndFetchAll();
        // return the count of posts , either draft or published
        try {
            return $this->database->count();
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }


    // method to return all the records from given table name
    public function getAllCategories() {
        try {
            return $this->database->fetchAllByTablename('categories');
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    //method to get category based on id
    public function getCategoryById($id) {
        try {
            if($this->database->fetchById('categories', 'cat_id', $id)) {
                return $this->database->fetchById('categories', 'cat_id', $id);
            }
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
        
    }

    // insert post
    // takes two parameters: tablename and all the records from the field 
    public function insertPost($data) {
        try {
            if ($this->database->insert('posts', $data)) {
                return true;
            }
        } catch (PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // method to update post status
    public function updatePostStatus($status, $id) {
        $sql = "UPDATE posts SET post_status = :status WHERE post_id = :id";
        // preparing sql without passing values
        $this->database->prepareQuery($sql);
        // binding the values seperately
        $this->database->bindQuery(':status', $status);
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
     public function getSingleRecord($tableName, $field, $id) {
        try {
            // fetch single record
            if($this->database->fetchById($tableName, $field, $id)) {
                return $this->database->fetchById($tableName, $field, $id);
            }
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }


    // method to update post data in the database
    public function updatePost($data, $id) {

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
        $sql = "UPDATE posts SET " .$field. " WHERE post_id = ?";
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
   
    // delete post based on id
    public function deletePostById($id) {
        // check whether the id exists or not
        $this->database->fetchById('posts', 'post_id', $id);
        if($this->database->count() > 0) {
            try {
                // call to delete method in database
                if($this->database->deleteById('posts', 'post_id' , $id)) {
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