<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo get_theme_mod('seo_title') ? get_theme_mod('seo_title') : get_bloginfo('name'); ?></title>
    <meta name="description" content="<?php echo get_theme_mod('seo_description') ? get_theme_mod('seo_description') : get_bloginfo('description'); ?>" />
    <?php wp_head(); ?>
</head>
<body>
    <div class="main_container">
        <?php the_content() ?>    
    </div>
    <?php wp_footer(); ?>
</body>
</html>