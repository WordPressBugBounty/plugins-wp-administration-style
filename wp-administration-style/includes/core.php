<?php
namespace Wp_Administration_Style;

require_once WP_ADMINISTRATION_STYLE['PATH'] . 'includes/is-gutenberg-active.php';

defined('ABSPATH') or die();

if (!class_exists('Wp_Administration_Style')) {
    final class Wp_Administration_Style {
        public function __construct() {
            add_action('admin_head', [$this, 'farsi_font_face']);
            add_action('admin_enqueue_scripts', [$this, 'dashboard_styles']);
            add_action('login_enqueue_scripts', [$this, 'login_styles']);
            add_action('login_head', [$this, 'farsi_font_face']);

            // Elementor editor styles
            add_action('elementor/editor/wp_head', [$this, 'farsi_font_face']);
            add_action('elementor/editor/after_enqueue_styles', fn() => wp_enqueue_style('wp-administration-style::elementor-editor', WP_ADMINISTRATION_STYLE['URL'] . 'static/css/elementor-editor.css', [], WP_ADMINISTRATION_STYLE['VERSION']));
            add_action('elementor/preview/enqueue_styles', function () {
                $this->farsi_font_face();
                wp_enqueue_style('wp-administration-style::elementor-preview', WP_ADMINISTRATION_STYLE['URL'] . 'static/css/elementor-preview.css', [], WP_ADMINISTRATION_STYLE['VERSION']);
            });
            add_action('elementor/editor/after_enqueue_scripts', fn() => wp_enqueue_script('wp-administration-style::elementor-editor', WP_ADMINISTRATION_STYLE['URL'] . 'static/js/elementor-editor.js', [], WP_ADMINISTRATION_STYLE['VERSION']));

            add_action('plugins_loaded', function () {
                if (!class_exists('Elementor_Ad_Eraser')) {
                    require_once WP_ADMINISTRATION_STYLE['PATH'] . 'elementor-ad-eraser/elementor-ad-eraser.php';
                }
            });
        }

        public function dashboard_styles() {
            wp_enqueue_style('wp-administration-style::base', WP_ADMINISTRATION_STYLE['URL'] . 'static/css/base.css', [], WP_ADMINISTRATION_STYLE['VERSION']);
            wp_enqueue_style('wp-administration-style::uicons', WP_ADMINISTRATION_STYLE['URL'] . 'static/fonts/wp-administration-style-icons/style.css', [], WP_ADMINISTRATION_STYLE['VERSION']);

            if (is_gutenberg_active()) {
                wp_enqueue_style('wp-administration-style::gutenberg', WP_ADMINISTRATION_STYLE['URL'] . 'static/css/gutenberg.css', [], WP_ADMINISTRATION_STYLE['VERSION']);
                wp_enqueue_script('wp-administration-style::gutenberg', WP_ADMINISTRATION_STYLE['URL'] . 'static/js/gutenberg.js', [], WP_ADMINISTRATION_STYLE['VERSION']);
            }

            if (is_plugin_active('elementor/elementor.php')) {
                wp_enqueue_style('wp-administration-style::elementor', WP_ADMINISTRATION_STYLE['URL'] . 'static/css/elementor.css', [], WP_ADMINISTRATION_STYLE['VERSION']);
            }

            if (is_plugin_active('woocommerce/woocommerce.php')) {
                wp_enqueue_style('wp-administration-style::woocommerce', WP_ADMINISTRATION_STYLE['URL'] . 'static/css/woocommerce.css', [], WP_ADMINISTRATION_STYLE['VERSION']);
            }

            wp_enqueue_style('wp-administration-style::mce', WP_ADMINISTRATION_STYLE['URL'] . 'static/css/mce.css', [], WP_ADMINISTRATION_STYLE['VERSION']);
            wp_enqueue_script('wp-administration-style::js', WP_ADMINISTRATION_STYLE['URL'] . 'static/js/index.js', [], WP_ADMINISTRATION_STYLE['VERSION']);
        }

        public function login_styles() {
            wp_enqueue_style('wp-administration-style::signin', WP_ADMINISTRATION_STYLE['URL'] . 'static/css/signin.css', [], WP_ADMINISTRATION_STYLE['VERSION']);
            wp_enqueue_style('wp-administration-style::uicons', WP_ADMINISTRATION_STYLE['URL'] . 'static/fonts/wp-administration-style-icons/style.css', [], WP_ADMINISTRATION_STYLE['VERSION']);
        }

        public function farsi_font_face() {
            $vazirmatn_font_url = WP_ADMINISTRATION_STYLE['URL'] . 'static/fonts/Vazirmatn/Vazirmatn.woff2?v' . WP_ADMINISTRATION_STYLE['VERSION'];
            $vazirmatn_nl_font_url = WP_ADMINISTRATION_STYLE['URL'] . 'static/fonts/Vazirmatn/Vazirmatn-NL.woff2?v' . WP_ADMINISTRATION_STYLE['VERSION'];

            echo sprintf(
                '
                    <link id="wp-administration-style-vazirmatn-link" rel="preload" href="%1$s" as="font" type="font/woff2" crossorigin />
                    <link id="wp-administration-style-vazirmatn-nl-link" rel="preload" href="%2$s" as="font" type="font/woff2" crossorigin />

                    <style id="wp-administration-style-vazirmatn-style" type="text/css">
                        @font-face {
                            font-family: "wp-administration-style-vazirmatn";
                            src: url("%1$s") format("woff2");
                            font-weight: 100 900;
                            font-display: block;
                            font-style: normal;
                        }
                        @font-face {
                            font-family: "wp-administration-style-vazirmatn-nl";
                            src: url("%2$s") format("woff2");
                            font-weight: 100 900;
                            font-display: block;
                            font-style: normal;
                        }

                        :root {
                            --wp-administration-style--font-family--vazirmatn: "wp-administration-style-vazirmatn";
                            --wp-administration-style--font-family--vazirmatn-nl: "wp-administration-style-vazirmatn-nl";
                        
                            --wp-administration-style--font-family-sans-fallback: ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
                            --wp-administration-style--font-family-sans: var(--wp-administration-style--font-family--vazirmatn), var(--wp-administration-style--font-family-sans-fallback), dashicons;

                            --wp-administration-style--font-family-mono-fallback: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, Liberation Mono, Courier New, monospace;
                            --wp-administration-style--font-family-mono: var(--wp-administration-style--font-family--vazirmatn-nl), var(--wp-administration-style--font-family-mono-fallback), dashicons;
                        }
                    </style>
                ',
                $vazirmatn_font_url,
                $vazirmatn_nl_font_url,
            );
        }
    }

    new Wp_Administration_Style();
}
