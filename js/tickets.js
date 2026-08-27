function loadEventix() {
	const script = document.createElement('script');
	script.src = 'https://shop.eventix.io/build/integrate.js';
	document.body.appendChild(script);
}

if (document.readyState === 'loading') {
	// Loading hasn't finished yet
	document.addEventListener('DOMContentLoaded', () => {
		loadEventix();
	});
} else {
	// `DOMContentLoaded` has already fired
	loadEventix();
}
