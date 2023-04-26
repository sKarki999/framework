<nav class="sb-topnav navbar navbar-expand navbar-dark bg-navy">
    <a class="navbar-brand" href="javascript:"><h4>CMS</h4></a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <div class="input-group-append">
            </div>
        </div>
    </div>
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item active"><a class="nav-link" href="#"><?php echo $this->getSession('username'); ?></a></li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo baseUrl;?>/Profile/<?php echo $this->getSession('userId');?>"><i class="fa fa-fw fa-user"></i>&nbsp;Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo baseUrl;?>/Account/logout"><i class="fa fa-fw fa-power-off"></i>&nbsp;Logout</a>
            </div>
        </li>
    </ul>
</nav>