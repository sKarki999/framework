<!-- Head -->
<?php echo $this->view($data['fragments']['header'], $data);?>
<!-- Navigation -->
<?php echo $this->view($data['fragments']['nav'], $data);?>
<?php echo $this->getFLash('msgSuccess', 'alert-success');?>

    <div class="callout large primary" style="background:darkseagreen;">
      <div class="row column text-center">
        <h1><?php echo 'Contact Us'; ?></h1>
      </div>
    </div>

    <article class="grid-container">
        <div class="grid-x grid-margin-x" id="content">
          <div class="medium-12 cell">
                <div class="col-lg-8 col-md-10 mx-auto">
                <p>Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
                <form method="post" action="<?php echo baseUrl;?>/Site/saveContactMessage">
                  <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                    <label><h5 class="required">Full Name</h5></label>
                    <input type="text" class="form-control" name="fullname" 
                      value="<?php echo (isset($data['fullname'])) ? $data['fullname'] : '' ;
                      ?>" />
                      <div style="color:red;">
                      <?php echo (!empty($this->error['fullname'])) ? $this->error['fullname'] : '';
                      ?>
                      </div>
                    </div>
                  </div>
                  <br/>
                  <div class="form-group">
                    <label><h5 class="required">Email Address</h5></label>
                    <input type="email" class="form-control" name="email"
                    value="<?php echo (isset($data['email'])) ? $data['email'] : '' ;
                      ?>" />
                      <div style="color:red;">
                          <?php echo (!empty($this->error['email'])) ? $this->error['email'] : '';
                          ?>
                      </div>
                  </div>
                  <br />
                  <div class="form-group">
                    <label><h5 class="required">Message</h5></label>
                    <textarea rows="5" class="form-control" name="message"><?php if(isset($data['message'])) {echo $data['message'];}?></textarea>
                    <div style="color:red;">
                        <?php 
                          echo (!empty($this->error['message'])) ? $this->error['message'] : '';
                        ?>
                    </div>
                  </div>
                  <br>
                  <div id="success"></div>
                  <button type="submit" class="button">Send</button>
                </form>
              </div>
          </div>
        </div>
    </article>

  <!-- Footer -->
  <?php echo $this->view($data['fragments']['footer']);?>