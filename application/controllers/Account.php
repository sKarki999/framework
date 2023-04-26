<?php 
class Account extends BaseController {

    private $accountModel;
    public function __construct() {
        Parent::__construct();
        // load and instantiate the account model
        $this->accountModel = $this->model('AccountModel');
    }


    // default method
    // directs to login method
    public function index() {
        Redirect::goTo('Account/login');
    }

    // load the login page
    public function login() {
        $this->view('account');
    }

    // get the user sudmitted data
    public function submit() {

        // check for validation errors
        $this->validation('usernameOrEmail', 'Username or Email', 'required');
        $this->validation('password', 'Password', 'required');

        if($this->noError()) {
            $data = $_POST;
            // echo '<pre>' . print_r($data, true);
            
            // verify the user credentials
            $result = $this->accountModel->verifyCredentials($data['usernameOrEmail'], $data['password']);
            
            // if success, set the session data
            // - redirect user to dashboard
            // else throw error
            if($result['status'] == 'success') {

                $sessionData = [
                    'userId'        => $result['records']['user_id'],
                    'firstname'     => $result['records']['firstname'],
                    'lastname'      => $result['records']['lastname'],
                    'username'      => $result['records']['username'],
                    'userRole'      => $result['records']['user_role']
                ];

                $this->setFlash('loggedIn', 'Logged in. Lets get Started !!');
                $this->setSession($sessionData);
                Redirect::goTo('Dashboard');
            
            } else if($result['status'] == 'passwordNotMatched') {
                $data = $_POST;
                $this->setFlash('passwordError', 'Password Doesnot Match');
                $this->view('account', $data);
            } else {
                $data = $_POST;
                $this->setFlash('usernameOrEmailNotFound', 'Username or Email not Found');
                $this->view('account', $data);
            }
        
        } else {
            // $data = $_POST;
            $this->view('account');
        }
    }

    // method to logout from the system
    public function logout() {
        $this->setFlash('loggedOut', 'Logged Out Successfully');
        $this->destroySession();
        $this->view('account');
    }

}
?>