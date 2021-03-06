<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Enable features from Soil when plugin is activated
  // https://roots.io/plugins/soil/
  /**
   * Enable features from Soil when plugin is activated
   * @link https://roots.io/plugins/soil/
   */
  add_theme_support('soil', [
    /**
     * Clean up WordPress
     */
    'clean-up' => [
        /**
         * Obscure and suppress WordPress information.
         */
        'wp_obscurity',

        /**
         * Disable WordPress emojis.
         */
        'disable_emojis',

        /**
         * Disable Gutenberg block library CSS.
         */
        'disable_gutenberg_block_css',

        /**
         * Disable extra RSS feeds.
         */
        'disable_extra_rss',

        /**
         * Disable recent comments CSS.
         */
        'disable_recent_comments_css',

        /**
         * Disable gallery CSS.
         */
        'disable_gallery_css',

        /**
         * Clean HTML5 markup.
         */
        'clean_html5_markup',
    ],

    /**
     * Disable WordPress REST API
     */
    'disable-rest-api',

    /**
     * Remove version query string from all styles and scripts
     */
    'disable-asset-versioning',

    /**
     * Disables trackbacks/pingbacks
     */
    'disable-trackbacks',

    /**
     * Moves all scripts to wp_footer action
     */
    'js-to-footer',

    /**
     * Cleaner walker for wp_nav_menu()
     */
    'nav-walker',

    /**
     * Redirects search results from /?s=query to /search/query/, converts %20 to +
     *
     * @link http://txfx.net/wordpress-plugins/nice-search/
     */
    'nice-search',

    /**
     * Convert absolute URLs to relative URLs
     *
     * Inspired by {@link http://www.456bereastreet.com/archive/201010/how_to_make_wordpress_urls_root_relative/}
     */
    'relative-urls',
  ]);

  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage')
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  add_editor_style(Assets\asset_path('styles/main.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'sage'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);
  register_sidebar([
    'name'          => __('Contact Sidebar', 'roots'),
    'id'            => 'sidebar-contact',
    'before_widget' => '<section class="widget %1$s %2$s contact"><div class="widget-inner">',
    'after_widget'  => '</div></section>',
    'before_title'  => '<h3 class="h3_3border"><span>',
    'after_title'   => '</span></h3>',
  ]);
  register_sidebar([
    'name'          => __('Footer', 'sage'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<div class="col-md-4 %1$s %2$s"><section class="widget %1$s %2$s">',
    'after_widget'  => '</section></div>',
    'before_title'  => '<h3><span>',
    'after_title'   => '</span></h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_front_page(),
    is_page_template('template-custom.php'),
  ]);

  return apply_filters('sage/display_sidebar', $display);
}

/**
 * Theme assets
 */
function assets() {
  wp_enqueue_style('sage/css', Assets\asset_path('styles/main.css'), false, null);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);