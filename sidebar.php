<?php
/**
 * The sidebar
 * 
 */
?>

    <?php if ( is_active_sidebar( 'main-sidebar' ) ) : ?>
        <div id="secondary" class="widget-area pure-u-1-5">
            <?php dynamic_sidebar( 'main-sidebar' ); ?>
        </div><!-- #secondary -->
    <?php endif; ?>