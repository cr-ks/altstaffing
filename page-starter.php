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

<!-- FOOTER -->
<?php get_footer(); ?>
<!-- END FOOTER -->

<!-- SHORTCODE SCRIPT -->
<script>
const section = document.querySelectorAll('section')[0];
let html =  section.innerHTML
let regex = new RegExp('<p>\\[','gi');

// create shortcodes array
let shortcodes = new Array();
let substring, element, type, background;
while (regex.exec(html)){
  substring = html.substring(regex.lastIndex - 1);
  element = substring.substring(0, substring.indexOf('</p>'));

  type = element.substring(element.indexOf('type') + 6);
  type = type.substring(0, type.indexOf('”'));

  if (element.indexOf('background') != -1) {
    background = element.substring(element.indexOf('background') + 12);
    background = background.substring(0, background.indexOf('”'));
	} else { background = null }
	
	if (element.indexOf('name') != -1) {
    name = element.substring(element.indexOf('name') + 6);
    name = name.substring(0, name.indexOf('”'));
  } else { name = null }

  shortcodes.push({
    type: type,
		background: background,
		name: name,
    code: element
  });
}

// edit the page
if (shortcodes.length > 0) {
	console.log(':: SHORTCODE SECTIONS ::')
  console.log(shortcodes);

  let insert, element;
  for (let i = 0; i < shortcodes.length; i++) {
		additional_tag = i > 0 ? '</div>' : '';

		if (shortcodes[i].name) {
			additional_tag = additional_tag + `<a id="${shortcodes[i].name}"></a>`;
		}
		
		switch (shortcodes[i].type) {
			case 'Hero':
			const image_raw = '<?php the_post_thumbnail("1200"); ?>';
			const heroImage = image_raw ? image_raw.substring(image_raw.indexOf('src=') + 5, image_raw.indexOf('.jpg') + 4) : null;
			insert = `${additional_tag}<div class="${shortcodes[i].type}" style="background-image: url('${heroImage}')">`;
			break;

			case 'Full-Image-Panel':
			let img = html.substring(html.indexOf('Full-Image-Panel'));
			img = img.substring(img.indexOf('<figure class="wp-block-image">'), img.indexOf('</figure>') + 9);
			html = html.replace(img, '');
			img = img.substring(img.indexOf('src=') + 5, img.indexOf('.jpg') + 4);
			insert = `${additional_tag}<div class="${shortcodes[i].type}" style="background-image: url('${img}')">`;
			break;

			case 'Standard-Footer':
			insert = `${additional_tag}<div class="${shortcodes[i].type}">FOOTER`;

			default:
			insert = `${additional_tag}<div class="${shortcodes[i].type} section-${shortcodes[i].background}">`;
		}

		element = `<p>${shortcodes[i].code}</p>`;
    html = html.replace(element, insert);
  }

  // put the page back
  html = html.replace(`</section>`, `</div></section>`);
  section.innerHTML = html;
}

// Smooth anchor transition
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
				e.preventDefault();

        document.getElementById(this.getAttribute('href').substring(1)).scrollIntoView({
						behavior: 'smooth', 
						block: 'start'
        });
    });
});

</script>
<!-- END SCRIPT -->
