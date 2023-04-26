 <!-- Head -->
<?php echo $this->view($data['fragments']['header'], $data);?>
<!-- Nav -->
<?php echo $this->view($data['fragments']['nav'], $data);?>

    <div class="callout large primary" style="background:darkseagreen;">
      <div class="text-center">
        <h1><a href="<?php echo baseUrl;?>/Site" style="color:black;">Home</a>
        <?php $date = $data['settings']['date_format'] . ' ' .$data['settings']['time_format'];
          echo '<span style="color:white;font-size:20px;color:black;">' . date($date)."<br>". '</span>'; ?>
          </li>
        </h1>
      </div>
    </div>
    
    <article class="grid-container">
        <div class="grid-x grid-margin-x" id="content">
          <div class="medium-9 cell">
            
            <?php 
              if(!empty($data['posts'])) {
              foreach ($data['posts'] as $post) {
              $post = Template::getPost($post);
            ?>

            <div class="blog-post">
              <h3><a href="<?php echo baseUrl;?>/Site/post/<?php echo $post['post_id'];?>"><?php echo $post['post_title'];?> </a>
              <small><?php echo $post['post_date'];?></small></h3>
              <img class="thumbnail" style="width:100%; height:auto;" src="<?php echo baseUrl; ?>/assets/system/back/img/<?php echo $post['post_image'];?>">
              <div class="callout">
              <?php echo substr($post['post_content'], 0, 50) ;?>
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
    
        <div class="row column">

        <?php if (isset($data['pageCount']) && $data['pageCount'] > 1 && !empty($data['posts'])) { ?>
          <ul class="pagination" role="navigation" aria-label="Pagination">
            
            <?php if ($data['currentPage'] > 1) { ?>
            <li class="">
              <a href="<?php echo baseUrl;?>/Site/<?php echo $data['currentPage']-1;?>/<?php echo $data['settings']['blogsPerPage'];?>" >Previous</a>
            </li>
            <?php } ?>

            <?php for ($i=1; $i<=$data['pageCount']; $i++) {
                    $class = ($i == $data['currentPage']) ? 'current' : ''; ?>
            <!-- <li class="current">1</li> -->
            
            <li class="<?php echo $class?>">
              <a href="<?php echo baseUrl; ?>/Site/<?php echo $i; ?>/<?php echo $data['settings']['blogsPerPage'];?>">
                <?php echo $i; ?>
              </a>
            </li>
          
            <?php } ?>
            <?php if ($data['currentPage'] < $data['pageCount']) { ?>
            <li>
              <a href="<?php echo baseUrl;?>/Site/<?php echo $data['currentPage']+1; ?>/<?php echo $data['settings']['blogsPerPage'];?>">Next</a>
            </li>
            <?php } ?>
          </ul>
        <?php } ?>
        </div>

    </article>


<!-- Footer -->
<?php echo $this->view($data['fragments']['footer']);?>