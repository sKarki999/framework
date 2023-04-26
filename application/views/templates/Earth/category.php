<!-- header -->
<?php echo $this->view($data['fragments']['header'], $data);?>
<!-- Navigation -->
<?php echo $this->view($data['fragments']['nav'], $data);?>
  
  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

      <?php 
          if(!empty($data['categorizedPosts'])) {
          foreach ($data['categorizedPosts'] as $categorizedPost) {
              $post = Template::getPost($categorizedPost);
        ?>
        <h1 class="my-4"> <?php echo $post['cat_title']; ?>
          <!-- <small>Secondary Text</small> -->
        </h1>
          
          <!-- Blog Post -->
          <div class="card mb-4">
          <img class="img-responsive" style="max-width:730px; height:400px;" src= "<?php echo baseUrl; ?>/assets/system/back/img/<?php echo $post['post_image']; ?>" alt="image">
            <div class="card-body">
              <h2 class="card-title"><?php echo $post['post_title'];?></h2>
              <p class="card-text">
                <?php
                    $summary = explode('.', $post['post_content']);
                    echo $summary[0] . '......'; 
                  ?>
              </p>
              <a href="<?php echo baseUrl;?>/Site/post/<?php echo $post['post_id']; ?>" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Posted on <?php echo $post['post_date']; ?> by
              <a href="#"><?php echo $post['post_author']; ?></a>
            </div>
          </div>
            <?php } 
            } else { ?>
                <div class="site-branding my-4">
                <div class="site-branding-inner">
                    <div class="site-branding-text">
                          <h1><a href="" style="color:red;"><?php echo $data['settings']['site_title']; ?></a></h1>
                            <p class="site-description text-muted">Just another Orion site</p>
                    </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <section class="no-results not-found">
                    <header class="page-header">
                      <h1 class="page-title my-1">Nothing Found</h1>
                    </header><!-- .page-header -->
                      <div class="page-content my-4">
                        <p class="text-primary" >Add post for this category.</p>	
                      </div><!-- .page-content -->
                  </section><!-- .no-results -->
                  <a href="<?php echo baseUrl;?>/Post/addPost" class="btn" style="background:#9BB7D4;">Add New !!!&nbsp;<i class="fas fa-plus"></i></a>
                </div>
              </div>
            <?php } ?>
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
