<header>
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="cell">
				<?php
				if ( is_404() ) {
					echo '<h1>' . __( 'Page not found', 'wordpoint-base' ) . '</h1>'; // WPCS: XSS Ok.
				} elseif ( is_archive() ) {
					the_archive_title( '<h1>', '</h1>' );
				} else {
					the_title( '<h1>', '</h1>' );
				}
				?>
			</div>
		</div>
	</div>
</header>
