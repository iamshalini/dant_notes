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
<?php
    echo '<input type="hidden" name="activepost" id="activepost" value="'.get_the_ID().'" />';
?>
    <section class="doctorSingleMain commonPY">
<div class="container">
           <div class="row">
<?php
    $doctor_image = get_field( 'doctor_image', $post_id );
    $dr_name = get_field( 'dr_name', $post_id );
    $dr_education = get_field( 'dr_education', $post_id );
    $specialist = get_field( 'specialist', $post_id );
    $dr_detail = get_field( 'dr_detail', $post_id );
    $speciality = get_field( 'speciality', $post_id );
    $languages = get_field( 'languages', $post_id );
    $locations = get_field( 'doctor_locations', $post_id );
    $education = get_field( 'education', $post_id );
    $experience = get_field( 'experience', $post_id );
    $activities = get_field( 'activities', $post_id );
	$speciality1 = get_field( 'speciality1', $post_id );
	$speciality2 = get_field( 'speciality2', $post_id );
	$book_now = get_field( 'book_now', $post_id )	;	   
		 $designationdr= get_field('designation', $post_id) 	;	   ?>
			<?php $drrrid = get_the_ID();
			 ?>
					   <?php 

					   $args = array(  
						   'post_type' => 'service',
						   'post_status' => 'publish',
						   'posts_per_page' => -1, 
						   'orderby' => 'post_date', 
						   'order' => 'DESC', 

					   );


					   $loop = new WP_Query( $args ); 
$texoid="";
					   while ( $loop->have_posts() ) : $loop->the_post(); 
					   ?> 
					   
						   <?php 
						   $id = get_the_ID();
						   $terms = get_the_terms($id, 'services' );
						   if ( !empty( $terms ) ){
							   // get the first term
							   $term = array_shift( $terms );
							   $termid.= $term->term_id;
						   }   
  
						   $meta = get_post_meta($id);
						   $doctors=	$meta['doctors'];
						   $doctors_id='';

						   foreach ($doctors as $key => $drid) {
							   $doctors_id= $drid;
						   }
						   $id = get_the_ID();
						  
						   $doctors = unserialize($doctors_id);
                            
					 
						   if (in_array($drrrid, $doctors))
						   {
							   $texoid.= $term->term_id.' ';
							  
						   } ?> 
						
					  
					   <?php
					   endwhile;

					   wp_reset_postdata(); 
                           
					   ?>
		<?php
			     $catarray= (explode(" ",$texoid)); 
			      
                   $serviceid= reset($catarray);  
   
			   ?>
			   
 <div class="col-md-4 singleDoctorProfileGrid">
                    <div class="doctorProfilePart singleDoctorProfilePart">
						<?php	if($doctor_image  ==''){?>
						 <img src="<?php echo site_url();?>/wp-content/uploads/2021/02/1-2.jpg">	
							<?php	}
                    	 if (!empty($doctor_image)) : ?>
                        <div class="doctorImg">
                            <img src="<?php echo $doctor_image; ?>" alt="" />
                        </div>
                        <?php
						   
						endif; ?>
                        <div class="doctorProfileBio">
                            <h4><?php if(ICL_LANGUAGE_CODE=='ar'){if( $designationdr =='dr' ){ echo 'دكتور.'; }elseif($designationdr =='prof'){echo 'الأستاذ';} else{echo 'آنسة';} }else {echo $designationdr.'. ';} ?>  <?php the_title(); ?></h4>
							
							<?php	$id = get_the_ID();
							  $meta = get_post_meta($id);
							  $sid='';
						       $array=	$meta['drservice'];
						
							    foreach ($array as $key => $srid) {
                                    $sid= $srid;
                                    }
						      
							?>
							
						 <?php if(ICL_LANGUAGE_CODE=='ar'){
	         $consultant_specility = 'استشاري' ;
		     $specialist_specility ='أخصائي';
		 }
		  else{
			   $consultant_specility = 'Consultant' ;
		       $specialist_specility ='Specialist';
			 } 
							
  
      $labels = array();
      $field = get_field_object('speciality1', $post_id);
      $values = get_field('speciality1', $post_id);
						
      foreach ($values as $value) {
		 $labels[] = $value['label'];}

     
		 
	 ?>
							<h5><?php if (!empty($dr_education)) : ?><span class="singleLine"><?php echo $dr_education; ?></span><?php endif; ?> <?php if( get_field('specialist') == 'specialist' ) {echo $specialist_specility.', ';} if( get_field('specialist') == 'consultant' ){echo $consultant_specility.', ';}?> <?php  echo implode(', ', $labels); ?></h5> 
                           
                            <div class="doctorSocialMedia">
                                <ul>
                                  <?php if(ICL_LANGUAGE_CODE=='ar'){
                               echo ' <li>شارك:</li>';
	 								 }
							else{
								    echo ' <li>Share:</li>';
							}?>	 
                                    <li> 
						<a href="javascript:fbShare('<?php echo urlencode(get_permalink($post->ID)); ?>&t=<?php echo urlencode($post->post_title); ?>/', 'Fb Share', 'Facebook share popup', 'http://goo.gl/dS52U', 520, 350)"><i class="fab fa-facebook-f"></i></a>
				
									 
								 </li>
                                    <li><a href="http://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank"> <i class="fab fa-twitter"></i> </a> </li>
                              <?php
