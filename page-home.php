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

	<div class="resource-link">
		<a href="/resources"><img src="/wp-content/themes/ica_master/library/images/resourcesbutton.png"></a>
	</div>

</div>

<!-- FOOTER -->
<?php get_footer(); ?>
<!-- END FOOTER -->

<script>

	const image_raw = '<?php the_post_thumbnail('1200'); ?>';
	const image = image_raw ? image_raw.substring(image_raw.indexOf('src=') + 5, image_raw.indexOf('.jpg') + 4) : null;

	console.log(':: Custom Shortcodes by DMH ::');
	const section = document.querySelectorAll('section')[0];
	let html =  section.innerHTML
	let regex = new RegExp('<p>\\[','gi');

	let shortcodes = new Array();
	while (regex.exec(html)){
		shortcodes.push(regex.lastIndex);
	}

	if (shortcodes.length > 0) {
		section.html = `<div></div>`; // replace the page with nothing while we rearrange the data

		let title, tag, insert = '', element = '';
		let insertions = [];

		for (let i = 0; i < shortcodes.length; i++) {
			// let index = shortcodes[i] - 1 + (insert.length - element.length);
			const substring = html.substring(shortcodes[i] - 1);
			element = substring.substring(0, substring.indexOf('</p>'));
			console.log(':: Shortcode found - ' + element);

			title = element.substring(element.indexOf('background') + 12);
			title = title.substring(0, title.indexOf(']') - 1);

			tag = i > 0 ? '</div>' : '';
			insert = title === 'image' ? `${tag}<div class="section-${title}" style="background-image: url('${image}')">` : `${tag}<div class="section-${title}">`;
			element = `<p>${element}</p>`;

			insertions.push({ element, insert })
		}

		for (let insertion of insertions) {
			html = html.replace(insertion.element, insertion.insert);
		}

		html = html.replace(`</section>`, `</div></section>`);
		section.innerHTML = html;
	}

</script>
