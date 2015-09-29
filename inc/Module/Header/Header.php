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
	public function __construct() {
		$this->id = 'header';
		$this->init_settings();
	}

	public function run() {
		add_action( 'diress_page_header', array( $this, 'renderSection' ) );
		add_action('customize_register', array($this,'registerCustomizer'));
	}
	public function registerCustomizer($wp_customize){
		$wp_customize->add_section( 'header',
			array(
				'title' => __( 'Header', DIRESS_DOMAIN ), //Visible title of section
				'priority' => 20, //Determines what order this appears in
				'capability' => 'edit_theme_options', //Capability needed to tweak
				'description' => __('Customizer the theme',DIRESS_DOMAIN), //Descriptive tooltip
				'active_callback' => 'is_front_page',
			)
		);
		$wp_customize->add_setting( 'accent_color', array(
			'default' => '#f72525',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
			'label' => __( 'Accent Color', 'theme_textdomain' ),
			'section' => 'header',
		) ) );
	}
	public function renderSection() {
		$this->get_template('section.php');
	}
}