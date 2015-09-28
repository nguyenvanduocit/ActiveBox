<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 12:59 AM
 */

namespace Diress\Module\CallToAction;


use Diress\Module\Base;

class CallToAction extends Base{
	public function __construct() {
		$this->id = 'calltoaction';
		$this->init_settings();
	}
	public function run() {
		add_action( 'diress_render_calltoaction_module', array( $this, 'renderSection' ) );
		add_filter('diress_header_menu_items', array($this,'addMenuItem'));
	}
	public function addMenuItem($items){
		$items['download'] = 'Download';
		return $items;
	}
	public function renderSection(){
		$this->get_template('section.php');
	}
}