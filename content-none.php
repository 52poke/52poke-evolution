<?php
/**
 * The template for displaying a "No posts found" message
 *
 */
?>
    <article id="post-0" class="post no-results not-found pure-form">
        <header class="entry-header">
            <h1 class="entry-title">未找到</h1>
        </header>

        <div class="entry-content">
            <?php if ( is_search() ) : ?>

            <p>抱歉，没有符合您搜索条件的结果。请换其它关键词再试。</p>
            <?php get_search_form(); ?>

            <?php else : ?>

            <p>我们可能无法找到您需要的内容。或许搜索功能可以帮到您。</p>
            <?php get_search_form(); ?>

            <?php endif; ?>

        </div><!-- .entry-content -->
    </article><!-- #post-0 -->