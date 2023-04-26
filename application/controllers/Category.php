<?php 

class Category extends BaseController {

    private $sessionId;
    private $categoryModel;
    public function __construct() {
        Parent::__construct();
        // load category model if exists
        $this->categoryModel = $this->model("CategoryModel");
        $this->sessionId = $this->getSession('userId');
        if(!$this->sessionId) {
            Redirect::goTo('Account');
        }
    }

    // category panel page
    // shows categories with pagination suppot
    public function index($currentPage = null, $perPage = null) {
        
        // count number of categories in database to initiate pagination
        $data['categoriesCount'] = $this->categoryModel->countCategory();
        if(isset($_POST['selectPerPage'])) {
            // getting per page value submitted in form
            $data['perPage'] = $_POST['selectPerPage'];
        } else if (!empty($perPage)) {
            // get per page if passed from URL
            $data['perPage'] = $perPage;
        } else {
            // default value, if all conditions fails
            $data['perPage'] = '5';
        }
        // counting pages , rouding off floating value to near whole number
        $data['pageCount'] = ceil($data['categoriesCount']/$data['perPage']);
        // check if current page is available from url, if not , set default as 1
        $data['currentPage'] = (isset($currentPage)) ? $currentPage : '1';
        // logic to define starting row
        $data['startPage'] = ($data['currentPage'] - 1) * $data['perPage'];
        // calling model to get categories with defined starting page number and perpage value  
        $data['result'] = $this->categoryModel->getCategoriesWithPagination($data['startPage'], $data['perPage']);
        // load view to display categories
        $this->view('category/index', $data);
    }


    public function addCategory() {
        //echo "<pre>" . print_r($_SERVER, true);
        // // load view page for adding categories
         $this->view('category/add');
    }

    public function saveCategory() {
        // get the user posted data
        $data['cat_title'] = $_POST['cat_title'];
        // check if category exists already
        $categoryExists = $this->categoryModel->getCategoryByField($data['cat_title']);
        // if exists, set flash for error message
        if($categoryExists == 1) {
            $this->setFlash('categoryExists', 'Category exists already. Choose another!!');
            $this->view('category/add', $data);
        } else {
            // validation
            $this->validation('cat_title', 'Category Title', 'required|min_len|2');
            //check for errors
            if($this->noError()) {
                //capitalize the first alphabet, if not
                $data['cat_title'] = ucwords($_POST['cat_title']);
                // call model to insert category into database
                if ($this->categoryModel->insertCategory($data)) {
                    // if successfull, add session flash message
                    $this->setFlash('insertSuccess', 'Category added successfully');
                }
                Redirect::goTo('Category');
            } else {
                // retain the user submitted value
                $data['cat_title'] = $_POST['cat_title'];
                // set flash for failed message
                $this->setFlash('insertFailed', 'Validation error !!');
                $this->view('category/add', $data);
            }
        }
    }


    public function editCategory($id, $currentPage = '') {
        // get the categories to be updated based on id
        // pre-populate the form based on id 
        $data['category'] = $this->categoryModel->getCategoryById($id);
        // if passed from url
        if(empty($currentPage)) {
            $currentPage = 1;
        }
        $data['currentPage'] = $currentPage;
        // load view
        $this->view('category/edit', $data);
    }

    public function saveEditedCategory($id, $currentPage) {

        // validation
        $this->validation('cat_title', 'Category Title', 'required,min_len,3');
        if ($this->noError()) {
            // get submitted data to be updated
            $categoryTitle = ucwords($_POST['cat_title']);
            // call model to update category based on id
            if($this->categoryModel->updateCategory($categoryTitle, $id)) {
            // if successfull, add flash message
            $this->setFlash('updateSuccess', 'Category edited successfully');
            }
            Redirect::goTo('Category');
        } else {
            // retain the user submitted value
            // set flash for failed message
            $this->setFlash('updateFailed', 'Validation error !!');
            // $this->view('admin/category/edit', $data);
            $this->editCategory($id, $currentPage);
        }        
    }

    // method to delete category based on id
    public function deleteCategory($id) {
        // call the method in model to delete category based on id
        // if successfull, set the flash message.
        if ($this->categoryModel->deleteCategoryById($id)) {
            $this->setFlash('deleteSuccess', 'Category deleted successfully');
            Redirect::goTo('Category');
        }
    }
}
?>