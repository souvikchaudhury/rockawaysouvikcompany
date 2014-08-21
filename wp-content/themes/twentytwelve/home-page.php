<?php
/*
Template Name: Home Page
*/
?>
<?php get_header(); ?>
<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script type="text/javascript">
	$("#maindialog").show();
</script>
       <div id="maindialog" >
	   <div class="dialog">
	    	<div class="wrappers">
				<div class="headers1">
					<div class="logos"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="" width="90px" /></a></div>
                    <div class="logos2"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="" width="90px" /></a></div>
					<h2 class="specialh2">**URGENT GOVERNMENT SHUTDOWN ALERT**</h2>
					<h3 class="specialh3">Rockaway Theatre Company is currently <span class="redT">CLOSED</span> due to the Federal Government Shutdown.</h3>
                    <p class="tag">As a supporter of the Rockaway Theatre Company (RTC), this is what you need to know:</p>
					
					
				</div>


				<div class="containers">
                
					<ul>
                    
                    <li>
                    <h4>Why is RTC affected?</h4>
                    <p>The Post Theatre (RTC’s Theatre Venue) is located on Fort Tilden, which is a part of Gateway National Recreation Area. Gateway National Recreation Area is a National Park, and is therefore closed to the public because of the Government Shutdown. This means that not only do supporters not have access to RTC, but RTC Volunteers, Actors and Executive staff does not have access to the Post Theatre either.</p>
                    </li>
                    
                    <li>
                    <h4>Will the shows & workshops still go forward as scheduled?</h4>
                    <p>No. In the event of a continued Government Shutdown, we do not have access to our Performance Venue, or any of our Theatrical Equipment, therefore we cannot rehearse or perform.</p>
                    <p><strong>IF YOU ARE A MEMBER OF A THEATRE WORKSHOP:</strong> RTC is working diligently to find local venues to host our workshops. In the event of an extended Government Shutdown <U>AND</U> if we can find a venue to host our workshops, you will be contacted by your Theatre Workshop Instructor as to where and when your class will be held.</p>
                    </li>
                    
                    <li>
                    <h4 class="specialh3" style="text-align:left;">I’ve reserved tickets for <i>“How to Succeed in Business without Really Trying”</i>, What do I do?</h4>
                    <p>Our best advice is: <strong>Watch the news!</strong> If the National Park Service is reinstated, the performances will go on as scheduled.</p>
                   
                    <ul>
                    <h5>Other places to watch:</h5>
                    <li><a href="http://www.rockawaytheatrecompany.org">www.rockawaytheatrecompany.org</a> – our website! We will have continued postings and updates as to show cancellations and updates on the situation.</li>
                    <li><a href="http://www.facebook.com/RockawayTheatreCompany">www.facebook.com/RockawayTheatreCompany</a> - Our Facebook Page. The Updates and postings with regards to our situation will be posted here as well</li>
                    <li><a href="http://twitter.com/RockawayTheatre">twitter.com/RockawayTheatre</a> - Our Twitter feed. Up-to-the-minute details will be posted as we get them!</li>
                    </ul>
                    
                    </li>
                    <p>We encourage all of our supporters to continue to reserve tickets either by calling the Ticket Hotline or by visiting our website. In the event that the National Park Service is reinstated, and Fort Tilden is reopened, the show will go on!</p>
                    </ul>
                    
                    <div class="question"><span>All questions can be directed to:</span> <span><a href="mailto:rockawaytheatre@verizon.net">rockawaytheatre@verizon.net</a></span></div>
                    
			</div>


</div>
	    	<div class="proceed" id="hhgg">OK, PROCEED TO RTC WEBSITE</div>
	    </div>
	  </div> 
