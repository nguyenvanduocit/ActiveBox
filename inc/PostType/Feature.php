<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/27/2015
 * Time: 11:34 AM
 */

namespace Diress\PostType;


class Feature extends Base{

	public function __construct(){

		$this->postType = 'feature';
		$this->singularName ='Feature';
		$this->pluralName = 'Features';
		$this->menuName = 'Feature';
		$this->slug = 'feature';
		$this->args = array(
			'supports'=>array( 'title', 'editor', 'thumbnail')
		);
	}

	function init() {
		add_action( 'init', array( $this, 'registerPostType' ));
	}
}