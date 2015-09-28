<?php
$menuItems = apply_filters('diress_header_menu_items', array());
?>
<?php if($menuItems): ?>
<nav class="navigation" role="navigation">
	<ul class="primary-nav">
		<?php foreach($menuItems as $slug=>$title): ?>
			<li><a href="#<?php _e($slug) ?>" class=""><?php _e($title) ?></a></li>
		<?php endforeach ?>
		<?php do_action('diress_header_menu'); ?>
	</ul>
</nav>
<a href="#" class="nav-toggle">Menu<span></span></a>
<?php endif; ?>