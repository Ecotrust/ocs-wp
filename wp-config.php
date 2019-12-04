<?php
/**
 *
 * Oregon Conservation Strategy WordPress Base Configuration
 *
 */

/**
 *
 * ____ Let's Get Local (and set a few other defaults) ____
 *
 **********************************************************/

	define('WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/app');
	define('WP_CONTENT_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/app');
    // Now set in theme/lib/init.php
	//define('UPLOADS', '../media' );


	define('WP_SITEURL', 'http://' . $_SERVER['SERVER_NAME'] . '/wordpress');
	define('WP_HOME',    'http://' . $_SERVER['SERVER_NAME']);

	define('WP_DEFAULT_THEME',			'odfw-ocs-sage'); // folder name of default theme to skip admin setup
	define('WPLANG',					''     ); // Defaults to English
	define('WP_MEMORY_LIMIT',			'256M' ); // Greedy
	define('AUTOMATIC_UPDATER_DISABLED', true  );

	define('FORCE_SSL_ADMIN', false);
	// in some setups HTTP_X_FORWARDED_PROTO might contain
	// a comma-separated list e.g. http,https
	// so check for https existence
	if (strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false)
	$_SERVER['HTTPS']='on';
/**
 *
 * Define two constants for use with Compass Map iframes
 *
 */

    // Path to the build directory for front-end assets
    // define('COMPASS_URL_PREFIX', 'http://52.25.124.64/visualize/');
    // Path to the build directory for front-end assets
    // Ensuring opacity is always set to 1.0 on OCS - Oregon Mask Layer
    define('COMPASS_URL_SUFFIX', '&print=true&dls%5B%5D=true&dls%5B%5D=1.0&dls%5B%5D=549');

/**
 *
 * ____ More WordPress Settings _____
 *
 **************************************/
    /* AutoSave Interval. */
    define( 'AUTOSAVE_INTERVAL', '40' );
    /* Specify maximum number of Revisions. */
    define( 'WP_POST_REVISIONS', '7' );
    /* Media Trash. */
    define( 'MEDIA_TRASH', true );
    /* Trash Days. */
    define( 'EMPTY_TRASH_DAYS', '365' );


    /* Compression. Gulp has got this. May be useful for plugins */
    define( 'COMPRESS_CSS',        false );
    define( 'COMPRESS_SCRIPTS',    false );
    define( 'ENFORCE_GZIP',        true );

    /* PHP Memory */
    //define( 'WP_MEMORY_LIMIT', '1128' );
    //define( 'WP_MAX_MEMORY_LIMIT', '1256' );

    /* WordPress Cache */
    //define( 'WP_CACHE', true );




/**
 *
 * ____ Database Information ____
 *
 *********************************/

	// store actual credentials in local-cofig.php, not here (local-config is ignored by git)
	if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) :
		include( dirname( __FILE__ ) . '/local-config.php' );
	else:
		define('DB_NAME', '');
		define('DB_USER', '');
		define('DB_PASSWORD', '');
		define('DB_HOST', 'localhost');
	endif;

	$table_prefix  = 'wp_'; // WordPress Database Table prefix.




/**
 *
 * ____ Go Go Memcache! ____
 *
 ***************************/
	if ( file_exists( dirname( __FILE__ ) . '/memcached.php' ) )
		$memcached_servers = include( dirname( __FILE__ ) . '/memcached.php' );




/**
 * ____ Authentication Unique Keys and Salts ___
 *
 * Generate this section here: https://api.wordpress.org/secret-key/1.1/salt/
 *
 ****************************************************************************/
    define('AUTH_KEY',         '|r@!.GK>z,A~Dr,5ArO3T_;S&8A|5Lo lj)O7&,}WaX-r1p!J?ie&a| UDP|*Sp=');
    define('SECURE_AUTH_KEY',  'Qrk5}sw55=H8OBs2O S(~gMiqWlc??88NN0H!Z!Yy.&4RH!rCAW({XcFV%|T(zvO');
    define('LOGGED_IN_KEY',    'Uv/a o!2`Pei25ep~rJX`#q/++SuutR;!Qg+nEHU0/oAW)6cp,-]ZnC;etf!=iOF');
    define('NONCE_KEY',        'TVlp!|4`F9*oce7#(1+b7R$@4[}&/&,7$+_+c501]Yn!9i25jdJP:{])a3AS|WU{');
    define('AUTH_SALT',        'OR:)L+?yGtiRfj7FTV)HNJ_:^-j0(Yl )XRt1:r(.N?.-hAYr8EN^BwQMWW)49ny');
    define('SECURE_AUTH_SALT', 'q4s&jD-t&u 0CIpE$I})6^R5LElrH=~d6GUxQt,rYXu6@U+VB5a^w=NIOdg(02sN');
    define('LOGGED_IN_SALT',   ',.O?)(0)Lqw6BL*TR*Wj.tF:i~cunn1D_/sCw~QqD|jdxMY/5]5($Pk/QY;|;:t+');
    define('NONCE_SALT',       ']T,2GWm,sunBRy# Kw$Ov0NO(qn-cKFiNUpxGG^fX=[Q%9L<]?0zZdBy^ZYI>it<');


/**
 *
 * ___ It Begins: Bootstrap Wordpress ____
 *
 ******************************************/

    // Absolute path to the WordPress directory.
    if ( !defined('ABSPATH') )
        define('ABSPATH', dirname(__FILE__) . '/wordpress/');

    // Sets up WordPress vars and included files.
    require_once(ABSPATH . 'wp-settings.php');
