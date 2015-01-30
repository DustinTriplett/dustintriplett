<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'WPCACHEHOME', '/home2/geeken5/public_html/dustintriplett.com/blog/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('WP_CACHE', true); //Added by WP-Cache Manager
define('DB_NAME', 'geeken5_wrdp2');

/** MySQL database username */
define('DB_USER', 'geeken5_wrdp2');

/** MySQL database password */
define('DB_PASSWORD', 'YMmSM9yfVIxUrKqT');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '^QzwX!-s0/REX0=Qn>hNGu2X|^rieov23f\`NoIM!QidviMU>2:9<eYHh2K9O)j~8O0*MQrz)gXRimfv');
define('SECURE_AUTH_KEY',  'R5<:Pv/Q<JdRw7W!y?Pzl(tNNc_Ug6R)uXmvvl~u5SJDawrX20^ylUCuXgtd>D2d2');
define('LOGGED_IN_KEY',    'o:2CrDLuH2sUCGm:Rd=:kIKXB7h3e01z;7|m5*v77P1pRI;QkYp(ubnmNT>y>RSoyji3D7CY');
define('NONCE_KEY',        'a-p1kOP#rkJj2MYBm=:z;P:ujC9:b#5\`DB)w-(S8Tq*JM$n2pXn1F^O4#o;jW)3thMsxMTa)~r');
define('AUTH_SALT',        'Z@C)9c1Oy(F_:S-8kjQ#o7tI~IseuhVuQWzx9ui(FBhs~-MM73c#W*Z(WX5956=$Uozr#');
define('SECURE_AUTH_SALT', 'TH3G8T6?5xD7$DCfLs$6Hk$0W8gg$Qgei66OS*p5L/D=5MyxVHOjg_CHJChfdI2yv9ur2oYVE1vZW');
define('LOGGED_IN_SALT',   'lS401o*:phfkTXQl>e@*6R=E(EPOF=!A|us;vzlQpjv!;vWzACKhk^9VYaXgy66B/>E>:');
define('NONCE_SALT',       'c1bfb\`Ly1SKjcS_hrHk_@iWnpg4GsL|?uG?_Pwuf3Ymk_5W8QHD=$Jmohc~dtVLDBDCjlKJs');

/**#@-*/
define('AUTOSAVE_INTERVAL', 600 );
define('WP_POST_REVISIONS', 1);
define( 'WP_CRON_LOCK_TIMEOUT', 120 );
define( 'WP_AUTO_UPDATE_CORE', true );
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
add_filter( 'auto_update_plugin', '__return_true' );
add_filter( 'auto_update_theme', '__return_true' );
