<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
get_header(); ?>

	<div id="content_inner">
    
		<div id="content_area_inner">
       
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php  comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
<?php $str=$_SERVER['REQUEST_URI'];
			  $found=strpos($str,"performance-calendar"); 
			  if($found==false){ ?>
        <?php get_sidebar(); ?>
        <?php } ?>
		</div><!-- #content -->
         
	</div><!-- #content -->
	</div><!-- #primary -->
</div>
</div>

<?php get_footer(); ?>
