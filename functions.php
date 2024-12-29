<?php

/**
 * Theme Functions
 * This file serves as an "import holder" for modular theme functions.
 */

// 1. Customizer settings
require_once get_template_directory() . '/assets/functions/adminpanel/customizer.php';


// 2. Main settings (Custom admin panel page)
require_once get_template_directory() . '/assets/functions/adminpanel/section.php';


// 3. Enqueue scripts and styles
require_once get_template_directory() . '/assets/functions/enqueue-scripts.php';


// 4. Helper functions
require_once get_template_directory() . '/assets/functions/helpers.php';