<?php $this->view("fragments/header"); ?>
<?php $this->view("fragments/nav"); ?>
<?php $this->view("fragments/sidebar"); ?>        
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">

                        <div class="card mt-3">
                            <div class="card-header" style="background:#EDD59E;">
                                <h1 class="d-inline-block card-title">User Panel&nbsp;</h1>
                            </div>
                        </div>

                        <?php 
                            // display the flash messages
                            $this->getFlash('userInsertSuccess','alert-success');
                            $this->getFlash('userUpdateSuccess', 'alert-success');
                            $this->getFlash('userDeleteSuccess', 'alert-success');
                            $this->getFlash('roleUpdate', 'alert-success');
                        ?>

                        <div class="card-deck">
                            <div class="card my-4">
                                <div class="card-header" style="background:whitesmoke;">
                                    <h5><i class="fa fa-users fa-1x"></i>&nbsp;<a class="text-dark" href="<?php echo baseUrl;?>/Admin/userPanel">Users&nbsp;<span class="small text-dark"><i class="fas fa-angle-right"></i></span></a>
                                        <span class="float-right">
                                        <a href="<?php echo baseUrl;?>/Admin/addUser" class="btn" style="background:#EDD59E;">Add User&nbsp;<i class="fas fa-plus"></i></a>
                                        </span>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <h5 class="text-muted">Total Users
                                    <span class="float-right"><?php echo $data['totalUsers']; ?></span>
                                    </h5> <hr />
                                    <h5 class="text-muted">Administrator
                                    <span class="float-right"><?php echo $data['adminCount']; ?></span>
                                    </h5>
                                    <h5 class="text-muted">Editor
                                    <span class="float-right"><?php echo $data['editorCount']; ?></span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-deck">
                            
                            <div class="card my-2" >
                                <div class="card-header" style="background:whitesmoke;color:dark;">
                                    <h5><i class="fa fa-users fa-1x"></i>&nbsp;Users Table
                                    </h5>
                                </div>
                                    
                                <form action="<?php echo baseUrl;?>/Admin/changeRole" method="post" class="form-inline">
                                    <div class="box-body table-responsive mt-3">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered table-hover table-sm">
                                                <thead style="background:#EDD59E;">
                                                    <tr>
                                                        <th>Username</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Role</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        <?php
                                                            foreach ($data['users'] as $value) {
                                                                ?>
                                                        <tr>
                                                        <td><?php echo $value['username']; ?></td>
                                                        <td><?php echo $value['firstname'].' '.$value['lastname']; ?></td>
                                                        <td><?php echo $value['email']; ?></td>
                                                        <td><?php echo $value['user_role'];?></td>
                                                        <?php if($value['username'] != 'sagun') { ?>
                                                        <td>
                                                        <a class="btn btn-secondary btn-sm" href="<?php echo baseUrl; ?>/Admin/editUser/<?php echo $value['user_id'];?>" style="margin-left:15px;"><i class="far fa-edit"></i>&nbsp;&nbsp;Edit</a></td>
                                                        <td>
                                                            <a id="confirmDeletion" class="btn btn-secondary btn-sm" href="<?php echo baseUrl; ?>/Admin/deleteUser/<?php echo $value['user_id']; ?>" style="margin-left:15px;"><i class="fa fa-trash"></i>&nbsp;&nbsp;Delete</a> 
                                                        </td>
                                                            <?php } ?>
                                                        </tr>
                                                        <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>    
                                    </div>
                                </form>
                            </div>     
                        </div>
                    </div>
                </main>
 <?php $this->view("fragments/footer"); ?>            
               