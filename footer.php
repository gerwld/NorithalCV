<footer class="main_footer">
  <div class="main_footer_content_h5umek ct_wrapper">
    <?php if (!get_theme_mod('footer_block1_disabled')): ?>
      <nav class="navleb_eiyrwd navleb__sect1">
        <label class="navleb_label_od8xfo"><?php echo get_theme_mod('footer_block1_title') ?></label>
        <span class="navleb_link_hbn9xu">
          <?php echo get_theme_mod('footer_block1_value') ?>
        </span>
      </nav>
    <?php endif; ?>
    <?php if (!get_theme_mod('footer_block2_disabled')): ?>
      <nav class="navleb_eiyrwd navleb__sect2">
        <label class="navleb_label_od8xfo"><?php echo get_theme_mod('footer_block2_title') ?></label>
        <span class="navleb_link_hbn9xu">
          <?php echo get_theme_mod('footer_block2_value') ?>
        </span>
      </nav>
    <?php endif; ?>

    <?php get_template_part('assets/sections/socials'); ?>

    <?php if (!get_theme_mod('footer_block2_disabled')): ?>
      <div class="lbcopght_j5q49j">
        <?php
        // Retrieve the value saved as HTML
        $data = get_theme_mod('footer_creds_value', '');

        // Convert to ASCII
        $asciiData = html_entity_decode($data, ENT_QUOTES | ENT_HTML5);

        // placeholders
        $asciiData = str_replace("&date", date('Y'), $asciiData);
        $asciiData = str_replace("&name", get_theme_mod('header_setting_title', ''), $asciiData);

        echo $asciiData;
        ?>
      </div>
    <?php endif; ?>

  </div>
</footer>
<?php wp_footer() ?>
</body>

</html>