<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 10:36 PM
 */

namespace Diress;


class Widget {
	private static $instance;
	protected $widget_classes;

	/**
	 * @return \Diress\Widget
	 */
	public static function getInstance(){
		if(is_null(static::$instance)){
			static::$instance = new static();
		}
		return static::$instance;
	}
	public function __construct(){
		$this->widget_classes = apply_filters('diress_widget_map',array(
			'\Diress\Widget\SocialWidget'
		));
	}
	public function init(){
		foreach( $this->widget_classes as $index => $class ){
			Abstracts\Widget::init( $class );
		}
	}
}