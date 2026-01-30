<?php

if ( ! function_exists( 'evolution_setup' ) ) :
/**
 * 52Poké Evolution setup
 */
function evolution_setup() {

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );

    register_nav_menus( array(
        'primary'   => '头部菜单栏',
    ) );

    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list',
    ) );
}
endif;
add_action( 'after_setup_theme', 'evolution_setup' );

function evolution_widgets_init() {
    register_sidebar( array(
        'name'          => '侧边栏',
        'id'            => 'main-sidebar',
        'description'   => '页面中的侧边栏',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'evolution_widgets_init' );

function evolution_scripts() {
    // Main stylesheet
    $style_min_path = get_stylesheet_directory() . '/style.min.css';
    $style_uri = get_stylesheet_uri();
    $style_version = '20140815';
    if ( file_exists( $style_min_path ) ) {
        $style_uri = get_stylesheet_directory_uri() . '/style.min.css';
        $style_version = filemtime( $style_min_path );
    }
    wp_enqueue_style( 'evolution-style', $style_uri, array(), $style_version );

    // Masonry + imagesLoaded (core handles)
    wp_enqueue_script( 'masonry' );
    wp_enqueue_script( 'imagesloaded' );

    $script_min_path = get_template_directory() . '/js/functions.min.js';
    $script_uri = get_template_directory_uri() . '/js/functions.js';
    $script_version = '20260130';
    if ( file_exists( $script_min_path ) ) {
        $script_uri = get_template_directory_uri() . '/js/functions.min.js';
        $script_version = filemtime( $script_min_path );
    }

    wp_enqueue_script( 'evolution-script', $script_uri, array( 'masonry', 'imagesloaded' ), $script_version, true );
}
add_action( 'wp_enqueue_scripts', 'evolution_scripts' );

if ( ! function_exists( 'evolution_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 * 
 * @return void
 */
function evolution_paging_nav() {
    // Don't print empty markup if there's only one page.
    if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
        return;
    }

    $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $query_args   = array();
    $url_parts    = explode( '?', $pagenum_link );

    if ( isset( $url_parts[1] ) ) {
        wp_parse_str( $url_parts[1], $query_args );
    }

    $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
    $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

    $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
    $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

    // Set up paginated links.
    $links = paginate_links( array(
        'base'     => $pagenum_link,
        'format'   => $format,
        'total'    => $GLOBALS['wp_query']->max_num_pages,
        'current'  => $paged,
        'mid_size' => 1,
        'add_args' => array_map( 'urlencode', $query_args ),
        'prev_text' => '&larr; 上一页',
        'next_text' => '下一页 &rarr;',
    ) );

    if ( $links ) :

    ?>
    <nav class="navigation paging-navigation" role="navigation">
        <div class="pagination loop-pagination">
            <?php echo $links; ?>
        </div><!-- .pagination -->
    </nav><!-- .navigation -->
    <?php
    endif;
}
endif;

if ( ! function_exists( 'evolution_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function evolution_post_nav() {
    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous ) {
        return;
    }

    ?>
    <nav class="navigation post-navigation" role="navigation">
        <div class="nav-links">
            <?php
            if ( is_attachment() ) :
                previous_post_link( '%link', '<span class="meta-nav">发布于</span>%title' );
            else :
                previous_post_link( '%link', '<span class="meta-nav">上一文章</span>%title' );
                next_post_link( '%link', '<span class="meta-nav">下一文章</span>%title' );
            endif;
            ?>
        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
}
endif;

/** Support non-latin usernames */
add_filter('sanitize_user', function ($username, $raw_username, $strict) {
	$username = wp_strip_all_tags( $raw_username );
	$username = preg_replace( '|%([a-fA-F0-9][a-fA-F0-9])|', '', $username );
	$username = preg_replace( '/&.+?;/', '', $username );
	$username = trim( $username );
	$username = preg_replace( '|\s+|', ' ', $username );
	return $username;
}, 10, 3);
