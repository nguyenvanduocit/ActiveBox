<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/27/2015
 * Time: 10:00 AM
 */

namespace Diress;


class Term extends \AEngine\Term{
	public function __construct(){
		$load_terms = array(
			'\Diress\Term\WorkCategory'
		);
		$this->loadTerm($load_terms);
	}
}