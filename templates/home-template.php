<?php

/**
 * Template name: Home
 *
 * @package    WordPress
 * @subpackage Bootstrap 5.3.2
 * @autor      ddc_nl
 */
$BsWp = new BsWp;
$render_hidden_home_sections = (bool) apply_filters('ddc_render_hidden_home_sections', false);

$BsWp->get_template_parts([
    'parts/shared/html-header',
    'parts/shared/header'
]);
?>

<!-- 1. HERO — Захват внимания, первичный CTA -->
<section id="intro" class="home-hero">
    <div class="video-wrap">
        <div class="video">
            <video muted autoplay loop playsinline preload="metadata">
                <source src="<?php echo get_template_directory_uri() ?>/videos/hero_intro.mp4" type="video/mp4" />
            </video>
        </div>
    </div>
    <div class="hero-content">
        <h1 class="hero-title">
            <span class="hero-title__line"><?php esc_html_e('Раскрой талант,', 'wp_denysmyr'); ?></span>
            <span class="hero-title__line"><?php esc_html_e('сделай жизнь', 'wp_denysmyr'); ?></span>
            <span class="hero-title__line hero-title__line--accent"><?php esc_html_e('ярче', 'wp_denysmyr'); ?></span>
        </h1>

        <div class="hero-card">
            <div class="hero-card__content">
                <span class="hero-card__eyebrow"><?php esc_html_e('Пробное занятие', 'wp_denysmyr'); ?></span>
                <strong><?php esc_html_e('Начни танцевать сегодня', 'wp_denysmyr'); ?></strong>
                <p><?php esc_html_e('Для детей от 4 лет, подростков и взрослых.', 'wp_denysmyr'); ?></p>
                <button type="button" class="hero-card__button" data-bs-toggle="modal" data-bs-target="#contact_form">
                    <span><?php esc_html_e('Записаться', 'wp_denysmyr'); ?></span>
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                </button>
            </div>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/images/kids-dance.jpg'); ?>" alt="<?php esc_attr_e('Танцы для детей Talent Center DDC', 'wp_denysmyr'); ?>" width="547" height="556">
        </div>
    </div>
    <aside class="social-rail" aria-label="<?php esc_attr_e('Социальные сети', 'wp_denysmyr'); ?>">
        <a href="https://www.facebook.com/talentcenterddc/" target="_blank" rel="noopener" aria-label="Facebook">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 8h3V4h-3c-3 0-5 2-5 5v2H6v4h3v7h4v-7h3l1-4h-4V9c0-.7.3-1 1-1Z"/></svg>
        </a>
        <a href="https://t.me/talentcenterddc" target="_blank" rel="noopener" aria-label="Telegram">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m21.4 4.6-3.1 14.7c-.2 1-1 1.2-1.8.7l-4.7-3.5-2.3 2.2c-.3.3-.5.5-1 .5l.3-4.8 8.8-8c.4-.3-.1-.5-.6-.2L6.1 13.1l-4.7-1.5c-1-.3-1-1 .2-1.5l18.3-7c.9-.3 1.7.2 1.5 1.5Z"/></svg>
        </a>
        <a href="https://www.youtube.com/channel/UCVzMFcw7IkqWvxmtdgBMnhQ" target="_blank" rel="noopener" aria-label="YouTube">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12c0-2.4-.3-4.1-.5-5-.2-.8-.8-1.4-1.6-1.6C18.4 5 12 5 12 5s-6.4 0-7.9.4C3.3 5.6 2.7 6.2 2.5 7 2.3 7.9 2 9.6 2 12s.3 4.1.5 5c.2.8.8 1.4 1.6 1.6 1.5.4 7.9.4 7.9.4s6.4 0 7.9-.4c.8-.2 1.4-.8 1.6-1.6.2-.9.5-2.6.5-5Zm-12 4V8l6 4-6 4Z"/></svg>
        </a>
        <a href="https://www.instagram.com/ddc_nl/" target="_blank" rel="noopener" aria-label="Instagram">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5Zm0 2a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3H7Zm11.5 1.5a1.25 1.25 0 1 1 0 2.5 1.25 1.25 0 0 1 0-2.5ZM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10Zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z"/></svg>
        </a>
    </aside>
</section>

