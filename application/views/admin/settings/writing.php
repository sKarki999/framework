<?php $this->view("fragments/header"); ?>
<?php $this->view("fragments/nav"); ?>
<?php $this->view("fragments/sidebar"); ?>        
            <div id="layoutSidenav_content">
                <main>
				    <div class="container-fluid">

                        <?php
                            if ($data['writing']) {
                                $writing = $data['writing'][0];
							}
							$this->getFlash('writingSuccess', 'alert-success');
                        ?>

                        <div class="card-deck">
							
							<div class="card my-4">
								<div class="card-header" style="background:#A0DAA9;">
									<h1 class="d-inline-block card-title">Writing Settings</h1>
								</div>
								<div class="card-body">
                                    <form method="post" action="<?php echo baseUrl; ?>/admin/saveWritingSettings/<?php echo $writing['id']; ?>">
                                        <div class="form-group row">
											<label for="" class="col-sm-3 col-form-label"><h5>Mail Server:</h5></label>
											<div class="col-sm-5">
											<input type="text" name="mail_server" value="<?php if(isset($writing['mail_server'])){echo $writing['mail_server'];} ?>" class="form-control">
											</div>
										</div>
										<div class="form-group row">
											<label for="" class="col-sm-3 col-form-label"><h5>Login Name:</h5></label>
											<div class="col-sm-5">
											<input type="text" name="login_name" value="<?php if(isset($writing['login_name'])){echo $writing['login_name'];} ?>" class="form-control">
											</div>
										</div>
										<div class="form-group row">
											<label for="" class="col-sm-3 col-form-label"><h5>Password:</h5></label>
											<div class="col-sm-5">
											<input type="text" name="password" value="<?php if(isset($writing['password'])){echo $writing['password'];} ?>" class="form-control">
											</div>
										</div>
                                        
										<div class="form-group row">
											<div class="col-sm-9">
											 <input type="submit" class="btn" style="background:#A0DAA9;" value="Save Changes" />
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>

                    </div>
                </main>
 <?php $this->view("fragments/footer"); ?>               
               