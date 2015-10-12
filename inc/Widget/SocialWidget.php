<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 10:32 PM
 */

namespace Diress\Widget;

use Diress\Util;

class SocialWidget extends \AEngine\Abstracts\Widget{
	protected $defaults = array(
		'title' => 'Social connect',
		'facebook_url' => '',
		'twitter_url' => '',
		'linkedin_url' => '',
		'gplus_url' => '',
	);
	function __construct() {
		parent::__construct( 'diress-social-widget', __( 'Social Widget', DIRESS_DOMAIN ), array(
			'description' => __( 'Social widget for footer sidebar', DIRESS_DOMAIN )
		) );
	}
	function form( $instance ) {
		echo Util::html( 'p', $this->input( array(
			'type' => 'text',
			'name' => 'title',
			'desc' => __( 'Title:', DIRESS_DOMAIN )
		), $instance ) );

		echo Util::html( 'p', $this->input( array(
			'type' => 'url',
			'name' => 'facebook_url',
			'desc' => __( 'Facebook Url:', DIRESS_DOMAIN )
		), $instance ) );
		echo Util::html( 'p', $this->input( array(
			'type' => 'url',
			'name' => 'twitter_url',
			'desc' => __( 'Twitter Url:', DIRESS_DOMAIN )
		), $instance ) );
		echo Util::html( 'p', $this->input( array(
			'type' => 'url',
			'name' => 'linkedin_url',
			'desc' => __( 'LinkedIn Url:', DIRESS_DOMAIN )
		), $instance ) );
		echo Util::html( 'p', $this->input( array(
			'type' => 'url',
			'name' => 'gplus_url',
			'desc' => __( 'Google plus Url:', DIRESS_DOMAIN )
		), $instance ) );
	}

	function content( $instance ) {
		?>
		<ul class="footer-share">
			<?php if ( isset( $instance['facebook_url'] ) && ($instance['facebook_url'] != '') ): ?>
				<li><a href="<?php _e( $instance['facebook_url'] ); ?>"><i class="fa fa-facebook"></i></a>
				</li><?php endif ?>
			<?php if ( isset( $instance['twitter_url'] )&& ($instance['twitter_url'] != '') ): ?>
				<li><a href="<?php _e( $instance['twitter_url'] ); ?>"><i class="fa fa-twitter"></i></a>
				</li><?php endif ?>
			<?php if ( isset( $instance['linkedin_url'] ) && ($instance['linkedin_url'] != '')): ?>
				<li><a href="<?php _e( $instance['linkedin_url'] ); ?>"><i class="fa fa-linkedin"></i></a>
				</li><?php endif ?>
			<?php if ( isset( $instance['gplus_url'] )&& ($instance['gplus_url'] != '') ): ?>
				<li><a href="<?php _e( $instance['gplus_url'] ); ?>"><i class="fa fa-google-plus"></i></a>
				</li><?php endif ?>
		</ul>
		<?php
	}
}