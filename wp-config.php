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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp2022_brief' );

/** MySQL database username */
define( 'DB_USER', 'omar' );

/** MySQL database password */
define( 'DB_PASSWORD', '123diouf' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'wZ,(m3%:)5Q5k2Xv^5x?pg.pDdR,f;)}l%n]c F(Gwo]&1(_Zx;U Eo^ZEeTQIM+' );
define( 'SECURE_AUTH_KEY',  'IiD{A[Ii3xNe-9kk3*|}!#h)cS3tv4..xeKkw<>,kf@b3-6X7SlA)[<VQRAUyk-g' );
define( 'LOGGED_IN_KEY',    'uR^Ej znOyH_hwHOh/^n.6NM;U5?`#b/Oc(kb9>XV:uSsi6Dv.4d>YIG&Ehj]mn:' );
define( 'NONCE_KEY',        'G(7:#B,<~.&{and:jq8I[|$T,X%60i eNKwxoT/HHAtFTiqZ;(o]dPu(p~^u#$V:' );
define( 'AUTH_SALT',        '>kke0_<{T7/th}r%=]Os(RNt(7=NDzc4ZzE!o9MgmzcESysW+dU2xRPpc6 6Q4eO' );
define( 'SECURE_AUTH_SALT', 'v+yr0&R!|;=Fnt]=hi]]G.9 T,ih7_M%4:T-8ZwT&+wlG$Fcl(X lZ[H~e#6g2bO' );
define( 'LOGGED_IN_SALT',   'X2TE0#C@cTIOX:*M_jwD:c,W<6kW8tQ>b5`C?3p-C(qDH,vUM6>Y^P)6(-Bk}{+q' );
define( 'NONCE_SALT',       '7qx=3b #R%(N~baR.>~`ErHTHM]Y(qGh-.PVdg]xz%?x@ #Y!=$%Y:rC9I -3fSz' );

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

@ini_set('upload_max_size' , '256M' );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

define( 'FS_METHOD', 'direct' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
