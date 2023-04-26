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

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
      <?php 
          if(!empty($data['searchedPosts'])) {
          foreach ($data['searchedPosts'] as $post) {
            $post = Template::getPost($post);
        ?>
        <div class="post-preview">
          <a href="<?php echo baseUrl; ?>/Site/post/<?php echo $post['post_id']; ?>">
            <h2 class="post-title">
              <?php echo $post['post_title']; ?>
            </h2>
          </a>
          <a href="<?php echo baseUrl;?>/Site/category/<?php echo $post['post_category_id'];?>">
            <h5 class="post-subtitle">
              <?php echo $post['cat_title'];?>
            </h5>
          </a>
          <p class="card-text">
          <?php 
              $summary = explode('.', $post['post_content']);
              echo $summary[0] . '......';
          ?>
          </p>
          <p class="post-meta">Posted by
            <a href="#"><?php echo $post['post_author']; ?></a>
            <?php echo $post['post_date']; ?></p>
        </div>
        <hr>
        <?php
          } 
            } else { ?>
              <div class="card my-4 ml-5 mr-5">
                <div class="card-body">
                  <section class="no-results not-found">
                    <header class="page-header">
                      <h1 class="page-title my-1">Nothing Found</h1>
                    </header><!-- .page-header -->
                      <div class="page-content my-4">
                        <p class="text-primary" >Search again</p>	
                      </div><!-- .page-content -->
                  </section><!-- .no-results -->
              </div>
            </div>
            <?php } ?>
      <!-- Pagination -->
      <?php if (isset($data['pageCount']) && $data['pageCount'] > 1 && !empty($data['searchedPosts'])) { ?>
            <ul class="pagination justify-content-center mb-5">
                <?php if ($data['currentPage'] > 1) { ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo baseUrl;?>/Site/searchPost/<?php echo $data['currentPage']-1;?>/<?php echo $data['search'];?>" >Previous</a>
                </li>
                <?php } ?>
                <?php for ($i=1; $i<=$data['pageCount']; $i++) {
                    $class = ($i == $data['currentPage']) ? 'active' : ''; ?>
                    <li class="page-item <?php echo $class?>">
                        <a class="page-link " href="<?php echo baseUrl; ?>/Site/searchPost/<?php echo $i; ?>/<?php echo $data['search'];?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php
                        } ?>  
                <?php if ($data['currentPage'] < $data['pageCount']) { ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo baseUrl;?>/Site/searchPost/<?php echo $data['currentPage']+1; ?>/<?php echo $data['search'];?>">Next</a>
                </li>
                <?php } ?>
            </ul>
        <?php } ?>


      </div>
    </div>
  </div>

  <hr>

   <!-- Footer -->
   <?php echo $this->view($data['fragments']['footer']);?>
