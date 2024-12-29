<?php

function reset_all_customizer_settings() {
    remove_theme_mods(); // Removes all saved Customizer settings for the current theme.
}
add_action('admin_init', 'reset_all_customizer_settings');