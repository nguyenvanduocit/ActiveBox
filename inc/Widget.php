<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 10:36 PM
 */

namespace Diress;


class Widget extends \AEngine\Widget{
	public function __construct(){
		$this->widget_classes = apply_filters('diress_widget_map',array(
			'\Diress\Widget\SocialWidget'
		));
	}
}