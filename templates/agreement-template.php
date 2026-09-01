<?php

/**
 * Template name: Agreement
 *
 * Dance Class Agreement — fullscreen multilingual landing page.
 * Replaces the static PDF contract with a live web page.
 * Supports EN / NL / RU via data-lang attributes + JS.
 *
 * @package    WordPress
 * @subpackage Bootstrap 5.3.2
 * @autor      ddc_nl
 */

$BsWp = new BsWp;

// Meta description управляется через AIOSEO в wp-admin

add_action('wp_footer', function () {
    ?>
    <script>
    (function () {
        'use strict';

        // ── ДАННЫЕ ФИЛИАЛОВ / ГРУПП (Этап 1 — статика) ───────────
        // На Этапе 2 заменяется fetch() к CRM REST API.
        var branchData = {
            amsterdam: {
                name: 'Amsterdam',
                groups: [
                    { label_en: 'DDC NL · 1×/week',         label_nl: 'DDC NL · 1×/week',         label_ru: 'DDC NL · 1 р/нед',         label_uk: 'DDC NL · 1 р/тижд',              classes: 4, price: 80  },
                    { label_en: 'Kids 12+ · 2×/week',           label_nl: 'Kids 12+ · 2×/week',           label_ru: 'Дети 12+ · 2 р/нед',           label_uk: 'Діти 12+ · 2 р/тижд',            classes: 8, price: 100 },
                    { label_en: 'Kids 7–11 · 2×/week',          label_nl: 'Kids 7–11 · 2×/week',          label_ru: 'Дети 7–11 л. · 2 р/нед',       label_uk: 'Діти 7–11 р. · 2 р/тижд',        classes: 8, price: 100 }
                ]
            },
            rotterdam: {
                name: 'Rotterdam',
                groups: [
                    { label_en: 'DDC NL · 1×/week',         label_nl: 'DDC NL · 1×/week',         label_ru: 'DDC NL · 1 р/нед',         label_uk: 'DDC NL · 1 р/тижд',        classes: 4, price: 70 },
                    { label_en: 'Kids 5–7 · 1×/week',           label_nl: 'Kids 5–7 · 1×/week',           label_ru: 'Дети 5–7 л. · 1 р/нед',        label_uk: 'Діти 5–7 р. · 1 р/тижд',   classes: 4, price: 60 },
                    { label_en: 'Kids 8–13 · 1×/week',          label_nl: 'Kids 8–13 · 1×/week',          label_ru: 'Дети 8–13 л. · 1 р/нед',       label_uk: 'Діти 8–13 р. · 1 р/тижд',  classes: 4, price: 60 }
                ]
            },
            apeldoorn: {
                name: 'Apeldoorn',
                groups: [
                    { label_en: 'Kids 8–12 · 1×/week',          label_nl: 'Kids 8–12 · 1×/week',          label_ru: 'Дети 8–12 л. · 1 р/нед',       label_uk: 'Діти 8–12 р. · 1 р/тижд',  classes: 4, price: 50 }
                ]
            },
            arnhem: {
                name: 'Arnhem',
                groups: [
                    { label_en: 'DDC NL · 1×/week',         label_nl: 'DDC NL · 1×/week',         label_ru: 'DDC NL · 1 р/нед',         label_uk: 'DDC NL · 1 р/тижд',              classes: 4, price: 80 },
                    { label_en: 'DDC NL · Ivanna · 1×/week', label_nl: 'DDC NL · Ivanna · 1×/week', label_ru: 'DDC NL · Иванна · 1 р/нед', label_uk: 'DDC NL · Іванна · 1 р/тижд',      classes: 4, price: 80 },
                    { label_en: 'Kids 7–11 · Ivanna · 1×/week', label_nl: 'Kids 7–11 · Ivanna · 1×/week', label_ru: 'Дети 7–11 · Иванна · 1 р/нед', label_uk: 'Діти 7–11 · Іванна · 1 р/тижд', classes: 4, price: 60 }
                ]
            }
        };

        // ── КАЛЬКУЛЯТОР ───────────────────────────────────────────
        function updateGroups(lang) {
            var branchSel = document.getElementById('agr-branch-' + lang);
            var groupSel  = document.getElementById('agr-group-' + lang);
            var branchKey = branchSel.value;

            document.getElementById('agr-result-' + lang).classList.remove('is-visible');
            groupSel.innerHTML = '';

            if (!branchKey) {
                groupSel.disabled = true;
                groupSel.innerHTML = '<option>—</option>';
                return;
            }

            var data = branchData[branchKey];
            groupSel.disabled = false;
            groupSel.innerHTML = '<option value="">—</option>';

            data.groups.forEach(function (g, i) {
                var opt = document.createElement('option');
                opt.value = i;
                opt.textContent = g['label_' + lang] || g.label_en;
                groupSel.appendChild(opt);
            });
        }

        function updatePrice(lang) {
            var branchSel = document.getElementById('agr-branch-' + lang);
            var groupSel  = document.getElementById('agr-group-' + lang);
            var resultEl  = document.getElementById('agr-result-' + lang);
            var branchKey = branchSel.value;
            var groupIdx  = groupSel.value;

            if (!branchKey || groupIdx === '') {
                resultEl.classList.remove('is-visible');
                return;
            }

            var branch = branchData[branchKey];
            var group  = branch.groups[parseInt(groupIdx, 10)];

            document.getElementById('agr-res-branch-' + lang).textContent  = branch.name;
            document.getElementById('agr-res-group-' + lang).textContent   = group['label_' + lang] || group.label_en;
            document.getElementById('agr-res-classes-' + lang).textContent = group.classes;
            document.getElementById('agr-res-price-' + lang).textContent   = '€' + group.price;
            resultEl.classList.add('is-visible');
        }

        // ── ПЕРЕКЛЮЧЕНИЕ ЯЗЫКОВ ───────────────────────────────────
        var LANG_KEY = 'ddc_lang';

        function setLang(lang) {
            document.querySelectorAll('[data-lang]').forEach(function (el) {
                el.classList.remove('is-active');
                if (el.closest('.agr-anchor-nav')) el.style.display = 'none';
            });

            document.querySelectorAll('[data-lang="' + lang + '"]').forEach(function (el) {
                el.classList.add('is-active');
                if (el.closest('.agr-anchor-nav')) el.style.display = 'flex';
            });

            document.querySelectorAll('.agr-lang-btn').forEach(function (btn) {
                btn.classList.toggle('is-active', btn.dataset.lang === lang);
            });

            try { localStorage.setItem(LANG_KEY, lang); } catch (e) {}
        }

        // ── ИНИЦИАЛИЗАЦИЯ ─────────────────────────────────────────
        document.addEventListener('DOMContentLoaded', function () {
            var savedLang = 'ru';
            try { savedLang = localStorage.getItem(LANG_KEY) || 'ru'; } catch (e) {}
            setLang(savedLang);

            document.querySelectorAll('.agr-lang-btn').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    setLang(btn.dataset.lang);
                });
            });

            ['en', 'nl', 'ru', 'uk'].forEach(function (lang) {
                var branchSel = document.getElementById('agr-branch-' + lang);
                var groupSel  = document.getElementById('agr-group-' + lang);
                if (branchSel) branchSel.addEventListener('change', function () { updateGroups(lang); });
                if (groupSel)  groupSel.addEventListener('change',  function () { updatePrice(lang); });
            });

            document.querySelectorAll('.agr-anchor-nav a[href^="#"]').forEach(function (link) {
                link.addEventListener('click', function (e) {
                    var target = document.querySelector(link.getAttribute('href'));
                    if (target) {
                        e.preventDefault();
                        target.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });
        });

        window.agrSetLang = setLang;
    }());
    </script>
    <?php
});

