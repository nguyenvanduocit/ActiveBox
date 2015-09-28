<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/27/2015
 * Time: 1:34 PM
 */

namespace Diress\Shortcode;


interface ShortcodeInterface {
	/**
	 * All constructors must implement and accept $attributes and $content as arguments
	 *
	 * @param array $attributes
	 * @param string $content
	 * @param string $shortcode
	 * @return mixed
	 */
	public function __construct($attributes, $content, $shortcode);

	/**
	 * @return string generated output
	 */
	public function render();
}