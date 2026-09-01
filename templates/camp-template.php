<?php

/**
 * Template name: Dance Camp
 *
 * Landing page for LITO DANCE CAMP 2027.
 *
 * @package     WordPress
 * @subpackage  Bootstrap 5.3.2
 * @autor       ddc_nl
 */

$BsWp = new BsWp;

$camp_data = [
    'name' => 'LITO DANCE CAMP 2027',
    'location' => 'Santa Susanna, Spain',
    'dates_display' => '26 июля - 4 августа 2027',
    'dates_short' => '26.07 - 04.08.2027',
    'duration' => '10 дней',
    'hotel' => 'Hotel Don Angel',
    'hotel_stars' => '★★★★',
    'regular_price' => '1390',
    'deposit' => '450',
    'bus_note' => 'Автобус оплачивается отдельно',
];

$camp_images = [
    'https://talentcenterddc.nl/wp-content/uploads/2026/03/camp-1.webp',
    'https://talentcenterddc.nl/wp-content/uploads/2026/03/camp-2.webp',
    'https://talentcenterddc.nl/wp-content/uploads/2026/03/camp-3.webp',
    'https://talentcenterddc.nl/wp-content/uploads/2026/03/camp-4.webp',
    'https://talentcenterddc.nl/wp-content/uploads/2026/03/camp-5.webp',
    'https://talentcenterddc.nl/wp-content/uploads/2026/03/camp-6.webp',
    'https://talentcenterddc.nl/wp-content/uploads/2026/03/camp-7.webp',
    'https://talentcenterddc.nl/wp-content/uploads/2026/03/camp-8.webp',
    'https://talentcenterddc.nl/wp-content/uploads/2026/03/camp-9.webp',
];

$camp_included = [
    ['HOTEL 4★', 'Проживание в Hotel Don Angel.', '🏨'],
    ['FULL BOARD', 'Трёхразовое питание, шведский стол.', '🍽'],
    ['DANCE', '2-3 танцевальных занятия ежедневно.', '💃'],
    ['ACTIVITIES', 'Активности с вожатыми и хореографами.', '🌴'],
    ['PARTIES', 'Вечеринки и дискотеки каждый вечер.', '🎉'],
    ['INSURANCE', 'Медицинская страховка.', '🩺'],
    ['CAMP T-SHIRT', 'Фирменная футболка LITO DANCE CAMP.', '👕'],
];

$camp_faq = [
    ['С какого возраста можно ехать?', 'Возраст участников подтверждается индивидуально при бронировании. Напишите возраст ребёнка в заявке, и команда лагеря подскажет, подходит ли программа.'],
    ['Можно ли ребёнку ехать без родителей?', 'Да, лагерь рассчитан на организованную поездку детей и подростков. Детали сопровождения и документов команда обсудит с родителями перед бронированием.'],
    ['Кто находится с детьми?', 'Дети находятся под присмотром команды лагеря, хореографов и сопровождающих взрослых.'],
    ['Как дети связываются с родителями?', 'Команда заранее согласует удобный канал связи с родителями и сообщает новости по группе. При необходимости ребёнок сможет связаться с родителями через сопровождающих.'],
    ['Что делать, если ребёнок заболел?', 'Медицинская страховка включена. Команда связывается с родителями и помогает организовать медицинскую помощь на месте.'],
    ['Что входит в стоимость?', 'Проживание в Hotel Don Angel 4★, трёхразовое питание, танцевальные классы, активности, вечерняя программа, страховка и фирменная футболка лагеря.'],
    ['Что оплачивается отдельно?', 'Автобус оплачивается отдельно. Дополнительные личные расходы и документы также не входят в базовую стоимость.'],
    ['Как происходит бронирование?', 'Вы оставляете заявку, команда связывается с вами, подтверждает детали и отправляет информацию для внесения предоплаты.'],
    ['Что означает предоплата €450?', 'Предоплата €450 бронирует место ребёнка в LITO DANCE CAMP 2027 и учитывается в общей стоимости тарифа.'],
    ['Можно ли вернуть предоплату?', 'Условия возврата зависят от даты отмены и договорённостей бронирования. Команда отправит актуальные условия перед внесением предоплаты.'],
    ['Как дети добираются до Испании?', 'Транспорт организуется отдельно. Автобус не входит в стоимость тарифа и оплачивается отдельно.'],
    ['Что ребёнку взять с собой?', 'После подтверждения бронирования родители получат список вещей: одежда для танцев, пляжа, документы, базовая аптечка и личные принадлежности.'],
];

$camp_reviews = [];