<!-- 2. ПРЕИМУЩЕСТВА — Почему мы? Первый ответ на вопрос родителя -->
<section id="special_thanks">
    <div class="container">
        <div class="row align-items-center g-4 g-xl-5">
            <div class="col-12 col-lg-6">
                <div class="st-inner effect">
                    <span class="st-eyebrow"><?php echo __('Почему выбирают нас', 'wp_denysmyr'); ?></span>
                    <h2 class="st-heading"><?php echo __('ТАНЦЫ,<br>КОТОРЫЕ<br>РАСКРЫВАЮТ<br>ТАЛАНТ И<br>УВЕРЕННОСТЬ', 'wp_denysmyr'); ?></h2>
                    <ul class="st-features">
                        <li><?php echo __('Танцы для детей от 4 лет, подростков и взрослых', 'wp_denysmyr'); ?></li>
                        <li><?php echo __('Современные направления и программы', 'wp_denysmyr'); ?></li>
                        <li><?php echo __('Профессиональные и заботливые преподаватели', 'wp_denysmyr'); ?></li>
                        <li><?php echo __('Комфортные, безопасные залы', 'wp_denysmyr'); ?></li>
                        <li><?php echo __('Группы по возрасту и уровню подготовки', 'wp_denysmyr'); ?></li>
                    </ul>
                    <button type="button" class="st-btn" data-bs-toggle="modal" data-bs-target="#contact_form">
                        <?php echo __('Записаться на пробное', 'wp_denysmyr'); ?>
                    </button>
                </div>
            </div>
            <?php if (is_active_sidebar('insta_widget')) : ?>
            <div class="col-12 col-lg-6">
                <div class="st-insta effect">
                    <?php dynamic_sidebar('insta_widget'); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- 3. НАПРАВЛЕНИЯ — Что выбрать для себя или ребёнка? Интерес и желание -->
<section class="styles-section">
    <div class="container mb-2">
        <div class="row align-items-center mb-5">
            <div class="col-12 col-lg-6">
                <span class="sub-title"><?php echo __('Направления танцев', 'wp_denysmyr'); ?></span>
                <h2 class="main-title"><?php echo __('НАЙДИ СВОЙ<br>СТИЛЬ', 'wp_denysmyr'); ?></h2>
            </div>
            <div class="col-12 col-lg-6">
                <div class="seo-text">
                    <p><?php echo __('Программы для детей от 4 лет, подростков и взрослых — hip-hop, contemporary, dancehall и другие современные направления. Каждый ученик найдёт свой стиль, свою группу и уверенность в движении.', 'wp_denysmyr'); ?></p>
                    <p><?php echo __('Занятия проходят в небольших группах по возрасту и уровню подготовки — от абсолютных новичков до опытных танцоров. Удобное расписание и внимательный подход к детям, подросткам и взрослым.', 'wp_denysmyr'); ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <?php
        $args = [
            'post_type'      => 'styles',
            'posts_per_page' => -1,
            'nopaging'       => true,
            'orderby'        => 'menu_order',
            'order'          => 'ASC'
        ];
        $the_query = new WP_Query( $args );
        ?>
        <?php if ( $the_query->have_posts() ) : ?>
            <div class="swiper styles-swiper">
                <div class="swiper-wrapper">
                    <?php while ( $the_query->have_posts() ) : $the_query->the_post();
                        $bg_img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                        if (!$bg_img) $bg_img = 'https://talentcenterddc.nl/wp-content/uploads/2025/12/faq-talent-center-ddc.jpg';
                    ?>
                        <div class="swiper-slide">
                            <a href="<?php the_permalink(); ?>" class="city-card" style="background-image: url('<?php echo esc_url($bg_img); ?>');">
                                <div class="city-overlay"></div>
                                <div class="city-content">
                                    <?php the_title( '<h3 class="city-name">', '</h3>' ); ?>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>
    <!-- Конверсионная полоса под слайдером -->
    <div class="styles-cta-wrap">
        <div class="container">
            <div class="styles-cta-strip">
                <div class="styles-cta-strip__text">
                    <span><?php echo __('Не знаешь с чего начать?', 'wp_denysmyr'); ?></span>
                    <strong><?php echo __('Запишись на пробное — подберём направление вместе.', 'wp_denysmyr'); ?></strong>
                </div>
                <button type="button" class="st-btn" data-bs-toggle="modal" data-bs-target="#contact_form">
                    <?php echo __('Записаться на пробное', 'wp_denysmyr'); ?>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- 4. ДОСТИЖЕНИЯ — Доверие, цифры, авторитет -->
