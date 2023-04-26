<?php 

class Appearance extends BaseController {

    private $appearanceModel;
    private $sessionId;
    public function __construct() {
        // calling the parent constructor
        Parent::__construct();
        // load and instantiate the model
        $this->appearanceModel = $this->model('AppearanceModel');
        // get session , if not set, redirect to log in page
        $this->sessionId = $this->getSession('userId');
        if(!$this->sessionId) {
            Redirect::goTo('Account');
        }
    }

    // default method
    //redirect to gettemplate method
    public function index() {
        Redirect::goTo('Appearance/getTemplate');
    }

    // method to get all templates from database
    public function getTemplate() {
        // call model to get all templates
        $data['templates'] = $this->appearanceModel->getAll();
        // call model to get current template
        $data['currentTemplate'] = $this->appearanceModel->getCurrentTemplate();
        //echo '<pre>' . print_r($data, true);
        // send to view for display
        $this->view('template', $data);
    }

    // method to set current template
    // takes the template's name as parameter
    public function setCurrentTemplate($currentTemplate) {
        // save the current template name in the database
        $this->appearanceModel->setTemplate($currentTemplate);
        Redirect::goTo('Appearance/getTemplate');
    }

    // load the add template view page
    public function addTemplate() {
        $this->view('addTemplate');
    }

    // method to save new template
    public function saveNewTemplate() {
        
        // echo '<pre>' . print_r($_FILES['templateFile']['name'], true);
        // echo '<pre>' . print_r($_FILES['asset']['name'], true);
        $templateFile = $_FILES['templateFile']['name'];
        $explodeTemplateFile = explode('.', $templateFile);
        $asset = $_FILES['asset']['name'];
        $explodeAsset = explode('.',$asset);
        // print_r($asset);
        // print_r($templateFile);
        // print_r($asset);
        // print_r($explodeAsset);
        
        // check if template name is provided
        if(!empty($_POST['templateName'])) {
            
            $templateName = $_POST['templateName'];
            
            // check if template name already exists
            if($this->appearanceModel->getTemplateByName($templateName)) {
                $data = $_POST;
                // set error and send to view
                $data['error'] = 'Error: Template name already exists!!';
                $this->view('addTemplate',$data);
            }

            $templateDesc   = $_POST['templateDesc'];
            if ($templateName === $explodeTemplateFile[0]) {
                
                //echo "all good";
                // move fragments to views
                $templateFile_tmp_name = $_FILES['templateFile']['tmp_name'];
                move_uploaded_file($templateFile_tmp_name, '../application/views/templates/'.$templateFile);

                // load the PHP built-in ZipArchive class
                $zipTemplateFile = new ZipArchive;
                // open the uploaded zip file
                if($zipTemplateFile->open(APPROOT. '\\views\\templates\\' .$templateFile) === TRUE) {
                    // extract the zip file in given location
                    $zipTemplateFile->extractTo(APPROOT.'\views\templates');
                    $zipTemplateFile->close();
                    $this->setFlash('fileUpload', 'Template uploaded Successfully!!');
                    // remove the uploaded zip file as files are already extracted
                    unlink(APPROOT.'\\views\\templates\\'.$templateFile);
                }

                // move assets to public
                $asset_tmp_name = $_FILES['asset']['tmp_name'];
                move_uploaded_file($asset_tmp_name, '../public/assets/'.$asset);
                
                // load the PHP built-in ZipArchive class
                $zipAsset = new ZipArchive;
                // open the uploaded zip file
                if($zipAsset->open('C:\\xampp\\htdocs\\Orion\\public\\assets\\' .$asset) === TRUE) {
                    // extract the zip file in given location
                    $zipAsset->extractTo('C:\\xampp\\htdocs\\Orion\\public\\assets');
                    $zipAsset->close();
                    $this->setFlash('fileUpload', 'Template uploaded Successfully!!');
                    // remove the uploaded zip file as files are already extracted
                    unlink('c:\\xampp\\htdocs\\Orion\\public\\assets\\'.$asset);
                    // rename the directory to follow proper naming convention
                    rename('c:\\xampp\\htdocs\\Orion\\public\\assets\\'.$explodeAsset[0], 'c:\\xampp\\htdocs\\Orion\\public\\assets\\' .$templateName);
                }
                
                //save template to database
                if($this->appearanceModel->saveTemplate($templateName, $templateDesc)) {
                    // load templates view page
                    $this->getTemplate();
                }

            } else {
                $data = $_POST;
                // set error and send to view
                $data['error'] = 'Error: Given Names must Match.!';
                $this->view('addTemplate',$data);
            }

        } else {
            $data = $_POST;
            // set error and send to view
            $data['error'] = 'Error: Template name is empty.!';
            $this->view('addTemplate',$data);
        }

    }

    // method to delete template
    // takes id as a parameter
    public function deleteTemplate($id) {
        // call model to delete by id
        if($this->appearanceModel->deleteTemplateById($id)) {
            $this->setFlash('templateDel', 'Template deleted successfully');
        } 
        // redirect to templates view page
        Redirect::goTo('Appearance');

    }

}

?>