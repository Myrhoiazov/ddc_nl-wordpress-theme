<?php

/**
 * Shared helpers for the blog listing (templates/news-template.php) and
 * single post (single.php) views.
 */

if (!function_exists('ddc_news_primary_category')) {
    /**
     * First assigned category for a post, or null when it has none.
     */
    function ddc_news_primary_category($post_id) {
        $categories = get_the_category($post_id);
        return !empty($categories) ? $categories[0] : null;
    }
}

if (!function_exists('ddc_news_category_accent')) {
    /**
     * Deterministic accent index (0-4) from a category id, so labels get
     * visual variety without any template hardcoding a category name.
     */
    function ddc_news_category_accent($term_id) {
        return $term_id % 5;
    }
}

if (!function_exists('ddc_news_page_url')) {
    /**
     * URL of the page using the News listing template, for "back to blog"
     * links from single posts. Falls back to the home page when no such
     * page has been created yet.
     */
    function ddc_news_page_url() {
        static $url = null;

        if ($url !== null) {
            return $url;
        }

        $pages = get_posts([
            'post_type'      => 'page',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'meta_key'       => '_wp_page_template',
            'meta_value'     => 'templates/news-template.php',
            'fields'         => 'ids',
        ]);

        $url = !empty($pages) ? get_permalink($pages[0]) : home_url('/');

        return $url;
    }
}

if (!function_exists('ddc_reading_time_minutes')) {
    /**
     * Estimated reading time in whole minutes (minimum 1) at ~200 words/min.
     */
    function ddc_reading_time_minutes($content) {
        $text  = wp_strip_all_tags($content);
        $words = preg_split('/\s+/u', trim($text), -1, PREG_SPLIT_NO_EMPTY);
        $count = $words ? count($words) : 0;

        return max(1, (int) ceil($count / 200));
    }
}

if (!function_exists('ddc_build_toc')) {
    /**
     * Injects anchor ids into <h2>/<h3> headings in a block of rendered
     * post-content HTML and returns both the modified HTML and a nested
     * table of contents: top-level entries for each h2, numbered child
     * entries for the h3s that follow it.
     *
     * @return array{html: string, items: array}
     */
    function ddc_build_toc($html) {
        if (trim($html) === '') {
            return ['html' => $html, 'items' => []];
        }

        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $dom->loadHTML(
            '<?xml encoding="utf-8" ?><div id="ddc-toc-root">' . $html . '</div>',
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );
        libxml_clear_errors();

        $root = $dom->getElementById('ddc-toc-root');

        if (!$root) {
            return ['html' => $html, 'items' => []];
        }

        $xpath    = new DOMXPath($dom);
        $headings = $xpath->query('.//h2 | .//h3', $root);

        $items        = [];
        $used_ids     = [];
        $last_h2_index = null;

        foreach ($headings as $heading) {
            $text = trim($heading->textContent);

            if ($text === '') {
                continue;
            }

            $id = sanitize_title($text) ?: 'section';

            if (isset($used_ids[$id])) {
                $used_ids[$id]++;
                $id .= '-' . $used_ids[$id];
            } else {
                $used_ids[$id] = 1;
            }

            $heading->setAttribute('id', $id);

            if ($heading->nodeName === 'h2' || $last_h2_index === null) {
                $items[]       = ['id' => $id, 'text' => $text, 'children' => []];
                $last_h2_index = count($items) - 1;
            } else {
                $items[$last_h2_index]['children'][] = ['id' => $id, 'text' => $text];
            }
        }

        $out = '';
        foreach ($root->childNodes as $child) {
            $out .= $dom->saveHTML($child);
        }

        return ['html' => $out, 'items' => $items];
    }
}
