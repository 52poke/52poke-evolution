<?php
/**
 * The default template for displaying content
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
            if ( is_single() ) :
                the_title( '<h1 class="entry-title">', '</h1>' );
            else :
                the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
            endif;
        ?>
    </header><!-- .entry-header -->

    <?php if ( is_search() ) : ?>
    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div><!-- .entry-summary -->
    <?php else : ?>
    <div class="entry-content">
        <?php
            if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'post-thumbnail', array( 'class' => 'aligncenter' ) );
            }
            the_content( '继续阅读 <span class="meta-nav">&rarr;</span>' );
            wp_link_pages( array(
                'before'      => '<div class="page-links"><span class="page-links-title">页码：</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
            ) );
        ?>
    </div><!-- .entry-content -->
    <?php endif; ?>
    <footer class="entry-meta">
        <time class="entry-date" datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?> <?php echo get_the_time(); ?></time>

        <span class="cat-links"><?php echo get_the_category_list( ',' ); ?></span>
		<span><?php echo get_the_author() ?></span>
        <?php
            if ( is_single() ) : the_tags( '<span class="tag-links">', '', '</span>' ); endif;

            if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
        ?>
        <span class="comments-link"><?php comments_popup_link( '发表回复', '1条评论', '%条评论' ); ?></span>
        <?php
            endif;

            edit_post_link( '编辑', '<span class="edit-link">', '</span>' );
        ?>
    </footer>
</article><!-- #post-## -->