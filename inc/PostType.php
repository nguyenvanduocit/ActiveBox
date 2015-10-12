<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/27/2015
 * Time: 8:01 AM
 */

namespace Diress;


class PostType extends \AEngine\PostType{

	public function __construct() {
		$load_posttypes = array(
			'\Diress\PostType\Work',
			'\Diress\PostType\Feature',
			'\Diress\PostType\TeamMember',
			'\Diress\PostType\Testimonial'
		);
		$this->loadPostType($load_posttypes);
	}
}