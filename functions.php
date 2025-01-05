<?php

/**
 * Theme Functions
 * This file serves as a central import hub for modularized theme functionalities, ensuring a clean and maintainable structure.
 */

/**
 * 1. Initialize Core Settings
 * Loads foundational settings and configurations for the WordPress admin panel.
 **/
require_once get_template_directory() . '/assets/functions/adminpanel/initialize.php';

/**
 * 2. Customizer Integration
 * Enables theme customization options through the WordPress Customizer interface.
 **/
require_once get_template_directory() . '/assets/functions/adminpanel/customizer.php';


/**
 * 3. Asset Management
 * Enqueues essential scripts and stylesheets to ensure proper loading and performance optimization.
 **/
require_once get_template_directory() . '/assets/functions/enqueue-scripts.php';

/**
 * 4. Utility and Helper Functions
 * Includes reusable helper methods to streamline theme development and enhance code reusability.
 **/
require_once get_template_directory() . '/assets/functions/helpers.php';

/**
 * Developer's Note: Avoid adding custom code directly to this file. 
 * For maintainability and to preserve changes during theme updates, use a custom plugin. 
 * Reference: https://github.com/woocommerce/theme-customisations
 */
