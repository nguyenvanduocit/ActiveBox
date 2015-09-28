<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/25/2015
 * Time: 1:28 PM
 */

namespace Diress;


class Diress {
	/** @var  \Diress\Diress */
	private static $instance;
	/**
	 * @return \Diress\Diress
	 */
	public static function getInstance(){
		if(is_null(static::$instance)){
			static::$instance = new static();
		}
		return static::$instance;
	}

	/**
	 * Run the theme
	 */
	public function run() {
		// Load and register team
		$this->Term()->init();
		// Load and register posttype
		$this->PostType()->init();
		// Run all active module
		$this->Module()->runActivedModules();
		// Load and register shortcode
		$this->Shortcode()->init();
		// Load and init front
		$this->Front()->init();
	}
	public function Term(){
		return Term::getInstance();
	}
	public function Shortcode(){
		return Shortcode::getInstance();
	}

	public function PostType(){
		return PostType::getInstance();
	}
	/**
	 * @return Front
	 */
	public function Front(){
		return Front::getInstance();
	}
	/**
	 * @return \Diress\Module
	 */
	public function Module() {
		return Module::getInstance();
	}

	/**
	 * @return \Diress\Template
	 */
	public function Template(){
		return Template::getInstace();
	}
}