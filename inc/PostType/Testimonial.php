<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 8:33 PM
 */

namespace Diress\PostType;


class Testimonial extends \AEngine\PostType\Base{

	public function __construct(){

		$this->postType = 'testimonial';
		$this->singularName ='Testimonial';
		$this->pluralName = 'Testimonial';
		$this->menuName = 'Testimonial';
		$this->slug = 'testimonial';
		$this->args = array(
			'supports'=>array( 'title', 'editor', 'thumbnail')
		);
	}

	public function init() {
		add_action( 'init', array( $this, 'registerPostType' ));
	}
}