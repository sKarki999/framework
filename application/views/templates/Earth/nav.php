<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="<?php echo baseUrl;?>/Site">
      <?php echo $data['settings']['site_title'];?></a>
        <?php 
          echo '<span style="color:white;">' . date("F j, Y")."<br>". '</span>';
          // $date = $data['settings']['date_format'] . ' ' .$data['settings']['time_format'];
          // echo '<span style="color:white;">' . date($date)."<br>". '</span>';
        ?>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo baseUrl; ?>/Site">Home</a>
          </li>
          <?php 
              if (!empty($data['pages'])) {
                  foreach ($data['pages'] as $page) {
                      ?>
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo baseUrl; ?>/Site/page/<?php echo $page['page_id']; ?>"><?php echo $page['page_title']; ?>
              <span class="sr-only">(current)</span>
            </a>
            
          </li>
          <?php
                  }
              }?>
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo baseUrl; ?>/Site/contactUs">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
