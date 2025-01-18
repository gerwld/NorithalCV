<?php
// customizer.php



// ** ----------------------------------------------------- ** //
// ** --------------------- Validation  ------------------- ** //
// ** ----------------- & Sanitizing part  ---------------- ** //
// ** ----------------------------------------------------- ** //



function vs_sanitize_header($value)
{
  $value = sanitize_text_field($value);
  $value = trim($value);
  $value = esc_html($value);

  return $value;
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

function vs_sanitize_html($input)
{
  // Allow only specific HTML tags
  $allowed_tags = [
    'a' => [
      'href' => [],
      'title' => [],
      'target' => [],
      'class' => [],
    ],
    'br' => [],
    'em' => [],
    'strong' => [],
    'p' => [
      'class' => [],
    ],
    'div' => [
      'class' => [],
    ],
    'span' => [
      'class' => [],
    ],
    'ul' => [],
    'ol' => [],
    'li' => [],
  ];

  return wp_kses($input, $allowed_tags);
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
};

function wlx_sanitize_url($input)
{
  // Sanitize a single URL
  return esc_url_raw(strip_tags(stripslashes($input)));
};

function wlx_sanitize_menu_slug($input)
{
  // Sanitize the input as a slug
  return sanitize_title($input);
};

function wlx_sanitize_boolean($input)
{
  // Sanitizes boolean
  return !!$input;
};

// Define the sanitization callback function
function vs_sanitize_image($image)
{
  // Validate the URL or empty string
  $image = esc_url_raw($image);

  // Check if the image is an attachment and a valid image type
  $attachment_id = attachment_url_to_postid($image);
  if ($attachment_id && wp_attachment_is_image($attachment_id)) {
    return $image; // Return the valid image URL
  }

  return ''; // Return an empty string for invalid input
}






// ** ----------------------------------------------------- ** //
// ** --------------------- Validation  ------------------- ** //
// ** -------------- & Sanitizing part END  --------------- ** //
// ** ----------------------------------------------------- ** //


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
    'sanitize_callback' => 'vs_sanitize_header',
    'validate_callback' => function ($validity, $value) {
      return vs_validate_field($validity, $value, 30, "Title", true);
    },
    'default' => get_bloginfo('name') ?? 'Arturo Feeney'
  ));
  // --- Header Settings => Title setting => Control for it
  $wp_customize->add_control('header_title_control', array(
    'label' => 'Change header title',
    'type' => 'text',
    'section' => 'header_section',
    'settings' => 'header_setting_title',
  ));


  // --- Header Settings => Title setting => Partial for it
  if (isset($wp_customize->selective_refresh)) {
    $wp_customize->selective_refresh->add_partial('header_setting_title_partial', array(
      'selector'            => '.header_logo_name_sx1980',
      'settings'            => array('header_setting_title'),
      'fallback_refresh'    => true, // If JS is not supported
    ));
  }

  // -- Header Settings => Subtitle setting 
  $wp_customize->add_setting('header_setting_subtitle', array(
    'sanitize_callback' => 'vs_sanitize_header',
    'validate_callback' => function ($validity, $value) {
      return vs_validate_field($validity, $value, 30, "Subtitle", false);
    },
    'default' => get_bloginfo('description') ?? 'Interior Designer'
  ));
  // --- Header Settings => Subitle setting => Control for it
  $wp_customize->add_control('header_subtitle_control', array(
    'label' => 'Change header subtitle',
    'type' => 'text',
    'section' => 'header_section',
    'settings' => 'header_setting_subtitle',
  ));


  // Function to get available menus and return them as choices
  function my_get_menus_as_choices()
  {
    $menus = wp_get_nav_menus();
    $choices = array();

    // Loop through menus and prepare them as choices
    foreach ($menus as $menu) {
      $choices[$menu->term_id] = $menu->name;
    }

    return $choices;
  }
  // Header Settings => Choose Menu Setting
  $wp_customize->add_setting('wlx_header_menu', array(
    'default'   => '',
    'transport' => 'refresh',
    'sanitize_callback' => 'wlx_sanitize_menu_slug',
  ));

  // Header Settings => Choose Menu Setting => Control for it
  $wp_customize->add_control('wlx_header_menu_control', array(
    'label'    => 'Choose a menu',
    'section'  => 'header_section',
    'settings' => 'wlx_header_menu',
    'type'     => 'select',
    'choices'  => my_get_menus_as_choices(),
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
    'sanitize_callback' => 'vs_sanitize_header',
    'validate_callback' => function ($validity, $value) {
      return vs_validate_field($validity, $value, 100, "Title", true);
    },
    'default' => $preset_data['title']
  ));
  // --- Hero Settings => Title setting => Control for it
  $wp_customize->add_control('hero_title_control', array(
    'label' => 'Change hero title',
    'type' => 'text',
    'section' => 'hero_section',
    'settings' => 'hero_setting_title',
  ));

  // --- Hero Settings => Title setting => Partial for it
  if (isset($wp_customize->selective_refresh)) {
    $wp_customize->selective_refresh->add_partial('hero_setting_title_partial', array(
      'selector'            => '.hero_block_title_dcfukm',
      'settings'            => array('hero_setting_title'),
      'fallback_refresh'    => true, // If JS is not supported
    ));
  }


  // -- Hero Settings => Subtitle setting 
  $wp_customize->add_setting('hero_setting_subtitle', array(
    'sanitize_callback' => 'vs_sanitize_header',
    'validate_callback' => function ($validity, $value) {
      return vs_validate_field($validity, $value, 30, "Subtitle", false);
    },
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
    'sanitize_callback' => 'vs_sanitize_header',
    'validate_callback' => function ($validity, $value) {
      return vs_validate_field($validity, $value, 280, "Description", false);
    },
    'default' => $preset_data['desc']
  ));
  // --- Hero Settings => Subitle setting => Control for it
  $wp_customize->add_control('hero_desc_control', array(
    'label' => 'Change hero description',
    'type' => 'text',
    'section' => 'hero_section',
    'settings' => 'hero_setting_desc',
  ));

  // --- Hero Settings => Subitle setting => Partial for it
  if (isset($wp_customize->selective_refresh)) {
    $wp_customize->selective_refresh->add_partial('hero_setting_desc_partial', array(
      'selector'            => '.hero_block_desc_pxc8fn',
      'settings'            => array('hero_setting_desc'),
      'fallback_refresh'    => true, // If JS is not supported
    ));
  }



  $setButtonByID = function ($id) {
    global $preset_data;
    global $wp_customize;
    if ($wp_customize && $id) {
      // -- Hero Settings => Button 1 Title 
      $wp_customize->add_setting("hero_btn_title_$id", array(
        'default' => $preset_data["btn$id" . "_text"],
        'sanitize_callback' => 'vs_sanitize_header',
        'validate_callback' => function ($validity, $value) {
          return vs_validate_field($validity, $value, 50, "Button title", false);
        },
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
        'sanitize_callback' => 'wlx_sanitize_url',
        'validate_callback' => function ($validity, $value) {
          return vs_validate_field($validity, $value, 280, "Description", false);
        },
        'default' => $preset_data["btn$id" . "_link"]
      ));
      // --- Hero Settings => Subitle setting => Control for it
      $wp_customize->add_control("hero_btn_link_$id" . "_control", array(
        'label' =>  $preset_data["btn$id" . "_label"] . " button – Link",
        'type' => 'text',
        'input_attrs' => array(
          'placeholder' => 'https://',
        ),
        'section' => 'hero_section',
        'settings' => "hero_btn_link_$id",
      ));
    }
  };

  // --- Hero Settings => Button 1 setting => Partial for it
  if (isset($wp_customize->selective_refresh)) {
    $wp_customize->selective_refresh->add_partial('hero_btn_title_1_partial', array(
      'selector'            => '.hero_block_nav_g6s6zi',
      'settings'            => array('hero_btn_title_1'),
      'fallback_refresh'    => true, // If JS is not supported
    ));
  }

  // --- Hero Settings => Image setting
  $wp_customize->add_setting('hero_setting_image', array(
    'sanitize_callback' => 'vs_sanitize_image',
    'default'   => '',
    'transport' => 'refresh',
  ));

  // --- Hero Settings => Image setting => Control for it
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_setting_image', array(
    'label'    => 'Change Hero Image',
    'section'  => 'hero_section',
    'settings' => 'hero_setting_image',
  )));

  // --- Hero Settings => Subitle setting => Partial for it
  if (isset($wp_customize->selective_refresh)) {
    $wp_customize->selective_refresh->add_partial('hero_setting_image_partial', array(
      'selector'            => '.hero_block_main_img_kb3bwl',
      'settings'            => array('hero_setting_image'),
      'fallback_refresh'    => true, // If JS is not supported
    ));
  }

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
    'footer_block1_value' => "<a href=\"mailto://weblxapplications@gmail.com\">weblxapplications@gmail.com</a>",
    'footer_block2_title' => 'Phone',
    'footer_block2_value' => "<a href=\"tel://18005550199\">\r\n  <span>+1(800)</span>555-0199\r\n</a>",
  ];

  $GLOBALS['preset_data'] = $preset_data;
  // - Create section 
  $wp_customize->add_section('footer_section', array(
    'title' => 'Footer Settings',
    'priority' => 10,
    'panel' => 'global_panel'
  ));



  $setFooterBlockByID = function ($id) {
    global $preset_data;
    global $wp_customize;
    $prefix = 'footer_block' . $id;

    if ($wp_customize && $id) {

      // -- Footer Settings => Block Title setting 
      $wp_customize->add_setting($prefix . "_title", array(
        'sanitize_callback' => 'vs_sanitize_header',
        'validate_callback' => function ($validity, $value) {
          return vs_validate_field($validity, $value, 25, "Title", true);
        },
        'default' => $preset_data[$prefix . '_title']
      ));
      // --- Footer Settings => Block Title setting => Control for it
      $wp_customize->add_control($prefix . 'title_control', array(
        'label' => 'Block ' . $id . ' - Title',
        'type' => 'text',
        'section' => 'footer_section',
        'settings' => $prefix . "_title",
      ));


      // --- Hero Settings => Button 1 setting => Partial for it
      if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial($prefix . '_partial', array(
          'selector'            => '.navleb__sect' . $id,
          'settings'            => $prefix . "_title",
          'fallback_refresh'    => true, // If JS is not supported
        ));
      }


      // -- Footer Settings => Block Value setting 
      $wp_customize->add_setting($prefix . '_value', array(
        'sanitize_callback' => 'vs_sanitize_html',
        'validate_callback' => function ($validity, $value) {
          return vs_validate_field($validity, $value, 300, "Value", true);
        },
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
        'sanitize_callback' => 'wlx_sanitize_boolean',
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

  $setFooterCredsBlock = function () {
    global $wp_customize;
    $preset_data = [
      'footer_creds_value' => "<span>© &date, &name.</span>\r\n<span>All rights reserved.</span>",
    ];

    // -- Footer Settings => Creds Value setting 
    $wp_customize->add_setting('footer_creds_value', array(
      'sanitize_callback' => 'vs_sanitize_html',
      'validate_callback' => function ($validity, $value) {
        return vs_validate_field($validity, $value, 300, "Value", true);
      },
      'default' => $preset_data['footer_creds_value'],
      // 'transport' => 'postMessage', // Add transport for live preview
    ));
    // --- Footer Settings => Creds Value setting => Control for it
    $wp_customize->add_control('footer_block_control', array(
      'label' => 'Credentials Block - Value (html)',
      'type' => 'textarea',
      'section' => 'footer_section',
      'settings' => 'footer_creds_value',
    ));

    // --- Footer Settings => Creds Value setting => Partial for it
    if (isset($wp_customize->selective_refresh)) {
      $wp_customize->selective_refresh->add_partial('footer_creds_value_partial', array(
        'selector'            => '.lbcopght_j5q49j',
        'settings'            => "footer_creds_value",
        'fallback_refresh'    => true, // If JS is not supported
      ));
    };

    // -- Footer Settings => Block Disable setting 
    $wp_customize->add_setting('footer_creds_disabled', array(
      'sanitize_callback' => 'wlx_sanitize_boolean',
      'default' => false
    ));
    // --- Footer Settings => Block Disable setting => Control for it
    $wp_customize->add_control('footer_creds_disabled_control', array(
      'label' => 'Hide Block',
      'type' => 'checkbox',
      'section' => 'footer_section',
      'settings' => 'footer_creds_disabled',
    ));
  };


  $setFooterBlockByID(1);
  $setFooterBlockByID(2);
  $setFooterCredsBlock();
}


// -- Main panel  => Social Links
function getSocialsSection()
{
  global $wp_customize;
  $socials_available = [
    'facebook',
    'linkedin',
    'twitter',
    'youtube',
    'instagram',
    'dribble',
    'github',
    'behance',
    'codepen',
    'kofi',
    'telegram',
    'tiktok',
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
      // -- Footer Settings => Block N Title setting 
      $wp_customize->add_setting("social_$key", array(
        'sanitize_callback' => 'vs_sanitize_header',
        'validate_callback' => function ($validity, $value) {
          return vs_validate_field($validity, $value, 1500, "Link", false);
        },
        'default' => $preset_data['social_' . $key . '_title'] ?? ""
      ));
      // --- Footer Settings => Block N Title setting => Control for it
      $wp_customize->add_control('social_' . $key . '_control', array(
        'label' => ucfirst($key) . ' Link',
        'type' => 'text',
        'section' => 'socials_section',
        'settings' => "social_$key",
        'input_attrs' => array(
          'placeholder' => 'https://',
        ),
      ));
    }
  };

  // --- Socials Settings => Block  $socials_available[0] Title setting => Partial for it
  if (isset($wp_customize->selective_refresh)) {
    $wp_customize->selective_refresh->add_partial('social_' . $socials_available[0] . '_partial', array(
      'selector'            => '.soc_links_dsivaj',
      'settings'            => 'social_' . $socials_available[0],
      'fallback_refresh'    => true, // If JS is not supported
    ));
  };


  $wp_customize->add_setting("social_colors_hover", array(
    'sanitize_callback' => 'wlx_sanitize_boolean',
    'default' => false,
  ));
  // --- Footer Settings => Block 1 Title setting => Control for it
  $wp_customize->add_control('social_colors_hover_control', array(
    'label' => 'Set brand color on hover',
    'type' => 'checkbox',
    'section' => 'socials_section',
    'settings' => "social_colors_hover",
  ));


  array_map($setSocialsByKey, $socials_available);
}


// Append all panels using $customize_register wp hook
add_action('customize_register', 'set_global_customizer');
