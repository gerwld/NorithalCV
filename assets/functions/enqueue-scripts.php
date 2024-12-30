<?php

// Connect Javascript, CSS files
function enqueue_assets_main()
{
  wp_enqueue_style('styles', get_stylesheet_uri());
  wp_enqueue_style(
    'font-montserrat',
    'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap'
  );
  wp_enqueue_style('font-roboto', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap');

  wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/index.js', '', '', true);
}
add_action('wp_enqueue_scripts', 'enqueue_assets_main');


 // Connect Admin panel CSS files
 function weblx_enqueue_styles($post_suffix){
  if (strpos($post_suffix, 'weblx') !== false) {
   wp_enqueue_style('my-theme-settings', get_template_directory_uri() . '/assets/styles/theme-settings.css');
  }
  wp_enqueue_style('my-theme-settings', get_template_directory_uri() . '/assets/styles/admin-settings.css');
 }add_action('admin_enqueue_scripts', 'weblx_enqueue_styles', 10);