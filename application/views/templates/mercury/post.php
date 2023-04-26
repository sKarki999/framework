<!-- Head -->
<?php echo $this->view($data['fragments']['header'], $data);?>
<!-- Navigation -->
<?php echo $this->view($data['fragments']['nav'], $data);?>


    <div class="callout large primary" style="background:darkseagreen;">
      <div class="row column text-center">
        <h1>Post</h1>
      </div>
    </div>

    <article class="grid-container">
        <div class="grid-x grid-margin-x" id="content">
          <div class="medium-9 cell">
            
            <?php 
              if(!empty($data['post'])) {
              $post = $data['post'][0];
              // print_r($singlePost);
            ?>

            <div class="blog-post">
              <h2><?php echo $post['post_title'];?>
              <small><?php echo $post['post_date'];?></small></h2>
              <img class="thumbnail" src="<?php echo baseUrl; ?>/assets/system/back/img/<?php echo $post['post_image'];?>">
              <div class="callout">
              <?php echo $post['post_content'];?>
              </div>
                <div class="callout">
                  <p><?php echo 'Author: ' . $post['post_author']; ?></p>
                  <p><?php echo 'Tags: ' . $post['meta_tags']; ?></p>
                </div>
            </div>
            <?php
                } else {
                echo "<div class='card-body'><h1> Posts not found.</h1></div>";
              } ?>
          
          </div>
          <?php echo $this->view($data['fragments']['sidebar'], $data);?>
        </div>
    
        
    </article>

  <!-- Footer -->
  <?php echo $this->view($data['fragments']['footer']);?>