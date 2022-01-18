<?php

class SiteOrigin_Widgets_Bundle_Compatibility {

	const BEAVER_BUILDER = 'Beaver Builder';
	const ELEMENTOR = 'Elementor';
	const VISUAL_COMPOSER = 'Visual Composer';

	/**
	 * Get the singleton instance
	 *
	 * @return SiteOrigin_Widgets_Bundle_Compatibility
	 */
	public static function single() {
		static $single;
		return empty( $single ) ? $single = new self() : $single;
	}

	function __construct() {
		$builder = $this->get_active_builder();
		if ( ! empty( $builder ) ) {
			require_once $builder['file_path'];
		}
		
		if ( function_exists( 'register_block_type' ) ) {
			require_once plugin_dir_path( __FILE__ ) . 'block-editor/widget-block.php';
		}

		// These actions handle alerting cache plugins that they need to regenerate a page cache.
		add_action( 'siteorigin_widgets_stylesheet_deleted', array( $this, 'clear_page_cache' ) );
		add_action( 'siteorigin_widgets_stylesheet_added', array( $this, 'clear_page_cache' ) );
		add_action( 'siteorigin_widgets_stylesheet_cleared', array( $this, 'clear_all_cache' ) );

		if (
			function_exists( 'amp_is_enabled' ) &&
			amp_is_enabled()
		) {
			// AMP plugin is installed and enabled. Remove Slider Lazy Loading.
			add_filter( 'siteorigin_widgets_slider_attr', function( $attr ) {
				if ( ! empty( $attr['class'] ) ) {
					$attr['class'] = str_replace( ' skip-lazy', '', $attr['class'] );
				}
				$attr['loading'] = false;
				return $attr;
			} );
		}
	}

	function get_active_builder() {

		$builders = include_once 'builders.php';

		foreach ( $builders as $builder ) {
			if ( $this->is_builder_active( $builder ) ) {
				return $builder;
			}
		}

		return null;
	}

	function is_builder_active( $builder ) {
		switch ( $builder[ 'name' ] ) {
			case self::BEAVER_BUILDER:
				return class_exists( 'FLBuilderModel', false );
			break;
			case self::ELEMENTOR:
				return class_exists( 'Elementor\\Plugin', false );
			break;
			case self::VISUAL_COMPOSER:
				return class_exists( 'Vc_Manager' );
			break;
		}
	}


	/**
	 * Tell cache plugins that they need to regenerate a page cache.
	 *
	 * @param $name The name of the file that's been deleted.
	 * @param $instance The current instance of the related widget.
	 *
	 */
	public function clear_page_cache( $name, $instance = array() ) {
		$id = explode( '-', $name );
		$id = end( $id );
		$id = explode( '.', $id )[0];

		if ( is_numeric( $id ) ) {
			if ( function_exists( 'w3tc_flush_post' ) ) {
				w3tc_flush_post( $id );
			}

			if ( class_exists( 'Swift_Performance_Cache' ) ) {
				Swift_Performance_Cache::clear_post_cache( $id );
			}

			if ( class_exists( '\Hummingbird\\WP_Hummingbird' ) ) {
				do_action( 'wphb_clear_page_cache', $id );
			}

			if ( function_exists( 'breeze_varnish_purge_cache' ) ) {
				breeze_varnish_purge_cache( get_the_permalink( $id ) );
			}
		}
	}

	/**
	 * Tell cache plugins that they need to regenerate their all page cache.
	 */
	public function clear_all_cache() {
		if ( function_exists( 'w3tc_flush_all' ) ) {
			w3tc_flush_all();
		}

		if ( class_exists( 'Swift_Performance_Cache' ) ) {
			Swift_Performance_Cache::clear_all_cache();
		}

		if ( class_exists( '\Hummingbird\\WP_Hummingbird' ) ) {
			do_action( 'wphb_clear_page_cache' );
		}

		if ( class_exists( 'Breeze_PurgeCache' ) ) {
			Breeze_PurgeCache::breeze_cache_flush();
		}
	}

}

SiteOrigin_Widgets_Bundle_Compatibility::single();
