<?php 

class Site extends BaseController {

    private $siteModel;
    public function __construct() {

        Parent::__construct();
        // load and instantiate the Site model
        $this->siteModel = $this->model('SiteModel');
    }

    // default method
    // can take current page as parameter, [optional]
    public function index($currentPage = null) {
        
        // get the last saved template and fragments
        $template = $this->siteModel->getTemplate();
        $data['fragments'] = Template::getFragements($template[0]['current_template']);
        //print_r($data);
        // count number of published posts in database to initiate pagination
        $data['itemsCount'] = $this->siteModel->countItems('published');
        // print_r($data);
        $data['settings'] = $this->getSettings();
        // print_r($data);
        //counting pages , rouding off floating value to nearest whole number
        $data['pageCount'] = ceil($data['itemsCount']/$data['settings']['blogsPerPage']);
        // check if current page is available from url, if not , set default as 1 
        $data['currentPage'] = (isset($currentPage)) ? (int) $currentPage : 1;
        // logic to define starting row
        $data['startPage'] = ($data['currentPage'] - 1) * $data['settings']['blogsPerPage'];
        // calling to model to get posts with defined starting page number and perpage value 
        $data['posts'] = $this->siteModel->getitemsWithPagination($data['startPage'], $data['settings']['blogsPerPage']);
        $data['categories'] = $this->siteModel->getAll('categories');
        $data['pages']      = $this->siteModel->getPages($data['settings']['homePageShow']);
        // echo "<pre>" . print_r($data, true);
        $this->view($data['fragments']['home'], $data);
    }

    // search posts
    public function searchPost($currentPage = null, $search = null) {
        
        $template = $this->siteModel->getTemplate();
        $data['fragments'] = Template::getFragements($template[0]['current_template']);
        // get settings
        $data['settings'] = $this->getSettings();

        // get searched value via POST super global 
        $search = isset($_POST['search']) ? $_POST['search'] : $search;
        if(!$search) {
            Redirect::goTo('Site');
        }
        // count number of searched published posts in database to initiate pagination
        $data['itemsCount'] = $this->siteModel->countSearchedItems($search);
        
        //counting pages , rouding off floating value to nearest whole number
        $data['pageCount'] = ceil($data['itemsCount']/$data['settings']['blogsPerPage']);
        
        // check if current page is available from url, if not , set default as 1 
        $data['currentPage'] = (isset($currentPage)) ? (int) $currentPage : 1;

        // logic to define starting row
        $data['startPage'] = ($data['currentPage'] - 1) * $data['settings']['blogsPerPage'];

        $data['searchedPosts'] = $this->siteModel->getSearchedItemsWithPagination(
                                 $data['startPage'], $data['settings']['blogsPerPage'],$search);
        $data['search'] = $search;

        $data['categories'] = $this->siteModel->getAll('categories');
        // $data['searchedPosts'] = $this->siteModel->getSearchedPostsWithCategories($search);
        $data['pages'] = $this->siteModel->getPages($data['settings']['homePageShow']);
        //echo '<pre>' . print_r($data, true);
        $this->view($data['fragments']['search'], $data);
    }

    // single post
    public function post($postId) {
        // get templates
        $template = $this->siteModel->getTemplate();
        // get fragments of the current template
        $data['fragments'] = Template::getFragements($template[0]['current_template']);
        // get all the defined settings
        $data['settings'] = $this->getSettings();
        $data['categories'] = $this->siteModel->getAll('categories');
        $data['post'] = $this->siteModel->getSinglePostWithCategory($postId);
        $data['pages'] = $this->siteModel->getPages($data['settings']['homePageShow']);
        //echo '<pre>' . print_r($data, true);
        $this->view($data['fragments']['post'], $data);
    }

    // single post
    public function page($pageId) {
        // get current template
        $template = $this->siteModel->getTemplate();
        // get fragments
        $data['fragments'] = Template::getFragements($template[0]['current_template']);
        // get settings
        $data['settings'] = $this->getSettings();
        // get all categories
        $data['categories'] = $this->siteModel->getAll('categories');
        // get the page content based on id
        $data['page'] = $this->siteModel->getSinglePage($pageId);
        $data['pages'] = $this->siteModel->getPages($data['settings']['homePageShow']);
        //echo '<pre>' . print_r($data, true);
        $this->view($data['fragments']['page'], $data);
    }



    public function category($id) {
        // get current template
        $template = $this->siteModel->getTemplate();
        // get fragments
        $data['fragments'] = Template::getFragements($template[0]['current_template']);
        // get settings
        $data['settings'] = $this->getSettings();
        // get all categories
        $data['categories'] = $this->siteModel->getAll('categories');
        // get posts for selected categories
        $data['categorizedPosts'] = $this->siteModel->getAllPostsForCategory($id);
        $data['pages'] = $this->siteModel->getPages($data['settings']['homePageShow']);
        //echo '<pre>' . print_r($data, true);
        $this->view($data['fragments']['category'], $data);
    }


    public function contactUs() {
        // get current template
        $template = $this->siteModel->getTemplate();
        // get fragments
        $data['fragments'] = Template::getFragements($template[0]['current_template']);
        // get settings
        $data['settings'] = $this->getSettings();
        $data['categories'] = $this->siteModel->getAll('categories');
        $data['pages'] = $this->siteModel->getPages($data['settings']['homePageShow']);
        //echo '<pre>' . print_r($data, true);
        $this->view($data['fragments']['contact'], $data);
    }

    // method to save contact message
    public function saveContactMessage() {
        // validate the fields
        $this->validation('fullname', 'Full Name', 'required');
        $this->validation('email', 'Email', 'required');
        $this->validation('message', 'Message', 'required|min_len|3');

        if($this->noError()) {
            $data['message'] = $_POST;
            //echo '<pre>' . print_r($data, true);
            //call the model to insert message
            if($this->siteModel->insertMessage($data['message'])) {
                $this->setFlash('msgSuccess', 'Message sent Succesfully');
            }
            Redirect::goTo('Site/contactUs');
        } else {

            $data = $_POST;
            // get current template
            $template = $this->siteModel->getTemplate();
            // get fragments
            $data['fragments'] = Template::getFragements($template[0]['current_template']);
            // get settings
            $data['settings'] = $this->getSettings();
            $data['categories'] = $this->siteModel->getAll('categories');
            $data['pages'] = $this->siteModel->getPages($data['settings']['homePageShow']);
            $this->setFlash('msgError', 'Validation Errors!!!');
            $this->view($data['fragments']['contact'], $data);

        }
        
    }

    public function getSettings() {
        
        // get reading settings
        $reading = $this->siteModel->getAll('tbl_reading_settings');
        $data['blogsPerPage'] = $reading[0]['blog_page_show_no'];
        // avoid 0 or negative values
        if($data['blogsPerPage'] <= 0) {
            $data['blogsPerPage'] = 1;
        }
        $data['homePageShow'] = $reading[0]['home_page_show_no'];
        // avoid 0 or negative values
        if($data['homePageShow'] <=0 ) {
            $data['homePageShow'] = 1;
        }
        
        // get general settings
        $general = $this->siteModel->getAll('tbl_general_settings');
        $data['site_tagline'] = $general[0]['site_tagline'];
        $data['site_title'] = $general[0]['site_title'];
        $data['date_format'] = $general[0]['date_format'];
        $data['time_format'] = $general[0]['time_format'];
        //echo '<pre>' . print_r($data, true);
        return $data;

    }
}

?>