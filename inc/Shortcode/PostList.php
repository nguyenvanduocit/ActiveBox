<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 2:44 PM
 */

namespace Diress\Shortcode;


class PostList  implements  ShortcodeInterface{
	/**
	 * @var WP_Query to help setup the query needed by the render method.
	 */
	protected $query;

	/**
	 * @var string number of items to show on the current page
	 * Default: -1.
	 */
	protected $number;

	/**
	 * @var string ordery by course field
	 * Default: date
	 */
	protected $orderby;

	/**
	 * @var string ASC or DESC
	 * Default: 'DESC'
	 */
	protected  $order;

	/**
	 * @var category can be completed or active or all
	 */
	protected $category;

	/**
	 * @var string csv of course ids to limit the search to
	 */
	protected $ids;

	/**
	 * @var exclude courses by id
	 */
	protected $exclude;
	/**
	 * @var string post_type
	 */
	protected $post_type;
	/**
	 * @var string parth to the loop
	 */
	protected $loop_part;
	/**
	 * @var string the in the loop.
	 */
	protected $loop_file;
	protected $template_args;
	/**
	 * All constructors must implement and accept $attributes and $content as arguments
	 *
	 * @param array $attributes
	 * @param string $content
	 * @param string $shortcode
	 * @return mixed
	 */
	public function __construct($attributes, $content, $shortcode){
// set up all argument need for constructing the course query
		$this->number = isset( $attributes['number'] ) ? $attributes['number'] : '10';
		$this->orderby = isset( $attributes['orderby'] ) ? $attributes['orderby'] : 'date';
		$this->post_type = isset( $attributes['post_type'] ) ? $attributes['post_type'] : 'post';
		$this->loop_part = isset( $attributes['loop_part'] ) ? $attributes['loop_part'] : 'inc/Shortcode/template';
		$this->loop_file = isset( $attributes['loop_file'] ) ? $attributes['loop_file'] : 'loop.php';
		$this->template_args = isset( $attributes['template_args'] ) ? $attributes['template_args'] : array();

		// set the default for menu_order to be ASC
		if( 'menu_order' == $this->orderby && !isset( $attributes['order']  ) ){

			$this->order =  'ASC';

		}else{

			// for everything else use the value passed or the default DESC
			$this->order = isset( $attributes['order']  ) ? $attributes['order'] : 'DESC';

		}

		$category = isset( $attributes['category'] ) ? $attributes['category'] : '';
		$this->category = is_numeric( $category ) ? intval( $category ) : $category;

		$ids =  isset( $attributes['ids'] ) ? $attributes['ids'] : '';
		$this->ids = empty( $ids ) ? '' : explode( ',', $ids );

		$exclude =  isset( $attributes['exclude'] ) ? $attributes['exclude'] : '';
		$this->exclude = empty( $exclude ) ? '' : explode( ',', $exclude );

		// setup the course query that will be used when rendering
		$this->setup_course_query();
	}
	/**
	 * Sets up the object course query
	 * that will be used int he render method.
	 *
	 * @since 1.9.0
	 */
	protected function setup_course_query(){
		// query defaults
		$query_args = array(
			'post_type'        => $this->post_type,
			'post_status'      => 'publish',
			'orderby'          => $this->orderby,
			'order'            => $this->order,
			'posts_per_page'   => $this->number,

		);

		// limit the query if the user supplied ids
		if( ! empty( $this->ids ) && is_array( $this->ids ) ) {

			$query_args['post__in'] = $this->ids;

		}

		// exclude the course by id fromt he query
		if( ! empty( $this->exclude ) && is_array( $this->exclude ) ) {

			$query_args['post__not_in'] = $this->exclude;

		}

		$this->query = new \WP_Query( $query_args );

	}// end setup _course_query
	/**
	 * @return string generated output
	 */
	public function render(){
		global $wp_query, $diress;
		// keep a reference to old query
		$current_global_query = $wp_query;

		// assign the query setup in $this-> setup_course_query
		$wp_query = $this->query;

		ob_start();
		$diress->Template()->get_template($this->loop_file,$this->template_args, $this->loop_part);
		$shortcode_output =  ob_get_clean();
		//restore old query
		$wp_query = $current_global_query;
		wp_reset_query();
		return $shortcode_output;
	}
}