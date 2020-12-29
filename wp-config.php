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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'qoE0oLJLirgQOINdS/OHlWRGG448D3mT0R04i5ArGlnnfFAvo0XZnEXaOvi/OPfGdR+VriuSLOLhAuzfF+acaQ==');
define('SECURE_AUTH_KEY',  'BK8ZuG34KuIR+pm8G3sTDnhs53q2fRZP3JHiDNRqmQjo05ix7TO8k5DoswM/yt5G+RPPO2JmCN0mn3vW1sxySQ==');
define('LOGGED_IN_KEY',    '+rAnUVcdpsixQiHq1WMF5YBKi4Toe6mC3zTs329uclWKOM8xHxon6rVRKHsxOBbdlEasvwJHSQbsBhrPGIt1TA==');
define('NONCE_KEY',        'Eht49Tbaos3qLMvrE11+LYxYD4EJOfj4hKqFznAFXvA+ZbTBm4jitsTYQBy2hWB75V0VvU2qmEP8Z/Ho/HKMng==');
define('AUTH_SALT',        'aY+8/v1yR084cYm26IYCB0PkVDVjuAV1+I9ycXpQ7ABaQk2JTLC97e8JDTpuHFlw02/geOgkMZzPQD0R1xYe6w==');
define('SECURE_AUTH_SALT', 'T9c37ZeWxv+F3tC3nyntsHaCE/9lWl/ipd62clBCTsG2ZGcfqZGSR+hsKFhkpNzFcZcR3V6ji7yi/ICqNgdc2A==');
define('LOGGED_IN_SALT',   'DIFHnGxLA6fBP6jJV4iHZtM4T92+1loIZaSr31JMUXeONHGBMyeBl8pfdCW+N+x7dmINUSv6WMuIdY0Wqf7dJw==');
define('NONCE_SALT',       'JtY0k7XjdZiTIXdnuTCclRmrWHBNJH9/PsNpvbp6LlDvsv0vfBwBvU7tZ/H3faNHmeyI5BvNi+MqRN0yn7TGUQ==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
