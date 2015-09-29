<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 4:11 PM
 */

namespace Diress\Form;


class Form {
	protected $data   = array();
	protected $prefix = array();

	/**
	 * Constructor.
	 *
	 * @param array          $data
	 * @param string|boolean $prefix (optional)
	 *
	 * @return void
	 */
	public function __construct( $data, $prefix = false ) {
		if ( is_array( $data ) ) {
			$this->data = $data;
		}

		if ( $prefix ) {
			$this->prefix = (array) $prefix;
		}
	}

	/**
	 * Traverses the form.
	 *
	 * @param string $path
	 *
	 * @return object A scbForm
	 */
	public function traverse_to( $path ) {
		$data = FormBuilder::get_value( $path, $this->data );

		$prefix = array_merge( $this->prefix, (array) $path );

		return new Form( $data, $prefix );
	}

	/**
	 * Generates form field.
	 *
	 * @param array $args
	 *
	 * @return string
	 */
	public function input( $args ) {
		$value = FormBuilder::get_value( $args['name'], $this->data );

		if ( ! empty( $this->prefix ) ) {
			$args['name'] = array_merge( $this->prefix, (array) $args['name'] );
		}

		return FormBuilder::input_with_value( $args, $value );
	}
}