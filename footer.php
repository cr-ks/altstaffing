			<div class="pre-footer">

			</div>
			
			<footer class="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

				<div class="footer-navigation-container" style="float: left">
					<?php wp_nav_menu(array(
    					         'container' => false,                           // remove nav container
    					         'container_class' => 'menu cf',                 // class of container (should you choose to use it)
    					         'menu' => __( 'Footer Links', 'ICA' ),  				// nav name
    					         'menu_class' => 'nav top-nav cf footer-nav',     // adding custom nav class
    					         'theme_location' => 'main-nav',                 // where it's located in the theme
    					         'before' => '',                                 // before the menu
        			               'after' => '',                                  // after the menu
        			               'link_before' => '',                            // before each link
        			               'link_after' => '',                             // after each link
        			               'depth' => 0,                                   // limit the depth of the nav
    					         'fallback_cb' => ''                             // fallback function (if there is one)
						)); ?>
				</div>
					<div class="footer-image" style="float: right">
						<!-- <img src="/wp-content/themes/alt/library/images/footer.png" /> -->
					</div>
				<!-- <div class="social" style="float: right">
					<a href="https://www.facebook.com/TheICAGroup1/"><img src="/wp-content/themes/ica_master/library/images/social/facebook.png"></a>
					<a href="https://twitter.com/TheICAGroup"><img src="/wp-content/themes/ica_master/library/images/social/twitter.png"></a>
					<a href="https://www.instagram.com/theicagroup/"><img src="/wp-content/themes/ica_master/library/images/social/instagram.png"></a>
					<a href="https://www.linkedin.com/company/theicagroup"><img src="/wp-content/themes/ica_master/library/images/social/linkedin.png"></a>
					<a href="https://www.youtube.com/channel/UCtSqorD451vQPk4ot0s3J4A"><img src="/wp-content/themes/ica_master/library/images/social/youtube.png"></a>
				</div> -->
				<div class="clear"></div>

				<div class="sub-footer">
					<p><b>The ICA Group</b><span> | </span><a href="tel:6172328765">(617) 232-8765</a><span> | </span>74 King Street, Northampton, MA 01060</p>
					<p>&copy; 2019 ICA. All rights reserved.</p>
				</div>

			</footer>

		</div>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>

	</body>

</html> <!-- end of site. what a ride! -->
