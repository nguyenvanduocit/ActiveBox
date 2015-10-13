<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/25/2015
 * Time: 5:06 PM
 */

namespace Diress\Module\Header;


class Header extends \AEngine\Module\FrontModule {
	public function __construct() {
		$this->id = 'header';
		$this->controls = array(
				"header_logo_src" => array(
						'label' => 'Logo',
						'type'=>'upload',
						'default'=>TEMPLATE_URL.'/images/logo.png'
				),
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

	/**
	 * Run the module
	 */
	public function run() {
		parent::run();
		add_action( 'diress_page_header', array( $this, 'renderSection' ) );
		add_action( 'customize_preview_init', array($this, 'enqueuePreviewAsset') );
		add_action( 'diress_render_customize_css', array($this, 'outputCustomizeCss') );

	}

	/**
	 * Output customized css to header
	 */
	public function outputCustomizeCss(){
		echo sprintf('.diress_header_panner_button{background-color:%1$s}', $this->settings['panner_btn_bg_color']);
		echo sprintf('section.banner{background-image:url(%1$s)}', $this->settings['panner_background_image']);
	}

	/**
	 * Enqueue asset for customizer preview
	 */
	public function enqueuePreviewAsset(){
		wp_enqueue_script( 'header-customizer',TEMPLATE_URL.'/inc/Module/Header/js/customizer.js',array( 'jquery','customize-preview' ),DIRESS_VERSION,true );
	}

	/**
	 * Render the section
	 */
	public function renderSection() {
		$this->get_template('section.php', $this->getSettings());
	}
}