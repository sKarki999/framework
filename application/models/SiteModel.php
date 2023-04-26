<?php 

class SiteModel {

    private $database;

    public function __construct() {

        $this->database = new Database();
    }

    // method to get all details from given tablename
    public function getAll($tableName) {
        return $this->database->fetchAllByTablename($tableName);
    }

    // method to get all pages based on passed limit
    public function getPages($limit) {
        $sql = "SELECT * FROM pages WHERE page_status = :status LIMIT " . $limit;
        $this->database->prepareQuery($sql);
        $this->database->bindQuery(':status', 'published');
        try {
            return $this->database->executeAndfetchAll();
        } catch (PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
        
    }

    // method to fetch data for pagination
    public function getItemsWithPagination($start, $perPage) {
        
        // join query to join two tables based on foreign key
        // LIMIT and OFFSET to determine the post per page and starting row
        $sql = "SELECT * FROM posts INNER JOIN categories ON posts.post_category_id = categories.cat_id 
                WHERE post_status = :status ORDER BY post_date DESC LIMIT ".$perPage. " OFFSET " .$start;
        // preparing query
        $this->database->prepareQuery($sql);
        // binding values
        $this->database->bindQuery(':status', 'published');
        try {
                return $this->database->executeAndFetchAll();
        } catch (PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
        
    }

    // method to get all posts for given category
    public function getAllPostsForCategory($id) {
        // sql to get all posts for given category based on id
        $sql = "SELECT * FROM posts INNER JOIN categories ON posts.post_category_id = categories.cat_id 
                WHERE post_category_id = :id AND post_status = :status ORDER BY post_date DESC";
        // preparing query
        $this->database->prepareQuery($sql);
        // bind values separately
        $this->database->bindQuery(':id', $id);
        $this->database->bindQuery(':status', 'published');
        try {
            // execute and fetch data
            return $this->database->executeAndfetchAll();
        } catch (PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
        
    }

    // method to get single post with category based on id
    public function getSinglePostWithCategory($id) {

        $sql = "SELECT * FROM posts INNER JOIN categories ON posts.post_category_id = categories.cat_id 
                WHERE post_id = :id ORDER BY post_date DESC";
        $this->database->prepareQuery($sql);
        $this->database->bindQuery(':id',$id);
        try {
            return $this->database->executeAndfetchAll();
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }


    // get single page
    public function getSinglePage($id) {
        $sql = "SELECT * FROM pages WHERE page_id = :id";
        $this->database->prepareQuery($sql);
        $this->database->bindQuery(':id',$id);
        try {
            return $this->database->executeAndfetchAll();
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // method to get current template
    public function getTemplate() {
        $sql = "SELECT current_template FROM template_settings";
        $this->database->prepareQuery($sql);
        try {
            return $this->database->executeAndfetchAll();
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // method to count number of items from given table
    public function countItems($status) {
        // query to select all posts based on status
        $sql = "SELECT * FROM posts WHERE post_status = :status";
        $this->database->prepareQuery($sql);
        $this->database->bindQuery(':status', $status);
        $this->database->executeAndFetchAll();
        try {
            return $this->database->count();
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // method to count number of items from given table
    public function countSearchedItems($search) {
        // query to countsearched items 
        $sql = "SELECT * FROM posts WHERE post_status = :status 
               AND (meta_tags LIKE :search OR post_title LIKE :search) ORDER BY post_date DESC";
        $this->database->prepareQuery($sql);
        // bind values
        $this->database->bindQuery(':status', 'published');
        $this->database->bindQuery(':search', '%'.$search.'%');
        // execute, fetch and return count
        $this->database->executeAndfetchAll();
        try {
            return $this->database->count();
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // method to fetch data for pagination
    public function getSearchedItemsWithPagination($start, $perPage, $search) {
        
        // join query to join two tables based on foreign key
        // LIMIT and OFFSET to determine the searched posts per page and starting row
        $sql = "SELECT * FROM posts INNER JOIN categories ON posts.post_category_id = categories.cat_id 
               WHERE post_status = :status AND (meta_tags LIKE :search OR post_title LIKE :search) 
               ORDER BY post_date DESC LIMIT ".$perPage. " OFFSET " .$start;
        // preparing query
        $this->database->prepareQuery($sql);
        // binding values
        $this->database->bindQuery(':status', 'published');
        $this->database->bindQuery(':search', '%'.$search.'%');
        try {
            // execute and fetch data
            return $this->database->executeAndFetchAll();
        } catch (PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
        
    }

    // method to insert message into database
    public function insertMessage($data) {
        try {
            if($this->database->insert('contact',$data)) {
                return true;
            }
        } catch (PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

}
?>