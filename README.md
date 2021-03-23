WordPoint Theme
=====================

This starter theme was inspired by (and large chunks of it just plain stolen from) a few great sources that deserve credit:

* [Theme Scaffold](https://github.com/10up/theme-scaffold) by [10up](https://10up.com/)
* [FoundationPress](https://github.com/olefredrik/FoundationPress/) by [olefredrik](https://github.com/olefredrik/)
* [Sage](https://github.com/roots/sage/) by [Roots](https://roots.io/)

## Authors
* [Yanike Mann](https://github.com/yanike )
* [Chance Strickland](https://github.com/chaance )

## Dependencies

1. [Node & NPM](https://www.npmjs.com/get-npm) - Build packages and 3rd party dependencies are managed through NPM, so you will need that installed globally. We recommend using [`nvm`](https://github.com/creationix/nvm) to develop with Node v8.11.
2. [Gulp](https://gulpjs.com/) - Gulp is used as the main task runner. it runs Sass, PostCSS, processes images/SVG files, and executes Webpack.
3. [Webpack](https://webpack.js.org/) - Webpack is used to process the JavaScript.
4. [Composer]() - Install and manage PHP dependencies.

## Getting Started

### Get Started
Eventually there will be a CLI tool to quickly setup and deploy new projects.

For now, start by setting up a local install of WordPress. From there:
* Clone this repo into the root directory alongside your core WordPress files
* Move the starter theme's directory (`wordpoint-base`) into `wp-content/themes`.
* Rename `wordpoint-base` to your project name.
	* We recommend using something short but unique. To prevent any conflict with public themes in the WP repo, always use the wordpoint prefix (e.g., wordpointclientname).
* Do case-sensitive search/replace for the following:
	* **wordpoint-base** (e.g., WordpointClientName)
	* **WORDPOINT_BASE** (e.g., WORDPOINT_CLIENT_NAME)
	* **WORDPOINT_Base** (e.g., WORDPOINT_Client_Name)
	* **wordpoint-base** (e.g., wordpoint-client-name)
	* **wordpoint_base** (e.g., wordpoint_client_name)
	* **WORDPOINT Base** (e.g., WORDPOINT Client Name)
* Delete the left over empty directory from the repo.
	* Be sure to keep the `.gitignore` file in the root directory, as you'll need to push to WP Engine from here.
* `cd` into the theme folder.
* run `npm run start` to begin development.

The reason we don't setup the repo directly inside the theme directory in our case is because WP Engine's Git Push tool does not like Git submodules, and if you forget to remove `.git` from the theme folder, you'll notice nothing gets deployed after you push your work. This will all be restructured once our Pipelines configuration is in place and we no longer rely on WP Engine for deployment.

#### TODOs:
* Finalize Pipelines configuration, test, and merge into this project
* Develop bash script to handle setup, DB syncronization, and deployment

## Commands

`npm run start` (install dependencies and run initial Gulp)

`npm run watch` (watch)

`npm run build` (build all files)

`npm run deploy` (build all files ready for deployment)

## Contributing

We welcome pull requests and spirited, but respectful, debates. One goal of ours is to audit, consolidate and remove dependencies as regularly as we can without sacrificing efficiency, adding complexity or harming cross-browser support.

1. Fork it!
2. Create your feature branch: `git checkout -b feature/my-new-feature`
3. Commit your changes: `git commit -am 'Added some great feature!'`
4. Push to the branch: `git push origin feature/my-new-feature`
5. Submit a pull request

## Theme Features

### Linting
We have configured linting tools to conform to the WordPress coding standards with some minor variance. We recommend installing `stylelint`, `eslint` and `phpcs` and the corresponding WP standards globally, but each will also be installed as project dependencies with the theme. You'll also want to install a few exntensions for your editor to make these standards easier to follow.
* **Editor Config** [ [Base package](https://editorconfig.org/) | [Atom](https://github.com/sindresorhus/atom-editorconfig) | [Sublime](https://github.com/sindresorhus/editorconfig-sublime) | [VS Code](https://github.com/editorconfig/editorconfig-vscode) ]
* **Eslint** [ [Base package](https://github.com/eslint/eslint) | [Atom](https://github.com/AtomLinter/linter-eslint) | [Sublime](https://github.com/SublimeLinter/SublimeLinter-eslint) | [VS Code](https://github.com/Microsoft/vscode-eslint) | [eslint-config-wordpress](https://www.npmjs.com/package/eslint-config-wordpress) ]
* **Stylelint** [ [Base package](https://github.com/stylelint/stylelint) | [Atom](https://atom.io/packages/linter-stylelint) | [Sublime](https://github.com/SublimeLinter/SublimeLinter-stylelint) | [VS Code](https://github.com/shinnn/vscode-stylelint) | [stylelint-config-wordpress](https://www.npmjs.com/package/stylelint-config-wordpress) ]
* **PHP CodeSniffer** [ [Base Package](https://github.com/squizlabs/PHP_CodeSniffer) | [Atom](https://atom.io/packages/linter-phpcs) | [Sublime](https://github.com/squizlabs/sublime-PHP_CodeSniffer) | [VS Code](https://github.com/ikappas/vscode-phpcs) | [WordPress-Coding-Standards](https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards) ]

### JavaScript DOM-based routing
We borrowed (stole?) the concept of DOM-based routing for JavaScript from [Sage](https://roots.io/sage/docs/theme-development-and-building/). This functionality enables you to run specific scripts on specific pages. Routes (and the scripts they include) run when the route name matches a class on the body element of the current page.

Out of the box, it comes with two routes:
* `common`, which fires on all pages
* `home`, which fires on the home page (when the body has the class home)

One note: the route must be converted to camel case when the body class in question uses hyphenated strings. So if your body class matches the slug `about-us`, your route name would be `aboutUs`.

Note also that the route's file name (e.g., `aboutUs.js`) doesn't have to match the body class. What's important is that the name used for the import that is registered with the router (`aboutUs`) matches.

Every route is defined in its own file in `assets/js/frontend/routes`.

Each route includes two methods: init() and finalize():

```javascript
export default {
	init() {
		// scripts here run on the DOM load event
	},
	finalize() {
		// scripts here fire after init() runs
	}
};
```

The order of execution for routes is:

1. The `init` scripts in the `common` route (after the browser's DOM load event)
2. For each route matching the loaded page (e.g., `home`), the `init` scripts and then the `finalize` scripts
3. The `finalize` scripts in the common route
4.
More than one page-specific route might can a given page. For example, if you register both a route matching all single posts (`singlePost`) and a route for single posts with the video post format (`singleFormatVideo`), both would fire when a video post is viewed.

To add scripts to an existing route, add the desired JavaScript within the route's `init()` or `finalize()` methods. For example, the `init()` method on the `common` route might contain the code needed to toggle your site's menu when its icon is clicked.

Because all routes run after the browser has fired the DOM load event, you do not need to wrap the code in your routes within an event handler that watches for that event (e.g., `jQuery(document).ready()`).

#### Adding a new route
As an example, let's add a route that runs when a page with the default template is viewed. The class for this page is `page-template-default`, so our route will be named `pageTemplateDefault`.

1. Create the file `assets/js/frontend/routes/pageTemplateDefault.js` with the following contents:

```javascript
export default {
	init() {
		// scripts here run on the DOM load event
		console.log( 'This is a page with the default template.' );
	},
	finalize() {
		// scripts here fire after init() runs
	}
};
```

2. Import your new route in main.js:

```javascript
// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import pageTemplateDefault from './routes/pageTemplateDefault'; // add this line!
```

3. Also in `frontend.js`, register your route:

```javascript
/** Populate Router instance with DOM routes */
const routes = new Router( {
	common,
	home,
	pageTemplateDefault // add this line!
} );
```

1. After rebuilding your site's assets, when you load a page with the default template, your new route should run and you should see 'This is a page with the default template.' printed in your browser's console.

#### 3rd party packages
Example of how to add 3rd party packages* and have them included in the theme:

1. From the theme directory, add the package using `npm`. So if we're using Slick Carousel:
	* Run `$ npm i slick-carousel`
	* Open up `frontend.js` and `frontend.scss` to add the entry points for the package. If you're using the Slick Carousel then your theme JS and CSS, respectively, would look like:

```javascript
import 'slick-carousel/slick/slick.min';
```
```scss
@import "~slick-carousel/slick/slick.scss";
@import "~slick-carousel/slick/slick-theme.scss";
```

Running your build might fail if 3rd party package's relative paths are not configured before imported. For example, to load Slick Carousel's paths add the following line in your `_variables.scss` file:

```scss
// Slick Carousel font path
$slick-font-path: "~slick-carousel/slick/fonts/";

// Slick Carousel ajax-loader.gif path
$slick-loader-path: "~slick-carousel/slick/";
```

## Learn more about the default packages used with this project

- [Babel core](https://www.npmjs.com/package/@babel/core)
- [Babel preset-env](https://www.npmjs.com/package/@babel/preset-env)
- [Babel register](https://www.npmjs.com/package/@babel/register)
- [Babel eslint](https://www.npmjs.com/package/babel-eslint)
- [Babel loader](https://www.npmjs.com/package/babel-loader)
- [Babel preset env](https://www.npmjs.com/package/babel-preset-env)
- [Browserslist](https://www.npmjs.com/package/browserslist)
- [Can I Use DB](https://www.npmjs.com/package/caniuse-db)
- [Date Format](https://www.npmjs.com/package/dateformat)
- [Del](https://www.npmjs.com/package/del)
- [Eslint](https://www.npmjs.com/package/eslint)
- [Eslint config WordPress](https://www.npmjs.com/package/eslint-config-wordpress)
- [Eslint loader](https://www.npmjs.com/package/eslint-loader)
- [Gulp](https://www.npmjs.com/package/gulp)
- [Gulp CSSNano](https://www.npmjs.com/package/gulp-cssnano)
- [Gulp filter](https://www.npmjs.com/package/gulp-filter)
- [Gulp Live Reload](https://www.npmjs.com/package/gulp-livereload)
- [Gulp PostCSS](https://www.npmjs.com/package/gulp-postcss)
- [Gulp Rename](https://www.npmjs.com/package/gulp-rename)
- [Gulp Sass](https://www.npmjs.com/package/gulp-sass)
- [Gulp Sourcemaps](https://www.npmjs.com/package/gulp-sourcemaps)
- [Gulp Zip](https://www.npmjs.com/package/gulp-zip)
- [Husky](https://www.npmjs.com/package/husky)
- [Lint Staged](https://www.npmjs.com/package/lint-staged)
- [Node Sass tilde importer](https://www.npmjs.com/package/node-sass-tilde-importer)
- [PostCSS preset-env](https://www.npmjs.com/package/postcss-preset-env)
- [Pump](https://www.npmjs.com/package/pump)
- [Require DIR](https://www.npmjs.com/package/require-dir)
- [Stylelint](https://www.npmjs.com/package/stylelint)
- [Stylelint config WordPress](https://www.npmjs.com/package/stylelint-config-wordpress)
- [Webpack](https://www.npmjs.com/package/webpack)
- [Webpack CLI](https://www.npmjs.com/package/webpack-cli)
- [Webpack Stream](https://www.npmjs.com/package/webpack-stream)
