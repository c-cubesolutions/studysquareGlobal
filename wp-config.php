<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'studysqa_ssglobal' );

/** MySQL database username */
define( 'DB_USER', 'studysqa_global' );

/** MySQL database password */
define( 'DB_PASSWORD', '?.idUjD#qrn.');


/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'h_/W~!ej~_xH#FK2nomfdLuelUXwvxGpj,f<!M.Ql7OR`}ss~a`p5WnBC+e>8r-P' );
define( 'SECURE_AUTH_KEY',  'j<KEU#VUbRGqm|48X!{jhdp<tYzZ@cTkyK=U/7X``eR|1Y>6mwxK[R0I){Q|,T&D' );
define( 'LOGGED_IN_KEY',    '<5RPvw=H,8&^|^ZLytXvK-b[<xQ^7/mfE<n!{}uT;NeCT^ShVs?h<d;VcL?opc(U' );
define( 'NONCE_KEY',        '._UnniKN!RH:` [yMdj*gCGhXfQ.ao^cu)(FMiNb-J5r5#@JFaUenm9C!E<P`)#x' );
define( 'AUTH_SALT',        '>wG7=OU1s MYe+y&X|(u9p#?L7>wR#& RB*paKenf&{h8bn~qLn%2s#giUu-I}K[' );
define( 'SECURE_AUTH_SALT', '0.e_}!%.UyO?~WHZmxV|wK t+e%_;XEGpCGk7NJn+y<1H]})Rq@trO =&Lb[-~G8' );
define( 'LOGGED_IN_SALT',   ',X|5UB`x~!)[4p#)nGi;B[l]0ATa!(OE8N#ej%%Rc#q=W#U5T *-%e4oOo X&eO#' );
define( 'NONCE_SALT',       '9GnS7k=NKc^vJ- ;e)]ljB-ueWiu1f<+H|.|jdY{PVEDs#hmUT[kp1wra-Th$Z=T' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'ig_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
