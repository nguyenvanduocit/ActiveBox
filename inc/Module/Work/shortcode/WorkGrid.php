<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 1:22 AM
 */

namespace Diress\Module\Work\shortcode;


use Diress\Shortcode\ShortcodeInterface;

class WorkGrid implements  ShortcodeInterface{
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
			'post_type'        => 'work',
			'post_status'      => 'publish',
			'orderby'          => $this->orderby,
			'order'            => $this->order,
			'posts_per_page'   => $this->number,

		);

		// add the course category taxonomy query
		if( ! empty( $this->category ) ) {

			$tax_query = array();
			$term_id = intval( term_exists($this->category) );

			if (! empty( $term_id) ) {

				$tax_query = array(
					'taxonomy' => 'work-category',
					'field' => 'id',
					'terms' => $term_id,
				);

			}

			$query_args['tax_query'] = array($tax_query);

		}

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
		$templatePath = 'inc/Module/Work/template/';
		$diress->Template()->get_template('loop.php',null, $templatePath);
		$shortcode_output =  ob_get_clean();
		//restore old query
		$wp_query = $current_global_query;
		wp_reset_query();
		return $shortcode_output;
	}
}