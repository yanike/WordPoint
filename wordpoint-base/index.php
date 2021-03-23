<?php
/**
 * The main template file.
 *
 * @package wordpoint-base
 */

get_header();
?>

<div class="grid-container">
	<div class="grid-x grid-padding-x">

		<div class="medium-7 large-8 cell">

			<main id="main" class="page-index__sidebar">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						get_template_part( 'parts/content', 'page' );
					endwhile;
				endif;
				?>
			</main>

		</div><!-- .cell -->

		<div class="medium-5 large-4 cell">

			<aside id="sidebar" class="page-index__sidebar">
				<?php get_sidebar(); ?>
			</aside>

		</div><!-- .cell -->

	</div><!-- .grid-x -->
</div><!-- .grid-container -->

<?php get_footer(); ?>
