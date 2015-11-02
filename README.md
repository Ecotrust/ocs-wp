# OCS WordPress

## Notes:
* WordPress itself is a submodule
* wp-config.php, plugin folders and theme files are in the repository root. wp-config.php has been updated to point to these.
  * see https://davidwinter.me/install-and-manage-wordpress-with-git/ for more info on the WordPress set up


## Requirements
PHP requirement is in order to run the site. Node, gulp and Bower requirements are for development only.

| Prerequisite    | How to check | How to install
| --------------- | ------------ | ------------- |
| PHP >= 5.4.x    | `php -v`     | [php.net](http://php.net/manual/en/install.php) |
| Node.js 0.12.x  | `node -v`    | [nodejs.org](http://nodejs.org/) |
| gulp >= 3.8.10  | `gulp -v`    | `npm install -g gulp` |
| Bower >= 1.3.12 | `bower -v`   | `npm install -g bower` |

## Setup
### Get the code
1. `$ mkdir ocs` (or whatever you like)
2. `$ git clone {this repo url} ocs`
3. `$ git submodule init` # Get WordPress
4. `$ git submodule update`.

### Install/Setup
1. Create a database
2. Import the existing database however you like. Easist, particularly with a large DB + MAMP is with [WP-CLI](http://wp-cli.org/): `$ wp db import /path/to/data.sql`
1. Copy `local-config-sample.php` to `local-config.php`
2. Edit `local-config.php` and add you database connection details
3. If this is a production environment, change the `WP_ENV` constant to `production`
4. [optional pt 1] Add an entry to /etc/hosts for ocs
5. [optional pt 1] Create a vhost for OCS (for MAMP that's in `/Applications/MAMP/conf/apache/extra/httpd-vhosts.conf`)
6. Restart Apache 
4. Wordpress Admin is at /wordpress/wp-admin.php

## Development
Custom code for the OCS currently lives in two places:  

1. `/app/plugins/ocs-site-customizations`: most OCS-specific functional code belongs here instead of...
2. `/app/themes/odfw-ocs-sage/`: templates, CSS, JS and other site assets.

### Theme development
The OCS theme is built on top of the [Sage](https://github.com/roots/sage) starter theme. In order to develop CSS or JS you'll need to get the theme's tooling up and running. You can probably hack PHP without any further set up.

#### Sage Setup
1. Install Node and NPM. [Cross platform install how-to](http://blog.nodeknockout.com/post/65463770933/how-to-install-nodejs-and-npm). If you already have them installed, be sure to have the latest version of npm: `npm install -g npm@latest`
2. Install node dependencies for this project: `$ npm install --global gulp bower`
3. From the theme folder `$ cd app/themes/odfw-ocs-sage`
	* run `$ npm install` to have npm install additional theme dependencies
	* run `$ bower install` to install frontend dependencies  
4. All set! From the theme folder run `$ gulp serve` to work on theme. gulp will start a server at http://localhost:3000/ and will watch all of the files in the theme. Any changes you make will be compiled automatically (from sass/js/php...) and your browser will automatically update to reflect the changes. Note that while the gulp server will serve assets and refresh PHP you still need to run a LAMP stack (or equivalent server).

#### Available gulp commands
* `gulp` — Compile and optimize the files in the assets directory
* `gulp watch` — Compile assets when file changes are made
* `gulp --production` — Compile assets for production (no source maps).

#### Couple of other sage notes:
1. `functions.php` is only a file includer. Please add functions to the included file you think is most appropriate. If a function defines core site functionality (things that shouldn't break no matter the theme), put it into the ocs-site-customizations plugin.
2. Unless most things in the WP universe, sage uses [namespacing](http://php.net/manual/en/language.namespaces.basics.php). In order to call a function you've defined elsewhere within the theme you'll need to understand a little bit how namespacing works. There's a good write up [on the sage blog](https://roots.io/upping-php-requirements-in-your-wordpress-themes-and-plugins/).
3. Work on JS/SASS files within `/assets/`. Compiled equivalents are served from `/dist/`. Do not edit files within `/dist/`—your heart will be broken when gulp wipes them out.
5. More on [sage](https://roots.io/sage/docs/), [gulp](http://leveluptuts.com/tutorials/learning-gulp), [sass](http://sass-lang.com/), and [BrowserSync](http://www.browsersync.io)

## Updating
### Update WordPress
1. `$ cd /path/to/wordpress`
2. `$ git fetch -t` to get the most recent tags. Each release version of Wordpress is tagged.
3. `$ git tag` to see the list
4. `$ git checkout 4.3.1` or whatever the most recent tag is
5. `$ cd ..` Need to get out of the Wordpress directory for the next steps or you will melt poor little git's brain.
6. `$ git add wordpress` to stage the update
7. `$ git commit -m "Update Wordpress to 4.3.1"`

### Update Plugins
Either use the admin panel or use [WP-CLI](http://wp-cli.org/). With WP-CLI installed, navigate to the `/wordpress` folder and run (eg):

`$ wp plugin update hello-dolly`

or

`$ wp plugin update --all`
