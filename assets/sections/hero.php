<section class="hero_block_p07c6b" role="doc-credit">
  <div class="hero_block_left_bzbb5l">
    <div class="hero_block__left__content">
      <div class="hero_block_main_img_kb3bwl">
        <?php
        $def_img = 'https://images.unsplash.com/photo-1514543250559-83867827ecce?q=80&amp;w=2850&amp;auto=format&amp;fit=crop&amp;ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D';
        $img = get_theme_mod('hero_setting_image');
        if (!$img)
          $img = $def_img;

        echo "<img src=\"$img\"></img>"
        ?>
      </div>
      <a href="https://example.com" style="color: var(--background);">Hidden Link</a>
    </div>
  </div>

  <div class="hero_block_right_6r9dz0">
    <div class="hero_block_right__content_2h9yzm">
      <h1 class="hero_block_title_dcfukm"><?php echo get_theme_mod('hero_setting_title') ?></h1>
      <h3 class="hero_block_subtitle_dfa0fm"><?php echo get_theme_mod('hero_setting_subtitle') ?></h3>
      <p class="hero_block_desc_pxc8fn"><?php echo get_theme_mod('hero_setting_desc') ?></p>
      <nav class="hero_block_nav_g6s6zi">
        <?php
        // Loop through buttons (adjust the range as needed for your buttons)
        for ($i = 1; $i <= 3; $i++) {
          $title = get_theme_mod("hero_btn_title_$i");
          $link = get_theme_mod("hero_btn_link_$i");

          if ($title && $link) {
            echo '<a href="' . esc_url($link) . '" class="hero_block_navlink_9ag8s8 is_' . "$i\">" . esc_html($title) . '</a>';
          }
        }
        ?>
      </nav>
    </div>
  </div>
</section>