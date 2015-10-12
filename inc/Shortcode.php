<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/27/2015
 * Time: 1:41 PM
 */

namespace Diress;

class Shortcode extends \AEngine\Shortcode{
	public function __construct(){
		$this->shortcode_classes = apply_filters('diress_shortcode_map',array(
			'post_list'=>'\Diress\Shortcode\PostList'
		));
	}
}