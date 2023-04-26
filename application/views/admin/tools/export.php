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

                        <div class="card-deck mt-2">
                            <div class="card my-2">
                                <div class="card-header" style="background:whitesmoke;color:dark;">
                                    <h5><i class="fas fa-file-csv fa-2x"></i>&nbsp;&nbsp;Export Data</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted">Feature to export contents of the CMS</h6>
                                    <p class="card-text">This feature will export all the contents of the selected database table into a csv file.
                                    </p>
                                    <div class="card-title" style="background:whitesmoke;color:dark;">
                                        <h3>Select table</h3>
                                    </div>
                                    <form method="post" action="<?php echo baseUrl;?>/admin/exportProcess">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exportTag" value="category">
                                            <label class="" for="">
                                                Category
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exportTag" id="" value="post">
                                            <label class="" for="">
                                                Post
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exportTag" id="" value="page">
                                            <label class="" for="">
                                                Page
                                            </label>
                                        </div>
                                        <div class="form-group mt-3">
                                            <button class="btn" style="background:#A0DAA9;" name="export" id="downloadButton" type="submit">Download File</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
 <?php $this->view("fragments/footer"); ?>               
               