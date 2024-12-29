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
    'validate_callback' => 'true_validate_header',
    'sanitize_callback' => 'true_sanitize_header',
    'default' => 'Arturo Feeney'
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
  $wp_customize->add_setting('header_setting_desc', array(
    'validate_callback' => 'true_validate_header',
    'sanitize_callback' => 'true_sanitize_header',
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


//Валидатор и санитайзер
function true_sanitize_header($value)
{
  return sanitize_text_field($value);
}

function true_validate_header($validity, $value)
{
  if ('' === $value) {
    $validity->add('empty_copy', 'Header title cannot be empty');
  } else if (strlen($value) > 12) {
    $validity->add('empty_copy', 'Header title cannot be greater that 12 symbols');
  }
  return $validity;
}

function true_validate_cbtn_link($validity, $value)
{
  if ('' === $value) {
    $validity->add('empty_copy', 'Button link cannot be empty');
  }
  return $validity;
}

function true_validate_cbtn_text($validity, $value)
{
  if ('' === $value) {
    $validity->add('empty_copy', 'Button text value cannot be empty');
  } else if (strlen($value) > 15) {
    $validity->add('empty_copy', 'Button text value cannot be greater that 15 symbols');
  }
  return $validity;
}

function weblx_theme_sanitize_text($input)
{
  $output = array();
  foreach ($input as $key => $v) {
    if (isset($input[$key])) {
      $output[$key] = strip_tags(stripslashes($input[$key]));
    }
  }
  return apply_filters('weblx_theme_sanitize_urls', $output, $input);
}

function weblx_theme_sanitize_urls($input)
{
  $output = array();
  foreach ($input as $key => $v) {
    if (isset($input[$key])) {
      $output[$key] = esc_url_raw(strip_tags(stripslashes($input[$key])));
    }
  }
  return apply_filters('weblx_theme_sanitize_urls', $output, $input);
}
