var shuffleInstance;
var Videos = {
    init: () => {
        const Shuffle = window.Shuffle; // Assumes you're using the UMD version of Shuffle (for example, from unpkg.com).
        const element = document.querySelector('.video-row');
        const sizer = element.querySelector('.js-shuffle-sizer');

        shuffleInstance = new Shuffle(element, {
            itemSelector: '.video',
            sizer: sizer, // could also be a selector: '.js-shuffle-sizer'
        });
    },
    filter: (name) => {
        if (name == 'all') {
            shuffleInstance.filter(Shuffle.ALL_ITEMS);
        } else {
            shuffleInstance.filter(name);
        }
    }
};

window.addEventListener('load', Videos.init);