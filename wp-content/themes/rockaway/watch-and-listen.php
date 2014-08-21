<?php
/*
Template Name: Watch And Listen
*/
?>

<?php get_header(); ?>



<div id="content_inner">
			 <h1><?php  the_title(); ?></h1>
            <div class="content_area_inner">
				
          <ul class="audition_list">
				   
		   <?php
			query_posts('cat=8'.'&orderby=date&order=desc');
			while (have_posts()) : the_post();
			?>
				<li>
				 <div class="listen_video">
				<?php  echo $key_1_video = get_post_meta(get_the_ID(), 'video',true); ?>
				</div>
				<div class="listen_txt">
					<h4><?php the_title(); ?></h4>		
					<p><?php echo get_the_content(); ?></p>		
				</div>
			  </li>
          <?php endwhile; ?>		   
       </ul>
  


		</div><!-- #content -->
	</div><!-- #primary -->
</div>
</div>
<?php get_footer(); ?>
