<?php
/**
 * The Header template
 *
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, viewport-fit=cover">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
    <link rel="shortcut icon" sizes="196x196" href="<?php echo get_template_directory_uri(); ?>/images/icon-196.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/icon-114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/images/icon-120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/images/icon-144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/images/icon-152.png" />
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page">
        <header class="site-header pure-g-r" style="padding-left: calc(env(safe-area-inset-left) - 22px); padding-right: calc(env(safe-area-inset-right) - 17px);">
            <h1 class="site-title pure-u-1-4">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<span class="blogname-top">52Poké</span>
                    <span class="blogname-bottom"><?php bloginfo( 'name' ); ?></span>
                </a>
                <span class="header-poke-ball menu-toggle"></span>
            </h1>

            <div class="header-right pure-u-3-4">
                <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>

                <nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
                    <?php get_search_form(); ?>
                    <?php wp_nav_menu( array( 'menu_class' => 'nav-menu' ) ); ?>
                    <?php if (function_exists('wpcc_output_navi')) : wpcc_output_navi(); endif; ?>
                </nav>
            </div>

            <div class="header-line-shape"></div>
        </header>
        <main id="main" class="site-main pure-g-r" style="padding-left: calc(env(safe-area-inset-left) - 20px); padding-right: calc(env(safe-area-inset-right) - 15px);">
