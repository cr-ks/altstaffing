<?php
/*
 Template Name: Starter Template
*/
?>

<!-- HEADER -->
<?php get_header(); ?>
<!-- END HEADER -->

<div class="page-container">

	<!-- MAIN -->
	<main class="main-container" id="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

		<!-- ARTICLE START -->
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article class="article-container" id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

			<!-- MAIN SECTION -->
			<section itemprop="articleBody">

				<?php
					// the content (pretty self explanatory huh)
					the_content();
				?>

			</section>
			<!-- END MAIN SECTION -->
		
			</div>
		</article>
		<?php endwhile; else : ?>
		<?php endif; ?>
		<!-- END ARTICLE -->

	</main>
</div>
<div class="hide" id="featured-image"><?php the_post_thumbnail("1200"); ?></div>

<!-- FOOTER -->
<div class="pre-footer">
	<div class="pre-footer-content">
		For more information, please visit
		<a href="#">Blue Jacket Staffing</a>
	</div>
</div>
<?php get_footer(); ?>
<!-- END FOOTER -->
