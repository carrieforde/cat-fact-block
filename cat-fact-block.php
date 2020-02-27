<?php
/**
 * Plugin Name:     Cat Fact Block
 * Text Domain:     cat-fact-block
 * Domain Path:     /languages
 * Version:         1.0.0
 *
 * @package         Cat_Fact_Block
 */

add_action( 'init', 'cat_fact_block_init' );
/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/designers-developers/developers/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */
function cat_fact_block_init() {
	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}

	$index_js = 'dist/cat-fact-block.js';
	wp_register_script(
		'cat-fact-block-editor',
		plugins_url( $index_js, __FILE__ ),
		array(
			'wp-blocks',
			'wp-i18n',
			'wp-element',
		),
		'1.0.0',
		false
	);

	register_block_type(
		'cat-fact-block/cat-fact-block',
		array(
			'editor_script' => 'cat-fact-block-editor',
		)
	);
}

add_action( 'wp_enqueue_scripts', 'cat_fact_block_enqueue_scripts' );
/**
 *  Enqueue front end scripts.
 */
function cat_fact_block_enqueue_scripts() {
	if ( has_block( 'cat-fact-block/cat-fact-block' ) ) {

		$index_js = 'dist/cat-fact-component.js';

		wp_enqueue_script(
			'cat-fact-component',
			plugins_url( $index_js, __FILE__ ),
			array(),
			'1.0.0',
			false
		);
	}
}

add_filter( 'script_loader_tag', 'cat_fact_block_add_script_attributes', 10, 2 );
function cat_fact_block_add_script_attributes( $tag, $handle ) {
	if ( 'cat-fact-component' !== $handle ) {
		return $tag;
	}

	return str_replace( "type='text/javascript' src", ' type="module" async src', $tag );
}
