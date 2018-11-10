<?php
/**
 * Plugin's bootstrap file to launch the plugin.
 *
 * @package     Gutenberg_Example
 * @author      Zac Gordon (@zgordon) / Fabian Kägy (fabiankaegy)
 * @license     GPL2+
 *
 * @wordpress-plugin
 * Plugin Name: Gutenberg - Example
 * Plugin URI:  https://gutenberg.courses
 * Description: A plugin containing example blocks for developers.  From <a href="https://gutenberg.courses/development">Zac Gordon's Gutenberg Development Course</a>.
 * Version:     1.0.0
 * Author:      Zac Gordon / Fabian Kägy
 * Domain Path: /languages
 * License:     GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

namespace Gutenberg_Example;

//  Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Gets this plugin's absolute directory path.
 *
 * @since  1.0.0
 * @ignore
 * @access private
 *
 * @return string
 */
function _get_plugin_directory() {
	return __DIR__;
}

/**
 * Gets this plugin's URL.
 *
 * @since  1.0.0
 * @ignore
 * @access private
 *
 * @return string
 */
function _get_plugin_url() {
	static $plugin_url;

	if ( empty( $plugin_url ) ) {
		$plugin_url = plugins_url( null, __FILE__ );
	}

	return $plugin_url;
}


add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\enqueue_block_editor_assets' );
/**
 * Enqueue block editor only JavaScript and CSS.
 */
function enqueue_block_editor_assets() {
	// Make paths variables so we don't write em twice ;)
	$block_path = '/assets/js/editor.blocks.js';
	$style_path = '/assets/css/blocks.editor.css';

	// Enqueue the bundled block JS file
	wp_enqueue_script(
		'jsforwp-blocks-js',
		_get_plugin_url() . $block_path,
		[ 'wp-i18n', 'wp-element', 'wp-blocks', 'wp-components' ],
		filemtime( _get_plugin_directory() . $block_path )
	);

	// Enqueue optional editor only styles
	wp_enqueue_style(
		'jsforwp-blocks-editor-css',
		_get_plugin_url() . $style_path,
		[ 'wp-blocks' ],
		filemtime( _get_plugin_directory() . $style_path )
	);
}

add_action( 'enqueue_block_assets', __NAMESPACE__ . '\enqueue_assets' );
/**
 * Enqueue front end and editor JavaScript and CSS assets.
 */
function enqueue_assets() {
	$style_path = '/assets/css/blocks.style.css';
	wp_enqueue_style(
		'jsforwp-blocks',
		_get_plugin_url() . $style_path,
		[ 'wp-blocks' ],
		filemtime( _get_plugin_directory() . $style_path )
	);
}

add_action( 'enqueue_block_assets', __NAMESPACE__ . '\enqueue_frontend_assets' );
/**
 * Enqueue frontend JavaScript and CSS assets.
 */
function enqueue_frontend_assets() {

	// If in the backend, bail out.
	if ( is_admin() ) {
		return;
	}

	$block_path = '/assets/js/frontend.blocks.js';
	wp_enqueue_script(
		'jsforwp-blocks-frontend',
		_get_plugin_url() . $block_path,
		[],
		filemtime( _get_plugin_directory() . $block_path )
	);
}
