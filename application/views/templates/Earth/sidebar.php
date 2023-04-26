<div class="col-md-4">
        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
            <form action="<?php echo baseUrl; ?>/Site/searchPost" method="post">
              <div class="input-group">
                <input type="text" class="form-control" name="search" id="search" placeholder="Search for..."
                value="<?php echo isset($data['search']) ? $data['search'] : '';?>" />
                <span class="input-group-append">
                  <button class="btn btn-secondary" type="submit" id="searchButton">Go!</button>
                </span>
              </div>
            </form>
          </div>
        </div>
        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">Categories</h5>
          <div class="card-body">
            <div class="row">
              
              <div class="col-lg-6">
              <?php 
                    if (!empty($data['categories'])) {
                        foreach ($data['categories'] as $category) {
                            ?>
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="<?php echo baseUrl; ?>/Site/category/<?php echo $category['cat_id']; ?>"><?php echo $category['cat_title']; ?></a>
                  </li>
                </ul>
              </div>
            
              <div class="col-lg-6">
                <?php
                        }
                    } else { ?>
                          No categories.
                <?php }?>       
              </div>
            </div>
          </div>
        </div>
        
        <!-- Side Widget -->
        <div class="card my-4">
          <h5 class="card-header">Side Widget</h5>
          <div class="card-body">
            Add some cool widget here...
          </div>
        </div>