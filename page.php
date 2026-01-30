<?php
/**
 * The template for displaying all single posts
 */
 get_header(); ?>

<section id="content" class="site-content page-content pure-u-4-5 pure-form">
    <?php
        while ( have_posts() ) : the_post();

            get_template_part( 'content', 'page' );

            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }

        endwhile;
    ?>
</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>