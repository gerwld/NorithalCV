<?php
if ( have_posts() ) :
    while ( have_posts() ) : the_post();
?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header>
                <h1><?php the_title(); ?></h1>
                <p>Posted on <?php the_date(); ?> by <?php the_author(); ?></p>
            </header>
            <div class="content">
                <?php the_content(); ?>
            </div>
            <footer>
                <p><?php the_tags(); ?></p>
            </footer>
        </article>
<?php
    endwhile;
else :
    echo '<p>No posts found.</p>';
endif;
?>
