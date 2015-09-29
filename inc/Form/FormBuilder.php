<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 4:08 PM
 */

namespace Diress\Form;


use Diress\Util;

class FormBuilder {
	const TOKEN = '%input%';

	/**
	 * Generates form field.
	 *
	 * @param array|FormFieldInterface $args
	 * @param mixed                $value
	 *
	 * @return string
	 */
	public static function input_with_value( $args, $value ) {
		$field = FormField::create( $args );

		return $field->render( $value );
	}

	/**
	 * Generates form field.
	 *
	 * @param array|FormFieldInterface $args
	 * @param array                $formdata (optional)
	 *
	 * @return string
	 */
	public static function input( $args, $formdata = null ) {
		$field = FormField::create( $args );

		return $field->render( FormBuilder::get_value( $args['name'], $formdata ) );
	}

	/**
	 * Generates a table wrapped in a form.
	 *
	 * @param array $rows
	 * @param array $formdata (optional)
	 *
	 * @return string
	 */
	public static function form_table( $rows, $formdata = null ) {
		$output = '';
		foreach ( $rows as $row ) {
			$output .= self::table_row( $row, $formdata );
		}

		$output = self::form_table_wrap( $output );

		return $output;
	}

	/**
	 * Generates a form.
	 *
	 * @param array  $inputs
	 * @param array  $formdata (optional)
	 * @param string $nonce
	 *
	 * @return string
	 */
	public static function form( $inputs, $formdata = null, $nonce ) {
		$output = '';
		foreach ( $inputs as $input ) {
			$output .= self::input( $input, $formdata );
		}

		$output = self::form_wrap( $output, $nonce );

		return $output;
	}

	/**
	 * Generates a table.
	 *
	 * @param array $rows
	 * @param array $formdata (optional)
	 *
	 * @return string
	 */
	public static function table( $rows, $formdata = null ) {
		$output = '';
		foreach ( $rows as $row ) {
			$output .= self::table_row( $row, $formdata );
		}

		$output = self::table_wrap( $output );

		return $output;
	}

	/**
	 * Generates a table row.
	 *
	 * @param array $args
	 * @param array $formdata (optional)
	 *
	 * @return string
	 */
	public static function table_row( $args, $formdata = null ) {
		return self::row_wrap( $args['title'], self::input( $args, $formdata ) );
	}


// ____________WRAPPERS____________

	/**
	 * Wraps a table in a form.
	 *
	 * @param string $content
	 * @param string $nonce (optional)
	 *
	 * @return string
	 */
	public static function form_table_wrap( $content, $nonce = 'update_options' ) {
		return self::form_wrap( self::table_wrap( $content ), $nonce );
	}

	/**
	 * Wraps a content in a form.
	 *
	 * @param string $content
	 * @param string $nonce (optional)
	 *
	 * @return string
	 */
	public static function form_wrap( $content, $nonce = 'update_options' ) {
		return Util::html( "form method='post' action=''",
			$content,
			wp_nonce_field( $nonce, '_wpnonce', $referer = true, $echo = false )
		);
	}

	/**
	 * Wraps a content in a table.
	 *
	 * @param string $content
	 *
	 * @return string
	 */
	public static function table_wrap( $content ) {
		return Util::html( "table class='form-table'", $content );
	}

	/**
	 * Wraps a content in a table row.
	 *
	 * @param string $title
	 * @param string $content
	 *
	 * @return string
	 */
	public static function row_wrap( $title, $content ) {
		return Util::html( 'tr',
			Util::html( "th scope='row'", $title ),
			Util::html( 'td', $content )
		);
	}


// ____________PRIVATE METHODS____________


// Utilities


	/**
	 * Generates the proper string for a name attribute.
	 *
	 * @param array|string $name The raw name
	 *
	 * @return string
	 */
	public static function get_name( $name ) {
		$name = (array) $name;

		$name_str = array_shift( $name );

		foreach ( $name as $key ) {
			$name_str .= '[' . esc_attr( $key ) . ']';
		}

		return $name_str;
	}

