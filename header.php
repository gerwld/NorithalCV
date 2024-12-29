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
        <a href="/" class="header_logo_link_tkq9k6" role="header-logo-link">
          <div class="header_logo_icon_zxi7wp">ic</div>
          <span class="header_logo_name_sx1980"><?php echo get_theme_mod('header_setting_title') ?></span>
        </a>
        <span class="header_logo_sub_ahif43"><?php echo get_theme_mod('header_setting_desc') ?></span>
      </div>

      <nav class="header_navigation">

        <ul class="header_navigation_list_adkb1t" role="navigation">
          <li class="header_navigation_item_qpbg9x">
            <a href="#" class="header_navigation_link_j1ph9o">Resume</a>
          </li>
          <li class="header_navigation_item_qpbg9x">
            <a href="#" class="header_navigation_link_j1ph9o">Project</a>
          </li>
          <li class="header_navigation_item_qpbg9x">
            <a href="#" class="header_navigation_link_j1ph9o">Contacts</a>
          </li>

          <div class="mobile_header_buttons_lw7g60 header_navigation_buttons_21q1vu">
            <button id="ltbtn_theme" title="Theme">
              <svg class="light" viewbox="0 0 53.6 54.1">
                <path fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" d="M45.8,32.6
c-2.4,7.6-9.4,13.3-17.8,13.6c-10.7,0.4-19.8-8-20.2-18.8c-0.3-9.2,5.6-17.1,14-19.5c-0.7,2.1-1,4.3-0.9,6.7
c0.4,10.8,9.4,19.2,20.2,18.8C42.7,33.3,44.3,33,45.8,32.6L45.8,32.6z"></path>
              </svg>
              <svg class="dark hidden" viewbox="0 0 59.2 59.2">
                <circle fill="none" stroke="currentColor" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" cx="29.5" cy="29.6" r="12"></circle>
                <line fill="none" stroke="currentColor" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" x1="7.6" y1="29.6" x2="2.5" y2="29.6"></line>
                <line fill="none" stroke="currentColor" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" x1="56.6" y1="29.6" x2="51.5" y2="29.6"></line>
                <line fill="none" stroke="currentColor" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" x1="14" y1="14" x2="10.4" y2="10.5"></line>
                <line fill="none" stroke="currentColor" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" x1="48.7" y1="48.7" x2="45.1" y2="45.1"></line>
                <line fill="none" stroke="currentColor" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" x1="14" y1="45.1" x2="10.4" y2="48.7"></line>
                <line fill="none" stroke="currentColor" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" x1="48.7" y1="10.5" x2="45.1" y2="14"></line>
                <line fill="none" stroke="currentColor" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" x1="29.5" y1="51.6" x2="29.5" y2="56.6"></line>
                <line fill="none" stroke="currentColor" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" x1="29.5" y1="2.6" x2="29.5" y2="7.6"></line>
              </svg>
            </button>

            <button id="ltbtn_lang" title="Select Language">
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewbox="0 0 512 512">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="34" d="M48 112h288M192 64v48m80 336l96-224l96 224m-162.5-64h133M281.3 112S257 206 199 277S80 384 80 384"></path>
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M256 336s-35-27-72-75s-56-85-56-85"></path>
              </svg>
            </button>
          </div>

        </ul>

        <div class="header_navigation_buttons_21q1vu">
          <button id="ltbtn_theme" title="Theme">
            <svg class="light" viewbox="0 0 53.6 54.1">
              <path fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" d="M45.8,32.6
c-2.4,7.6-9.4,13.3-17.8,13.6c-10.7,0.4-19.8-8-20.2-18.8c-0.3-9.2,5.6-17.1,14-19.5c-0.7,2.1-1,4.3-0.9,6.7
c0.4,10.8,9.4,19.2,20.2,18.8C42.7,33.3,44.3,33,45.8,32.6L45.8,32.6z"></path>
            </svg>
            <svg class="dark hidden" viewbox="0 0 59.2 59.2">
              <circle fill="none" stroke="currentColor" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" cx="29.5" cy="29.6" r="12"></circle>
              <line fill="none" stroke="currentColor" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" x1="7.6" y1="29.6" x2="2.5" y2="29.6"></line>
              <line fill="none" stroke="currentColor" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" x1="56.6" y1="29.6" x2="51.5" y2="29.6"></line>
              <line fill="none" stroke="currentColor" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" x1="14" y1="14" x2="10.4" y2="10.5"></line>
              <line fill="none" stroke="currentColor" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" x1="48.7" y1="48.7" x2="45.1" y2="45.1"></line>
              <line fill="none" stroke="currentColor" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" x1="14" y1="45.1" x2="10.4" y2="48.7"></line>
              <line fill="none" stroke="currentColor" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" x1="48.7" y1="10.5" x2="45.1" y2="14"></line>
              <line fill="none" stroke="currentColor" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" x1="29.5" y1="51.6" x2="29.5" y2="56.6"></line>
              <line fill="none" stroke="currentColor" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" x1="29.5" y1="2.6" x2="29.5" y2="7.6"></line>
            </svg>
          </button>

          <button id="ltbtn_lang" title="Select Language">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewbox="0 0 512 512">
              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="34" d="M48 112h288M192 64v48m80 336l96-224l96 224m-162.5-64h133M281.3 112S257 206 199 277S80 384 80 384"></path>
              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M256 336s-35-27-72-75s-56-85-56-85"></path>
            </svg>
          </button>
          <button id="ltbtn_mobmenu" title="Menu">
            <span>Menu</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewbox="0 0 24 24">
              <path fill="currentColor" d="m12 15.4l-6-6L7.4 8l4.6 4.6L16.6 8L18 9.4z"></path>
            </svg>
          </button>
        </div>
      </nav>

    </div>
  </header>

  


  <!-- get_theme_mod -->

  <!-- <nav class="main-nav desktop_menu_el" id="main-desktop-nav">
    <?php $has_items_prim = wp_nav_menu(array('theme_location' => 'primary-menu', 'echo' => false)) !== false; ?>
    <?php if ($has_items_prim) {
      wp_nav_menu(array(
        'theme_location' => 'primary-menu'
      ));
    } else wp_nav_menu(array('menu' => 'primary')); ?>
  </nav> -->