<?php $this->view("fragments/header"); ?>
<?php $this->view("fragments/nav"); ?>
<?php $this->view("fragments/sidebar"); ?>        
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">

                        <div class="card mt-3">
                            <div class="card-header" style="background:#A0DAA9;">
                                <h1 class="d-inline-block card-title">Dashboard&nbsp;</h1>
                            </div>
                        </div>
                        <?php 
                            echo $this->getFlash('loggedIn', 'alert-success');
                            echo $this->getFlash('editError', 'alert-info');
                            echo $this->getFlash('deleteError', 'alert-info');
                            echo $this->getFlash('permissionError', 'alert-info');
                        ?>

                        <div class="card mt-5">
                            <nav class="navbar navbar-expand-lg navbar-light">
                                <a class="navbar-brand" href="javascript:">Quick Links&nbsp;<i class="fas fa-arrow-right"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                    <div class="navbar-nav">
                                    <a class="nav-item nav-link active text-primary ml-2" href="<?php echo baseUrl;?>/Post/addPost"><i class="fa fa-edit"></i>&nbsp;&nbsp;Write Your first blog post</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a class="nav-item nav-link active text-primary ml-2" href="<?php echo baseUrl;?>/Page/addPage"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add an About Page</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a class="nav-item nav-link active text-primary ml-2" href="<?php echo baseUrl;?>/Site" target="_blank"><i class="fa fa-desktop"></i>&nbsp;&nbsp;View Your site</a>&nbsp;&nbsp;
                                    <?php if($this->getSession('userRole') == 'Admin') { ?>    
                                    <a class="nav-item nav-link active text-primary ml-2" href="<?php echo baseUrl;?>/Admin/messagePanel"><i class="fas fa-envelope-open-text"></i>&nbsp;&nbsp;Read Messages</a>&nbsp;&nbsp;
                                    <?php } ?>
                                </div>
                                </div>
                            </nav>
                        </div>

                        <div class="card-deck mt-4">
                            <div class="card">
                                <div class="card-header" style="background:#9BB7D4;">
                                    <h5><i class="far fa-sticky-note fa-1x"></i>&nbsp;<a class="text-dark" href="<?php echo baseUrl;?>/Post">Posts&nbsp;<span class="small text-dark"><i class="fas fa-angle-right"></i></span></a></h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="text-dark">Total Posts
                                    <span class="float-right"><?php echo $data['postsCount']; ?></span>
                                    </h6>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" style="background:#EDCDC2;">
                                    <h5><i class="fa fa-list-alt fa-1x"></i>&nbsp;<a class="text-dark" href="<?php echo baseUrl;?>/Category">Categories</a>&nbsp;<span class="small text-dark"><i class="fas fa-angle-right"></i></span></h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="text-dark">Total Categories
                                    <span class="float-right"><?php echo $data['categoriesCount']; ?></span>
                                    </h6>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" style="background:khaki;">
                                    <h5><i class="fas fa-columns fa-1x"></i>&nbsp;<a class="text-dark" href="<?php echo baseUrl;?>/Page">Pages</a>&nbsp;<span class="small text-dark"><i class="fas fa-angle-right"></i></span></h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="text-dark">Total Pages
                                    <span class="float-right"><?php echo $data['pagesCount']; ?></span>
                                    </h6>
                                </div>
                            </div>
                            <?php if($this->getSession('userRole') == 'Admin') { ?>
                            <div class="card">
                                <div class="card-header" style="background:#EDD59E;">
                                    <h5><i class="fa fa-users fa-1x"></i>&nbsp;<a class="text-dark" href="<?php echo baseUrl;?>/Admin/userPanel">Users</a>&nbsp;<span class="small text-dark"><i class="fas fa-angle-right"></i></span></h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="text-dark">Total Users
                                    <span class="float-right"><?php echo $data['usersCount']; ?></span>
                                    </h6>
                                </div>
                            </div>
                            <?php } ?>

                            <div class="card">
                                <div class="card-header" style="background:#D8BFD8;">
                                    <h5><i class="fa fa-file fa-1x"></i>&nbsp;<a class="text-dark" href="<?php echo baseUrl;?>/Appearance">Templates</a>&nbsp;<span class="small text-dark"><i class="fas fa-angle-right"></i></span></h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="text-dark">Total Template
                                    <span class="float-right"><?php echo $data['templatesCount']; ?></span>
                                    </h6>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-header" style="background:#A0DAA9;">
                                <h4><i class="fas fa-chart-bar"></i>&nbsp;Content - Column Chart</h4>
                            </div>
                            <div class="col-md-12">
                            <canvas id="myChart" width="600px;" height="200px;"></canvas>
                            </div>
                        </div>
                                
                        <script>
                            var ctx = document.getElementById('myChart');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: ['Draft Posts', 'Published Posts', 'Categories', 'Draft Page', 'Published Page', 'Admin', 'Editor', 'Template'],
                                    datasets: [{
                                        label: 'Count',
                                        data: [
                                            <?php echo $data['postDraftCount']; ?>, 
                                            <?php echo $data['postPublishedCount']; ?>, 
                                            <?php echo $data['categoriesCount']; ?>, 
                                            <?php echo $data['pageDraftCount']; ?>, 
                                            <?php echo $data['pagePublishedCount']; ?>, 
                                            <?php echo $data['adminCount']; ?>, 
                                            <?php echo $data['editorCount']; ?>,
                                            <?php echo $data['templatesCount']; ?>
                                        ],
                                        backgroundColor: [
                                            '#9BB7D4',
                                            '#9BB7D4',
                                            '#EDCDC2',
                                            'khaki',
                                            'khaki',
                                            '#EDD59E',
                                            '#EDD59E',
                                            '#D8BFD8'
                                        ],
                                        borderWidth: 2,
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                </main>
<?php $this->view("fragments/footer"); ?>