<?php
// Theme customizer.php


// - Main panel
function set_global_customizer($wp_customize)
{
  $wp_customize->add_panel(
    'global_panel',
    array(
      'title' => 'Main Theme Settings',
      'description' => "Most essential configurations for the elements in the header section.",
      'priority' => 10,
    )
  );

  getHeaderSection($wp_customize);
  getHeroSection($wp_customize);
}


// -- Main panel  => Header Settings
function getHeaderSection($wp_customize)
{
  // - Create section 
  $wp_customize->add_section('header_section', array(
    'title' => 'Header Settings',
    'priority' => 10,
    'panel' => 'global_panel'
  ));

  // -- Header Settings => Title setting 
  $wp_customize->add_setting('header_setting_title', array(
    'validate_callback' => function ($validity, $value) {
      return vs_validate_field($validity, $value, 30, "Title", true);
    },
    'sanitize_callback' => 'vs_sanitize_header',
    'default' => get_bloginfo('name') ?? 'Arturo Feeney'
  ));
  // --- Header Settings => Title setting => Control for it
  $wp_customize->add_control('header_title_control', array(
    'label' => 'Change header title',
    'type' => 'text',
    'section' => 'header_section',
    'settings' => 'header_setting_title',
  ));

  // -- Header Settings => Subtitle setting 
  $wp_customize->add_setting('header_setting_subtitle', array(
    'validate_callback' => function ($validity, $value) {
      return vs_validate_field($validity, $value, 30, "Subtitle", false);
    },
    'sanitize_callback' => 'vs_sanitize_header',
    'default' => get_bloginfo('description') ?? 'Interior Designer'
  ));
  // --- Header Settings => Subitle setting => Control for it
  $wp_customize->add_control('header_subtitle_control', array(
    'label' => 'Change header subtitle',
    'type' => 'text',
    'section' => 'header_section',
    'settings' => 'header_setting_subtitle',
  ));
}


// -- Main panel  => Hero Settings
function getHeroSection($wp_customize)
{
  $preset_data = [
    'title' => 'Welcome to my portfolio.',
    'sub' => 'A Bit About Me',
    'desc' => 'Every space has a story, and my mission is to bring it to life. I blend creativity with functionality to design interiors that inspire, comfort, and reflect your unique style.'
  ];
  // - Create section 
  $wp_customize->add_section('hero_section', array(
    'title' => 'Hero Settings',
    'priority' => 10,
    'panel' => 'global_panel'
  ));
  // -- Hero Settings => Title setting 
  $wp_customize->add_setting('hero_setting_title', array(
    'validate_callback' => function ($validity, $value) {
      return vs_validate_field($validity, $value, 40, "Title", true);
    },
    'sanitize_callback' => 'vs_sanitize_header',
    'default' => $preset_data['title']
  ));
  // --- Hero Settings => Title setting => Control for it
  $wp_customize->add_control('hero_title_control', array(
    'label' => 'Change hero title',
    'type' => 'text',
    'section' => 'hero_section',
    'settings' => 'hero_setting_title',
  ));
  // -- Hero Settings => Subtitle setting 
  $wp_customize->add_setting('hero_setting_subtitle', array(
    'validate_callback' => function ($validity, $value) {
      return vs_validate_field($validity, $value, 30, "Subtitle", false);
    },
    'sanitize_callback' => 'vs_sanitize_header',
    'default' => $preset_data['sub']
  ));
  // --- Hero Settings => Subitle setting => Control for it
  $wp_customize->add_control('hero_subtitle_control', array(
    'label' => 'Change hero subtitle',
    'type' => 'text',
    'section' => 'hero_section',
    'settings' => 'hero_setting_subtitle',
  ));
  // -- Hero Settings => Description setting 
  $wp_customize->add_setting('hero_setting_desc', array(
    'validate_callback' => function ($validity, $value) {
      return vs_validate_field($validity, $value, 280, "Description", false);
    },
    'sanitize_callback' => 'vs_sanitize_header',
    'default' => $preset_data['desc']
  ));
  // --- Hero Settings => Subitle setting => Control for it
  $wp_customize->add_control('hero_desc_control', array(
    'label' => 'Change hero description',
    'type' => 'text',
    'section' => 'hero_section',
    'settings' => 'hero_setting_desc',
  ));
}




// Append all panels using $customize_register wp hook
add_action('customize_register', 'set_global_customizer');




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
