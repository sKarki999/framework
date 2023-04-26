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
                            echo $this->getFlash('postInsertFailed', 'alert-danger');
                            echo $this->getFlash('usernameExists', 'alert-danger');
                            echo $this->getFlash('emailExists', 'alert-danger');
                        ?>

                        <div class="card my-4">
                            <div class="card-header">
                                <h4>Add New User&nbsp;&nbsp;
                                <a href="<?php echo baseUrl;?>/Admin/userPanel" class="btn" style="background:#EDD59E;">Back&nbsp;<i class="fas fa-backward"></i></a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form method="post" action="<?php echo baseUrl;?>/Admin/saveUser">

                                    <div class="form-group">
                                        <label for=""><h5>First name</h5></label>
                                        <input type="text" class="form-control" name="firstname" 
                                        value="<?php echo (isset($data['firstname'])) ? $data['firstname'] : '';
                                        ?>"/>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo (!empty($this->error['firstname'])) ? $this->error['firstname'] : '';
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5>Last name</h5></label>
                                        <input type="text" class="form-control" name="lastname" 
                                        value="<?php echo (isset($data['lastname'])) ? $data['lastname'] : '';
                                        ?>"/>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo (!empty($this->error['lastname'])) ? $this->error['lastname'] : '';
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="required">Username</h5></label>
                                        <input type="text" class="form-control" name="username"
                                        value="<?php echo (isset($data['username'])) ? $data['username'] : '' ;
                                        ?>" />
                                        <div class="text-danger h6 mt-1">
                                            <?php echo (!empty($this->error['username'])) ? $this->error['username'] : '';
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="required">Email</h5></label>
                                        <input type="email" class="form-control" name="email" 
                                        value="<?php echo (isset($data['email'])) ? $data['email'] : '';
                                        ?>"/>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo (!empty($this->error['email'])) ? $this->error['email'] : '';
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="required">Password</h5></label>
                                        <input type="password" class="form-control" name="password" 
                                        value="<?php echo (isset($data['password'])) ? $data['password'] : '';
                                        ?>"/>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo (!empty($this->error['password'])) ? $this->error['password'] : '';
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="required">Role</h5></label>
                                        <select class="form-control" name="user_role">
                                            <option value="<?php echo (isset($data['user_role']) ? $data['user_role'] : 'Choose Role'); ?>">
                                                <?php echo (isset($data['user_role']) ? $data['user_role'] : 'Choose a role'); ?>
                                            </option>
                                            <option value="Admin">Admin</option>
                                            <option value="Editor">Editor</option>
                                        </select>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo (!empty($this->error['user_role'])) ? $this->error['user_role'] : ''; ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn" style="background:#EDD59E;" value="Add" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
 <?php $this->view("fragments/footer"); ?>            
               