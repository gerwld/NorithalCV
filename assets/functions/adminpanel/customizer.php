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

  getHeaderSection();
  getHeroSection();
  getFooterSection();
  getSocialsSection();
}


// -- Main panel  => Header Settings
function getHeaderSection()
{
  global $wp_customize;
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
function getHeroSection()
{
  global $wp_customize;
  $preset_data = [
    'title' => 'Welcome to my portfolio.',
    'sub' => 'A Bit About Me',
    'desc' => 'Every space has a story, and my mission is to bring it to life. I blend creativity with functionality to design interiors that inspire, comfort, and reflect your unique style.',
    'btn1_text' => 'Contact Me',
    'btn1_link' => '/contacts',
    'btn2_text' => 'Resume',
    'btn2_link' => '/resume',
    'btn3_text' => 'Projects',
    'btn3_link' => '/projects',
    'btn1_label' => 'First',
    'btn2_label' => 'Second',
    'btn3_label' => 'Third',
  ];
  $GLOBALS['preset_data'] = $preset_data;
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


  $setButtonByID = function ($id) {
    global $preset_data;
    global $wp_customize;
    if ($wp_customize && $id) {
      // -- Hero Settings => Button 1 Title 
      $wp_customize->add_setting("hero_btn_title_$id", array(
        'validate_callback' => function ($validity, $value) {
          return vs_validate_field($validity, $value, 15, "Button title", false);
        },
        'sanitize_callback' => 'vs_sanitize_header',
        'default' => $preset_data["btn$id" . "_text"]
      ));
      // --- Hero Settings => Subitle setting => Control for it
      $wp_customize->add_control("hero_btn_title_$id" . "_control", array(
        'label' => $preset_data["btn$id" . "_label"] . " button – Text",
        'type' => 'text',
        'section' => 'hero_section',
        'settings' => "hero_btn_title_$id",
      ));
      // -- Hero Settings => Button 1 Link
      $wp_customize->add_setting("hero_btn_link_$id", array(
        'validate_callback' => function ($validity, $value) {
          return vs_validate_field($validity, $value, 280, "Description", false);
        },
        'sanitize_callback' => 'wlx_sanitize_url',
        'default' => $preset_data["btn$id" . "_link"]
      ));
      // --- Hero Settings => Subitle setting => Control for it
      $wp_customize->add_control("hero_btn_link_$id" . "_control", array(
        'label' =>  $preset_data["btn$id" . "_label"] . " button – Link",
        'type' => 'text',
        'input_attrs' => array(
          'placeholder' => __('https://', 'directorist'),
        ),
        'section' => 'hero_section',
        'settings' => "hero_btn_link_$id",
      ));
    }
  };

  $setButtonByID(1);
  $setButtonByID(2);
  $setButtonByID(3);
}

// -- Main panel  => Footer Settings
function getFooterSection()
{
  global $wp_customize;
  $preset_data = [
    'footer_block1_title' => 'Email',
    'footer_block1_value' => '<a href="mailto://weblxapplications@gmail.com">weblxapplications@gmail.com</a>',
    'footer_block2_title' => 'Phone',
    'footer_block2_value' => '<a href="tel://18005550199"><span>+1(800)</span>555-0199</a>',
  ];
  $GLOBALS['preset_data'] = $preset_data;
  // - Create section 
  $wp_customize->add_section('footer_section', array(
    'title' => 'Footer Settings',
    'priority' => 10,
    'panel' => 'global_panel'
  ));


  $setSocialsByKey = function ($id) {
    global $preset_data;
    global $wp_customize;
    if ($wp_customize && $id) {
      // -- Footer Settings => Block 1 Title setting 
      $wp_customize->add_setting("footer_block$id", array(
        'validate_callback' => function ($validity, $value) {
          return vs_validate_field($validity, $value, 25, "Title", true);
        },
        'sanitize_callback' => 'vs_sanitize_header',
        'default' => $preset_data['footer_block' . $id . '_title']
      ));
      // --- Footer Settings => Block 1 Title setting => Control for it
      $wp_customize->add_control('footer_block' . $id . '_control', array(
        'label' => 'Block ' . $id . ' - Title',
        'type' => 'text',
        'section' => 'footer_section',
        'settings' => 'footer_block' . $id,
      ));

      // -- Footer Settings => Block 1 Value setting 
      $wp_customize->add_setting('footer_block' . $id . 'value', array(
        'validate_callback' => function ($validity, $value) {
          return vs_validate_field($validity, $value, 300, "Value", true);
        },
        'sanitize_callback' => 'vs_sanitize_header',
        'default' => $preset_data['footer_block' . $id . '_value']
      ));
      // --- Footer Settings => Block 1 Value setting => Control for it
      $wp_customize->add_control('footer_block' . $id . 'value_control', array(
        'label' => 'Block ' . $id . ' - Value (html)',
        'type' => 'textarea',
        'section' => 'footer_section',
        'settings' => 'footer_block' . $id . 'value',
      ));
    }
  };



  $setFooterBlockByID = function ($id) {
    global $preset_data;
    global $wp_customize;
    $prefix = 'footer_block' . $id;

    if ($wp_customize && $id) {

      // -- Footer Settings => Block Title setting 
      $wp_customize->add_setting("footer_block$id", array(
        'validate_callback' => function ($validity, $value) {
          return vs_validate_field($validity, $value, 25, "Title", true);
        },
        'sanitize_callback' => 'vs_sanitize_header',
        'default' => $preset_data[$prefix . '_title']
      ));
      // --- Footer Settings => Block Title setting => Control for it
      $wp_customize->add_control($prefix . '_control', array(
        'label' => 'Block ' . $id . ' - Title',
        'type' => 'text',
        'section' => 'footer_section',
        'settings' => $prefix,
      ));

      // -- Footer Settings => Block Value setting 
      $wp_customize->add_setting($prefix . '_value', array(
        'validate_callback' => function ($validity, $value) {
          return vs_validate_field($validity, $value, 300, "Value", true);
        },
        'sanitize_callback' => 'vs_sanitize_header',
        'default' => $preset_data[$prefix . '_value']
      ));
      // --- Footer Settings => Block Value setting => Control for it
      $wp_customize->add_control($prefix . 'value_control', array(
        'label' => 'Block ' . $id . ' - Value (html)',
        'type' => 'textarea',
        'section' => 'footer_section',
        'settings' => $prefix . '_value',
      ));

      // -- Footer Settings => Block Disable setting 
      $wp_customize->add_setting($prefix . '_disabled', array(
        'default' => false
      ));
      // --- Footer Settings => Block Disable setting => Control for it
      $wp_customize->add_control($prefix . 'disable_control', array(
        'label' => 'Hide Block',
        'type' => 'checkbox',
        'section' => 'footer_section',
        'settings' => $prefix . '_disabled',
      ));
    }
  };


  $setFooterBlockByID(1);
  $setFooterBlockByID(2);
}


// -- Main panel  => Social Links
function getSocialsSection()
{
  global $wp_customize;
  $socials_available = [
    'facebook', 'linkedin',
    'twitter', 'youtube',
    'instagram', 'dribble',
    'github', 'behance',
    'codepen', 'kofi',
    'telegram', 'tiktok',
  ];

  // - Create section 
  $wp_customize->add_section('socials_section', array(
    'title' => 'Social Links',
    'priority' => 10,
    'panel' => 'global_panel'
  ));


  $setSocialsByKey = function ($key) {
    global $preset_data;
    global $wp_customize;
    if ($wp_customize && $key) {
      // -- Footer Settings => Block 1 Title setting 
      $wp_customize->add_setting("social_$key", array(
        'validate_callback' => function ($validity, $value) {
          return vs_validate_field($validity, $value, 1500, "Link", false);
        },
        'sanitize_callback' => 'vs_sanitize_header',
        'default' => $preset_data['social_' . $key . '_title'] ?? ""
      ));
      // --- Footer Settings => Block 1 Title setting => Control for it
      $wp_customize->add_control('social_' . $key . '_control', array(
        'label' => ucfirst($key) . ' Link',
        'type' => 'text',
        'section' => 'socials_section',
        'settings' => "social_$key",
        'input_attrs' => array(
          'placeholder' => __('https://', 'directorist'),
        ),
      ));

    }
  };


  array_map($setSocialsByKey, $socials_available);


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
