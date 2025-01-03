<?php

// ** ----------------------------------------------------- ** //
// ** ------------------- Initialization ------------------ ** //
// ** ----------------- of the Customizer ---------------- ** //
// ** ----------------------------------------------------- ** //

/**
 * Set a theme mod if it doesn't exist.
 *
 * @param string $name The name of the theme mod.
 * @param mixed $default The default value to set if the theme mod doesn't exist.
 */
function initialize_theme_mod($name, $default)
{
  if (!get_theme_mod($name)) {
    set_theme_mod($name, $default);
  }
}

/**
 * Initialize customizer defaults.
 */
function initialize_customizer_defaults()
{
  // Define all defaults in a single array
  $defaults = [
    // Header
    'header_setting_title' => get_bloginfo('name') ?? 'Arturo Feeney',
    'header_setting_subtitle' => get_bloginfo('description') ?? 'Interior Designer',
    'wlx_header_menu' => 'norithal_main_menu',

    // Hero text
    'hero_setting_title' => 'Welcome to my portfolio.',
    'hero_setting_subtitle' => 'A Bit About Me',
    'hero_setting_desc' => 'Every space has a story, and my mission is to bring it to life. I blend creativity with functionality to design interiors that inspire, comfort, and reflect your unique style.',

    // Hero buttons
    'hero_btn_link_1' => '/contacts',
    'hero_btn_title_1' => 'Contact Me',
    'hero_btn_link_2' => '/resume',
    'hero_btn_title_2' => 'Resume',
    'hero_btn_link_3' => '/projects',
    'hero_btn_title_3' => 'Projects',
    'hero_setting_image' => '',

    // Footer
    'footer_block1_title' => 'Email',
    'footer_block1_value' => '<a href="mailto://weblxapplications@gmail.com">weblxapplications@gmail.com</a>',
    'footer_block1_disabled' => false,
    'footer_block2_title' => 'Phone',
    'footer_block2_value' => '<a href="tel://18005550199"><span>+1(800)</span>555-0199</a>',
    'footer_block2_disabled' => false,
    'footer_creds_value' => "<span>© &date, &name.</span>\r\n<span>All rights reserved.</span>",

    // Socials
    'social_colors_hover' => false,
    'social_facebook' => 'https://facebook.com/',
    'social_instagram' => 'https://instagram.com/',
    'social_github' => 'https://github.com/gerwld',
    'social_kofi' => 'https://ko-fi.com/patrykjaworski',
    'social_linkedin' => 'https://pjaworskidev.com/',
  ];

  // Initialize settings
  foreach ($defaults as $name => $default) {
    initialize_theme_mod($name, $default);
  }
}


/**
 * Initialize theme default menu.
 */
function wlx_create_norithal_main_menu() {
  // Check if the default menu exists, if not, create it
  $menu_name = 'norithal_main_menu';
  $menu_exists = wp_get_nav_menu_object($menu_name);

  if (!$menu_exists) {
      // Create the menu
      $menu_id = wp_create_nav_menu($menu_name);

      // Add default menu items to the menu
      wp_update_nav_menu_item($menu_id, 0, array(
          'menu-item-title' =>  __('Resume'),
          'menu-item-classes' => 'home',
          'menu-item-url'   => home_url('/resume'), 
          'menu-item-status' => 'publish'
      ));

      wp_update_nav_menu_item($menu_id, 0, array(
          'menu-item-title' => __('Projects'),
          'menu-item-classes' => 'about',
          'menu-item-url'   => home_url('/projects'), 
          'menu-item-status' => 'publish'
      ));


      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' => __('Contact'),
        'menu-item-classes' => 'about',
        'menu-item-url'   => home_url('/contact'), 
        'menu-item-status' => 'publish'
    ));
  }
}
add_action('after_switch_theme', 'wlx_create_norithal_main_menu');


add_action('after_setup_theme', 'initialize_customizer_defaults');
