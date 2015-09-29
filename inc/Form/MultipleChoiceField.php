<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 4:18 PM
 */

namespace Diress\Form;


class MultipleChoiceField extends FormField{
	/**
	 * Validates a value against a field.
	 *
	 * @param mixed $value
	 *
	 * @return array
	 */
	public function validate( $value ) {
		return array_intersect( array_keys( $this->choices ), (array) $value );
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
			'numeric' => false, // use numeric array instead of associative
			'checked' => null,
		) );

		if ( ! is_array( $args['checked'] ) ) {
			$args['checked'] = array();
		}

		$opts = '';
		foreach ( $args['choices'] as $value => $title ) {
			$single_input = FormField::_checkbox( array(
				'name'     => $args['name'] . '[]',
				'type'     => 'checkbox',
				'value'    => $value,
				'checked'  => in_array( $value, $args['checked'] ),
				'desc'     => $title,
				'desc_pos' => 'after',
			) );

			$opts .= str_replace( FormBuilder::TOKEN, $single_input, $args['wrap_each'] );
		}

		return FormField::add_desc( $opts, $args['desc'], $args['desc_pos'] );
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
		$args['checked'] = (array) $value;
	}
}