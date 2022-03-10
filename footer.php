<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
<?php 
$insuranceData = get_field('insurance_partners','options');
if(!empty($insuranceData)){

?>
<?php 
global $post;

if( $post->ID != 3747 && $post->ID != 3798) { ?>

 <section class="insurancePartnersMain commonPY">
        <div class="container">
            <div class="headingText lightUppercase borderLine">
                <h2><?php echo $insuranceData['section_title']; ?></h2>
            </div>
            <div class="companyLogosOuter">
                <div class="companyLogosSlider">
					<?php foreach($insuranceData['images_repeater'] as $itemData){ ?>
                    <div class="item">
                        <div class="companyLogo">
                            <a href="javascript:;">
                                <img src="<?php echo $itemData['image']; ?>" alt="" />
                            </a>
                        </div>
                    </div>
					<?php } ?>
                 
                </div>
            </div>
        </div>
    </section><!--End Insurance Partners-->

<?php } ?>

<?php } ?>
<?php $footer = get_field('footer','options'); ?>
    <footer id="footer" class="commonPT">
        <div class="container">
            <div class="footertop">
                <div class="row">
					<?php if(!empty($footer['phone_number'])) { ?>
                    <div class="col-md-4 col-sm-6">
						
                        <div class="footerContactBox">
                            <a href="tel:<?php echo $footer['phone_number']; ?>">
                                <div class="footerContactBox__img">
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 26.1 26.1" style="enable-background:new 0 0 26.1 26.1;" xml:space="preserve">
                                    <g>
                                    <path class="st0" d="M13.1,0C5.9,0,0,5.9,0,13.1c0,7.2,5.9,13.1,13.1,13.1c0.4,0,0.8-0.4,0.8-0.8c0-0.4-0.4-0.8-0.8-0.8
                                    c-6.3,0-11.5-5.1-11.5-11.5c0-6.3,5.1-11.5,11.5-11.5c6.3,0,11.5,5.1,11.5,11.5c0,2.6-1.4,5.3-3.4,6.4c-0.7,0.4-1.5,0.6-2.4,0.6
                                    c0.5-0.3,0.9-0.7,1.3-1.2c0.1-0.1,0.1-0.2,0.2-0.3c0.3-0.6,0.3-1.3,0.4-2c0.2-0.9-3.7-2.5-4.1-1.5c-0.1,0.4-0.3,1.6-0.6,2
                                    c-0.2,0.3-0.8,0.2-1.1-0.1C14,16.1,13,15,12.2,14.1c0,0,0,0-0.1-0.1c0,0-0.1,0-0.1-0.1v0c-0.9-0.9-2-1.9-2.8-2.8
                                    c-0.3-0.3-0.4-0.9-0.1-1.1c0.3-0.2,1.6-0.4,2-0.6c1.1-0.3-0.6-4.3-1.5-4.1C9,5.6,8.2,5.7,7.6,5.9C7.5,6,7.4,6.1,7.3,6.1
                                    C5.1,7.5,4.8,11,7,13.6c0.8,1,1.7,1.9,2.6,2.9l0,0c0,0,0.1,0,0.1,0.1c0,0,0.1,0,0.1,0.1l0,0c0.9,0.9,2,2.2,3.8,3.4
                                    c3.8,2.5,6.7,1.8,8.4,0.9c2.9-1.6,4.2-5.1,4.2-7.8C26.1,5.9,20.3,0,13.1,0L13.1,0z M13.1,0"/>
                                    </g>
                                    </svg>
                                </div>
                                <div class="footerContactBox__cntnt">
									  <?php if(ICL_LANGUAGE_CODE=='ar'){echo ' <p>لدي سؤال؟ اتصل بنا الآن</p>';}else{echo ' <p> Have a question? call us now</p>';}?>	 
   <h4><?php echo $footer['phone_number']; ?></h4>
                                </div>
                            </a>
                        </div>
                    </div>
					<?php } ?>
					<?php if(!empty($footer['email_address'])) { ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="footerContactBox">
                            <a href="mailto:<?php echo $footer['email_address']; ?>">
                                <div class="footerContactBox__img">
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 24.8 17.6" style="enable-background:new 0 0 24.8 17.6;" xml:space="preserve">
                                    <path class="st0" d="M20.1,13.6c-0.1,0-0.2,0-0.3-0.1l-4.6-4.3c-0.2-0.2-0.2-0.4,0-0.6c0.2-0.2,0.4-0.2,0.6,0l4.6,4.3
                                    c0.2,0.2,0.2,0.4,0,0.6C20.3,13.6,20.2,13.6,20.1,13.6L20.1,13.6z M20.1,13.6"/>
                                    <path class="st0" d="M4.7,13.6c-0.1,0-0.2,0-0.3-0.1c-0.2-0.2-0.1-0.4,0-0.6l4.6-4.3c0.2-0.2,0.4-0.1,0.6,0c0.2,0.2,0.1,0.4,0,0.6
                                    L5,13.5C4.9,13.6,4.8,13.6,4.7,13.6L4.7,13.6z M4.7,13.6"/>
                                    <path class="st0" d="M22.8,17.6H2c-1.1,0-2-0.9-2-2V2c0-1.1,0.9-2,2-2h20.8c1.1,0,2,0.9,2,2v13.6C24.8,16.7,23.9,17.6,22.8,17.6
                                    L22.8,17.6z M2,0.8C1.3,0.8,0.8,1.3,0.8,2v13.6c0,0.7,0.5,1.2,1.2,1.2h20.8c0.7,0,1.2-0.5,1.2-1.2V2c0-0.7-0.5-1.2-1.2-1.2H2z
                                    M2,0.8"/>
                                    <path class="st0" d="M12.4,10.8c-0.5,0-1.1-0.2-1.5-0.5l-10.3-9c-0.2-0.1-0.2-0.4,0-0.6c0.1-0.2,0.4-0.2,0.6,0l10.3,9
                                    c0.5,0.4,1.4,0.4,1.9,0l10.3-8.9c0.2-0.1,0.4-0.1,0.6,0c0.1,0.2,0.1,0.4,0,0.6l-10.3,8.9C13.5,10.7,12.9,10.8,12.4,10.8L12.4,10.8z
                                    M12.4,10.8"/>
                                    </svg>
                                </div>
                                <div class="footerContactBox__cntnt">
										  <?php if(ICL_LANGUAGE_CODE=='ar'){echo ' <p>بحاجة الى دعم؟ ارسل لنا على</p>';}else{echo ' <p>Need Support? Drop us an email</p>';}?>	 

                                
                                    <h4><?php echo $footer['email_address']; ?></h4>
                                </div>
                            </a>
                        </div>
                    </div>
					<?php
					 }		
					if(!empty($footer['location'])) { ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="footerContactBox">
                            <a href="<?php echo $footer['location'] ?>" target="_blank">
                                <div class="footerContactBox__img">
                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="31 157 352 480" style="enable-background:new 31 157 352 480;" xml:space="preserve">
                                    <path d="M207,637c-2.386,0-4.648-1.065-6.168-2.904C193.896,625.712,31,427.576,31,333
                                    c0-97.202,78.798-176,176-176s176,78.798,176,176c0,94.576-162.896,292.712-169.832,301.096C211.648,635.935,209.386,637,207,637z
                                    M207,173c-88.324,0.101-159.899,71.676-160,160c0,78.976,129.896,245.712,160,283.288C237.104,578.704,367,411.96,367,333
                                    C366.899,244.676,295.324,173.101,207,173z"/>
                                    <path d="M315.88,302.664l-104-80c-2.877-2.214-6.883-2.214-9.76,0l-104,80
                                    c-3.499,2.697-4.149,7.721-1.452,11.22c1.514,1.964,3.852,3.115,6.332,3.116h24v88c0,4.418,3.582,8,8,8h144c4.418,0,8-3.582,8-8v-88
                                    h24c4.418-0.002,7.998-3.586,7.996-8.004C318.995,306.516,317.844,304.178,315.88,302.664z M191,397v-48h32v48H191z M279,301
                                    c-4.418,0-8,3.582-8,8v88h-32v-56c0-4.418-3.582-8-8-8h-48c-4.418,0-8,3.582-8,8v56h-32v-88c0-4.418-3.582-8-8-8h-8.48L207,239.096
                                    L287.48,301H279z"/>
                                    </svg>
                                </div>
                                <div class="footerContactBox__cntnt">
                                   <?php if(ICL_LANGUAGE_CODE=='ar'){echo ' <p>حدد لنا</p>';}else{echo ' <p>Locate Us </p>';}?>	 
                                    <h4>24.39681, 54.5010627</h4>
                                </div>
                            </a>
                        </div>
                    </div>
					<?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 footerAboutGridOuter">
                    <div class="footerLogobox">
                        <a href="<?php echo site_url(); ?>" class="footermain__logo"><img src="<?php echo $footer['footer_logo'] ?>" alt="footer_logo"></a>
                        <p><?php echo $footer['logo_content'] ?></p>
                        <a href="javascript:;" class="footermain__fax">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 378.961 392"
                                style="enable-background:new 0 0 378.961 392;" xml:space="preserve">
                                <path style="fill:#FFFFFF;"
                                    d="M378.961,274.32V129.762c0-18.16-14.801-32.961-32.961-32.961h-39.68V21.199
                        C306.32,9.52,296.801,0,285.121,0H93.84C82.16,0,72.641,9.52,72.641,21.199v75.602h-39.68C14.801,96.801,0,111.602,0,129.762V274.32
                        c0,18.16,14.801,32.961,32.961,32.961h39.68v63.52C72.641,382.48,82.16,392,93.84,392h191.281c11.68,0,21.199-9.52,21.199-21.199
                        v-63.602H346C364.238,307.199,378.961,292.48,378.961,274.32L378.961,274.32z M88.48,21.199c0-2.961,2.399-5.359,5.36-5.359h191.281
                        c2.957,0,5.359,2.398,5.359,5.359v75.602h-202V21.199z M290.559,370.801c0,2.961-2.399,5.359-5.36,5.359H93.84
                        c-2.961,0-5.36-2.398-5.36-5.359V210h202v160.801H290.559z M363.121,274.32c0,9.442-7.68,17.121-17.121,17.121h-39.68v-89.363
                        c0-4.398-3.519-7.918-7.922-7.918H80.559c-4.399,0-7.918,3.52-7.918,7.918v89.363h-39.68c-9.441,0-17.121-7.679-17.121-17.121
                        V129.762c0-9.442,7.68-17.121,17.121-17.121H346c9.441,0,17.121,7.679,17.121,17.121V274.32z M363.121,274.32" />
                                <path style="fill:#FFFFFF;" d="M56.32,145.281c-2.082,0-4.082,0.879-5.601,2.321c-1.438,1.519-2.321,3.519-2.321,5.597
                        c0,2.082,0.883,4.082,2.321,5.602c1.519,1.437,3.519,2.32,5.601,2.32c2.078,0,4.078-0.883,5.602-2.32
                        c1.437-1.442,2.316-3.52,2.316-5.602c0-2.078-0.879-4.078-2.316-5.597C60.48,146.16,58.398,145.281,56.32,145.281L56.32,145.281z
                            M56.32,145.281" />
                                <path style="fill:#FFFFFF;"
                                    d="M133.441,300.961H245.68c4.398,0,7.922-3.52,7.922-7.922c0-4.398-3.524-7.918-7.922-7.918H133.441
                        c-4.402,0-7.921,3.52-7.921,7.918C125.52,297.441,129.039,300.961,133.441,300.961L133.441,300.961z M133.441,300.961" />
                                <path style="fill:#FFFFFF;"
                                    d="M133.441,345.84H245.68c4.398,0,7.922-3.52,7.922-7.918c0-4.402-3.524-7.922-7.922-7.922H133.441
                        c-4.402,0-7.921,3.52-7.921,7.922C125.52,342.32,129.039,345.84,133.441,345.84L133.441,345.84z M133.441,345.84" />
                                <path style="fill:#FFFFFF;"
                                    d="M133.441,256.078H245.68c4.398,0,7.922-3.519,7.922-7.918c0-4.398-3.524-7.922-7.922-7.922H133.441
                        c-4.402,0-7.921,3.524-7.921,7.922C125.52,252.559,129.039,256.078,133.441,256.078L133.441,256.078z M133.441,256.078" />
                            </svg>
                            <span><?php if(ICL_LANGUAGE_CODE=='ar'){echo 'الفاكس:';}else{echo '  FAX:';}?><?php echo $footer['fax'] ?></span> </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 footerContentGrid footerBlogGridOuter">
                   <?php if(ICL_LANGUAGE_CODE=='ar'){echo '<h3>أحدث البيانات الصحفية</h3>';}else{echo ' <h3>Latest Press Releases</h3>';}?>	 
					
					<?php
				$args = array(
				'post_type' => 'post',
				'posts_per_page'=>3
			);

			$post_query = new WP_Query($args);
            if($post_query->have_posts() ) {
            while($post_query->have_posts() ) {
			$post_query->the_post();
			$img = get_the_post_thumbnail_url(get_the_ID(),'thumbnail');	
            ?>
                    <div class="footerBlog">
                        <div class="footerBlog__img">
                            <img src="<?php echo $img; ?>" alt="<?php the_title(); ?>">
                        </div>
                        <div class="footerBlog__cntnt">
                            <p><a href="<?php echo get_the_permalink(); ?>">  <?php
			           $content = get_the_title();
			          echo wp_trim_words( $content, 6, '..' );
							?></a></p>
                            <div class="calanderDate">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 25.6 25.6" style="enable-background:new 0 0 25.6 25.6;" xml:space="preserve">
                                <path class="st0" d="M23.5,2.4H20V0.8C20,0.4,19.6,0,19.2,0c-0.4,0-0.8,0.4-0.8,0.8v1.6h-4.8V0.8c0-0.4-0.4-0.8-0.8-0.8
                                    C12.4,0,12,0.4,12,0.8v1.6H7.2V0.8C7.2,0.4,6.8,0,6.4,0C6,0,5.6,0.4,5.6,0.8v1.6H2.1C1,2.4,0,3.4,0,4.5v18.9c0,1.2,1,2.1,2.1,2.1
                                    h21.3c1.2,0,2.1-1,2.1-2.1V4.5C25.6,3.4,24.6,2.4,23.5,2.4L23.5,2.4z M24,23.5c0,0.3-0.2,0.5-0.5,0.5H2.1c-0.3,0-0.5-0.2-0.5-0.5
                                    V4.5C1.6,4.2,1.8,4,2.1,4h3.5v1.6C5.6,6,6,6.4,6.4,6.4c0.4,0,0.8-0.4,0.8-0.8V4H12v1.6c0,0.4,0.4,0.8,0.8,0.8c0.4,0,0.8-0.4,0.8-0.8
                                    V4h4.8v1.6c0,0.4,0.4,0.8,0.8,0.8C19.6,6.4,20,6,20,5.6V4h3.5C23.8,4,24,4.2,24,4.5V23.5z M24,23.5"/>
                                    <rect x="5.6" y="9.6" class="st0" width="3.2" height="2.4"/>
                                    <rect x="5.6" y="13.6" class="st0" width="3.2" height="2.4"/>
                                    <rect x="5.6" y="17.6" class="st0" width="3.2" height="2.4"/>
                                    <rect x="11.2" y="17.6" class="st0" width="3.2" height="2.4"/>
                                    <rect x="11.2" y="13.6" class="st0" width="3.2" height="2.4"/>
                                    <rect x="11.2" y="9.6" class="st0" width="3.2" height="2.4"/>
                                    <rect x="16.8" y="17.6" class="st0" width="3.2" height="2.4"/>
                                    <rect x="16.8" y="13.6" class="st0" width="3.2" height="2.4"/>
                                    <rect x="16.8" y="9.6" class="st0" width="3.2" height="2.4"/>
                                </svg>
                                <span><?php echo date('M d, Y',strtotime(get_the_date())); ?></span>
                            </div>
                        </div>
                    </div>
					<?php } } wp_reset_query(); ?>
                </div>
                <div class="col-lg-3 col-md-6 footerContentGrid footerLinksGridOuter pl-lg-5">
                      <?php if(ICL_LANGUAGE_CODE=='ar'){echo '<h3> روابط مفيدة</h3>';}else{echo ' <h3>Useful Links</h3>';}?> 
					<?php 
					$args = array(
						'theme_location' => 'Footer Menu',
						'menu' => 'Footer Menu'
					);
					echo wp_nav_menu( $args ); 
					?>
                </div>
                <div class="col-lg-3 col-md-6 footerContentGrid footerFollowUsGridOuter">
                    <?php if(ICL_LANGUAGE_CODE=='ar'){echo '<h3> تابعنا</h3>';}else{echo ' <h3>Follow Us</h3>';}?> 
				<?php if(ICL_LANGUAGE_CODE=='ar'){echo '<h3> تواصل معنا عبر وسائل التواصل الاجتماعي</h3>';}else{echo '<p>Contact us via social media</p>';}?> 
                    
                    <div class="footerSocialMedia">
                        <ul>
							<?php if(!empty($footer['facebook_link'])){ ?>
                            <li><a href="<?php echo $footer['facebook_link']; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<?php } ?>
							<?php if(!empty($footer['twitter_link'])){ ?>
                            <li><a href="<?php echo $footer['twitter_link']; ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<?php } ?>
							<?php if(!empty($footer['instagram_link'])){ ?>
                            <li><a href="<?php echo $footer['instagram_link']; ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<?php } ?>
							<?php if(!empty($footer['linkdin_link'])){ ?>
                            <li><a href="<?php echo $footer['linkdin_link']; ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
							<?php } ?>
                        </ul>
                    </div>
                    <div class="newsLetterForm">
							<?php if(ICL_LANGUAGE_CODE=='ar'){echo ' <h3> اشترك في النشرة الإخبارية</h3>';}else{echo ' <h3>Subscribe Newsletter</h3>';}?> 
                       
                        <?php echo do_shortcode('[email-subscribers-form id="1"]'); ?>
                        <?php /* ?>
                        <form action="">
                            <input type="text" value="" placeholder="Enter Email Address" />
                            <button class="subscribeButton">
                                <i class="far fa-envelope"></i>
                            </button>
                        </form>
                        <?php */ ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="footerContact">
            <div class="container">
				<?php dynamic_sidebar('sidebar-5'); ?>
            </div>
        </div>
    </footer><!--Footer End-->
</main>
		<?php wp_footer(); ?>
<script>
	if ( $(".happyPatientInfomationPart").length ) { 
	   var a = 0;
$(window).scroll(function () { 
var oTop = $('.happyPatientInfomationPart').offset().top - window.innerHeight;
if (a == 0 && $(window).scrollTop() > oTop) {
$('.counter').each(function () {
var $this = $(this),
    countTo = $this.attr('data-count');
$({
    countNum: $this.text()
}).animate({
        countNum: countTo
    },
    {
        duration: 2000,
        easing: 'swing',
        step: function () {
            $this.text(Math.floor(this.countNum));
        },
        complete: function () {
            $this.text(this.countNum);
            //alert('finished');
        }

    });
});
a = 1;
}
});
	}

    
	 $(document).ready(function(){
        $('ul li:has(ul)').closest('.dropdown-menu').addClass('fullwidth');
        $('.fullwidth ul:first-child').addClass( "row" );
		

    var dropdown = document.getElementById("cat");
function onCatChange() {
    if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
        location.href = window.location.href + "?cat="+dropdown.options[dropdown.selectedIndex].value;
    }
 }
  // dropdown.onchange = onCatChange;
		
    });
$(".menu-primary-container li").on({
    mouseenter: function (ev) {
			 
	ev.preventDefault();
 		 var columnlength= $(this).find(".sub-menu h4.menu-item-link-class").length;
		  if (columnlength == '2') {
              $(this).find('.fullwidth').addClass('column-grid');
 	    	}
	  
       }, 
    mouseleave: function () {
        $(this).find('.fullwidth').removeClass('column-grid');
    }
});
	$(".menu-primary-arabic-container li").on({
    mouseenter: function (ev) {
			
	ev.preventDefault();
 		 var columnlength= $(this).find(".sub-menu h4.menu-item-link-class").length;
		  
		  if (columnlength == '2') {
              $(this).find('.fullwidth').addClass('column-grid');
 	    	}
	  
       }, 
    mouseleave: function () {
        $(this).find('.fullwidth').removeClass('column-grid');
    }
}); 
		if ( $("#okadoc-content").length ) { 
			var okaWidgetOption = okaWidgetOption || {
		heading1: "BOOK AN APPOINTMENT NOW",
		heading2: "Please Book your appointment and we will get back to you as soon as possible.",
		url: "https://danatalemarat.okadoc.com/en-ae",
		selector: "okadoc-content",
		target: "_top",
		targetUrl: "https://danatalemarat.okadoc.com/en-ae/search/result",
		clientKey: "whitelabel-danatalemarat",
		template: "eta",
		};
		(function() {
		var oka = document.createElement("script"); oka.type = "text/javascript"; oka.async = true;
		oka.src = ("https:" == document.location.protocol ? "https://" : "http://") + "danatalemarat.okadoc.com/static/js/embed.js";
		var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(oka, s);
		})();
		}
   
</script>
<script>
      jQuery('select').on('change', function() {
       var selecteddoc_link = ( this.value );
		   jQuery('.selecteddoc').attr("href", selecteddoc_link);
		 
});
jQuery('select[name="main_cat"]').on('change', function() {
	   jQuery(".doctorsFilterOuter").addClass("current");
       jQuery(".doc").css("display", "none");
 
});	
	 jQuery('select[name="main_cathead"]').on('change', function() {
		  jQuery(".doctorsFilterOuter").addClass("current");
		  jQuery(".doc").css("display", "none"); 
});	
	
	jQuery('select[id="new_selecthead"]').on('change', function() {
	 
       if($('select[name="main_cathead"]').val("Select Service") ) {
                jQuery('select[name="main_cathead"]').attr('disabled', 'disabled');   
   }
 
});	
	
</script>

<script>
    $(document).ready(function() {
  // Construct URL object using current browser URL
  var url = new URL(document.location);

  // Get query parameters object
  var params = url.searchParams;
   
  // Get value of delivery results
  var results_delivery = params.get("dr");
	 var serviceid = params.get("sr");
    
  // Set it as the dropdown value
      $('select[name="doctors"]').val(results_delivery);
        $('select[name="service"]').val(serviceid);

    	$("#ser_cat").change(function(){
		     $("#dr_cat ").empty();
			  $.ajax({
				type: "post",
				url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
				//dataType: "text",
				data: { action: 'get_dr_form', 
				   sr_id: $("#ser_cat option:selected").attr('id') },
				    beforeSend: function() {$("#loading").fadeIn('slow');},
					success: function(data) {
 					   	$("#dr_cat ").append(data);
					
              }
				});
		 
		})
	 
		});
 
</script>
  
<!--  <script type="text/javascript">
 (function($){

    $("#selectboxid1").on('change', function(){
		 
		  if($('.wpml-ls-native').attr("lang") == 'ar') {
					 var current_language = 'en';
				 }else{
					  var current_language = 'ar';
				 }
           $(".doctorsTeamOuter ").empty();
			$.ajax({
				type: "post",
				url: "",
				//dataType: "text",
				data: { action: 'my_action', 
                   lang: current_language,
                    order:  "Asc", },
				  
					success: function(data) {
						alert('yes');
 					     }
				});
	});
	  	})(jQuery);
</script>   -->
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script language="javascript">
  
		$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
   
    $('#appt-date').attr('min', maxDate);
});
 
</script>
<script>
	
	$('#selectboxid').on('change', function() {
		var order = $("#selectboxid option:selected").val();
		
         	if ($("#selectboxid").val() === "") {
			
            $('body').removeClass('desc_order');
			 $('body').addClass('Asc_order');
        }
		else if ($("#selectboxid").val() === "bydefault")  {
               $('body').removeClass('Asc_order');
			    $('body').removeClass('desc_order');
       }
		else{
		 $('body').addClass('desc_order');
			$('body').removeClass('Asc_order');
	 	  }
		
   });
		 
 
</script>

<script type="text/javascript">
		(function($){
		$("#selectboxid").change(function(){
		  if ( $("#main_cat option:selected").val()!='-1') {  
               
         
			var value = $("#selectboxid").val();
			  if($('.wpml-ls-native').attr("lang") == 'ar') {
					 var current_language = 'en';
				 }else{
					  var current_language = 'ar';
				 }
			if (value =="dsc"){
			         $(".doctorsTeamOuter ").empty();
			$.ajax({
				type: "post",
				url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
				//dataType: "text",
				data: { action: 'desending_order', 
                   lang: current_language,
                  cat_id: $("#main_cat option:selected").val() },
				    beforeSend: function() {$("#loading").fadeIn('slow');},
					success: function(data) {
 					//window.location = "http://your/url";
					$("#loading").fadeOut('slow');
					  $(".doctorsTeamOuter").append(data);
					  var language = $('.wpml-ls-native').attr("lang") ;
				        if (language == 'en') {
					       $('input.commonButton').val('بحث');
                           }	 
              }
				});
			}
			  else if (value == "bydefault")  {
				    $(".doctorsTeamOuter ").empty();
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
					  $(".doctorsTeamOuter").append(data);
					  var language = $('.wpml-ls-native').attr("lang") ;
				        if (language == 'en') {
					       $('input.commonButton').val('بحث');
                           }	 
              }
				});
				  
			  }
			else{
		  $(".doctorsTeamOuter ").empty();
			$.ajax({
				type: "post",
				url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
				//dataType: "text",
				data: { action: 'Assending_order', 
					    lang: current_language,
                  cat_id: $("#main_cat option:selected").val() },
				    beforeSend: function() {$("#loading").fadeIn('slow');},
					success: function(data) {
 					//window.location = "http://your/url";
					$("#loading").fadeOut('slow');
					  $(".doctorsTeamOuter").append(data);
					  var language = $('.wpml-ls-native').attr("lang") ;
				        if (language == 'en') {
					       $('input.commonButton').val('بحث');
                           }	 
              }
				});
			}
			
		  }
			 
		});


	 
		})(jQuery);
