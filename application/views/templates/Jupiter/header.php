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
  <link href="<?php echo baseUrl;?>/assets/jupiter/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="<?php echo baseUrl;?>/assets/jupiter/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="<?php echo baseUrl;?>/assets/jupiter/css/clean-blog.min.css" rel="stylesheet">

</head>
<body>