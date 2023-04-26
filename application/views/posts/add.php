<?php $this->view("fragments/header"); ?>
<?php $this->view("fragments/nav"); ?>
<?php $this->view("fragments/sidebar"); ?>        
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        
                        <div class="card mt-3">
                            <div class="card-header" style="background:#9BB7D4;">
                                <h1 class="d-inline-block card-title">Post Panel&nbsp;</h1>
                            </div>
                        </div>

                        <?php echo $this->getFlash('postInsertFailed', 'alert-danger');?>

                        <div class="card my-4">
                            <div class="card-header">
                                <h4>Add New Post&nbsp;&nbsp;
                                <a href="<?php echo baseUrl;?>/Post" class="btn" style="background:#9BB7D4;">Back&nbsp;<i class="fas fa-backward"></i></a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form method="post" action="<?php echo baseUrl;?>/Post/savePost" enctype="multipart/form-data">
                                    
                                    <div class="form-group mb-4">
                                        <label for=""><h5 class="required">Post Title</h5></label>
                                        <input type="text" class="form-control" name="post_title"
                                        value="<?php echo (isset($data['post_title'])) ? $data['post_title'] : '' ;
                                        ?>" />
                                        <div class="text-danger h6 mt-1">
                                            <?php echo (!empty($this->error['post_title'])) ? $this->error['post_title'] : '';
                                            ?>
                                        </div>
                                    </div>
                                    
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="width:120px;"><strong>Post Image</strong></span>
                                        </div>
                                        <div class="custom-file col-sm-12">
                                        <input type="file" class="custom-file-input" name="post_image" id="">
                                        <label class="custom-file-label text-muted" for="">Choose image</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="required">Post Content</h5></label>
                                        <textarea name="post_content" id="postContent">
                                        <?php echo (isset($data['post_content'])) ? $data['post_content'] : '';?>
                                        </textarea>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo (!empty($this->error['post_content'])) ? $this->error['post_content'] : '';
                                            ?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for=""><h5 class="required">SEO Title</h5></label>
                                        <input type="text" class="form-control" name="seo_title" 
                                        value="<?php echo (isset($data['seo_title'])) ? $data['seo_title'] : '';
                                        ?>"/>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo (!empty($this->error['seo_title'])) ? $this->error['seo_title'] : '';
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5>Meta Description</h5></label>
                                        <input type="text" class="form-control" name="meta_description" 
                                        value="<?php echo (isset($data['meta_description'])) ? $data['meta_description'] : '';
                                        ?>"/>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo (!empty($this->error['meta_description'])) ? $this->error['meta_description'] : '';
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="required">Meta Tags</h5></label>
                                        <input type="text" class="form-control" name="meta_tags" 
                                        value="<?php echo (isset($data['meta_tags'])) ? $data['meta_tags'] : '';
                                        ?>"/>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo (!empty($this->error['meta_tags'])) ? $this->error['meta_tags'] : '';
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="required">Category</h5></label>
                                        <select class="form-control" name="post_category_id">
                                            <option value="<?php echo (isset($data['givenCategory']['cat_id']) ? $data['givenCategory']['cat_id'] : 0); ?>">
                                                <?php echo (isset($data['givenCategory']['cat_title']) ? $data['givenCategory']['cat_title'] : 'Choose a Category'); ?>
                                                </option>
                                            <?php 
                                                foreach ($data['categories'] as $category) {
                                                    ?>
                                            <option value="<?php echo $category['cat_id'];?>"><?php echo $category['cat_title'];?></option>
                                            <?php
                                                } ?>                                                
                                        </select>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo (!empty($this->error['post_category_id'])) ? $this->error['post_category_id'] : '';
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn" style="background:#9BB7D4;" value="Publish" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
<?php $this->view("fragments/footer"); ?>            
               