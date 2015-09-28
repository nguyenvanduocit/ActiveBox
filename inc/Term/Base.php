<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/27/2015
 * Time: 9:58 AM
 */

namespace Diress\Term;


abstract class Base {
	protected $singularName;
	protected $pluralName;
	protected $menuName;
	protected $name;
	protected $slug;
	protected $meta_fields;
	abstract function init();
	public function registerTerm(){
		$args = array(
			'hierarchical' => true,
			'labels' => $this->createLable(),
			'show_ui' => true,
			'public' => true,
			'query_var' => true,
			'show_in_nav_menus' => true,
			'show_admin_column' => true,
			'rewrite' => array(
				'slug' => $this->slug
			)
		);
		$object_types = apply_filters('diress_term_'.$this->name.'_object_type', array());
		register_taxonomy( $this->getName(), $object_types, $args );
	}

	protected function createLable () {
		$singular = $this->getSingularName();
		$plural = $this->getPluralName();
		$menu = $this->getMenuName();
		$labels = array(
			'name' => sprintf(_x( '%s', 'taxonomy general name', DIRESS_DOMAIN ),$plural),
			'singular_name' => sprintf(_x( '%s', 'taxonomy singular name', DIRESS_DOMAIN ), $singular),
			'search_items' => sprintf(__( 'Search %s', DIRESS_DOMAIN ), $plural),
			'all_items' => sprintf( __( 'All %s', DIRESS_DOMAIN ), $plural ),
			'parent_item' => sprintf(__( 'Parent %s', DIRESS_DOMAIN ),$singular),
			'parent_item_colon' => sprintf(__( 'Parent %s:', DIRESS_DOMAIN ), $singular),
			'new_item' => sprintf( __( 'New %s', DIRESS_DOMAIN ), $singular ),
			'update_item' => sprintf(__( 'Update %s', DIRESS_DOMAIN ), $singular),
			'add_new_item' => sprintf( __( 'Add New %s', DIRESS_DOMAIN ), $singular ),
			'new_item_name' => sprintf(__( 'New %s Name', DIRESS_DOMAIN ), $singular),
			'menu_name' => sprintf( __( '%s', DIRESS_DOMAIN ), $menu )
		);
		return $labels;
	}
	/**
	 * @return mixed
	 */
	public function getSingularName() {
		return $this->singularName;
	}

	/**
	 * @param mixed $singularName
	 */
	public function setSingularName( $singularName ) {
		$this->singularName = $singularName;
	}

	/**
	 * @return mixed
	 */
	public function getPluralName() {
		return $this->pluralName;
	}

	/**
	 * @param mixed $pluralName
	 */
	public function setPluralName( $pluralName ) {
		$this->pluralName = $pluralName;
	}

	/**
	 * @return mixed
	 */
	public function getMenuName() {
		return $this->menuName;
	}

	/**
	 * @param mixed $menuName
	 */
	public function setMenuName( $menuName ) {
		$this->menuName = $menuName;
	}

	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName( $name ) {
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getSlug() {
		return $this->slug;
	}

	/**
	 * @param mixed $slug
	 */
	public function setSlug( $slug ) {
		$this->slug = $slug;
	}

	/**
	 * @return mixed
	 */
	public function getMetaFields() {
		return $this->meta_fields;
	}

	/**
	 * @param mixed $meta_fields
	 */
	public function setMetaFields( $meta_fields ) {
		$this->meta_fields = $meta_fields;
	}
}