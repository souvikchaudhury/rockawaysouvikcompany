<?php 
/*template name: VIDEO44 */
get_header(); ?>
	 <!--  <div class="banner"></div>
    subscribe -->
    <div class="subscribe">
     <h2>Sign up for my fat-burning newsletter and get your life back!</h2> <a href="#login-box" class="login-window nectar-button accent-color" href="#">SUBSCRIBE</a>
    </div>
    <!-- /subscribe -->
    <!-- popup box -->
    <div id="login-box" class="login-popup">
      <!-- popup header -->
       <div class="popupHeader">
        <img src="<?php echo content_url();?>/themes/FBM/images/featured-sml.jpg" width="639" height="56" alt="FBM Featured" /> 
        <a href="#" class="close"><img src="<?php echo content_url();?>/themes/FBM/images/close.jpg" width="27" height="26" class="btn_close" title="Close Window" alt="Close" /></a>
       </div>
      <!-- /popup header -->
      <!-- popup box content -->
       <div class="boxContent">
        <h2>WANT TO BURN BELLY FAT, BEAT CRAVINGS, AND <span>LOOK GREAT?</span></h2>
        <ul>
         <li><span>Discover the secrets</span> of how I lost 20 pounds in 40 days </li>
		 <li><span>Learn how to shed belly fat and get 6 pack abs </span> without changing your exercise plan</li> 
		 <li><span>Optimize your workouts</span> with tricks from top personal trainers in the world</li>
		 <li><span>Get inspiration</span> to look and feel great for the rest of your life</li>
         <li><span>And much  more...</span></li>
        </ul>
        <div class="testimonial">“Abel is a great guy who produces excellent content. Subscribe to his e-mail list. You’ll be smarter, happier, and healthier for doing so.”<div class="details">- Dave Asprey, <span>The Bulletproof Exec</span></div></div>
        <div class="join">JOIN THE 100,000 READERS AND LISTENERS IN THE <span>WILD DIET TRIBE</span> TODAY!</div>
        <form accept-charset="UTF-8" action="https://qk160.infusionsoft.com/app/form/process/6cd5ca8ae2f6b55cea382cf45648bd25"; class="infusion-form" method="POST">
            <input name="inf_form_xid" type="hidden" value="6cd5ca8ae2f6b55cea382cf45648bd25" />
            <input name="inf_form_name" type="hidden" value="Web Form" />
            <input name="infusionsoft_version" type="hidden" value="1.29.9.21" />
            <div class="infusion-field">
            <input class="infusion-field-input-container textBox" id="inf_field_Email" name="inf_field_Email" type="text" autocomplete="on" value="Enter Your Best Email Address" onfocus="(this.value == 'Enter Your Best Email Address') && (this.value = '')"
       onblur="(this.value == '') && (this.value = 'Enter Your Best Email Address')" />
            </div>
            <div class="infusion-submit">
            <input type="submit" value="SUBSCRIBE NOW" class="submit_btn" />
            </div>
         </form>
       </div>
      <!-- popup box content -->  
     </div>
     
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo content_url();?>/themes/FBM/js/custom.js"></script>
    <!-- popup box -->
<div class="container-wrap">
	
	<div class="container main-content">
		
		<div class="row">
			
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
			
			VIDEO WORKSSSS
				
				<?php the_content(); ?>
	
			<?php endwhile; endif; ?>
				
	
		</div><!--/row-->
		
	</div><!--/container-->
	
</div>
	
<?php get_footer(); ?>