<?php
global $wp_query, $diress;
$postType = $diress->PostType()->getPostType('testimonial');
while($wp_query->have_posts()):$wp_query->the_post();
	$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
	?>
	<li>
		<div class="col-md-6">
			<div class="avatar">
				<img src="<?php _e($postType->getThumbnailSrc(array('thumbnail_id'=>$post_thumbnail_id, 'size'=>'testimonial-thumbnail'))); ?>" alt="" class="img-responsive">
			</div>
		</div>
		<div class="col-md-6">
			<blockquote>
				<?php the_content(); ?>
				<cite class="author"><?php the_title(); ?></cite>
			</blockquote>
		</div>
	</li>
<?php endwhile; ?>