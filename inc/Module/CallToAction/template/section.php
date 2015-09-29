<section id="download" class="section download dark">
	<div class="container">
		<div class="col-md-8 col-md-offset-2 text-center">
			<h3 class="cta-title"><?php if(isset($cta_text)) {_e($cta_text);} ?></h3>
			<p class="cta-desc"><?php if(isset($cta_desc)) {_e($cta_desc);} ?></p>
			<a href="<?php if(isset($cta_btn_href)) {_e($cta_btn_href);} ?>" class="btn btn-large cta-button"><?php if(isset($cta_btn_text)) {_e($cta_btn_text);} ?></a>
		</div>
	</div>
</section><!-- download -->