<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 12:52 AM
 */

namespace Diress\Module\Testimonial;


class Testimonial extends \AEngine\Module\Base{
	public function __construct() {
		$this->id = 'testimonial';
		$this->init_settings();
	}
	public function run() {
		add_action( 'diress_render_testimonial_module', array( $this, 'renderSection' ) );
		add_filter('diress_header_menu_items', array($this,'addMenuItem'));
		add_image_size( 'testimonial-thumbnail', 997, 500, true);
	}
	public function addMenuItem($items){
		$items['testimonials'] = 'testimonials';
		return $items;
	}
	public function renderSection(){
		$this->get_template('section.php');
	}
}