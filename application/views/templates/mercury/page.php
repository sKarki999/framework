<!-- Head -->
<?php echo $this->view($data['fragments']['header'], $data);?>
<!-- Navigation -->
<?php echo $this->view($data['fragments']['nav'], $data);?>

      <?php
          if (!empty($data['page'])) {
              $singlePage = $data['page'][0];
              // print_r($singlePost);?>

    <div class="callout large primary" style="background:darkseagreen;">
      <div class="row column text-center">
        <h1><?php echo $singlePage['page_title']; ?></h1>
      </div>
    </div>
    <?php } ?>

    
    <article class="grid-container">
        <div class="grid-x grid-margin-x" id="content">
          <div class="medium-12 cell">
            <?php 
              if (!empty($data['page'])) {
                $singlePage = $data['page'][0];
            ?>

            <div class="blog-post">
              <div class="callout">
              <?php echo $singlePage['page_content'];?>
              </div>
                
            </div>
            <?php
                } else {
                echo "<div class='card-body'><h1> Posts not found.</h1></div>";
              } ?>
          
          </div>
          <?php //echo $this->view($data['fragments']['sidebar'], $data);?>
        </div>
    
        
    </article>
    
  
  <!-- Footer -->
  <?php echo $this->view($data['fragments']['footer']);?>