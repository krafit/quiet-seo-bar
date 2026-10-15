<?php
declare(strict_types=1);

namespace happyhappy\Quiet_SEO_Bar;

/**
 * Plugin Name:	Quiet SEO Bar
 * Description:	Replaces the bold SEO Bar of The SEO Framework in list tables with small, accessible status shapes.
 * Version:	1.0.0
 * Requires at least:	6.5
 * Requires PHP:	8.0
 * Requires Plugins:	autodescription
 * Author:	Simon Kraft
 * Author URI:	https://simon.blog/
 * License:	GPL3
 * License URI:	https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:	quiet-seo-bar
 * GitHub Plugin URI:	https://github.com/krafit/quiet-seo-bar
 * Primary Branch:	main
 *
 * @package	happyhappy\Quiet_SEO_Bar
 */

// prevent direct file access
if ( ! \defined( 'ABSPATH' ) ) {
	exit;
}

\define( 'QUIET_SEO_BAR_FILE', __FILE__ );

require_once __DIR__ . '/inc/class-quiet-seo-bar.php';

$quiet_seo_bar = Quiet_SEO_Bar::get_instance();
$quiet_seo_bar->plugin_file = \QUIET_SEO_BAR_FILE;
$quiet_seo_bar->init();
