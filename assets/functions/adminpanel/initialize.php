<?php


// ** ----------------------------------------------------- ** //
// ** ------------------- Initialization  ----------------- ** //
// ** ----------------- of the cuztomizer  ---------------- ** //
// ** ----------------------------------------------------- ** //


// Initializes values by the principle: get -> if none? -> set
function initialize_customizer_defaults()
{
  // Header
  if (!get_theme_mod('header_setting_title')) {
    set_theme_mod('header_setting_title', get_bloginfo('name') ?? 'Arturo Feeney');
  }
  if (!get_theme_mod('header_setting_subtitle')) {
    set_theme_mod('header_setting_subtitle', get_bloginfo('description') ?? 'Interior Designer');
  }
  // Hero
  if (!get_theme_mod('hero_setting_title')) {
    set_theme_mod('hero_setting_title', 'Welcome to my portfolio.');
  }
  if (!get_theme_mod('hero_setting_subtitle')) {
    set_theme_mod('hero_setting_subtitle', 'A Bit About Me');
  }
  if (!get_theme_mod('hero_setting_desc')) {
    set_theme_mod('hero_setting_desc', 'Every space has a story, and my mission is to bring it to life. I blend creativity with functionality to design interiors that inspire, comfort, and reflect your unique style.');
  }

  
}
add_action('after_setup_theme', 'initialize_customizer_defaults');
