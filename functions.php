<?php
//console.log alternative
function consolelog($data){ $output = $data; if (is_array($output)) $output = implode(',', $output); echo "<script>console.log('Debug Objects: " . $output . "' );</script>";}


//connect theme js files, etc
function enqueue_assets_main()
{
 wp_enqueue_style('styles', get_stylesheet_uri());
 wp_enqueue_style('font-montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap');
 wp_enqueue_style('font-roboto', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap');

 wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/index.js', '', '', true);
}
add_action('wp_enqueue_scripts', 'enqueue_assets_main');



//Add assets/js in theme-parts

function test_template_part_hook() {
 wp_enqueue_script('slider', get_template_directory_uri() . '/assets/js/slider.js', '', '', true);
} add_action( 'get_template_part_assets/sections/slider-block-bl', 'test_template_part_hook', 10 );

function connect_asset_js_header() {
 wp_enqueue_script('slider', get_template_directory_uri() . '/assets/js/header.js', '', '', true);
} add_action( 'get_template_part_assets/sections/slider-block-bl', 'connect_asset_js_header', 10 );


//*** add theme functional with hooks / params ***//
//add logo
if (function_exists('add_theme_support')) {
 add_theme_support( 'custom-logo', [
  'height'      => 50,
  'width'       => 140,
  'flex-width'  => false,
  'flex-height' => false,
  'header-text' => '',
  'unlink-homepage-logo' => false, 
 ] );
};

//disable admin bar by default
// add_filter('show_admin_bar', '__return_false');

//Add menu sections
function wpb_custom_new_menu(){
 register_nav_menus(
  array(
   'primary-menu' => __('Primary'),
   'footer-menu' => __('Footer Menu 1'),
   'footer-menu-2' => __('Footer Menu 2'),
   'footer-menu-3' => __('Footer Menu 3'),
  )
 );} add_action('init', 'wpb_custom_new_menu');

 // //Add admin panel css styles
function weblx_enqueue_styles($post_suffix){
 if (strpos($post_suffix, 'weblx') !== false) {
  wp_enqueue_style('my-theme-settings', get_template_directory_uri() . '/assets/styles/theme-settings.css');
 }
 wp_enqueue_style('my-theme-settings', get_template_directory_uri() . '/assets/styles/admin-settings.css');
}add_action('admin_enqueue_scripts', 'weblx_enqueue_styles', 10);
//*** add theme functional with hooks / params (end) ***//



//add weblx menu page
function weblx_create_menu_page()
{
 add_menu_page(
  'Norithal CV Theme Settings',
  'Norithal CV',
  'administrator',
  'norithal_cv_menu',
  'norithal_cv_menu_display',
  null,
  '32'
 );

 add_submenu_page(
  'norithal_cv_menu',
  'Main Settings - Norithal CV Theme',
  'Main Settings',
  'administrator',
  'norithal_cv_menu',
  'norithal_cv_mainsettings_display'
 );

 add_submenu_page(
  'norithal_cv_menu',
  'Header Settings - Norithal CV Theme',
  'Header',
  'administrator',
  'norithal_cv_header',
  'norithal_cv_header_display'
 );

 add_submenu_page(
  'norithal_cv_menu',
  'Contact Us Settings - Norithal CV Theme',
  'Contact Us',
  'administrator',
  'norithal_cv_contact_us',
  'norithal_cv_contactus_display'
 );

 add_submenu_page(
  'norithal_cv_menu',
  'Slider Settings - Norithal CV Theme',
  'Slider',
  'administrator',
  'norithal_cv_slider',
  'norithal_cv_slider_display'
 );
 add_submenu_page(
  'norithal_cv_menu',
  'Social Icons Settings - Norithal CV Theme',
  'Social Icons',
  'administrator',
  'norithal_cv_soc_icons',
  'norithal_cv_menu_soc_icons_display'
 );
}
add_action('admin_menu', 'weblx_create_menu_page');

function norithal_cv_menu_display() {
  echo '<h1>Norithal CV Theme Settings</h1>';
  // Your menu page content here
}


function norithal_cv_mainsettings_display() {
  echo '<h1>norithal_cv_mainsettings_display</h1>';
  // Your menu page content here
}

function norithal_cv_slider_display() {
  echo '<h1>norithal_cv_slider_display</h1>';
  // Your menu page content here
}




function norithal_cv_menu_soc_icons_display(){
?>
 <div class="wrap">
  <h2>Настройки Social Icons</h2>
  <!-- вывод ошибок -->
  <?php settings_errors(); ?>
  <form method="post" action="options.php" class="h2_hidden">
   <?php settings_fields('weblx_theme_sect1_options'); ?>
   <?php do_settings_sections('weblx_theme_sect1_options'); ?>
   <?php submit_button(); ?>
  </form>
 </div>
<?php
}

function norithal_cv_contactus_display(){
 ?>
  <div class="wrap">
   <h2>Настройки Contact Us Section</h2>
   <!-- вывод ошибок -->
   <?php settings_errors(); ?>
   <form method="post" action="options.php" class="h2_hidden">
    <?php settings_fields('weblx_theme_contact_options'); ?>
    <?php do_settings_sections('weblx_theme_contact_options'); ?>
    <?php submit_button(); ?>
   </form>
  </div>
 <?php
 }

 function norithal_cv_header_display() {
  ?>
  <div class="wrap">
   <h2>Настройки Header Section</h2>
   <!-- вывод ошибок -->
   <?php settings_errors(); ?>
   <form method="post" action="options.php" class="h2_hidden">
    <?php settings_fields('weblx_theme_header_options'); ?>
    <?php do_settings_sections('weblx_theme_header_options'); ?>
    <?php submit_button(); ?>
   </form>
  </div>
 <?php
 }


 //**** init & set soc icons subpage ****//
function weblx_theme_init_socicons_options()
{
 if (false == get_option('weblx_theme_sect1_options')) {
  add_option('weblx_theme_sect1_options');
 }
 add_settings_section(
  'weblx_sect1',
  'Social Icons',
  'weblx_sect1_callback',
  'weblx_theme_sect1_options'
 );

 add_settings_field(
  'twitter',
  'Twitter',
  'weblx_op_field_callback',
  'weblx_theme_sect1_options',
  'weblx_sect1',
  array(
   'id' => 'twitter',
   'option' => 'weblx_theme_sect1_options',
   'type' => 'text',
   'placeholder' => 'link'
  )
 );
 add_settings_field(
  'facebook',
  'Facebook',
  'weblx_op_field_callback',
  'weblx_theme_sect1_options',
  'weblx_sect1',
  array(
   'id' => 'facebook',
   'option' => 'weblx_theme_sect1_options',
   'type' => 'text',
   'placeholder' => 'link'
  )
 );
 add_settings_field(
  'linkedin',
  'Linkedin',
  'weblx_op_field_callback',
  'weblx_theme_sect1_options',
  'weblx_sect1',
  array(
   'id' => 'linkedin',
   'option' => 'weblx_theme_sect1_options',
   'type' => 'text',
   'placeholder' => 'link'
  )
 );
 add_settings_field(
  'youtube',
  'YouTube',
  'weblx_op_field_callback',
  'weblx_theme_sect1_options',
  'weblx_sect1',
  array(
   'id' => 'youtube',
   'option' => 'weblx_theme_sect1_options',
   'type' => 'text',
   'placeholder' => 'link'
  )
 );
 add_settings_field(
  'instagram',
  'Instagram',
  'weblx_op_field_callback',
  'weblx_theme_sect1_options',
  'weblx_sect1',
  array(
   'id' => 'instagram',
   'option' => 'weblx_theme_sect1_options',
   'type' => 'text',
   'placeholder' => 'link'
  )
 );
 add_settings_field(
  'dribble',
  'Dribble',
  'weblx_op_field_callback',
  'weblx_theme_sect1_options',
  'weblx_sect1',
  array(
   'id' => 'dribble',
   'option' => 'weblx_theme_sect1_options',
   'type' => 'text',
   'placeholder' => 'link'
  )
 );
 add_settings_field(
  'github',
  'GitHub',
  'weblx_op_field_callback',
  'weblx_theme_sect1_options',
  'weblx_sect1',
  array(
   'id' => 'github',
   'option' => 'weblx_theme_sect1_options',
   'type' => 'text',
   'placeholder' => 'link'
  )
 );

 register_setting(
  'weblx_theme_sect1_options',
  'weblx_theme_sect1_options',
  'weblx_theme_sanitize_urls'
 );
}
add_action('admin_init', 'weblx_theme_init_socicons_options');


//**** init & set contact subpage ****//
function weblx_theme_init_contact_options()
{
 if (false == get_option('weblx_theme_contact_options')) {
  add_option('weblx_theme_contact_options');
 }
 add_settings_section(
  'weblx_contact_hd',
  'Header and title',
  'weblx_contact_hd_callback',
  'weblx_theme_contact_options'
 );

 add_settings_field(
  'weblx_contact_hd_title',
  'Section Title',
  'weblx_op_field_callback',
  'weblx_theme_contact_options',
  'weblx_contact_hd',
  array(
   'id' => 'weblx_contact_hd_title',
   'type' => 'text',
   'option' => 'weblx_theme_contact_options'
  )
 );

 add_settings_field(
  'weblx_contact_hd_desc',
  'Section Descritpion',
  'weblx_op_field_callback',
  'weblx_theme_contact_options',
  'weblx_contact_hd',
  array(
   'id' => 'weblx_contact_hd_desc',
   'type' => 'textarea',
   'option' => 'weblx_theme_contact_options'
  )
 );
 add_settings_field(
  'weblx_contact_hd_placeholder',
  'Input placeholder value',
  'weblx_op_field_callback',
  'weblx_theme_contact_options',
  'weblx_contact_hd',
  array(
   'id' => 'weblx_contact_hd_placeholder',
   'type' => 'text',
   'option' => 'weblx_theme_contact_options'
  )
 );

 add_settings_field(
  'weblx_contact_hd_btn_text',
  'Button text value',
  'weblx_op_field_callback',
  'weblx_theme_contact_options',
  'weblx_contact_hd',
  array(
   'id' => 'weblx_contact_hd_btn_text',
   'type' => 'text',
   'option' => 'weblx_theme_contact_options'
  )
 );

 add_settings_field(
  'weblx_contact_hd_hide',
  'Hide Section',
  'weblx_op_field_callback',
  'weblx_theme_contact_options',
  'weblx_contact_hd',
  array(
   'id' => 'weblx_contact_hd_hide',
   'type' => 'checkbox',
   'option' => 'weblx_theme_contact_options'
  )
 );

 register_setting(
  'weblx_theme_contact_options',
  'weblx_theme_contact_options',
  'weblx_theme_sanitize_text'
 );
}
add_action('admin_init', 'weblx_theme_init_contact_options');

//**** init & set header subpage ****//
function weblx_theme_init_header_options()
{
 if (false === get_option('weblx_theme_header_options')) {
  add_option('weblx_theme_header_options');
 }
 add_settings_section(
  'weblx_header_hd',
  'Header Block Options',
  'weblx_header_hd_callback',
  'weblx_theme_header_options'
 );

 add_settings_section(
  'weblx_header_btn_hd',
  'Header Button Options',
  'weblx_header_btn_hd_callback',
  'weblx_theme_header_options'
 );

 add_settings_section(
  'weblx_header_il_hd',
  'Header Illustration Options',
  'weblx_header_il_hd_callback',
  'weblx_theme_header_options'
 );

 add_settings_field(
  'weblx_header_hd_title',
  'Header Title',
  'weblx_op_field_callback',
  'weblx_theme_header_options',
  'weblx_header_hd',
  array(
   'id' => 'weblx_header_hd_title',
   'type' => 'text',
   'option' => 'weblx_theme_header_options'
  )
 );
 add_settings_field(
  'weblx_header_hd_desc',
  'Header Description',
  'weblx_op_field_callback',
  'weblx_theme_header_options',
  'weblx_header_hd',
  array(
   'id' => 'weblx_header_hd_desc',
   'type' => 'textarea',
   'option' => 'weblx_theme_header_options'
  )
 );

 add_settings_field(
  'weblx_header_hd_btn_title',
  'Button text',
  'weblx_op_field_callback',
  'weblx_theme_header_options',
  'weblx_header_btn_hd',
  array(
   'id' => 'weblx_header_hd_btn_title',
   'type' => 'text',
   'option' => 'weblx_theme_header_options'
  )
 );
 add_settings_field(
  'weblx_header_hd_btn_link',
  'Button Link',
  'weblx_op_field_callback',
  'weblx_theme_header_options',
  'weblx_header_btn_hd',
  array(
   'id' => 'weblx_header_hd_btn_link',
   'type' => 'text',
   'option' => 'weblx_theme_header_options'
  )
 );

 echo get_option('weblx_theme_header_options')['weblx_header_hd_btn_newtab'] ?? 0; // Retrieve the options array


 add_settings_field(
  'weblx_header_hd_btn_newtab',
  'Open in a new tab',
  'weblx_op_field_callback',
  'weblx_theme_header_options',
  'weblx_header_btn_hd',
  array(
   'id' => 'weblx_header_hd_btn_newtab',
   'type' => 'checkbox',
   'option' => 'weblx_theme_header_options'
  )
 );

 add_settings_field(
  'weblx_header_hd_il_choose',
  'Select Illustration',
  'weblx_op_field_callback',
  'weblx_theme_header_options',
  'weblx_header_il_hd',
  array(
   'id' => 'weblx_header_hd_il_choose',
   'type' => 'text',
   'option' => 'weblx_theme_header_options'
  )
 );

 register_setting(
  'weblx_theme_header_options',
  'weblx_theme_header_options',
  "weblx_theme_sanitize_text"
 );
}
add_action('admin_init', 'weblx_theme_init_header_options');


//callbacks for show info
function weblx_sect1_callback(){
 echo '<p>Укажите ссылки на социальные сети:</p>';}

//callbacks for contact us
function weblx_contact_hd_callback(){
 echo '<p>Заполните данные секции:</p>';}

function weblx_op_field_callback($args) {
 $id = $args['id'];
 $option = $args['option'];
 $options = get_option($option);
 $val = '';
 $placeholder = '';
 if (isset($options[$id])) {
  $val = $options[$id];
 } 
 if(isset($args['placeholder']) && $args['placeholder'] === 'link') {
  $placeholder = 'https://'. $id .'.com/*';
 }
 if($args['type'] === 'textarea') {
 echo '<textarea size="36" rows="8" cols="36" style="resize: none;" id="' . $id . '" name="'. $option .'[' . $id . ']">'. $val .'</textarea>';
 }else if($args['type'] === 'checkbox') {
  echo '<input type="checkbox" id="' . $id . '" name="'. $option .'[' . $id . ']" value="1" ' . checked(1, $options[$id] ?? 0, false) . '/>';
 } else {
  echo '<input type="' . $args['type'] . '" placeholder="'. $placeholder .'" size="36" id="' . $id . '" name="'. $option .'[' . $id . ']" value="' . $val . '"/>';
 }
}

//callbacks for header section
function weblx_header_hd_callback() {
 echo '<h3>Заголовок и подзаголовок:</h3>';
}
function weblx_header_btn_hd_callback() {
 echo '<h3>Настройки кнопки:</h3>';
}

function weblx_header_il_hd_callback() {
 echo '<h3>Настройки иллюстрации:</h3>';
 }


//default values setters
function set_default_contact_hd(){
 $options = get_option('weblx_theme_contact_options');
  // to ensure that $options is an array
  if (!is_array($options)) {
    $options = [];
  }

 $setdefault = array_merge($options, array(
  'weblx_contact_hd_title' => $options['weblx_contact_hd_title'] ? $options['weblx_contact_hd_title'] : 'Contact Us',
  'weblx_contact_hd_desc' => $options['weblx_contact_hd_desc'] ? $options['weblx_contact_hd_desc'] : 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci aliquam libero laudantium cumque, aperiam quos nesciunt tempore, assumenda error veniam dolorum quidem.',
  'weblx_contact_hd_placeholder' => $options['weblx_contact_hd_placeholder'] ? $options['weblx_contact_hd_placeholder'] : 'Your email',
  'weblx_contact_hd_btn_text' => $options['weblx_contact_hd_btn_text'] ? $options['weblx_contact_hd_btn_text'] : 'Send',
  'weblx_contact_hd_hide' => $options['weblx_contact_hd_hide'],
 ));
 update_option('weblx_theme_contact_options', $setdefault);
} set_default_contact_hd();

function set_default_header_hd(){
 $options = get_option('weblx_theme_header_options');
 // to ensure that $options is an array
 if (!is_array($options)) {
  $options = [];
}
 $setdefault = array_merge($options, array(
  'weblx_header_hd_title' => $options['weblx_header_hd_title'] ? $options['weblx_header_hd_title'] : 'Norithal CV Theme',
  'weblx_header_hd_desc' => $options['weblx_header_hd_desc'] ? $options['weblx_header_hd_desc'] : 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis nulla neque, ratione sequi vel hic eveniet qui sit fuga laboriosam autem maxime ipsa nesciunt ipsum nisi fugit assumenda, consequatur blanditiis!',
  'weblx_header_hd_btn_title' => $options['weblx_header_hd_btn_title'] ? $options['weblx_header_hd_btn_title'] : 'Explore',
  'weblx_header_hd_btn_link' => $options['weblx_header_hd_btn_link'] ? $options['weblx_header_hd_btn_link'] : '#section-1',
 ));
 update_option('weblx_theme_header_options', $setdefault);
} set_default_header_hd();

//**** set main page in admin panel end ****//



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

// EXTRAS (Glob. functions, etc)

function inline_svg($relative_path) {
  $svg_file = get_template_directory() . '/' . ltrim($relative_path, '/');
  return (file_exists($svg_file)) ? file_get_contents($svg_file) : '<!-- SVG not found -->';
}