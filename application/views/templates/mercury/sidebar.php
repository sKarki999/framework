<div class="medium-3 cell" data-sticky-container>
            <div class="sticky" data-sticky data-anchor="content">
              <h4>Categories</h4>
        <ul>
            <?php foreach($data['categories'] as $category) {?>
            <li><a href="<?php echo baseUrl;?>/Site/category/<?php echo $category['cat_id']; ?>"><?php echo $category['cat_title']; ?></a>
            <?php } ?>
        </ul>
    </div>
</div>

