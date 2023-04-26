<!-- Head -->
<?php echo $this->view($data['fragments']['header'], $data);?>
<!-- Navigation -->
<?php echo $this->view($data['fragments']['nav'], $data);?>

    <?php 
        if(!empty($data['post'])) {
        $post = $data['post'][0];
        // print_r($singlePost);
    ?>
  <!-- Page Header -->
  <header class="masthead" style="background-image: url('<?php echo baseUrl;?>/assets/system/back/img/<?php echo $post['post_image'];?>')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1><?php echo $post['post_title']; ?></h1>
            <h2 class="subheading"><?php echo $post['cat_title'];?></h2>
            <span class="meta">Posted by
              <a href="#"><?php echo $post['post_author'];?></a>
              on August 24, 2019</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <?php echo $post['post_content'];?>
        </div>
      </div>
    </div>
  </article>
    <?php 
    } else { ?>
        <div class="card my-4 ml-5 mr-5">
            <div class="card-body">
              <div class="site-branding my-4">
                  <div class="site-branding-inner">
                      <div class="site-branding-text">
                            <h1><a href="" style="color:red;"><?php echo SITE_NAME;?></a></h1>
                              <p class="site-description text-muted">Just another Orion site</p>
                      </div>
                  </div>
                </div>
            </div>
            <div class="card-body">
              <section class="no-results not-found">
                <header class="page-header">
                  <h1 class="page-title my-1">Nothing Found</h1>
                </header><!-- .page-header -->
                  <div class="page-content my-4">
                    <p class="text-primary" >Ready to publish your first post ?</p>	
                  </div><!-- .page-content -->
              </section><!-- .no-results -->
              <a href="<?php echo baseUrl;?>/Post/addPost" class="btn" style="background:#9BB7D4;">Get started !!!&nbsp;<i class="fas fa-plus"></i></a>
          </div>
        </div>
      <?php } ?>
      </div>
    </div>
  </div>

  <hr>

   <!-- Footer -->
   <?php echo $this->view($data['fragments']['footer']);?>
