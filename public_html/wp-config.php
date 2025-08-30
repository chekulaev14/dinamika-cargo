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
define( 'DB_NAME', 'admin_28187' );

/** Database username */
define( 'DB_USER', 'admin_28187' );

/** Database password */
define( 'DB_PASSWORD', 'a9710d6157feadc98118' );

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
define( 'AUTH_KEY',         '6xKgMyY5]Q@c->AE(n{yYq022bG<ZhjUx^ .JWk4a<P?=i={YPQfk,=@N}+B*C2>' );
define( 'SECURE_AUTH_KEY',  'lKzQFodlFYWf$^KK`9dd&;K:21>f7/{/Aq7 zJFj~cmcH,{930z,4Tx6BsV1U^Ez' );
define( 'LOGGED_IN_KEY',    '$EPjU5LIdcZvcZj3hfdS*{+x-O]>$6 qVB6su%$hA6u-P&CX][d!0%7lsHEych#A' );
define( 'NONCE_KEY',        'X P8.}|5,Lnabgrrki0,0XIeC<4l$]2Tq|Ng*,I,<,9:bMPwAL4-)?:}x1*cUoZn' );
define( 'AUTH_SALT',        'on)`RHR`x}^-P95g2Z_9kscKa+Gh>LT( _`R@*|RQlx7n-Km:c[r~LZDjhee%N!]' );
define( 'SECURE_AUTH_SALT', 'jB*) L4,.qby(Vr15wt1G;a]eKychz5K>o$7KF*Ef@-T%1Ngh<e%dM^}h[qmV5`@' );
define( 'LOGGED_IN_SALT',   'RR{6]yt^^i;>lFl$?HX7e4uH7^X 2w4`M*BYni_Rhy$P56eg8RG:+I(?~w,r8q<j' );
define( 'NONCE_SALT',       ':XF*oATj^Xydv#OWg%K*?JoqnY|mR[-&;;b(&_&az#YqHiyM[;&2kz> h&eN|vG%' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_rCb3U_';


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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';