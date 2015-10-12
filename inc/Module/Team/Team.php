<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 12:52 AM
 */

namespace Diress\Module\Team;


class Team extends \AEngine\Module\Base{
	public function __construct() {
		$this->id = 'team';
		$this->init_settings();
	}
	public function run() {
		add_action( 'diress_render_team_module', array( $this, 'renderSection' ) );
		add_filter('diress_header_menu_items', array($this,'addMenuItem'));
		add_image_size( 'team_member-thumbnail', 263, 263, true);
	}
	public function addMenuItem($items){
		$items['teams'] = 'teams';
		return $items;
	}
	public function renderSection(){
		$this->get_template('section.php');
	}
}