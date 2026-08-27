document.addEventListener('DOMContentLoaded', () => {

    // Unix timestamp (in seconds) to count down to
    var startDateTime = (new Date('2025-05-16 09:00:00').getTime() / 1000);

    // Set up FlipDown
    var flipdown = new FlipDown(startDateTime)
        // Start the countdown
        .start()
        // Do something when the countdown ends
        .ifEnded(() => {
            console.log('The countdown has ended!');
        });


});

var options = {
    "hoverEffect": "circle-move",
    "hoverItemMove": false,
    "defaultCursor": false,
    "outerWidth": 33,
    "outerHeight": 33
};
jQuery(function ($) {
    if (typeof magicMouse !== 'undefined') {
        magicMouse(options);
    }


});
const mainEl = document.getElementById('main');

function isInViewport(element, callback, leaveCallback) {
    var rect = element.getBoundingClientRect();
    var html = document.documentElement;
    var windowH = html.clientHeight;
    var scrolled = mainEl.scrollTop;
    var inViewLine = scrolled + windowH;
    var trashHold = 400;
    var comp1 = (rect.top + trashHold) - windowH;
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


const choreographer = document.getElementById('choreographer');
const choreographers = choreographer.querySelectorAll('.choreographer');
const highlight = document.getElementById('highlights');
const highlights = highlight.querySelectorAll('.highlight');
const winners = document.getElementById('competition');
const winner = winners.querySelectorAll('.winner');
const team = document.getElementById('team');
const members = team.querySelectorAll('.team');
const team2 = document.getElementById('team2');
const members2 = team2.querySelectorAll('.team');
const partners = document.getElementById('partners');
const partner = partners.querySelectorAll('.logo-img');

mainEl.addEventListener('scroll', () =>{
    isInViewport(choreographer, () => {
        for (let i = 0; i < choreographers.length; i++) {
            const item = choreographers[i];
            item.classList.add('in-view');
        }
    }, () => {
        for (let i = 0; i < choreographers.length; i++) {
            const item = choreographers[i];
            item.classList.remove('in-view');
        }
    });
    isInViewport(highlight, () => {
        for (let i = 0; i < highlights.length; i++) {
            const item = highlights[i];
            item.classList.add('in-view');
        }
    }, () => {
        for (let i = 0; i < highlights.length; i++) {
            const item = highlights[i];
            item.classList.remove('in-view');
        }
    });
    isInViewport(winners, () => {
        for (let i = 0; i < winner.length; i++) {
            const item = winner[i];
            item.classList.add('in-view');
        }
    }, () => {
        for (let i = 0; i < winner.length; i++) {
            const item = winner[i];
            item.classList.remove('in-view');
        }
    });
    isInViewport(team, () => {
        for (let i = 0; i < members.length; i++) {
            const item = members[i];
            item.classList.add('in-view');
        }
    }, () => {
        for (let i = 0; i < members.length; i++) {
            const item = members[i];
            item.classList.remove('in-view');
        }
    });
    isInViewport(team2, () => {
        for (let i = 0; i < members2.length; i++) {
            const item = members2[i];
            item.classList.add('in-view');
        }
    }, () => {
        for (let i = 0; i < members2.length; i++) {
            const item = members2[i];
            item.classList.remove('in-view');
        }
    });
    isInViewport(partners, () => {
        for (let i = 0; i < partner.length; i++) {
            const item = partner[i];
            item.classList.add('in-view');
        }
    }, () => {
        for (let i = 0; i < partner.length; i++) {
            const item = partner[i];
            item.classList.remove('in-view');
        }
    });
});

