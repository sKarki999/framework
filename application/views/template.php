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
                        <?php
                            echo $this->getFlash('templateDel', 'alert-success');
                            echo $this->getFlash('fileUpload', 'alert-success');
                            $currentTemplate = $data['currentTemplate'][0];
                            //print_r($currentTemplate);
                            ?>
                            <div class="card-deck mt-2">
                                <div class="card my-2">
                                    <div class="card-header" style="background:whitesmoke;color:dark;">
                                        <h5><i class="fa fa-file fa-2x"></i>&nbsp;&nbsp;Available Templates&nbsp;&nbsp;
                                        <span class="float-right">
                                        <a href="<?php echo baseUrl; ?>/Appearance/addTemplate" class="btn" style="background:#D8BFD8;">Add New&nbsp;<i class="fas fa-plus"></i></a>
                                        </span>
                                        </h5>
                                    </div>
                                    
                                    <div class="row">
                                        <?php if (!empty($data['templates'])) {
                                            foreach ($data['templates'] as $template) {
                                        ?>
                                        <div class="col-sm-4">
                                            <div class="card mt-3 mb-2">
                                                <div class="card-header">
                                                    <h6><?php echo $template['template_name'];?>
                                                    <?php if ($template['template_name'] !== 'Earth') { ?>
                                                    <span class="float-right">
                                                    <a id="confirmDeletion" href="<?php echo baseUrl; ?>/Appearance/deleteTemplate/<?php echo $template['id'];?>" class="btn btn-secondary btn-sm">Delete&nbsp;<i class="fa fa-trash"></i></a>
                                                    </span>
                                                    <?php } ?>
                                                    </h6>
                                                </div>
                                                <div class="card-body">
                                                <?php if(isset($template['template_description'])) {?>
                                                <h6 style="color:blue;">Description</h6>
                                                    <p class="card-text">
                                                        <?php echo $template['template_description']; } ?>
                                                    </p>
                                                    <h6 class="card-subtitle mb-2 text-muted">
                                                    <span style="color:green;">
                                                        <?php if ($template['template_name'] == $currentTemplate['current_template']) {
                                                            echo 'Activated'; ?>
                                                        <a href="<?php echo baseUrl; ?>/Site" class="btn btn-sm" style="background:#D8BFD8;" target="_blank">Visit Site</a>
                                                        <?php
                                                        } ?>
                                                    </span>
                                                    </h6>
                                                    <?php if ($template['template_name'] !== $currentTemplate['current_template']) { ?>
                                                    <a href="<?php echo baseUrl;?>/Appearance/setCurrentTemplate/<?php echo $template['template_name'];?>" class="btn btn-sm" style="background:#D8BFD8;">Activate</a>
                                                    <?php } ?>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <?php
                                                }
                                            } else {
                                                echo "<div class='card-body'><h3> Templates not found.</h3></div>";
                                            }
                                                
                                        ?>
                                    </div>
                                </div>
                            </div>
                    </div>
                </main>
 <?php $this->view("fragments/footer"); ?>               
               