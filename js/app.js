let timeout;
const disableMagicMouseEffect = () => {
	const cursor = document.getElementById('magicMouseCursor');
	const pointer = document.getElementById('magicPointer');

	if (cursor) {
		cursor.remove();
	}
	if (pointer) {
		pointer.remove();
	}

	if (document.body && document.body.style.cursor === 'none') {
		document.body.style.cursor = 'auto';
	}
};

disableMagicMouseEffect();
document.addEventListener('DOMContentLoaded', disableMagicMouseEffect);
window.addEventListener('load', disableMagicMouseEffect);

const menuBtn = document.getElementById('menu_btn');
const main = document.getElementById('main');
const menu = document.querySelector('.main-menu');
const siteHeader = document.querySelector('.site-header');
const desktopSubmenuItems = document.querySelectorAll('.site-header__item.has-submenu');

const updateHeaderScrollState = () => {
	if (!siteHeader || !main) {
		return;
	}

	siteHeader.classList.toggle('is-scrolled', main.scrollTop > 12);
};

const closeDesktopSubmenus = (exceptItem = null) => {
	desktopSubmenuItems.forEach((item) => {
		if (item === exceptItem) {
			return;
		}

		item.classList.remove('is-open');
		const toggle = item.querySelector('.site-header__submenu-toggle');
		if (toggle) {
			toggle.setAttribute('aria-expanded', 'false');
		}
	});
};

desktopSubmenuItems.forEach((item) => {
	const toggle = item.querySelector('.site-header__submenu-toggle');
	if (!toggle) {
		return;
	}

	toggle.addEventListener('click', () => {
		const willOpen = !item.classList.contains('is-open');
		closeDesktopSubmenus(item);
		item.classList.toggle('is-open', willOpen);
		toggle.setAttribute('aria-expanded', String(willOpen));
	});
});

document.addEventListener('click', (event) => {
	if (!event.target.closest('.site-header__item.has-submenu')) {
		closeDesktopSubmenus();
	}
});

document.addEventListener('keydown', (event) => {
	if (event.key === 'Escape') {
		closeDesktopSubmenus();
	}
});

// Forward #main scroll events to window so any window-based scroll listeners keep working
if (main) {
	main.addEventListener('scroll', () => {
		window.dispatchEvent(new Event('scroll'));
		updateHeaderScrollState();
	}, { passive: true });

	updateHeaderScrollState();
}

if (main && menuBtn && menu) {
	main.addEventListener('scroll', () => {
		// Кнопка меню всегда остаётся видимой при скролле
	});

	menuBtn.addEventListener('click', () => {
		if (menu.classList.contains('is-show')) {
			menu.classList.remove('is-show');
			menuBtn.classList.remove('is-show');
			menuBtn.setAttribute('aria-expanded', 'false');
			menu.setAttribute('aria-hidden', 'true');
		} else {
			menu.classList.add('is-show');
			menuBtn.classList.add('is-show');
			menuBtn.setAttribute('aria-expanded', 'true');
			menu.setAttribute('aria-hidden', 'false');
		}
	});

	const mainMenuItems = menu.querySelectorAll('.nav-link');
	if (mainMenuItems.length) {
		for (let i = 0; i < mainMenuItems.length; i++) {
			const $menuItem = mainMenuItems[i];

			$menuItem.addEventListener('click', (e) => {
				if (e.target.classList.contains('submenu')) {
					e.preventDefault();

					const panelId = e.target.dataset.id;
					const panel = menu.querySelector('.panel-' + panelId);
					if (panel) {
						panel.classList.add('is-active');
					}
				}
			});
		}
	}

	const backBtns = menu.querySelectorAll('.back-btn');
	if (backBtns.length) {
		for (let i = 0; i < backBtns.length; i++) {
			const btn = backBtns[i];
			btn.addEventListener('click', (e) => {
				e.preventDefault();
				const openPanel = menu.querySelector('.sub-nav-panel.is-active');

				if (openPanel) {
					openPanel.classList.remove('is-active');
				}
			});
		}
	}
}

const loggedInActions = () => {
	const loggedInLinks = document.querySelectorAll(
		'.panel-community .link-logged-in',
	);
	const loggedOutLinks = document.querySelectorAll(
		'.panel-community .link-logged-out',
	);

	if (!loggedInLinks.length && !loggedOutLinks.length) {
		return;
	}

	if (typeof jQuery === 'undefined' || typeof data === 'undefined' || !data.url) {
		return;
	}

	jQuery
		.ajax({
			url: data.url + '/public/app.php',
			dataType: 'json',
			method: 'POST',
			data: {
				modus: 'is_logged_in',
			},
		})
		.done((data) => {
			if (data) {
				if (data.logged_in) {
					if (loggedInLinks) {
						for (let i = 0; i < loggedInLinks.length; i++) {
							const link = loggedInLinks[i];
							link.style.display = 'block';
						}
					}
					if (loggedOutLinks) {
						for (let i = 0; i < loggedOutLinks.length; i++) {
							const link = loggedOutLinks[i];
							link.style.display = 'none';
						}
					}
				}
			}
		})
		.always(() => {});
};

