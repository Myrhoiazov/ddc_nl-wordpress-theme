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
    saveSettings: () => {
        monster.classList.remove('is-show');
        const analytical = monster.querySelector('#analytical'),
              personalization = monster.querySelector('#personalization'),
              marketing = monster.querySelector('#marketing');
        
        localStorage.setItem('analytics_storage', analytical.checked ? 'granted' : 'denied');
        localStorage.setItem('personalization_storage', personalization.checked ? 'granted' : 'denied');
        localStorage.setItem('ad_storage', marketing.checked ? 'granted' : 'denied');

        gtag('consent', 'update', {
            'analytics_storage': (analytical.checked ? 'granted' : 'denied'),
            'personalization_storage': (personalization.checked ? 'granted' : 'denied'),
            'ad_storage': (marketing.checked ? 'granted' : 'denied'),
            'ad_user_data': (marketing.checked ? 'granted' : 'denied'),
            'ad_personalization': (marketing.checked ? 'granted' : 'denied'),
        });

        dataLayer.push({ 'event': 'cookie_consent_update' });

        if (analytical.checked) {
            dataLayer.push({ 'event': 'cookie_consent_statistics' });
        }

        if (marketing.checked) {
            dataLayer.push({ 'event': 'cookie_consent_marketing' });
        }

        if (personalization.checked) {
            dataLayer.push({ 'event': 'cookie_consent_preferences' });
        }
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

