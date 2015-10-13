<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/27/2015
 * Time: 1:23 AM
 */

namespace Diress\Module\Footer;

class Footer  extends \AEngine\Module\FrontModule{
	public function __construct() {
		$this->defaultSettings['copyright_text'] = '&coppyright Sen Viet';
		$this->id = 'footer';
		$this->init_settings();
	}

	public function run() {
		add_action( 'diress_before_footer', array( $this, 'renderSection' ) );
		$this->registerSidebar();
	}
	public function renderSection(){
		$this->get_template('section.php');
	}
	protected function registerSidebar(){
		/**
		 * Creates a sidebar Footer 1
		 * @param string|array  Builds Sidebar based off of 'name' and 'id' values.
		 */
		$args = array(
			'name'          => __( 'Footer 1', DIRESS_DOMAIN ),
			'id'            => 'diress-footer-1',
			'description'   => '',
			'class'         => '',
			'before_widget' => '<aside id="%1$s" class="footer-col col-md-4 %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h5 class="widgettitle">',
			'after_title'   => '</h5>'
		);

		register_sidebar( $args );

		/**
		 * Creates a sidebar Footer 2
		 * @param string|array  Builds Sidebar based off of 'name' and 'id' values.
		 */
		$args = array(
			'name'          => __( 'Footer 2', DIRESS_DOMAIN ),
			'id'            => 'diress-footer-2',
			'description'   => '',
			'class'         => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>'
		);

		register_sidebar( $args );


		/**
		 * Creates a sidebar Footer 3
		 * @param string|array  Builds Sidebar based off of 'name' and 'id' values.
		 */
		$args = array(
			'name'          => __( 'Footer 3', DIRESS_DOMAIN ),
			'id'            => 'diress-footer-3',
			'description'   => '',
			'class'         => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>'
		);

		register_sidebar( $args );
	}
}