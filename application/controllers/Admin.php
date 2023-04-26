<?php 

class Admin extends BaseController {

    private $sessionId;
    private $settingsModel;
    private $toolsModel;
    private $userModel;
    private $messageModel;

    public function __construct() {
        
        Parent::__construct();
        // get session id
        $this->sessionId = $this->getSession('userId');
        // load and instantiate the models
        $this->settingsModel = $this->model('SettingsModel');
        $this->toolsModel = $this->model('ToolsModel');
        $this->userModel = $this->model('userModel');
        $this->messageModel = $this->model('MessageModel');
        
        // if session id isnot set redirect to login page
        if (!$this->sessionId) {
            Redirect::goTo('Account/login');
        }
        // if user is editor, then redirect to dashboard
        if($this->getSession('userRole') === 'Editor') {
            $this->setFlash('permissionError', 'Access denied !!');
            Redirect::goTo('Dashboard');
        }
    }

    // login page
    public function index() {
        if($this->sessionId) {
            Redirect::goTo('Dashboard');
        } else {
            Redirect::goTo('Account/login');
        }
    }

    // User Management
    public function userPanel() {
        // get all users
        $data['users'] = $this->userModel->getAll();
        $data['totalUsers'] = $this->userModel->countAllUsers();
        $data['adminCount'] = $this->userModel->countUsersByRole('Admin');
        $data['editorCount'] = $this->userModel->countUsersByRole('Editor');
        //echo '<pre>' . print_r($data, true);
        // load view to display all users
        $this->view('users/index', $data);
    }

    // load the add user view page
    public function addUser() {
        $this->view('users/add');
    }

    // method to save the user
    public function saveUser() {
        // check if username or email already exists
        $usernameExists = $this->userModel->getUserByField('username', $_POST['username']); 
        $emailExists = $this->userModel->getUserByField('email', $_POST['email']); 
        
        // check whether the username or email already exists
        // if exists throw error information
        if ($usernameExists == 1) {
            $data = $_POST;
            //echo '<pre>' . print_r($data, true);
            $this->setFlash('usernameExists', 'Username exists already. Choose another !!');
            $this->view('users/add', $data);
        
        } else if ($emailExists == 1) {
            $data = $_POST;
            $this->setFlash('emailExists', 'Email exists already!!');
            $this->view('users/add', $data);
        
        } else {
            // validation
            $this->validation('username', 'Username', 'required');
            $this->validation('email', 'Email', 'required');
            $this->validation('password', 'Password', 'required|min_len|3');
            $this->validation('user_role', 'User Role', 'required');

            if($this->noError()) {
                $data = $_POST;
                $data['firstname'] = (!empty($data['firstname'])) ? $data['firstname'] : '-';
                $data['lastname'] = (!empty($data['lastname'])) ? $data['lastname'] : '-';
                // hash the user given password
                // php built-in method
                $data['password'] = $this->hashPassword($data['password']);
                
                if($this->userModel->insertUser($data)) {
                    $this->setFlash('userInsertSuccess', 'User added successfully');
                }
                Redirect::goTo('Admin/userPanel');
                //echo "<pre>" . print_r($data, true);
            } else {
                $data = $_POST;
                //echo '<pre>' . print_r($data, true);
                $this->view('users/add', $data);
            }
        }
    }

    // method to edit user
    public function editUser($id) {
        // get current user
        $data['currentUser'] = $this->userModel->getUserById($id);
        // deny deleting one super admin
        if($data['currentUser']['username'] === 'sagun') {
            $this->setFlash('editError', 'Cannot edit Super admin!!');
            Redirect::goTo('Dashboard');
        }
        //echo "<pre>" . print_r($data, true);
        $this->view('users/edit', $data);
    }

    // to save edited user
    public function saveEditedUser($id) {

        // validation
        if(!empty($_POST['password'])) {
            $this->validation('password', 'New Password', 'min_len|3');
        }
        if($this->noError()) {
            $data = $_POST;
            //echo '<pre>' . print_r($data, true);
            $data['firstname'] = (!empty($data['firstname'])) ? $data['firstname'] : '-';
            $data['lastname'] = (!empty($data['lastname'])) ? $data['lastname'] : '-';
            // if password is given, update the password
            // if not, remove password field from received data before updating
            if(!empty($data['password'])) {
                $data['password'] = $this->hashPassword($data['password']);
            } else {
                unset($data['password']);
            }
            if($this->userModel->updateUser($data, $id)) {
                $this->setFlash('userUpdateSuccess', 'Profile updated successfully');
            }
            Redirect::goTo('Admin/userPanel');
            //echo "<pre>" . print_r($data, true);;
        } else {
            // set flash message
            $this->setFlash('userEditFailed', 'Validation errors !!');
            $this->editUser($id);
        }
    }


