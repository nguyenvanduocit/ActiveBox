<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 10:25 PM
 */

namespace Diress\Abstracts;


use Diress\Form\Form;

class Widget extends \WP_Widget{
	/**
	 * Widget defaults.
	 * @var array
	 */
	protected $defaults = array();
	/**
	 * Widgets to register.
	 * @var array
	 */
	private static $widgets = array();
	/**
	 * Initializes widget.
	 *
	 * @param string $class
	 * @param string $file (optional)
	 * @param string $base (optional)
	 *
	 * @return void
	 */
	public static function init( $class, $file = '', $base = '' ) {
		self::$widgets[] = $class;
		add_action( 'widgets_init', array( __CLASS__, 'register' ) );
		//todo remember to delete option
	}
	/**
	 * Registers widgets.
	 *
	 * @return void
	 */
	public static function register() {
		foreach ( self::$widgets as $widget ) {
			register_widget( $widget );
		}
	}
	/**
	 * Displays widget content.
	 *
	 * @param array $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * @param array $instance The settings for the particular instance of the widget.
	 *
	 * @return void
	 */
	public function widget( $args, $instance ) {
		$instance = wp_parse_args( $instance, $this->defaults );
		extract( $args );
		/** @var string $before_widget */
		echo $before_widget;
		$title = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
		if ( ! empty( $title ) ) {
			/** @var string $after_title */
			/** @var string $before_title */
			echo $before_title . $title . $after_title;
		}
		$this->content( $instance );
		/** @var string $after_widget */
		echo $after_widget;
	}
	/**
	 * This is where the actual widget content goes.
	 *
	 * @param array $instance The settings for the particular instance of the widget.
	 *
	 * @return void
	 */
	protected function content( $instance ) { }
//_____HELPER METHODS_____
	/**
	 * Generates a input form field.
	 *
	 * @param array $args
	 * @param array $formdata (optional)
	 *
	 * @return string
	 */
	protected function input( $args, $formdata = array() ) {
		$prefix = array( 'widget-' . $this->id_base, $this->number );
		$form = new Form( $formdata, $prefix );
		// Add default class
		if ( ! isset( $args['extra'] ) && 'text' == $args['type'] ) {
			$args['extra'] = array( 'class' => 'widefat' );
		}
		// Add default label position
		if ( ! in_array( $args['type'], array( 'checkbox', 'radio' ) ) && empty( $args['desc_pos'] ) ) {
			$args['desc_pos'] = 'before';
		}
		$name = $args['name'];
		if ( ! is_array( $name ) && '[]' == substr( $name, -2 ) ) {
			$name = array( substr( $name, 0, -2 ), '' );
		}
		$args['name'] = $name;
		return $form->input( $args );
	}
}