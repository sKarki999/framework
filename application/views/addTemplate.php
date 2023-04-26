<?php $this->view("fragments/header"); ?>
<?php $this->view("fragments/nav"); ?>
<?php $this->view("fragments/sidebar"); ?>        
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">

                        <div class="card mt-4">
                            <div class="card-header" style="background:#D8BFD8;">
                                <h1 class="d-inline-block card-title">Template Management&nbsp;</h1>
                            </div>
                        </div>
                        
                            <div class="card-deck mt-2">
                                <div class="card my-2">
                                    <div class="card-header" style="background:whitesmoke;color:dark;">
                                        <h5><i class="fa fa-file fa-2x"></i>&nbsp;&nbsp;Add New Template&nbsp;&nbsp;
                                        <span class="float-right">
                                        <a href="<?php echo baseUrl;?>/Appearance/getTemplate" class="btn" style="background:#D8BFD8;">Back&nbsp;<i class="fas fa-backward"></i></a>
                                        </span>
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="<?php echo baseUrl;?>/Appearance/saveNewTemplate" enctype="multipart/form-data">
                                        <?php if(isset($data['error'])) { ?>
                                        <div class="mt-3 mb-3">
                                            <span class="text-danger h6 mt-1">
                                                <?php echo $data['error'];?>
                                            </span>
                                        </div>
                                        <?php } ?>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><strong>Name</strong></div>
                                            </div>
                                            <input type="text" class="form-control col-sm-12" name="templateName" />
                                        </div>

                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><strong>Short Description</strong></div>
                                            </div>
                                            <input type="text" class="form-control col-sm-12" name="templateDesc" />
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" style="width:150px;"><strong>Upload Template</strong></span>
                                            <div class="custom-file col-sm-12">
                                                <input type="file" name="templateFile" />
                                            </div>
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" style="width:150px;"><strong>Upload Asset</strong></span>
                                            <div class="custom-file col-sm-12">
                                                <input type="file" name="asset" />
                                            </div>
                                        </div>
                                        
                                        <div class="form-group mt-3">
                                            <input class="btn" style="background:#D8BFD8;" type="submit" name="upload" id="upload" value="Upload" />
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                    </div>
                </main>
 <?php $this->view("fragments/footer"); ?>               
               