pop up end-->

        <div id="banner"><img src="<?php echo get_template_directory_uri(); ?>/images/lft_shdo.png" alt="" width="21" height="337" class="lft_img" />
       <?php  if(function_exists('fhs_display_front'))
				{
				echo fhs_display_front();
				}
        ?>
         <img src="<?php echo get_template_directory_uri(); ?>/images/rgt_shdo.png" alt="" width="21" height="337" class=" rgt_img" /></div>
  <div id="content_area">
  <div id="left_content">
		  <div class="lft_wh_bx">
		
		   <div id="slider4" class="sliderwrapper">
		        <h1>views of the stage</h1>
			
		   <?php  query_posts('cat=6'.'&orderby=date&order=desc&showposts=4');
					while (have_posts()) : the_post();
		                   $thumbnail_id = get_post_thumbnail_id(get_the_ID());
					//$stage_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
					//$stage_image = get_the_post_thumbnail($post->ID, array(307,251));
					//$stage_image  = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
					?>
		<?php if (!empty($thumbnail_id))
		{
		  $thumbnail = wp_get_attachment_image_src($thumbnail_id, 'full');
		  if (count ($thumbnail) >= 3)
		  {
		    $thumbnail_url = $thumbnail[0];
		    $thumbnail_width = $thumbnail[1];
		    $thumbnail_height = $thumbnail[2];
		    $thumbnail_w = 307;
		    $thumbnail_h = floor($thumbnail_height * $thumbnail_w / $thumbnail_width);
		  }
		}
		?>
		
				<div class="contentdiv">
					<?php //echo $stage_image; ?>
			<!--<img src="<?php echo site_url();?>/wp-content/themes/twentytwelve/resize.php?img=<?php// echo $stage_image[0]; ?>&h=<?php //echo "151" ?>&w=<?php echo "307"; ?>" alt="<?php the_title(); ?>" />-->
				<!--<img src="<?php //echo $stage_image; ?>" alt="" width="307" height="151" />-->
		<img class="thumbnail" src="<?php echo $thumbnail_url; ?>" alt="<?php the_title_attribute(); ?>"
		       width="<?php echo $thumbnail_w; ?>" height="<?php echo $thumbnail_h; ?>" />
		
				<p> <?php echo wp_trim_words(get_the_content(), 20, ' ....');  ?></p>
				<a href="<?php echo get_permalink($recent["ID"]); ?>">Read More...</a>
				</div>
			<?php		
				endwhile;
		    ?>
		</div>
		
		<div id="paginate-slider4" class="view_stage_list">
			<?php query_posts('cat=6'.'&orderby=date&order=desc&showposts=4');
					while (have_posts()) : the_post();
					$stage_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
					 $thumbnail = get_the_post_thumbnail($post->ID, array(55,48));
			?>
			<a href="#" class="toc"><?php echo $thumbnail; ?>
		              <?php echo wp_trim_words(get_the_content(), 12, ' ....');  ?></a>
		   <?php		
				endwhile;
		    ?>
		
		</div>
		
		<script type="text/javascript">
		
		featuredcontentslider.init({
		id: "slider4", //id of main slider DIV
		contentsource: ["inline", ""], //Valid values: ["inline", ""] or ["ajax", "path_to_file"]
		toc: "markup", //Valid values: "#increment", "markup", ["label1", "label2", etc]
		nextprev: ["", "Next"], //labels for "prev" and "next" links. Set to "" to hide.
		revealtype: "click", //Behavior of pagination links to reveal the slides: "click" or "mouseover"
		enablefade: [true, 0.1], //[true/false, fadedegree]
		autorotate: [false, 3000], //[true/false, pausetime]
		onChange: function(previndex, curindex, contentdivs){ //event handler fired whenever script changes slide
		//previndex holds index of last slide viewed b4 current (0=1st slide, 1=2nd etc)
		//curindex holds index of currently shown slide (0=1st slide, 1=2nd etc)
		}
		})
		
		</script>
  </div>
  
  <div class="lft_wh_bx">
<h1>  plays and events</h1>
		<?php  require_once 'front_ticketinformation.php'; ?>
  </div>
  
  <div class="lft_wh_bx"><h1>location</h1>
  <div class="location">
<div class="location_txt"><h2>  Address</h2>
<p>Rockaway Theatre Company
The Post Theatre<br />Building T4<br />Fort Tilden/Rockaway, NY
</p>
<p>
	Enter Your Starting Address: 
	<br>
	<p>
		<div class="googlemapform">
	        <input type="hidden" name="address1" value="<?php echo get_option('officeAddrs',true); ?>" class="address_input1" size="40" />
	        <input type="text" name="address2" placeholder="Enter Your Starting Address" class="address_input" size="40" />
	        <input type="submit" name="find" value="Search" class="grey_butt getdistancesubmit"/>
	    </div>
    </p>
    <p id="results"></p>

