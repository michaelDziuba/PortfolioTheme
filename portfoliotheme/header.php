<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
    <?php
    if($wp_query->is_home){

    }else{
        echo "<style>
                .slider-posts .carousel {display: none;} 
                .blog-post-title, .blog-post-meta {text-align: center;}
            </style>";
    }
    ?>
    <link href="https://fonts.googleapis.com/css?family=Lora:700" rel="stylesheet">
</head>
<body <?php body_class(); ?>>
<div id="container">
<div class="blog-masthead">
    <div id="header-image">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
            <img src="<?php echo get_template_directory_uri(); ?>/images/header.png" alt="header" width="100%" height="100%" />
        </a>
    </div>
    <div id="main-menu" class="nav-menu-container">

        <nav id="site-navigation" class="main-navigation" role="navigation">
            <button class="menu-toggle"><span class='dashicons dashicons-menu'></span></button>
            <?php      wp_nav_menu( array(
                'theme_location' => 'header-menu',
                'menu_class' => 'blog-nav list-inline'
            ) ); ?>
        </nav>
    </div>
</div>
<div class="blog-header">
   <h1 class="blog-title" id="header"><?php bloginfo( 'name' ); ?></h1>
</div>


