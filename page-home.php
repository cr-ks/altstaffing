<?php
/*
 Template Name: Home Page
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

<div style="display: none;">
	<div id="News-Container">
		<!-- POST POPULATION -->
		<?php 
			$args = array('category_name'=>'News' );
			$query = new WP_Query( $args );
			$divID = 1;
			while ( $query->have_posts() && $divID < 4 ) : $query->the_post(); 
			$link = get_the_excerpt();
			$link = str_replace('<p>', '', $link);
			$link = str_replace('</p>', '', $link);
		?>
			
			<div class="news-section-column">
				<div class="news-section-image"id="news-section-image-<?php echo $divID ?>">
					<?php the_post_thumbnail(); ?>
				</div>
				<div class="news-section-title" id="news-section-title-<?php echo $divID ?>"><?php the_title(); ?></div>
				<div class="news-section-content" id="news-section-content-<?php echo $divID ?>"><?php the_content(); ?></div>
				<a class="wp-block-button__link" href="<?php echo $link; ?>">read more</a>
			</div>


		<?php $divID++ ?>
		<?php endwhile; ?>
		<div class="clear"></div>
	</div>
</div>

<!-- FOOTER -->
<?php get_footer(); ?>
<!-- END FOOTER -->