<?php
$locations  = get_nav_menu_locations();
$menu_id    = $locations['primary'] ?? null;
$menu_items = $menu_id ? wp_get_nav_menu_items($menu_id) : [];

// Hide menu items that link to a post/page with no translation in the current
// language, instead of sending visitors to content that's just going to bounce
// them straight to the RU version anyway (see functions.php's untranslated-content
// redirect). Only applies once a non-default language is actually being browsed —
// leaves the RU menu, and every hidden language before it has real content, untouched.
if (function_exists('pll_current_language') && function_exists('pll_default_language')) {
    $current_lang = pll_current_language();
    $default_lang = pll_default_language();

    if ($current_lang && $default_lang && $current_lang !== $default_lang) {
        $menu_items = array_values(array_filter($menu_items, function ($item) use ($current_lang) {
            if ('post_type' !== $item->type) {
                return true;
            }

            return (bool) pll_get_post($item->object_id, $current_lang);
        }));
    }
}

$menu_tree  = [];
$children   = [];

foreach ($menu_items as $item) {
    if ((int) $item->menu_item_parent === 0) {
        $menu_tree[$item->ID] = [
            'item'     => $item,
            'children' => [],
        ];
        continue;
    }

    $children[$item->menu_item_parent][] = $item;
}

foreach ($children as $parent_id => $child_items) {
    if (isset($menu_tree[$parent_id])) {
        $menu_tree[$parent_id]['children'] = $child_items;
    }
}

$current_url = home_url(wp_unslash($_SERVER['REQUEST_URI'] ?? '/'));

// hide_if_no_translation: languages with no published content for the current
// page never show up here — no separate "hidden language" flag needed, this is
// Polylang's own built-in behavior (verified against the live install: NL/UK/EN
// correctly disappear from this list while empty). Computed once and rendered
// in two places below: the desktop switcher inside .site-header__nav, and a
// second copy inside #mobile_menu — .site-header is a 2-column CSS grid, so a
// bare third element between </nav> and #menu_btn wraps onto its own grid row
// and pushes the menu button out of the header entirely.
$pll_switcher_languages = function_exists('pll_the_languages')
    ? pll_the_languages(['raw' => 1, 'hide_if_no_translation' => 1])
    : [];
?>

<header class="site-header">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-header__logo" aria-label="<?php esc_attr_e('Talent Center DDC — главная', 'wp_denysmyr'); ?>">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/images/ddc_logo.png'); ?>" alt="Talent Center DDC" width="100" height="59">
    </a>

    <nav class="site-header__nav" aria-label="<?php esc_attr_e('Главное меню', 'wp_denysmyr'); ?>">
        <?php foreach ($menu_tree as $node) :
            $item         = $node['item'];
            $has_children = !empty($node['children']);
            $is_active    = untrailingslashit($current_url) === untrailingslashit($item->url);
            $item_classes = array_filter([
                'site-header__item',
                $has_children ? 'has-submenu' : '',
                $is_active ? 'is-active' : '',
            ]);
        ?>
            <div class="<?php echo esc_attr(implode(' ', $item_classes)); ?>">
                <a href="<?php echo esc_url($item->url); ?>" class="site-header__link">
                    <?php echo esc_html($item->title); ?>
                </a>

                <?php if ($has_children) : ?>
                    <button class="site-header__submenu-toggle" type="button" aria-expanded="false" aria-label="<?php echo esc_attr(sprintf(__('Открыть подменю «%s»', 'wp_denysmyr'), $item->title)); ?>">
                        <span aria-hidden="true"></span>
                    </button>
                    <div class="site-header__submenu">
                        <?php foreach ($node['children'] as $child) : ?>
                            <a href="<?php echo esc_url($child->url); ?>" class="site-header__submenu-link">
                                <?php echo esc_html($child->title); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <?php if (!empty($pll_switcher_languages)) : ?>
            <div class="site-header__lang" aria-label="<?php esc_attr_e('Переключить язык', 'wp_denysmyr'); ?>">
                <?php foreach ($pll_switcher_languages as $pll_lang) : ?>
                    <a
                        href="<?php echo esc_url($pll_lang['url']); ?>"
                        class="site-header__lang-link<?php echo $pll_lang['current_lang'] ? ' is-active' : ''; ?>"
                        hreflang="<?php echo esc_attr($pll_lang['locale']); ?>"
                        <?php echo $pll_lang['current_lang'] ? 'aria-current="true"' : ''; ?>
                    ><?php echo esc_html($pll_lang['name']); ?></a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </nav>

    <button id="menu_btn" class="site-header__menu-toggle" type="button" aria-expanded="false" aria-controls="mobile_menu">
        <span></span>
        <span></span>
        <span></span>
        <span class="visually-hidden"><?php esc_html_e('Открыть меню', 'wp_denysmyr'); ?></span>
    </button>
</header>

<div id="mobile_menu" class="main-menu" aria-hidden="true">
    <nav class="nav flex-column">
        <?php foreach ($menu_tree as $node) :
            $item         = $node['item'];
            $has_children = !empty($node['children']);
        ?>
            <a href="<?php echo esc_url($item->url); ?>" class="nav-link <?php echo $has_children ? 'submenu' : ''; ?>" data-id="<?php echo esc_attr($item->ID); ?>">
                <?php echo esc_html($item->title); ?>
            </a>
        <?php endforeach; ?>

        <?php if (!empty($pll_switcher_languages)) : ?>
            <div class="main-menu__lang" aria-label="<?php esc_attr_e('Переключить язык', 'wp_denysmyr'); ?>">
                <?php foreach ($pll_switcher_languages as $pll_lang) : ?>
                    <a
                        href="<?php echo esc_url($pll_lang['url']); ?>"
                        class="main-menu__lang-link<?php echo $pll_lang['current_lang'] ? ' is-active' : ''; ?>"
                        hreflang="<?php echo esc_attr($pll_lang['locale']); ?>"
                        <?php echo $pll_lang['current_lang'] ? 'aria-current="true"' : ''; ?>
                    ><?php echo esc_html($pll_lang['name']); ?></a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </nav>

    <?php foreach ($menu_tree as $node) : ?>
        <?php if (!empty($node['children'])) : ?>
            <div class="sub-nav-panel panel-<?php echo esc_attr($node['item']->ID); ?>">
                <nav class="nav flex-column">
                    <button type="button" class="nav-link back-btn"><?php esc_html_e('Назад', 'wp_denysmyr'); ?></button>
                    <?php foreach ($node['children'] as $child) : ?>
                        <a href="<?php echo esc_url($child->url); ?>" class="nav-link"><?php echo esc_html($child->title); ?></a>
                    <?php endforeach; ?>
                </nav>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<main id="main">

<?php if (is_page() && !get_page_template_slug() && !is_front_page() && !is_home()) : ?>
    <div id="content">
<?php endif; ?>
