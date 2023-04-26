<?php

class Database {

    private $dsn = DSN;
	private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $connection;
    private $query;

    public function __construct() {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT    =>true
            
        ];
        try {
            // connecting to database
            $this->connection = new PDO($this->dsn, $this->dbUser, $this->dbPass, $options);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
    
    // prepare the query
    public function prepareQuery($sql) {
        $this->query = $this->connection->prepare($sql);
    }

    // binding values
    public function bindQuery($parameter, $value, $type=null) {

        // to find parameter type if not specified
        switch(is_null($type)) {

            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
                break;
        }
        // bind the values
        $this->query->bindValue($parameter, $value, $type);
    }

    // Execute Queries
    public function executeQuery($data = null) {
        // check for data
        if (is_null($data)) {
            // execution without passing data
            return $this->query->execute();
        } else {
            //execution passing data as array
            return $this->query->execute($data);
        }    
    }

    // Insert Method
    public function insert($tableName, $record) {
        // get values of array
        $values = array_values($record);
        // converts the array keys to string , separated by comma(,)
        $keys = implode(",", array_keys($record));
        // count the records and repeat same amount of '?' as placeholder 
        $placeholder = str_repeat('?,', count($record));
        $placeholder = rtrim($placeholder, " ,");
        // writing queries for insert
        $sql = "INSERT INTO " .$tableName. " (" .$keys. ") VALUES (" .$placeholder. ")";

        // preparing query without passing values
        $this->query = $this->connection->prepare($sql);
        // executing query passing values as an array 
        return $this->query->execute($values);
    }
    
    // delete record based on id
    public function deleteById($tableName, $field, $id) {
        // query to delete based on id
        $sql = "DELETE FROM " .$tableName. " WHERE " .$field. " = :id";
        // preparing query
        $this->query = $this->connection->prepare($sql);
        // binding id
        $this->query->bindValue(':id', $id, PDO::PARAM_INT);
        return $this->query->execute();
    }


    // Execute query and fetch all as an array
    public function executeAndFetchAll() {
        // just execute and return data as array
        $this->query->execute();
        return $this->query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Prepare, execute and fetch all from the given tablename
    public function fetchAllByTablename($tableName) {
        // sql to select all
        $sql = "SELECT * FROM " .$tableName;
        // preparing query
        $this->query = $this->connection->prepare($sql);
        // execute and fetch all as an array
        $this->query->execute();
        return $this->query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch array based on id from the given tablename
    public function fetchById($tableName, $field, $id) {
        // query to select on given condition
        $sql = "SELECT * FROM " .$tableName. " WHERE " .$field. " =:id";
        $this->query = $this->connection->prepare($sql);
        //bind value 
        $this->query->bindValue(':id', $id, PDO::PARAM_INT);
        // execute and fetch data as array
        $this->query->execute();
        return $this->query->fetch(PDO::FETCH_ASSOC);
    }

    // Fetch array based on field from the given tablename
    public function fetchByField($tableName, $field, $value) {
        // query to select on given condition
        $sql = "SELECT * FROM " .$tableName. " WHERE " .$field. " =:value";
        $this->query = $this->connection->prepare($sql);
        //bind value 
        $this->query->bindValue(':value', $value, PDO::PARAM_STR);
        // execute and fetch data as array
        $this->query->execute();
        return $this->query->fetch(PDO::FETCH_ASSOC);
    }



    // count the number of rows
    public function count() {
        return $this->query->rowCount();
    }
}
?>