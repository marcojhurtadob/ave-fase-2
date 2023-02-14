<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_2' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'jdb3Gw6~{[`MIW(>Bw!Ztre6!,d:W>j{`1Yn2ruoQjzLjarHP)Pitp];npzeMLW6' );
define( 'SECURE_AUTH_KEY',  'dYvK~,qZwT!{NJoA^1hw:<Em2T*7P_R#n5q/p8F!y}^K4N{;P%Zh$X0G!H`?jO:q' );
define( 'LOGGED_IN_KEY',    '99(wiCHd0_Sht:I`Zus137B6g3C+GC.&/K_JH}1;.(d,}H`qK{C042q[sw$Pj wv' );
define( 'NONCE_KEY',        'K(7lp/=hX@K~EUK1755b0V_Z@Y&A*?N)F.8BTn1Hx$Jt5^)wck9dwGi!edK@guYX' );
define( 'AUTH_SALT',        '9cF&RPs#<7K oI`#y*37p3XuXyCh]^WLH?&U<wzdNNp;c+$:P@Pq;{8$S~k/]X w' );
define( 'SECURE_AUTH_SALT', 'ya 7<i|vF>#raGa7,UxvAVD@?XUfwe#w0@nYd{|~/[eP^0/`q,^+@47)<bce[>`c' );
define( 'LOGGED_IN_SALT',   '$mb:Rb0wcJR]$B}:`UkF{4Yux=o=]=S3zVL$QI1>DQOs=N/XQkY9%0AqXd&;T*0F' );
define( 'NONCE_SALT',       'ep;#h4~Z1ZS_Kf(OG;zO2<!!v<t+Muy?aNt50B^ll(tz<rXVy*gYNG{l`K7yJJVa' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */

define('WP_ALLOW_MULTISITE', true);
define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', false );
define( 'DOMAIN_CURRENT_SITE', 'localhost' );
define( 'PATH_CURRENT_SITE', '/wordpress_2/' );
define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
