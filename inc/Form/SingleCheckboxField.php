<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 4:19 PM
 */

namespace Diress\Form;


class SingleCheckboxField  extends FormField{
	/**
	 * Validates a value against a field.
	 *
	 * @param mixed $value
	 *
	 * @return boolean
	 */
	public function validate( $value ) {
		return (bool) $value;
	}

	/**
	 * Generate the corresponding HTML for a field.
	 *
	 * @param array $args
	 *
	 * @return string
	 */
	protected function _render( $args ) {
		$args = wp_parse_args( $args, array(
			'value'   => true,
			'desc'    => null,
			'checked' => false,
			'extra'   => array(),
		) );

		$args['extra']['checked'] = $args['checked'];

		if ( is_null( $args['desc'] ) && ! is_bool( $args['value'] ) ) {
			$args['desc'] = str_replace( '[]', '', $args['value'] );
		}

		return FormField::_input_gen( $args );
	}

	/**
	 * Sets value using a reference.
	 *
	 * @param array  $args
	 * @param string $value
	 *
	 * @return void
	 */
	protected function _set_value( &$args, $value ) {
		$args['checked'] = ( $value || ( isset( $args['value'] ) && $value == $args['value'] ) );
	}
}