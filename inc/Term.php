<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/27/2015
 * Time: 10:00 AM
 */

namespace Diress;


class Term {
	private static $instance = null;

	/**
	 * @return \Diress\Term
	 */
	public static function getInstance(){
		if(is_null(static::$instance)){
			static::$instance = new static();
		}
		return static::$instance;
	}
	/** @var  \Diress\Term\Base[] */
	protected $terms;
	public function __construct(){
		$load_terms = array(
			'\Diress\Term\WorkCategory'
		);
		$load_terms = apply_filters( 'diress_terms', $load_terms );
		// Get sort order option
		// Load gateways in order
		foreach ( $load_terms as $term ) {
			/** @var \Diress\Term\Base $load_term */
			$load_term = is_string( $term ) ? new $term() : $term;

			$this->terms[ $load_term->getName() ] = $load_term;
		}
	}
	/**
	 * Get gateways.
	 *
	 * @access public
	 * @return PostType\Base[]
	 */
	public function getTerms() {
		return $this->terms;
	}

	/**
	 * @param $id
	 *
	 * @return PostType\Base|null
	 */
	public function getTerm($termName){
		if(array_key_exists($termName, $this->terms)){
			return $this->terms[$termName];
		}
		return null;
	}
	/**
	 * Register posttype
	 */
	public function init(){
		foreach($this->terms as $termName => $term){
			$term->init();
		}
	}
}