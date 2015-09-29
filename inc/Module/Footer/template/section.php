<footer class="footer">
	<div class="footer-top">
		<div class="container">
			<div class="row">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("diress-footer-1") ) : ?>
					<div class="footer-col col-md-4">
						<h5>Location</h5>
						<p>3481 Melrose Place<br>Beverly Hills, CA 90210</p>
					</div>
				<?php endif; ?>
				<div class="footer-col col-md-4">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("diress-footer-2") ) : ?>
						<h5>Share with Love</h5>
						<ul class="footer-share">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="https://twitter.com/kamal_chaneman"><i class="fa fa-twitter"></i></a></li>
							<li><a href="https://www.linkedin.com/in/kamalchaneman"><i class="fa fa-linkedin"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						</ul>
					<?php endif; ?>
				</div>
				<div class="footer-col col-md-4">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("diress-footer-3") ) : ?>
						<h5>About ActiveBox</h5>
						<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec ullamcorper nulla non metus auctor fringilla.</p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div><!-- footer top -->
	<div class="footer-bottom">
		<div class="container">
			<div class="col-md-12">
				<p>Copyright © 2015 ActiveBox. All Rights Reserved<br>Made with <i class="fa fa-heart pulse"></i> by <a href="http://kamalchaneman.com/">Kamal Chaneman</a> and <a href="http://wordpresskite.com/">Nguyễn Văn Được</a></p>
			</div>
		</div>
	</div>
</footer><!-- footer -->