	/**
	 * Traverses the formdata and retrieves the correct value.
	 *
	 * @param string $name     The name of the value
	 * @param array  $value    The data that will be traversed
	 * @param mixed  $fallback (optional) The value returned when the key is not found
	 *
	 * @return mixed
	 */
	public static function get_value( $name, $value, $fallback = null ) {
		foreach ( (array) $name as $key ) {
			if ( ! isset( $value[ $key ] ) ) {
				return $fallback;
			}

			$value = $value[ $key ];
		}

		return $value;
	}

	/**
	 * Given a list of fields, validate some data.
	 *
	 * @param array $fields    List of args that would be sent to FormBuilder::input()
	 * @param array $data      (optional) The data to validate. Defaults to $_POST
	 * @param array $to_update (optional) Existing data to populate. Necessary for nested values
	 *
	 * @return array
	 */
	public static function validate_post_data( $fields, $data = null, $to_update = array() ) {
		if ( null === $data ) {
			$data = stripslashes_deep( $_POST );
		}

		foreach ( $fields as $field ) {
			$value = FormBuilder::get_value( $field['name'], $data );

			$fieldObj = FormField::create( $field );

			$value = $fieldObj->validate( $value );

			if ( null !== $value ) {
				self::set_value( $to_update, $field['name'], $value );
			}
		}

		return $to_update;
	}

	/**
	 * For multiple-choice fields, we can never distinguish between "never been set" and "set to none".
	 * For single-choice fields, we can't distinguish either, because of how self::update_meta() works.
	 * Therefore, the 'default' parameter is always ignored.
	 *
	 * @param array  $args      Field arguments.
	 * @param int    $object_id The object ID the metadata is attached to
	 * @param string $meta_type (optional)
	 *
	 * @return string
	 */
	public static function input_from_meta( $args, $object_id, $meta_type = 'post' ) {
		$single = ( 'checkbox' != $args['type'] );

		$key = (array) $args['name'];
		$key = end( $key );

		$value = get_metadata( $meta_type, $object_id, $key, $single );

		return self::input_with_value( $args, $value );
	}

	/**
	 * Updates metadata for passed list of fields.
	 *
	 * @param array  $fields
	 * @param array  $data
	 * @param int    $object_id The object ID the metadata is attached to
	 * @param string $meta_type (optional) Defaults to 'post'
	 *
	 * @return void
	 */
	public static function update_meta( $fields, $data, $object_id, $meta_type = 'post' ) {
		foreach ( $fields as $field_args ) {
			$key = $field_args['name'];

			if ( 'checkbox' == $field_args['type'] ) {
				$new_values = isset( $data[ $key ] ) ? $data[ $key ] : array();

				$old_values = get_metadata( $meta_type, $object_id, $key );

				foreach ( array_diff( $new_values, $old_values ) as $value ) {
					add_metadata( $meta_type, $object_id, $key, $value );
				}

				foreach ( array_diff( $old_values, $new_values ) as $value ) {
					delete_metadata( $meta_type, $object_id, $key, $value );
				}
			} else {
				$value = isset( $data[ $key ] ) ? $data[ $key ] : '';

				if ( '' === $value ) {
					delete_metadata( $meta_type, $object_id, $key );
				} else {
					update_metadata( $meta_type, $object_id, $key, $value );
				}
			}
		}
	}

	/**
	 * Sets value using a reference.
	 *
	 * @param array  $arr
	 * @param string $name
	 * @param mixed  $value
	 *
	 * @return void
	 */
	private static function set_value( &$arr, $name, $value ) {
		$name = (array) $name;

		$final_key = array_pop( $name );

		while ( ! empty( $name ) ) {
			$key = array_shift( $name );

			if ( ! isset( $arr[ $key ] ) ) {
				$arr[ $key ] = array();
			}

			$arr =& $arr[ $key ];
		}

		$arr[ $final_key ] = $value;
	}
}