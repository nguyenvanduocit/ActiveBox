<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 4:17 PM
 */

namespace Diress\Form;


use Diress\Util;

class SelectField extends SingleChoiceField {
	/**
	 * Generate the corresponding HTML for a field.
	 *
	 * @param array $args
	 *
	 * @return string
	 */
	protected function _render_specific( $args ) {
		$args = wp_parse_args( $args, array(
			'text'  => false,
			'extra' => array(),
		) );

		$options = array();

		if ( false !== $args['text'] ) {
			$options[] = array(
				'value'    => '',
				'selected' => ( $args['selected'] === array( 'foo' ) ),
				'title'    => $args['text'],
			);
		}

		foreach ( $args['choices'] as $value => $title ) {
			$value = (string) $value;

			$options[] = array(
				'value'    => $value,
				'selected' => ( $value == $args['selected'] ),
				'title'    => $title,
			);
		}

		$opts = '';
		foreach ( $options as $option ) {
			$opts .= Util::html( 'option', array( 'value'    => $option['value'],
			                                'selected' => $option['selected']
			), $option['title'] );
		}

		$args['extra']['name'] = $args['name'];

		$input = Util::html( 'select', $args['extra'], $opts );

		return FormField::add_label( $input, $args['desc'], $args['desc_pos'] );
	}
}