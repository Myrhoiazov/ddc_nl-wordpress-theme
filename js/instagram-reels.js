/**
 * Instagram Reels interaction controller.
 *
 * State machine per card: IDLE -> (first click) PLAYING -> (second
 * click on the same card) OPEN_INSTAGRAM. Clicking a different card
 * while one is playing pauses the old one and plays the new one
 * instead of opening Instagram.
 *
 * Drag vs. click: Swiper's own 'click' event turned out to not fire
 * reliably for every genuine tap (verified in-browser — a plain tap on
 * a slide could reach the native <a> without Swiper ever emitting
 * 'click', leaving nothing to preventDefault() the navigation). Native
 * click listeners on each card are used instead, guarded by Swiper's
 * `allowClick` flag — which Swiper itself flips to false right after a
 * drag/swipe release specifically so consumer code can ignore that
 * click — so a drag-release still never triggers play or navigation.
 */
class InstagramReels {
	constructor(root) {
		this.root = root;
		this.activeCard = null;
		this.activeVideo = null;

		this.init();
	}

	init() {
		this.swiper = typeof initHomeSwiper === 'function'
			? initHomeSwiper('.instagram-reels-swiper')
			: undefined;

		this.root.querySelectorAll('[data-instagram-reels-item]').forEach((card) => {
			card.addEventListener('click', (event) => this.handlePointerEvent(event));
		});
	}

	handlePointerEvent(event) {
		if (this.swiper && !this.swiper.allowClick) {
			// A drag/swipe just ended on this same release — Swiper set
			// allowClick=false for exactly this reason.
			return;
		}

		const card = event.target.closest('[data-instagram-reels-item]');
		if (!card || !this.root.contains(card)) {
			return;
		}

		event.preventDefault();

		const permalink = card.getAttribute('data-permalink') || card.getAttribute('href');

		if (card.classList.contains('is-playing')) {
			this.openInstagram(permalink);
			return;
		}

		// Any click on a card other than the one already playing
		// interrupts it — even when this card itself has no video and
		// goes straight to Instagram — so at most one video ever plays.
		this.pauseActive();

		const videoSrc = card.getAttribute('data-video-src');
		if (!videoSrc) {
			this.openInstagram(permalink);
			return;
		}

		this.play(card, videoSrc);
	}

	play(card, videoSrc) {
		const video = this.ensureVideo(card, videoSrc);
		const playResult = video.play();

		if (playResult && typeof playResult.catch === 'function') {
			playResult.catch(() => {
				// Playback refused (e.g. data-saver mode) — don't leave
				// a stuck, silent "playing" card; fall back to Instagram.
				this.reset(card);
				this.openInstagram(card.getAttribute('data-permalink') || card.getAttribute('href'));
			});
		}

		card.classList.add('is-playing');
		this.activeCard = card;
		this.activeVideo = video;
	}

	ensureVideo(card, videoSrc) {
		let video = card.querySelector('video');
		if (video) {
			return video;
		}

		video = document.createElement('video');
		video.className = 'instagram-reels__video';
		video.muted = true;
		video.playsInline = true;
		video.setAttribute('muted', '');
		video.setAttribute('playsinline', '');
		video.preload = 'metadata';

		const poster = card.querySelector('.instagram-reels__poster');
		if (poster) {
			video.poster = poster.getAttribute('src') || '';
		}

		video.src = videoSrc;

		video.addEventListener('error', () => {
			// A broken stream shouldn't keep offering "play" forever —
			// drop the video source so future clicks go straight to
			// Instagram instead of retrying a dead URL.
			card.removeAttribute('data-video-src');
			this.reset(card);
		}, { once: true });

		card.appendChild(video);

		return video;
	}

	pauseActive() {
		if (this.activeVideo) {
			this.activeVideo.pause();
		}
		if (this.activeCard) {
			this.activeCard.classList.remove('is-playing');
		}
		this.activeCard = null;
		this.activeVideo = null;
	}

	reset(card) {
		card.classList.remove('is-playing');

		const video = card.querySelector('video');
		if (video) {
			video.remove();
		}

		if (this.activeCard === card) {
			this.activeCard = null;
			this.activeVideo = null;
		}
	}

	openInstagram(permalink) {
		if (!permalink) {
			return;
		}
		window.open(permalink, '_blank', 'noopener,noreferrer');
	}
}

document.querySelectorAll('[data-instagram-reels]').forEach((root) => new InstagramReels(root));
