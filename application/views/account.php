<?php $this->view("fragments/header"); ?>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            
                            <div class="col-lg-5">
                                <?php 
                                    echo $this->getFlash('usernameOrEmailNotFound', 'alert-danger');
                                    echo $this->getFlash('passwordError', 'alert-danger');
                                    echo $this->getFlash('loggedOut', 'alert-success');
                                    echo $this->getFlash('permissionError', 'alert-info');
                                ?>
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center text-muted my-4">Orion***</h3></div>
                                        <div class="card-body">
                                            <form method="post" action="<?php echo baseUrl;?>/Account/submit">
                                                <div class="form-group">
                                                    <label for=""><h6 class="text-muted">Username or Email</h6></label>
                                                    <input class="form-control py-4" type="text" name="usernameOrEmail" 
                                                    value="<?php echo (isset($data['usernameOrEmail'])) ? $data['usernameOrEmail'] : ''; ?>" />
                                                    <div class="text-danger h6 mt-1">
                                                        <?php echo (!empty($this->error['usernameOrEmail'])) ? $this->error['usernameOrEmail'] : ''; ?>
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for=""><h6 class="text-muted">Password</h6></label>
                                                    <input class="form-control py-4" type="password" name="password" />
                                                    <div class="text-danger h6 mt-1">
                                                        <?php echo (!empty($this->error['password'])) ? $this->error['password'] : ''; ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" class="btn" style="background:#A0DAA9;" value="login" />
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <div class="card-footer">
                                    <a href="<?php echo baseUrl;?>/Site" class="text-muted">&larr; Visit Site</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

<?php $this->view('fragments/footer');?>