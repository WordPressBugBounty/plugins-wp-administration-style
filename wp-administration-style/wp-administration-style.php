<?php
namespace Wp_Administration_Style;

defined('ABSPATH') or die();

/**
 * Plugin Name:                       WP Administration Style
 * Description:                       Enhances the user interface and user experience of the WordPress dashboard.
 * Version:                           7.3.1
 * Tested up to:                      6.6.0
 * Requires at least:                 5.0.0
 * Requires PHP:                      7.4.33
 * Author:                            babakfp
 * Author URI:                        https://babakfp.ir
 * License:                           GPLv3 or later
 * License URI:                       https://www.gnu.org/licenses/gpl-3.0.html
 * Tags:                              Farsi, Farsi UI, فارسی, فونت فارسی, داشبورد فارسی
 * Text Domain:                       wp-administration-style
 * Domain Path:                       /languages
 */

define('WP_ADMINISTRATION_STYLE', [
    'VERSION' => '7.3.1',
    'PATH' => plugin_dir_path(__FILE__),
    'URL' => plugin_dir_url(__FILE__),
]);

require_once WP_ADMINISTRATION_STYLE['PATH'] . 'includes/core.php';
