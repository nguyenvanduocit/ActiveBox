<?php
global $wp_query, $diress;
$postType = $diress->PostType()->getPostType('work');
?>
<section id="works" class="works section no-padding">
	<div class="container-fluid">
		<div class="row no-gutter">
			<?php
			while($wp_query->have_posts()):$wp_query->the_post();
				$post_thumbnail_id = get_post_thumbnail_id( $post_id );
				?>
			<div class="col-lg-3 col-md-6 col-sm-6 work">
				<a href="<?php _e($postType->getThumbnailSrc(array('thumbnail_id'=>$post_thumbnail_id, 'size'=>'full'))); ?>" class="work-box">
					<img src="<?php _e($postType->getThumbnailSrc(array('thumbnail_id'=>$post_thumbnail_id, 'size'=>'work-thumbnail'))); ?>" alt="asdf">
					<div class="overlay">
						<div class="overlay-caption">
							<h5><?php the_title(); ?></h5>
							<p><?php the_excerpt(); ?></p>
						</div>
					</div><!-- overlay -->
				</a>
			</div>
			<?php endwhile; ?>
		</div>
	</div>
</section><!-- works -->