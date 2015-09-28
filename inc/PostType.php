<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/27/2015
 * Time: 8:01 AM
 */

namespace Diress;


class PostType {
	private static $instance = null;

	/**
	 * @return \Diress\PostType
	 */
	public static function getInstance(){
		if(is_null(static::$instance)){
			static::$instance = new static();
		}
		return static::$instance;
	}
	/** @var  \Diress\PostType\Base[] */
	protected $postTypes;
	public function __construct(){
		$load_posttypes = array(
			'\Diress\PostType\Work'
		);
		$load_posttypes = apply_filters( 'diress_posttypes', $load_posttypes );
		// Get sort order option
		// Load gateways in order
		foreach ( $load_posttypes as $postType ) {
			/** @var \Diress\PostType\Base $load_postType */
			$load_postType = is_string( $postType ) ? new $postType() : $postType;

			$this->postTypes[ $load_postType->getPostType() ] = $load_postType;
		}
	}
	/**
	 * Get gateways.
	 *
	 * @access public
	 * @return PostType\Base[]
	 */
	public function getPostTypes() {
		return $this->postTypes;
	}

	/**
	 * @param $id
	 *
	 * @return PostType\Base|null
	 */
	public function getPostType($postTypeName){
		if(array_key_exists($postTypeName, $this->postTypes)){
			return $this->postTypes[$postTypeName];
		}
		return null;
	}
	/**
	 * Register posttype
	 */
	public function init(){
		foreach($this->postTypes as $postTypeName => $postType){
			$postType->init();
		}
	}
}