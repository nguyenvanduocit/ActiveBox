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
		add_action('admin_notices', array($this,'adminNotice'));
	}

	/**
	 * Show some admin notice
	 */
	public function adminNotice(){
		$dismiss = get_transient('diress_dismiss');
		$screen = get_current_screen();
		if( (!$dismiss || !$dismiss['sampledata']) && ($screen->id !='import')  ):?>
		<div class="notice frash-notice frash-notice-rate" id="frash-notice" data-message="Thanks :)">
			<div class="frash-notice-logo"></div>
			<div class="frash-notice-message">You can import sample data to take a look about how your site appears. The sample data file was packed with the theme.</div>
			<div class="frash-notice-cta">
				<a class="frash-notice-act button-primary" href="<?php echo admin_url('/import.php') ?>">Import</a>
				<button class="frash-notice-dismiss" id="import_notice_dimiss">No thanks</button>
			</div>
		</div>
	<?php
		set_transient('diress_dismiss', array('sampledata'=>true), 10*DAY_IN_SECONDS);
	endif;
	}
	public function enqueueAsset(){
		wp_enqueue_style( 'diress-adtmin', TEMPLATE_URL . '/css/admin.css' );
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