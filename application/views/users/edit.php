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

                        <?php echo $this->getFlash('userInsertFailed', 'alert-danger');?>

                        <div class="card my-4">
                            <div class="card-header">
                                <h4>Edit User&nbsp;&nbsp;
                                <a href="<?php echo baseUrl;?>/Admin/userPanel" class="btn" style="background:#EDD59E;">Back&nbsp;<i class="fas fa-backward"></i></a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form method="post" action="<?php echo baseUrl;?>/Admin/saveEditedUser/<?php echo $data['currentUser']['user_id'];?>">

                                    <div class="form-group">
                                        <label for=""><h5>First name</h5></label>
                                        <input type="text" class="form-control" name="firstname" 
                                        value="<?php echo (isset($data['currentUser']['firstname'])) ? $data['currentUser']['firstname'] : '';
                                        ?>"/>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo (!empty($this->error['firstname'])) ? $this->error['firstname'] : '';
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5>Last name</h5></label>
                                        <input type="text" class="form-control" name="lastname" 
                                        value="<?php echo (isset($data['currentUser']['lastname'])) ? $data['currentUser']['lastname'] : '';
                                        ?>"/>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo (!empty($this->error['lastname'])) ? $this->error['lastname'] : '';
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5>Username</h5></label>
                                        <input type="text" class="form-control disable" name="username"
                                        value="<?php echo (isset($data['currentUser']['username'])) ? $data['currentUser']['username'] : '' ;
                                        ?>" />
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5>Email</h5></label>
                                        <input type="email" class="form-control disable" name="email" 
                                        value="<?php echo (isset($data['currentUser']['email'])) ? $data['currentUser']['email'] : '';
                                        ?>"/>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5>Set New Password</h5></label>
                                        <input type="password" class="form-control" name="password" />
                                        <div class="text-danger h6 mt-1">
                                            <?php echo (!empty($this->error['password'])) ? $this->error['password'] : ''; ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5>Role</h5></label>
                                        <select class="form-control" name="user_role">
                                            <option value="<?php echo (isset($data['currentUser']['user_role']) ? $data['currentUser']['user_role'] : 0); ?>">
                                                <?php echo (isset($data['currentUser']['user_role']) ? 'Current Role: '.$data['currentUser']['user_role'] : 'Choose a role'); ?>
                                            </option>
                                            <option value="Admin">Admin</option>
                                            <option value="Editor">Editor</option>
                                        </select>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo (!empty($this->error['user_role'])) ? $this->error['user_role'] : ''; ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn" style="background:#EDD59E;" value="Update" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
 <?php $this->view("fragments/footer"); ?>            
               