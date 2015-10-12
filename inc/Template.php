<?php
/**
 * This is template manager
 * User: nguyenvanduocit
 * Date: 9/25/2015
 * Time: 10:28 PM
 */

namespace Diress;


class Template extends \AEngine\Template{
	public function getTempateDir(){
		return TEMPLATE_DIR;
	}
}