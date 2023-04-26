<!-- Head -->
<?php echo $this->view($data['fragments']['header'], $data);?>
<!-- Navigation -->
<?php echo $this->view($data['fragments']['nav'], $data);?>
  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

        <?php 

          if(!empty($data['post'])) {
            $post = $data['post'][0];
            // print_r($singlePost);
        ?>
        <h1 class="my-4"> <?php echo $post['cat_title']; ?>
          <!-- <small>Secondary Text</small> -->
        </h1>
          
          <!-- Blog Post -->
          <div class="card mb-4">
            <img class="img-responsive" src= "<?php echo baseUrl; ?>/assets/system/back/img/<?php echo $post['post_image']; ?>" alt="cms">
            <div class="card-body" style="max-width: auto;">
              <h2 class="card-title"><?php echo $post['post_title'];?></h2>
              <p class="card-text"><?php echo $post['post_content']; ?></p>
            </div>
            <div class="card-footer text-muted">
              Posted on <?php echo $post['post_date']; ?> by
              <a href="#"><?php echo $post['post_author']; ?></a>
            </div>
          </div>
            <?php 
            } else {
               echo "<div class='card-body'><h1> Post not found.</h1></div>";
            } ?>


      </div>

      <!-- Sidebar Widgets Column -->
      <?php echo $this->view($data['fragments']['sidebar'], $data);?>
      
      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <?php echo $this->view($data['fragments']['footer']);?>            
