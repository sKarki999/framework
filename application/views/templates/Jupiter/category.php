<!-- Head -->
<?php echo $this->view($data['fragments']['header'], $data);?>
<!-- Navigation -->
<?php echo $this->view($data['fragments']['nav'], $data);?>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('<?php echo baseUrl; ?>/assets/template1/img/post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Blog</h1>
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
          if(!empty($data['categorizedPosts'])) {
          foreach ($data['categorizedPosts'] as $categorizedPost) {
              $post = Template::getPost($categorizedPost);
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
            <p class="card-text"><?php echo substr($post['post_content'], 0, 10) . ' ... '; ?></p>
          <p class="post-meta">Posted by
            <a href="#"><?php echo $post['post_author']; ?></a>
            <?php echo $post['post_date']; ?></p>
        </div>
        <hr>
        <?php
          } 
            } else {
              echo "<div class='card-body'><h1> Posts not found.</h1></div>";
            } ?>
      
      </div>
    </div>
  </div>

  <hr>
<!-- Footer -->
<?php echo $this->view($data['fragments']['footer']);?>