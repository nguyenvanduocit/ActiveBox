<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 12:59 AM
 */

namespace Diress\Module\CallToAction;

class CallToAction extends \AEngine\Module\Base{
	public function __construct() {
		$this->id = 'CallToAction';
		$this->controls = array(
			"cta_text" => array(
				'label' => 'Call to action',
				'type'=>'text',
				'default'=>'Are You Ready to Start? Download Now For Free!'
			),
			"cta_desc" => array(
				'label' => 'Description',
				'type'=>'textarea',
				'default'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna vel scelerisque nisl consectetur et.'
			),
			"cta_bg_color" => array(
				'label' => 'Background color',
				'type'=>'color',
				'default'=>'#E8E8E8'
			),
			"cta_btn_text" => array(
				'label' => 'Button text',
				'type'=>'text',
				'default'=>'Explore now'
			),
			"cta_btn_href" => array(
				'label' => 'Button href',
				'type'=>'text',
				'default'=>'http://laptrinh.senviet.org'
			),
			"cta_btn_bg_color" => array(
				'label' => 'Button color',
				'type'=>'color',
				'default'=>'#e84545'
			)
		);
		$this->init_settings();
	}
	public function run() {
		parent::run();
		add_action( 'diress_render_calltoaction_module', array( $this, 'renderSection' ) );
		add_filter('diress_header_menu_items', array($this,'addMenuItem'));
		add_action( 'customize_preview_init', array($this, 'enqueuePreviewAsset') );
		add_action( 'diress_render_customize_css', array($this, 'outputCustomizeCss') );
	}
	public function addMenuItem($items){
		$items['download'] = 'Download';
		return $items;
	}

	public function renderSection(){
		$this->get_template('section.php', $this->settings);
	}
	/**
	 * Output customized css to header
	 */
	public function outputCustomizeCss(){
		echo sprintf('.cta-button{background-color:%1$s}', $this->settings['cta_btn_bg_color']);
		echo sprintf('#download{background-color:%1$s}', $this->settings['cta_bg_color']);
	}

	/**
	 * Enqueue asset for customizer preview
	 */
	public function enqueuePreviewAsset(){
		wp_enqueue_script( 'cta-customizer',TEMPLATE_URL.'/inc/Module/CallToAction/js/customizer.js',array( 'jquery','customize-preview' ),DIRESS_VERSION,true );
	}
}