    // method to delete user based on id  
    public function deleteUser($id) {
        // check for user
        $data['currentUser'] = $this->userModel->getUserById($id);
        //echo "<pre>" . print_r($data, true);
        if($data['currentUser']['username'] === 'sagun') {
            $this->setFlash('deleteError', 'Cannot delete Super admin!!');
            Redirect::goTo('Dashboard');
        } else {
            // call the method in model to delete user based on id
            // if success, set the flash message.
            $this->userModel->deleteUserById($id);
            $this->setFlash('userDeleteSuccess', 'User Deleted Successfully');
            Redirect::goTo('Admin/userPanel');
        }
    }


    // Settings Module
    // get the last general settings from database and display in the form
    public function generalSettings() {
        $data['general'] = $this->settingsModel->SelectAll('tbl_general_settings');
        //echo "<pre>" . print_r($data, true);
        $this->view('admin/settings/general', $data);
    }

    // get the new general site settings values 
    // update the values based on id
    public function saveGeneralSettings($id) {
        $data = $_POST;
        if($this->settingsModel->updateSettings('tbl_general_settings', $data, $id)) {
            $this->setFlash('generalSuccess', 'Settings updated Successfully');
        }
        Redirect::goTo('Admin/generalSettings');
    }

    // get the last reading settings from database and display in the form
    public function readingSettings() {
        
        $data['reading'] = $this->settingsModel->selectAll('tbl_reading_settings');
        //echo "<pre>" . print_r($data, true);
        $this->view('admin/settings/reading', $data);
    }
    
    // get the new reading settings
    // update the values base on id
    public function saveReadingSettings($id) {

        $data = $_POST;
        //echo "<pre>" . print_r($data, true);
        if($this->settingsModel->updateSettings('tbl_reading_settings', $data, $id)) {
            $this->setFlash('readingSuccess', 'Settings updated Successfully');
        }
        Redirect::goTo('Admin/readingSettings');
    }


    
    // get the last Writing Settings from database and display in the form
    public function writingSettings() {
        $data['writing'] = $this->settingsModel->selectAll('tbl_writing_settings');
        //echo "<pre>" . print_r($data, true);
        $this->view('admin/settings/writing', $data);
    }

    // get the new writing settings
    // update the values based on id
    public function saveWritingSettings($id) {

        $data = $_POST;
        //echo "<pre>" . print_r($data, true);
        if($this->settingsModel->updateSettings('tbl_writing_settings', $data, $id)) {
            $this->setFlash('writingSuccess', 'Settings updated Successfully');
        }
        Redirect::goTo('Admin/writingSettings');
    }


    // get the last Media Settings from database and display in the form
    public function mediaSettings() {

        $data['media'] = $this->settingsModel->selectAll('tbl_media_settings');
        //echo '<pre>' . print_r($data, true);
        $this->view('admin/settings/media', $data);
    }

    // get the new media settings
    // update based on id
    public function saveMediaSettings($id) {
        
        $data = $_POST;
        //echo "<pre>" . print_r($data, true);
        if($this->settingsModel->updateSettings('tbl_media_settings', $data, $id)) {
            $this->setFlash('mediaSuccess', 'Settings updated Successfully');
        }
        Redirect::goTo('Admin/mediaSettings');
    }


    // Tools - exporting the data to csv files
    public function toolsExportView() {

        $this->view('admin/tools/export');
    }

    public function exportProcess() {

        // check if field is set
        if(isset($_POST['exportTag'])) {
            $exportTag = $_POST['exportTag'];
        } 
       
        switch($exportTag) {

            case "category":
                // filename
                $filename = 'categories_' . date('Ymd') . '.csv';
                
                // header definitions
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename = $filename");
                header("Content-Type: application/csv");

                //file creation
                $file = fopen('php://output', 'w');

                // table fields 
                $field = array(
                    "Category Id", "Category Title"
                );
                ob_end_clean();
                fputcsv($file, $field);
                
                // get all categories
                $categories = $this->toolsModel->getAll('categories');
                foreach($categories as $category) {
                    // putting each category in csv file
                    fputcsv($file, $category);
                }
                // close file after completion
                fclose($file);
                exit;
                break;

            
            case "post":
                // file name
                $filename = 'posts_' . date('Ymd') . '.csv';
                // header definitions
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename = $filename");
                header("Content-Type: application/csv");
                //file open
                $file = fopen('php://output', 'w');
                // table fields
                $fields = array(
                    "Post Id", "Post Title", "Post Image", "Post Author", "Post Content", "SEO Title", "Meta Description",
                    "Meta Tags", "Post Status", "Post Date", "Post's Category Id"
                );
                ob_end_clean();
                fputcsv($file, $fields);
                // get all posts
                $posts = $this->toolsModel->getAll('posts');
                // putting each post in csv file
                foreach($posts as $post) {
                    fputcsv($file, $post);
                }
                // close file after completion
                fclose($file);
                break;

            
            case "page":
                // filename
                $filename = 'pages_' . date('Ymd') . '.csv';
                
                // header definitions
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename = $filename");
                header("Content-Type: application/csv");

                //file creation
                $file = fopen('php://output', 'w');

                // table fields 
                $fields = array(
                    "Page Id", "Page Title", "Page Image", "Page Author", "Page Content",
                    "Page Status", "Page Date"
                );
                // discard the contents of topmost output buffer
                ob_end_clean();
                fputcsv($file, $fields);
                
                // get all categories
                $pages = $this->toolsModel->getAll('pages');
                foreach($pages as $page) {
                    // putting each category in csv file
                    fputcsv($file, $page);
                }
                // close file after completion
                fclose($file);
                break;
            
            default:
                // can define for other tables
                break;

        }
    }

