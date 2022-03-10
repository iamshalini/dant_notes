 
<?php
if ( ! class_exists( 'frontendAjaxDropdown' ) ):
 class frontendAjaxDropdown
 {
 
 function __construct()
 {
 
       add_shortcode( 'ajax-dropdown', array($this, 'init_shortocde') );
       add_action( 'wp_ajax_get_subcat', array($this, 'getSubCat') );
	   add_action( 'wp_ajax_get_subcat2', array($this, 'getSubCat2') );
	   add_action( 'wp_ajax_get_dr', array($this, 'get_dr') );
	   add_action( 'wp_ajax_desending_order', array($this, 'desending_order') );
	   add_action( 'wp_ajax_Assending_order', array($this, 'Assending_order') );
     
        add_action('wp_ajax_nopriv_get_subcat', array($this, 'getSubCat') );
	    add_action('wp_ajax_nopriv_get_subcat2', array($this, 'getSubCat2') );
	    add_action('wp_ajax_nopriv_get_dr', array($this, 'get_dr') );
	    add_action( 'wp_ajax_nopriv_desending_order', array($this, 'desending_order') );
	    add_action( 'wp_ajax_nopriv_Assending_order', array($this, 'Assending_order') );
 
  } 
      
	 function init_shortocde()
 { ?>
		<div class="form-group">
			<div class="filterIcon">
			<img src="<?php echo site_url();?>/wp-content/uploads/2021/05/stethoscope.svg" alt="">
			</div>
 	 
			 <select name="main_cat" id="main_cat" class="form-field">
				<option value="-1" selected="selected"><?php if(ICL_LANGUAGE_CODE=='ar'){echo 'اختر الخدمة';}else{echo 'Choose the service';}?></option>
				   <?php    
		          $args = array(
		            'post_type'      => 'service', // You can add a custom post type if you like
		             'posts_per_page' => -1,
					 'orderby' => 'title', 
	                 'order' => 'ASC', 
                     'post__not_in' => array(653,721,1251), 
					  
		            );
    $query = new WP_Query($args);
    $list = array();
			 while ($query->have_posts()) : $query->the_post(); 
    if(in_array(get_the_title(), $list)){ continue; }
    $list[] = get_the_title();
    ?>
				  <option value="<?php the_ID(); ?>"> <?php echo get_the_title();?> </option>
   
    <?php endwhile;
    wp_reset_postdata();?>
		 
</select>	
 
		</div> 
		<div id="sub_cat" class="form-group">
		  <div class="filterIcon">
		       <img src="<?php echo site_url();?>/wp-content/uploads/2021/05/user.svg" alt="">
		  </div> 
		  <select id="new_select" class="form-field"  >
		     <option value="" selected=""><?php if(ICL_LANGUAGE_CODE=='ar'){echo 'البحث عن طريق الإسم';}else{echo ' Search by Name';}?>
		     	
		     </option>
		           <?php    
		            query_posts(array(
		            'post_type'      => 'doctors', // You can add a custom post type if you like
		            'posts_per_page' => -1,
                    'orderby' => 'title', 
	              'order' => 'ASC', 
		            ));?>

		            <?php while ( have_posts() ) : the_post(); ?>
			  <?php $designationdr= get_field('designation') 	;
			  
			  ?>	
				  <option value="<?php the_ID(); ?>"><?php   if(ICL_LANGUAGE_CODE=='ar'){if( $designationdr =='dr' ){ echo 'دكتور.'; }elseif($designationdr =='prof'){echo 'الأستاذ';} else{echo 'آنسة';} }else {echo $designationdr.'. ';} ?> <?php echo the_title(); ?> </option>
		            <?php endwhile; wp_reset_query();// end of the loop. ?>
		  </select>
		</div>  
  
 
	  
 <script type="text/javascript">
			(function($){
			$("#main_cat").change(function(){
			
		  if ( $("#main_cat option:selected").val()=='-1') {  
              window.location.reload();
          }
			else{
				if($('.wpml-ls-native').attr("lang") == 'ar') {
					 var current_language = 'en';
				 }else{
					  var current_language = 'ar';
				 }
			 
               	$("#new_select ").empty();	
				 $("#selectboxid").empty();
				$.ajax({
				type: "post",
				url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
				//dataType: "text",
				data: { action: 'get_subcat2', 
                  lang: current_language,
				cat_id: $("#main_cat option:selected").val() },
				beforeSend: function() {$("#loading").fadeIn('slow');},
					success: function(data) {
				 
					//window.location = "http://your/url";
					$("#loading").fadeOut('slow');
					  $("#new_select ").append(data);
						if($('.wpml-ls-native').attr("lang") == 'ar') { 
							 $("#selectboxid ").append('<option value="bydefault" selected=""> Sort by default</option><option value=""> First Name (A-Z)</option><option value="dsc">First Name (Z-A)</option>');
								}else{
								 $("#selectboxid ").append('<option value="bydefault" selected="">البحث عن طريق الإسم</option><option value=""> الاسم الأول (أ-ي)</option><option value="dsc">الاسم الأول (ي-أ) </option>');
								}
						
					 	
						var language = $('.wpml-ls-native').attr("lang") ;
				   if (language == 'en') {
					$('input.commonButton').val('بحث');
                    }	 

					}
				});	
				
		
				
				
			 $(".doctorsTeamOuter ").remove();
				
				$.ajax({
				type: "post",
				url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
				//dataType: "text",
				data: { action: 'get_subcat', 
                  lang: current_language,
                  cat_id: $("#main_cat option:selected").val() },
					
				beforeSend: function() {$("#loading").fadeIn('slow');},
					success: function(data) {
 					//window.location = "http://your/url";
					$("#loading").fadeOut('slow');
						 var drdata = data; 
						  $('<div class="doctorsTeamOuter">' + drdata +'</div>').insertAfter( ".doctorsFilterOuter" ); 
					//$(".doctorsTeamOuter ").append(data);
					    var language = $('.wpml-ls-native').attr("lang") ;
					
                 if (language == 'en') {
					$('input.commonButton').val('بحث');
                    }	 

					}
				});

			}
			});
			$('.form-field').html(function(i,h){
			return h.replace(/&nbsp;/g,'');
			});
			})(jQuery);
		</script>
        
		<script type="text/javascript">
		(function($){
		$("#new_select").change(function(){
            if($('.wpml-ls-native').attr("lang") == 'ar') {
					 var current_language = 'en';
				 }else{
					  var current_language = 'ar';
				 }
		$(".doctorsTeamOuter ").empty();
			$.ajax({
			type: "post",
			url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
			//dataType: "text",
			data: { action: 'get_dr', 
			 lang: current_language,	   
			dr_id:  $("#new_select option:selected").val() },
			//dr_id: $("#new_select option:selected").val() },
			beforeSend: function() {$("#loading").fadeIn('slow');},
				success: function(data) {
				 
				//window.location = "http://your/url";
				$("#loading").fadeOut('slow');
				$(".doctorsTeamOuter ").append(data);

				var language = $('.wpml-ls-native').attr("lang") ;
				if (language == 'en') {
				$('input.commonButton').val('بحث');

				}	 

				}
			});

		});
		$('.form-field').html(function(i,h){
		return h.replace(/&nbsp;/g,'');
		});
		})(jQuery);
		</script>

 <div id="loading" style="display: none;"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/ajax-loader.gif" alt="" /></div>


 <?php }
 /**
 * AJAX action: Shows dropdown for selected parent
 */
 function get_dr(){	 
	 $dr_id = $_POST['dr_id'];
		$args=array(
		//'cat' => $cat_id,
		'post_type' => 'doctors',// You can set custom post type here
		'post_status' => 'publish',
		'id' => $dr_id,
		'posts_per_page' => 1, 
		);
	 
    $my_query = null;
    $my_query = new WP_Query($args);
 if( $my_query->have_posts() ) {?>
    <div class="row">
       <?php while ($my_query->have_posts()) : $my_query->the_post(); 
			 $meta = get_post_meta($dr_id); 
  
				$doctor_image = get_field('doctor_image', $dr_id);
				$languages = get_field('languages', $dr_id);
				$speciality1 = get_field('speciality1', $dr_id);
				$speciality2 = get_field('speciality2', $dr_id);
				$specialist = get_field('specialist', $dr_id); 
				$book_now = get_field('book_now', $dr_id); 
				$url= get_permalink($dr_id);
				  $designationdr= get_field('designation', $dr_id) ;	
		   ?>
			<div class="col-xl-3 col-lg-4 col-6 doctorsTeamGrid">
				<div class="doctorProfilePart">                            
					<div class="doctorImg">
					<a href="<?php the_permalink(); ?>">
					<?php  if($doctor_image  ==''){?>
					<img src="<?php echo site_url();?>/wp-content/uploads/2021/02/1-2.jpg">	

					<?php	}
					else{   ?>
					<img src="<?php echo $doctor_image; ?>" alt="">
					<?php	}

					?>
					</a>
						<div class="docBioInfoHover">
							<div class="docBioInfoInner">
									<?php if(ICL_LANGUAGE_CODE == 'ar'){
			$Speciality = 'تخصص' ;
		}
	else{
			$Speciality = 'Speciality ' ;
		}  
									$labels = array();
      $field = get_field_object('speciality1', $dr_id);
      $values = get_field('speciality1', $dr_id);
						
      foreach ($values as $value) {
		 $labels[] = $value['label'];}  
	?>
		<h4> <?php echo $Speciality ;?> </h4>
								<p><?php echo implode(', ', $labels); ?></p>

								<h4 style="padding: 0 42px;"> <?php if(ICL_LANGUAGE_CODE=='ar'){echo 'دكتور اللغات';}else{echo 'Languages';}?></h4>
								<p><?php echo $languages ?></p>
								<div class="buttonOuter"><a class="commonButton commonButton--white" href="<?php echo $url;?>"> <?php if(ICL_LANGUAGE_CODE=='ar'){echo 'عرض الصفحة الشخصية';}else{echo ' View Profile';}?></a></div>
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
						
						 <?php if(ICL_LANGUAGE_CODE=='ar'){
	         $consultant_specility = 'استشاري' ;
		     $specialist_specility ='أخصائي';
		 }
		  else{
			   $consultant_specility = 'Consultant' ;
		       $specialist_specility ='Specialist';
			 } 
	 ?>
						<div class ="inner_bio">
							<div class ="details">
								<?php $doctorname= get_the_title( $dr_id );
		  ?> 
<h4><a href="<?php echo $url;?>" style="color:#000" > <?php if(ICL_LANGUAGE_CODE=='ar'){if( $designationdr =='dr' ){ echo 'دكتور.'; }elseif($designationdr =='prof'){echo 'الأستاذ';} else{echo 'آنسة';} }else {echo $designationdr.'. ';} ?> <?php echo $doctorname ;?></a></h4><h5> <?php if( get_field('specialist', $dr_id) == 'specialist' ) {echo $specialist_specility.', ';} if( get_field('specialist', $dr_id) == 'consultant' ){echo $consultant_specility.', ';}?><?php   echo implode(', ', $labels); ?></h5>	
							</div>

						</div>
					</div>  
					<div class ="booknow_btn">

					<?php if (!empty($book_now)) : ?>
				  <a class="commonButton borderButton" href="<?php echo $book_now['url'] ?>"><?php echo $book_now['title'];?> </a>          						<?php else : ?>
					<a class="commonButton borderButton"  href="<?php echo get_bloginfo('url')?>/request-an-appointment/?dr=<?php echo $id ?>"><?php if(ICL_LANGUAGE_CODE=='ar'){echo 'طلب موعد';}else{echo 'Request An Appointment';}?> </a> <?php endif; ?>
					</div>

				</div>
			</div>
  <?php  
         endwhile; ?>
    </div> 

<?php 
 }exit();
	 }  

//  grid doctors after filter **************************************************

function getSubCat(){ 
  $p_id = $_POST['cat_id'];
    $args=array(
	//'cat' => $cat_id,
	'post_type' => 'service',// You can set custom post type here
	'post_status' => 'publish',
	'posts_per_page' => -1, 
	'orderby' => 'title', 
	'order' => 'ASC', 
		
     'p'   => $p_id,
	);
   
	$my_query = null;
	$my_query = new WP_Query($args);
	if( $my_query->have_posts() ) {?>
      <div class="row ">
		<?php while ($my_query->have_posts()) : $my_query->the_post(); 
         $featured_posts = get_field('doctors'); 
		    if( $featured_posts ): 
		      foreach( $featured_posts as $post): 
		      
		 setup_postdata($post);
		   $locations[] = $post;
			?>
		<?php endforeach; ?>
		    <?php  wp_reset_postdata(); ?>
		<?php endif;  

		endwhile; 
	      $locations = array_unique($locations);
 		 
				    if($locations == ''){?>
				 <div class='no_doctor'> <?php if(ICL_LANGUAGE_CODE=='ar'){echo ' لا طبيب';}else{echo 'No Doctor';}?>  </div> 
		<?php	}
		   else{
 $consultant= get_posts( array(
      'fields'         => 'ids',
      'post_status'    => 'publish',
	 'posts_per_page' => -1, 
      'post_type'      => 'doctors',
       'post__in'  => $locations, 
		 'orderby'   => 'title',  
        'order'     => 'ASC', 
      'meta_query' => array(
		 
        array(
            'key' => 'specialist',
            'value' => 'consultant',
            'compare' => '='
		   ),
	   
	)
)); 
     $specialist= get_posts( array(
      'fields'         => 'ids',
      'post_status'    => 'publish',
      'post_type'      => 'doctors',
         'posts_per_page' => -1, 
       'post__in'  => $locations, 
		 'orderby'   => 'title',  
        'order'     => 'ASC', 
      'meta_query' => array(
		 
        array(
            'key' => 'specialist',
            'value' => 'specialist',
            'compare' => '='
		   ),
	   
	)
)); 
 $gp = get_posts( array(
      'fields'         => 'ids',
      'post_status'    => 'publish',
      'post_type'      => 'doctors',
         'posts_per_page' => -1, 
       'post__in'  => $locations, 
		 'orderby'   => 'title',  
        'order'     => 'ASC', 
      'meta_query' => array(
		 
        array(
            'key' => 'specialist',
            'value' => 'general-practitioner',
            'compare' => '='
		   ),
	   
	)
)); 
			  $other = get_posts( array(
      'fields'         => 'ids',
      'post_status'    => 'publish',
      'post_type'      => 'doctors',
         'posts_per_page' => -1, 
       'post__in'  => $locations, 
		 'orderby'   => 'title',  
        'order'     => 'ASC', 
      'meta_query' => array(
		 
        array(
             'key' => 'specialist',
            'value' => '',
            'compare' => '='
		   ),
	   
	)
));
    
     $drposts = array_merge_recursive($consultant,$specialist,$gp,$other);	 
		   $loop = new WP_Query(array(
      'post_type' => 'doctors',
      'posts_per_page' => -1,
       'post__in'  => $drposts, 
       'orderby'   => 'post__in', 
        'order'     => 'ASC' ,
	    
)); 	
			   
          if($loop->have_posts()) :
           while ( $loop->have_posts() ) : $loop->the_post(); 
			
		   $meta = get_post_meta($location); 
            $doctor_image = get_field('doctor_image', $location);
			 $languages = get_field('languages', $location);
			 $speciality1 = get_field('speciality1', $location);
			 $speciality2 = get_field('speciality2', $location);
			 $specialist = get_field('specialist', $location); 
			 $book_now = get_field('book_now', $location); 
		     $url= get_permalink($location);
		     $drname = get_the_title( $location ); 
             $designationdr= get_field('designation', $location) 	;
			 	 
		        if ($drname != ''){ 
                    $labels = array();
					$field = get_field_object('speciality1', $dr_id);
					$values = get_field('speciality1', $dr_id);

					foreach ($values as $value) {
					$labels[] = $value['label'];}  
			
	      ?>  
			<div class="col-xl-3 col-lg-4 col-6 doctorsTeamGrid">
				<div class="doctorProfilePart">                            
					<div class="doctorImg">
					<a href="<?php the_permalink(); ?>">
					<?php  if($doctor_image  ==''){?>
					<img src="<?php echo site_url();?>/wp-content/uploads/2021/02/1-2.jpg">	

					<?php	}
					else{   ?>
					<img src="<?php echo $doctor_image; ?>" alt="">
					<?php	}

					?>
					</a>
						<div class="docBioInfoHover">
							<div class="docBioInfoInner">
							<?php if(ICL_LANGUAGE_CODE == 'ar'){
			$Speciality = 'تخصص' ;
		}
	else{
			$Speciality = 'Speciality ' ;
		}   
	?>
		<h4> <?php echo $Speciality ;?> </h4>
							<p> <?php echo implode(', ', $labels); ?> </p>

							<h4 style="padding: 0 42px;"> <?php if(ICL_LANGUAGE_CODE=='ar'){echo 'دكتور اللغات';}else{echo 'Languages';}?></h4>
							<p><?php echo $languages ?></p>
							<div class="buttonOuter"><a class="commonButton commonButton--white" href="<?php echo $url;?>"> <?php if(ICL_LANGUAGE_CODE=='ar'){echo 'عرض الصفحة الشخصية';}else{echo ' View Profile';}?></a></div>
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
					}

	?> <?php if(ICL_LANGUAGE_CODE=='ar'){
	         $consultant_specility = 'استشاري' ;
		     $specialist_specility ='أخصائي';
		 }
		  else{
			   $consultant_specility = 'Consultant' ;
		       $specialist_specility ='Specialist';
			 } 
	 ?>
						<div class ="inner_bio">
							<div class ="details">
							<?php $doctorname= get_the_title( $location ); 		?>	
							 
						<h4><a href="<?php echo $url;?>" style="color:#000" > <?php   if(ICL_LANGUAGE_CODE=='ar'){if( $designationdr =='dr' ){ echo 'دكتور.'; }elseif($designationdr =='prof'){echo 'الأستاذ';} else{echo 'آنسة';} }else {echo $designationdr.'. ';} ?> <?php echo $doctorname ;?></a></h4>  <h5>  <?php if( get_field('specialist') == 'specialist' ) {echo $specialist_specility.', ';} if( get_field('specialist') == 'consultant' ){echo $consultant_specility.', ';}?><?php echo implode(', ', $labels); ?></h5>		
							</div>
						</div>
					</div>  
					<div class ="booknow_btn">

					<?php if (!empty($book_now)) : ?>
					  <a class="commonButton borderButton" href="<?php echo $book_now['url'] ?>"><?php echo $book_now['title'];?> </a>         						<?php else : ?>
					<a class="commonButton borderButton"  href="<?php echo get_bloginfo('url')?>/request-an-appointment/?dr=<?php echo $id ?>"><?php if(ICL_LANGUAGE_CODE=='ar'){echo 'طلب موعد';}else{echo 'Request An Appointment';}?> </a> <?php endif; ?>
					</div>

				</div>
			</div>
    <?php }	
		 
		  endwhile;
   else:
 
   endif;
  	   
                        
			   
			   
		   }
?>
 	 	 
    </div> 
   <?php }exit();
 
} 
// 	 for doctor dropdown ***************************************************************

	 
function getSubCat2(){ 
	  $p_id = $_POST['cat_id'];
    $args=array(
	//'cat' => $cat_id,
	'post_type' => 'service',// You can set custom post type here
	'post_status' => 'publish',
	'posts_per_page' => -1, 
	'orderby' => 'title', 
	'order' => 'ASC', 
     'p' => $p_id,
	//'meta_key' => 'doctors',
		 
	);

	$my_query = null;
	$my_query = new WP_Query($args);
	if( $my_query->have_posts() ) {?>
     
		<?php while ($my_query->have_posts()) : $my_query->the_post(); 
  
        $featured_posts = get_field('doctors'); 
		    if( $featured_posts ): 
		      foreach( $featured_posts as $post): 
		      
		 setup_postdata($post);
		   $locations[] = $post;
			?>
		<?php endforeach; ?>
		    <?php  wp_reset_postdata(); ?>
		<?php endif;  

		endwhile; 
	     $locations = array_unique($locations);
    if($locations == ''){?>
 <option value="" ><?php if(ICL_LANGUAGE_CODE=='ar'){echo ' لا طبيب';}else{echo 'No Doctor';}?>   </option>
		<?php	}
	else{
		
	 						   
       $doctor_posts  = new WP_Query( array('post_type'=> 'doctors','post__in' =>$locations,'posts_per_page' => -1,'post_status'=> 'publish','orderby' =>  'title',
        'order' => 'ASC', ) );
		 						   
	   if($doctor_posts->have_posts()) :
              while($doctor_posts->have_posts()) :  $doctor_posts->the_post();					   	 
   
		        $meta = get_post_meta($location); 
                $drname = get_the_title( $location ); 
			   
			  	if ($drname != ''){ 
				$id = get_the_ID();	
	                  $designationdr= get_field('designation') 	;
			  
			  ?>	
		  <option value="<?php  echo $id ?>"> <?php   if(ICL_LANGUAGE_CODE=='ar'){if( $designationdr =='dr' ){ echo 'دكتور.'; }elseif($designationdr =='prof'){echo 'الأستاذ';} else{echo 'آنسة';} }else {echo $designationdr.'. ';} ?> <?php echo $drname ?></option>
    <?php }
								    endwhile;
								   
   else:
?>

 <?php
   endif;
 		
								  } ?>
  	 
   <?php }exit();
 
}
 
