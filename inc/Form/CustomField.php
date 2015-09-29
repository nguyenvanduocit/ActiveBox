<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 4:19 PM
 */

namespace Diress\Form;

class CustomField implements  FormFieldInterface{
	protected $args;
	/**
	 * Constructor.
	 *
	 * @param array $args
	 *
	 * @return void
	 */
	function __construct( $args ) {
		$this->args = wp_parse_args( $args, array(
			'render'   => 'var_dump',
			'sanitize' => 'wp_filter_kses',
		) );
	}
	/**
	 * Magic method: $field->arg
	 *
	 * @param string $key
	 *
	 * @return mixed
	 */
	public function __get( $key ) {
		return $this->args[ $key ];
	}
	/**
	 * Magic method: isset( $field->arg )
	 *
	 * @param string $key
	 *
	 * @return boolean
	 */
	public function __isset( $key ) {
		return isset( $this->args[ $key ] );
	}
	/**
	 * Generate the corresponding HTML for a field.
	 *
	 * @param mixed $value (optional)
	 *
	 * @return string
	 */
	public function render( $value = null ) {
		return call_user_func( $this->render, $value, $this );
	}
	/**
	 * Sanitizes value.
	 *
	 * @param mixed $value
	 *
	 * @return mixed
	 */
	public function validate( $value ) {
		return call_user_func( $this->sanitize, $value, $this );
	}
}