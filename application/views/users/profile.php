<?php $this->view("fragments/header"); ?>
<?php $this->view("fragments/nav"); ?>
<?php $this->view("fragments/sidebar"); ?>        
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        
                        <div class="card mt-3">
                            <div class="card-header" style="background:#EDD59E;">
                                <h1 class="d-inline-block card-title">Profile Update&nbsp;</h1>
                            </div>
                        </div>

                        <?php
                            echo $this->getFlash('updateFailed', 'alert-danger');
                            echo $this->getFlash('updateSuccess', 'alert-success');
                            $value = $data[0];
                        ?>

                        <div class="card my-4">
                            <div class="card-body">
                                <form method="post" action="<?php echo baseUrl;?>/Profile/UpdateProfile/<?php echo $value['user_id'];?>">

                                <div class="form-group">
                                        <label for=""><h5>First name</h5></label>
                                        <input type="text" class="form-control" name="firstname" 
                                        value="<?php echo (isset($value['firstname'])) ? $value['firstname'] : '';
                                        ?>"/>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo (!empty($this->error['firstname'])) ? $this->error['firstname'] : '';
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5>Last name</h5></label>
                                        <input type="text" class="form-control" name="lastname" 
                                        value="<?php echo (isset($value['lastname'])) ? $value['lastname'] : '';
                                        ?>"/>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo (!empty($this->error['lastname'])) ? $this->error['lastname'] : '';
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5>Username</h5></label>
                                        <input type="text" class="form-control disable" name="username"
                                        value="<?php echo (isset($value['username'])) ? $value['username'] : '' ;
                                        ?>" />
                                        <div class="text-danger h6 mt-1">
                                            <?php echo (!empty($this->error['username'])) ? $this->error['username'] : '';
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5>Email</h5></label>
                                        <input type="email" class="form-control disable" name="email" 
                                        value="<?php echo (isset($value['email'])) ? $value['email'] : ''; ?>"/>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo (!empty($this->error['email'])) ? $this->error['email'] : '';
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5>Set New Password</h5></label>
                                        <input type="password" class="form-control" name="password" />
                                        <div class="text-danger h6 mt-1">
                                            <?php echo (!empty($this->error['password'])) ? $this->error['password'] : '';
                                            ?>
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
               