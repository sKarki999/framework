<?php 

class Dashboard extends BaseController {

    private $sessionId;
    private $dashboardModel;
    public function __construct() {
        
        Parent::__construct();
        // load and instantiate dashboard model
        $this->dashboardModel = $this->model('dashboardModel');
        $this->sessionId = $this->getSession('userId');
        if(!$this->sessionId) {
            Redirect::goTo('Account/login');
        }
    }

    public function index() {
        // counting all the values from the database to display in the dashboard
        $data = [
            'categoriesCount'       => $this->dashboardModel->count('categories'),
            'postsCount'            => $this->dashboardModel->count('posts'),
            'postDraftCount'        => $this->dashboardModel->countField('posts', 'post_status', 'draft'),
            'postPublishedCount'    => $this->dashboardModel->countField('posts', 'post_status', 'published'),
            'pagesCount'            => $this->dashboardModel->count('pages'),
            'pageDraftCount'        => $this->dashboardModel->countField('pages', 'page_status', 'draft'),
            'pagePublishedCount'    => $this->dashboardModel->countField('pages', 'page_status', 'published'),
            'usersCount'            => $this->dashboardModel->count('tbl_users'),
            'adminCount'            => $this->dashboardModel->countField('tbl_users', 'user_role', 'Admin'),
            'editorCount'           => $this->dashboardModel->countField('tbl_users', 'user_role', 'Editor'),
            'templatesCount'        => $this->dashboardModel->count('templates')
        ];
        
        //echo "<pre>" . print_r($data, true);
        $this->view('dashboard', $data);
    }

}
?>