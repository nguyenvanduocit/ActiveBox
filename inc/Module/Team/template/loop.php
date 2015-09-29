<?php
global $wp_query, $diress;
/** @var \Diress\PostType\Feature $postType */
$postType = $diress->PostType()->getPostType('team_member');
while($wp_query->have_posts()):$wp_query->the_post();
	$postId = get_the_ID();
	$post_thumbnail_id = get_post_thumbnail_id( $postId );
	?>
	<div class="col-md-3 col-sm-6">
		<div class="person">
			<img src="<?php _e($postType->getThumbnailSrc(array('thumbnail_id'=>$post_thumbnail_id, 'size'=>'team_member-thumbnail'))); ?>" alt="" class="img-responsive">
			<div class="person-content">
				<h4><?php the_title() ?></h4>
				<h5 class="role"><?php _e(get_post_meta($postId, 'teammate_role', true)) ?></h5>
				<?php the_content(); ?>
			</div>
			<ul class="social-icons clearfix">
				<?php if($facebooUrl = get_post_meta($postId, 'teammate_facebook_url', true)): ?>
					<li><a href="<?php _e($facebooUrl); ?>"><span class="fa fa-facebook"></span></a></li>
				<?php endif; ?>
				<?php if($twitterUrl = get_post_meta($postId, 'teammate_twitter_url', true)): ?>
					<li><a href="<?php _e($twitterUrl); ?>"><span class="fa fa-twitter"></span></a></li>
				<?php endif; ?>
				<?php if($linkedinUrl = get_post_meta($postId, 'teammate_linkedin_url', true)): ?>
					<li><a href="<?php _e($linkedinUrl); ?>"><span class="fa fa-linkedin"></span></a></li>
				<?php endif; ?>

				<?php if($gplusUrl = get_post_meta($postId, 'teammate_gplus_url', true)): ?>
					<li><a href="<?php _e($gplusUrl); ?>"><span class="fa fa-google-plus"></span></a></li>
				<?php endif; ?>

				<?php if($dribbbleUrl = get_post_meta($postId, 'teammate_dribbble_url', true)): ?>
					<li><a href="<?php _e($dribbbleUrl); ?>"><span class="fa fa-dribbble"></span></a></li>
				<?php endif; ?>
			</ul>
		</div><!-- person -->
	</div>
	<?php if( ($wp_query->current_post+1) % 4 == 0): ?>
		<div class="clearfix"></div>
	<?php endif ?>
<?php endwhile; ?>