$BsWp->get_template_parts([
    'parts/shared/html-header',
    'parts/shared/header',
]);
?>

<div class="agr-page">

    <?php /* ── HERO ─────────────────────────────────────────────── */ ?>
    <div class="agr-hero">

        <?php /* Переключатель языков */ ?>
        <div class="agr-lang">
            <button class="agr-lang-btn" data-lang="en" type="button">EN</button>
            <button class="agr-lang-btn" data-lang="nl" type="button">NL</button>
            <button class="agr-lang-btn is-active" data-lang="ru" type="button">RU</button>
            <button class="agr-lang-btn" data-lang="uk" type="button">UK</button>
        </div>

        <div data-lang="en">
            <div class="agr-hero-tag">Dance Class Agreement</div>
            <h1>Your agreement with <span>Talent Center DDC</span></h1>
            <p class="agr-hero-sub">Everything you need to know before signing — payment, attendance, cancellation, and your SEPA mandate explained simply.</p>
        </div>
        <div data-lang="nl">
            <div class="agr-hero-tag">Dansles Overeenkomst</div>
            <h1>Jouw overeenkomst met <span>Talent Center DDC</span></h1>
            <p class="agr-hero-sub">Alles wat je moet weten voor het ondertekenen — betaling, aanwezigheid, annulering en SEPA-machtiging eenvoudig uitgelegd.</p>
        </div>
        <div data-lang="ru" class="is-active">
            <div class="agr-hero-tag">Договор на занятия</div>
            <h1>Ваш договор с <span>Talent Center DDC</span></h1>
            <p class="agr-hero-sub">Всё, что нужно знать перед подписанием — оплата, посещаемость, отмена и SEPA-мандат простым языком.</p>
        </div>
        <div data-lang="uk">
            <div class="agr-hero-tag">Договір на танцювальні заняття</div>
            <h1>Ваш договір з <span>Talent Center DDC</span></h1>
            <p class="agr-hero-sub">Все, що потрібно знати перед підписанням — оплата, відвідуваність, скасування та SEPA-мандат простою мовою.</p>
        </div>
    </div>

    <?php /* ── ЯКОРНАЯ НАВИГАЦИЯ ───────────────────────────────── */ ?>
    <div class="agr-anchor-nav">
        <div data-lang="en">
            <a href="#agr-pricing">Pricing</a>
            <a href="#agr-payment">Payment &amp; Direct Debit</a>
            <a href="#agr-sepa">SEPA Mandate</a>
            <a href="#agr-attendance">Attendance</a>
            <a href="#agr-cancellation">Cancellation</a>
            <a href="#agr-company">Company Details</a>
            <a href="#agr-faq">FAQ</a>
        </div>
        <div data-lang="nl">
            <a href="#agr-pricing">Tarieven</a>
            <a href="#agr-payment">Betaling &amp; Incasso</a>
            <a href="#agr-sepa">SEPA-machtiging</a>
            <a href="#agr-attendance">Aanwezigheid</a>
            <a href="#agr-cancellation">Annulering</a>
            <a href="#agr-company">Bedrijfsgegevens</a>
            <a href="#agr-faq">FAQ</a>
        </div>
        <div data-lang="ru" class="is-active">
            <a href="#agr-pricing">Цены</a>
            <a href="#agr-payment">Оплата и списание</a>
            <a href="#agr-sepa">SEPA-мандат</a>
            <a href="#agr-attendance">Посещаемость</a>
            <a href="#agr-cancellation">Отмена</a>
            <a href="#agr-company">Реквизиты</a>
            <a href="#agr-faq">FAQ</a>
        </div>
        <div data-lang="uk">
            <a href="#agr-pricing">Ціни</a>
            <a href="#agr-payment">Оплата та списання</a>
            <a href="#agr-sepa">SEPA-мандат</a>
            <a href="#agr-attendance">Відвідуваність</a>
            <a href="#agr-cancellation">Скасування</a>
            <a href="#agr-company">Реквізити</a>
            <a href="#agr-faq">FAQ</a>
        </div>
    </div>

    <div class="agr-wrap">

        <?php /* ── ЦЕНЫ / КАЛЬКУЛЯТОР ──────────────────────────── */ ?>
        <div class="agr-section" id="agr-pricing">

            <div data-lang="en">
                <div class="agr-eyebrow">Pricing</div>
                <h2>Choose your branch &amp; group</h2>
                <p>Select your branch and group below to see the exact monthly fee. Prices vary by location, style, and number of classes per week.</p>
                <div class="agr-calc">
                    <h3>💶 Calculate your monthly fee</h3>
                    <div class="agr-calc-row">
                        <div class="agr-calc-field">
                            <label for="agr-branch-en">Branch</label>
                            <select id="agr-branch-en">
                                <option value="">— Select branch —</option>
                                <option value="amsterdam">Amsterdam</option>
                                <option value="rotterdam">Rotterdam</option>
                                <option value="apeldoorn">Apeldoorn</option>
                                <option value="arnhem">Arnhem</option>
                            </select>
                        </div>
                        <div class="agr-calc-field">
                            <label for="agr-group-en">Group</label>
                            <select id="agr-group-en" disabled>
                                <option value="">— Select branch first —</option>
                            </select>
                        </div>
                    </div>
                    <div class="agr-result" id="agr-result-en">
                        <div class="agr-result-row"><span class="agr-result-label">Branch</span><span class="agr-result-value" id="agr-res-branch-en">—</span></div>
                        <div class="agr-result-row"><span class="agr-result-label">Group</span><span class="agr-result-value" id="agr-res-group-en">—</span></div>
                        <div class="agr-result-row"><span class="agr-result-label">Classes per month</span><span class="agr-result-value" id="agr-res-classes-en">—</span></div>
                        <div class="agr-result-row"><span class="agr-result-label">Monthly fee (incl. VAT)</span><span class="agr-result-value is-total" id="agr-res-price-en">—</span></div>
                        <p class="agr-result-note">Payment is collected automatically on the 1st of each month via SEPA Direct Debit.</p>
                    </div>
                </div>
            </div>

            <div data-lang="nl">
                <div class="agr-eyebrow">Tarieven</div>
                <h2>Kies je vestiging &amp; groep</h2>
                <p>Selecteer hieronder je vestiging en groep om de exacte maandelijkse kosten te zien. Prijzen variëren per locatie, stijl en aantal lessen per week.</p>
                <div class="agr-calc">
                    <h3>💶 Bereken je maandelijkse bijdrage</h3>
                    <div class="agr-calc-row">
                        <div class="agr-calc-field">
                            <label for="agr-branch-nl">Vestiging</label>
                            <select id="agr-branch-nl">
                                <option value="">— Kies vestiging —</option>
                                <option value="amsterdam">Amsterdam</option>
                                <option value="rotterdam">Rotterdam</option>
                                <option value="apeldoorn">Apeldoorn</option>
                                <option value="arnhem">Arnhem</option>
                            </select>
                        </div>
                        <div class="agr-calc-field">
                            <label for="agr-group-nl">Groep</label>
                            <select id="agr-group-nl" disabled>
                                <option value="">— Kies eerst vestiging —</option>
                            </select>
                        </div>
                    </div>
                    <div class="agr-result" id="agr-result-nl">
                        <div class="agr-result-row"><span class="agr-result-label">Vestiging</span><span class="agr-result-value" id="agr-res-branch-nl">—</span></div>
                        <div class="agr-result-row"><span class="agr-result-label">Groep</span><span class="agr-result-value" id="agr-res-group-nl">—</span></div>
                        <div class="agr-result-row"><span class="agr-result-label">Lessen per maand</span><span class="agr-result-value" id="agr-res-classes-nl">—</span></div>
                        <div class="agr-result-row"><span class="agr-result-label">Maandelijks bedrag (incl. BTW)</span><span class="agr-result-value is-total" id="agr-res-price-nl">—</span></div>
                        <p class="agr-result-note">Betaling wordt automatisch geïncasseerd op de 1e van elke maand via SEPA-incasso.</p>
                    </div>
                </div>
            </div>

            <div data-lang="ru" class="is-active">
                <div class="agr-eyebrow">Цены</div>
                <h2>Выберите филиал и группу</h2>
                <p>Выберите ниже свой филиал и группу, чтобы узнать точную ежемесячную стоимость. Цены зависят от города, стиля и количества занятий в неделю.</p>
                <div class="agr-calc">
                    <h3>💶 Рассчитайте ежемесячную оплату</h3>
                    <div class="agr-calc-row">
                        <div class="agr-calc-field">
                            <label for="agr-branch-ru">Филиал</label>
                            <select id="agr-branch-ru">
                                <option value="">— Выберите филиал —</option>
                                <option value="amsterdam">Amsterdam</option>
                                <option value="rotterdam">Rotterdam</option>
                                <option value="apeldoorn">Apeldoorn</option>
                                <option value="arnhem">Arnhem</option>
                            </select>
                        </div>
                        <div class="agr-calc-field">
                            <label for="agr-group-ru">Группа</label>
                            <select id="agr-group-ru" disabled>
                                <option value="">— Сначала выберите филиал —</option>
                            </select>
                        </div>
                    </div>
                    <div class="agr-result" id="agr-result-ru">
                        <div class="agr-result-row"><span class="agr-result-label">Филиал</span><span class="agr-result-value" id="agr-res-branch-ru">—</span></div>
                        <div class="agr-result-row"><span class="agr-result-label">Группа</span><span class="agr-result-value" id="agr-res-group-ru">—</span></div>
                        <div class="agr-result-row"><span class="agr-result-label">Занятий в месяц</span><span class="agr-result-value" id="agr-res-classes-ru">—</span></div>
                        <div class="agr-result-row"><span class="agr-result-label">Ежемесячная оплата (вкл. НДС)</span><span class="agr-result-value is-total" id="agr-res-price-ru">—</span></div>
                        <p class="agr-result-note">Оплата автоматически списывается 1-го числа каждого месяца через SEPA Direct Debit.</p>
                    </div>
                </div>
            </div>

            <div data-lang="uk">
                <div class="agr-eyebrow">Ціни</div>
                <h2>Оберіть філію та групу</h2>
                <p>Оберіть нижче свою філію та групу, щоб дізнатися точну щомісячну вартість. Ціни залежать від міста, стилю та кількості занять на тиждень.</p>
                <div class="agr-calc">
                    <h3>💶 Розрахуйте щомісячну оплату</h3>
                    <div class="agr-calc-row">
                        <div class="agr-calc-field">
                            <label for="agr-branch-uk">Філія</label>
                            <select id="agr-branch-uk">
                                <option value="">— Оберіть філію —</option>
                                <option value="amsterdam">Amsterdam</option>
                                <option value="rotterdam">Rotterdam</option>
                                <option value="apeldoorn">Apeldoorn</option>
                                <option value="arnhem">Arnhem</option>
                            </select>
                        </div>
                        <div class="agr-calc-field">
                            <label for="agr-group-uk">Група</label>
                            <select id="agr-group-uk" disabled>
                                <option value="">— Спочатку оберіть філію —</option>
                            </select>
                        </div>
                    </div>
                    <div class="agr-result" id="agr-result-uk">
                        <div class="agr-result-row"><span class="agr-result-label">Філія</span><span class="agr-result-value" id="agr-res-branch-uk">—</span></div>
                        <div class="agr-result-row"><span class="agr-result-label">Група</span><span class="agr-result-value" id="agr-res-group-uk">—</span></div>
                        <div class="agr-result-row"><span class="agr-result-label">Занять на місяць</span><span class="agr-result-value" id="agr-res-classes-uk">—</span></div>
                        <div class="agr-result-row"><span class="agr-result-label">Щомісячна оплата (з ПДВ)</span><span class="agr-result-value is-total" id="agr-res-price-uk">—</span></div>
                        <p class="agr-result-note">Оплата автоматично списується 1-го числа кожного місяця через SEPA Direct Debit.</p>
                    </div>
                </div>
            </div>

        </div><!-- #agr-pricing -->

        <?php /* ── КАК РАБОТАЕТ ОПЛАТА ────────────────────────── */ ?>
        <div class="agr-section" id="agr-payment">

            <div data-lang="en">
                <div class="agr-eyebrow">Payment &amp; Direct Debit</div>
                <h2>How payments work</h2>
                <p>Payments are collected automatically each month via SEPA Direct Debit — you don't need to do anything after the initial setup.</p>
                <div class="agr-steps">
                    <div class="agr-step"><div class="agr-step-num">1</div><div class="agr-step-body"><h4>Sign the agreement &amp; mandate</h4><p>You provide your IBAN and authorize Talent Center DDC to collect monthly payments from your account.</p></div></div>
                    <div class="agr-step"><div class="agr-step-num">2</div><div class="agr-step-body"><h4>First payment</h4><p>The first monthly fee is collected upon signing the agreement.</p></div></div>
                    <div class="agr-step"><div class="agr-step-num">3</div><div class="agr-step-body"><h4>Monthly auto-debit</h4><p>Every 1st of the month, your fee is automatically debited from your account via SEPA.</p></div></div>
                    <div class="agr-step"><div class="agr-step-num">4</div><div class="agr-step-body"><h4>Failed payment</h4><p>If a payment fails, you must settle manually within 5 business days.</p></div></div>
                </div>
                <div class="agr-highlight">
                    <h3>Important to know</h3>
                    <p>Monthly fees are non-refundable. Missed classes cannot be refunded or rescheduled unless cancelled by the organizer.</p>
                    <p>All fees include VAT. You will receive a payment confirmation each month.</p>
                </div>
            </div>

            <div data-lang="nl">
                <div class="agr-eyebrow">Betaling &amp; Incasso</div>
                <h2>Hoe betalingen werken</h2>
                <p>Betalingen worden elke maand automatisch geïncasseerd via SEPA-incasso — na de eerste instelling hoef je niets meer te doen.</p>
                <div class="agr-steps">
                    <div class="agr-step"><div class="agr-step-num">1</div><div class="agr-step-body"><h4>Onderteken overeenkomst &amp; machtiging</h4><p>Je geeft je IBAN op en machtigt Talent Center DDC om maandelijkse betalingen te incasseren.</p></div></div>
                    <div class="agr-step"><div class="agr-step-num">2</div><div class="agr-step-body"><h4>Eerste betaling</h4><p>De eerste maandelijkse bijdrage wordt geïncasseerd bij het ondertekenen.</p></div></div>
                    <div class="agr-step"><div class="agr-step-num">3</div><div class="agr-step-body"><h4>Maandelijkse automatische incasso</h4><p>Elke 1e van de maand wordt je bedrag automatisch van je rekening afgeschreven via SEPA.</p></div></div>
                    <div class="agr-step"><div class="agr-step-num">4</div><div class="agr-step-body"><h4>Mislukte betaling</h4><p>Als een betaling mislukt, moet je dit handmatig voldoen binnen 5 werkdagen.</p></div></div>
                </div>
                <div class="agr-highlight">
                    <h3>Belangrijk om te weten</h3>
                    <p>Maandelijkse kosten zijn niet restitueerbaar. Gemiste lessen kunnen niet worden terugbetaald of ingehaald tenzij geannuleerd door de organisator.</p>
                    <p>Alle kosten zijn inclusief BTW. Je ontvangt elke maand een betalingsbevestiging.</p>
                </div>
            </div>

            <div data-lang="ru" class="is-active">
                <div class="agr-eyebrow">Оплата и автосписание</div>
                <h2>Как работает оплата</h2>
                <p>Платежи списываются автоматически каждый месяц через SEPA Direct Debit — после первоначальной настройки ничего делать не нужно.</p>
                <div class="agr-steps">
                    <div class="agr-step"><div class="agr-step-num">1</div><div class="agr-step-body"><h4>Подписание договора и мандата</h4><p>Вы предоставляете IBAN и разрешаете Talent Center DDC ежемесячно списывать оплату с вашего счёта.</p></div></div>
                    <div class="agr-step"><div class="agr-step-num">2</div><div class="agr-step-body"><h4>Первый платёж</h4><p>Первый ежемесячный взнос списывается при подписании договора.</p></div></div>
                    <div class="agr-step"><div class="agr-step-num">3</div><div class="agr-step-body"><h4>Ежемесячное автосписание</h4><p>Каждое 1-е число месяца оплата автоматически списывается с вашего счёта через SEPA.</p></div></div>
                    <div class="agr-step"><div class="agr-step-num">4</div><div class="agr-step-body"><h4>Неуспешный платёж</h4><p>Если платёж не прошёл — необходимо оплатить вручную в течение 5 рабочих дней.</p></div></div>
                </div>
                <div class="agr-highlight">
                    <h3>Важно знать</h3>
                    <p>Ежемесячная оплата не возвращается. Пропущенные занятия не компенсируются и не переносятся, если не отменены организатором.</p>
                    <p>Все суммы включают НДС. Вы получаете подтверждение оплаты каждый месяц.</p>
                </div>
            </div>

            <div data-lang="uk">
                <div class="agr-eyebrow">Оплата та автосписання</div>
                <h2>Як працює оплата</h2>
                <p>Платежі списуються автоматично щомісяця через SEPA Direct Debit — після початкового налаштування нічого робити не потрібно.</p>
                <div class="agr-steps">
                    <div class="agr-step"><div class="agr-step-num">1</div><div class="agr-step-body"><h4>Підписання договору та мандата</h4><p>Ви надаєте IBAN і дозволяєте Talent Center DDC щомісяця списувати оплату з вашого рахунку.</p></div></div>
                    <div class="agr-step"><div class="agr-step-num">2</div><div class="agr-step-body"><h4>Перший платіж</h4><p>Перший щомісячний внесок списується при підписанні договору.</p></div></div>
                    <div class="agr-step"><div class="agr-step-num">3</div><div class="agr-step-body"><h4>Щомісячне автосписання</h4><p>Кожного 1-го числа місяця оплата автоматично списується з вашого рахунку через SEPA.</p></div></div>
                    <div class="agr-step"><div class="agr-step-num">4</div><div class="agr-step-body"><h4>Невдалий платіж</h4><p>Якщо платіж не пройшов — потрібно оплатити вручну протягом 5 робочих днів.</p></div></div>
                </div>
                <div class="agr-highlight">
                    <h3>Важливо знати</h3>
                    <p>Щомісячна оплата не повертається. Пропущені заняття не компенсуються і не переносяться, якщо не скасовані організатором.</p>
                    <p>Усі суми включають ПДВ. Ви отримуєте підтвердження оплати щомісяця.</p>
                </div>
            </div>

        </div><!-- #agr-payment -->

        <?php /* ── SEPA МАНДАТ ─────────────────────────────────── */ ?>
        <div class="agr-section" id="agr-sepa">

            <div data-lang="en">
                <div class="agr-eyebrow">SEPA Mandate</div>
                <h2>What is a SEPA Direct Debit mandate?</h2>
                <p>A SEPA mandate is a written authorization that allows a company to automatically collect payments from your bank account. It is the standard payment method across Europe, fully regulated by EU banking law.</p>
                <div class="agr-sepa">
                    <h3>Your rights under SEPA</h3>
                    <ul>
                        <li>You can request a refund from your bank for any unauthorized debit within <strong>8 weeks</strong> of the charge.</li>
                        <li>You will be notified at least <strong>14 days in advance</strong> before the first debit.</li>
                        <li>You can cancel your mandate at any time via your bank — this does not replace the contractual cancellation notice to DDC.</li>
                        <li>Your bank details are stored securely and used only for payment collection.</li>
                    </ul>
                </div>
            </div>

            <div data-lang="nl">
                <div class="agr-eyebrow">SEPA-machtiging</div>
                <h2>Wat is een SEPA-incassomachtiging?</h2>
                <p>Een SEPA-machtiging is een schriftelijke toestemming waarmee een bedrijf automatisch betalingen van je bankrekening kan incasseren. Het is de standaard betaalmethode in Europa, volledig gereguleerd door Europese bankwetgeving.</p>
                <div class="agr-sepa">
                    <h3>Jouw rechten onder SEPA</h3>
                    <ul>
                        <li>Je kunt bij je bank een terugboeking aanvragen voor elke niet-geautoriseerde afschrijving binnen <strong>8 weken</strong>.</li>
                        <li>Je wordt minimaal <strong>14 dagen van tevoren</strong> geïnformeerd vóór de eerste afschrijving.</li>
                        <li>Je kunt je machtiging op elk moment intrekken bij je bank — dit vervangt niet de contractuele opzegging bij DDC.</li>
                        <li>Je bankgegevens worden veilig bewaard en alleen gebruikt voor betalingsdoeleinden.</li>
                    </ul>
                </div>
            </div>

            <div data-lang="ru" class="is-active">
                <div class="agr-eyebrow">SEPA-мандат</div>
                <h2>Что такое мандат SEPA Direct Debit?</h2>
                <p>Мандат SEPA — это письменное разрешение, позволяющее компании автоматически списывать платежи с вашего счёта. Стандартный метод оплаты в Европе, полностью защищённый банковским законодательством ЕС.</p>
                <div class="agr-sepa">
                    <h3>Ваши права по SEPA</h3>
                    <ul>
                        <li>Вы можете запросить возврат у банка за несанкционированное списание в течение <strong>8 недель</strong>.</li>
                        <li>Вы будете уведомлены не менее чем за <strong>14 дней</strong> до первого списания.</li>
                        <li>Вы можете отозвать мандат через банк — это не заменяет уведомление об отмене договора в адрес DDC.</li>
                        <li>Банковские данные хранятся в безопасности и используются только для сбора платежей.</li>
                    </ul>
                </div>
            </div>

            <div data-lang="uk">
                <div class="agr-eyebrow">SEPA-мандат</div>
                <h2>Що таке мандат SEPA Direct Debit?</h2>
                <p>Мандат SEPA — це письмовий дозвіл, який дозволяє компанії автоматично списувати платежі з вашого рахунку. Стандартний метод оплати в Європі, повністю захищений банківським законодавством ЄС.</p>
                <div class="agr-sepa">
                    <h3>Ваші права за SEPA</h3>
                    <ul>
                        <li>Ви можете запросити повернення коштів у банку за несанкціоноване списання протягом <strong>8 тижнів</strong>.</li>
                        <li>Вас повідомлять не менш ніж за <strong>14 днів</strong> до першого списання.</li>
                        <li>Ви можете відкликати мандат через банк — це не замінює повідомлення про розірвання договору на адресу DDC.</li>
                        <li>Банківські дані зберігаються безпечно і використовуються лише для збору платежів.</li>
                    </ul>
                </div>
            </div>

        </div><!-- #agr-sepa -->

        <?php /* ── ПОСЕЩАЕМОСТЬ ─────────────────────────────────── */ ?>
        <div class="agr-section" id="agr-attendance">

            <div data-lang="en">
                <div class="agr-eyebrow">Attendance</div>
                <h2>Class attendance policy</h2>
                <div class="agr-info-grid">
                    <div class="agr-info-card"><div class="agr-info-icon">❌</div><h4>Missed classes</h4><p>Not refundable and cannot be rescheduled unless cancelled by the organizer.</p></div>
                    <div class="agr-info-card"><div class="agr-info-icon">✅</div><h4>Organizer cancellation</h4><p>If DDC cancels a class, students are notified in advance and alternatives are arranged.</p></div>
                    <div class="agr-info-card"><div class="agr-info-icon">🔒</div><h4>Your spot</h4><p>Guaranteed as long as payments are up to date. Late payments may result in loss of place.</p></div>
                </div>
            </div>

            <div data-lang="nl">
                <div class="agr-eyebrow">Aanwezigheid</div>
                <h2>Aanwezigheidsbeleid</h2>
                <div class="agr-info-grid">
                    <div class="agr-info-card"><div class="agr-info-icon">❌</div><h4>Gemiste lessen</h4><p>Niet terugbetaalbaar en niet in te halen, tenzij geannuleerd door de organisator.</p></div>
                    <div class="agr-info-card"><div class="agr-info-icon">✅</div><h4>Annulering door DDC</h4><p>Als DDC een les annuleert, worden studenten vooraf op de hoogte gesteld en worden alternatieven getroffen.</p></div>
                    <div class="agr-info-card"><div class="agr-info-icon">🔒</div><h4>Jouw plek</h4><p>Gegarandeerd zolang betalingen actueel zijn. Achterstallige betalingen kunnen leiden tot verlies van je plek.</p></div>
                </div>
            </div>

            <div data-lang="ru" class="is-active">
                <div class="agr-eyebrow">Посещаемость</div>
                <h2>Правила посещения</h2>
                <div class="agr-info-grid">
                    <div class="agr-info-card"><div class="agr-info-icon">❌</div><h4>Пропущенные занятия</h4><p>Не компенсируются и не переносятся, если не отменены организатором.</p></div>
                    <div class="agr-info-card"><div class="agr-info-icon">✅</div><h4>Отмена DDC</h4><p>Если DDC отменяет занятие — ученики уведомляются заранее и принимаются альтернативные меры.</p></div>
                    <div class="agr-info-card"><div class="agr-info-icon">🔒</div><h4>Ваше место</h4><p>Гарантировано при своевременной оплате. Задолженность может привести к потере места в группе.</p></div>
                </div>
            </div>

            <div data-lang="uk">
                <div class="agr-eyebrow">Відвідуваність</div>
                <h2>Правила відвідування</h2>
                <div class="agr-info-grid">
                    <div class="agr-info-card"><div class="agr-info-icon">❌</div><h4>Пропущені заняття</h4><p>Не компенсуються і не переносяться, якщо не скасовані організатором.</p></div>
                    <div class="agr-info-card"><div class="agr-info-icon">✅</div><h4>Скасування DDC</h4><p>Якщо DDC скасовує заняття — учні повідомляються заздалегідь і вживаються альтернативні заходи.</p></div>
                    <div class="agr-info-card"><div class="agr-info-icon">🔒</div><h4>Ваше місце</h4><p>Гарантовано за своєчасної оплати. Заборгованість може призвести до втрати місця в групі.</p></div>
                </div>
            </div>

        </div><!-- #agr-attendance -->

        <?php /* ── ОТМЕНА ────────────────────────────────────────── */ ?>
        <div class="agr-section" id="agr-cancellation">

            <div data-lang="en">
                <div class="agr-eyebrow">Cancellation</div>
                <h2>How to cancel your membership</h2>
                <div class="agr-sepa">
                    <h3>Cancellation rules</h3>
                    <ul>
                        <li>Written notice must be submitted at least <strong>1 calendar month</strong> in advance.</li>
                        <li>Fees for the <strong>current month are non-refundable</strong>, even if you cancel mid-month.</li>
                        <li>The notice period month must also be paid in full.</li>
                        <li>Send your cancellation to: <strong>info@talentcenterddc.nl</strong></li>
                    </ul>
                </div>
                <p>DDC reserves the right to terminate the agreement in cases of repeated misconduct or non-payment. Outstanding fees remain due regardless of termination.</p>
            </div>

            <div data-lang="nl">
                <div class="agr-eyebrow">Annulering</div>
                <h2>Hoe je lidmaatschap op te zeggen</h2>
                <div class="agr-sepa">
                    <h3>Annuleringsregels</h3>
                    <ul>
                        <li>Schriftelijke opzegging minimaal <strong>1 kalendermaand</strong> van tevoren.</li>
                        <li>Kosten voor de <strong>huidige maand zijn niet restitueerbaar</strong>, ook niet bij opzegging halverwege.</li>
                        <li>De opzegtermijnmaand moet volledig worden betaald.</li>
                        <li>Stuur je opzegging naar: <strong>info@talentcenterddc.nl</strong></li>
                    </ul>
                </div>
                <p>DDC behoudt zich het recht voor de overeenkomst te beëindigen bij herhaald wangedrag of wanbetaling. Openstaande kosten blijven verschuldigd.</p>
            </div>

            <div data-lang="ru" class="is-active">
                <div class="agr-eyebrow">Отмена</div>
                <h2>Как отказаться от занятий</h2>
                <div class="agr-sepa">
                    <h3>Правила отмены</h3>
                    <ul>
                        <li>Письменное уведомление — не менее чем за <strong>1 календарный месяц</strong>.</li>
                        <li>Оплата за <strong>текущий месяц не возвращается</strong>, даже при отмене в середине месяца.</li>
                        <li>Месяц уведомления оплачивается полностью.</li>
                        <li>Отправьте уведомление на: <strong>info@talentcenterddc.nl</strong></li>
                    </ul>
                </div>
                <p>DDC оставляет за собой право расторгнуть договор при систематических нарушениях или неоплате. Задолженность остаётся к оплате.</p>
            </div>

            <div data-lang="uk">
                <div class="agr-eyebrow">Скасування</div>
                <h2>Як відмовитися від занять</h2>
                <div class="agr-sepa">
                    <h3>Правила скасування</h3>
                    <ul>
                        <li>Письмове повідомлення — не менш ніж за <strong>1 календарний місяць</strong>.</li>
                        <li>Оплата за <strong>поточний місяць не повертається</strong>, навіть у разі скасування в середині місяця.</li>
                        <li>Місяць повідомлення оплачується повністю.</li>
                        <li>Надішліть повідомлення на: <strong>info@talentcenterddc.nl</strong></li>
                    </ul>
                </div>
                <p>DDC залишає за собою право розірвати договір у разі систематичних порушень або несплати. Заборгованість залишається до сплати.</p>
            </div>

        </div><!-- #agr-cancellation -->

        <?php /* ── РЕКВИЗИТЫ ─────────────────────────────────────── */ ?>
        <div class="agr-section" id="agr-company">

            <div data-lang="en">
                <div class="agr-eyebrow">Company Details</div>
                <h2>Talent Center DDC</h2>
                <div class="agr-company">
                    <div class="agr-company-detail"><div class="agr-cd-label">Company name</div><div class="agr-cd-value">Talent Center DDC</div></div>
                    <div class="agr-company-detail"><div class="agr-cd-label">VAT number</div><div class="agr-cd-value">NL004836578B09</div></div>
                    <div class="agr-company-detail"><div class="agr-cd-label">Chamber of Commerce (KVK)</div><div class="agr-cd-value">90720814</div></div>
                    <div class="agr-company-detail"><div class="agr-cd-label">Email</div><div class="agr-cd-value"><a href="mailto:info@talentcenterddc.nl">info@talentcenterddc.nl</a></div></div>
                </div>
            </div>

            <div data-lang="nl">
                <div class="agr-eyebrow">Bedrijfsgegevens</div>
                <h2>Talent Center DDC</h2>
                <div class="agr-company">
                    <div class="agr-company-detail"><div class="agr-cd-label">Bedrijfsnaam</div><div class="agr-cd-value">Talent Center DDC</div></div>
                    <div class="agr-company-detail"><div class="agr-cd-label">BTW-nummer</div><div class="agr-cd-value">NL004836578B09</div></div>
                    <div class="agr-company-detail"><div class="agr-cd-label">KVK-nummer</div><div class="agr-cd-value">90720814</div></div>
                    <div class="agr-company-detail"><div class="agr-cd-label">E-mail</div><div class="agr-cd-value"><a href="mailto:info@talentcenterddc.nl">info@talentcenterddc.nl</a></div></div>
                </div>
            </div>

            <div data-lang="ru" class="is-active">
                <div class="agr-eyebrow">Реквизиты компании</div>
                <h2>Talent Center DDC</h2>
                <div class="agr-company">
                    <div class="agr-company-detail"><div class="agr-cd-label">Название компании</div><div class="agr-cd-value">Talent Center DDC</div></div>
                    <div class="agr-company-detail"><div class="agr-cd-label">Номер НДС (VAT)</div><div class="agr-cd-value">NL004836578B09</div></div>
                    <div class="agr-company-detail"><div class="agr-cd-label">Торговая палата (KVK)</div><div class="agr-cd-value">90720814</div></div>
                    <div class="agr-company-detail"><div class="agr-cd-label">Email</div><div class="agr-cd-value"><a href="mailto:info@talentcenterddc.nl">info@talentcenterddc.nl</a></div></div>
                </div>
            </div>

            <div data-lang="uk">
                <div class="agr-eyebrow">Реквізити компанії</div>
                <h2>Talent Center DDC</h2>
                <div class="agr-company">
                    <div class="agr-company-detail"><div class="agr-cd-label">Назва компанії</div><div class="agr-cd-value">Talent Center DDC</div></div>
                    <div class="agr-company-detail"><div class="agr-cd-label">Номер ПДВ (VAT)</div><div class="agr-cd-value">NL004836578B09</div></div>
                    <div class="agr-company-detail"><div class="agr-cd-label">Торгова палата (KVK)</div><div class="agr-cd-value">90720814</div></div>
                    <div class="agr-company-detail"><div class="agr-cd-label">Email</div><div class="agr-cd-value"><a href="mailto:info@talentcenterddc.nl">info@talentcenterddc.nl</a></div></div>
                </div>
            </div>

        </div><!-- #agr-company -->

        <?php /* ── FAQ ───────────────────────────────────────────── */ ?>
        <div class="agr-section" id="agr-faq">

            <div data-lang="en">
                <div class="agr-eyebrow">FAQ</div>
                <h2>Frequently asked questions</h2>
                <div class="agr-faq-item"><div class="agr-faq-q">Can I try a class before signing?</div><div class="agr-faq-a">Yes — DDC offers a trial class. Contact us at <a href="mailto:info@talentcenterddc.nl">info@talentcenterddc.nl</a> to book your first session.</div></div>
                <div class="agr-faq-item"><div class="agr-faq-q">Can I switch to a different group?</div><div class="agr-faq-a">Yes, subject to availability. Contact us and we'll help you transfer to the right group. Your fee may be adjusted accordingly.</div></div>
                <div class="agr-faq-item"><div class="agr-faq-q">What if my IBAN changes?</div><div class="agr-faq-a">Notify us immediately at <a href="mailto:info@talentcenterddc.nl">info@talentcenterddc.nl</a> with your new IBAN so we can update the direct debit.</div></div>
                <div class="agr-faq-item"><div class="agr-faq-q">Can I pause my membership?</div><div class="agr-faq-a">Pausing is not included in the standard agreement. Please contact us directly to discuss your situation.</div></div>
                <div class="agr-faq-item"><div class="agr-faq-q">Can I transfer my spot to someone else?</div><div class="agr-faq-a">No — the agreement is personal and non-transferable. A new student must sign a separate agreement.</div></div>
            </div>

            <div data-lang="nl">
                <div class="agr-eyebrow">FAQ</div>
                <h2>Veelgestelde vragen</h2>
                <div class="agr-faq-item"><div class="agr-faq-q">Kan ik een proefles volgen voor het ondertekenen?</div><div class="agr-faq-a">Ja — DDC biedt een proefles aan. Neem contact op via <a href="mailto:info@talentcenterddc.nl">info@talentcenterddc.nl</a> om je eerste les te boeken.</div></div>
                <div class="agr-faq-item"><div class="agr-faq-q">Kan ik van groep wisselen?</div><div class="agr-faq-a">Ja, afhankelijk van beschikbaarheid. Neem contact op en we helpen je over te stappen. Je bijdrage kan worden aangepast.</div></div>
                <div class="agr-faq-item"><div class="agr-faq-q">Wat als mijn IBAN verandert?</div><div class="agr-faq-a">Stel ons onmiddellijk op de hoogte via <a href="mailto:info@talentcenterddc.nl">info@talentcenterddc.nl</a> zodat we de incassogegevens kunnen bijwerken.</div></div>
                <div class="agr-faq-item"><div class="agr-faq-q">Kan ik mijn lidmaatschap pauzeren?</div><div class="agr-faq-a">Pauzeren is niet standaard inbegrepen. Neem direct contact met ons op om je situatie te bespreken.</div></div>
                <div class="agr-faq-item"><div class="agr-faq-q">Kan ik mijn plek overdragen?</div><div class="agr-faq-a">Nee — de overeenkomst is persoonlijk en niet overdraagbaar. Een nieuwe student moet een aparte overeenkomst tekenen.</div></div>
            </div>

            <div data-lang="ru" class="is-active">
                <div class="agr-eyebrow">FAQ</div>
                <h2>Частые вопросы</h2>
                <div class="agr-faq-item"><div class="agr-faq-q">Можно ли попробовать занятие перед подписанием?</div><div class="agr-faq-a">Да — DDC предлагает пробное занятие. Напишите на <a href="mailto:info@talentcenterddc.nl">info@talentcenterddc.nl</a>, чтобы записаться.</div></div>
                <div class="agr-faq-item"><div class="agr-faq-q">Можно ли перейти в другую группу?</div><div class="agr-faq-a">Да, при наличии мест. Свяжитесь с нами и мы поможем с переводом. Стоимость может быть скорректирована.</div></div>
                <div class="agr-faq-item"><div class="agr-faq-q">Что если мой IBAN изменится?</div><div class="agr-faq-a">Немедленно сообщите нам на <a href="mailto:info@talentcenterddc.nl">info@talentcenterddc.nl</a> с новым IBAN для обновления реквизитов списания.</div></div>
                <div class="agr-faq-item"><div class="agr-faq-q">Можно ли приостановить занятия?</div><div class="agr-faq-a">Приостановка не предусмотрена стандартным договором. Свяжитесь с нами для обсуждения ситуации.</div></div>
                <div class="agr-faq-item"><div class="agr-faq-q">Можно ли передать место другому?</div><div class="agr-faq-a">Нет — договор личный и не подлежит передаче. Новый ученик должен подписать отдельный договор.</div></div>
            </div>

            <div data-lang="uk">
                <div class="agr-eyebrow">FAQ</div>
                <h2>Часті запитання</h2>
                <div class="agr-faq-item"><div class="agr-faq-q">Чи можна спробувати заняття перед підписанням?</div><div class="agr-faq-a">Так — DDC пропонує пробне заняття. Напишіть на <a href="mailto:info@talentcenterddc.nl">info@talentcenterddc.nl</a>, щоб записатися.</div></div>
                <div class="agr-faq-item"><div class="agr-faq-q">Чи можна перейти в іншу групу?</div><div class="agr-faq-a">Так, за наявності місць. Зв'яжіться з нами, і ми допоможемо з переходом. Вартість може бути скоригована.</div></div>
                <div class="agr-faq-item"><div class="agr-faq-q">Що робити, якщо мій IBAN зміниться?</div><div class="agr-faq-a">Негайно повідомте нас на <a href="mailto:info@talentcenterddc.nl">info@talentcenterddc.nl</a> з новим IBAN для оновлення реквізитів списання.</div></div>
                <div class="agr-faq-item"><div class="agr-faq-q">Чи можна призупинити заняття?</div><div class="agr-faq-a">Призупинення не передбачено стандартним договором. Зв'яжіться з нами для обговорення ситуації.</div></div>
                <div class="agr-faq-item"><div class="agr-faq-q">Чи можна передати місце іншому?</div><div class="agr-faq-a">Ні — договір особистий і не підлягає передачі. Новий учень має підписати окремий договір.</div></div>
            </div>

        </div><!-- #agr-faq -->

    </div><!-- .agr-wrap -->

    <?php /* ── CTA ──────────────────────────────────────────────── */ ?>
    <div class="agr-cta">
        <div data-lang="en">
            <h2>Ready to join?</h2>
            <p>Contact us to enrol or book your trial class.</p>
            <button type="button" class="agr-cta-btn" data-bs-toggle="modal" data-bs-target="#contact_form">Contact us →</button>
        </div>
        <div data-lang="nl">
            <h2>Klaar om mee te doen?</h2>
            <p>Neem contact op om je in te schrijven of een proefles te boeken.</p>
            <button type="button" class="agr-cta-btn" data-bs-toggle="modal" data-bs-target="#contact_form">Neem contact op →</button>
        </div>
        <div data-lang="ru" class="is-active">
            <h2>Готовы присоединиться?</h2>
            <p>Напишите нам, чтобы записаться или попробовать пробное занятие.</p>
            <button type="button" class="agr-cta-btn" data-bs-toggle="modal" data-bs-target="#contact_form">Написать нам →</button>
        </div>
        <div data-lang="uk">
            <h2>Готові приєднатися?</h2>
            <p>Напишіть нам, щоб записатися або спробувати пробне заняття.</p>
            <button type="button" class="agr-cta-btn" data-bs-toggle="modal" data-bs-target="#contact_form">Написати нам →</button>
        </div>
    </div>

</div><!-- .agr-page -->

<?php
$BsWp->get_template_parts([
    'parts/modals/contact',
    'parts/shared/footer',
    'parts/shared/cookiebar',
    'parts/shared/html-footer',
]);
?>
