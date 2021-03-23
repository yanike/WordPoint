<?php get_header(); ?>

<div class="grid-container">
	<div class="grid-x grid-padding-x">

		<div class="medium-7 large-8 cell">

			<main id="main" class="page-404__sidebar">
				<?php _e( 'This page cannot be found. Please try your search again or go back to the homepage.', 'wordpoint-base' ); // WPCS: XSS Ok. ?>
			</main>

		</div><!-- .cell -->

		<div class="medium-5 large-4 cell">

			<aside id="sidebar" class="page-404__sidebar">
				<?php get_sidebar(); ?>
			</aside>

		</div><!-- .cell -->

	</div><!-- .grid-x -->
</div><!-- .grid-container -->

<?php get_footer(); ?>
