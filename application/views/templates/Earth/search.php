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
          if(!empty($data['searchedPosts'])) {
          foreach ($data['searchedPosts'] as $post) {
              $post = Template::getPost($post);
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
                        <p class="text-primary" >Search again !!!</p>	
                      </div><!-- .page-content -->
                  </section><!-- .no-results -->
                </div>
              </div>
            <?php } ?>
      </div>

      <!-- Sidebar Widgets Column -->
      <?php echo $this->view($data['fragments']['sidebar'], $data);?>

      </div>

    </div>
    <!-- /.row -->

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
  <!-- /.container -->

  <!-- Footer -->
  <?php echo $this->view($data['fragments']['footer']);?>
