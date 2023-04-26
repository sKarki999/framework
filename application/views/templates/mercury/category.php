<!-- Head -->
<?php echo $this->view($data['fragments']['header'], $data);?>
<!-- Navigation -->
<?php echo $this->view($data['fragments']['nav'], $data);?>


    <div class="callout large primary" style="background:darkseagreen;">
      <div class="row column text-center">
        <h1>Category</h1>
      </div>
    </div>

    <article class="grid-container">
        <div class="grid-x grid-margin-x" id="content">
          <div class="medium-9 cell">
            
            <?php 
              if(!empty($data['categorizedPosts'])) {
              foreach ($data['categorizedPosts'] as $post) {
                  $post = Template::getPost($post);
            ?>

            <div class="blog-post">
              <h3><a href="<?php echo baseUrl;?>/Site/post/<?php echo $post['post_id'];?>"><?php echo $post['post_title'];?> </a>
                  <small><?php echo $post['post_date'];?></small>
              </h3>
              <img class="thumbnail" src="<?php echo baseUrl; ?>/assets/system/back/img/<?php echo $post['post_image'];?>">
              <div class="callout">
                <?php echo substr($post['post_content'], 0, 20) ;?>
              </div>
                <div class="callout">
                  <p><?php echo 'Author: ' . $post['post_author']; ?></p>
                  <p><?php echo 'Tags: ' . $post['meta_tags']; ?></p>
                </div>
            </div>
            <?php
              } 
                } else { ?>
                  <h1><a href="" style="color:red;"><?php echo SITE_NAME;?></a></h1>
                  <p class="site-description text-muted">Just another Orion site</p>
                <div>
                    <header>
                      <h1>Nothing Found</h1>
                    </header>
                      <div>
                        <p>Ready to publish your first post ?</p>	
                      </div>
                  <a href="<?php echo baseUrl;?>/Post/addPost" class="button" style="background:#9BB7D4;color:black;">Get started !!!&nbsp;<i class="fas fa-plus"></i></a>
                </div>
            <?php } ?>
          </div>
          <?php echo $this->view($data['fragments']['sidebar'], $data);?>
        </div>
    </article>

  <!-- Footer -->
  <?php echo $this->view($data['fragments']['footer']);?>