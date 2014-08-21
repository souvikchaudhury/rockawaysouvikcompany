<?php
/**
 * Template Name: Full-width Page Template, No Sidebar
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

         <div id="content_inner">
			 <?php
			   $str=$_SERVER['REQUEST_URI'];
			  $found=strpos($str,"performance-calendar"); 
			  if($found==false){ ?>
			 <h1><?php  the_title(); ?></h1>
		    <?php }else{ ?>
				 <h1>performance calendar</h1>
			<?php }?>
            <div class="content_area_inner">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php //comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
</div>
</div>
<?php get_footer(); ?>
