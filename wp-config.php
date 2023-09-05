<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'WPCACHEHOME', '/home/www/iconideadotcom/www/wp-content/plugins/wp-super-cache/' );
define( 'DB_NAME', 'iconidea_db' );

/** Database username */
define( 'DB_USER', 'iconidea_ecom' );

/** Database password */
define( 'DB_PASSWORD', 'ecm2018!@#' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define( 'WP_MAX_MEMORY_LIMIT' , '512M' );

define( 'WP_HOME', 'https://iconidea.co.th' );

define( 'WP_SITEURL', 'https://iconidea.co.th' );

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
define( 'AUTH_KEY',         '!< Vc$Ox=xXLK+OGTT5Uj;)Fj}-Z_?@so!o;y5ju/Mt]q5qzHmTE#@~9c;YK#s%8' );
define( 'SECURE_AUTH_KEY',  '_:Ie2>p%-tLh)MM3{6 f}IXOF4&osyAwAOgjhWcrdG},j]xGthVnLa!oU?A@O9Z?' );
define( 'LOGGED_IN_KEY',    'D$AZhc*wK_KP>ghng!ka4qQ5k^V.=@BffZb6%TD5$z/(495{<[&U#~$6L>p{+1%V' );
define( 'NONCE_KEY',        '(LBDbKzXd+[-9AF[~og&}c|7blAYRhF)m%+m8D2cPc3ntXQ%A9CXs+PPRj]>*}--' );
define( 'AUTH_SALT',        'Rx/n&hO)/MGZzk# P$Gq(DHJ;fJQ+Vj!>TZZ5K!yvU;()EizlKMk4L? e #QUPId' );
define( 'SECURE_AUTH_SALT', '.[R[X =VIy:9I ;o9jBe,jI/2#5c:l+9[}Zl0B*]w6FvbQ`ZNo}ipZs:<R5,Q`{I' );
define( 'LOGGED_IN_SALT',   'MQ|LC%F!S%|]m<mK6M=)B9y:8E<gGh+~is-Q7asy-:X?3,-B.?*y}3tdK2.UV*O0' );
define( 'NONCE_SALT',       'uf#I:dl1R+M(mJE$|G62ae~oPwY},dRh!w Z^B}0$rw},d]]hd$~hXw&fhU.$rI5' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
