<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 12:19 AM
 */

namespace Diress\Module\Feature;

class Feature extends \AEngine\Module\Base{
	public function __construct() {
		$this->id = 'feature';
		$this->init_settings();
	}
	public function run() {
		add_action( 'diress_render_feature_module', array( $this, 'renderSection' ) );
		add_filter('diress_header_menu_items', array($this,'addMenuItem'));
	}
	public function addMenuItem($items){
		$items['features'] = 'features';
		return $items;
	}
	public function renderSection(){
		$this->get_template('section.php');
	}
}