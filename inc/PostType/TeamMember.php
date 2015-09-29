<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/27/2015
 * Time: 11:34 AM
 */

namespace Diress\PostType;


class TeamMember extends Base{

	public function __construct(){

		$this->postType = 'team_member';
		$this->singularName ='Team member';
		$this->pluralName = 'Team members';
		$this->menuName = 'Team member';
		$this->slug = 'team-member';
		$this->args = array(
			'supports'=>array( 'title', 'editor', 'thumbnail','comments')
		);
		$this->meta_fields = array('role', 'facebook_url', 'twitter_url', 'gplus_url', 'linkedin_url', 'dribbble_url');
	}

	function init() {
		add_action( 'init', array( $this, 'registerPostType' ));
	}
}