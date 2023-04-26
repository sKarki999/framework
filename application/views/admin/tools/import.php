<?php $this->view("fragments/header"); ?>
<?php $this->view("fragments/nav"); ?>
<?php $this->view("fragments/sidebar"); ?>        
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">

                        <div class="card mt-4">
                            <div class="card-header" style="background:#A0DAA9;">
                                <h1 class="d-inline-block card-title">Tools&nbsp;</h1>
                            </div>
                        </div>
                        <?php 
                            $this->getFlash('imported','alert-success');
                        ?>

                        <div class="card-deck mt-2">
                            <div class="card my-2">
                                <div class="card-header" style="background:whitesmoke;color:dark;">
                                    <h5><i class="fas fa-file-csv fa-2x"></i>&nbsp;&nbsp;Import Data</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted">Feature to import contents from a csv file.</h6>
                                    <p class="card-text">This feature will import all the contents from the csv file into the selected database table.
                                    </p>
                                    <form method="post" action="<?php echo baseUrl;?>/admin/importProcess" enctype="multipart/form-data">
                                        
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                            <div class="input-group-text">Tablename</div>
                                            </div>
                                            <input type="text" class="form-control col-sm-7" name="tableName" placeholder="Import content in ....">
                                        </div>

                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="width:103px;">Upload</span>
                                            </div>
                                            <div class="custom-file col-sm-7">
                                            <input type="file" class="custom-file-input" name="csvFilename" id="csvFilename">
                                            <label class="custom-file-label text-muted" for="csvFilename">Choose file</label>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group mt-3">
                                            <input class="btn" style="background:#A0DAA9;" type="submit" name="import" id="import" value="Import file" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
 <?php $this->view("fragments/footer"); ?>               
               