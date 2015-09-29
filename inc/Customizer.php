<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 7:28 AM
 */

namespace Diress;


class Customizer {
	protected $sectionName;
	/** @var  \Diress\Customizer */
	private static $instance;
	/**
	 * @return \Diress\Customizer
	 */
	public static function getInstance(){
		if(is_null(static::$instance)){
			static::$instance = new static();
		}
		return static::$instance;
	}
	public function __construct(){
		$this->sectionName = 'diress_options';
	}
	public function mayInit(){
		// Setup the Theme Customizer settings and controls...
		add_action( 'customize_register' , array( $this , 'register' ) );
	}

	/**
	 * @param $wp_customize \WP_Customize_Manager
	 */
	public function register($wp_customize){
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	}
}