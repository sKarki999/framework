<!-- Head -->
<?php echo $this->view($data['fragments']['header'], $data);?>
<!-- Navigation -->
<?php echo $this->view($data['fragments']['nav'], $data);?>

<?php $this->getFlash('msgSuccess', 'alert-success');?>
  <!-- Page Header -->
  <header class="masthead">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading my-4">
            <h1>Contact Us</h1>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <p>Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
        <form method="post" action="<?php echo baseUrl;?>/Site/saveContactMessage">
         
            <div class="form-group">
              <label><h5 class="required">Full Name</h5></label>
              <input type="text" class="form-control" name="fullname" 
                value="<?php echo (isset($data['fullname'])) ? $data['fullname'] : '' ;
                ?>" />
                <div class="text-danger h6 mt-1">
                    <?php echo (!empty($this->error['fullname'])) ? $this->error['fullname'] : '';
                    ?>
                </div>
            </div>
         
          
            <div class="form-group">
              <label><h5 class="required">Email Address</h5></label>
              <input type="email" class="form-control" name="email"
              value="<?php echo (isset($data['email'])) ? $data['email'] : '' ;
                ?>" />
                <div class="text-danger h6 mt-1">
                    <?php echo (!empty($this->error['email'])) ? $this->error['email'] : '';
                    ?>
                </div>
            </div>

          
            <div class="form-group">
              <label><h5 class="required">Message</h5></label>
              <textarea rows="5" class="form-control" name="message"><?php if(isset($data['message'])) {echo $data['message'];}?></textarea>
              <div class="text-danger h6 mt-1">
                  <?php 
                    echo (!empty($this->error['message'])) ? $this->error['message'] : '';
                  ?>
              </div>
            </div>
          
          <br>
          <button type="submit" class="btn btn-primary">Send</button>
        </form>
      </div>
    </div>
  </div>

  <hr>

   <!-- Footer -->
   <?php echo $this->view($data['fragments']['footer']);?>
