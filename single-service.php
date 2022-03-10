<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
 
    
  
?>
<?php if(ICL_LANGUAGE_CODE=='ar'){
	         $consultant_specility = 'استشاري' ;
		     $specialist_specility ='أخصائي';
		 }
		  else{
			   $consultant_specility = 'Consultant' ;
		       $specialist_specility ='Specialist';
			 } ?>
<?php $speciality1 = get_field('speciality1');
	  $speciality2 = get_field('speciality2');?>
    <section class="serviceSingleMain commonPY">
	<?php	$post_id = get_the_ID();
		  
                $categories = get_the_terms($post_id, 'services');
						 if( $categories ){
							 $parent = "";
                            
							 //display all the top-level categories first
							 foreach ($categories as $category) {
								 if( !$category->parent ){
									 $parent .= $category->term_id;
								 }
							 }if($parent == '116'|| $parent == '138' ){?>
								 
		 <img class="balloonCloud one" src="<?php echo site_url();?>/wp-content/uploads/2021/02/balloon-clouds1.png" alt="" />
        <img class="balloonCloud two" src="<?php echo site_url();?>/wp-content/uploads/2021/02/balloon-clouds2-1.png" alt="" />
        <img class="balloonCloud full" src="<?php echo site_url();?>/wp-content/uploads/2021/02/balloon-clouds-full.png" alt="" />
		<?php }
							 
							
							 //now, display all the child categories
						 }	 	?> 
		 
	 
<div class="container">
           <div class="row">


 <div class="col-md-3 singleServiceSidebar">
 
 
 
<?php
	 
// 	 $menu_array = wp_get_nav_menu_items('Primary');
 
// 	 echo'<pre>';
// 	 print_r($menu_array);
// 	  echo'</pre>';
 
	 	 
	 
$this_post = $post->ID;
//var_dump($this_post);  
$terms = get_the_terms( $post->ID , 'services' );

// 	
	  
	 
foreach ( $terms as $term ) {
    
	if ( ! empty( $term->parent) ) :
	 
    $args = array (
		     'posts_per_page'   =>-1,
                'post_type' => 'service',
		        'orderby' => 'menu_order', 
		        'order' => 'ASC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'services',
                        'field'    => 'slug',
                        'terms'    => $term->slug,
                    ),
                ),
            );
          
            // run the query
            $query = new WP_Query( $args ); 
            if( $query->have_posts() ) { 
				
	               ?>
                      <div class="singleServiceSidebarList">
<ul>

                <?php //echo '<h2>' . __( '', 'tutsplus' ) . '</h2>'; ?>
                    <?php while ( $query->have_posts() ) : $query->the_post(); 
                   ?>
                         <li><a <?php if( $this_post == $post->ID ) { echo ' class="active"'; } ?>href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
                      
                             
                        <?php endwhile; ?>
                         
                        <?php wp_reset_postdata(); ?>  
	        </ul>
                    </div>
            <?php }
            endif;
          }
/*
global $post;
$current_category = get_the_terms($post->ID, 'services');
$terms = get_the_terms( $post->ID , 'services' );
foreach ( $terms as $term ) {
//echo $term->name;


$same_category = new WP_Query(array(
    'cat'            => $term->name,
    //'post__not_in'   => array($post->ID),
    'post_type'        => 'service',
    'posts_per_page' => -1
));
//var_dump($current_category);
while ( $same_category->have_posts() ) : $same_category->the_post(); ?>
    <li>
        <div class="borderline">
            <a href="<?php //the_permalink(); ?>">
                <?php //the_title(); ?>
            </a>
        </div>
       
    </li>
<?php endwhile; 
}
 $category = get_the_terms( $post->ID, 'services' ); ?>
 <pre><?php //var_dump($category); ?>   </pre>  
 <?php
foreach ( $category as $cat){
  //var_dump($cat);
if ( ! empty( $cat->parent ) ) :
     //echo $cat->term_id;


endif;

}
*/       
          
      

     ?><?php /* ?>


                        <ul>
                            <li><a href="javascript:;">Bariatric Surgery</a></li>
                            <li><a href="javascript:;">Endocrine Surgery</a></li>
                            <li><a class="active" href="javascript:;">Obstetrics & Gynecology Surgery</a></li>
                            <li><a href="javascript:;">Gastroenterology</a></li>
                            <li><a href="javascript:;">Minimally access surgery...</a></li>
                            <li><a href="javascript:;">Breast surgery</a></li>
                            <li><a href="javascript:;">General surgery</a></li>
                            <li><a href="javascript:;">Proctology Disorders</a></li>
                            <li><a href="javascript:;">Venous Disorders</a></li>
                            <li><a href="javascript:;">Oncology Surgery</a></li>
                            <li><a href="javascript:;">Scarless Surgery and innovative...</a></li>
                            <?php */ ?>
                
                    <div class="latestCategoriesOuter">
						 <?php if(ICL_LANGUAGE_CODE=='ar'){echo '<h3>أحدث الفئات</h3>';}else{echo '  <h3>Latest Categories</h3>';}?>
    
