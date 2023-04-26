<?php $this->view("fragments/header"); ?>
<?php $this->view("fragments/nav"); ?>
<?php $this->view("fragments/sidebar"); ?>        
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    
                        <div class="card mt-3">
                            <div class="card-header" style="background:#EDCDC2;">
                                <h1 class="d-inline-block card-title">Category Panel&nbsp;</h1>
                            </div>
                        </div>
                        <?php 
                            echo $this->getFlash('insertFailed','alert-danger');
                            echo $this->getFlash('categoryExists','alert-danger');
                        ?>
                        <div class="card my-2">
                            <div class="card-header">
                                <h4>Add New Category&nbsp;&nbsp;
                                    <a href="<?php echo baseUrl;?>/Category" class="btn" style="background:#EDCDC2;">Back&nbsp;<i class="fas fa-backward"></i></i></a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form method="post" action="<?php echo baseUrl;?>/Category/saveCategory">
                                    <div class="form-group">
                                        <label for=""><h4 class="required">Title</h4></label>
                                        <input type="text" class="form-control" name="cat_title" 
                                            value="<?php echo (isset($data['cat_title'])) ? $data['cat_title'] : ''; 
                                            ?>" />
                                        <div class="text-danger h6 mt-1">
                                            <?php echo (isset($this->error['cat_title'])) ? $this->error['cat_title'] : '';
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn" style="background:#EDCDC2;" value="Add" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
 <?php $this->view("fragments/footer"); ?>            
               