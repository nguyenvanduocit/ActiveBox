<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 12:52 AM
 */

namespace Diress\Module\Work;


use Diress\Module\Base;

class Work extends Base{
	public function __construct() {
		$this->id = 'work';
		$this->init_settings();
	}
	public function run() {
		add_action( 'diress_render_work_module', array( $this, 'renderSection' ) );
		add_filter('diress_header_menu_items', array($this,'addMenuItem'));
		add_filter('diress_shortcode_map', array($this,'addShortCode'));
		add_image_size( 'work-thumbnail', 650, 350, array('center', 'center'));
	}
	public function addShortCode($shortCodeMap){
		$shortCodeMap['work-grid'] = '\Diress\Module\Work\shortcode\WorkGrid';
		return $shortCodeMap;
	}
	public function addMenuItem($items){
		$items['works'] = 'works';
		return $items;
	}
	public function renderSection(){
		echo do_shortcode('[work-grid]');
	}
}