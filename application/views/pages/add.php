<?php $this->view("fragments/header"); ?>
<?php $this->view("fragments/nav"); ?>
<?php $this->view("fragments/sidebar"); ?>        
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="card mt-3">
                            <div class="card-header" style="background:khaki;">
                                <h1 class="d-inline-block card-title">Page Panel&nbsp;</h1>
                            </div>
                        </div>    
                        <?php echo $this->getFlash('pageInsertFailed', 'alert-danger') ?>
                        <div class="card my-4">
                            <div class="card-header">
                                <h4>Add New Page&nbsp;&nbsp;
                                <a href="<?php echo baseUrl;?>/Page" class="btn" style="background: khaki;">Back&nbsp;<i class="fas fa-backward"></i></i></a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form method="post" action="<?php echo baseUrl;?>/Page/savePage" enctype="multipart/form-data">
                                    <div class="form-group">
                                    <label for=""><h5 class="required">Page Title</h5></label>
                                        <input type="text" class="form-control" name="page_title" 
                                        value="<?php echo (isset($data['page_title'])) ? $data['page_title'] : '' ;
                                        ?>" />
                                        <div class="text-danger h6 mt-1">
                                            <?php echo (!empty($this->error['page_title'])) ? $this->error['page_title'] : ''; 
                                            ?>
                                        </div>
                                    </div>

                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="width:120px;"><strong>Page Image</strong></span>
                                        </div>
                                        <div class="custom-file col-sm-12">
                                        <input type="file" class="custom-file-input" name="page_image" id="">
                                        <label class="custom-file-label text-muted" for="">Choose image</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                    <label for=""><h5>Page Content</h5></label>
                                        <textarea name="page_content" id="pageContent">
                                        <?php echo (isset($data['page_content'])) ? $data['page_content'] : '' ; ?>
                                        </textarea>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo (!empty($this->error['page_content'])) ? $this->error['page_content'] : ''; 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn" style="background: khaki;" value="Add Page" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
 <?php $this->view("fragments/footer"); ?>            
               