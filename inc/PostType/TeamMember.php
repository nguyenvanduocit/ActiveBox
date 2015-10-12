<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/27/2015
 * Time: 11:34 AM
 */

namespace Diress\PostType;


class TeamMember extends \AEngine\PostType\Base{

	public function __construct(){

		$this->postType = 'team_member';
		$this->singularName ='Team member';
		$this->pluralName = 'Team members';
		$this->menuName = 'Team member';
		$this->slug = 'team-member';
		$this->args = array(
			'supports'=>array( 'title', 'editor', 'thumbnail')
		);
		$this->meta_fields = array('role', 'facebook_url', 'twitter_url', 'gplus_url', 'linkedin_url', 'dribbble_url');
		$this->meta_fields = array(
			'teammate_role'=>array(
				'type' => 'text',
				'name' => 'teammate_role',
				'title'=>'Role',
				'value' => 'No role'
			),
			'teammate_facebook_url'=>array(
				'type' => 'text',
				'name' => 'teammate_facebook_url',
				'title'=>'Facebook profile url',
				'value' => 'http://facebook.com/'
			),
			'teammate_twitter_url'=>array(
				'type' => 'text',
				'name' => 'teammate_twitter_url',
				'title'=>'Twitter profile url',
				'value' => 'http://twitter.com/'
			),
			'teammate_gplus_url'=>array(
				'type' => 'text',
				'name' => 'teammate_gplus_url',
				'title'=>'Google Plus url',
				'value' => 'http://plus.google.com/'
			),
			'teammate_linkedin_url'=>array(
				'type' => 'text',
				'name' => 'teammate_linkedin_url',
				'title'=>'LinkedIn url',
				'value' => 'http://linkedin.com/'
			),
			'teammate_dribbble_url'=>array(
				'type' => 'text',
				'name' => 'teammate_dribbble_url',
				'title'=>'LinkedIn url',
				'value' => 'http://dribbble.com/'
			)
		);
	}

	function init() {
		add_action( 'init', array( $this, 'registerPostType' ));
	}
}