<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/25/2015
 * Time: 1:29 PM
 */

namespace Diress\Module;


abstract class Base {
	/**
	 * Setting values.
	 * @var array
	 */
	public $settings = array();
	/**
	 * Setting values.
	 * @var array
	 */
	public $defaultSettings = array(
		'enabled' => true
	);
	/**
	 * 'yes' if the method is enabled
	 * @var string
	 */
	public $enabled = 'yes';
	/** @var  string */
	protected $id;

	/**
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}

	abstract function run();

	/**
	 * @return bool
	 */
	public function isAvailable() {
		$is_available = ( 'yes' === $this->enabled ) ? true : false;

		return $is_available;
	}

	/**
	 * @param $key
	 * @param null $empty_value
	 *
	 * @return mixed
	 */
	public function get_option( $key, $empty_value = null ) {
		if ( empty( $this->settings ) ) {
			$this->init_settings();
		}

		// Get option default if unset
		if ( ! isset( $this->settings[ $key ] ) ) {
			$this->settings[ $key ] = isset( $defaultSettings[ $key ] ) ? $defaultSettings[ $key ] : '';
		}

		if ( ! is_null( $empty_value ) && empty( $this->settings[ $key ] ) ) {
			$this->settings[ $key ] = $empty_value;
		}

		return $this->settings[ $key ];
	}

	public function init_settings() {
		$this->settings = get_theme_mod( 'diress_' . $this->id . '_settings', null );
		if ( ! $this->settings || ! is_array( $this->settings ) ) {
			$this->settings = array();
		}
		$this->settings = wp_parse_args( $this->settings, $this->defaultSettings );
		if ( ! empty( $this->settings ) && is_array( $this->settings ) ) {
			$this->settings = array_map( array( $this, 'format_settings' ), $this->settings );
			$this->enabled  = isset( $this->settings['enabled'] ) && $this->settings['enabled'] == 'yes' ? 'yes' : 'no';
		}
	}

	/**
	 * Decode values for settings.
	 *
	 * @param mixed $value
	 *
	 * @return array
	 */
	public function format_settings( $value ) {
		return is_array( $value ) ? $value : $value;
	}

	/**
	 * Get module template
	 * @param $name
	 * @param $args
	 */
	public function get_template($template_name, $args = array()){
		global $diress;
		$template_path =  'inc/Module/'.ucfirst($this->id).'/template/';
		$diress->Template()->get_template($template_name, $args, $template_path);
	}
}