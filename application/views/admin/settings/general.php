<?php $this->view("fragments/header"); ?>
<?php $this->view("fragments/nav"); ?>
<?php $this->view("fragments/sidebar"); ?>        
            <div id="layoutSidenav_content">
                <main>
					
					<div class="container-fluid">
						<?php
							if($data['general']) {
								$general= $data['general'][0];
							}
							$this->getFlash('generalSuccess', 'alert-success');
						?>
						<div class="card-deck">
							
							<div class="card my-4">
								<div class="card-header" style="background:#A0DAA9;">
									<h1 class="d-inline-block card-title">General Settings</h1>
								</div>
								<div class="card-body">
									<form method="post" action="<?php echo baseUrl; ?>/admin/saveGeneralSettings/<?php if(isset($general['id'])) {echo $general['id'];}?>">
									<div class="form-group row">
											<label for="" class="col-sm-3 col-form-label"><h5>Site Title:</h5></label>
											<div class="col-sm-9">
											<input type="text"  class="form-control" name="site_title" value="<?php if(isset($general['site_title'])){echo $general['site_title'];} ?>">
											</div>
										</div>
										<div class="form-group row">
											<label for="" class="col-sm-3 col-form-label"><h5>Site Tagline: </h5></label>
											<div class="col-sm-9">
											<input type="text" name="site_tagline" value="<?php if(isset($general['site_tagline'])){echo $general['site_tagline'];} ?>" class="form-control">
											</div>
										</div>
										<div class="form-group row">
											<label for="" class="col-sm-3 col-form-label"><h5>Site URL:</h5></label>
											<div class="col-sm-9">
											<input type="text" name="site_address" value="<?php if(isset($general['site_address'])){echo $general['site_address'];} ?>" class="form-control">
											</div>
										</div>
										<div class="form-group row">
											<label for="" class="col-sm-3 col-form-label"><h5>Admin Email Address:</h5></label>
											<div class="col-sm-9">
											<input type="text" name="admin_email" value="<?php if(isset($general['admin_email'])){echo $general['admin_email'];} ?>" class="form-control">
											</div>
										</div>
										<div class="form-group row">
											<label for="" class="col-sm-3 col-form-label"><h5>User Default Role:</h5></label>
											<div class="col-sm-9">
												<select class="form-control" name="user_role">
													<option value="<?php echo $general['user_role']; ?>">Current Role: <?php if(isset($general['user_role'])) {echo $general['user_role'];} else {echo 'Not Defined';}?></option>	
													<option value="Administrator">Administrator</option>
													<option value="Editor">Editor</option>
												</select>
											</div>
										</div>
										<hr />
										<div class="form-group">
											<div class="row">
											<legend class="col-form-label col-sm-3 pt-0"><h5>Date Format:</h5></legend>
												<div class="col-sm-9">
													<p><h6><input type="radio" name="date_format" value="Y-m-d" <?php echo (isset($general['date_format']) && $general['date_format'] == 'Y-m-d') ? "checked" : ''; ?>/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2020-12-04  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Y-m-d</h6></p>
													<p><h6><input type="radio" name="date_format" value="m/d/y" <?php echo (isset($general['date_format']) && $general['date_format'] == 'm/d/y') ? "checked" : ''; ?>/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;12/04/2020  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;m/d/y</h6></p>
													<p><h6><input type="radio" name="date_format" value="d/m/y" <?php echo (isset($general['date_format']) && $general['date_format'] == 'd/m/y') ? "checked" : ''; ?>/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;04/12/2020  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;d/m/y</h6></p>
												</div>
											</div>
										</div>
										<hr />
										<div class="form-group">
											<div class="row">
												<legend class="col-form-label col-sm-3 pt-0"><h5>Time Format:</h5></legend>
												<div class="col-sm-9">
													<p><h6><input type="radio" name="time_format" value="g:i a" <?php echo (isset($general['time_format']) && $general['time_format'] == 'g:i a') ? "checked" : ''; ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;11:05 am  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;g:i a</h6></p>
													<p><h6><input type="radio" name="time_format" value="g:i A" <?php echo (isset($general['time_format']) && $general['time_format'] == 'g:i A') ? "checked" : ''; ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;11:05 AM  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;g:i A</h6></p>
													<p><h6><input type="radio" name="time_format" value="H:i" <?php echo (isset($general['time_format']) && $general['time_format'] == 'H:i') ? "checked" : ''; ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;11:05  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;H:i</h6></p>
												</div>
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
               