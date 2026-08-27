<?php

/**
 * Template name: Dance Camp
 *
 * Landing page for DDC Spain Dance Camp — Summer 2026.
 *
 * @package     WordPress
 * @subpackage  Bootstrap 5.3.2
 * @autor       ddc_nl
 */

$BsWp = new BsWp;

add_action('wp_head', function () {
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
    /* ================================================
       DDC SPAIN CAMP — PAGE STYLES  (Summer palette)
       Ocean navy #023e8a · Sky #00b4d8 · Foam #caf0f8
       Sea-green #52b788 · Mint #d8f3dc · Sun #fec601
    ================================================ */


    /* ---------- RESET / BASE ---------- */
    .camp-page section {
        position: relative;
        overflow: hidden;
        padding: 90px 0;
        border-top: 4px solid rgba(0,180,216,0.25);
    }

    /* ---------- HERO ---------- */
    #camp-hero {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        border-top: none;
        padding: 0;
        background-color: #023e8a;
    }

    .camp-hero-bg {
        position: absolute;
        inset: 0;
        z-index: 0;
        background: linear-gradient(
            160deg,
            #03045e 0%,
            #0077b6 55%,
            #00b4d8 100%
        );
    }

    /* Slot for hero background photo — replace background-image when ready */
    .camp-hero-bg.has-photo {
        background-size: cover;
        background-position: center;
    }

    .camp-hero-bg::after {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse at 20% 80%, rgba(0,180,216,0.35) 0%, transparent 50%),
            radial-gradient(ellipse at 80% 15%, rgba(254,198,1,0.2) 0%, transparent 45%),
            radial-gradient(ellipse at 50% 50%, rgba(82,183,136,0.12) 0%, transparent 60%);
    }

    .camp-hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        padding: 2rem 1rem;
    }

    .camp-eyebrow {
        display: inline-block;
        font-size: 0.8rem;
        letter-spacing: 5px;
        text-transform: uppercase;
        color: #fec601;
        font-weight: 700;
        margin-bottom: 1.2rem;
        padding: 6px 16px;
        border: 1px solid rgba(254,198,1,0.4);
        border-radius: 50px;
        background: rgba(254,198,1,0.08);
    }

    .camp-hero-title {
        font-family: 'Oswald', sans-serif;
        font-size: 5.5rem;
        color: #fff;
        text-transform: uppercase;
        line-height: 0.9;
        font-weight: 700;
        margin-bottom: 0.4rem;
    }

    .camp-hero-title .highlight {
        color: #fec601;
        display: block;
        font-size: 9rem;
        opacity: 1;
    }

    .camp-hero-sub {
        font-size: 1.1rem;
        color: rgba(202,240,248,0.85);
        font-weight: 300;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 2.5rem;
        margin-top: 1rem;
    }

    .camp-hero-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        margin-bottom: 3rem;
    }

    .camp-tag {
        background-color: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.25);
        color: #fff;
        padding: 9px 20px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        backdrop-filter: blur(6px);
        transition: all 0.3s ease;
    }

    .camp-tag:hover {
        background-color: rgba(255,255,255,0.2);
        border-color: rgba(254,198,1,0.6);
        color: #fec601;
    }

    .camp-hero-vibe {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        color: rgba(202,240,248,0.5);
        font-size: 0.85rem;
        letter-spacing: 3px;
        text-transform: uppercase;
        margin-top: 1rem;
    }

    .camp-hero-vibe span {
        color: rgba(254,198,1,0.6);
    }

    .camp-scroll-arrow {
        position: absolute;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        z-index: 3;
        color: rgba(202,240,248,0.6);
        font-size: 1.8rem;
        animation: campBounce 2s ease infinite;
        cursor: default;
    }

    @keyframes campBounce {
        0%, 100% { transform: translateX(-50%) translateY(0); }
        50% { transform: translateX(-50%) translateY(10px); }
    }

    /* ---------- PRICING / EARLY BIRD ---------- */
    #camp-pricing {
        background: linear-gradient(160deg, #fff8e7 0%, #fffef8 60%, #f0fbff 100%);
        color: #111;
    }

    #camp-pricing::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at 50% 0%, rgba(254,198,1,0.12) 0%, transparent 60%);
        pointer-events: none;
    }

    .camp-section-label {
        display: block;
        font-size: 0.75rem;
        letter-spacing: 4px;
        text-transform: uppercase;
        font-weight: 700;
        color: #0096c7;
        margin-bottom: 0.6rem;
    }

    .camp-section-title {
        font-family: 'Oswald', sans-serif;
        font-size: 4.5rem;
        text-transform: uppercase;
        line-height: 0.95;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .camp-section-title.on-dark  { color: #fff; }
    .camp-section-title.on-light { color: #023e8a; }
    .camp-section-title.yellow   { color: #fec601; }

    /* Countdown */
    .camp-countdown-wrap {
        margin-bottom: 3rem;
    }

    .camp-countdown-note {
        font-size: 0.8rem;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: rgba(0,0,0,0.45);
        margin-bottom: 1.5rem;
    }

    .camp-countdown {
        display: flex;
        justify-content: center;
        gap: 16px;
    }

    .cd-unit {
        text-align: center;
        background: rgba(254,198,1,0.1);
        border: 1px solid rgba(254,198,1,0.4);
        border-radius: 14px;
        padding: 18px 24px;
        min-width: 85px;
        transition: border-color 0.3s ease, background 0.3s ease;
    }

    .cd-unit:hover {
        background: rgba(254,198,1,0.18);
        border-color: #fec601;
    }

    .cd-unit .cd-num {
        font-family: 'Six Caps', sans-serif;
        font-size: 4.5rem;
        color: #fec601;
        line-height: 1;
        display: block;
    }

    .cd-unit .cd-label {
        font-size: 0.65rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: rgba(0,0,0,0.45);
        margin-top: 4px;
        display: block;
    }

    /* Price cards */
    .pricing-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        max-width: 820px;
        margin: 0 auto 2rem;
    }

    .price-card {
        border-radius: 22px;
        padding: 2.5rem 2rem;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .price-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 24px 48px rgba(0,0,0,0.15);
    }

    .price-card.is-early {
        background: linear-gradient(135deg, #fec601 0%, #ffd84a 100%);
        color: #111;
    }

    .price-card.is-late {
        background: linear-gradient(135deg, #0077b6 0%, #00b4d8 100%);
        color: #fff;
    }

    .price-card-badge {
        font-size: 0.7rem;
        letter-spacing: 3px;
        text-transform: uppercase;
        font-weight: 700;
        margin-bottom: 0.6rem;
        display: block;
        opacity: 0.75;
    }

    .price-card-date {
        font-size: 0.8rem;
        font-weight: 700;
        padding: 4px 14px;
        border-radius: 20px;
        display: inline-block;
        margin-bottom: 1.8rem;
    }

    .price-card.is-early .price-card-date {
        background: rgba(0,0,0,0.12);
        color: #111;
    }

    .price-card.is-late .price-card-date {
        background: rgba(255,255,255,0.18);
        color: rgba(255,255,255,0.85);
    }

    .price-row {
        display: flex;
        align-items: baseline;
        gap: 10px;
        margin-bottom: 0.9rem;
    }

    .price-row .who {
        font-size: 0.9rem;
        font-weight: 600;
        min-width: 80px;
    }

    .price-row .amount {
        font-family: 'Six Caps', sans-serif;
        font-size: 4rem;
        line-height: 1;
        font-weight: 400;
    }

    .price-card.is-early .amount { color: #111; }
    .price-card.is-late .amount  { color: rgba(255,255,255,0.45); text-decoration: line-through; }

    .price-card-fire {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        font-size: 2rem;
        animation: priceFire 1.5s ease infinite alternate;
    }

    @keyframes priceFire {
        from { transform: scale(1) rotate(-5deg); }
        to { transform: scale(1.15) rotate(5deg); }
    }

    .price-card-note {
        font-size: 0.75rem;
        opacity: 0.55;
        margin-top: 1.2rem;
        line-height: 1.5;
    }

    .price-flight-note {
        text-align: center;
        font-size: 0.85rem;
        color: rgba(0,0,0,0.5);
        padding: 12px 20px;
        border: 1px dashed rgba(0,150,199,0.35);
        border-radius: 12px;
        max-width: 500px;
        margin: 0 auto;
    }

    /* ---------- INCLUDED ---------- */
    #camp-included {
        background: linear-gradient(135deg, #e0f7fa 0%, #caf0f8 60%, #d8f3dc 100%);
        color: #111;
    }

    .included-list {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-top: 3rem;
    }

    .inc-item {
        background: rgba(255,255,255,0.75);
        border: 1px solid rgba(0,180,216,0.2);
        border-left: 4px solid #00b4d8;
        border-radius: 0 14px 14px 0;
        padding: 1.5rem 1.4rem;
        backdrop-filter: blur(4px);
        transition: background 0.3s ease, transform 0.3s ease;
    }

    .inc-item:hover {
        background: rgba(255,255,255,0.95);
        transform: translateX(4px);
    }

    .inc-item .inc-icon {
        font-size: 1.8rem;
        display: block;
        margin-bottom: 0.6rem;
    }

    .inc-item .inc-text {
        font-size: 0.95rem;
        color: #1a3a4a;
        line-height: 1.5;
        font-weight: 500;
    }

    /* ---------- BENEFITS ---------- */
    #camp-benefits {
        background: #fff;
        color: #111;
    }

    .benefits-intro {
        font-family: 'Oswald', sans-serif;
        font-size: 1.5rem;
        color: rgba(0,119,182,0.25);
        text-transform: uppercase;
        letter-spacing: 3px;
        margin-bottom: 2.5rem;
        font-weight: 600;
    }

    .benefits-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    .benefit-card {
        border-radius: 20px;
        padding: 2.2rem;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .benefit-card:hover {
        transform: scale(1.02);
    }

    .benefit-card:nth-child(1) { background: linear-gradient(135deg, #0077b6 0%, #00b4d8 100%); color: #fff; }
    .benefit-card:nth-child(2) { background: linear-gradient(135deg, #fec601 0%, #ffd84a 100%); color: #111; }
    .benefit-card:nth-child(3) { background: linear-gradient(135deg, #52b788 0%, #74c69d 100%); color: #fff; }
    .benefit-card:nth-child(4) { background: linear-gradient(135deg, #023e8a 0%, #0077b6 100%); color: #fff; }

    .benefit-card .b-emoji {
        font-size: 2.5rem;
        display: block;
        margin-bottom: 0.9rem;
    }

    .benefit-card .b-title {
        font-family: 'Oswald', sans-serif;
        font-size: 2rem;
        text-transform: uppercase;
        line-height: 1;
        margin-bottom: 0.7rem;
        font-weight: 700;
    }

    .benefit-card .b-text {
        font-size: 0.9rem;
        line-height: 1.7;
        opacity: 0.85;
        margin: 0;
    }

    /* ---------- PHOTO GALLERY ---------- */
    #camp-photos {
        background: linear-gradient(135deg, #e8f5e9 0%, #e0f7fa 100%);
        color: #111;
    }

    .photos-mosaic {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        grid-template-rows: 260px 260px 260px;
        gap: 10px;
        margin-top: 2.5rem;
    }

    .photo-slot {
        border-radius: 14px;
        background: rgba(255,255,255,0.6);
        border: 2px dashed rgba(0,180,216,0.35);
        overflow: hidden;
        position: relative;
        transition: border-color 0.3s ease, background 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 8px;
        color: rgba(0,119,182,0.45);
        font-size: 0.75rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        cursor: default;
    }

    .photo-slot:hover {
        border-color: #00b4d8;
        background: rgba(255,255,255,0.85);
    }

    .photo-slot.large {
        grid-row: span 2;
    }

    .photo-slot img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
    }

    .photo-slot .ph-icon {
        font-size: 2rem;
        opacity: 0.45;
        display: block;
    }

    /* ---------- HOTEL ---------- */
    #camp-hotel {
        background: linear-gradient(135deg, #ffffff 0%, #e0f7fa 50%, #ffffff 100%);
        color: #111;
    }

    .hotel-photo-slot {
        border-radius: 22px;
        background: #caf0f8;
        border: 2px dashed rgba(0,180,216,0.3);
        height: 420px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 10px;
        color: rgba(0,100,150,0.45);
        font-size: 0.8rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        overflow: hidden;
        position: relative;
    }

    .hotel-photo-slot img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 20px;
    }

    .hotel-stars { color: #fec601; font-size: 1.3rem; letter-spacing: 3px; }

    .hotel-info-list {
        list-style: none;
        padding: 0;
        margin: 2rem 0 0;
    }

    .hotel-info-list li {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 14px 0;
        border-bottom: 1px solid rgba(0,180,216,0.15);
        font-size: 1rem;
        line-height: 1.5;
    }

    .hotel-info-list li:last-child { border-bottom: none; }

    .hotel-info-list .hi-icon {
        font-size: 1.3rem;
        min-width: 30px;
    }

    /* ---------- CTA ---------- */
    #camp-cta {
        background: linear-gradient(135deg, #03045e 0%, #0077b6 55%, #00b4d8 100%);
        color: #fff;
        text-align: center;
    }

    #camp-cta::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse at 30% 80%, rgba(82,183,136,0.2) 0%, transparent 50%),
            radial-gradient(ellipse at 70% 10%, rgba(254,198,1,0.15) 0%, transparent 45%);
        pointer-events: none;
    }

    #camp-cta > .container { position: relative; z-index: 1; }

    .cta-big {
        font-family: 'Oswald', sans-serif;
        font-size: 7rem;
        color: #fec601;
        text-transform: uppercase;
        line-height: 0.9;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .cta-sub {
        font-size: 1.1rem;
        color: rgba(202,240,248,0.85);
        margin-bottom: 2.5rem;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .cta-note {
        font-size: 0.85rem;
        color: rgba(202,240,248,0.5);
        margin-top: 1.5rem;
    }

    /* ---------- FADE-UP ANIMATIONS ---------- */
    .c-fade {
        opacity: 0;
        transform: translateY(28px);
        transition: opacity 0.65s ease, transform 0.65s ease;
    }

    .c-fade.in-view { opacity: 1; transform: translateY(0); }
    .c-fade:nth-child(2) { transition-delay: 0.1s; }
    .c-fade:nth-child(3) { transition-delay: 0.2s; }
    .c-fade:nth-child(4) { transition-delay: 0.3s; }
    .c-fade:nth-child(5) { transition-delay: 0.4s; }
    .c-fade:nth-child(6) { transition-delay: 0.5s; }

    /* ---------- SUN ANIMATION ---------- */
    .camp-sun {
        position: absolute;
        top: 9%;
        right: 7%;
        width: 150px;
        height: 150px;
        z-index: 2;
        pointer-events: none;
        user-select: none;
    }

    .camp-sun svg {
        width: 100%;
        height: 100%;
        overflow: visible;
        animation: campSunGlow 3s ease-in-out infinite;
    }

    .camp-sun-rays {
        transform-origin: 100px 100px;
        animation: campSunSpin 10s linear infinite;
    }

    @keyframes campSunSpin {
        from { transform: rotate(0deg); }
        to   { transform: rotate(360deg); }
    }

    @keyframes campSunGlow {
        0%, 100% { filter: drop-shadow(0 0 8px rgba(254,198,1,0.55)); }
        50%       { filter: drop-shadow(0 0 24px rgba(254,198,1,1)); }
    }

    /* ---------- CLOUDS ---------- */
    .hero-clouds,
    .hero-seagulls {
        position: absolute;
        inset: 0;
        z-index: 1;
        pointer-events: none;
        overflow: hidden;
    }

    .hero-cloud { position: absolute; line-height: 0; }
    .hero-cloud svg { display: block; }

    .hero-cloud--1 { top: 8%;  width: 260px; opacity: 0.22; animation: cloudGoRight 36s linear infinite; }
    .hero-cloud--2 { top: 22%; width: 155px; opacity: 0.15; animation: cloudGoLeft  24s linear infinite; animation-delay: -8s; }
    .hero-cloud--3 { top: 5%;  width: 360px; opacity: 0.1;  animation: cloudGoRight 50s linear infinite; animation-delay: -22s; }
    .hero-cloud--4 { top: 33%; width: 120px; opacity: 0.17; animation: cloudGoLeft  19s linear infinite; animation-delay: -5s; }
    .hero-cloud--5 { top: 15%; width: 210px; opacity: 0.13; animation: cloudGoRight 32s linear infinite; animation-delay: -15s; }

    @keyframes cloudGoRight {
        from { transform: translateX(-520px); }
        to   { transform: translateX(calc(100vw + 520px)); }
    }
    @keyframes cloudGoLeft {
        from { transform: translateX(calc(100vw + 320px)); }
        to   { transform: translateX(-320px); }
    }

    /* ---------- SEAGULLS ---------- */
    .hero-seagull { position: absolute; line-height: 0; }

    .hero-seagull svg {
        display: block;
        animation: seagullFlap 0.85s ease-in-out infinite;
        transform-origin: 50% 80%;
    }
    @keyframes seagullFlap {
        0%, 100% { transform: scaleY(1); }
        50%      { transform: scaleY(0.22); }
    }

    .hero-seagull--1 { top: 18%; opacity: 0.65; width: 46px; animation: birdGlide1 22s linear infinite; }
    .hero-seagull--2 { top: 26%; opacity: 0.45; width: 28px; animation: birdGlide2 30s linear infinite; animation-delay: -12s; }
    .hero-seagull--3 { top: 12%; opacity: 0.55; width: 34px; animation: birdGlide1 17s linear infinite; animation-delay: -7s; }
    .hero-seagull--4 { top: 36%; opacity: 0.35; width: 20px; animation: birdGlide2 26s linear infinite; animation-delay: -3s; }
    .hero-seagull--5 { top: 21%; opacity: 0.58; width: 88px; animation: birdGlide1 28s linear infinite; animation-delay: -18s; }

    @keyframes birdGlide1 {
        0%   { transform: translateX(-120px) translateY(0px); }
        25%  { transform: translateX(25vw)   translateY(-14px); }
        55%  { transform: translateX(55vw)   translateY(9px); }
        80%  { transform: translateX(82vw)   translateY(-7px); }
        100% { transform: translateX(calc(100vw + 120px)) translateY(0px); }
    }
    @keyframes birdGlide2 {
        0%   { transform: translateX(calc(100vw + 100px)) translateY(0px); }
        25%  { transform: translateX(75vw)   translateY(-12px); }
        55%  { transform: translateX(42vw)   translateY(8px); }
        80%  { transform: translateX(18vw)   translateY(-9px); }
        100% { transform: translateX(-100px) translateY(0px); }
    }

    /* ---------- HERO WAVE ---------- */
    .hero-wave {
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        z-index: 2;
        pointer-events: none;
        line-height: 0;
    }
    .hero-wave svg { width: 100%; height: auto; display: block; }

    /* ---------- SHIMMER ON ЛЕТО ---------- */
    .camp-hero-title .highlight {
        background: linear-gradient(90deg, #fec601 0%, #ffe580 35%, #fffacc 50%, #ffe580 65%, #fec601 100%);
        background-size: 220% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: shimmerTitle 4s linear infinite;
    }
    @keyframes shimmerTitle {
        from { background-position: 0% center; }
        to   { background-position: 220% center; }
    }

    /* ---------- RESPONSIVE ---------- */
    @media (max-width: 991px) {
        .camp-hero-title { font-size: 4rem; }
        .camp-hero-title .highlight { font-size: 6.5rem; }
        .camp-section-title { font-size: 3.5rem; }
        .pricing-grid { grid-template-columns: 1fr; max-width: 100%; }
        .included-list { grid-template-columns: repeat(2, 1fr); }
        .cta-big { font-size: 5rem; }
        .photos-mosaic {
            grid-template-columns: 1fr 1fr;
            grid-template-rows: auto;
        }
        .photo-slot.large { grid-row: span 1; }
        .camp-sun { width: 110px; height: 110px; top: 8%; right: 5%; }
    }

    @media (max-width: 767px) {
        .camp-page section { padding: 60px 0; }
        .camp-hero-title { font-size: 2.6rem; }
        .camp-hero-title .highlight { font-size: 4.5rem; }
        .camp-section-title { font-size: 2.5rem; }
        .camp-eyebrow { letter-spacing: 2px; font-size: 0.68rem; }
        .camp-hero-sub { font-size: 0.9rem; letter-spacing: 1px; }
        .camp-hero-content { padding: 2rem 1.2rem; }
        .camp-countdown { gap: 8px; }
        .cd-unit { padding: 10px 12px; min-width: 62px; }
        .cd-unit .cd-num { font-size: 2.4rem; }
        .benefits-grid { grid-template-columns: 1fr; }
        .photos-mosaic {
            grid-template-columns: 1fr 1fr;
            grid-template-rows: repeat(5, 160px);
        }
        .photo-slot.large { grid-column: span 2; }
        .included-list { grid-template-columns: 1fr; }
        .hotel-photo-slot { height: 240px; }
        .cta-big { font-size: 3rem; }
        .camp-hero-tags { gap: 6px; }
        .camp-tag { font-size: 0.72rem; padding: 6px 12px; }
        .pricing-grid { max-width: 100%; }
        .price-row .amount { font-size: 3rem; }
        .camp-sun { width: 76px; height: 76px; top: 5%; right: 3%; }
    }

    @media (max-width: 400px) {
        .camp-hero-title { font-size: 2.2rem; }
        .camp-hero-title .highlight { font-size: 3.8rem; }
        .cta-big { font-size: 2.5rem; }
        .camp-sun { width: 60px; height: 60px; top: 4%; right: 2%; }
    }
    </style>
    <?php
});

add_action('wp_footer', function () {
    ?>
    <script>
    (function () {
        // Countdown to March 15
        function runCountdown() {
            var deadline = new Date('2026-03-15T23:59:59');
            function tick() {
                var now = new Date();
                var diff = deadline - now;
                if (diff < 0) diff = 0;
                var d = Math.floor(diff / 86400000);
                var h = Math.floor((diff % 86400000) / 3600000);
                var m = Math.floor((diff % 3600000) / 60000);
                var s = Math.floor((diff % 60000) / 1000);
                var pad = function(n){ return n < 10 ? '0'+n : n; };
                var el = function(id){ return document.getElementById(id); };
                el('cd-days')  && (el('cd-days').textContent  = d);
                el('cd-hours') && (el('cd-hours').textContent = pad(h));
                el('cd-mins')  && (el('cd-mins').textContent  = pad(m));
                el('cd-secs')  && (el('cd-secs').textContent  = pad(s));
                if (diff > 0) setTimeout(tick, 1000);
            }
            tick();
        }
        runCountdown();

        // Scroll fade-up
        function checkFade() {
            document.querySelectorAll('.c-fade').forEach(function(el) {
                if (el.getBoundingClientRect().top < window.innerHeight - 50) {
                    el.classList.add('in-view');
                }
            });
        }
        var mainEl = document.getElementById('main');
        (mainEl || window).addEventListener('scroll', checkFade, { passive: true });
        checkFade();
    })();
    </script>
    <?php
});

$BsWp->get_template_parts([
    'parts/shared/html-header',
    'parts/shared/header'
]);
?>

<div class="camp-page">

<!-- ========================================================
     HERO
======================================================== -->
<section id="camp-hero">
    <div class="camp-hero-bg"></div>
    <!-- Замените class на "camp-hero-bg has-photo" и добавьте стиль background-image когда будет фото -->

    <!-- Floating clouds -->
    <div class="hero-clouds" aria-hidden="true">
        <div class="hero-cloud hero-cloud--1">
            <svg viewBox="0 0 200 70" fill="white" xmlns="http://www.w3.org/2000/svg">
                <ellipse cx="100" cy="52" rx="88" ry="18"/><ellipse cx="65" cy="38" rx="38" ry="28"/><ellipse cx="108" cy="30" rx="50" ry="32"/><ellipse cx="155" cy="42" rx="36" ry="24"/>
            </svg>
        </div>
        <div class="hero-cloud hero-cloud--2">
            <svg viewBox="0 0 160 55" fill="white" xmlns="http://www.w3.org/2000/svg">
                <ellipse cx="80" cy="40" rx="72" ry="15"/><ellipse cx="55" cy="28" rx="30" ry="22"/><ellipse cx="95" cy="22" rx="42" ry="26"/><ellipse cx="130" cy="32" rx="26" ry="18"/>
            </svg>
        </div>
        <div class="hero-cloud hero-cloud--3">
            <svg viewBox="0 0 260 80" fill="white" xmlns="http://www.w3.org/2000/svg">
                <ellipse cx="130" cy="60" rx="118" ry="20"/><ellipse cx="85" cy="44" rx="50" ry="36"/><ellipse cx="140" cy="35" rx="65" ry="40"/><ellipse cx="200" cy="48" rx="48" ry="30"/>
            </svg>
        </div>
        <div class="hero-cloud hero-cloud--4">
            <svg viewBox="0 0 120 45" fill="white" xmlns="http://www.w3.org/2000/svg">
                <ellipse cx="60" cy="34" rx="52" ry="12"/><ellipse cx="42" cy="24" rx="26" ry="18"/><ellipse cx="72" cy="18" rx="34" ry="22"/><ellipse cx="96" cy="28" rx="22" ry="15"/>
            </svg>
        </div>
        <div class="hero-cloud hero-cloud--5">
            <svg viewBox="0 0 180 62" fill="white" xmlns="http://www.w3.org/2000/svg">
                <ellipse cx="90" cy="46" rx="80" ry="16"/><ellipse cx="60" cy="32" rx="35" ry="26"/><ellipse cx="100" cy="26" rx="46" ry="30"/><ellipse cx="145" cy="36" rx="32" ry="22"/>
            </svg>
        </div>
    </div>

    <!-- Seagulls -->
    <div class="hero-seagulls" aria-hidden="true">
        <div class="hero-seagull hero-seagull--1">
            <svg viewBox="0 0 60 26" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 16 C10 5,20 3,30 12 C40 3,50 5,58 16" stroke="white" stroke-width="3.5" fill="none" stroke-linecap="round"/>
            </svg>
        </div>
        <div class="hero-seagull hero-seagull--2">
            <svg viewBox="0 0 60 26" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 16 C10 5,20 3,30 12 C40 3,50 5,58 16" stroke="white" stroke-width="3.5" fill="none" stroke-linecap="round"/>
            </svg>
        </div>
        <div class="hero-seagull hero-seagull--3">
            <svg viewBox="0 0 60 26" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 16 C10 5,20 3,30 12 C40 3,50 5,58 16" stroke="white" stroke-width="3.5" fill="none" stroke-linecap="round"/>
            </svg>
        </div>
        <div class="hero-seagull hero-seagull--4">
            <svg viewBox="0 0 60 26" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 16 C10 5,20 3,30 12 C40 3,50 5,58 16" stroke="white" stroke-width="3.5" fill="none" stroke-linecap="round"/>
            </svg>
        </div>
        <div class="hero-seagull hero-seagull--5">
            <svg viewBox="0 0 90 38" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 22 C10 10,18 8,24 16 C30 8,38 10,46 22" stroke="white" stroke-width="3" fill="none" stroke-linecap="round"/>
                <path d="M52 18 C58 9,64 7,70 14 C76 7,82 9,88 18" stroke="white" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                <path d="M22 32 C26 26,30 24,34 28 C38 24,42 26,46 32" stroke="white" stroke-width="2" fill="none" stroke-linecap="round"/>
            </svg>
        </div>
    </div>

    <!-- Animated smiling sun -->
    <div class="camp-sun" aria-hidden="true">
        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <radialGradient id="sunBodyGrad" cx="42%" cy="36%" r="65%">
                    <stop offset="0%" stop-color="#ffe066"/>
                    <stop offset="100%" stop-color="#fec601"/>
                </radialGradient>
            </defs>
            <!-- Rotating rays -->
            <g class="camp-sun-rays">
                <rect x="92" y="6"  width="16" height="40" rx="8" fill="#ffd84a"/>
                <rect x="92" y="6"  width="16" height="40" rx="8" fill="#ffd84a" transform="rotate(45 100 100)"/>
                <rect x="92" y="6"  width="16" height="40" rx="8" fill="#ffd84a" transform="rotate(90 100 100)"/>
                <rect x="92" y="6"  width="16" height="40" rx="8" fill="#ffd84a" transform="rotate(135 100 100)"/>
                <rect x="92" y="6"  width="16" height="40" rx="8" fill="#ffd84a" transform="rotate(180 100 100)"/>
                <rect x="92" y="6"  width="16" height="40" rx="8" fill="#ffd84a" transform="rotate(225 100 100)"/>
                <rect x="92" y="6"  width="16" height="40" rx="8" fill="#ffd84a" transform="rotate(270 100 100)"/>
                <rect x="92" y="6"  width="16" height="40" rx="8" fill="#ffd84a" transform="rotate(315 100 100)"/>
            </g>
            <!-- Body -->
            <circle cx="100" cy="100" r="58" fill="url(#sunBodyGrad)"/>
            <!-- Left eye -->
            <circle cx="82"  cy="90"  r="7"   fill="#3d2000"/>
            <circle cx="79"  cy="87"  r="2.5" fill="rgba(255,255,255,0.65)"/>
            <!-- Right eye -->
            <circle cx="118" cy="90"  r="7"   fill="#3d2000"/>
            <circle cx="115" cy="87"  r="2.5" fill="rgba(255,255,255,0.65)"/>
            <!-- Smile -->
            <path d="M 74 112 Q 100 140 126 112" stroke="#3d2000" stroke-width="5" fill="none" stroke-linecap="round"/>
            <!-- Rosy cheeks -->
            <circle cx="72"  cy="113" r="11" fill="rgba(255,100,60,0.22)"/>
            <circle cx="128" cy="113" r="11" fill="rgba(255,100,60,0.22)"/>
        </svg>
    </div>

    <div class="camp-hero-content">
        <span class="camp-eyebrow">Детский танцевальный лагерь DDC</span>

        <h1 class="camp-hero-title">
            Танцевальное
            <span class="highlight">Лето</span>
            в Испании
        </h1>

        <p class="camp-hero-sub">11 дней, которые дети будут вспоминать весь год</p>

        <div class="camp-hero-tags">
            <span class="camp-tag">📍 Льорет-де-Мар, Испания</span>
            <span class="camp-tag">📅 19–29 июля</span>
            <span class="camp-tag">🏨 Gran Garbí & AquaSplash 4★</span>
            <span class="camp-tag">11 дней / 10 ночей</span>
        </div>

        <button type="button" class="btn btn-primary btn-round magic-hover magic-hover__square" data-bs-toggle="modal" data-bs-target="#contact_form">
            <?php echo __('Забронировать место 👇', 'wp_denysmyr') ?>
        </button>

        <div class="camp-hero-vibe">
            Море <span>•</span> Танцы <span>•</span> Друзья <span>•</span> Эмоции
        </div>
    </div>

    <!-- Sea waves decoration -->
    <div class="hero-wave" aria-hidden="true">
        <svg viewBox="0 0 1440 100" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,55 C240,85 480,25 720,55 C960,85 1200,25 1440,55 L1440,100 L0,100 Z" fill="rgba(0,180,216,0.18)"/>
            <path d="M0,68 C180,45 360,82 540,62 C720,42 900,78 1080,60 C1200,48 1350,72 1440,65 L1440,100 L0,100 Z" fill="rgba(0,180,216,0.1)"/>
            <path d="M0,82 C300,68 600,90 900,76 C1100,66 1280,88 1440,80 L1440,100 L0,100 Z" fill="rgba(202,240,248,0.08)"/>
        </svg>
    </div>

    <div class="camp-scroll-arrow">↓</div>
</section>

<!-- ========================================================
     EARLY BIRD PRICING
======================================================== -->
<section id="camp-pricing" class="camp-section-dark">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-10">

                <span class="camp-section-label c-fade">Успей до 15 марта</span>
                <h2 class="camp-section-title on-light c-fade">🔥 Ранняя<br><span style="color:#fec601">Цена</span></h2>

                <div class="camp-countdown-wrap c-fade">
                    <p class="camp-countdown-note">Осталось до повышения цены</p>
                    <div class="camp-countdown">
                        <div class="cd-unit">
                            <span class="cd-num" id="cd-days">—</span>
                            <span class="cd-label">Дней</span>
                        </div>
                        <div class="cd-unit">
                            <span class="cd-num" id="cd-hours">—</span>
                            <span class="cd-label">Часов</span>
                        </div>
                        <div class="cd-unit">
                            <span class="cd-num" id="cd-mins">—</span>
                            <span class="cd-label">Минут</span>
                        </div>
                        <div class="cd-unit">
                            <span class="cd-num" id="cd-secs">—</span>
                            <span class="cd-label">Секунд</span>
                        </div>
                    </div>
                </div>

                <div class="pricing-grid c-fade">

                    <div class="price-card is-early">
                        <span class="price-card-fire">🔥</span>
                        <span class="price-card-badge">Ранняя цена</span>
                        <span class="price-card-date">До 15 марта</span>

                        <div class="price-row">
                            <span class="who">Ребёнок</span>
                            <span class="amount">1 059 €</span>
                        </div>
                        <div class="price-row">
                            <span class="who">Взрослый</span>
                            <span class="amount">759 €</span>
                        </div>

                        <p class="price-card-note">Количество мест ограничено — бронируй сейчас!</p>
                    </div>

                    <div class="price-card is-late">
                        <span class="price-card-badge">Стандартная цена</span>
                        <span class="price-card-date">С 15 марта</span>

                        <div class="price-row">
                            <span class="who">Ребёнок</span>
                            <span class="amount">1 159 €</span>
                        </div>
                        <div class="price-row">
                            <span class="who">Взрослый</span>
                            <span class="amount">859 €</span>
                        </div>

                        <p class="price-card-note">Цена повышается на 100 € после 15 марта</p>
                    </div>

                </div>

                <p class="price-flight-note c-fade">
                    ✈️ Перелёт оплачивается отдельно
                </p>

                <div class="mt-4 c-fade">
                    <button type="button" class="btn btn-primary btn-round magic-hover magic-hover__square" data-bs-toggle="modal" data-bs-target="#contact_form">
                        <?php echo __('Записаться по ранней цене 👇', 'wp_denysmyr') ?>
                    </button>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- ========================================================
     WHAT'S INCLUDED
======================================================== -->
<section id="camp-included">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <span class="camp-section-label c-fade">В стоимость входит</span>
                <h2 class="camp-section-title on-light c-fade">Всё<br><span style="color:#fec601">включено</span></h2>

                <div class="included-list">
                    <div class="inc-item c-fade">
                        <span class="inc-icon">🏨</span>
                        <span class="inc-text">Проживание в отеле 4★</span>
                    </div>
                    <div class="inc-item c-fade">
                        <span class="inc-icon">🍽️</span>
                        <span class="inc-text">Трёхразовое питание (шведский стол)</span>
                    </div>
                    <div class="inc-item c-fade">
                        <span class="inc-icon">💃</span>
                        <span class="inc-text">2–3 танцевальных занятия ежедневно</span>
                    </div>
                    <div class="inc-item c-fade">
                        <span class="inc-icon">🤸</span>
                        <span class="inc-text">Активности с вожатыми и хореографами</span>
                    </div>
                    <div class="inc-item c-fade">
                        <span class="inc-icon">🎉</span>
                        <span class="inc-text">Вечеринки и дискотеки каждый вечер</span>
                    </div>
                    <div class="inc-item c-fade">
                        <span class="inc-icon">🩺</span>
                        <span class="inc-text">Медицинская страховка</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- ========================================================
     WHAT KIDS GET
======================================================== -->
<section id="camp-benefits">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <span class="camp-section-label c-fade">Что получают дети</span>
                <h2 class="camp-section-title on-light c-fade">Зачем<br>ехать?</h2>
                <p class="benefits-intro c-fade">11 дней активного отдыха без телефонов</p>

                <div class="benefits-grid">
                    <div class="benefit-card c-fade">
                        <span class="b-emoji">💃</span>
                        <div class="b-title">Танцевальное<br>развитие</div>
                        <p class="b-text">Ежедневные занятия с профессиональными хореографами — шаги, стиль, уверенность на сцене.</p>
                    </div>
                    <div class="benefit-card c-fade">
                        <span class="b-emoji">🤝</span>
                        <div class="b-title">Новые<br>друзья</div>
                        <p class="b-text">Знакомства с детьми, которые разделяют одну страсть. Своё комьюнити на всю жизнь.</p>
                    </div>
                    <div class="benefit-card c-fade">
                        <span class="b-emoji">🌊</span>
                        <div class="b-title">Море &<br>свобода</div>
                        <p class="b-text">Солнце, пляж, средиземноморская атмосфера — отдых без гаджетов и настоящие эмоции.</p>
                    </div>
                    <div class="benefit-card c-fade">
                        <span class="b-emoji">⭐</span>
                        <div class="b-title">Уверенность<br>& рост</div>
                        <p class="b-text">Яркие воспоминания, новая мотивация, самостоятельность и характер победителя.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- ========================================================
     PHOTO GALLERY (placeholder)
======================================================== -->
<section id="camp-photos">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-11">

                <span class="camp-section-label c-fade">Атмосфера</span>
                <h2 class="camp-section-title on-light c-fade">📸 Моменты<br>лагеря</h2>

                <div class="photos-mosaic">
                    <div class="photo-slot large c-fade">
                        <img src="https://talentcenterddc.nl/wp-content/uploads/2026/03/camp-1.webp" alt="DDC Танцевальный лагерь Испания" loading="lazy">
                    </div>
                    <div class="photo-slot c-fade">
                        <img src="https://talentcenterddc.nl/wp-content/uploads/2026/03/camp-2.webp" alt="DDC Танцевальный лагерь" loading="lazy">
                    </div>
                    <div class="photo-slot c-fade">
                        <img src="https://talentcenterddc.nl/wp-content/uploads/2026/03/camp-3.webp" alt="DDC Танцевальный лагерь" loading="lazy">
                    </div>
                    <div class="photo-slot c-fade">
                        <img src="https://talentcenterddc.nl/wp-content/uploads/2026/03/camp-4.webp" alt="DDC Танцевальный лагерь" loading="lazy">
                    </div>
                    <div class="photo-slot c-fade">
                        <img src="https://talentcenterddc.nl/wp-content/uploads/2026/03/camp-5.webp" alt="DDC Танцевальный лагерь" loading="lazy">
                    </div>
                    <div class="photo-slot c-fade">
                        <img src="https://talentcenterddc.nl/wp-content/uploads/2026/03/camp-6.webp" alt="DDC Танцевальный лагерь" loading="lazy">
                    </div>
                    <div class="photo-slot c-fade">
                        <img src="https://talentcenterddc.nl/wp-content/uploads/2026/03/camp-7.webp" alt="DDC Танцевальный лагерь" loading="lazy">
                    </div>
                    <div class="photo-slot c-fade">
                        <img src="https://talentcenterddc.nl/wp-content/uploads/2026/03/camp-8.webp" alt="DDC Танцевальный лагерь" loading="lazy">
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- ========================================================
     HOTEL INFO
======================================================== -->
<section id="camp-hotel">
    <div class="container">
        <div class="row align-items-center gy-5">

            <div class="col-lg-6 c-fade">
                <div class="hotel-photo-slot">
                    <img src="https://talentcenterddc.nl/wp-content/uploads/2026/03/camp-9.webp" alt="Hotel Gran Garbí & AquaSplash">
                </div>
            </div>

            <div class="col-lg-6 c-fade">
                <span class="camp-section-label">Где мы живём</span>
                <h2 class="camp-section-title on-light">Hotel Gran<br>Garbí ★★★★</h2>
                <p style="color:#0077b6; font-size:0.9rem; font-weight:600; letter-spacing:1px; margin-bottom:1.5rem;">
                    C/ Potosí, 7 · Lloret de Mar · Costa Brava
                </p>

                <ul class="hotel-info-list">
                    <li>
                        <span class="hi-icon">📍</span>
                        <span>300 м от пляжа и центра Льорет-де-Мар — курорт Коста Брава, 55 км от Барселоны, пляжи Кала-Баньс и Фенальс рядом</span>
                    </li>
                    <li>
                        <span class="hi-icon">🛏️</span>
                        <span>268 современных номеров с балконом, кондиционером, спутниковым ТВ, феном, мини-баром и бесплатным Wi-Fi по всему отелю</span>
                    </li>
                    <li>
                        <span class="hi-icon">🏊</span>
                        <span>2 открытых бассейна с шезлонгами и зонтиками + 1 крытый с подогревом — идеально для детей и взрослых</span>
                    </li>
                    <li>
                        <span class="hi-icon">🌊</span>
                        <span>Бесплатный вход в аквапарк <strong>Garbí AquaSplash</strong> — горки до 9 м, детские аттракционы, в 50 м от отеля. Открыт всё лето</span>
                    </li>
                    <li>
                        <span class="hi-icon">🍽️</span>
                        <span>Шведский стол 3 раза в день: завтрак, обед и ужин — с show-cooking и летней террасой. Тематические вечера со средиземноморской кухней</span>
                    </li>
                    <li>
                        <span class="hi-icon">🎭</span>
                        <span>Ежедневная анимационная программа + <strong>Mini Club</strong> для детей 3–12 лет (июнь–сентябрь) — вечерние шоу, дискотеки, игры</span>
                    </li>
                    <li>
                        <span class="hi-icon">🏋️</span>
                        <span>Тренажёрный зал, игровая зона с аркадными автоматами, пинг-понг, бильярд, сады и большие лаунж-зоны</span>
                    </li>
                    <li>
                        <span class="hi-icon">🅿️</span>
                        <span>Бесплатная наружная парковка для гостей отеля (по наличию мест)</span>
                    </li>
                    <li>
                        <span class="hi-icon">📅</span>
                        <span><strong>19–29 июля 2026</strong> — 11 дней / 10 ночей</span>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</section>

<!-- ========================================================
     FINAL CTA
======================================================== -->
<section id="camp-cta">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-10">

                <h2 class="cta-big c-fade">
                    Едем<br>в Испанию!
                </h2>

                <p class="cta-sub c-fade">
                    Количество мест ограничено. Забронируй место по ранней цене до 15 марта и сэкономь 100 €!
                </p>

                <div class="c-fade">
                    <button type="button" class="btn btn-primary btn-round magic-hover magic-hover__square" data-bs-toggle="modal" data-bs-target="#contact_form">
                        <?php echo __('Хочу в лагерь! 🌊', 'wp_denysmyr') ?>
                    </button>
                </div>

                <p class="cta-note c-fade">✈️ Перелёт оплачивается отдельно</p>

            </div>
        </div>
    </div>
</section>

</div><!-- .camp-page -->

<?php
$BsWp->get_template_parts([
    'parts/modals/contact',
    'parts/shared/footer',
    'parts/shared/cookiebar',
    'parts/shared/html-footer'
]);
?>
