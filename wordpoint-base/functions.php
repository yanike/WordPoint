<?php
/**
 * WP Theme constants and setup functions
 *
 * @package wordpoint-base
 */

// Useful global constants.
define( 'WORDPOINT_BASE_VERSION', '0.1.0' );
define( 'WORDPOINT_BASE_URL', get_stylesheet_directory_uri() );
define( 'WORDPOINT_BASE_TEMPLATE_URL', get_template_directory_uri() );
define( 'WORDPOINT_BASE_PATH', get_template_directory() . '/' );
define( 'WORDPOINT_BASE_INC', WORDPOINT_BASE_PATH . 'inc/' );
define( 'WORDPOINT_BASE_NAMESPACE', 'WORDPOINT_Base' );

// Require function files.
$wordpoint_inc = [
	'autoload',
	'core',
	'template-tags',
	'foundation',
	'images',
	'icons',
];

foreach ( $wordpoint_inc as $inc ) {
	if ( file_exists( WORDPOINT_BASE_INC . $inc ) ) {
		require_once WORDPOINT_BASE_INC . $inc;
	}
}

// Run the setup functions.
WORDPOINT_Base\Core\setup();

// Require Composer autoloader if it exists.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once 'vendor/autoload.php';
}

foreach ( [ 'post-types', 'taxonomies' ] as $dir ) {
	foreach ( glob( WORDPOINT_BASE_PATH . "/inc/$dir/*.php" ) as $inc ) {
		require_once $inc;
	}
}
