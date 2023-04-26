<?php $this->view("fragments/header"); ?>
<?php $this->view("fragments/nav"); ?>
<?php $this->view("fragments/sidebar"); ?>        
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <?php
                            if ($data['media']) {
                                $media = $data['media'][0];
                            }
                            $this->getFlash('mediaSuccess', 'alert-success');
                        ?>

                        
                        <div class="card-deck">
							
							<div class="card my-4">
								<div class="card-header" style="background:#A0DAA9;">
									<h1 class="d-inline-block card-title">Media Settings</h1>
								</div>
								    <div class="card-body">
                                        <form method="post" action="<?php echo baseUrl; ?>/admin/saveMediaSettings/<?php echo $media['id']; ?>">
                                            <div class="card-deck mt-2">
                                                <div class="card h-100" style="max-width: 18rem;">
                                                    <div class="card-header">
                                                    <h5>Image Size</h5>
                                                    </div>
                                                    <div class="card-body">

                                                    <ul class="list-group">
                                                        <li class="list-group-item"><h6>Width:</h6>
                                                            <input class="form-control" style="font-size:17px;" type="number" name="image_width" value="<?php if(isset($media['image_width'])) {echo $media['image_width'];}?>" />
                                                        </li>
                                                        <li class="list-group-item"><h6>Height:</h6>
                                                            <input class="form-control" style="font-size:17px;" type="number" name="image_height" value="<?php if(isset($media['image_height'])) {echo $media['image_height'];}?>" />
                                                        </li>
                                                    </ul>
                                                    
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group mt-4">
                                            <input type="submit" value="Save Changes" class="btn" style="background:#A0DAA9;" />
                                            </div>
                                        </form>
                                    </div>
							</div>
						</div>

                        
                    </div>
                </main>
 <?php $this->view("fragments/footer"); ?>               
               