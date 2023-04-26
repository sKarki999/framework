<?php $this->view("fragments/header"); ?>
<?php $this->view("fragments/nav"); ?>
<?php $this->view("fragments/sidebar"); ?>        
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">

                        <div class="card mt-3">
                            <div class="card-header" style="background:#DFCFBE;">
                                <h1 class="d-inline-block card-title">Message Panel&nbsp;</h1>
                            </div>
                        </div>

                        <?php 
                            if(!empty($data['readMore'])) {
                                $readMore = $data['readMore'][0];
                            } 
                        ?>
            
                        <div class="card-deck mt-1">

                            <div class="card my-2" >
                            <div class="card-header">
                                <h4>Message&nbsp;&nbsp;
                                    <a href="<?php echo baseUrl;?>/admin/messagePanel" class="btn" style="background:#DFCFBE;">Back&nbsp;<i class="fas fa-backward"></i></i></a>
                                </h4>
                            </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $readMore['fullname'];?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $readMore['email'];?></h6>
                                    <p class="card-text"><?php echo $readMore['message'];?> </p>
                                </div>
                            </div>     
                        </div>
                    </div>
                </main>
 <?php $this->view("fragments/footer"); ?>            
               