</p>
</div>
<iframe width="389" height="214" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=40.564465,-73.885009&amp;aq=&amp;sll=40.561058,-73.880224&amp;sspn=0.016334,0.042272&amp;ie=UTF8&amp;t=m&amp;ll=40.564221,-73.887906&amp;spn=0.006977,0.016651&amp;z=15&amp;output=embed"></iframe>
</div>
  </div>
  
  </div>
  <div id="right_content">
  <div class="rgt_wh_bx"><h1>latest news</h1>
  <div class="rgt_wh_inner">
	 <!--<img src="<?php //echo get_template_directory_uri(); ?>/images/news_img.jpg" alt="" width="294" height="152" class="rgt_img"/>-->
	  <?php
			query_posts('cat=4'.'&orderby=date&order=desc&showposts=1');
			while (have_posts()) : the_post();
			$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
			// $feat_image = get_the_post_thumbnail($post->ID, array(294,200));
 
			?>
			<?php //echo $feat_image; ?>
		<img src="<?php echo $feat_image; ?>" alt="" width="294" height="152" class="rgt_img"/>
		<h2><?php the_title(); ?></h2>
		<?php echo wp_trim_words(get_the_content(), 12, ' ....'); ?><a href="<?php the_permalink() ?>" >Read more</a>
	<?php		
		endwhile;
		  ?>  
    </div>
  </div>
  <div class="rgt_wh_bx"><h1>watch and listen</h1>
  <div class="rgt_wh_inner">
	  	  <?php
			query_posts('cat=7'.'&orderby=date&order=desc&showposts=1');
			while (have_posts()) : the_post();
		
			?>
      <?php 
      echo $key_1_video = get_post_meta(get_the_ID(), 'video',true);
      
      
      //echo the_meta('video');?>
      <h2><?php the_title(); ?></h2>
      <p><?php echo wp_trim_words(get_the_content(), 20, ' ....'); ?></p>
     <?php endwhile; ?>

<a href="<?php echo get_site_url(); ?>/watch-and-listen" class="grey_butt">View All</a>
    </div>
  </div>
  <div id="other" class="domtab doprevnext">
  <h1>blogs</h1>
   
	<ul class="domtabs">
		<li><a href="#t1">recent</a></li>
		<!--<li><a href="#t2">popular</a></li>
		<li><a href="#t3">comments</a></li>
		<li class="last_tab"><a href="#t4">Test 4</a></li>-->
	</ul>
		<div>
		<ul class="recent_bx" id="t1">
			 <?php   $args        = array( 'numberposts' => '3' ,'category' => '1','orderby' => 'post_date','order' => 'DESC',);
					 $recent_posts = wp_get_recent_posts( $args );
					 foreach( $recent_posts as $recent ){
					 //$feat_image = wp_get_attachment_url( get_post_thumbnail_id($recent["ID"]) );
					 $postThumbnail = get_the_post_thumbnail($recent["ID"], array(48,47));
				
			 ?>
				<li>
					<?php if($postThumbnail!=""){
				      echo $postThumbnail; } ?>
				 <!--<p><a href="<?php //echo get_permalink($recent["ID"]); ?>"><?php //echo $recent["post_title"]; ?></a></p>-->
				 <p><?php echo substr($recent["post_content"],0,50); ?>....</p>
				 <a href="<?php echo get_permalink($recent["ID"]); ?>"><?php echo date('j F, Y', strtotime($recent["post_date"])); ?></a>
				</li>
		 <?php } ?>
        </ul>
	</div>
	<!--<div>
		<h2><a name="t2" id="t2">Proof 2</a></h2>
		<p>Test to prove that more than one menu is possible</p>
		<p><a href="#top">back to menu</a></p>
	</div>
	<div>
		<h2><a name="t3" id="t3">Proof 3</a></h2>
		<p>Test to prove that more than one menu is possible</p>
		<p><a href="#top">back to menu</a></p>
	</div>-->
	<!--<div>
		<h2><a name="t4" id="t4">Proof 4</a></h2>
		<p>Test to prove that more than one menu is possible</p>
		<p><a href="#top">back to menu</a></p>
	</div>-->
    
</div>

  </div>
  </div>
</div>
</div>
        
<?php get_footer(); ?>