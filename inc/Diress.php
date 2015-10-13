<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/25/2015
 * Time: 1:28 PM
 */

namespace Diress;


use AEngine\API;
use AEngine\Template;

class Diress extends \AEngine\ThemeBase{
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
		// register widget
		$this->Widget()->init();
		$this->Customizer()->init();
		if(is_admin())
		{
			$this->Admin()->init();
		}
		else {
			// Load and init front
			$this->Front()->init();
		}
		// TODO Check if customizer is open
		// Setup the Theme Customizer settings and controls...
		$this->Customizer()->init();

		add_action( 'after_setup_theme', array( $this, 'afterSetupTheme' ) );
		add_action( 'admin_bar_menu', array($this, 'removeUnuseAdminBarItem'), 999 );
	}
	public function Admin(){
		return Admin::getInstance();
	}

	/**
	 * @return Customizer
	 */
	public function Customizer(){
		return Customizer::getInstance();
	}

	/**
	 * @return API
	 */
	public function API() {
		return API::getInstance();
	}

	/**
	 * @return Widget
	 */
	public function Widget() {
		return Widget::getInstance();
	}

	/**
	 * @return Term
	 */
	public function Term() {
		return Term::getInstance();
	}

	/**
	 * @return Shortcode
	 */
	public function Shortcode() {
		return Shortcode::getInstance();
	}

	/**
	 * @return PostType
	 */
	public function PostType() {
		return PostType::getInstance();
	}

	/**
	 * @return \AEngine\Module
	 */
	public function Module() {
		return Module::getInstance();
	}

	/**
	 * @return Front
	 */
	public function Front(){
		return Front::getInstance();
	}
	/**
	 * @param $wp_admin_bar \WP_Admin_Bar
	 */
	public function removeUnuseAdminBarItem($wp_admin_bar){
		$wp_admin_bar->remove_node('new-post');
		$wp_admin_bar->remove_node('new-user');
		$wp_admin_bar->remove_node('new-page');
		$wp_admin_bar->remove_node('comments');
	}
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	public function afterSetupTheme() {
		/*
		 * Load language for text domain from /lang dir
		 */
		load_theme_textdomain( 'DIRESS_DOMAIN', TEMPLATE_DIR . '/lang' );
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		_remove_theme_support('menus');
	}

	public function getFILE() {
		return DIRESS_FILE;
	}
	public function getDIR() {
		return DIRESS_DIR;
	}
}