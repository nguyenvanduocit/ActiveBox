<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/25/2015
 * Time: 5:06 PM
 */

namespace Diress\Module\Header;


use Diress\Module\Base;

class Header extends Base {
	public function __construct() {
		$this->id = 'header';
		$this->init_settings();
	}

	public function run() {
		add_action( 'diress_page_header', array( $this, 'renderSection' ) );
	}

	public function renderSection() {
		$this->get_template('section.php');
	}
}