<?php
 $terms = get_the_terms( $post->ID, 'services' );
if ( ! empty( $terms ) ) :
  $term = array_pop( $terms );
  
  $parent_term = ( $term->parent ? get_term( $term->parent, 'services' ) : $term );
 
  $child_terms = get_term_children( $parent_term->term_id, 'services' );
    if ( ! empty( $child_terms ) ) :
     echo " <ul> ";
         foreach ( $child_terms as $child_term_id ) :
      $child_term = get_term_by( 'id', $child_term_id, 'services' );
      echo '<li><a href="'.get_term_link( $child_term, 'services' ).'">' .$child_term->name. '</a></li>';
          
    endforeach;
     echo "</ul> ";
  endif;  
endif; ?>
                       
                    </div>
                </div>

              <div class="col-md-9 singleServiceBlogContent">
                    <div class="serviceSingleContentOuter">
						<?php $post_image = get_field('post_image');
						 if($post_image != ""){?>
							 	<img src=" <?php echo $post_image ;?>" alt="" />
						  	 
					<?php	 }
						?>
					 
  <?php  

  if ( have_posts() ) {
  while ( have_posts() ) {
  the_post();
	    ?> <h2><?php the_title();?></h2><?php
	  the_content();
            
    }
  }

   ?>
    </div>
  <?php if( get_field('circle_info') ): $i = 0; ?>
				  <div class="singleDoctorInfomationPart">
	 
					 <?php while( the_repeater_field('circle_info') ):$i++; ?>
	                    <div class="circleInfo <?php echo "color".$i; ?>">
                                <div class="middle">
                                    <h5><?php the_sub_field('heading'); ?></h5>
                                    <p><?php the_sub_field('content'); ?></p>
                                </div>
                            </div>
	  
       
 
    <?php endwhile; ?>
					      
                        </div>
 <?php endif;?>
                       
				 <div class="serviceSingleContentOuter">
                        <?php the_field('listing_after_doctor_info'); ?>
				  </div>
<div class="serviceSingleDoctorsPart">
                        <div class="headingText">
							<?php $id = get_the_ID();
						
						$termname=	wp_get_object_terms( $id, 'services', array( 'fields' => 'names' ) );
                               $meta = get_post_meta($id);  
							$doctors=	$meta['doctors'];
						   $doctors_id='';
                            $texoid='';
						   foreach ($doctors as $key => $drid) {
							   $doctors_id= $drid;
						   }
						   $id = get_the_ID();
						 
						   $doctorsid = unserialize($doctors_id);
							$docs_id= array();
				             	$labels = array();
							foreach ($doctorsid as $key => $drsid) {
							   $docs_id= $drsid;
							 $field = get_field_object('speciality1', $docs_id);
										$values = get_field('speciality1', $docs_id);
	                    	 foreach ($values as $value) {
											$labels[] = $value['label'];
									}	  
						 		 
							   }
						    $string =  array_unique($labels);
							
						 
							 
$featured_posts = get_field('doctors');
 
if( $featured_posts ):  
					 
  ?> <h4 class="drprectice"> <?php if(ICL_LANGUAGE_CODE=='ar'){echo 'الأطباء الممارسون فيالشخصية';}else{echo 'Doctors practicing in ';}?> <?php echo implode(', ', $string); ?></h4>
     </div>	 
 
      <div class="serviceSingleDoctorsSlider">
    <?php foreach( $featured_posts as $post ): 
$doctor_image = get_field( 'doctor_image', $post);
 $specialist = get_field( 'specialist', $post);

