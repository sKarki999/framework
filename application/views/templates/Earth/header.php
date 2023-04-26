<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>
  <?php 
    if(!empty($data['post'][0]['seo_title'])) {
      echo $data['post'][0]['seo_title'].' &#8212; '.$data['post'][0]['meta_description'];  
    } else {
      echo $data['settings']['site_title'].' &#8212; '.$data['settings']['site_tagline'];
    }
  ?>
  </title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo baseUrl; ?>/assets/system/front/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Custom styles for this template -->
  <link href="<?php echo baseUrl; ?>/assets/system/front/css/blog-home.css" rel="stylesheet">

</head>

<body>
