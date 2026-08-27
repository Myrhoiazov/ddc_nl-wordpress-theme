<div id="cookie_monster" class="">
    <div class="pop-up">
        <div class="pop-up-option is-hidden">
            <div class="pop-up-title mb-3">
                Settings
            </div>
            <div class="row">
                <div class="col-lg-6 mb-2 mb-lg-4 d-grid">
                    <input type="checkbox" class="btn-check" id="necessary" autocomplete="off" checked>
                    <label class="btn disabled" for="necessary">
                        Necessary cookies
                    </label>
                </div>
                <div class="col-lg-6 mb-2 mb-lg-4 d-grid">
                    <input type="checkbox" class="btn-check" id="analytical" autocomplete="off" checked>
                    <label class="btn" for="analytical">
                        Analytical cookies
                    </label>
                </div>
                <div class="col-lg-6 mb-2 mb-lg-4 d-grid">
                    <input type="checkbox" class="btn-check" id="personalization" autocomplete="off" checked>
                    <label class="btn" for="personalization">
                        personalization cookies
                    </label>
                </div>
                <div class="col-lg-6 mb-2 mb-lg-4 d-grid">
                    <input type="checkbox" class="btn-check" id="marketing" autocomplete="off" checked>
                    <label class="btn" for="marketing">
                        Marketing cookies
                    </label>
                </div>
                <div class="col-lg-6 offset-lg-6 d-grid">
                    <button class="btn btn-primary" onclick="CookieMonster.saveSettings();">
                        Save & exit
                    </button>
                </div>
            </div>
        </div>
        <div class="pop-up-tabs justify-content-between">
            <div class="tab active" data-tab="0">
                Consent
            </div>
            <div class="tab" data-tab="1">
                About
            </div>
        </div>
        <div class="pop-up-tabs-content">
            <div class="tab-content active">
                <div class="pop-up-title">
                    We use cookies
                </div>
                <p class="mb-0">
                    We use cookies to personalise content and ads, to provide social media features and to analyse our traffic. We also share information about your use of our site with our social media, advertising and analytics partners who may combine it with other information that you’ve provided to them or that they’ve collected from your use of their services.
                </p>
            </div>
            <div class="tab-content">
                <p>
                    Cookies are small pieces of data stored on a user's device by a web browser. Websites use cookies for several reasons:
                </p>
                <ol>
                    <li>
                        <b>User Authentication</b>: Cookies help remember users who have logged in, keeping them signed in as they navigate between pages.
                    </li>
                    <li>
                        <b>Personalization</b>: They allow websites to remember user preferences, such as language settings or themes, creating a more tailored experience.
                    </li>
                    <li>
                        <b>Session Management</b>: Cookies manage user sessions, helping maintain the state of a user's interactions (like items in a shopping cart) as they browse.
                    </li>
                    <li>
                        <b>Analytics</b>: Cookies track user behavior, allowing website owners to analyze traffic and understand how visitors interact with their site, which helps improve usability.
                    </li>
                    <li>
                        <b>Advertising</b>: Cookies help deliver targeted ads based on user behavior and preferences, which can enhance ad effectiveness.
                    </li>
                    <li>
                        <b>Performance</b>: Some cookies improve the performance of a website by storing information that can be quickly accessed, reducing load times.
                    </li>
                </ol>

                <p>
                    Overall, while cookies enhance user experience and site functionality, users often have control over cookie settings and can choose to accept or reject them.
                </p>
            </div>
        </div>
        <div class="pop-up-btns">
            <div onclick="CookieMonster.grantAll();">
                Allow all
            </div>
            <div onclick="CookieMonster.denyAll();">
                Deny
            </div>
            <div onclick="CookieMonster.customize();">
                Customize
            </div>
        </div>
    </div>
</div>