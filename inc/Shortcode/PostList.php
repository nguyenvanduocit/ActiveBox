<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 2:44 PM
 */

namespace Diress\Shortcode;


class PostList  extends \AEngine\Shortcode\PostList{
	public function getTemplate(){
		global $aEngine;
		$aEngine->Template()->get_template($this->loop_file,$this->template_args, $this->loop_part);
	}
}