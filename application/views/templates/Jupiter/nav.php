<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="<?php echo baseUrl;?>/Site">Home</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            <?php
              if (!empty($data['pages'])) {
                  foreach ($data['pages'] as $page) {
                      ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo baseUrl; ?>/Site/page/<?php echo $page['page_id']; ?>"><?php echo $page['page_title']; ?></a>
          </li>
          <?php
                  } ?>
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo baseUrl; ?>/Site/contactUs">Contact</a>
          </li>
          <?php
              } else {
                echo '<span style="color:white;">' . date("F j, Y")."<br>". '</span>';
              }?>

          <form action="<?php echo baseUrl; ?>/Site/searchPost" method="post">
            <div class="form-outline">
                <input type="text" class="form-control" name="search" placeholder="search post .." />
            </div>
          </form>
        </ul>
      </div>
    </div>
  </nav>