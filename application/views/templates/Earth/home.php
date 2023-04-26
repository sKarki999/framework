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
          if(!empty($data['posts'])) {
          foreach ($data['posts'] as $post) {
              $result = Template::getPost($post);
        ?>
        
        <h1 class="my-4"> <?php echo $result['cat_title']; ?>
          <!-- <small>Secondary Text</small> -->
        </h1>
          
          <!-- Blog Post -->
          <div class="card mb-4">
          <a href="<?php echo baseUrl; ?>/Site/post/<?php echo $result['post_id']; ?>"><img class="img-responsive" src= "<?php echo baseUrl; ?>/assets/system/back/img/<?php echo $result['post_image'];?>" alt="image"></a>
            <div class="card-body">
              <h2 class="card-title"><a href="<?php echo baseUrl; ?>/Site/post/<?php echo $result['post_id']; ?>"><?php echo $result['post_title']; ?></a></h2>
              <p class="card-text">
                <?php
                    echo substr($post['post_content'], 0, 50) . '...';
                  ?>
              </p>
              <a href="<?php echo baseUrl; ?>/Site/post/<?php echo $result['post_id']; ?>" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Posted on <?php echo $result['post_date']; ?> by
              <?php echo '<span style="color:red;">' . $result['post_author'] . '</span>';?>
            </div>
          </div>

          <?php
          } 
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
                        <p class="text-primary" >Ready to publish your first post ?</p>	
                      </div><!-- .page-content -->
                  </section><!-- .no-results -->
                  <a href="<?php echo baseUrl;?>/Post/addPost" class="btn" style="background:#9BB7D4;">Get started !!!&nbsp;<i class="fas fa-plus"></i></a>
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
  <!-- /.container -->

  <!-- Footer -->
  <?php 
    echo $this->view($data['fragments']['footer']);
  ?>
