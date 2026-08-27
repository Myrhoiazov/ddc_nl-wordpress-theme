const mainEl = document.getElementById('main');

function isInViewport(element, callback, leaveCallback) {
	var rect = element.getBoundingClientRect();
	var html = document.documentElement;
	var windowH = html.clientHeight;
	var scrolled = mainEl.scrollTop;
	var inViewLine = scrolled + windowH;
	var trashHold = 400;
	var comp1 = rect.top + trashHold - windowH;
	var comp2 = rect.bottom - trashHold;

	// Scroll top handle
	if (comp1 < 0 && !element.classList.contains('in-view-top')) {
		element.classList.add('in-view-top');
		element.classList.add('in-view-bottom');
		callback();
	} else if (comp1 > 0 && element.classList.contains('in-view-top')) {
		element.classList.remove('in-view-top');
		element.classList.remove('in-view-bottom');
		leaveCallback();
	}

	// scroll down handle

	if (comp2 < 0 && !element.classList.contains('out-view-bottom')) {
		element.classList.add('out-view-bottom');
		leaveCallback();
	} else if (comp2 > 0 && element.classList.contains('out-view-bottom')) {
		element.classList.remove('out-view-bottom');
		callback();
	}
}

const loadLightboxOnPlugin = () => {
	const images = document.querySelectorAll('.ftg-lightbox');
	if (images) {
		for (let i = 0; i < images.length; i++) {
			const image = images[i];

			image.setAttribute('data-fslightbox', 'gallery');
		}
	}

	refreshFsLightbox();
};

var loadedEventix = false;

const intro = document.getElementById('intro');
const introItems = intro ? intro.querySelectorAll('.effect') : [];
const earlybird = document.getElementById('earlybird');
const earlybirdHeading = earlybird ? earlybird.querySelector('.bird-txt') : null;
const choreographer = document.getElementById('choreographer');
const choreographers = choreographer ? choreographer.querySelectorAll('.choreographer') : [];
const highlight = document.getElementById('highlights');
const highlights = highlight ? highlight.querySelectorAll('.highlight') : [];
const editions = document.getElementById('previous_editions');
const editionItems = editions ? editions.querySelectorAll('.effect') : [];
const partners = document.getElementById('partners');
const partner = partners ? partners.querySelectorAll('.logo-img') : [];
const nextEvent = document.getElementById('next_edition');
const nextItems = nextEvent ? nextEvent.querySelectorAll('.effect') : [];
const ddc_nl_social = document.getElementById('ddc_nl_social');
const ddc_nl_socialItems = ddc_nl_social ? ddc_nl_social.querySelectorAll('.effect') : [];
const thanks = document.getElementById('special_thanks');
const thanksItems = thanks ? thanks.querySelectorAll('.effect') : [];

function preloadImages(section) {
	const $section = document.getElementById(section);
	if (!$section || !$section.classList.contains('images-loaded')) {
		if (!$section) return;
		const images = $section.getElementsByTagName('img');
		if (images) {
			for (let i = 0; i < images.length; i++) {
				const image = images[i];

				const loadImg = new Image();

				console.log('loading: ' + image.src);

				loadImg.src = image.src;
			}
		}
		$section.classList.add('images-loaded');
	}
}

const showCoockie = localStorage.getItem('show_cookiebar');

