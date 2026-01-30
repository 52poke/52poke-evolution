<?php
/**
 * The template for displaying the footer
 *
 */
?>
        </main>

        <footer class="site-footer" style="padding-left: calc(env(safe-area-inset-left) - 20px); padding-right: calc(env(safe-area-inset-right) - 20px); padding-bottom: env(safe-area-inset-bottom)">
            <?php
            $host = isset( $_SERVER['HTTP_HOST'] ) ? strtolower( $_SERVER['HTTP_HOST'] ) : '';
            $is_52poke_domain = ( $host === '52poke.com' || $host === '52poke.net' );
            if ( ! $is_52poke_domain && $host !== '' ) {
                $is_52poke_domain = (
                    substr( $host, -strlen( '.52poke.com' ) ) === '.52poke.com' ||
                    substr( $host, -strlen( '.52poke.net' ) ) === '.52poke.net'
                );
            }
            ?>
            <?php if ( $is_52poke_domain ) : ?>
                <p>&copy; 2005-<?php echo date( 'Y', current_time( 'timestamp' ) ); ?> 52Poké. <a rel="license" title="署名-非商业性使用-相同方式共享 3.0" href="http://creativecommons.org/licenses/by-nc-sa/3.0/deed.zh">Some rights reserved</a> | Designed by <a href="http://wiki.52poke.com/wiki/User:%E9%98%BF%E5%B8%83">hikarievo</a> | <a href="http://52poke.com/about/#legal">Legal Info</a></p>
            <?php else : ?>
                <p>&copy; <?php echo date( 'Y', current_time( 'timestamp' ) ); ?> <?php bloginfo( 'name' ); ?> | Designed by <a href="http://wiki.52poke.com/wiki/User:%E9%98%BF%E5%B8%83">hikarievo</a></p>
            <?php endif; ?>

            <div class="footer-line-shape"></div>

            <p>Pokémon ©<?php echo date( 'Y', current_time( 'timestamp' ) ); ?> Pokémon. ©1995-<?php echo date( 'Y', current_time( 'timestamp' ) ); ?> Nintendo/Creatures Inc. /GAME FREAK inc. "宝可梦"是任天堂的商标</p>
            <span class="footer-poke-ball-shape"></span>
        </footer>
    </div><!-- #page -->

    <?php wp_footer(); ?>
</body>
</html>
