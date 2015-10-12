<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/27/2015
 * Time: 11:34 AM
 */

namespace Diress\PostType;


class Work extends \AEngine\PostType\Base{

	public function __construct(){

		$this->postType = 'work';
		$this->singularName ='Work';
		$this->pluralName = 'Works';
		$this->menuName = 'Work';
		$this->slug = 'work';
		$this->terms = array('work-category' );
		$this->args = array(
			'supports'=>array( 'title', 'excerpt', 'thumbnail')
		);
	}

	function init() {
		add_action( 'init', array( $this, 'registerPostType' ));
	}
}