mainEl.addEventListener('scroll', () => {
	if (intro) {
		isInViewport(
			intro,
			() => {
				if (showCoockie === 'false') {
					for (let i = 0; i < introItems.length; i++) {
						const item = introItems[i];
						item.classList.add(
							'in-view',
							'animate__animated',
							'animate__slideInLeft'
						);
					}
				}
			},
			() => {
				for (let i = 0; i < introItems.length; i++) {
					const item = introItems[i];
					item.classList.remove(
						'in-view',
						'animate__animated',
						'animate__slideInLeft'
					);
				}
			}
		);
	}
	if (earlybird) {
		isInViewport(
			earlybird,
			() => {
				earlybird.classList.add('is-gold');
				if (earlybirdHeading) earlybirdHeading.classList.add('is-gold');
			},
			() => {
				earlybird.classList.remove('is-gold');
				if (earlybirdHeading) earlybirdHeading.classList.remove('is-gold');
			}
		);
	}
	if (ddc_nl_social) {
		isInViewport(
			ddc_nl_social,
			() => {
				for (let i = 0; i < ddc_nl_socialItems.length; i++) {
					const item = ddc_nl_socialItems[i];
					item.classList.add(
						'in-view',
						'animate__animated',
						'animate__fadeInDown'
					);
				}
			},
			() => {
				for (let i = 0; i < ddc_nl_socialItems.length; i++) {
					const item = ddc_nl_socialItems[i];
					item.classList.remove(
						'in-view',
						'animate__animated',
						'animate__fadeInDown'
					);
				}
			}
		);
	}
	if (nextEvent) {
		isInViewport(
			nextEvent,
			() => {
				preloadImages('previous_editions');
				for (let i = 0; i < nextItems.length; i++) {
					const item = nextItems[i];
					item.classList.add(
						'in-view',
						'animate__animated',
						'animate__fadeInDown'
					);
				}
			},
			() => {
				for (let i = 0; i < nextItems.length; i++) {
					const item = nextItems[i];
					item.classList.remove(
						'in-view',
						'animate__animated',
						'animate__fadeInDown'
					);
				}
			}
		);
	}
	if (editions) {
		isInViewport(
			editions,
			() => {
				preloadImages('choreographer');
				for (let i = 0; i < editionItems.length; i++) {
					const item = editionItems[i];
					item.classList.add(
						'in-view',
						'animate__animated',
						'animate__fadeInDown'
					);
				}
			},
			() => {
				for (let i = 0; i < editionItems.length; i++) {
					const item = editionItems[i];
					item.classList.remove(
						'in-view',
						'animate__animated',
						'animate__fadeInDown'
					);
				}
			}
		);
	}
	if (choreographer) {
		isInViewport(
			choreographer,
			() => {
				preloadImages('highlights');
				for (let i = 0; i < choreographers.length; i++) {
					const item = choreographers[i];
					item.classList.add(
						'in-view',
						'animate__animated',
						'animate__slideInLeft'
					);
				}
			},
			() => {
				for (let i = 0; i < choreographers.length; i++) {
					const item = choreographers[i];
					item.classList.remove(
						'in-view',
						'animate__animated',
						'animate__slideInLeft'
					);
				}
			}
		);
	}
	if (highlight) {
		isInViewport(
			highlight,
			() => {
				preloadImages('partners');
				for (let i = 0; i < highlights.length; i++) {
					const item = highlights[i];
					item.classList.add(
						'in-view',
						'animate__animated',
						'animate__fadeInDown'
					);
				}
			},
			() => {
				for (let i = 0; i < highlights.length; i++) {
					const item = highlights[i];
					item.classList.remove(
						'in-view',
						'animate__animated',
						'animate__fadeInDown'
					);
				}
			}
		);
	}
	if (partners) {
		isInViewport(
			partners,
			() => {
				for (let i = 0; i < partner.length; i++) {
					const item = partner[i];
					item.classList.add(
						'in-view',
						'animate__animated',
						'animate__fadeInDown'
					);
				}
			},
			() => {
				for (let i = 0; i < partner.length; i++) {
					const item = partner[i];
					item.classList.remove(
						'in-view',
						'animate__animated',
						'animate__fadeInDown'
					);
				}
			}
		);
	}
	if (thanks) {
		isInViewport(
			thanks,
			() => {
				for (let i = 0; i < thanksItems.length; i++) {
					const item = thanksItems[i];
					item.classList.add(
						'in-view',
						'animate__animated',
						'animate__fadeInDown'
					);
				}
			},
			() => {
				for (let i = 0; i < thanksItems.length; i++) {
					const item = thanksItems[i];
					item.classList.remove(
						'in-view',
						'animate__animated',
						'animate__fadeInDown'
					);
				}
			}
		);
	}
});

window.addEventListener('load', () => {
	$(main).animate(
		{
			scrollTop: 1,
		},
		10,
		'swing'
	);
});

const openEarlyBird = () => {
	const section = document.getElementById('earlybird');
	const main = document.getElementById('main');
	if (!section || !main) return;
	section.classList.add('is-show');
	setTimeout(() => {
		$(main).animate(
			{
				scrollTop: section.offsetTop,
			},
			900,
			'swing'
		);
	}, 100);
};