<section class="ddc-achievements" id="achievements">
    <div class="ddc-bg"></div>
    <div class="ddc-overlay"></div>
    <div class="container">
        <span class="ddc-eyebrow"><?php _e('Talent Center DDC', 'wp_denysmyr'); ?></span>
        <h2 class="ddc-title">
            <?php _e('НАШИ<br>ДОСТИЖЕНИЯ', 'wp_denysmyr'); ?>
        </h2>
        <p class="ddc-description">
            <?php _e('Более 15 лет опыта, более 100 учеников в Нидерландах и Украине — доверие семей и взрослых танцоров, которое мы заслужили годами работы.', 'wp_denysmyr'); ?>
        </p>
        <ul class="ddc-list">
            <li><?php _e('Более 15 лет опыта преподавания танцев для детей, подростков и взрослых', 'wp_denysmyr'); ?></li>
            <li><?php _e('2 года успешной работы в Нидерландах', 'wp_denysmyr'); ?></li>
            <li><?php _e('4 филиала — в Нидерландах и Украине', 'wp_denysmyr'); ?></li>
            <li><?php _e('Более 100 учеников, которые регулярно посещают занятия', 'wp_denysmyr'); ?></li>
            <li><?php _e('Современные программы для детей от 4 лет, подростков и взрослых', 'wp_denysmyr'); ?></li>
            <li><?php _e('Участие учеников в выступлениях, фестивалях и конкурсах', 'wp_denysmyr'); ?></li>
        </ul>
        <div class="ddc-stats">
            <div class="stat">
                <span class="number" data-target="15">0</span>
                <span class="label"><?php _e('лет опыта', 'wp_denysmyr'); ?></span>
            </div>
            <div class="stat">
                <span class="number" data-target="100">0</span>
                <span class="label"><?php _e('учеников', 'wp_denysmyr'); ?>+</span>
            </div>
            <div class="stat">
                <span class="number" data-target="4">0</span>
                <span class="label"><?php _e('филиала', 'wp_denysmyr'); ?></span>
            </div>
            <div class="stat">
                <span class="number" data-target="2">0</span>
                <span class="label"><?php _e('страны', 'wp_denysmyr'); ?></span>
            </div>
        </div>
    </div>
</section>

<!-- 5. ЛОКАЦИИ — Где найти нас? Конверсия — запись -->
<section class="locations-section">
    <div class="container mb-2">
        <div class="row align-items-center mb-5">
            <div class="col-12 col-lg-6">
                <span class="sub-title"><?php echo __('Наши филиалы', 'wp_denysmyr'); ?></span>
                <h2 class="main-title"><?php echo __('НАЙДИ СТУДИЮ<br>РЯДОМ С ДОМОМ', 'wp_denysmyr'); ?></h2>
            </div>
            <div class="col-12 col-lg-6">
                <div class="seo-text">
                    <p><?php echo __('Студии танцев для детей, подростков и взрослых в Нидерландах и Украине — выберите ближайший филиал и запишитесь на пробное занятие. Удобное расположение, комфортные залы и дружелюбная атмосфера ждут каждого ученика.', 'wp_denysmyr'); ?></p>
                    <p><?php echo __('В каждом филиале работают опытные преподаватели, занятия проходят по гибкому расписанию — утром, вечером и в выходные дни. Нажмите на карточку города, чтобы узнать расписание занятий.', 'wp_denysmyr'); ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <?php
        $args = [
            'post_type'      => 'schedule',
            'posts_per_page' => -1,
            'nopaging'       => true,
            'orderby'        => 'menu_order',
            'order'          => 'ASC'
        ];
        $the_query = new WP_Query( $args );
        ?>
        <?php if ( $the_query->have_posts() ) : ?>
            <div class="swiper city-swiper">
                <div class="swiper-wrapper">
                    <?php while ( $the_query->have_posts() ) : $the_query->the_post();
                        $bg_img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                        if (!$bg_img) $bg_img = 'https://talentcenterddc.nl/wp-content/uploads/2025/12/faq-talent-center-ddc.jpg';
                    ?>
                        <div class="swiper-slide">
                            <div class="city-card" style="background-image: url('<?php echo esc_url($bg_img); ?>');">
                                <div class="city-overlay"></div>
                                <div class="city-content">
                                    <?php the_title( '<h3 class="city-name">', '</h3>' ); ?>
                                    <div class="schedule-reveal">
                                        <div class="schedule-inner">
                                            <?php the_content(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>
</section>

<!-- 6. ГАЛЕРЕЯ — Эмоция, живые фото, социальное доказательство -->
<section id="photo-gallery">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-12 col-lg-6">
                <span class="sub-title"><?php echo __('Живая атмосфера', 'wp_denysmyr'); ?></span>
                <h2 class="main-title gallery-title"><?php echo __('КАК МЫ<br>ТАНЦУЕМ', 'wp_denysmyr'); ?></h2>
            </div>
            <div class="col-12 col-lg-6">
                <p class="gallery-desc"><?php echo __('Реальные занятия, выступления и эмоции наших учеников — посмотрите, как проходят уроки в Talent Center DDC.', 'wp_denysmyr'); ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php echo do_shortcode('[FinalTilesGallery id="1"]') ?>
            </div>
        </div>
    </div>
</section>

<!-- 7. СОЦСЕТИ — Удержание, вовлечение, повторные визиты -->
<section id="ddc_nl_social">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php $BsWp->get_template_parts(['parts/shared/sign-up-form']) ?>
            </div>
        </div>
    </div>
</section>

<?php
$BsWp->get_template_parts([
    'parts/modals/contact',
    'parts/shared/footer',
    'parts/shared/cookiebar',
    'parts/shared/html-footer'
]);
?>
