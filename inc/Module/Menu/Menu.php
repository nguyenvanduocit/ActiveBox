<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/25/2015
 * Time: 11:35 PM
 */

namespace Diress\Module\Menu;


class Menu extends \AEngine\Module\Base{
	public function __construct() {
		$this->id = 'menu';
		$this->init_settings();
	}
	public function run() {
		add_action( 'diress_header_after-menu', array( $this, 'renderLeftNav' ) );
	}

	public function renderLeftNav() {
		$this->get_template('nav-header.php');
	}
}