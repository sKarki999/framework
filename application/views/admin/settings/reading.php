<?php $this->view("fragments/header"); ?>
<?php $this->view("fragments/nav"); ?>
<?php $this->view("fragments/sidebar"); ?>        
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        
                        <?php
							if($data['reading']) {
								$reading= $data['reading'][0];
							}
							$this->getFlash('readingSuccess', 'alert-success');
                        ?>

                        <div class="card-deck">
							
							<div class="card my-4">
								<div class="card-header" style="background:#A0DAA9;">
									<h1 class="d-inline-block card-title">Reading Settings</h1>
								</div>
								<div class="card-body">
                                    <form method="post" action="<?php echo baseUrl; ?>/admin/saveReadingSettings/<?php echo $reading['id']; ?>">
                                        <div class="form-group row">
											<label for="" class="col-sm-3 col-form-label"><h5>Blog Posts at most: </h5></label>
											<div class="col-md-2">
                                            <input type="number" style="font-size:20px;" name="blog_page_show_no" value="<?php if(isset($reading['blog_page_show_no'])){echo $reading['blog_page_show_no'];}?>" class="form-control">
											</div>
										</div>
                                        <hr />
										<div class="form-group row">
											<label for="" class="col-sm-3 col-form-label"><h5>Home Pages at most: </h5></label>
											<div class="col-md-2">
                                            <input type="number" style="font-size:20px;" name="home_page_show_no" value="<?php if(isset($reading['blog_page_show_no'])){echo $reading['home_page_show_no'];}?>" class="form-control">
											</div>
										</div>
                                        <hr />
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