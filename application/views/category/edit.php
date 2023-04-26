<?php $this->view("fragments/header"); ?>
<?php $this->view("fragments/nav"); ?>
<?php $this->view("fragments/sidebar"); ?>        
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="card mt-3" style="background:#EDCDC2;">
                            <div class="card-header">
                                <h1 class="d-inline-block card-title">Category Panel&nbsp;</h1>
                            </div>
                        </div>
                        <?php echo $this->getFlash('updateFailed','alert-danger');?>
                        <div class="card my-2">
                            <div class="card-header">
                                <h4>Edit Category&nbsp;&nbsp;
                                    <a href="<?php echo baseUrl;?>/Category/<?php echo $data['currentPage'];?>" class="btn" style="background:#EDCDC2;">Back&nbsp;<i class="fas fa-backward"></i></a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form method="post" action="<?php echo baseUrl;?>/Category/saveEditedCategory/<?php echo $data['category']['cat_id'];?>/<?php echo $data['currentPage']; ?>">
                                    <div class="form-group">
                                        <label for=""><h4 class="required">Title</h4></label>
                                        <input type="text" class="form-control" name="cat_title" value="<?php echo $data['category']['cat_title']; ?>" />
                                        <div class="text-danger h6 mt-1">
                                            <?php 
                                                if(!empty($this->error['cat_title'])) {
                                                echo $this->error['cat_title'];
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="submit" class="btn" style="background:#EDCDC2;" value="Update" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
 <?php $this->view("fragments/footer"); ?>            
               