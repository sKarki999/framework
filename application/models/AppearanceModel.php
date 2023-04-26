<?php 

class AppearanceModel {

    private $database;
    public function __construct() {
        $this->database = new Database();
    }

    // method to gell all saved templates from database
    public function getAll() {
        try {
            return $this->database->fetchAllByTablename('templates');
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // method to get current template
    public function getCurrentTemplate() {
        try {
            return $this->database->fetchAllByTablename('template_settings');
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // method to set current template
    public function setTemplate($template) {
        // query to update the current saved template
        $sql = 'UPDATE template_settings SET current_template = :template ';
        $this->database->prepareQuery($sql);
        $this->database->bindQuery(':template', $template);
        
        try {
           return  $this->database->executeQuery();
        } catch (PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // method to get template by name
    public function getTemplateByName($templateName) {
        // query to select all details of a passed template
        $sql = "SELECT * FROM templates WHERE template_name = :templateName";
        $this->database->prepareQuery($sql);
        // bind value
        $this->database->bindQuery(':templateName', $templateName);
        $this->database->executeAndFetchAll();
        try {
            return $this->database->count();
        } catch(PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    // method to save template
    // two parameters: template name , description is optional
    public function saveTemplate($templateName, $templateDesc = null) {
        // array variable with details
        $data = [
            'template_name'  => $templateName,
            'template_description'     => $templateDesc
        ];
        try {
            // insert into database
            return $this->database->insert('templates',$data);
        } catch (PDOException $e) {
            die("<h3>Error :</h3>" .$e->getMessage()."<hr/><h3>
            Trace :</h3> <pre>". $e->getTraceAsString()."</pre>");
        }
    }

    public function deleteTemplateById($id) {
        // check whether the id exists or not
        $this->database->fetchById('templates', 'id', $id);
        if($this->database->count() > 0) {
            try {
                // call to delete method in database
                if($this->database->deleteById('templates', 'id' , $id)) {
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