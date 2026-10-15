<?php
declare(strict_types=1);

namespace happyhappy\Quiet_SEO_Bar;

// prevent direct file access
if ( ! \defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Restyle the SEO Bar of The SEO Framework in admin list tables.
 *
 * The SEO Framework renders the SEO Bar markup in a private method without
 * a filter, but every item carries its state as a class
 * (tsf-seo-bar-good, -okay, -bad, -unknown, -undefined) plus a full
 * tooltip and ARIA label. This plugin therefore leaves the markup untouched
 * and only adds a stylesheet through The SEO Framework's own script loader,
 * so tooltips, screen reader text and quick edit refreshes keep working.
 *
 * @author	Simon Kraft
 * @license	GPL3
 * @package	happyhappy\Quiet_SEO_Bar
 */
final class Quiet_SEO_Bar {
	/**
	 * @var	string Plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * @var	self|null Unique instance of the class.
	 */
	private static ?self $instance = null;

	/**
	 * @var	string The full path to the main plugin file.
	 */
	public string $plugin_file = '';

	/**
	 * Get a unique instance of the class.
	 *
	 * @return	self The single instance of this class
	 */
	public static function get_instance(): self {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Initialize the plugin.
	 */
	public function init(): void {
		if ( ! \is_admin() ) {
			return;
		}

		\add_filter( 'the_seo_framework_scripts', [ $this, 'register_styles' ] );
		\add_filter( 'admin_body_class', [ $this, 'add_body_classes' ] );
	}

	/**
	 * Add body classes that switch optional styles on or off.
	 *
	 * @param	string	$classes Space-separated list of admin body classes
	 * @return	string Updated list of admin body classes
	 */
	public function add_body_classes( string $classes ): string {
		if ( ! $this->is_list_screen() ) {
			return $classes;
		}

		/**
		 * Filter whether good states are shown in colour.
		 *
		 * Return false to show good states in neutral grey, so only
		 * problems and warnings carry colour.
		 *
		 * @since	1.0.0
		 *
		 * @param	bool	$colorize Whether to colour good states
		 */
		if ( ! (bool) \apply_filters( 'quiet_seo_bar_colorize_good', true ) ) {
			$classes .= ' quiet-seo-bar-neutral-good';
		}

		/**
		 * Filter whether the default items are visually grouped.
		 *
		 * Groups: title and description, indexing to archiving, redirect.
		 * Grouping only applies when the bar holds exactly the six default
		 * items, so bars with added or removed items stay evenly spaced.
		 *
		 * @since	1.0.0
		 *
		 * @param	bool	$group Whether to group the items
		 */
		if ( (bool) \apply_filters( 'quiet_seo_bar_group_items', true ) ) {
			$classes .= ' quiet-seo-bar-grouped';
		}

		return $classes;
	}

	/**
	 * Check whether the current screen is a list table with an SEO Bar.
	 *
	 * @return	bool Whether the current screen is a list table
	 */
	private function is_list_screen(): bool {
		if ( ! \function_exists( 'tsf' ) ) {
			return false;
		}

		$is_list_screen = \tsf()->query()->is_wp_lists_edit();

		/**
		 * Filter whether the quiet SEO Bar is used on the current screen.
		 *
		 * @since	1.0.0
		 *
		 * @param	bool	$is_list_screen Whether to load the quiet SEO Bar
		 */
		return (bool) \apply_filters( 'quiet_seo_bar_load', $is_list_screen );
	}

	/**
	 * Register the stylesheet through The SEO Framework's script loader.
	 *
	 * The loader appends .min to the file name unless SCRIPT_DEBUG is
	 * enabled, so both seo-bar.css and seo-bar.min.css are shipped.
	 *
	 * The parameter is untyped on purpose: if another callback on this
	 * filter returns something other than an array, the value is passed
	 * through unchanged instead of causing a fatal error.
	 *
	 * @param	mixed	$scripts Script definitions of The SEO Framework
	 * @return	mixed Updated script definitions
	 */
	public function register_styles( mixed $scripts ): mixed {
		if ( ! \is_array( $scripts ) || ! $this->is_list_screen() ) {
			return $scripts;
		}

		$scripts[] = [
			'id' => 'quiet-seo-bar',
			'type' => 'css',
			'deps' => [ 'tsf' ],
			'autoload' => true,
			'name' => 'seo-bar',
			'base' => \plugin_dir_url( $this->plugin_file ) . 'assets/css/',
			'ver' => self::VERSION,
		];

		return $scripts;
	}
}