function desending_order(){ 

  $p_id = $_POST['cat_id'];
    $args=array(
//'cat' => $cat_id,
'post_type' => 'service',// You can set custom post type here
'post_status' => 'publish',
'posts_per_page' => -1, 
//'meta_key' => 'doctors',
 'p' => $p_id,
'meta_key' => 'doctors',
'orderby' =>  'meta_value',
'order' => 'ASC',
);
   
$my_query = null;
$my_query = new WP_Query($args);
	 
if( $my_query->have_posts() ) {?>
      <div class="row ">
<?php while ($my_query->have_posts()) : $my_query->the_post(); 
         $featured_posts = get_field('doctors'); 
if( $featured_posts ): 
      foreach( $featured_posts as $post): 
      
      setup_postdata($post);
      $locations[] = $post;
?>
         <?php endforeach; ?>
    <?php  wp_reset_postdata(); ?>
          <?php endif;  
 
         endwhile; 

  $locations = array_unique($locations);
							   if($locations == ''){?>
 <div class='no_doctor'> <?php if(ICL_LANGUAGE_CODE=='ar'){echo ' لا طبيب';}else{echo 'No Doctor';}?>  </div> 
		<?php	}
		   else{
		 $doctor_posts  = new WP_Query( array('post_type'=> 'doctors','post__in' =>  $locations,'posts_per_page' => -1,'orderby' =>  'title',
        'order' => 'DESC', ) );
							   
	   if($doctor_posts->have_posts()) :
      while($doctor_posts->have_posts()) :
         $doctor_posts->the_post();

		$doctor_image = get_field('doctor_image', $location);
			 $languages = get_field('languages', $location);
			 $speciality1 = get_field('speciality1', $location);
			 $speciality2 = get_field('speciality2', $location);
			 $specialist = get_field('specialist', $location); 
			 $book_now = get_field('book_now', $location); 
		     $url= get_permalink($location);
		     $drname = get_the_title( $location );   
	                if ($drname != ''){ 
						   $labels = array();
      $field = get_field_object('speciality1', $location);
      $values = get_field('speciality1', $location);
						
      foreach ($values as $value) {
		 $labels[] = $value['label'];}
	      ?>
		 
			<div class="col-xl-3 col-lg-4 col-6 doctorsTeamGrid">
				<div class="doctorProfilePart">                            
					<div class="doctorImg">
					<a href="<?php the_permalink(); ?>">
					<?php  if($doctor_image  ==''){?>
					<img src="<?php echo site_url();?>/wp-content/uploads/2021/02/1-2.jpg">	

					<?php	}
					else{   ?>
					<img src="<?php echo $doctor_image; ?>" alt="">
					<?php	}

					?>
					</a>
						<div class="docBioInfoHover">
							<div class="docBioInfoInner ">
							<?php if(ICL_LANGUAGE_CODE == 'ar'){
			$Speciality = 'تخصص' ;
		}
	else{
			$Speciality = 'Speciality ' ;
		}   
	?>
		<h4> <?php echo $Speciality ;?> </h4>
							<p> <?php  echo implode(', ', $labels);  ?> </p>
                                <h4 style="padding: 0 42px;"> <?php if(ICL_LANGUAGE_CODE=='ar'){echo 'دكتور اللغات';}else{echo 'Languages';}?></h4>
							<p><?php echo $languages ?></p>
							<div class="buttonOuter"><a class="commonButton commonButton--white" href="<?php echo $url;?>"> <?php if(ICL_LANGUAGE_CODE=='ar'){echo 'عرض الصفحة الشخصية';}else{echo ' View Profile';}?></a></div>
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
	 ?>
						<div class ="inner_bio">
							<div class ="details">
							<?php $doctorname= get_the_title( $location ); 		
						  $designationdr= get_field('designation', $location) 	;?>
		<h4><a href="<?php echo $url;?>" style="color:#000" > <?php   if(ICL_LANGUAGE_CODE=='ar'){if( $designationdr =='dr' ){ echo 'دكتور.'; }elseif($designationdr =='prof'){echo 'الأستاذ';} else{echo 'آنسة';} }else {echo $designationdr.'. ';} ?> <?php echo $doctorname ;?></a></h4>  <h5> <?php if( get_field('specialist') == 'specialist' ) {echo $specialist_specility.', ';} if( get_field('specialist') == 'consultant' ){echo $consultant_specility.', ';}?><?php  echo implode(', ', $labels);  ?></h5>		
							</div>
						</div>
					</div>  
					<div class ="booknow_btn">

					<?php if (!empty($book_now)) : ?>
				  <a class="commonButton borderButton" href="<?php echo $book_now['url'] ?>"><?php echo $book_now['title'];?> </a>         						<?php else : ?>
					<a class="commonButton borderButton"  href="<?php echo get_bloginfo('url')?>/request-an-appointment/?dr=<?php echo $id ?>"><?php if(ICL_LANGUAGE_CODE=='ar'){echo 'طلب موعد';}else{echo 'Request An Appointment';}?> </a> <?php endif; ?>
					</div>

				</div>
			</div>
    <?php }
        
      endwhile;
   else:
?>
 <?php
   endif;
							   
		  }
      		   
?>									   
	  
    </div> 
 
   <?php }exit();
 
}	
   
