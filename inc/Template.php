<?php
/**
 * This is template manager
 * User: nguyenvanduocit
 * Date: 9/25/2015
 * Time: 10:28 PM
 */

namespace Diress;


class Template {
	/**
	 * @var \Diress\Template
	 */
	private static $instance;

	/**
	 * @return \Diress\Template
	 */
	public static function getInstace(){
		if(is_null(static::$instance)){
			static::$instance = new static();
		}
		return static::$instance;
	}
	/**
	 * sensei_get_template function.
	 *
	 * @access public
	 * @param mixed $template_name
	 * @param array $args (default: array())
	 * @param string $template_path (default: '')
	 * @param string $default_path (default: '')
	 * @return void
	 */
	function get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
		if ( $args && is_array($args) ) {
			extract( $args );
		}
		$located = $this->locate_template( $template_name, $template_path, $default_path );

		do_action( 'diress_before_template_part', $template_name, $template_path, $located );

		include( $located );

		do_action( 'diress_after_template_part', $template_name, $template_path, $located );
	}
	/**
	 * Locate template, currently, this is check like a plugin, but
	 *
*@param        $template_name
	 * @param string $template_path
	 * @param string $default_path
	 *
	 * @return mixed|void
	 */
	function locate_template( $template_name, $template_path = '', $default_path = '' ) {
		if ( ! $template_path ) {
			$template_path = 'diress/';
		}
		if ( ! $default_path ) $default_path = TEMPLATE_DIR .'/template-parts/';
		// Look within passed path within the theme - this is priority
		$template = locate_template(
			array(
				$template_path . $template_name,
				$template_name
			)
		);

		// Get default template
		if ( ! $template )
			$template = $default_path . $template_name;

		// Return what we found
		return apply_filters( 'diress_locate_template', $template, $template_name, $template_path );
	}
}