$url=get_permalink();
?>
 <li><a href="https://www.linkedin.com/cws/share?url=<?php echo $url;?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
               </div>

                <div class="col-md-8 doctorSingleInfomation pl-lg-5">
                    <div class="doctorKnowladgePart">
                    	<?php if (!empty($speciality)) : ?>
                        <div class="headingText">
						<?php if(ICL_LANGUAGE_CODE=='ar'){
                               echo ' <h4>تخصص</h4>';
	
                               }
							else{
								    echo '  <h4>Speciality</h4>';
							}?>	
                          
                            <h5><?php echo $speciality; ?></h5>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($languages)) : ?>
                        <div class="headingText">
							<?php if(ICL_LANGUAGE_CODE=='ar'){
                               echo ' <h4>اللغات</h4>';
	
                               }
							else{
								    echo ' <h4>Languages</h4>';
							}?>
                          
                            <h5><?php echo $languages; ?></h5>
                        </div>
                        <?php endif; ?>
                         <?php if (!empty($locations)) : ?>
                        <div class="headingText">
							<?php if(ICL_LANGUAGE_CODE=='ar'){
                               echo ' <h4>المواقع</h4>';
	
                               }
							else{
								    echo ' <h4>Locations</h4>';
							}?>
							
                           <?php $drlocations = str_replace(',', ',<br />', $locations); ?>
							  <h5><?php echo $drlocations; ?></h5>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($education)) : ?>
                    <div class="headingText">
                        <?php if(ICL_LANGUAGE_CODE=='ar'){
                               echo ' <h4>تعليم</h4>';
	
                               }
							else{
								    echo '<h4>Education</h4>';
							}?>	
						
					 	
                    </div>
                    <p><?php echo $education; ?></p>
                    <?php endif; ?>
                    <?php if (!empty($experience)) : ?>
                    <div class="headingText">
								<?php if(ICL_LANGUAGE_CODE=='ar'){
                               echo ' <h4>خبرة</h4>';
	
                               }
							else{
								    echo ' <h4>Experience</h4>';
							}?>	
                       
                    </div>
                    <p><?php echo $experience; ?></p>
                    <?php endif; ?>
					 <?php if (!empty($activities)) : ?>
                    <div class="headingText">
							<?php if(ICL_LANGUAGE_CODE=='ar'){
                               echo ' <h4>أنشطة</h4>';
	
                               }
							else{
								    echo '   <h4>Activities</h4>';
							}?>	
                      
                    </div>
                    <p><?php echo $activities; ?></p>
                    <?php endif; ?>
					
                    <div class="buttonOuter">
					 
						 <?php if (!empty($book_now)) : ?>
                           <a class="commonButton" href="<?php echo $book_now['url'] ?>"><?php echo $book_now['title'];?> </a><?php else : ?>
                         <a class="commonButton" href="<?php echo get_bloginfo('url')?>/request-an-appointment/?dr=<?php echo $id ?>&sr=<?php echo $serviceid ?>"> <?php if(ICL_LANGUAGE_CODE=='ar'){ echo 'طلب موعد'; }else{echo 'Request An Appointment';}?></a><?php endif; ?>
						 
                    
                    </div>    
               </div>


	<?php /* 

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );
		}
	}

	*/ ?>
</div>
</div>
</section><!-- #site-content -->

<?php //get_template_part( 'template-parts/footer-menus-widgets' ); ?>
<script>
    function fbShare(url, title, descr, image, winWidth, winHeight) {
        var winTop = (screen.height / 2) - (winHeight / 2);
        var winLeft = (screen.width / 2) - (winWidth / 2);
        window.open('http://www.facebook.com/sharer.php?s=100&p[title]=' + title + '&p[summary]=' + descr + '&p[url]=' + url + '&p[images][0]=' + image, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
    }
</script>
<?php get_footer(); ?>
