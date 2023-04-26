<?php 

class Template {
    
    // method to return fragments of the given template 
    public static function getFragements($template) {
        return [
                'header'        => 'templates/'.$template.'/header',
                'nav'           => 'templates/'.$template.'/nav',
                'sidebar'       => 'templates/'.$template.'/sidebar',
                'footer'        => 'templates/'.$template.'/footer',
                'home'          => 'templates/'.$template.'/home',
                'search'        => 'templates/'.$template.'/search',
                'post'          => 'templates/'.$template.'/post',
                'category'      => 'templates/'.$template.'/category',
                'page'          => 'templates/'.$template.'/page',
                'contact'       => 'templates/'.$template.'/contact'
        ];
    }

    public static function getPost($post) {
        // get all fields of the post and return
        $data = array(
            'post_id'           => $post['post_id'],
            'post_title'        => $post['post_title'],
            'post_image'        => $post['post_image'],
            'post_author'       => $post['post_author'],
            'post_content'      => $post['post_content'],
            'post_date'         => $post['post_date'],
            'meta_tags'         => $post['meta_tags'],
            'seo_title'         => $post['seo_title'],
            'meta_description'  => $post['meta_description'],
            'post_category_id'  => $post['post_category_id'],
            'cat_title'         => $post['cat_title']
        );
        return $data;
    }
}
?>