<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/25/2015
 * Time: 5:06 PM
 */

namespace Diress\Module\Header;


use Diress\Module\Base;

class Header extends Base {
	protected $controls;
	public function __construct() {
		$this->id = 'header';
		$this->defaultSettings = array(
			'enabled'=>true,
			'panner_text'=>'Your Favorite One Page Multi Purpose Template',
			'panner_desc'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna vel scelerisque nisl consectetur et.',
			'panner_btn_text'=>'Explore now',
			'panner_btn_href'=>'http://laptrinh.senviet.org',
		);
		$this->controls = array(
				"panner_text" => array(
						'label' => 'Panner text',
						'type'=>'text',
						'default'=>'Your Favorite One Page Multi Purpose Template'
				),
				"panner_desc" => array(
						'label' => 'Panner description',
						'type'=>'textarea',
						'default'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna vel scelerisque nisl consectetur et.'
				),
				"panner_btn_text" => array(
						'label' => 'Button text',
						'type'=>'text',
						'default'=>'Explore now'
				),
				"panner_btn_href" => array(
						'label' => 'Button href',
						'type'=>'text',
						'default'=>'http://laptrinh.senviet.org'
				),
				"panner_btn_bg_color" => array(
						'label' => 'Button color',
						'type'=>'color',
						'default'=>'#e84545'
				),
				"panner_background_image" => array(
						'label' => 'Background image',
						'type'=>'upload',
						'default'=>TEMPLATE_URL.'/images/sample/banner.jpg'
				)
		);
		$this->init_settings();
	}

	public function run() {
		add_action( 'diress_page_header', array( $this, 'renderSection' ) );
		add_action('customize_register', array($this,'registerCustomizer'));
		add_action( 'customize_preview_init', array($this, 'enqueuePreviewAsset') );
	}
	public function enqueuePreviewAsset(){
		wp_enqueue_script( 'header-customizer',TEMPLATE_URL.'/inc/Module/Header/js/customizer.js',array( 'jquery','customize-preview' ),DIRESS_VERSION,true );
	}

	/**
	 * @param $wp_customize \WP_Customize_Manager
	 */
	public function registerCustomizer($wp_customize){
		$wp_customize->add_section( 'section_'.$this->id,
			array(
				'title' => __( 'Header', DIRESS_DOMAIN ), //Visible title of section
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
	public function renderSection() {
		$this->get_template('section.php', $this->settings);
	}
}