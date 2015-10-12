<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 4:54 PM
 */

namespace Diress;


class Util extends \AEngine\Util{
	public static function getElegantIconList(){
		return array(
				'icon-mobile'=>'icon-mobile',
				'icon-laptop'=>'icon-laptop',
				'icon-desktop'=>'icon-desktop',
				'icon-tablet'=>'icon-tablet',
				'icon-phone'=>'icon-phone',
				'icon-document'=>'icon-document',
				'icon-documents'=>'icon-documents',
				'icon-search'=>'icon-search',
				'icon-notebook'=>'icon-notebook',
				'icon-book-open'=>'icon-book-open'
		);
	}
}