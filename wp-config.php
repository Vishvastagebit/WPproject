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
define( 'DB_NAME', 'wpproject' );

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
define( 'AUTH_KEY',         ' +sGTd!=Q&brKS%H?r<XuEs >AP{w@WWmYVHKAn@9w0Dwi76p@XF7<m28CCSS}D/' );
define( 'SECURE_AUTH_KEY',  'OFleiO~]Aifbn-U1KAJV!;oS]oPHc1k}`mo_z8B=}75iAv]T4xe7mD-eTUeR^W7>' );
define( 'LOGGED_IN_KEY',    'W`z(<~T^.D)YcwE:`B@1;VK).~|&HQ<th-{}y-`o)|7B!^B3thJ}P+e%.@>7Dv+!' );
define( 'NONCE_KEY',        'bK3E_&hQNcxVF4h;5Y$J/Lz{SbvNa*6jY%sVDkO{OdZ&#3Seqf.^*U&9eTx?Miw0' );
define( 'AUTH_SALT',        'be64M#i6N+WFu<u|f{e>I%^e3@&7w/Cb=OLx{;.m68chr,vz7v,16W;@IcV~SBeQ' );
define( 'SECURE_AUTH_SALT', 'v-Jg2+l#c$F6-Px,B&{RAP[E10n-$cxZD.-Bek/{ab=]T|3##XsEXd(;08_6p4sU' );
define( 'LOGGED_IN_SALT',   'u(HVxV/c&G[+|4l@6{/iV@V@^^e91Qm6VvoHF;7M~e,xJ;f/=%87{48mDMN /Fuz' );
define( 'NONCE_SALT',       'bZN9ot;-zu1(*hKwM+0eZMG~7:p3f]woaG}L|;^f~2/qN+iwuDo8ki}=py@KeDm4' );

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
