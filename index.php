<?php
/**
 * The main template file
 */
 get_header(); ?>

<section id="content" class="site-content multi-content pure-u-4-5">
    <?php
        if ( have_posts() ) : ?>
        <div class="article-container">
        <?php
            while ( have_posts() ) : the_post();

                get_template_part( 'content', get_post_format() );

            endwhile; ?>
        </div>
        <?php
            evolution_paging_nav();

        else :

            get_template_part( 'content', 'none' );

        endif;
    ?>
</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>