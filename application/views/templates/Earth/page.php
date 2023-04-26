<!-- Head -->
<?php echo $this->view($data['fragments']['header'], $data);?>
<!-- Navigation -->
<?php echo $this->view($data['fragments']['nav'], $data);?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

        <!-- Page Content Column -->
        <div class="col-lg-8">

        <?php
          if (!empty($data['page'])) {
              $singlePage = $data['page'][0];
              // print_r($singlePost);?>

        <!-- Title -->
        <h1 class="mt-4"><?php echo $singlePage['page_title']; ?></h1>
        <?php if(!empty($singlePage['page_image'])) {?>
        <div class="text-center">
            <img class="img-fluid rounded" style="max-width:auto; height:auto;" src="<?php echo baseUrl; ?>/assets/system/back/img/<?php echo $singlePage['page_image']; ?>" alt="image">
        </div>
        <hr>
        <?php
          } ?>
        <!-- Post Content -->
        <p class="lead">
            <?php echo $singlePage['page_content'];?>
        </p>
        <?php
          } ?>
        
      </div>

      <!-- Sidebar Widgets Column -->
      <?php echo $this->view($data['fragments']['sidebar'], $data);?>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
  </div>
  <hr />
  <!-- Footer -->
  <?php echo $this->view($data['fragments']['footer']);?>
