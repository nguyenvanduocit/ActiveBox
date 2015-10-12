<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/27/2015
 * Time: 9:58 AM
 */

namespace Diress\Term;


class WorkCategory extends \AEngine\Term\Base{
	public function __construct(){
		$this->name = 'work-category';
		$this->singularName ='Work category';
		$this->pluralName = 'Work categories';
		$this->menuName = 'Category';
		$this->slug = 'work-cateogry';
	}

	function init() {
		add_action( 'init', array( $this, 'registerTerm' ));
	}
}