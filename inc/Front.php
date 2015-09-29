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
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueueAsset' ) );
	}
	/**
	 * Enqueue script and style
	 */
	public function enqueueAsset() {
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