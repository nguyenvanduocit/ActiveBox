<?php
/**
 * @var string $panner_text
 *@var string $panner_desc
 * @var string $panner_btn_href
 */
?>
<section class="banner" role="banner">
	<header id="header">
		<div class="header-content clearfix">
			<a class="logo" href="#"><img class="header_logo" src="<?php if(isset($header_logo_src)) {_e($header_logo_src);} ?>" alt=""></a>
			<?php do_action('diress_header_after-menu'); ?>
		</div><!-- header content -->
	</header><!-- header -->
	<div class="container">
		<div class="col-md-10 col-md-offset-1">
			<div class="banner-text text-center">
				<h1 class="diress_header_panner_text"><?php if(isset($panner_text)) {_e($panner_text);} ?></h1>
				<p class="diress_header_panner_desc"><?php if(isset($panner_desc)) {_e($panner_desc);} ?></p>
				<a href="<?php if(isset($panner_btn_href)) {_e($panner_btn_href);} ?>" class="btn btn-large diress_header_panner_button"><?php if(isset($panner_btn_text)) {_e($panner_btn_text);} ?></a>
			</div><!-- banner text -->
		</div>
	</div>
</section><!-- banner -->