function Assending_order(){ 
      $p_id = $_POST['cat_id'];
    $args=array(
	//'cat' => $cat_id,
	'post_type' => 'service',// You can set custom post type here
	'post_status' => 'publish',
	'posts_per_page' => -1, 
	'orderby' => 'title', 
	'order' => 'ASC', 
	//'meta_key' => 'doctors',
	  'p' => $p_id,
	);
   
	$my_query = null;
	$my_query = new WP_Query($args);
	if( $my_query->have_posts() ) {?>
      <div class="row  ">
		<?php while ($my_query->have_posts()) : $my_query->the_post(); 
         $featured_posts = get_field('doctors'); 
		    if( $featured_posts ): 
		      foreach( $featured_posts as $post): 
		      
		 setup_postdata($post);
		   $locations[] = $post;
			?>
		<?php endforeach; ?>
		    <?php  wp_reset_postdata(); ?>
		<?php endif;  

		endwhile; 
	  $locations = array_unique($locations);
			  if($locations == ''){?>
				 <div class='no_doctor'> <?php if(ICL_LANGUAGE_CODE=='ar'){echo ' لا طبيب';}else{echo 'No Doctor';}?>  </div> 
		<?php	}		
		else{
			  $doctor_posts  = new WP_Query( array('post_type'=> 'doctors','posts_per_page' => -1,'post__in' =>  $locations,'orderby' =>  'title',
        'order' => 'ASC', ) );
							   
	   if($doctor_posts->have_posts()) :
      while($doctor_posts->have_posts()) :
         $doctor_posts->the_post();

		$doctor_image = get_field('doctor_image', $location);
			 $languages = get_field('languages', $location);
			 $speciality1 = get_field('speciality1', $location);
			 $speciality2 = get_field('speciality2', $location);
			 $specialist = get_field('specialist', $location); 
			 $book_now = get_field('book_now', $location); 
		     $url= get_permalink($location);
		     $drname = get_the_title( $location );   
	                if ($drname != ''){ 
	      ?>
		 
			<div class="col-xl-3 col-lg-4 col-6 doctorsTeamGrid">
				<div class="doctorProfilePart">                            
					<div class="doctorImg">
					<a href="<?php the_permalink(); ?>">
					<?php  if($doctor_image  ==''){?>
					<img src="<?php echo site_url();?>/wp-content/uploads/2021/02/1-2.jpg">	

					<?php	}
					else{   ?>
					<img src="<?php echo $doctor_image; ?>" alt="">
					<?php	}

					?>
					</a>
						<div class="docBioInfoHover">
							<div class="docBioInfoInner">
								<?php if(ICL_LANGUAGE_CODE == 'ar'){
			$Speciality = 'تخصص' ;
		}
	else{
			$Speciality = 'Speciality ' ;
		}   
						 $labels = array();
      $field = get_field_object('speciality1', $location);
      $values = get_field('speciality1', $location);
						
      foreach ($values as $value) {
		 $labels[] = $value['label'];}
	?>
		<h4> <?php echo $Speciality ;?> </h4>
							<p><?php echo implode(', ', $labels);?></p>
                                <h4 style="padding: 0 42px;"> <?php if(ICL_LANGUAGE_CODE=='ar'){echo 'دكتور اللغات';}else{echo 'Languages';}?></h4>
							<p><?php echo $languages ?></p>
							<div class="buttonOuter"><a class="commonButton commonButton--white" href="<?php echo $url;?>"> <?php if(ICL_LANGUAGE_CODE=='ar'){echo 'عرض الصفحة الشخصية';}else{echo ' View Profile';}?></a></div>
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
	 ?>
						<div class ="inner_bio">
							<div class ="details">
							<?php $doctorname= get_the_title( $location );?>			
							<?php 
 
							   $designationdr= get_field('designation', $location) 	;?>
			   	
							 
						 		<h4><a href="<?php echo $url;?>" style="color:#000" > <?php   if(ICL_LANGUAGE_CODE=='ar'){if( $designationdr =='dr' ){ echo 'دكتور.'; }elseif($designationdr =='prof'){echo 'الأستاذ';} else{echo 'آنسة';} }else {echo $designationdr.'. ';} ?> <?php echo $doctorname ;?></a></h4> <h5><?php if( get_field('specialist') == 'specialist' ) {echo $specialist_specility.', ';} if( get_field('specialist') == 'consultant' ){echo $consultant_specility.', ';}?><?php echo implode(', ', $labels);?></h5>	
							</div>
						</div>
					</div>  
					<div class ="booknow_btn">

					<?php if (!empty($book_now)) : ?>
					  <a class="commonButton borderButton" href="<?php echo $book_now['url'] ?>"><?php echo $book_now['title'];?> </a>         						<?php else : ?>
					<a class="commonButton borderButton"  href="<?php echo get_bloginfo('url')?>/request-an-appointment/?dr=<?php echo $id ?>"><?php if(ICL_LANGUAGE_CODE=='ar'){echo 'طلب موعد';}else{echo 'Request An Appointment';}?> </a> <?php endif; ?>
					</div>

				</div>
			</div>
    <?php }
        
      endwhile;
   else:
?>
 <?php
   endif;
 					   
		   }
     
 ?>	 	 
    </div> 
   <?php }exit();
 
} 	 
} endif;
new frontendAjaxDropdown();