const vote = (e, user_id) => {
	const votingArea = e.target.parentElement.parentElement;

	if (
		user_id &&
		typeof jQuery !== 'undefined' &&
		typeof data !== 'undefined' &&
		data.url
	) {
		jQuery
			.ajax({
				url: data.url + '/public/app.php',
				dataType: 'json',
				method: 'POST',
				data: {
					modus: 'vote',
					user_id: user_id,
				},
			})
				.done((data) => {
					if (data) {
						if (data.exist) {
							const errorMsg = votingArea.querySelector('.failure');
							if (errorMsg) {
								errorMsg.style.display = 'inline-block';
							}
						} else {
							const successMsg = votingArea.querySelector('.success');
							if (successMsg) {
								successMsg.style.display = 'inline-block';
							}
						}
					}
				})
			.always(() => {});
	}
};

window.addEventListener('load', () => {
	if (document.querySelector('.panel-community')) {
		loggedInActions();
	}
});

const initAchievementsCounters = () => {
	const section = document.querySelector('.ddc-achievements');
	if (!section) {
		return;
	}

	const counters = section.querySelectorAll('.number[data-target]');
	if (!counters.length) {
		return;
	}

	const startCounters = () => {
		counters.forEach((counter) => {
			const target = Number(counter.dataset.target || 0);
			let count = 0;
			const speed = 60;

			const update = () => {
				const increment = target / speed;
				if (count < target) {
					count += increment;
					counter.innerText = Math.ceil(count);
					requestAnimationFrame(update);
				} else {
					counter.innerText = target;
				}
			};

			update();
		});
	};

	if (typeof IntersectionObserver === 'undefined') {
		startCounters();
		return;
	}

	let started = false;
	const observer = new IntersectionObserver(
		(entries) => {
			entries.forEach((entry) => {
				if (entry.isIntersecting && !started) {
					started = true;
					startCounters();
				}
			});
		},
		{ threshold: 0.2 },
	);

	observer.observe(section);
};

const initHomeSwiper = (selector) => {
	if (typeof Swiper === 'undefined' || !document.querySelector(selector)) {
		return;
	}

	new Swiper(selector, {
		slidesPerView: 1,
		spaceBetween: 20,
		loop: false,
		navigation: {
			nextEl: `${selector} .swiper-button-next`,
			prevEl: `${selector} .swiper-button-prev`,
		},
		breakpoints: {
			640: {
				slidesPerView: 2,
				spaceBetween: 20,
			},
			1024: {
				slidesPerView: 3,
				spaceBetween: 30,
			},
			1200: {
				slidesPerView: 4,
				spaceBetween: 30,
			},
		},
	});
};

const initHomeInteractions = () => {
	initAchievementsCounters();
	initHomeSwiper('.city-swiper');
	initHomeSwiper('.styles-swiper');
};

if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', initHomeInteractions);
} else {
	initHomeInteractions();
}

// Отправка данных формы в Telegram
document.addEventListener('wpcf7mailsent', function (event) {
	const values = getFormValues(event.detail.inputs);

	fetch('/wp-json/contact-form/tg', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify(values),
	}).catch(() => {});

	const modalEl = document.getElementById('contact_form');
	if (
		modalEl &&
		typeof bootstrap !== 'undefined' &&
		bootstrap.Modal
	) {
		const instance =
			bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);

		instance.hide();
	}

	if (typeof Swal !== 'undefined' && Swal.fire) {
		Swal.fire({
			title: 'Готово! 🎉',
			text: 'Сообщение успешно отправлено. Мы скоро свяжемся с вами 😊',
			icon: 'success',
		});
	}
});

const getFormValues = (inputs) => {
	return inputs.reduce((acc, field) => {
		// Strip [] suffix from CF7 checkbox/radio names (e.g. "messenger-type[]" → "messenger-type")
		const name = field.name.replace(/\[\]$/, '');
		if (name in acc) {
			// Multiple values for same field — combine as comma-separated string
			acc[name] = acc[name] ? acc[name] + ', ' + field.value : field.value;
		} else {
			acc[name] = field.value;
		}
		return acc;
	}, {});
};