$dr_detail = get_field( 'dr_detail', $post );
        // Setup this post for WP functions (variable must be named $post).
        setup_postdata($post); ?>
		  

                            <div class="item">
                                 <div class="doctorProfilePart"> 
                                    <div class="doctorImg">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php if (!empty($doctor_image)) : ?>
                                            <img src="<?php echo $doctor_image; ?>" alt="" />
                                            <?php else : ?>
                                                <img src="<?php echo site_url();?>/wp-content/uploads/2021/02/1-2.jpg" alt="" />
                                            <?php endif; ?>
										 
                                       <?php /*      <h4><img src="<?php echo get_template_directory_uri()?>/assets/images/plus-circle-icon.svg" alt="" /> <?php if(ICL_LANGUAGE_CODE=='ar'){echo 'عرض الصفحة الشخصية';}else{echo ' View Profile';}?></h4> <?php */?>
                                        </a>
										
										<div class="docBioInfoHover">
								<?php $title = get_the_title();
									$labels = array();
										$field = get_field_object('speciality1' );
										$values = get_field('speciality1' );

										foreach ($values as $value) {
											$labels[] = $value['label'];}
											
											
								$book_now = get_field( 'book_now')	;	
										$lanuage = get_field( 'languages')	;	
										?>
										<div class="docBioInfoInner">
											<?php if(ICL_LANGUAGE_CODE == 'ar'){
                                   			$Speciality = 'تخصص' ;
	                                        $Language= 'اللغات';
	                                         $profile= 'عرض الصفحة الشخصية';
	                                         $and = 'و';
	
	                                           	}
	                                           else{
		                                 	$Speciality = 'Speciality ' ;
	                                        $Language = 'Languages';
											$profile='View Profile'; 
											  $and = 'And';}   
                                         	?>
	                                       	<h4> <?php echo $Speciality ;?> </h4>
											<p><?php echo implode(', ', $labels); ?></p>
											<h4 style="padding: 0 42px;"><?php echo $Language ;?></h4>
											<p><?php echo $lanuage ?></p>
										 <div class="buttonOuter"><a class="commonButton commonButton--white" href=" <?php the_permalink(); ?>"><?php echo $profile ;?></a></div>
										</div>
									</div>
                                    </div>
                                    <div class="doctorProfileBio">
											<?php	$id = get_the_ID();
							  $meta = get_post_meta($id);
								
							$sid='';
						       $array=	$meta['drservice'];
							    foreach ($array as $key => $srid) {
									
                                    $sid= $srid;
                                    }?>
								
                        <?php	  $designationdr= get_field('designation') 	;		?>
							           
									 <h4> <a style="color:#000" href="<?php the_permalink(); ?>"> <?php   if(ICL_LANGUAGE_CODE=='ar'){if( $designationdr =='dr' ){ echo 'دكتور.'; }elseif($designationdr =='prof'){echo 'الأستاذ';} else{echo 'آنسة';} }else {echo $designationdr.'. ';} ?>  <?php echo get_the_title();?></a></h4> 
                                    	<?php  
										$book_now = get_field( 'book_now')	;	
								
$short_title = wp_trim_words( $title, 4, '...' );?>
										<h5><?php if( get_field('specialist') == 'specialist' ) {echo $specialist_specility.', ';} if( get_field('specialist') == 'consultant' ){echo $consultant_specility.', ';}?> <?php echo implode(', ', $labels); ?></h5>
                               </div> 
						 <?php if (!empty($book_now)) : ?>   <a class="commonButton borderButton" href="<?php echo $book_now['url'] ?>"><?php echo $book_now['title'];?> </a>      									 <?php else : ?>
                                <a class="commonButton borderButton" href="<?php echo get_bloginfo('url')?>/request-an-appointment/?dr=<?php echo $id ?>"> <?php if(ICL_LANGUAGE_CODE=='ar'){ echo 'طلب موعد'; }else{echo 'Request An Appointment';}?></a>  <?php endif; ?>
						    
                               
                                    </div>
                                </div>

                                <?php endforeach; ?>
    
    <?php 
    // Reset the global post object so that the rest of the page works correctly.
    wp_reset_postdata(); ?>

                        </div>
<?php endif; ?>
	
	
</div>
     </div>



