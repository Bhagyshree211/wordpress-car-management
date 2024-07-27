<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'car_addweb' );

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
define( 'AUTH_KEY',         'Co]}x^IVc2A7u)#Ub57qLvv~4jT}S`%F/~[|FaUR1eq1p2M OzE` 7=o{[:AHeUb' );
define( 'SECURE_AUTH_KEY',  'B[m,Lg&JTbBX6B,5?[kODRwIxjw-@k>|I~>!c+>SH`*Ta7I0UCgEWL84sp3aygo9' );
define( 'LOGGED_IN_KEY',    '~>@T@$r!XtARa=M~dq~_NP7,kwOEof)msNLS`3zT=n *fP)j9rt[+vEQOeK_`^ko' );
define( 'NONCE_KEY',        '7R>ufib7vX9^D[7^M51~CP?o|lm B9~<Og9KM&OoM*>ZKHeyyo0geTU-]>.b).`h' );
define( 'AUTH_SALT',        'j6*G^~~SF0`YC09/} LEW9@sy]MuM*]B}9<*JoI2ZP>MK8o/7?~jtjsjLspCJO^n' );
define( 'SECURE_AUTH_SALT', 'w) jBvv^8CP1ifwB==BT/,9BhirZfe#aw~ #3Sfr]oHWpf#vZ*qb9yU=K;<m8?Z<' );
define( 'LOGGED_IN_SALT',   '4#j(=?3>tSzAdkA=y}t5=qvL7G+ZmPSkr_cARxl!BZmJ:D)1axT7A_nm:&9s7[D;' );
define( 'NONCE_SALT',       'w7A}e*z2qZ&yxghkkSxd,rW`fH}%{LX$k*3]PQ?f[:I$uqP+o<H{#F &Hgl.;/[S' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'car_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define('WP_DEBUG', false);


/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
