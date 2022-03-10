<?php
function misha_my_load_more_scripts() {
 
    global $wp_query; 
 
    // In most cases it is already included on the page and this line can be removed
    wp_enqueue_script('jquery');
 
    // register our main script but do not enqueue it yet
    wp_register_script( 'my_loadmore', get_stylesheet_directory_uri() . '/assets/js/load-more.js', array('jquery') );
 
    // now the most interesting part
    // we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
    // you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
    wp_localize_script( 'my_loadmore', 'misha_loadmore_params', array(
        'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
        'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
        'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		 
        'max_page' => $wp_query->max_num_pages
    ) );
 
    wp_enqueue_script( 'my_loadmore' );
}
 
add_action( 'wp_enqueue_scripts', 'misha_my_load_more_scripts' );

function misha_loadmore_ajax_handler(){
 
    // prepare our arguments for the query
    $args = json_decode( stripslashes( $_POST['query'] ), true );
    $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
   
    $args['post_status'] = 'publish';
 
    // it is always better to use WP_Query but not here
    query_posts( $args );
 
    if( have_posts() ) :
 
        // run the loop
        while( have_posts() ): the_post(); 

$category_array = array();
      
    $post_categories = get_the_category ( get_the_ID() );
    
    if ( !empty ( $post_categories ) ){
        
       foreach ( $post_categories as $post_category ) {
          $category_array[] = $post_category->term_id;
          
        }
          
    }
    //Checks if post has an additional category
    $result = array_diff( $category_array,  $category_list   );

    if ( empty ( $result ) ) { 
     
            $termsw = get_the_terms(get_the_ID() , 'services' );
             $subterms = get_the_terms(get_the_ID() , 'services' );
		     $length = count($subterms);
             $counter = 1; 
			 $catname = array();
		  foreach($subterms as $term) {
				  $names =  isset($term->slug) ? $term->slug : '';
				  $names1 =  ($counter != $length) ? PHP_EOL : ''; 
				  $counter++;
				  $catname[] = $names.' ';
			  }	
		
		 $name= implode($catname);
	  
            // look into your theme code how the posts are inserted, but you can use your own HTML of course
            // do you remember? - my example is adapted for Twenty Seventeen theme
            //get_template_part( 'template-parts/post/content', get_post_format() );
            // for the test purposes comment the line above and uncomment the below one ?>


            <div class="filterGalleryGrid all <?php echo $counter.' '. $name ; /* echo out counter */ ?>">
                <div class="filterGalleryInner">
                     <div class="img">
                        <a href="<?php the_permalink(); ?>">
                            <?php 
             if ( has_post_thumbnail() ){
                 echo get_the_post_thumbnail();
             } else { ?>
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-no-image.svg" alt="">
             <?php }
             //Put your default icon code here 
             ?>
             <h4><?php the_title(); ?></h4>
      </a>
            </div>
            </div> </div>
 
 <?php  }
        endwhile;
 
    endif;
    die; // here we exit the script and even no wp_reset_query() required!
}
 
 
 
add_action('wp_ajax_loadmore', 'misha_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'misha_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}