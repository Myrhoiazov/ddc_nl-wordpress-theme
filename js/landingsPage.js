const Landing = {
    init: () => {
        Landing.loadFlipDown();
    },
    loadFlipDown: () => {
        var startDateTime = new Date('2026-05-15 10:30:00').getTime() / 1000;

        // Set up FlipDown
        var flipdown = new FlipDown(startDateTime)
            // Start the countdown
            .start()
            // Do something when the countdown ends
            .ifEnded(() => {
                console.log('The countdown has ended!');
            });
    },
    loadMagickMouse: () => {}
}


if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", Landing.init);
} else {
  Landing.init();
}
