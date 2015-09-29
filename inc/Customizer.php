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
	public function init(){
		// Setup the Theme Customizer settings and controls...
		add_action( 'customize_register' , array( $this , 'register' ) );
		add_action('customize_save', array($this, 'onCustomizerSave'));
		add_action( 'wp_head' , array( $this , 'outputCustomizeCss' ) );
	}
	public function onCustomizerSave($customizer){

	}
	/**
	 * @param $wp_customize \WP_Customize_Manager
	 */
	public function register($wp_customize){
		/**
		 * This method add some known setting of this theme. If you develop some new plugin, feel fee to use hook 'customize_register' to add your setting.
		 */
		$wp_customize->remove_section('static_front_page');
		$wp_customize->remove_panel('nav_menus');

		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	}
	public static function outputCustomizeCss() {
		?>
		<!--Customizer CSS-->
		<style type="text/css">
			<?php do_action('diress_render_customize_css') ?>
		</style>
		<!--/Customizer CSS-->
		<?php
	}
}