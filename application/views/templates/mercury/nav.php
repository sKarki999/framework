    <!-- Start Top Bar -->
    <div class="top-bar" style="background:darkkhaki;">
      <div class="top-bar-left">
        <ul class="menu" style="background:darkkhaki;">
          <li class="menu-text"><a href="<?php echo baseUrl;?>/Site" style="color:black;"><?php echo $data['settings']['site_title'];?></a>
        </ul>
      </div>
      <div class="top-bar-right" >
        <ul class="menu" style="background:darkkhaki;">
          <?php 
              foreach ($data['pages'] as $page) {
                  ?>
          <li><a href="<?php echo baseUrl;?>/Site/page/<?php echo $page['page_id'];?>" style="color:black;"><?php echo $page['page_title'];?></a></li>
        <?php } ?>
        <li><a href="<?php echo baseUrl;?>/Site/contactUs" style="color:black;">Contact Us</a></li>
        </ul>
      </div>
    </div>
    <!-- End Top Bar -->