</div>
			   </div></div> 
	</section><!-- #site-content -->	
	 <section class="whatOurpatientSayingMain commonPY">
        <div class="container">
            <div class="whatOurpatientSayingInner">
                <div class="headingText white lightUppercase borderLine">
                  <?php if(ICL_LANGUAGE_CODE=='ar'){echo ' <p>ماذا يقول عملاؤنا السعداء عنا</p>';}else{echo ' <p>What our happy customers say about us</p>';}?>  
                      <?php if(ICL_LANGUAGE_CODE=='ar'){echo ' <h2>ماذا يقول مرضانا</h2>';}else{echo ' <h2>What our patients are saying</h2>';}?>  
                </div>
                <div class="happyCustomerSliderOuter">
                    <div class="happyCustomerSlider">
						<?php

						$args = array(  
							'post_type' => 'testimonial',
							'post_status' => 'publish',
							'posts_per_page' => -1, 
							'orderby' => 'post_date', 
							'order' => 'DESC', 
						);

						$loop = new WP_Query( $args ); 

						while ( $loop->have_posts() ) : $loop->the_post(); 
						?> 
						 <div class="item">
                            <div class="imgPart">
                                <img src="<?php the_post_thumbnail('full-size');?> " alt="" />
                            </div>
                            <p> <?php the_content(); ?></p>
                            <h5><?php echo the_title();?></h5>
                        </div>
					 
						<?php
						endwhile;

						wp_reset_postdata(); 

						?>	
						 
                    </div>
                </div>
            </div>
        </div>
    </section><!--What our patients are saying End-->	
		
  <?php 
  $hospitalTitle = get_field('hospital');
  $hospitalimage = get_field('hospital_image_or_icon');
  $hospitaltext = get_field('hospital_text');
  $hospitalAppoitment = get_field('request_appoitment');
  $clinicTitle = get_field('clinic_title');
  $cliniclimage = get_field('clinic_image_or_icon');
  $clinictext = get_field('clinic_text');
  $clinicAppoitment = get_field('request_appoitment_clinic');
  if(!empty($hospitalTitle)  || !empty($clinicTitle)){
  ?>
		<section class="availableTheseClinicsOuter commonPY">
		
			
         <div class="container">
            <div class="headingText grey lightUppercase borderLine">
				  <?php if(ICL_LANGUAGE_CODE=='ar'){echo '<h2>هذه الخدمة متوفرة في هذه العيادات</h2>';}else{echo '<h2>This service is available at these clinics</h2>';}?>	 
				
				
             
            </div>
            <div class="row justify-content-center
">
              <?php if(!empty($hospitalTitle)){ ?>
                <div class="col-6 availableTheseClinicsGridPart pr-lg-5">
                    <div class="availableTheseClinicsGrid">
                        <div class="icon">
						<?php if( $hospitalimage ): ?>	
                               <img src="<?php echo $hospitalimage ?>" alt="" />
							 <?php else:?>
								  <img src="<?php echo site_url();?>/wp-content/uploads/2021/01/hospital-icon.svg" alt="" />
 								<?php endif;?>
                        </div>
						     <?php if( $hospitalTitle ): ?>
                             <h4><?php echo $hospitalTitle ?> </h4>
						    
 								<?php	endif;?>
                          <?php if( $hospitaltext ): ?>  
						              	<p><?php echo $hospitaltext ?> </p>
						
 								<?php endif;?>
					
						 <?php if( $clinicAppoitment ): ?>  
		   
						<a class="commonButton" href="<?php echo $clinicAppoitment['url']; ?>" target="<?php echo $clinicAppoitment['target']; ?>" > <?php echo $clinicAppoitment['title']; ?></a>
					
 						<?php endif;?>
						
                    </div>
                </div>
              <?php } ?>
              <?php if(!empty($clinicTitle)){ ?>
               <?php /* <div class="col-6 availableTheseClinicsGridPart pl-lg-5">
                    <div class="availableTheseClinicsGrid">
                        <div class="icon">
								<?php if( $cliniclimage ): ?>	
                               <img src="<?php echo $cliniclimage ?>" alt="" />
							 <?php else:?>
								   <img src="<?php echo site_url();?>/wp-content/uploads/2021/01/first-aidkit-icon.svg" alt="" />
 								<?php endif;?>
                          
                        </div>
						   <?php if( $clinicTitle ): ?>
                             <h4><?php echo $clinicTitle ?> </h4>
						   
 								<?php	endif;?>
                   
                           <?php if( $clinictext ): ?>  
						              	<p><?php echo $clinictext ?> </p>
						
 								<?php endif;?>
					   <?php if( $clinicAppoitment ): ?>  
		   
						<a class="commonButton" href="<?php echo $clinicAppoitment['url']; ?>" target="<?php echo $clinicAppoitment['target']; ?>" > <?php echo $clinicAppoitment['title']; ?></a>
						
 						<?php endif;?>
						
                       
                    </div>
                </div>*/?>
                 <?php } ?>
            </div>
        </div>

    </section><!--Available These Clinics End-->
   <?php } ?>
<?php //get_template_part( 'template-parts/footer-menus-widgets' ); ?>
<script>
	jQuery(function($) {
  $('.critselect').each(function() {
    var xContents = $(this).html();
    var lastCommaPos = xContents.lastIndexOf(',');
    $(this).html(xContents.substring(0, lastCommaPos));
  });
});
	</script>
<?php get_footer(); ?>
