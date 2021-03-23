import gulp from 'gulp';
import sass from 'gulp-sass';
import sourcemaps from 'gulp-sourcemaps';
import postcss from 'gulp-postcss';
import pump from 'pump';
import notify from 'gulp-notify';
import tildeImporter from 'node-sass-tilde-importer';
import { assets, dist, successMessage } from '../gulp.settings.babel';

gulp.task( 'sass', cb => {
	const fileSrc = [ 'admin', 'editor', 'frontend', 'shared' ].map(
		file => `${assets}/scss/${file}/${file}.scss`
	);

	pump( [
		gulp.src( fileSrc ),
		sass( {
			importer: tildeImporter,

			// includePaths: [ nodeModules ]
		} )
			.on( 'error', sass.logError ),
		sourcemaps.init( {
			loadMaps: true,
		} ),
		postcss( [
			require( 'postcss-import' ),
			require( 'postcss-preset-env' )( { stage: 0 } ),
		] ),
		gulp.dest( `${dist}/css` ),
		sourcemaps.write( './', {
			mapFile: function( mapFilePath ) {
				return mapFilePath.replace( '.css.map', '.min.css.map' );
			},
		} ),
		notify( { message: successMessage( 'sass' ), onLast: true } ),
	], cb );

} );
