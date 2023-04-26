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

                        <?php 
                            $this->getFlash('pageInsertSuccess','alert-success');
                            $this->getFlash('pageEditSuccess', 'alert-success');
                            $this->getFlash('pageDeleteSuccess', 'alert-success');
                            $this->getFlash('pageStatusSuccess', 'alert-success');
                        ?>
                        <?php if ($data['currentPage'] <= $data['pageCount']) { ?>
                        <div class="card-deck">
                            <div class="card my-4">
                                <div class="card-header" style="background:whitesmoke;">
                                    <h5><i class="fas fa-columns"></i>&nbsp;<a class="text-dark" href="<?php echo baseUrl;?>/Page">Pages&nbsp;<span class="small text-dark"><i class="fas fa-angle-right"></i></span></a>
                                        <span class="float-right">
                                        <a href="<?php echo baseUrl;?>/Page/addPage" class="btn" style="background: khaki;">Add New&nbsp;<i class="fas fa-plus"></i></a>
                                        </span>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <h5 class="text-muted">Total
                                    <span class="float-right"><?php echo $data['pagesCount']; ?></span>
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
                                    <h5><i class="fas fa-columns"></i>&nbsp;Items Per Page
                                        
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <form action="<?php echo baseUrl; ?>/Page" method="post">
                                        <div class="input-group">
                                            
                                            <select class="form-control" name="selectPerPage" id="selectPagesPerPage">
                                                <option value="0">Choose per page</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                            </select>
                                            
                                            <span class="input-group-btn">
                                                <button class="btn" id="pagesPerPage" style="background: khaki;" type="submit">Apply</button>
                                            </span>
                                        </div>
                                    </form>
                                    <?php if ($data['pagesCount'] > 0) { ?>
                                    <h6 class="text-dark mt-3 ml-1">
                                    <span class="card-title text-muted">Showing '<?php if (isset($data['perPage'])) { echo $data['perPage']; } ?>' items per Page </span>
                                    </h6>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if(!empty($data['result'])) { ?>
                        <div class="card-deck">
                            <div class="card my-2">
                                <div class="card-header" style="background:whitesmoke;color:dark;">
                                    <h5><i class="fas fa-columns"></i>&nbsp;Pages Table
                                    </h5>
                                </div>
                                <form action="<?php echo baseUrl;?>/Page/pageStatus/<?php echo $data['currentPage'];?>/<?php echo $data['perPage'];?>" method="post" class="form-inline">
                                    <div class="input-group ml-3 mt-3">
                                        <select class="form-control" name="pageStatus" id="selectPageStatus"> 
                                            <option value="0">Change Status </option>
                                            <option value="published">Publish</option>
                                            <option value="draft">Draft</option>
                                        </select>
                                        <span class="input-group-append">
                                            <button class="btn" id="updatePageStatus" style="background: khaki;" type="submit">Update</button>
                                        </span>
                                    </div>
                                    <div class="box-body table-responsive mt-3">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered table-hover table-sm">
                                                <thead style="background:khaki;font-size:17px;">
                                                    <tr>
                                                        <th><input type="checkbox" id="selectAllBoxes"></i></th>
                                                        <th>Title</th>
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
                                                        <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="<?php echo $value['page_id'];?>"></td>
                                                        <td><?php echo $value['page_title']; ?></td>
                                                        <td><?php echo $value['page_date']; ?></td>
                                                        <td><?php echo $value['page_status']; ?></td>
                                                        <td><a class="btn btn-secondary btn-sm"  href="<?php echo baseUrl; ?>/Page/editPage/<?php echo $value['page_id'];?>/<?php echo $data['currentPage'];?>" style="margin-left:15px;"><i class="far fa-edit"></i>&nbsp;&nbsp;Edit</a></td>
                                                        <td><a id="confirmDeletion" class="btn btn-secondary btn-sm"  href="<?php echo baseUrl; ?>/Page/deletePage/<?php echo $value['page_id']; ?>" style="margin-left:15px;"><i class="fa fa-trash"></i>&nbsp;&nbsp;Delete</a> </td>
                                                        </tr>
                                                        <?php } } else { ?>
                                                            <div class="card my-3" >
                                                                <div class="card-header" style="background:whitesmoke;">
                                                                    <h5><i class="fas fa-columns"></i>&nbsp;Pages
                                                                    </h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <h4>There are No pages.&nbsp;&nbsp;<a href="<?php echo baseUrl;?>/Page/addPage" class="btn" style="background:khaki;">Add New <i class="fas fa-plus"></i></i></a></h4>
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
                                            <a class="page-link" href="<?php echo baseUrl;?>/Page/<?php echo $data['currentPage']-1;?>/<?php echo $data['perPage'];?>" >Previous</a>
                                        </li>
                                        <?php } ?>
                                        <?php for ($i=1; $i<=$data['pageCount']; $i++) {
                                            $class = ($i == $data['currentPage']) ? 'active' : ''; ?>
                                            <li class="page-item <?php echo $class?>">
                                                <a class="page-link " href="<?php echo baseUrl; ?>/Page/<?php echo $i; ?>/<?php echo $data['perPage'];?>">
                                                    <?php echo $i; ?>
                                                </a>
                                            </li>
                                        <?php
                                                } ?>  
                                        <?php if ($data['currentPage'] < $data['pageCount']) { ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?php echo baseUrl;?>/Page/<?php echo $data['currentPage']+1; ?>/<?php echo $data['perPage'];?>">Next</a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </div>     
                        </div>
                    </main>
 <?php $this->view("fragments/footer"); ?>            
               