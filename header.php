<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-type" content="text/html; charset=<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <title><?php wp_title('-', true, 'right'); ?> <?php bloginfo('name'); ?></title>
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php
  wp_body_open();
  ?>
  <!-- HEADER PART -->
  <header class="header_45k1js header_fixed_5qttxp header_fixed_rounded_hh90or">
    <div class="header_content_66solo ct_wrapper sides_gap_51gyxe">

      <div class="header_logo_kn8mrg">
        <a href="<?php echo home_url(); ?>" class="header_logo_link_tkq9k6" role="header-logo-link">
          <div class="header_logo_icon_zxi7wp">ic</div>
          <span class="header_logo_name_sx1980">
            <?php echo get_theme_mod('header_setting_title');?>
          </span>
        </a>
        <span class="header_logo_sub_ahif43">
          <?php echo get_theme_mod('header_setting_subtitle');?>
          </span>
      </div>

      <nav class="header_navigation">

        <ul class="header_navigation_list_adkb1t" role="navigation">

          <?php
          $menu_id = get_theme_mod('wlx_header_menu');
          if ($menu_id) :
            wp_nav_menu(array('menu' => $menu_id));
          else :
            echo '<p>No menu selected.</p>';
          endif;
          ?>

          <div class="mobile_header_buttons_lw7g60 header_navigation_buttons_21q1vu">
            <button id="ltbtn_theme" title="Theme">
              <?php echo inline_svg('assets/img/icons/theme_light.svg'); ?>
              <?php echo inline_svg('assets/img/icons/theme_dark.svg'); ?>
            </button>

            <button id="ltbtn_lang" title="Select Language">
              <?php echo inline_svg('assets/img/icons/lang.svg'); ?>
            </button>
          </div>

        </ul>

        <div class="header_navigation_buttons_21q1vu">
          <button id="ltbtn_theme" title="Theme">
            <?php echo inline_svg('assets/img/icons/theme_light.svg'); ?>
            <?php echo inline_svg('assets/img/icons/theme_dark.svg'); ?>
          </button>

          <button id="ltbtn_lang" title="Select Language">
            <?php echo inline_svg('assets/img/icons/lang.svg'); ?>
          </button>

          <button id="ltbtn_mobmenu" title="Menu">
            <span>Menu</span>
            <?php echo inline_svg('assets/img/icons/menu.svg'); ?>
          </button>
        </div>
      </nav>

    </div>
  </header>