add_action('wp_head', function () use ($camp_images) {
    $canonical = home_url('/camp/');
    ?>
    <link rel="canonical" href="<?php echo esc_url($canonical); ?>">
    <link rel="preload" as="image" href="<?php echo esc_url($camp_images[0]); ?>">
    <style>
        :root{--camp-lime:#b8ff00;--camp-yellow:#f4ff00;--camp-green:#164f20;--camp-sky:#50c7ed;--camp-sand:#fff1cf;--camp-ink:#10170f}
        body.page-template-camp-template #content,body.page-template-camp-template #not_found{background:#fff;border-top:0;overflow:visible}
        .camp-page{--shadow-hard:8px 8px 0 var(--camp-ink);background:#fff;color:var(--camp-ink);font-family:"Raleway","Verdana","Arial",sans-serif;line-height:1.45;overflow:clip}
        .camp-page *{box-sizing:border-box}.camp-section{position:relative;padding:clamp(64px,9vw,112px) 0}.camp-container{width:min(1120px,calc(100% - 32px));margin:0 auto;position:relative;z-index:2}
        .camp-kicker,.camp-sticker,.camp-btn,.camp-card__eyebrow,.camp-price__status,.camp-fact__number{font-weight:900;text-transform:uppercase}
        .camp-kicker{display:inline-flex;align-items:center;gap:8px;background:var(--camp-lime);color:var(--camp-green);border:2px solid var(--camp-ink);box-shadow:4px 4px 0 var(--camp-ink);padding:8px 14px;transform:rotate(-1.5deg);letter-spacing:0}
        .camp-title{margin:18px 0 22px;font-size:clamp(42px,9vw,104px);line-height:.9;letter-spacing:0;color:var(--camp-ink)}.camp-title span{display:block}.camp-title--light{color:#fff;text-shadow:4px 4px 0 rgba(0,0,0,.28)}
        .camp-btn{display:inline-flex;align-items:center;justify-content:center;min-height:56px;border:3px solid var(--camp-ink);border-radius:999px;background:var(--camp-lime);color:var(--camp-ink);box-shadow:var(--shadow-hard);padding:14px 24px;text-decoration:none;transition:transform 180ms ease,box-shadow 180ms ease}
        .camp-btn:hover,.camp-btn:focus{color:var(--camp-ink);transform:translate(3px,3px);box-shadow:4px 4px 0 var(--camp-ink)}.camp-btn--dark{background:var(--camp-ink);color:#fff;box-shadow:7px 7px 0 var(--camp-yellow)}.camp-btn--dark:hover,.camp-btn--dark:focus{color:#fff}
        .camp-hero{min-height:min(840px,94vh);display:flex;align-items:center;padding:120px 0 92px;background:linear-gradient(90deg,rgba(16,23,15,.68),rgba(22,79,32,.24) 58%,rgba(80,199,237,.28)),url("<?php echo esc_url($camp_images[0]); ?>") center/cover no-repeat,var(--camp-sky);isolation:isolate}
        .camp-hero::before,.camp-hero::after{content:"";position:absolute;pointer-events:none;z-index:1}.camp-hero::before{width:min(560px,86vw);height:150px;left:-42px;top:22%;background:var(--camp-lime);transform:rotate(-7deg);clip-path:polygon(0 18%,96% 0,100% 70%,8% 100%);mix-blend-mode:hard-light;opacity:.9}.camp-hero::after{right:-42px;bottom:8%;width:min(440px,76vw);height:120px;background:var(--camp-yellow);transform:rotate(6deg);clip-path:polygon(4% 10%,100% 0,92% 82%,0 100%);opacity:.88}
        .camp-hero__content{max-width:820px}.camp-hero h1{margin:20px 0 18px;color:#fff;font-size:clamp(52px,12vw,128px);line-height:.82;letter-spacing:0;text-shadow:5px 5px 0 var(--camp-green)}.camp-hero h1 span{display:block}
        .camp-hero__sub{max-width:680px;color:#fff;font-size:clamp(20px,3.4vw,34px);font-weight:900;line-height:1.1;text-shadow:0 2px 16px rgba(0,0,0,.45)}.camp-hero__facts{display:flex;flex-wrap:wrap;gap:10px;margin:26px 0 30px}
        .camp-pill{display:inline-flex;align-items:center;min-height:44px;border:2px solid rgba(255,255,255,.8);border-radius:999px;background:rgba(255,255,255,.18);color:#fff;padding:8px 14px;font-weight:800;backdrop-filter:blur(8px)}.camp-hero__deposit{margin:18px 0 0;color:#fff;font-weight:800}
        .camp-sticker{display:inline-flex;align-items:center;justify-content:center;border:3px solid var(--camp-ink);background:#fff;color:var(--camp-ink);box-shadow:6px 6px 0 var(--camp-ink);padding:12px 18px;transform:rotate(5deg)}.camp-hero__sticker{position:absolute;right:min(7vw,84px);top:132px;z-index:3;background:var(--camp-yellow)}
        .camp-facts{background:var(--camp-green);color:#fff;padding:22px 0}.camp-facts__grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px}.camp-fact{min-height:118px;border:2px solid rgba(255,255,255,.35);background:rgba(255,255,255,.08);padding:18px}.camp-fact__number{display:block;color:var(--camp-lime);font-size:clamp(36px,6vw,64px);line-height:.9}.camp-fact__text{display:block;margin-top:6px;font-weight:700}
        .camp-story{background:var(--camp-sand)}.camp-split{display:grid;grid-template-columns:minmax(0,1fr) minmax(320px,.86fr);gap:clamp(28px,6vw,72px);align-items:center}.camp-copy{font-size:clamp(18px,2vw,24px);font-weight:700}
        .camp-media{position:relative;min-height:420px;border:3px solid var(--camp-ink);box-shadow:var(--shadow-hard);overflow:hidden;background:var(--camp-sky)}.camp-media img,.camp-gallery img,.camp-hotel__photo img{width:100%;height:100%;object-fit:cover;display:block}.camp-story__sticker{position:absolute;left:-18px;bottom:28px;z-index:4;background:var(--camp-lime);transform:rotate(-7deg)}
        .camp-included{background:#fff}.camp-card-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;margin-top:32px}.camp-card{min-height:190px;border:3px solid var(--camp-ink);background:#fff;box-shadow:6px 6px 0 var(--camp-ink);padding:22px}.camp-card:nth-child(3n+1){background:var(--camp-lime)}.camp-card:nth-child(3n+2){background:var(--camp-yellow)}.camp-card:nth-child(3n){background:#e7fbff}.camp-card__icon{display:block;font-size:32px;margin-bottom:18px}.camp-card__eyebrow{display:block;margin-bottom:8px;font-size:18px}
        .camp-detox{background:var(--camp-sky)}.camp-detox__message{display:inline-block;margin:12px 0 30px;background:var(--camp-ink);color:#fff;border:3px solid var(--camp-ink);box-shadow:7px 7px 0 var(--camp-yellow);padding:14px 18px;font-size:clamp(26px,5vw,56px);font-weight:900;line-height:1}
        .camp-gallery{background:var(--camp-green);color:#fff}.camp-gallery__grid{display:grid;grid-template-columns:2fr 1fr 1fr;grid-auto-rows:230px;gap:12px;margin-top:34px}.camp-gallery__item{position:relative;border:3px solid #fff;overflow:hidden;background:rgba(255,255,255,.18)}.camp-gallery__item--big{grid-row:span 2}.camp-gallery__item::after{content:"LITO";position:absolute;right:10px;bottom:10px;background:var(--camp-lime);color:var(--camp-ink);padding:4px 8px;font-weight:900}
        .camp-hotel{background:linear-gradient(135deg,#fff 0%,#e9fbff 54%,#fff7db 100%)}.camp-hotel__photo{min-height:430px;border:3px solid var(--camp-ink);box-shadow:var(--shadow-hard);overflow:hidden}.camp-list{display:grid;gap:12px;margin:26px 0 0;padding:0;list-style:none}.camp-list li{display:flex;gap:12px;align-items:flex-start;padding:14px 0;border-bottom:2px solid rgba(16,23,15,.12);font-weight:700}
        .camp-prices{background:var(--camp-sand)}.camp-price-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;align-items:stretch;margin-top:34px}.camp-price{position:relative;min-height:360px;border:3px solid var(--camp-ink);background:#fff;box-shadow:6px 6px 0 var(--camp-ink);padding:26px;display:flex;flex-direction:column}.camp-price--muted{opacity:.58;filter:grayscale(.7)}.camp-price--active{background:var(--camp-lime);transform:rotate(-1deg) translateY(-10px);box-shadow:10px 10px 0 var(--camp-ink)}.camp-price__badge{position:absolute;right:18px;top:18px;background:var(--camp-yellow);border:2px solid var(--camp-ink);padding:5px 9px;font-size:12px;font-weight:900}.camp-price__status{display:inline-block;width:fit-content;margin-bottom:20px;background:var(--camp-ink);color:#fff;padding:6px 10px}.camp-price h3{margin:0 0 12px;font-size:34px}.camp-price__amount{margin:0 0 16px;font-size:clamp(52px,8vw,82px);font-weight:900;line-height:.9}.camp-price p{font-weight:700}.camp-price .camp-btn{margin-top:auto}.camp-price__stamp{position:absolute;right:18px;bottom:24px;border:4px solid var(--camp-ink);color:var(--camp-ink);padding:8px 14px;font-weight:900;transform:rotate(-14deg)}.camp-price-note{margin:28px 0 0;font-size:20px;font-weight:900;text-align:center}
        .camp-deposit{background:var(--camp-lime)}.camp-deposit__box{display:grid;grid-template-columns:1fr auto;gap:28px;align-items:center;border:3px solid var(--camp-ink);background:#fff;box-shadow:var(--shadow-hard);padding:clamp(24px,5vw,48px)}.camp-deposit__amount{font-size:clamp(76px,13vw,154px);line-height:.82;font-weight:900}
        .camp-safety{background:#fff}.camp-day{background:var(--camp-sky)}.camp-timeline{display:grid;gap:10px;margin-top:30px}.camp-timeline__item{display:grid;grid-template-columns:92px 1fr;gap:14px;align-items:center;border:3px solid var(--camp-ink);background:#fff;box-shadow:5px 5px 0 var(--camp-ink);padding:14px 18px;font-weight:900}.camp-timeline__time{color:var(--camp-green)}
        .camp-reviews{background:var(--camp-sand)}.camp-empty-proof{border:3px dashed var(--camp-ink);background:#fff;padding:26px;font-weight:800}.camp-faq{background:var(--camp-green);color:#fff}.camp-faq .camp-kicker{background:var(--camp-yellow)}.camp-faq__list{display:grid;gap:10px;margin-top:30px}.camp-faq__item{border:2px solid rgba(255,255,255,.35);background:rgba(255,255,255,.08)}.camp-faq__question{width:100%;min-height:62px;display:flex;align-items:center;justify-content:space-between;gap:18px;border:0;background:transparent;color:#fff;padding:16px 18px;font:inherit;font-weight:900;text-align:left}.camp-faq__question span:last-child{flex:0 0 auto;width:34px;height:34px;border-radius:50%;background:var(--camp-lime);color:var(--camp-ink);display:inline-flex;align-items:center;justify-content:center}.camp-faq__answer{display:none;padding:0 18px 18px;color:rgba(255,255,255,.86);font-weight:600}.camp-faq__item.is-open .camp-faq__answer{display:block}
        .camp-final{min-height:78vh;display:flex;align-items:center;background:linear-gradient(90deg,rgba(16,23,15,.72),rgba(80,199,237,.18)),url("<?php echo esc_url($camp_images[5]); ?>") center/cover no-repeat;color:#fff}.camp-final__info{display:flex;flex-wrap:wrap;gap:10px;margin:28px 0}
        .camp-sticky{position:fixed;left:12px;right:12px;bottom:12px;z-index:1000;display:none;align-items:center;justify-content:space-between;gap:12px;border:3px solid var(--camp-ink);background:#fff;box-shadow:0 8px 28px rgba(0,0,0,.22);padding:10px}.camp-sticky.is-visible{display:flex}.camp-sticky__price{font-weight:900;line-height:1.1}.camp-sticky .camp-btn{min-height:44px;padding:10px 16px;box-shadow:none}
        .camp-booking-modal .modal-content{border:3px solid var(--camp-ink);border-radius:0;box-shadow:var(--shadow-hard)}.camp-booking-modal .modal-header{background:var(--camp-lime);border-bottom:3px solid var(--camp-ink)}.camp-booking-modal .modal-title{color:var(--camp-ink);font-weight:900}.camp-booking-form{display:grid;grid-template-columns:repeat(2,1fr);gap:14px}.camp-booking-form label{display:grid;gap:6px;font-weight:800}.camp-booking-form input,.camp-booking-form textarea{width:100%;border:2px solid var(--camp-ink);border-radius:0;padding:12px 14px;font:inherit}.camp-booking-form textarea,.camp-booking-form .is-full{grid-column:1/-1}.camp-form-status{grid-column:1/-1;min-height:24px;font-weight:800}.camp-form-status.is-success{border:2px solid var(--camp-green);background:#e9ffd0;padding:14px}
        .camp-reveal{opacity:0;transform:translateY(24px);transition:opacity 560ms ease,transform 560ms ease}.camp-reveal.is-visible{opacity:1;transform:translateY(0)}
        @media (min-width:992px){.camp-sticky{left:auto;width:360px}}@media (max-width:991px){.camp-split,.camp-deposit__box{grid-template-columns:1fr}.camp-card-grid,.camp-price-grid{grid-template-columns:1fr 1fr}.camp-price--active{transform:none}.camp-gallery__grid{grid-template-columns:1fr 1fr}}
        @media (max-width:575px){.camp-container{width:min(100% - 24px,1120px)}.camp-hero{min-height:auto;align-items:flex-start;padding:96px 0 52px;background-position:center top}.camp-hero::before{width:92vw;height:82px;left:-18px;top:205px;transform:rotate(-8deg)}.camp-hero::after{width:74vw;height:72px;right:-34px;bottom:34px;opacity:.72}.camp-hero__sticker{right:18px;top:58px;transform:rotate(5deg) scale(.68);padding:9px 12px;box-shadow:4px 4px 0 var(--camp-ink)}.camp-kicker{max-width:calc(100vw - 32px);padding:8px 10px;font-size:13px;line-height:1.15;box-shadow:3px 3px 0 var(--camp-ink)}.camp-hero h1{max-width:100%;margin:22px 0 14px;font-size:clamp(38px,11.8vw,52px);line-height:.9;text-shadow:3px 3px 0 var(--camp-green);overflow-wrap:anywhere}.camp-hero__sub{max-width:94vw;margin:0 0 18px;font-size:17px;line-height:1.18}.camp-hero__facts{gap:8px;margin:20px 0 26px}.camp-final__info{gap:8px}.camp-pill{width:100%;min-height:46px;justify-content:center;padding:8px 10px;font-size:15px;line-height:1.15;text-align:center;white-space:normal;backdrop-filter:blur(5px)}.camp-btn{min-height:54px;padding:12px 20px;font-size:16px;box-shadow:6px 6px 0 var(--camp-ink)}.camp-hero__deposit{margin-top:16px;font-size:16px}.camp-facts__grid,.camp-card-grid,.camp-price-grid,.camp-booking-form{grid-template-columns:1fr}.camp-facts__grid{grid-template-columns:1fr 1fr}.camp-gallery__grid{display:flex;overflow-x:auto;scroll-snap-type:x mandatory;margin-left:-16px;margin-right:-16px;padding:0 16px 10px}.camp-gallery__item{flex:0 0 82%;height:340px;scroll-snap-align:start}.camp-gallery__item--big{grid-row:auto}.camp-media,.camp-hotel__photo{min-height:320px}.camp-timeline__item{grid-template-columns:76px 1fr}.camp-page{padding-bottom:84px}}
        @media (prefers-reduced-motion:reduce){.camp-reveal,.camp-btn,.camp-price,.camp-sticker{transition:none;animation:none}}
    </style>
    <?php
}, 20);

add_action('wp_footer', function () {
    ?>
    <script>
    (function(){var campRoot=document.querySelector('.camp-page');if(!campRoot)return;function track(name,payload){window.dataLayer=window.dataLayer||[];window.dataLayer.push(Object.assign({event:name},payload||{}));if(typeof fbq==='function'){if(name==='camp_view')fbq('track','ViewContent',{content_name:'LITO DANCE CAMP 2027'});if(name==='camp_form_submit')fbq('track','Lead',{content_name:'LITO DANCE CAMP 2027'});if(name==='camp_booking_click'||name==='camp_regular_click')fbq('track','InitiateCheckout',{content_name:'LITO DANCE CAMP 2027',value:450,currency:'EUR'});}}track('camp_view');var revealObserver='IntersectionObserver'in window?new IntersectionObserver(function(entries){entries.forEach(function(entry){if(entry.isIntersecting){entry.target.classList.add('is-visible');if(entry.target.id==='camp-prices')track('camp_price_view');if(entry.target.id==='camp-gallery')track('camp_gallery_view');revealObserver.unobserve(entry.target);}});},{rootMargin:'0px 0px -12% 0px'}):null;document.querySelectorAll('.camp-reveal,#camp-prices,#camp-gallery').forEach(function(el){if(revealObserver)revealObserver.observe(el);else el.classList.add('is-visible');});document.querySelectorAll('[data-camp-cta]').forEach(function(button){button.addEventListener('click',function(){var eventName=button.getAttribute('data-camp-event')||'camp_booking_click';track(eventName,{cta_location:button.getAttribute('data-camp-cta')||''});});});document.querySelectorAll('.camp-faq__question').forEach(function(button){button.addEventListener('click',function(){var item=button.closest('.camp-faq__item');var isOpen=item.classList.toggle('is-open');button.setAttribute('aria-expanded',isOpen?'true':'false');button.querySelector('[data-faq-icon]').textContent=isOpen?'-':'+';if(isOpen)track('camp_faq_open',{question:button.textContent.trim()});});});var sticky=document.querySelector('.camp-sticky');var hero=document.querySelector('.camp-hero');if(sticky&&hero&&'IntersectionObserver'in window){var stickyObserver=new IntersectionObserver(function(entries){sticky.classList.toggle('is-visible',!entries[0].isIntersecting);},{threshold:0});stickyObserver.observe(hero);}else if(sticky){sticky.classList.add('is-visible');}var form=document.querySelector('#camp-booking-form');if(!form)return;var started=false;var messengerTouched=false;var status=form.querySelector('.camp-form-status');var messengerField=form.querySelector('[name="messenger"]');if(messengerField){messengerField.addEventListener('focus',function(){if(!messengerTouched){messengerTouched=true;track('camp_whatsapp_click');}});}form.addEventListener('input',function(){if(!started){started=true;track('camp_form_start');}});form.addEventListener('submit',function(event){event.preventDefault();if(!form.checkValidity()){form.reportValidity();return;}var submit=form.querySelector('[type="submit"]');var payload={};new FormData(form).forEach(function(value,key){payload[key]=value;});payload.lang=document.documentElement.lang||'ru';submit.disabled=true;status.textContent='Отправляем заявку...';status.className='camp-form-status';fetch('<?php echo esc_url_raw(rest_url('contact-form/camp-booking')); ?>',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(payload)}).then(function(response){if(!response.ok)throw new Error('Request failed');return response.json();}).then(function(){form.reset();status.className='camp-form-status is-success';status.innerHTML='🎉 Заявка получена!<br>Мы свяжемся с вами и отправим информацию для внесения предоплаты €450.';track('camp_form_submit');}).catch(function(){status.textContent='Не получилось отправить заявку. Попробуйте ещё раз или напишите нам напрямую.';}).finally(function(){submit.disabled=false;});});})();
    </script>
    <?php
}, 20);

$BsWp->get_template_parts([
    'parts/shared/html-header',
    'parts/shared/header'
]);
?>

<div class="camp-page">
    <section class="camp-section camp-hero" id="camp-hero">
        <div class="camp-container camp-hero__content">
            <span class="camp-kicker">Talent Center DDC presents</span>
            <h1><span>Танцевальное</span><span>лето в Испании</span></h1>
            <p class="camp-hero__sub">10 дней моря, танцев, друзей и настоящих эмоций 🇪🇸</p>
            <div class="camp-hero__facts" aria-label="Краткая информация о лагере">
                <span class="camp-pill">📍 <?php echo esc_html($camp_data['location']); ?></span>
                <span class="camp-pill">📅 <?php echo esc_html($camp_data['dates_display']); ?></span>
                <span class="camp-pill">🏨 <?php echo esc_html($camp_data['hotel'] . ' ' . $camp_data['hotel_stars']); ?></span>
            </div>
            <button type="button" class="camp-btn" data-bs-toggle="modal" data-bs-target="#camp_booking_modal" data-camp-cta="hero" data-camp-event="camp_booking_click">ЗАБРОНИРОВАТЬ МЕСТО →</button>
            <p class="camp-hero__deposit">Предоплата €<?php echo esc_html($camp_data['deposit']); ?></p>
        </div>
        <div class="camp-sticker camp-hero__sticker">LIMITED PLACES</div>
    </section>

    <section class="camp-facts" aria-label="Ключевые факты">
        <div class="camp-container camp-facts__grid">
            <div class="camp-fact"><span class="camp-fact__number">10 ДНЕЙ</span><span class="camp-fact__text">моря и приключений</span></div>
            <div class="camp-fact"><span class="camp-fact__number">2-3</span><span class="camp-fact__text">класса в день</span></div>
            <div class="camp-fact"><span class="camp-fact__number">0</span><span class="camp-fact__text">гаджетов</span></div>
            <div class="camp-fact"><span class="camp-fact__number">∞</span><span class="camp-fact__text">эмоций</span></div>
        </div>
    </section>

    <section class="camp-section camp-story">
        <div class="camp-container camp-split">
            <div class="camp-reveal">
                <span class="camp-kicker">море → танцы → друзья</span>
                <h2 class="camp-title"><span>Лето, которое</span><span>они не забудут</span></h2>
                <div class="camp-copy">
                    <p>Целых 10 дней моря, танцев и настоящей дружбы.</p>
                    <p>Каждый год дети возвращаются домой другими: увереннее, взрослее и счастливее.</p>
                    <p>Без телефонов, зато с кучей эмоций 💛</p>
                </div>
            </div>
            <div class="camp-media camp-reveal">
                <img src="<?php echo esc_url($camp_images[1]); ?>" alt="Дети на LITO DANCE CAMP у моря" loading="lazy">
                <span class="camp-sticker camp-story__sticker">NO PHONES. MORE LIFE.</span>
            </div>
        </div>
    </section>

    <section class="camp-section camp-included">
        <div class="camp-container">
            <span class="camp-kicker">What's included</span>
            <h2 class="camp-title"><span>Всё, что нужно</span><span>для идеального лета</span></h2>
            <div class="camp-card-grid">
                <?php foreach ($camp_included as $item) : ?>
                    <article class="camp-card camp-reveal">
                        <span class="camp-card__icon"><?php echo esc_html($item[2]); ?></span>
                        <span class="camp-card__eyebrow"><?php echo esc_html($item[0]); ?></span>
                        <p><?php echo esc_html($item[1]); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="camp-section camp-detox">
        <div class="camp-container">
            <span class="camp-kicker">Why kids love it</span>
            <h2 class="camp-title"><span>10 дней</span><span>без гаджетов</span></h2>
            <div class="camp-detox__message">📵 PHONE OFF → 🌴 LIFE ON</div>
            <div class="camp-card-grid">
                <article class="camp-card camp-reveal"><span class="camp-card__eyebrow">DANCE</span><p>Танцевальный рост и вдохновение.</p></article>
                <article class="camp-card camp-reveal"><span class="camp-card__eyebrow">FRIENDS</span><p>Новые друзья и своё комьюнити.</p></article>
                <article class="camp-card camp-reveal"><span class="camp-card__eyebrow">FREEDOM</span><p>Море, солнце, движение и настоящие эмоции.</p></article>
                <article class="camp-card camp-reveal"><span class="camp-card__eyebrow">GROWTH</span><p>Уверенность и самостоятельность.</p></article>
            </div>
        </div>
    </section>

    <section class="camp-section camp-gallery" id="camp-gallery">
        <div class="camp-container">
            <span class="camp-kicker">Photo / video gallery</span>
            <h2 class="camp-title camp-title--light"><span>Вот так</span><span>выглядит LITO 💛</span></h2>
            <div class="camp-gallery__grid">
                <?php foreach (array_slice($camp_images, 0, 6) as $index => $image) : ?>
                    <div class="camp-gallery__item <?php echo $index === 0 || $index === 4 ? 'camp-gallery__item--big' : ''; ?> camp-reveal">
                        <img src="<?php echo esc_url($image); ?>" alt="Атмосфера LITO DANCE CAMP" loading="lazy">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="camp-section camp-hotel">
        <div class="camp-container camp-split">
            <div class="camp-hotel__photo camp-reveal"><img src="<?php echo esc_url($camp_images[8]); ?>" alt="Hotel Don Angel в Santa Susanna" loading="lazy"></div>
            <div class="camp-reveal">
                <span class="camp-kicker">Где мы живём</span>
                <h2 class="camp-title"><span><?php echo esc_html($camp_data['hotel']); ?></span><span><?php echo esc_html($camp_data['hotel_stars']); ?></span></h2>
                <p class="camp-copy">Santa Susanna, Spain 🇪🇸</p>
                <ul class="camp-list">
                    <li><span>🏨</span><span>Hotel 4★ и организованное проживание участников лагеря.</span></li>
                    <li><span>📍</span><span>Santa Susanna, Spain.</span></li>
                    <li><span>🍽</span><span>Трёхразовое питание, buffet.</span></li>
                    <li><span>💃</span><span>Ежедневные танцевальные занятия и активности.</span></li>
                </ul>
                <button type="button" class="camp-btn mt-4" data-bs-toggle="modal" data-bs-target="#camp_booking_modal" data-camp-cta="hotel" data-camp-event="camp_booking_click">УЗНАТЬ БОЛЬШЕ →</button>
            </div>
        </div>
    </section>

    <section class="camp-section camp-prices" id="camp-prices">
        <div class="camp-container">
            <span class="camp-kicker">Prices</span>
            <h2 class="camp-title"><span>Выбери</span><span>своё лето</span></h2>
            <div class="camp-price-grid">
                <article class="camp-price camp-price--muted camp-reveal"><span class="camp-price__status">SOLD OUT</span><h3>PRE-SALE</h3><p class="camp-price__amount">€1190</p><p>Первые 10 мест.</p><span class="camp-price__stamp">SOLD OUT</span></article>
                <article class="camp-price camp-price--active camp-reveal"><span class="camp-price__badge">MOST POPULAR</span><span class="camp-price__status">ACTIVE</span><h3>REGULAR</h3><p class="camp-price__amount">€<?php echo esc_html($camp_data['regular_price']); ?></p><p>Текущий основной тариф. Предоплата €<?php echo esc_html($camp_data['deposit']); ?>.</p><button type="button" class="camp-btn camp-btn--dark" data-bs-toggle="modal" data-bs-target="#camp_booking_modal" data-camp-cta="regular_price" data-camp-event="camp_regular_click">ЗАБРОНИРОВАТЬ →</button></article>
                <article class="camp-price camp-reveal"><span class="camp-price__status">NEXT</span><h3>LATE TICKET</h3><p class="camp-price__amount">€1590</p><p>При наличии свободных мест.</p></article>
            </div>
            <p class="camp-price-note">🚌 <?php echo esc_html($camp_data['bus_note']); ?>. Количество мест ограничено.</p>
        </div>
    </section>

    <section class="camp-section camp-deposit">
        <div class="camp-container camp-deposit__box camp-reveal">
            <div>
                <span class="camp-kicker">Deposit</span>
                <h2 class="camp-title"><span>Не нужно платить</span><span>всю сумму сразу</span></h2>
                <p class="camp-copy">предоплата для бронирования места</p>
                <button type="button" class="camp-btn" data-bs-toggle="modal" data-bs-target="#camp_booking_modal" data-camp-cta="deposit" data-camp-event="camp_booking_click">ЗАБРОНИРОВАТЬ МЕСТО</button>
            </div>
            <div class="camp-deposit__amount">€<?php echo esc_html($camp_data['deposit']); ?></div>
        </div>
    </section>

    <section class="camp-section camp-safety">
        <div class="camp-container">
            <span class="camp-kicker">For parents</span>
            <h2 class="camp-title"><span>А как же</span><span>безопасность?</span></h2>
            <p class="camp-copy">Пока дети отдыхают, родители должны быть спокойны.</p>
            <div class="camp-card-grid">
                <article class="camp-card camp-reveal"><span class="camp-card__eyebrow">КОМАНДА ВЗРОСЛЫХ</span><p>Дети находятся под присмотром команды лагеря.</p></article>
                <article class="camp-card camp-reveal"><span class="camp-card__eyebrow">INSURANCE</span><p>Медицинская страховка включена.</p></article>
                <article class="camp-card camp-reveal"><span class="camp-card__eyebrow">HOTEL 4★</span><p>Организованное проживание группы.</p></article>
                <article class="camp-card camp-reveal"><span class="camp-card__eyebrow">ПИТАНИЕ</span><p>Трёхразовое питание каждый день.</p></article>
                <article class="camp-card camp-reveal"><span class="camp-card__eyebrow">DIGITAL DETOX</span><p>Отдых от постоянного использования телефонов и социальных сетей.</p></article>
                <article class="camp-card camp-reveal"><span class="camp-card__eyebrow">СВЯЗЬ С РОДИТЕЛЯМИ</span><p>Команда заранее согласует канал новостей и связи с детьми.</p></article>
            </div>
        </div>
    </section>

    <section class="camp-section camp-day">
        <div class="camp-container">
            <span class="camp-kicker">A day at LITO</span>
            <h2 class="camp-title"><span>Один день</span><span>в LITO</span></h2>
            <div class="camp-timeline">
                <?php foreach ([['08:30', '☀️ Завтрак'], ['10:00', '💃 Dance Class'], ['12:00', '🌊 Море'], ['14:00', '🍉 Обед'], ['16:00', '💃 Dance / Activities'], ['19:00', '🍽 Ужин'], ['20:30', '🎉 Party / Games / Disco']] as $row) : ?>
                    <div class="camp-timeline__item camp-reveal"><span class="camp-timeline__time"><?php echo esc_html($row[0]); ?></span><span><?php echo esc_html($row[1]); ?></span></div>
                <?php endforeach; ?>
            </div>
            <p class="camp-price-note">Пример одного дня. Финальная программа может меняться.</p>
        </div>
    </section>

    <section class="camp-section camp-reviews">
        <div class="camp-container">
            <span class="camp-kicker">Social proof</span>
            <h2 class="camp-title"><span>Родители</span><span>уже отпускали 💛</span></h2>
            <?php if ($camp_reviews) : ?>
                <div class="camp-card-grid">
                    <?php foreach ($camp_reviews as $review) : ?>
                        <article class="camp-card camp-reveal"><span class="camp-card__eyebrow"><?php echo esc_html($review['name']); ?></span><p><?php echo esc_html($review['text']); ?></p></article>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="camp-empty-proof camp-reveal">Реальные отзывы родителей будут добавлены после подтверждения текстов. Мы не публикуем вымышленные истории.</div>
            <?php endif; ?>
        </div>
    </section>

    <section class="camp-section camp-faq">
        <div class="camp-container">
            <span class="camp-kicker">FAQ</span>
            <h2 class="camp-title camp-title--light"><span>Вопросы</span><span>родителей</span></h2>
            <div class="camp-faq__list">
                <?php foreach ($camp_faq as $index => $faq) : ?>
                    <div class="camp-faq__item">
                        <button type="button" class="camp-faq__question" aria-expanded="false" aria-controls="camp-faq-<?php echo esc_attr((string) $index); ?>"><span><?php echo esc_html($faq[0]); ?></span><span data-faq-icon>+</span></button>
                        <div class="camp-faq__answer" id="camp-faq-<?php echo esc_attr((string) $index); ?>"><?php echo esc_html($faq[1]); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="camp-section camp-final">
        <div class="camp-container">
            <span class="camp-kicker">Final call</span>
            <h2 class="camp-title camp-title--light"><span>Лето</span><span>начинается</span><span>здесь.</span></h2>
            <div class="camp-final__info">
                <span class="camp-pill">🇪🇸 Santa Susanna</span>
                <span class="camp-pill"><?php echo esc_html($camp_data['dates_short']); ?></span>
                <span class="camp-pill">REGULAR TICKET - €<?php echo esc_html($camp_data['regular_price']); ?></span>
                <span class="camp-pill">Для бронирования - €<?php echo esc_html($camp_data['deposit']); ?></span>
            </div>
            <button type="button" class="camp-btn" data-bs-toggle="modal" data-bs-target="#camp_booking_modal" data-camp-cta="final" data-camp-event="camp_booking_click">ХОЧУ В LITO →</button>
            <p class="camp-hero__deposit">Количество мест ограничено</p>
        </div>
    </section>

    <div class="camp-sticky" aria-live="polite">
        <span class="camp-sticky__price">€<?php echo esc_html($camp_data['regular_price']); ?> · Предоплата €<?php echo esc_html($camp_data['deposit']); ?></span>
        <button type="button" class="camp-btn" data-bs-toggle="modal" data-bs-target="#camp_booking_modal" data-camp-cta="sticky" data-camp-event="camp_booking_click">ЗАБРОНИРОВАТЬ</button>
    </div>
</div>

<div class="modal fade camp-booking-modal" id="camp_booking_modal" tabindex="-1" aria-labelledby="camp_booking_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="camp_booking_modal_label">Забронировать LITO DANCE CAMP 2027</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form class="camp-booking-form" id="camp-booking-form" novalidate>
                    <input type="hidden" name="camp" value="LITO DANCE CAMP 2027">
                    <label>Имя родителя <input type="text" name="parent_name" autocomplete="name" required></label>
                    <label>Имя ребёнка <input type="text" name="child_name" required></label>
                    <label>Возраст ребёнка <input type="number" name="child_age" min="5" max="18" required></label>
                    <label>Телефон <input type="tel" name="phone" autocomplete="tel" required></label>
                    <label>Email <input type="email" name="email" autocomplete="email" required></label>
                    <label>WhatsApp / Telegram <input type="text" name="messenger" placeholder="@username или номер"></label>
                    <label class="is-full">Город <input type="text" name="city" autocomplete="address-level2"></label>
                    <label class="is-full">Комментарий <textarea name="comment" rows="4"></textarea></label>
                    <div class="camp-form-status" role="status" aria-live="polite"></div>
                    <button type="submit" class="camp-btn is-full">ЗАБРОНИРОВАТЬ МЕСТО</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$BsWp->get_template_parts([
    'parts/shared/footer',
    'parts/shared/cookiebar',
    'parts/shared/html-footer'
]);
?>
