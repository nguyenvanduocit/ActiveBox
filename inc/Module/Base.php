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
	protected $settings;
	public $defaultSettings = array('enabled' => true);
	/**
	 * Customizer control
	 * @var array
	 */
	protected $controls = array();
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

	public function run(){
		if(isset($this->controls)){
			add_action('customize_register', array($this,'registerCustomizer'));
		}
	}

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
			$this->settings[ $key ] = isset( $this->defaultSettings[ $key ] ) ? $this->defaultSettings[ $key ] : '';
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
		if (isset($this->controls)) {
			foreach($this->controls as $name=>$args){
				$this->defaultSettings[$name] = $args['default'];
			}
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

	/**
	 * @return array
	 */
	public function getSettings() {
		return $this->settings;
	}
	/**
	 * Register controls to customizer
	 * @param $wp_customize \WP_Customize_Manager
	 */
	public function registerCustomizer($wp_customize){
		$wp_customize->add_section( 'section_'.$this->id,
				array(
						'title' => __( ucfirst($this->id), DIRESS_DOMAIN ), //Visible title of section
						'priority' => 120, //Determines what order this appears in
						'capability' => 'edit_theme_options', //Capability needed to tweak
						'description' => __('Customize your header.',DIRESS_DOMAIN), //Descriptive tooltip
						'active_callback' => 'is_front_page',
				)
		);

		foreach($this->controls as $name=>$control){
			$settingName = 'diress_' . $this->id . '_settings['.$name.']';
			$wp_customize->add_setting( $settingName, array(
					'default' => $control['default'],
					'transport'   => 'postMessage',
			) );
			switch($control['type']){
				case 'color':
					$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'diress_' . $this->id . '_settings-'.$name, array(
							'label'        => $control['label'],
							'section'    => 'section_'.$this->id,
							'settings'   => $settingName,
					) ) );
					break;
				case 'upload':
					$wp_customize->add_control( new \WP_Customize_Upload_Control( $wp_customize, 'diress_' . $this->id . '_settings-'.$name, array(
							'label'        => $control['label'],
							'section'    => 'section_'.$this->id,
							'settings'   => $settingName,
					) ) );
					break;
				default:
					$wp_customize->add_control('diress_' . $this->id . '_settings-'.$name, array(
							'label'    => $control['label'],
							'section'  => 'section_'.$this->id,
							'settings' => $settingName,
							'type'     => $control['type']
					));
					break;
			}
		}
	}
}