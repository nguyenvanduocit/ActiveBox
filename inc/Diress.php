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
	}
	public function Admin(){
		return Admin::getInstance();
	}
	public function Customizer(){
		return Customizer::getInstance();
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
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		_remove_theme_support('menus');
	}
}