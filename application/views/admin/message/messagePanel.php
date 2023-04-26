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
                            $this->getFlash('msgDeletedSuccess', 'alert-success'); 
                        ?>
                        <?php 
                            if(!empty($data['result'])) {
                        ?>
                        <div class="card-deck mt-1">
                            
                            <div class="card my-2" >
                                <div class="card-header" style="background:whitesmoke;">
                                    <h5><i class="fa fa-list-alt fa-1x"></i>&nbsp;<a class="text-dark" href="<?php echo baseUrl;?>/Admin/messagePanel">Messages</a>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="box-body table-responsive">
                                                    
                                        <table class="table table-bordered table-hover table-sm">
                                            <thead style="background:#DFCFBE;">
                                            <tr>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Message</th>
                                                <th>Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php      
                                                foreach ($data['result'] as $value) {
                                            ?>
                                            <tr>
                                            <td><?php echo $value['fullname']; ?></td>
                                            <td><?php echo $value['email']; ?></td>
                                            <td><a href="<?php echo baseUrl;?>/Admin/readMore/<?php echo $value['id'];?>"><?php echo substr($value['message'], 0, 10) . '....'; ?></a></td>
                                            <td><a id="confirmDeletion" class="btn btn-secondary btn-sm" href="<?php echo baseUrl;?>/Admin/deleteMessage/<?php echo $value['id'];?>" 
                                                style="margin-left:15px;"><i class="fa fa-trash"></i>&nbsp;&nbsp;
                                                Delete</a></td>
                                            </tr>
                                            <?php } } else { ?>
                                                <div class="card my-3" >
                                                    <div class="card-header" style="background:whitesmoke;">
                                                        <h5><i class="fa fa-list-alt fa-1x"></i>&nbsp;Message
                                                        </h5>
                                                    </div>
                                                    <div class="card-body">
                                                    <h4>There are No Messages.</h4>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                            </div>     
                        </div>
                    </div>
                </main>
 <?php $this->view("fragments/footer"); ?>            
               