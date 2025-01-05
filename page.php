<?php

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package norithal
 * @since 1.0.0
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header(); ?>
<div class="single_block content_wrapper">
	<div class="main-heading">
		<h1><?php the_title(); ?></h1>
	</div>
	<section>
		<?php if (have_posts()): while (have_posts()): the_post(); ?>
				<?php the_content(); ?>
		<?php endwhile;
		endif; ?>
	</section>
</div>

<?php get_footer(); ?>