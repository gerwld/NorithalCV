<?php


//Theme customizer.php new settings
function set_menus_panel($wp_customize)
{
  $wp_customize->add_panel(
    'menu_select_panel',
    array(
      'title' => 'Header settings',
      'description' => "Most important settings for the elements in the header section.",
      'priority' => 10,
    )
  );

  //header title settings
  $wp_customize->add_section('header_sect_title', array(
    'title' => 'Header Title',
    'priority' => 10,
    'panel' => 'menu_select_panel'
  ));

  $wp_customize->add_section('header_sect_subtitle', array(
    'title' => 'Header Subtitle',
    'priority' => 10,
    'panel' => 'menu_select_panel'
  ));

  $wp_customize->add_setting('header_setting_title', array(
    'validate_callback' => 'true_validate_header',
    'sanitize_callback' => 'true_sanitize_header',
    'default' => 'Arturo Feeney'
  ));

  $wp_customize->add_setting('header_setting_desc', array(
    'validate_callback' => 'true_validate_header',
    'sanitize_callback' => 'true_sanitize_header',
    'default' => 'Interior Designer'
  ));

  $wp_customize->add_setting('header_subtitle', array(
    'default' => false
  ));

  $wp_customize->add_control('header_title_control', array(
    'label' => 'Change header title',
    'type' => 'text',
    'section' => 'header_sect_title',
    'settings' => 'header_setting_title',
  ));

  $wp_customize->add_control('header_subtitle_control', array(
    'label' => 'Change header subtitle',
    'type' => 'text',
    'section' => 'header_sect_subtitle',
    'settings' => 'header_setting_desc',
  ));

  //  $wp_customize->add_control('header_subtitle_control', array(
  //   'label' => 'Show header description',
  //   'description' => "*for change the description go to the site settings tab.",
  //   'type' => 'checkbox',
  //   'section' => 'header_sect_title',
  //   'settings' => 'header_subtitle',
  //  ));
  //header title settings end

  //primary section contact button
  //  $wp_customize->add_section(
  //   'contactbtn_menu_primary_section',
  //   array(
  //    'title' => 'Header Button',
  //    'priority' => 10,
  //    'panel' => 'menu_select_panel'
  //   )
  //  );

  $wp_customize->add_setting(
    'contactbtn_menu_primary_text',
    array(
      'validate_callback' => 'true_validate_cbtn_text',
      'sanitize_callback' => 'sanitize_text_field',
      'default' => 'Contact Us'
    )
  );
  $wp_customize->add_setting(
    'contactbtn_menu_primary_link',
    array(
      'validate_callback' => 'true_validate_cbtn_link',
      'sanitize_callback' => 'sanitize_text_field',
      'default' => '#contact-us'
    )
  );
  $wp_customize->add_setting(
    'contactbtn_menu_primary_show',
    array(
      'default' => true
    )
  );
  $wp_customize->add_setting(
    'contactbtn_menu_primary_innewwindow',
    array(
      'default' => false
    )
  );

  $wp_customize->add_control(
    'contactbtn_menu_primary_control-3',
    array(
      'label' => 'Show button',
      'type' => 'checkbox',
      'section' => 'contactbtn_menu_primary_section',
      'settings' => 'contactbtn_menu_primary_show',
    )
  );

  $wp_customize->add_control(
    'contactbtn_menu_primary_control-1',
    array(
      'label' => 'Button text',
      'type' => 'text',
      'section' => 'contactbtn_menu_primary_section',
      'settings' => 'contactbtn_menu_primary_text',
    )
  );

  $wp_customize->add_control(
    'contactbtn_menu_primary_control-2',
    array(
      'label' => 'Button link',
      'type' => 'text',
      'description' => 'http://*, https://*, /* or #id',
      'section' => 'contactbtn_menu_primary_section',
      'settings' => 'contactbtn_menu_primary_link',
    )
  );

  $wp_customize->add_control(
    'contactbtn_menu_primary_control-4',
    array(
      'label' => 'Open link in a new tab',
      'type' => 'checkbox',
      'section' => 'contactbtn_menu_primary_section',
      'settings' => 'contactbtn_menu_primary_innewwindow',
    )
  );
  //primary section contact button end
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