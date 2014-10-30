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
define('DB_NAME', 'db14582_ponasandbox');

/** MySQL database username */
define('DB_USER', '1clk_wp_llclaEK');

/** MySQL database password */
define('DB_PASSWORD', 'gdcBKZ4A');

/** MySQL hostname */
define('DB_HOST', $_ENV{DATABASE_SERVER});

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
define('AUTH_KEY',         'WfPXoCl8 dN6NbOFE 126FcFTY H8bpXDnd XxuDwACI');
define('SECURE_AUTH_KEY',  'C6Or6sBE 8H8Etf1m OwToMxow zVsKfQRp Y7Wol2lf');
define('LOGGED_IN_KEY',    'SGSx52Iu b6K5Kdja rO2iPldR lzKTQMdS wC8VEsfN');
define('NONCE_KEY',        '7JCriaU7 OH6fmbFR 1XIWG78N zz63cpho kq3IERYX');
define('AUTH_SALT',        'SD8dWsjC ZPVg1LLM FXBTPSe5 cC1sfIGn UrBVFXIy');
define('SECURE_AUTH_SALT', 'svHbJBsP LIUJofqC a4r4KDlc azuabOZt MaGnk5gO');
define('LOGGED_IN_SALT',   '1fs7eOgp AKGhVHLN sjMpw6SM JwSGNkUA 4zUb4TGA');
define('NONCE_SALT',       'DMS6LJJk XuGRlwMS lJDq7qbe IEt1UIsV JyxYraRX');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_ponasandbox';

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
