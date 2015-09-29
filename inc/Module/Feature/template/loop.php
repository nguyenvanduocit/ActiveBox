<?php
global $wp_query, $diress;
/** @var \Diress\PostType\Feature $postType */
$postType = $diress->PostType()->getPostType('feature');
while($wp_query->have_posts()):$wp_query->the_post();
	?>
	<div class="col-md-4 col-sm-6 feature text-center">
		<?php echo $postType->renderIcon(get_the_ID()); ?>
		<div class="feature-content">
			<h5><?php the_title() ?></h5>
			<?php the_content(); ?>
		</div>
	</div>
	<?php if( ($wp_query->current_post+1) % 3 == 0): ?>
		<div class="clearfix"></div>
	<?php endif ?>
<?php endwhile; ?>