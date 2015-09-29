<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 4:12 PM
 */

namespace Diress\Form;


use Diress\Util;

abstract class FormField implements FormFieldInterface{
	protected $args;

	/**
	 * Creates form field.
	 *
	 * @param array|FormField $args
	 *
	 * @return mixed false on failure or instance of form class
	 */
	public static function create( $args ) {
		if ( is_a( $args, 'scbFormField_I' ) ) {
			return $args;
		}

		if ( empty( $args['name'] ) ) {
			return trigger_error( 'Empty name', E_USER_WARNING );
		}

		if ( isset( $args['value'] ) && is_array( $args['value'] ) ) {
			$args['choices'] = $args['value'];
			unset( $args['value'] );
		}

		if ( isset( $args['values'] ) ) {
			$args['choices'] = $args['values'];
			unset( $args['values'] );
		}

		if ( isset( $args['extra'] ) && ! is_array( $args['extra'] ) ) {
			$args['extra'] = shortcode_parse_atts( $args['extra'] );
		}

		$args = wp_parse_args( $args, array(
			'desc'      => '',
			'desc_pos'  => 'after',
			'wrap'      => FormBuilder::TOKEN,
			'wrap_each' => FormBuilder::TOKEN,
		) );

		// depends on $args['desc']
		if ( isset( $args['choices'] ) ) {
			self::_expand_choices( $args );
		}

		switch ( $args['type'] ) {
			case 'radio':
				return new RadiosField( $args );
			case 'select':
				return new SelectField( $args );
			case 'checkbox':
				if ( isset( $args['choices'] ) ) {
					return new MultipleChoiceField( $args );
				} else {
					return new SingleCheckboxField( $args );
				}
			case 'range':
				return new RangeField($args);
			case 'custom':
				return new CustomField( $args );
			default:
				return new TextField( $args );
		}
	}

	/**
	 * Constructor.
	 *
	 * @param array $args
	 *
	 * @return void
	 */
	protected function __construct( $args ) {
		$this->args = $args;
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
	 * @return bool
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
		if ( null === $value && isset( $this->default ) ) {
			$value = $this->default;
		}

		$args = $this->args;

		if ( null !== $value ) {
			$this->_set_value( $args, $value );
		}

		$args['name'] = FormBuilder::get_name( $args['name'] );

		return str_replace( FormBuilder::TOKEN, $this->_render( $args ), $this->wrap );
	}

	/**
	 * Mutate the field arguments so that the value passed is rendered.
	 *
	 * @param array  $args
	 * @param mixed  $value
	 */
	abstract protected function _set_value( &$args, $value );

	/**
	 * The actual rendering.
	 *
	 * @param array $args
	 */
	abstract protected function _render( $args );

	/**
	 * Handle args for a single checkbox or radio input.
	 *
	 * @param array $args
	 *
	 * @return string
	 */
	protected static function _checkbox( $args ) {
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

		return self::_input_gen( $args );
	}

	/**
	 * Generate html with the final args.
	 *
	 * @param array $args
	 *
	 * @return string
	 */
	protected static function _input_gen( $args ) {
		$args = wp_parse_args( $args, array(
			'value' => null,
			'desc'  => null,
			'extra' => array(),
		) );

		$args['extra']['name'] = $args['name'];

		if ( 'textarea' == $args['type'] ) {
			$input = Util::html( 'textarea', $args['extra'], esc_textarea( $args['value'] ) );
		} else {
			$args['extra']['value'] = $args['value'];
			$args['extra']['type']  = $args['type'];
			$input = Util::html( 'input', $args['extra'] );
		}

		return self::add_label( $input, $args['desc'], $args['desc_pos'] );
	}

	/**
	 * Wraps a form field in a label, and position field description.
	 *
	 * @param string $input
	 * @param string $desc
	 * @param string $desc_pos
	 *
	 * @return string
	 */
	protected static function add_label( $input, $desc, $desc_pos ) {
		return Util::html( 'label', self::add_desc( $input, $desc, $desc_pos ) ) . "\n";
	}

	/**
	 * Adds description before/after the form field.
	 *
	 * @param string $input
	 * @param string $desc
	 * @param string $desc_pos
	 *
	 * @return string
	 */
	protected static function add_desc( $input, $desc, $desc_pos ) {
		if ( empty( $desc ) ) {
			return $input;
		}

		if ( 'before' == $desc_pos ) {
			return $desc . ' ' . $input;
		} else {
			return $input . ' ' . $desc;
		}
	}

	/**
	 * @param array $args
	 */
	private static function _expand_choices( &$args ) {
		$choices =& $args['choices'];

		if ( ! empty( $choices ) && ! self::is_associative( $choices ) ) {
			if ( is_array( $args['desc'] ) ) {
				$choices = array_combine( $choices, $args['desc'] );	// back-compat
				$args['desc'] = false;
			} else if ( ! isset( $args['numeric'] ) || ! $args['numeric'] ) {
				$choices = array_combine( $choices, $choices );
			}
		}
	}

	/**
	 * Checks if passed array is associative.
	 *
	 * @param array $array
	 *
	 * @return bool
	 */
	private static function is_associative( $array ) {
		$keys = array_keys( $array );
		return array_keys( $keys ) !== $keys;
	}
}