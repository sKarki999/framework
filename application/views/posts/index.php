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

                        <?php 
                            // display the flash messages
                            $this->getFlash('postInsertSuccess','alert-success');
                            $this->getFlash('postEditedSuccess', 'alert-success');
                            $this->getFlash('postDeletedSuccess', 'alert-success');
                            $this->getFlash('statusUpdate', 'alert-success');
                        ?>

                        <?php if($data['currentPage'] <= $data['pageCount']) { ?>
                        <div class="card-deck">
                            <div class="card my-4">
                                <div class="card-header" style="background:whitesmoke;">
                                    <h5><i class="far fa-sticky-note fa-1x"></i>&nbsp;<a class="text-dark" href="<?php echo baseUrl;?>/Post">Posts&nbsp;<span class="small text-dark"><i class="fas fa-angle-right"></i></span></a>
                                        <span class="float-right">
                                        <a href="<?php echo baseUrl;?>/Post/addPost" class="btn" style="background:#9BB7D4;">Add New&nbsp;<i class="fas fa-plus"></i></a>
                                        </span>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <h5 class="text-muted">Total
                                    <span class="float-right"><?php echo $data['postsCount']; ?></span>
                                    </h5> <hr />
                                    <h5 class="text-muted">Draft
                                    <span class="float-right"><?php echo $data['draftCount']; ?></span>
                                    </h5>
                                    <h5 class="text-muted">Published
                                    <span class="float-right"><?php echo $data['publishedCount']; ?></span>
                                    </h5>
                                </div>
                            </div>

                            <div class="card my-4">
                                <div class="card-header" style="background:whitesmoke;color:dark;">
                                    <h5><i class="far fa-sticky-note fa-1x"></i>&nbsp;Items Per Page
                                        
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <form action="<?php echo baseUrl; ?>/Post" method="post">
                                        <div class="input-group">
                                            
                                            <select class="form-control" name="selectPerPage" id="selectPostsPerPage">
                                                <option value="0">Choose per page</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                            </select>
                                            
                                            <span class="input-group-btn">
                                                <button class="btn"  id="postsPerPage" style="background:#9BB7D4;" type="submit">Apply</button>
                                            </span>
                                        </div>
                                    </form>
                                    <?php if ($data['postsCount'] > 0) {?>
                                    <h6 class="text-dark mt-3 ml-1">
                                    <span class="card-title text-muted">Showing '<?php if (isset($data['perPage'])) { echo $data['perPage']; } ?>' Items per Page 
                                    </span></h6>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if(!empty($data['result'])) { ?>
                        <div class="card-deck">
                            
                            <div class="card my-2" >
                                <div class="card-header" style="background:whitesmoke;color:dark;">
                                    <h5><i class="far fa-sticky-note fa-1x"></i>&nbsp;Posts Table
                                    </h5>
                                </div>
                                    
                                <form action="<?php echo baseUrl;?>/Post/postStatus/<?php echo $data['currentPage'];?>/<?php echo $data['perPage'];?>" method="post" class="form-inline">

                                    <div class="input-group ml-3 mt-3">
                                        <select class="form-control" name="postStatus" id="selectPostStatus"> 
                                            <option value="0">Change Status </option>
                                            <option value="published">Publish</option>
                                            <option value="draft">Draft</option>
                                        </select>
                                        <span class="input-group-append">
                                            <button class="btn" id="updatePostStatus" style="background:#9BB7D4;" type="submit">Update</button>
                                        </span>
                                    </div>
                                   
                                    <div class="box-body table-responsive mt-3">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered table-hover table-sm">
                                                <thead style="background:#9BB7D4;">
                                                    <tr>
                                                        <th><input type="checkbox" id="selectAllBoxes"></i></th>
                                                        <th>Title</th>
                                                        <th>Author</th>
                                                        <th>Category</th>
                                                        <th><i class="far fa-calendar-alt"></i>&nbsp;Date</th>
                                                        <th>Status</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        <?php
                                                            foreach ($data['result'] as $value) {
                                                                ?>
                                                        <tr>
                                                        <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="<?php echo $value['post_id'];?>"></td>
                                                        <td><?php echo $value['post_title']; ?></td>
                                                        <td><?php echo $value['post_author']; ?></td>
                                                        <td><?php echo $value['cat_title']; ?></td>
                                                        <td><?php echo $value['post_date']; ?></td>
                                                        <td><?php echo $value['post_status']; ?></td>
                                                        <td><a class="btn btn-secondary btn-sm" href="<?php echo baseUrl; ?>/Post/editPost/<?php echo $value['post_id'];?>/<?php echo $data['currentPage'];?>" style="margin-left:15px;"><i class="far fa-edit"></i>&nbsp;&nbsp;Edit</a></td>
                                                        <td><a id="confirmDeletion" class="btn btn-secondary btn-sm" href="<?php echo baseUrl; ?>/Post/deletePost/<?php echo $value['post_id']; ?>" style="margin-left:15px;"><i class="fa fa-trash"></i>&nbsp;&nbsp;Delete</a> </td>
                                                        </tr>
                                                        <?php } } else { ?>
                                                            <div class="card my-3" >
                                                                <div class="card-header" style="background:whitesmoke;">
                                                                    <h5><i class="far fa-sticky-note fa-1x"></i>&nbsp;Posts
                                                                    </h5>
                                                                </div>
                                                                <div class="card-body">
                                                                <h4>There are No posts.&nbsp;&nbsp;<a href="<?php echo baseUrl;?>/Post/addPost" class="btn" style="background:#9BB7D4;">Add New <i class="fas fa-plus"></i></a></h4>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>    
                                    </div>
                                </form>    
                                <?php if (isset($data['pageCount']) && $data['pageCount'] > 1 && !empty($data['result'])) { ?>
                                    <ul class="pagination justify-content-end" style="margin-right:10px;">
                                        <?php if ($data['currentPage'] > 1) { ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?php echo baseUrl;?>/Post/<?php echo $data['currentPage']-1;?>/<?php echo $data['perPage'];?>" >Previous</a>
                                        </li>
                                        <?php } ?>
                                        <?php for ($i=1; $i<=$data['pageCount']; $i++) {
                                            $class = ($i == $data['currentPage']) ? 'active' : ''; ?>
                                            <li class="page-item <?php echo $class?>">
                                                <a class="page-link " href="<?php echo baseUrl; ?>/Post/<?php echo $i; ?>/<?php echo $data['perPage'];?>">
                                                    <?php echo $i; ?>
                                                </a>
                                            </li>
                                        <?php
                                                } ?>  
                                        <?php if ($data['currentPage'] < $data['pageCount']) { ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?php echo baseUrl;?>/Post/<?php echo $data['currentPage']+1; ?>/<?php echo $data['perPage'];?>">Next</a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </div>     
                        </div>
                    </div>
                </main>
 <?php $this->view("fragments/footer"); ?>            
               