<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 4:12 PM
 */

namespace Diress\Form;

interface FormFieldInterface {
	/**
	 * Generate the corresponding HTML for a field.
	 *
	 * @param mixed $value (optional) The value to use.
	 *
	 * @return string
	 */
	function render( $value = null );

	/**
	 * Validates a value against a field.
	 *
	 * @param mixed $value The value to check.
	 *
	 * @return mixed null if the validation failed, sanitized value otherwise.
	 */
	function validate( $value );
}