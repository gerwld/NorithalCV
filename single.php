<?php get_header(); ?>
<div class="single_block content_wrapper">
<div class="main-heading">
	<h1><?php the_title(); ?></h1>
</div>
<section>
<?php
    // The Loop to display the single post
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            // Display post title
            the_title( '<h1 class="entry-title">', '</h1>' );

            // Display post content
            the_content();

            // Add pagination for multi-page posts
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'norithalcv-pure' ),
                'after'  => '</div>',
            ) );
        endwhile;
    endif;
    ?>
</section>
</div>

<?php get_footer(); ?>


