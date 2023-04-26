<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    
                    <a class="nav-link" href="<?php echo baseUrl; ?>/Dashboard">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-2x"></i></div>
                        Dashboard
                    </a>
                    
                    <a class="nav-link" href="<?php echo baseUrl;?>/Page">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns fa-2x"></i></div>
                        Pages
                    </a>

                    <a class="nav-link" href="<?php echo baseUrl;?>/Post">
                        <div class="sb-nav-link-icon"><i class="far fa-sticky-note fa-2x"></i></div>
                        Posts
                    </a>

                    <a class="nav-link" href="<?php echo baseUrl;?>/Category">
                        <div class="sb-nav-link-icon"><i class="fa fa-list-alt fa-2x"></i></div>
                        Categories
                    </a>
                                                
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAppearance" aria-expanded="false" aria-controls="collapseAppearance">
                        <div class="sb-nav-link-icon"><i class="fas fa-eye fa-2x"></i></div>
                        Appearance
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseAppearance" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="">Widgets</a>
                            <a class="nav-link" href="">Background</a>
                            <a class="nav-link" href="<?php echo baseUrl;?>/Appearance/getTemplate">Templates</a>
                        </nav>
                    </div>
                    <?php if($this->getSession('userRole') == 'Admin') { ?>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="false" aria-controls="collapseUsers">
                        <div class="sb-nav-link-icon"><i class="fa fa-users fa-2x"></i></i></div>
                        Users
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseUsers" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?php echo baseUrl;?>/Admin/userPanel">All Users</a>
                            <a class="nav-link" href="<?php echo baseUrl;?>/Admin/addUser">Add New</a>
                            <a class="nav-link" href="<?php echo baseUrl;?>/Profile/<?php echo $this->getSession('userId');?>">Profile</a>
                        </nav>
                    </div>
                    
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTools" aria-expanded="false" aria-controls="collapseTools">
                        <div class="sb-nav-link-icon"><i class="fas fa-tools fa-2x"></i></div>
                        Tools
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseTools" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?php echo baseUrl;?>/admin/toolsImportView">Import</a>
                            <a class="nav-link" href="<?php echo baseUrl;?>/admin/toolsExportView">Export</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings" aria-expanded="false" aria-controls="collapseSettings">
                        <div class="sb-nav-link-icon"><i class="fas fa-cog fa-2x"></i></div>
                        Settings
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseSettings" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?php echo baseUrl; ?>/admin/generalSettings">General</a>
                            <a class="nav-link" href="<?php echo baseUrl; ?>/admin/readingSettings">Reading</a>
                            <a class="nav-link" href="<?php echo baseUrl; ?>/admin/writingSettings">Writing</a>
                            <a class="nav-link" href="<?php echo baseUrl; ?>/admin/mediaSettings">Media</a>
                        </nav> 
                    </div>
                    <a class="nav-link" href="<?php echo baseUrl;?>/Admin/messagePanel">
                        <div class="sb-nav-link-icon"><i class="fas fa-envelope-open-text fa-2x"></i></div>
                        Messages
                    </a>
                    <?php } else { ?>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="false" aria-controls="collapseUsers">
                        <div class="sb-nav-link-icon"><i class="fa fa-users fa-2x"></i></i></div>
                        Users
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseUsers" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?php echo baseUrl;?>/Profile/<?php echo $this->getSession('userId');?>">Profile</a>
                        </nav>
                    </div>
                    <?php } ?>
                    
                    
                </div>
            </div>
            <div class="sb-sidenav-footer" style="background:#282D3C;color:white;">
                <div class="small">Logged in as:</div>
                <?php echo $this->getSession('userRole'); ?>
            </div>
        </nav>
    </div>