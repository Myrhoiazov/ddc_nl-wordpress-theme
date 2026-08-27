let byId = (name) => {
    return document.getElementById(name);
}
const monster = byId('cookie_monster');

const CookieMonster = {
    init: () => {
        const show = localStorage.getItem('show_cookiebar');

        if (show !== 'false') {
            monster.classList.add('is-show');
            CookieMonster.addTabListeners();
        }
    },
    addTabListeners: () => {
        const tabContent = monster.querySelector('.pop-up-tabs');
        console.log(tabContent);
        
        let tabs = tabContent.querySelectorAll('.tab');

        if (tabs) {
            for (let i = 0; i < tabs.length; i++) {
                const tab = tabs[i];

                tab.addEventListener('click', CookieMonster._clickTab);
            }
        }
    },
    _clickTab: (e) => {
        const tab = e.target;
        const active = tab.parentElement.querySelector('.active');

        active.classList.remove('active');
        tab.classList.add('active');
        console.log('click');

        CookieMonster._switchTabContent(tab.dataset.tab);
        
    },
    _switchTabContent: (tab) => {
        const contentWrap = monster.querySelector('.pop-up-tabs-content');
        const contentItems = contentWrap.children;

        console.log(contentItems);

        for (let i = 0; i < contentItems.length; i++) {
            const content = contentItems[i];
            content.classList.remove('active');
        }
        contentItems[parseInt(tab)].classList.add('active');
    },
    denyAll: () => {
        monster.classList.remove('is-show');
        CookieMonster._denyAll();
    },
    grantAll: () => {
        monster.classList.remove('is-show');
        CookieMonster._grantAll();
    },
    customize: () => {
        const optionOverlay = monster.querySelector('.pop-up-option');
        optionOverlay.classList.remove('is-hidden');
    },
    _denyAll: () => {
        localStorage.setItem('ad_storage', 'denied');
        localStorage.setItem('analytics_storage', 'denied');
        localStorage.setItem('personalization_storage', 'denied');
    },
    _grantAll: () => {
        localStorage.setItem('ad_storage', 'granted');
        localStorage.setItem('analytics_storage', 'granted');
        localStorage.setItem('personalization_storage', 'granted');

        dataLayer.push({ 'event': 'cookie_consent_update' });
        dataLayer.push({ 'event': 'cookie_consent_statistics' });
        dataLayer.push({ 'event': 'cookie_consent_marketing' });
        dataLayer.push({ 'event': 'cookie_consent_preferences' });

        gtag('consent', 'update', {
            'ad_user_data': 'granted',
            'ad_personalization': 'granted',
            'ad_storage': 'granted',
            'analytics_storage': 'granted',
            'personalization_storage': 'granted'
        });
    },
    _getCookie: (name) => {
        let value = `; ${document.cookie}`,
            parts = value.split('; ' + name + '=');

        if (parts.length === 2) return parts.pop().split(';').shift();

        return null;
    }
}

CookieMonster.init();

// const cookiePopup = () => {
//     const cookiebar = document.getElementById('cookiebanner');
//     if (cookiebar == null) return;
//     var $show = window.show_cookie_bar;
//     if ($show) {
//         cookiebar.classList.add('active');
//         const cookieAkkoord = document.getElementById('cookie-akkoord');
//         const cookieSettings = document.getElementById('cookie-settings');
//         const cookieNietAkkoord = document.getElementById('cookie-niet-akkoord');
//         const saveSettingsBtn = document.getElementById('cookie-instellingen-opslaan');
//         cookieAkkoord.addEventListener('click', () => {
//             cookiebar.classList.remove('active');
//             grandAllCookies();
//             Header.cookieToestemmingScript();
//         });
//         saveSettingsBtn.addEventListener('click', () => {
//             // Get checkboxes
//             const checkPers = document.getElementById('personalization_storage');
//             const checkAnal = document.getElementById('analytics_storage');
//             const checkAd = document.getElementById('ad_storage');
//             // Store new settings
//             window.localStorage.setItem('ad_storage', checkAd.checked ? 'granted' : 'denied');
//             window.localStorage.setItem('personalization_storage', checkPers.checked ? 'granted' : 'denied');
//             window.localStorage.setItem('analytics_storage', checkAnal.checked ? 'granted' : 'denied');
//             // Hide cookie bar
//             cookiebar.classList.remove('active');
//             // Get stored settings
//             const ad_storage = window.localStorage.getItem('ad_storage');
//             const personalization_storage = window.localStorage.getItem('personalization_storage');
//             const analytics_storage = window.localStorage.getItem('analytics_storage');
//             // And update consent
//             gtag('consent', 'update', {
//                 'ad_storage': (ad_storage ? ad_storage : 'denied'),
//                 'ad_user_data': (ad_storage ? ad_storage : 'denied'),
//                 'ad_personalization': (ad_storage ? ad_storage : 'denied'),
//                 'analytics_storage': (analytics_storage ? analytics_storage : 'denied'),
//                 'personalization_storage': (personalization_storage ? personalization_storage : 'denied'),
//             });
//             dataLayer.push({ 'event': 'cookie_consent_update' });
//             if (ad_storage === 'granted') {
//                 dataLayer.push({ 'event': 'cookie_consent_marketing' });
//             }
//             if (personalization_storage === 'granted') {
//                 dataLayer.push({ 'event': 'cookie_consent_preferences' });
//             }
//             if (analytics_storage === 'granted') {
//                 dataLayer.push({ 'event': 'cookie_consent_statistics' });
//             }
//         });
//         cookieSettings.addEventListener('click', () => {
//             const settings = document.querySelector('.settings-box');
//             if (settings.classList.contains('show')) {
//                 settings.classList.remove('show');
//                 saveSettingsBtn.style.display = 'none';
//                 cookieAkkoord.style.display = 'inline-block';
//             } else {
//                 settings.classList.add('show');
//                 saveSettingsBtn.style.display = 'inline-block';
//                 cookieAkkoord.style.display = 'none';
//             }
//         });
//         cookieNietAkkoord.addEventListener('click', () => {
//             denyAllCookies();
//             cookiebar.classList.remove('active');
//         });
//     }
// };