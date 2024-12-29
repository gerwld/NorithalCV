<?php
// Theme customizer.php


// - Sets the new panel
function set_menus_panel($wp_customize)
{
  $wp_customize->add_panel(
    'menu_select_panel',
    array(
      'title' => 'Header settings',
      'description' => "Most essential configurations for the elements in the header section.",
      'priority' => 10,
    )
  );



  // -- Header title section
  $wp_customize->add_section('header_sect_title', array(
    'title' => 'Header Title',
    'priority' => 10,
    'panel' => 'menu_select_panel'
  ));
  // --- Header title section -> setting 
  $wp_customize->add_setting('header_setting_title', array(
    'validate_callback' => function ($validity, $value) {
      return vs_validate_field($validity, $value, 30, "Title", true);
    },
    'sanitize_callback' => 'vs_sanitize_header',
    'default' => get_bloginfo('name') ?? 'Arturo Feeney'
  ));
  // ---- Header title section -> setting -> control
  $wp_customize->add_control('header_title_control', array(
    'label' => 'Change header title',
    'type' => 'text',
    'section' => 'header_sect_title',
    'settings' => 'header_setting_title',
  ));



  // -- Header subtitle section
  $wp_customize->add_section('header_sect_subtitle', array(
    'title' => 'Header Subtitle',
    'priority' => 10,
    'panel' => 'menu_select_panel'
  ));
  // --- Header subtitle section -> setting 
  $wp_customize->add_setting('header_setting_subtitle', array(
    'validate_callback' => function ($validity, $value) {
      return vs_validate_field($validity, $value, 30, "Subtitle", false);
    },
    'sanitize_callback' => 'vs_sanitize_header',
    'default' => 'Interior Designer'
  ));
  // ---- Header subtitle section -> setting -> control
  $wp_customize->add_control('header_subtitle_control', array(
    'label' => 'Change header subtitle',
    'type' => 'text',
    'section' => 'header_sect_subtitle',
    'settings' => 'header_setting_desc',
  ));
}

add_action('customize_register', 'set_menus_panel');





// ** ----------------------------------------------------- ** //
// ** --------------------- Validation  ------------------- ** //
// ** ----------------- & Sanitizing part  ---------------- ** //
// ** ----------------------------------------------------- ** //



function vs_sanitize_header($value)
{
  return sanitize_text_field($value);
}

function vs_validate_header($validity, $value)
{
  if ('' === $value) {
    $validity->add('empty_copy', 'Header title cannot be empty');
  } else if (strlen($value) > 12) {
    $validity->add('empty_copy', 'Header title cannot be greater that 12 symbols');
  }
  return $validity;
}

function vs_validate_field($validity, $value, $maxlength, $field_name, $nonempty)
{
  if ($nonempty && '' === $value) {
    $validity->add('empty_copy', "$field_name cannot be empty");
  } else if (strlen($value) > $maxlength) {
    $validity->add('empty_copy', "$field_name cannot be greater that $maxlength symbols");
  }
  return $validity;
}



function wlx_sanitize_text($input)
{
  $output = array();
  foreach ($input as $key => $v) {
    if (isset($input[$key])) {
      $output[$key] = strip_tags(stripslashes($input[$key]));
    }
  }
  return apply_filters('wlx_sanitize_text', $output, $input);
}

function wlx_sanitize_url($input)
{
  $output = array();
  foreach ($input as $key => $v) {
    if (isset($input[$key])) {
      $output[$key] = esc_url_raw(strip_tags(stripslashes($input[$key])));
    }
  }
  return apply_filters('wlx_sanitize_url', $output, $input);
}



// ** ----------------------------------------------------- ** //
// ** ------------------- Initialization  ----------------- ** //
// ** ----------------- of the cuztomizer  ---------------- ** //
// ** ----------------------------------------------------- ** //


// Initializes values by principle get -> if none? -> set
function initialize_customizer_defaults()
{
  if (!get_theme_mod('header_setting_title')) {
    set_theme_mod('header_setting_title', get_bloginfo('name') ?? 'Arturo Feeney');
  }
  if (!get_theme_mod('header_setting_subtitle')) {
    set_theme_mod('header_setting_subtitle', get_bloginfo('description') ?? 'Interior Designer');
  }
}
add_action('after_setup_theme', 'initialize_customizer_defaults');
