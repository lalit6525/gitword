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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'x)#Ez5(q!irrYx f97~L7A*=jLvNxsOLbz_QD%}.Cv@7E0[|72n}u{J6|;7:X Sx' );
define( 'SECURE_AUTH_KEY',   ')sCnfw#lt@[yfY</~S$v(gAGV;d}6~/5,/jCCRVe$x8A^Q$TnV[#jUj8vjEEZXT6' );
define( 'LOGGED_IN_KEY',     '+;p/vZZVaC1dN(Bc245c$3# SU~7E!%J[r-d)EFx$}(#wjxc/C+q)tdt:V+@Kn<`' );
define( 'NONCE_KEY',         'x.QNOh-Ko^6?b*NMtOCyr^sFyd1DBla>-~N_L[^JjRNS8zrTGq[wZ6UE{Ie#xc).' );
define( 'AUTH_SALT',         'm`n?,cVSgpP[FyYm?mj{%NE(&Hr<^hUu=$EzjkokAX*Syi.XoM  FG #K1+cPk;v' );
define( 'SECURE_AUTH_SALT',  ';hL6H0Cf>Jxgh~#AFoUC+gTkl_ogl_G[tqKy:pP$n(%3 7$T@ormU$q_Vr<-GUg-' );
define( 'LOGGED_IN_SALT',    'P#5Nf.dcymH|ET^j,L/ZLh9b]^Z~I4?X52,]3=O2:XPwf,IiB_zx(P,eS{H.F-I!' );
define( 'NONCE_SALT',        'F dx8@Wvi,P<m%:/~]# -;~p8!6%VbA4QGYVTMf?uOz|-nyT,1qk`)cE=8YgZ/H:' );
define( 'WP_CACHE_KEY_SALT', '3sLHd_)DNvgkL|n_R;m@xMmps#DvMgD!m<N7#iSP1{K8_;`{|ni|5vQI%$T._FAK' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
