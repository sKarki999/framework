<?php 

class Profile extends BaseController {

    private $profileModel;
    private $sessionId;
    public function __construct() {
        // calling parent constructor
        Parent::__construct();
        // load and instantiate model
        $this->profileModel = $this->model('ProfileModel');
        $this->sessionId = $this->getSession('userId');
        // check for session id
        if(!$this->sessionId) {
            Redirect::goTo('Account/Login');
        }
    }

    public function index($id) {
        $data= $this->profileModel->getAll($id);
        //echo "<pre>" . print_r($data, true);
        $this->view('users/profile', $data);
    }

    // method to update profile
    // takes id as a parameter
    public function updateProfile($id) {

        // validation
        if(!empty($_POST['password'])) {
            $this->validation('password', 'New Password', 'min_len|3');
        }

        if($this->noError()) {
            $data = $_POST;
            $data['firstname'] = (!empty($data['firstname'])) ? $data['firstname'] : '-';
            $data['lastname'] = (!empty($data['lastname'])) ? $data['lastname'] : '-';
            
            // if new password is provided, hash the password before inserting
            if(!empty($data['password'])) {
                $data['password'] = $this->hashPassword($data['password']);
            } else {
                // if password not provided, no need to update password
                unset($data['password']);
            }
            if($this->profileModel->updateUser($data, $id)) {
                $this->setFlash('updateSuccess', 'Profile updated successfully');
            }
            Redirect::goTo('Profile/' . $id);
            //echo "<pre>" . print_r($data, true);;
        } else {
            // set flash messages
            $this->setFlash('updateFailed', 'Validation errors !!');
            $this->index($id);
        }
    }

}
?>