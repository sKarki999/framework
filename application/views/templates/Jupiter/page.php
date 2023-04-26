<!-- Head -->
<?php echo $this->view($data['fragments']['header'], $data);?>
<!-- Navigation -->
<?php echo $this->view($data['fragments']['nav'], $data);?>


<?php
    if (!empty($data['page'])) {
        $page = $data['page'][0];
        // print_r($singlePost);
?>  

<!-- Page Header -->
<header class="masthead" style="background-image: url('<?php echo baseUrl;?>/assets/system/back/img/<?php echo $page['page_image'];?>')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            
          <div class="page-heading">
            <h1><?php echo $page['page_title']; ?></h1>
          </div>

        
        </div>
      </div>
    </div>
  </header>

<!-- Main Content -->
<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <p><?php echo $page['page_content'];?></p>
      </div>
    </div>
  </div>
<?php
    } ?>
  <hr>
<!-- Footer -->
<?php echo $this->view($data['fragments']['footer']);?>