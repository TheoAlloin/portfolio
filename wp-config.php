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
define('DB_NAME', 'portfolio');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'yp9;XD,=kPF(<^6d>E[!`S}?uJH*W7jhu1o88H[;3j2:H6Tjy4rRgY!KPnh.c+&j');
define('SECURE_AUTH_KEY',  'bR*4DX-:UB&_iA`_7`lgCKFU,GUcMd9nVSRwq)7 5*]{<a><IYzEG@,{wH-qF`jE');
define('LOGGED_IN_KEY',    'LhLL68aiJyl/1,$nz!z`BUnf b<cj|rX{:EoC5!wpJlnX]blX.59NpA9<QK<+-_z');
define('NONCE_KEY',        'oM5?/Ahs;6QB))CcA5<F|C>u-,/Z-AH|e5&F]-u~E9&m{<*h5ZT4#?TE6YL&rTk)');
define('AUTH_SALT',        'p<t=m6*,Q^p_yXr}rNok~+=o6DPA^t-XtCn}r9&;{g}mTF;Jjj(gg+v5||90H(Ka');
define('SECURE_AUTH_SALT', ',P)0ei2G0>c{JGonSn(^R,]=^6t(Y5KY#|]]l]}m59m2lVwi@I0+h4HsCLrP40E`');
define('LOGGED_IN_SALT',   'Y#&LNb+OUBYS72Q+o5#^7G}m&m@:!<B}.(!$V2azA9,QZ:%Vb49~nN/||h2V;?j/');
define('NONCE_SALT',       '$:; H9mQ);EjH/,nL&C|{MK?>b }2lj=e*/zS|i]V}2y)JM9eREs*.J-*-yNif$p');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
