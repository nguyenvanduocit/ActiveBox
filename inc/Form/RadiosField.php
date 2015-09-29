<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 4:17 PM
 */

namespace Diress\Form;


class RadiosField extends SelectField{
	/**
	 * Generate the corresponding HTML for a field.
	 *
	 * @param array $args
	 *
	 * @return string
	 */
	protected function _render_specific( $args ) {

		if ( array( 'foo' ) === $args['selected'] ) {
			// radio buttons should always have one option selected
			$args['selected'] = key( $args['choices'] );
		}

		$opts = '';
		foreach ( $args['choices'] as $value => $title ) {
			$value = (string) $value;

			$single_input = FormField::_checkbox( array(
				'name'     => $args['name'],
				'type'     => 'radio',
				'value'    => $value,
				'checked'  => ( $value == $args['selected'] ),
				'desc'     => $title,
				'desc_pos' => 'after',
			) );

			$opts .= str_replace( FormBuilder::TOKEN, $single_input, $args['wrap_each'] );
		}

		return FormField::add_desc( $opts, $args['desc'], $args['desc_pos'] );
	}
}