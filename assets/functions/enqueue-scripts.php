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