    // Tools - importing data from csv files
    public function toolsImportView() {

        $this->view('admin/tools/import');
    }

    public function importProcess() {

        if (isset($_POST['import'])) {
            
            $tableName = $_POST['tableName'];
            $filename = $_FILES['csvFilename']['tmp_name'];
            switch ($tableName) {

                case 'categories':

                    if ($_FILES['csvFilename']['size'] > 0) {
                        // counter
                        $row = 0;
                        // rows to be skipped
                        $skipRow = array('1');
                        // open file in read mode
                        $file = fopen($filename, "r");
                        // loop to get all the records from the file
                        while (($getData = fgetcsv($file, 10000, ",")) !== false) {
                            $row++;
                            
                            // skip the row
                            if (in_array($row, $skipRow)) {
                                continue;
                            }
                            
                            // get data from file and store in array
                            $data= [
                                'cat_title' => $getData[1]
                            ]; 
                            
                            // call method in model to insert into database
                            if($this->toolsModel->insertData('categories', $data)) {
                                $this->setFlash('imported', 'Files Imported Successfully');
                                Redirect::goTo('admin/toolsImportView');
                            }
                        }
                    }
                    exit;
                    break;

                case 'posts':
                    if ($_FILES['csvFilename']['size'] > 0) {
                        //counter
                        $row = 0;
                        // rows to be skipped
                        $skipRow = array('1');
                        // open file in read mode
                        $file = fopen($filename, "r");
                        // loop to get all the records from file
                        while (($getData = fgetcsv($file, 10000, ",")) !== false) {
                            $row++;

                            // skip the row
                            if (in_array($row, $skipRow)) {
                                continue;
                            }
                            // store each record in an array and call model for each set of data
                            // - to insert in database
                            $data = [
                                'post_title'        => $getData[1],
                                'post_image'        => $getData[2],
                                'post_author'       => $getData[3],
                                'post_content'      => $getData[4],
                                'seo_title'         => $getData[5],
                                'meta_description'  => $getData[6],
                                'meta_tags'         => $getData[7],
                                'post_status'       => $getData[8],
                                'post_date'         => date("Y-m-d H:i:s"),
                                'post_category_id'  => $getData[10]
                            ];

                            // call model to insert data
                            if($this->toolsModel->insertData('posts', $data)) {
                                $this->setFlash('imported', 'Files Imported Successfully');
                                Redirect::goTo('admin/toolsImportView');
                            }
                        }
                    }
                exit;
                break;
                case 'pages':
                    if ($_FILES['csvFilename']['size'] > 0) {
                        // counter
                        $row = 0;
                        // rows to be skipped
                        $skipRow = array('1');
                        // open file in read mode
                        $file = fopen($filename, "r");
                        // get all records from the file
                        while (($getData = fgetcsv($file, 10000, ",")) !== false) {
                            $row++;

                            // skip row
                            if (in_array($row, $skipRow)) {
                                continue;
                            }

                            //store the data in an array
                            $data = [
                                'page_title'    => $getData[1],
                                'page_image'    => $getData[2],
                                'page_author'   => $getData[3],
                                'page_content'  => $getData[4],
                                'page_status'   => $getData[5],
                                'page_date'     => date("Y-m-d H:i:s") 
                            ];

                            // call model to insert into database
                            if($this->toolsModel->insertData('pages', $data)) {
                                $this->setFlash('imported', 'Files Imported Successfully');
                                Redirect::goTo('admin/toolsImportView');
                            }
                        }
                    }
                exit;
                break;

                default:
                Redirect::goTo('admin/toolsImportView');
                break;

            }
        }

        Redirect::goTo('admin/toolsImportView');
    
    }
    
    // method to get all the messages and send to the message view
    public function messagePanel() {
        $data['result'] = $this->messageModel->getAllMessages();
        // print_r($data);
        $this->view('admin/message/messagePanel', $data);
    }

    // method to read detail message
    // takes id as parameter
    // based on id, fetches the message
    public function readMore($id) {

        $data['readMore'] = $this->messageModel->getMessageById($id);
        $this->view('admin/message/readMore', $data);
    }

    // method to delete message
    // call the method in model to delete message based on id
    // if successfull, set the flash message.
    public function deleteMessage($id) {
        if($this->messageModel->deleteMessageById($id)) {
            $this->setFlash('msgDeletedSuccess', 'Message Deleted Successfully');
            Redirect::goTo('Admin/messagePanel');
        }
    }

}

?>