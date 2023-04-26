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
                            $this->getFlash('insertSuccess', 'alert-success'); 
                            $this->getFlash('updateSuccess', 'alert-success'); 
                            $this->getFlash('deleteSuccess', 'alert-success'); 
                        ?>

                        <?php if($data['currentPage'] <= $data['pageCount']) { ?>
                        <div class="card-deck">
                            
                            <div class="card my-4">
                                <div class="card-header" style="background:whitesmoke;">
                                    <h5><i class="fa fa-list-alt fa-1x"></i>&nbsp;<a class="text-dark" href="<?php echo baseUrl;?>/Category">Categories&nbsp;<span class="small text-dark"><i class="fas fa-angle-right"></i></span></a>
                                        <span class="float-right">
                                        <a href="<?php echo baseUrl;?>/Category/addCategory" class="btn" style="background:#EDCDC2;">Add New&nbsp;<i class="fas fa-plus"></i></a>
                                        </span>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="text-dark">Total Categories
                                    <span class="float-right"><?php echo $data['categoriesCount']; ?></span>
                                    </h6>
                                </div>
                            </div>

                            <div class="card my-4">
                                <div class="card-header" style="background:whitesmoke;">
                                    <h5><i class="fa fa-list-alt fa-1x"></i>&nbsp;Items Per Page
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <form action="<?php echo baseUrl; ?>/Category" method="post">
                                        <div class="input-group">
                                            
                                            <select class="form-control" name="selectPerPage" id="selectCategoriesPerPage">
                                                <option value="0">Choose per page</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                            </select>
                                            
                                            <span class="input-group-btn">
                                                <button class="btn" id="categoryButton" style="background:#EDCDC2;" type="submit">
                                                    Apply
                                                </button>
                                            </span>
                                        </div>
                                    </form>
                                    <?php if ($data['categoriesCount'] > 0) { ?>
                                    <h6 class="text-dark mt-3">
                                    <span class="card-title text-muted">Showing '<?php if (isset($data['perPage'])) {echo $data['perPage'];} ?>' Items per Page
                                    </span></h6>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <?php 
                            if(!empty($data['result'])) {
                        ?>
                        <div class="card-deck mt-1">
                            
                            <div class="card my-2" >
                                <div class="card-header" style="background:whitesmoke;">
                                    <h5><i class="fa fa-list-alt fa-1x"></i>&nbsp;Categories Table
                                    </h5>
                                </div>
                                
                                <div class="card-body">
                                    <div class="box-body table-responsive">
                                                    
                                                    <table class="table table-bordered table-hover table-sm">
                                                        <thead style="background:#EDCDC2;">
                                                        <tr>
                                                            <th><i class="fas fa-sort-alpha-down"></i>&nbsp;&nbsp;Category Title</th>
                                                            <th>Edit</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php      
                                                        foreach ($data['result'] as $value) {
                                                    ?>
                                                    <tr>
                                                    <td><?php echo $value['cat_title']; ?></td>
                                                    <td><a class="btn btn-secondary btn-sm" href="<?php echo baseUrl;?>/Category/editCategory/<?php echo $value['cat_id'];?>/<?php echo $data['currentPage'];?>" 
                                                        style="margin-left:15px;"><i class="far fa-edit"></i>&nbsp;&nbsp;
                                                        Edit</a></td>
                                                    <td><a id="confirmDeletion" class="btn btn-secondary btn-sm" href="<?php echo baseUrl;?>/Category/deleteCategory/<?php echo $value['cat_id'];?>" 
                                                        style="margin-left:15px;"><i class="fa fa-trash"></i>&nbsp;&nbsp;
                                                        Delete</a></td>
                                                    </tr>
                                                    <?php } } else { ?>
                                                        <div class="card my-3" >
                                                            <div class="card-header" style="background:whitesmoke;">
                                                                <h5><i class="fa fa-list-alt fa-1x"></i>&nbsp;Categories
                                                                </h5>
                                                            </div>
                                                            <div class="card-body">
                                                            <h4>There are No categories.&nbsp;&nbsp;<a href="<?php echo baseUrl;?>/Category/addCategory" class="btn" style="background:#EDCDC2;">Add New <i class="fas fa-plus"></i></a></h4>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                        
                                    <?php if (isset($data['pageCount']) && $data['pageCount'] > 1 && !empty($data['result'])) { ?>
                                        <ul class="pagination justify-content-end" style="margin-right: 10px">    
                                            <?php if ($data['currentPage'] > 1) {?>
                                            <li class="page-item">
                                            <a href="<?php echo baseUrl;?>/Category/<?php echo $data['currentPage']-1;?>/<?php echo $data['perPage'];?>" class="page-link">Previous</a>
                                            </li>
                                            <?php } ?>
                                            
                                            <?php for ($i=1; $i<=$data['pageCount']; $i++) {
                                                $class = ($i == $data['currentPage']) ? 'active' : ''; 
                                            ?>
                                            <li class="page-item <?php echo $class; ?>">
                                            <a href="<?php echo baseUrl; ?>/Category/<?php echo $i;?>/<?php echo $data['perPage'];?>" class="page-link"><?php echo $i;?></a>
                                            </li>
                                            <?php } ?>
                                            <?php if ($data['currentPage'] < $data['pageCount']) {?>
                                            <li class="page-item">
                                            <a href="<?php echo baseUrl;?>/Category/<?php echo $data['currentPage']+1;?>/<?php echo $data['perPage'];?>" class="page-link">Next</a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                                </div>
                            </div>     
                        </div>
                    </div>
                </main>
 <?php $this->view("fragments/footer"); ?>            
               