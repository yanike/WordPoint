// Import external dependencies.
import 'what-input';

// Import Foundation.
// Alternatively, you can import only the plugins/components that you need.
import 'foundation-sites/js/entries/foundation';
import 'foundation-sites/js/entries/foundation-plugins';

// Import local dependencies.
import Router from '../_util/Router';

// Import route for each page.
import common from './routes/common';
import home from './routes/home';

// Populate Router instance with DOM routes.
const routes = new Router( {
	common, // All pages
	home, // Home page
} );

// Init Foundation.
jQuery( document ).ready( $ => ( $( document ).foundation() ) );

// Load route events.
jQuery( document ).ready( () => routes.loadEvents() );
