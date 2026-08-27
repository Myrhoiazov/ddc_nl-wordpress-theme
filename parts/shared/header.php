<?php
$locations  = get_nav_menu_locations();
$menu_id    = $locations['primary'] ?? null;
$menu_items = $menu_id ? wp_get_nav_menu_items($menu_id) : [];
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
