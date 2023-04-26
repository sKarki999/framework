<?php 

class Post extends BaseController {

    private $sessionId;
    private $postModel;

    public function __construct() {
        Parent::__construct();
        // load post model if exists.
        $this->postModel = $this->model('PostModel');
        $this->sessionId = $this->getSession('userId');
        if(!$this->sessionId) {
            Redirect::goTo('Account/login');
        }
    }

    // post panel
    // shows all the posts with pagination support
    public function index($currentPage=null, $perPage = null) {

        // count number of posts in database to initiate pagination
        $data['postsCount'] = $this->postModel->countAllPosts();
        if(isset($_POST['selectPerPage'])) {
            // getting perpage value submitted by form, if any
            $data['perPage'] = $_POST['selectPerPage'];
        } else if (!empty($perPage)) {
            // perpage passed from url, if any
            $data['perPage'] = $perPage;
        } else {
            // if all conditions fail then set default value
            $data['perPage'] = '5';
        }
        // counting pages , rouding off floating value to nearest whole number
        $data['pageCount'] = ceil($data['postsCount']/$data['perPage']);
        
        // check if current page is available from url, if not , set default as 1 
        $data['currentPage'] = (isset($currentPage)) ? (int) $currentPage : 1;
        
        // logic to define starting row
        $data['startPage'] = ($data['currentPage'] - 1) * $data['perPage'];
        
        // calling to model to get posts with defined starting page number and perpage value 
        $data['result'] = $this->postModel->getPostsWithPagination($data['startPage'], $data['perPage']);
        
        // couting the number of drafts and published posts
        $data['draftCount'] = $this->postModel->statusCount('draft');
        $data['publishedCount'] = $this->postModel->statusCount('published');
        // load view to display posts
        $this->view('posts/index', $data);
    }


    public function addPost() {
        // get all catgories and send it to post's add page
        // posts should be categorised so categories should be available to choose from
        $data['categories'] = $this->postModel->getAllCategories();
        // load view page for adding posts
        $this->view('posts/add', $data);
    }

    public function savePost() {
        
        // validation
        $this->validation('post_title', 'Post Title', 'required|min_len|3');
        $this->validation('post_content', 'Post Content', 'required');
        $this->validation('seo_title', 'SEO Title', 'required');
        $this->validation('meta_tags', 'Meta Tag', 'required');
        $this->validation('post_category_id', 'Category', 'required');

        if($this->noError()) {

            //get all posted data after form submission
            $data = $_POST;
            // capitalize the first alphabet of Post if not 
            $data['post_title'] = ucwords($data['post_title']);
            
            // if author not given, set to unknown
            $data['post_author'] = $this->getSession('username');
            
            // define current date and time 
            $data['post_date'] = date("Y-m-d H:i:s");
            
            // get image name
            $data['post_image'] = $_FILES['post_image']['name'];
            $post_image_temp = $_FILES['post_image']['tmp_name'];
            // move the image to given path
            move_uploaded_file($post_image_temp, '../public/assets/system/back/img/'.$data['post_image']);

            // call model for post insertion
            if($this->postModel->insertPost($data)) {
                // if inserted, add flash message and redirect to index page.
                $this->setFlash('postInsertSuccess', 'Post added successfully');
            }
            Redirect::goTo('Post');
        
        } else {
            // get user submitted data and get categories - reload the same view page
            $data = $_POST;
            // retain the category submitted and display if still validation fails
            $data['givenCategory'] = $this->postModel->getCategoryById($data['post_category_id']);
            // get all categories
            $data['categories'] = $this->postModel->getAllCategories();
            // set failure flash message
            $this->setFlash('postInsertFailed', 'Validation errors !');
            $this->view('posts/add', $data);
        }
    }


    // to change the post status - draft or publish
    public function postStatus($currentPage, $perPage) {
        
        if(isset($_POST['checkBoxArray'])) {
            // for each check box submission, check the post status
            // update the status as specified
            foreach($_POST['checkBoxArray'] as $postId) {
                $postStatus = $_POST['postStatus'];
                // calling to model to update status
                if($this->postModel->updatePostStatus($postStatus, $postId)) {
                    // if success, set session flash
                    $this->setFlash('statusUpdate', ' Post Status Updated!!');
                }
            }
        }
        // pass currentpage to stay in current page after status update
        // pass perpage to continue pagination with the specified perpage value
        Redirect::goTo('Post/' .$currentPage. '/' .$perPage);
    }


    // method to edit the post
    public function editPost($id, $currentPage='') {
        // get the post to be updated based on id
        // pre-populate the form with the post
        $data['posts'] = $this->postModel->getSingleRecord('posts', 'post_id', $id);
        // check whether the data exists for the given id
        // if not, redirect to Post
        if(empty($data['posts'])) {
            Redirect::goTo('Post');
        }
        // use of foreign key to get category id and display current post's category
        $categoryId = $data['posts']['post_category_id'];
        $data['currentCategory'] = $this->postModel->getSingleRecord('categories', 'cat_id', $categoryId);
        // get all categories to choose from for post update
        $data['categories'] = $this->postModel->getAllCategories();
        // if passed from url
        if(empty($currentPage)) {
            $currentPage = 1;
        }
        $data['currentPage'] = $currentPage;
        // load view and pre-populate current post's data
        //echo '<pre>' . print_r($data, true);
        $this->view('posts/edit', $data);
    }

    // method to save edited post
    public function saveEditedPost($id, $currentPage) {

        // validation
        $this->validation('post_title', 'Post Title', 'required|min_len|3');
        $this->validation('post_content', 'Post Content', 'required');
        $this->validation('seo_title', 'SEO Title', 'required');
        $this->validation('meta_tags', 'Meta Tag', 'required');
        $this->validation('post_category_id', 'Category', 'required');

        if($this->noError()) {
            
            // get posted data after form submission
            $data = $_POST;
            // Capitalize the first alphabet, if not
            $data['post_title'] = ucwords($data['post_title']);
            
            // to specify updated date
            $data['post_date'] = date("Y-m-d H:i:s");

            // get image name if no empty
            if(!empty($_FILES['post_image']['name'])) {
                $data['post_image'] = $_FILES['post_image']['name'];
                $post_image_temp = $_FILES['post_image']['tmp_name'];
                // move the image to given path
                move_uploaded_file($post_image_temp, '../public/assets/system/back/img/'.$data['post_image']);
            } else {
                // if image field is empty, dont update
                unset($data['post_image']);
            } 
            
            // call model to update post based on id
            // if successfull, set flash message and redirect the page to post panel
            if ($this->postModel->updatePost($data, $id)) {
                $this->setFlash('postEditedSuccess', 'Post Updated Successfully');
                Redirect::goTo('Post');
            }
        
        } else {
            
            $this->setFlash('postEditFailed', 'Validation errors !!');
            $this->editPost($id, $currentPage);
        }

    }

    // method to delete post based on id  
    public function deletePost($id) {
        // call the method in model to delete post based on id
        // if successfull, set the flash message.
        if($this->postModel->deletePostById($id)) {
            $this->setFlash('postDeletedSuccess', 'Post Deleted Successfully');
            Redirect::goTo('Post');
        }
    }
}
?>