<?php get_header('post'); ?>

<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			
			get_template_part( 'template-parts/content', get_post_type() );

			?>
			<div class="container">
			<?php  
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>
			</div>
			<?php  

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php get_footer();