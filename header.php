<!DOCTYPE html>
<html <?php language_attributes();?>>
    <head>
        <!-- Remy Sharp Shim -->
        <!--[if lt IE 9]>
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?> | <?php bloginfo('description'); ?></title>

        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon.ico" />

        <?php wp_head(); ?>
    </head>
        
    <body <?php body_class();?>>

            <header>
                <div class="nav" role="navigation">
                    <div class="container">

                        <div class="main-menu" id="main-menu">
                            <div class="reveal-about-container"></div> 
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <div class="logo-desktop">                                
                                
                                </div><!-- /#logo -->
                            </a>
                            <ul class="nav">
                                
                                 <?php
                                    wp_nav_menu( array(
                                        'menu'              => 'Main Menu',                
                                        'depth'             => 2,
                                        'container'         => 'div',
                                        'container_class'   => 'main-menu-container',
                                        'menu_class'        => 'nav navbar-nav'
                                    ));
                                ?>
                            </ul>
                        </div>
                        
                        
                    </div>  <!--/.container --> 
                </div><!--/.navbar-default -->
                <!-- start login-enroll-mobile -->
                
            </header>
           

            <div class="main-container">
