<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 9:26 PM
 */

namespace Diress;


class Admin {
	/** @var  \Diress\Admin */
	private static $instance;

	/**
	 * @return Admin
	 */
	public static function getInstance(){
		if(is_null(static::$instance)){
			static::$instance = new static();
		}
		return static::$instance;
	}
	public function init(){
		add_action( 'admin_menu', array($this, 'removeUnuseMenu') );
		add_action( 'admin_enqueue_scripts', array($this, 'enqueueAsset') );
	}
	public function enqueueAsset(){
		wp_enqueue_style( 'diress-actmin', TEMPLATE_URL . '/css/admin.css' );
	}

	public function removeUnuseMenu(){
		remove_submenu_page('themes.php', 'nav-menus.php');
		remove_submenu_page('options-general.php', 'options-discussion.php');
		remove_submenu_page('options-general.php', 'options-permalink.php');
		remove_submenu_page('options-general.php', 'options-reading.php');
		remove_submenu_page('options-general.php', 'options-writing.php');
		remove_menu_page('edit-tags.php?taxonomy=link_category');
		remove_menu_page('edit-comments.php');
		remove_menu_page( 'edit.php?post_type=page' );
		remove_menu_page( 'edit.php' );
	}
}