<?php

function theme_menu()
{ 
   remove_menu_page('edit.php'); // отключаем записи
   remove_menu_page('edit-comments.php'); // убираем комментарии из меню
}
add_action('admin_menu', 'theme_menu');


// Remove [embed] shortcode parser
remove_filter( 'the_content', [ $GLOBALS['wp_embed'], 'run_shortcode' ], 8 );
remove_filter( 'widget_text_content', [ $GLOBALS['wp_embed'], 'run_shortcode' ], 8 );

// Remove embed url parser
remove_filter( 'the_content', [ $GLOBALS['wp_embed'], 'autoembed' ], 8 );
remove_filter( 'widget_text_content', [ $GLOBALS['wp_embed'], 'autoembed' ], 8 );


function add_featured_image_support_to_your_wordpress_theme() {
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'add_featured_image_support_to_your_wordpress_theme' );


// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;
    
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);


# добавляет SVG в список разрешенных для загрузки файлов
function svg_upload_allow($mimes){
    $mimes["svg"] = "image/svg+xml";
    return $mimes;
}
add_filter("upload_mimes", "svg_upload_allow");

# исправление MIME типа для SVG файлов
function fix_svg_mime_type($data, $file, $filename, $mimes, $real_mime = "")
{
    // WP 5.1 +
    if (version_compare($GLOBALS["wp_version"], "5.1.0", ">=")) {
        $dosvg = in_array($real_mime, ["image/svg", "image/svg+xml"]);
    } else {
        $dosvg = ".svg" === strtolower(substr($filename, -4));
    }

    // mime тип был обнулен, поправим его
    // а также проверим право пользователя
    if ($dosvg) {
        // разрешим
        if (current_user_can("manage_options")) {
            $data["ext"] = "svg";
            $data["type"] = "image/svg+xml";
        }
        // запретим
        else {
            $data["ext"] = $type_and_ext["type"] = false;
        }
    }
	
    return $data;
}
add_filter("wp_check_filetype_and_ext", "fix_svg_mime_type", 10, 5);


function hs_image_editor_default_to_gd($editors)
{
    $gd_editor = "WP_Image_Editor_GD";
    $editors = array_diff($editors, [$gd_editor]);
    array_unshift($editors, $gd_editor);
    return $editors;
}
add_filter("wp_image_editors", "hs_image_editor_default_to_gd");

/* удалить логотип */
function true_admin_bar_remove_logo(){
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu("wp-logo");
}
add_action("wp_before_admin_bar_render", "true_admin_bar_remove_logo", 0);

// отключение проверки email
add_filter( 'admin_email_check_interval', '__return_false' );

// Disable Gutenberg on the back end.
add_filter( 'use_block_editor_for_post', '__return_false' );

// Disable Gutenberg for widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );

add_action( 'wp_enqueue_scripts', function() {
    // Remove CSS on the front end.
    wp_dequeue_style( 'wp-block-library' );

    // Remove Gutenberg theme.
    wp_dequeue_style( 'wp-block-library-theme' );

    // Remove inline global CSS on the front end.
    wp_dequeue_style( 'global-styles' );

    // Remove classic-themes CSS for backwards compatibility for button blocks.
    wp_dequeue_style( 'classic-theme-styles' );
}, 20 );

//Disable emojis in WordPress
add_action( 'init', 'smartwp_disable_emojis' );

function smartwp_disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' );
 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}

function disable_emojis_tinymce( $plugins ) {
 if ( is_array( $plugins ) ) {
 return array_diff( $plugins, array( 'wpemoji' ) );
 } else {
 return array();
 }
}

remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action( 'wp_head', 'wp_oembed_add_discovery_links');
remove_action( 'wp_head', 'rest_output_link_wp_head');
remove_action( 'template_redirect', 'rest_output_link_header', 11);
remove_action('template_redirect', 'wp_shortlink_header', 11);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');

remove_filter( 'wp_robots', 'wp_robots_max_image_preview_large' );