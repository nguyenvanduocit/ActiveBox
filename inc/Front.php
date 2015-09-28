<?php
/**
 * This class is used for manage front-end asset and some business on front-end.
 * User: nguyenvanduocit
 * Date: 9/25/2015
 * Time: 11:22 PM
 */

namespace Diress;


class Front {
	/** @var  \Diress\Front */
	private static $instance;

	/**
	 * @return Front
	 */
	public static function getInstance(){
		if(is_null(static::$instance)){
			static::$instance = new static();
		}
		return static::$instance;
	}
	public function init(){
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueueFrontAsset' ) );
		add_action( 'after_setup_theme', array( $this, 'afterSetupTheme' ) );
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

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );
	}

	/**
	 * Enqueue script and style
	 */
	public function enqueueFrontAsset() {
		wp_enqueue_script( 'bootstrap', TEMPLATE_URL . '/js/bootstrap.min.js', array('jquery'), DIRESS_VERSION, true);
		wp_enqueue_script( 'flexslider', TEMPLATE_URL . '/js/jquery.flexslider-min.js', array('jquery'), DIRESS_VERSION, true);
		wp_enqueue_script( 'fancybox', TEMPLATE_URL . '/js/jquery.fancybox.pack.js', array('jquery'), DIRESS_VERSION, true);
		wp_enqueue_script( 'waypoints', TEMPLATE_URL . '/js/jquery.waypoints.min.js', array('jquery'), DIRESS_VERSION, true);
		wp_enqueue_script( 'retina', TEMPLATE_URL . '/js/retina.min.js', array('jquery'), DIRESS_VERSION, true);
		wp_enqueue_script( 'modernizr', TEMPLATE_URL . '/js/modernizr.js', array('jquery'), DIRESS_VERSION, true);
		wp_enqueue_script( 'main-script', TEMPLATE_URL . '/js/main.js', array('jquery'), DIRESS_VERSION, true);

		wp_enqueue_style( 'bootstrap', TEMPLATE_URL . '/css/bootstrap.min.css' );
		wp_enqueue_style( 'flexslider', TEMPLATE_URL . '/css/flexslider.css' );
		wp_enqueue_style( 'fancybox', TEMPLATE_URL . '/css/jquery.fancybox.css' );
		wp_enqueue_style( 'main-style', TEMPLATE_URL . '/css/main.css' );
		wp_enqueue_style( 'responsive', TEMPLATE_URL . '/css/responsive.css' );
		wp_enqueue_style( 'animate', TEMPLATE_URL . '/css/animate.min.css' );
		wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
	}
}