</script>

<style>
  .doctorsTeamOuter.ASEC:first-child {
    border: 0px;
    padding: 0;
    margin: 0;
}
	 .doctorsTeamOuter.desc:first-child {
    border: 0px;
    padding: 0;
    margin: 0;
}
	 .doctorsTeamOuter.Asendeing:first-child {
    border: 0px;
    padding: 0;
    margin: 0;
}
	.doctorsTeamOuter.desc:nth-child(2) {
    border: 0;
    padding: 0;
    margin: 0;
}
	 .doctorsTeamOuter.Asendeing:nth-child(2){
    border: 0px;
    padding: 0;
    margin: 0;
}
	.doctorsTeamOuter.Asendeing:nth-child(3){
		   border: 0px;
    padding: 0;
    margin: 0;
	}
</style>
	<script>
		jQuery(document).on('click', '.pagination_dr a', function(e) {
			
			  window.scrollTo({ top: 300, behavior: 'smooth' });
             e.preventDefault();
			 var ajax_load = "<img src='<?php echo get_template_directory_uri(); ?>/assets/images/ajax-loader.gif;' alt='loading...' />";
              var url = $(this).attr('href');
				  jQuery('.doctorsTeamOuter').html(ajax_load).load(url + ' div.doctorsTeamOuter');
				 
                  });
		
		var divs = $(".partnermainSection > div");
for(var i = 0; i < divs.length; i+=2) {
    divs.slice(i, i+2).wrapAll("<div class='partner__container'><div class='partnerSection'><div class='partner__row'></div></div></div>");
}
		
		
			</script>  
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src='https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js'></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>


   </body>
</html>
