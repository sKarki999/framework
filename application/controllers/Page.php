<?php 

class Page extends BaseController {

    private $sessionId;
    private $pageModel;

    public function __construct() {
        Parent::__construct();
        //load page model if exists
        $this->pageModel = $this->model('PageModel');
        $this->sessionId = $this->getSession('userId');
        if(!$this->sessionId) {
            Redirect::goTo('Account/login');
        }
    }

    // page panel - show pages with pagination
    public function index($currentPage=null, $perPage = null) {
        // count number of pages
        $data['pagesCount'] = $this->pageModel->countAllPages();
        if(isset($_POST['selectPerPage'])) {
            // getting perpage value submitted by form, if any
            $data['perPage'] = $_POST['selectPerPage'];
        } else if(!empty($perPage)) {
            // perpage passed from url, if any
            $data['perPage'] = $perPage;
        } else {
            // if all conditions fail, then set default value
            $data['perPage'] = '5';
        }
        // page count - round off floating value to nearest whole number
        $data['pageCount'] = ceil($data['pagesCount']/$data['perPage']);
        // check if current page i available, if not, set default as 1
        $data['currentPage'] = (isset($currentPage)) ? $currentPage : 1;
        // logic to define starting row
        $data['start'] = ($data['currentPage'] - 1) * $data['perPage'];
        // calling model to get pages with pagination support
        // passing two parameters, starting row and per page value
        $data['result'] = $this->pageModel->getPagesWithPagination($data['start'], $data['perPage']);
        // counting the drafts and published pages
        $data['draftCount'] = $this->pageModel->statusCount('draft');
        $data['publishedCount'] = $this->pageModel->statusCount('published');
        // load view to display pages
        $this->view('pages/index', $data);

    }

    // method to add pages
    public function addPage() {

        // load view page for adding pages
        $this->view('pages/add');
    }

    // method to save page
    public function savePage() {
        
        // validation
        $this->validation('page_title', 'Page Title', 'required');

        if($this->noError()) {
            // get all posted data after form submission
            $data = $_POST;
            // capitalize page title , if not
            $data['page_title'] = ucwords($data['page_title']);
            // if author not given, set to unknown
            $data['page_author'] = $this->getSession('username');
            // current date 
            $data['page_date'] = date("Y-m-d H:i:s");

            // get image name
            $data['page_image'] = $_FILES['page_image']['name'];
            $page_image_temp = $_FILES['page_image']['tmp_name'];
            // move the image to given path
            move_uploaded_file($page_image_temp, '../public/assets/system/back/img/'.$data['page_image']);

            //echo"<pre>" . print_r($data,true);
        
            // call model to insert
            // if success, set flash message and redirect page
            if($this->pageModel->insertPage($data)) {
                $this->setFlash('pageInsertSuccess', 'Page added successfully');
            }
            Redirect::goTo('Page');
        } else {
            // get user submitted data and get categories - reload the same view page
            $data = $_POST;
            $this->setFlash('pageInsertFailed', 'Validation Errors!');
            $this->view('pages/add', $data);
         }
    }

    // method to update page status - draft or publish
    public function pageStatus($currentPage, $perPage) {
        
        if(isset($_POST['checkBoxArray'])) {
            // for each check box after submission, check the page status
            // update the status as specified
            foreach($_POST['checkBoxArray'] as $pageId) {
                $pageStatus = $_POST['pageStatus'];
                // calling model to update status
                // if success, set flash message and redirect
                if($this->pageModel->updatePageStatus($pageStatus, $pageId)) {
                    $this->setFlash('pageStatusSuccess', ' Page Status Updated!!');
                }
            }
        }
        Redirect::goTo('Page/' . $currentPage. '/'. $perPage);
    }

    // method to edit page
    public function editPage($id, $currentPage = '') { 
        // get the page to be updated based on id
        // pre-populate the form with the page data based on id
        $data['pages'] = $this->pageModel->getSingleRecordById($id);
        // if data is empty for given id, redirect to index
        if(empty($data['pages'])) {
            Redirect::goTo('Page');
        }
        
        // if passed from url
        if(empty($currentPage)) {
            $currentPage = 1;
        }
        $data['currentPage'] = $currentPage;
        // load view and pre-populate current page's data
        $this->view('pages/edit', $data);
    }

    // method to save updated page
    public function saveEditedPage($id, $currentPage) {

        // validation
        $this->validation('page_title', 'Page Title', 'required|min_len|3');

        if($this->noError()) {
            // get posted data after form submission
            $data = $_POST;
            // capitalize the first alphabet, if not
            $data['page_title'] = ucwords($data['page_title']);
            // get current date and time
            $data['page_date'] = date("Y-m-d H:i:s");

            // get image name if no empty
            if(!empty($_FILES['page_image']['name'])) {
                $data['page_image'] = $_FILES['page_image']['name'];
                $page_image_temp = $_FILES['page_image']['tmp_name'];
                // move the image to given path
                move_uploaded_file($page_image_temp, '../public/assets/system/back/img/'.$data['page_image']);
            } else {
                // if image field is empty, dont update
                unset($data['page_image']);
            }

            //print_r($data);

            // call model for update
            // set flash message if updated
            if ($this->pageModel->updatePage($data, $id)) {
                $this->setFlash('pageEditSuccess', 'Page Updated Successfully');
            }
            Redirect::goTo('Page');
        
        } else {
            $this->setFlash('pageEditFailed', 'Validation errors !!');
            $this->editPage($id, $currentPage);
         }
    }

    // method to delete page based on id
    public function deletePage($id) {
        // call model to delete
        // set flash message, if deleted
        if($this->pageModel->deletePageById($id)) {
            $this->setFlash('pageDeleteSuccess', 'Page Deleted Successfully');
            Redirect::goTo('Page');
        }
    }
}

?>