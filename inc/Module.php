<?php
/**
 * This is module manager
 * User: nguyenvanduocit
 * Date: 9/25/2015
 * Time: 5:25 PM
 */

namespace Diress;


class Module extends \AEngine\Module{
	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		$load_modules = array(
			'\Diress\Module\Header\Header',
			'\Diress\Module\Feature\Feature',
			'\Diress\Module\Work\Work',
			'\Diress\Module\Team\Team',
			'\Diress\Module\Testimonial\Testimonial',
			'\Diress\Module\CallToAction\CallToAction',
			'\Diress\Module\Menu\Menu',
			'\Diress\Module\Footer\Footer',
		);
		$this->loadModule( $load_modules );
	}
}