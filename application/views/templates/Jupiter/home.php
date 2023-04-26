<!-- Head -->
<?php echo $this->view($data['fragments']['header'], $data);?>
<!-- Navigation -->
<?php echo $this->view($data['fragments']['nav'], $data);?>


  <!-- Page Header -->
  <header class="masthead" style="background-image: url('<?php echo baseUrl; ?>/assets/jupiter/img/Nepal.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1><?php echo SITE_NAME;?></h1>
            <span class="subheading"></span>
          </div>
        </div>
      </div>
    </div>
  </header>
  <?php if(!empty($data['posts'])) { ?>  
  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
      <?php 
          // if(!empty($data['posts'])) {
          foreach ($data['posts'] as $post) {
              $result = Template::getPost($post);
        ?>
        <div class="post-preview">
          <a href="<?php echo baseUrl; ?>/Site/post/<?php echo $result['post_id']; ?>">
            <h2 class="post-title">
              <?php echo $result['post_title']; ?>
            </h2>
          </a>
          <a href="<?php echo baseUrl;?>/Site/category/<?php echo $result['post_category_id'];?>">
            <h5 class="post-subtitle">
              <?php echo $result['cat_title'];?>
            </h5>
          </a>
            <p class="card-text">
            <?php 
              $summary = explode('.', $post['post_content']);
              echo $summary[0] . '......';
            ?>
            </p>
          <p class="post-meta">Posted by
            <a href="#"><?php echo $result['post_author']; ?></a>
            <?php echo $result['post_date']; ?></p>
        </div>
        <hr>
        <?php
          } 
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
      
        <!-- Pagination -->
        <?php if (isset($data['pageCount']) && $data['pageCount'] > 1 && !empty($data['posts'])) { ?>
            <ul class="pagination justify-content-center mb-5">
                <?php if ($data['currentPage'] > 1) { ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo baseUrl;?>/Site/<?php echo $data['currentPage']-1;?>" >Previous</a>
                </li>
                <?php } ?>
                <?php for ($i=1; $i<=$data['pageCount']; $i++) {
                    $class = ($i == $data['currentPage']) ? 'active' : ''; ?>
                    <li class="page-item <?php echo $class?>">
                        <a class="page-link " href="<?php echo baseUrl; ?>/Site/<?php echo $i; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php
                        } ?>  
                <?php if ($data['currentPage'] < $data['pageCount']) { ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo baseUrl;?>/Site/<?php echo $data['currentPage']+1; ?>">Next</a>
                </li>
                <?php } ?>
            </ul>
        <?php } ?>
      </div>
    </div>
  </div>

  <hr>

   <!-- Footer -->
   <?php 
    if(!empty($data['posts'])) {
    echo $this->view($data['fragments']['footer']);
    }
  ?>