function fadeOut(element) {
  // element.style.opacity = 0;
  element.classList.remove('show');
  element.classList.add('hide');
  // var op = 1;  // initial opacity
  // var timer = setInterval(function () {
  //     if (op <= 0.1){
  //         clearInterval(timer);
  //     }
  //     element.style.opacity = op;
  //     op -= 0.1;
  // }, 50);
}

function fadeIn(element) {
  // element.style.opacity = 0;
  element.classList.remove('hide');
  element.classList.add('show');
  // var op = 0.1;  // initial opacity
  // var timer = setInterval(function () {
  //     if (op >= 1){
  //         clearInterval(timer);
  //     }
  //     element.style.opacity = op;
  //     op += 0.1;
  // }, 10);
}

function updateGalleryNext() {
  const images = [...document.getElementsByClassName('gallery-image')];
  const totalImages = images.length;
  const currentImage = images.filter(image => [...image.classList].includes('show'))[0];
  const currentIndex = Number(currentImage.id[currentImage.id.length - 1]);
  const nextIndex = currentIndex === totalImages - 1 ? 0 : currentIndex + 1;
  const nextImage = document.getElementById(`gallery-image-${nextIndex}`);
  fadeIn(nextImage);
  fadeOut(currentImage);
}

function updateGalleryPrevious() {
  const images = [...document.getElementsByClassName('gallery-image')];
  const totalImages = images.length;
  const currentImage = images.filter(image => [...image.classList].includes('show'))[0];
  const currentIndex = Number(currentImage.id[currentImage.id.length - 1]);
  const nextIndex = currentIndex === 0 ? totalImages - 1 : currentIndex - 1;
  const nextImage = document.getElementById(`gallery-image-${nextIndex}`);
  fadeIn(nextImage);
  fadeOut(currentImage);
}

const section = document.querySelectorAll('section')[0];
let html =  section.innerHTML
let regex = new RegExp('<p>\\[','gi');

// create shortcodes array
let shortcodes = new Array();
let substring, element, type, background;
while (regex.exec(html)) {
  substring = html.substring(regex.lastIndex - 1);
	element = substring.substring(0, substring.indexOf('</p>'));
  let raw = substring.replace(element, '');
  const sectionIndex = raw.indexOf('section');
  raw = sectionIndex > 0 ? raw.substring(4, sectionIndex - 4) : raw.substring(4);

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
		name: type,
		code: element,
		raw: raw.length > 5 ? raw : null
  });
}

// edit the page
if (shortcodes.length > 0) {
	console.log(':: SHORTCODE SECTIONS ::');
  console.log(shortcodes);

  let insert, element;
  for (let i = 0; i < shortcodes.length; i++) {
		additional_tag = i > 0 ? '</div>' : '';

		if (shortcodes[i].name) {
			additional_tag = additional_tag + `<a id="${shortcodes[i].name}"></a>`;
		}
		
		switch (shortcodes[i].type) {
			case 'Hero':
        const image_raw = document.getElementById('featured-image').innerHTML;
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
      
      case 'Gallery':
        let div = document.createElement('div');
        let imagesHTML = html.substring(html.indexOf('Gallery') + 17, html.indexOf('</ul>') + 5);
        div.innerHTML = imagesHTML;
        const imageArray = [...div.getElementsByTagName('img')];
        const images = imageArray.map(image => image.src);
        insert = `${additional_tag}`;
        html = html.replace(imagesHTML, '');
        div = document.createElement('div');
        const imagesArray = images.map((image, index) => {
          return `<img class="gallery-image ${[index === 0 ? 'show' : 'hide']}" id="gallery-image-${index}" src="${image}">`
        });
        div.innerHTML = `
          <div class="hero-image-gallery">
          <div class="left" id="left-arrow" onclick="updateGalleryPrevious()">&#10094;</div>
          <div class="right" id="left-arrow" onclick="updateGalleryNext()">&#10095;</div>
          ${imagesArray.join('')}
          </div>
        `;
        insert = `${additional_tag}<div>${div.innerHTML}</div>`;
      break;

      case 'News':
        let newsDiv = document.createElement('div');
        let newsHeader = document.getElementsByClassName('news-header')[0];
        newsDiv.appendChild(newsHeader);
        let newsContainer = document.getElementById('News-Container');
        newsDiv.appendChild(newsContainer);
        insert = `${additional_tag}<div class="News">${newsDiv.innerHTML}</div>`;
        newsHeader = document.getElementsByClassName('news-header');
        setTimeout(() => {
          newsHeader = document.getElementsByClassName('news-header');
          newsHeader[1].parentNode.removeChild(newsHeader[1]);
        }, 200);
      break;


			case 'Standard-Footer':
			  insert = `${additional_tag}<div class="${shortcodes[i].type}">FOOTER`;

			default:
			  insert = `${additional_tag}<div class="${shortcodes[i].type}">`;
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

document.querySelectorAll('.Events h6').forEach((selector, index) => {
	selector.addEventListener('click', () => {
		let element = document.querySelector(`.event-id-${index + 1}`);
		if (element.classList.contains('hide')) {
			element.classList.add('show');
			element.classList.remove('hide');
		} else {
			element.classList.add('hide');
			element.classList.remove('show');
		}
	});
});

document.querySelectorAll('.Interview h4').forEach((selector, index) => {
	selector.addEventListener('click', () => {
		let element = document.querySelector(`.interview-id-${index + 1}`);
		if (element.classList.contains('hide')) {
			element.classList.add('show');
			element.classList.remove('hide');
		} else {
			element.classList.add('hide');
			element.classList.remove('show');
		}
	});
});