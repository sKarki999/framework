
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
      <?php 
        if(!empty($data['post'][0]['seo_title'])) {
          echo $data['post'][0]['seo_title'].' &#8212; '.$data['post'][0]['meta_description'];  
        } else {
          echo $data['settings']['site_title'].' &#8212; '.$data['settings']['site_tagline'];
        }
      ?>
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.2.3/motion-ui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation-prototype.min.css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css' rel='stylesheet' type='text/css'>
    <!-- optional CDN for Foundation Icons ^^ -->
  </head>
  <body>