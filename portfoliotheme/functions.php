<?php


function bootstrapstarter_enqueue_styles() {
    wp_register_style('bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css' );
    $dependencies = array('bootstrap');
	wp_enqueue_style( 'bootstrapstarter-style', get_stylesheet_uri(), $dependencies ); 
}

function bootstrapstarter_enqueue_scripts() {
    $dependencies = array('jquery');
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/bootstrap/js/bootstrap.min.js', $dependencies, '', true );
    wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array ( 'jquery' ), '20160909', true);
    wp_enqueue_script( 'wpb_togglemenu', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20160909', true );
}

add_action( 'wp_enqueue_scripts', 'bootstrapstarter_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'bootstrapstarter_enqueue_scripts' );

function bootstrapstarter_wp_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
}

add_action( 'after_setup_theme', 'bootstrapstarter_wp_setup' );

function bootstrapstarter_register_menu() {
    register_nav_menu('header-menu', __( 'Header Menu' ));
}
add_action( 'init', 'bootstrapstarter_register_menu' );

function bootstrapstarter_widgets_init() {

    register_sidebar( array(
        'name'          => 'Footer - Copyright Text',
        'id'            => 'footer',
        'before_widget' => '<div class="footer-copyright-text">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>'
    ) );
}
add_action( 'widgets_init', 'bootstrapstarter_widgets_init' );


//Adds the post's category slug as a class name to the post's container 
// for css styling and for displaying its featured image inside a slider
function the_category_unlinked($separator = ' ') {
    $categories = (array) get_the_category();
    
    $thelist = '';
    foreach($categories as $category) {    // concate
        $thelist .= $separator . $category->category_nicename . $separator . explode("-", $category->category_nicename)[0];
    } 
    echo $thelist;
}

//Enqueue the Dashicons script
add_action( 'wp_enqueue_scripts', 'load_dashicons_front_end' );
function load_dashicons_front_end() {
    wp_enqueue_style( 'dashicons' );
}

function get_all_except_categories() {
    $exclude = array('category__not_in' =>  [45, 46, 47, 48, 49, 57, 58, 59, 60, 61, 62, 63, 64],
                        'posts_per_page' => 3,
                        'paged' => get_query_var( 'paged' ),
                        'orderby' => 'post_date',
                        'order' => 'DESC');
    return $exclude;
}


function getSlidesArray($slider_query){
     $slides = new SplFixedArray($slider_query->found_posts);
    $index = 0;
     while ( $slider_query->have_posts() ) {
        $slider_query->the_post();
        if(has_post_thumbnail()){
            $slide = new SplFixedArray(3);
            $thumb_id = get_post_thumbnail_id();
            $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
            $thumb_url = $thumb_url_array[0];
            $slide[0] = get_the_excerpt();
            $slide[1] = $thumb_url;
            $slide[2] = get_the_title();
            $slides[$index] = $slide;
        }
        $index++;
    }
    return $slides;
}



// Modify the main query object
function my_modify_main_query( $query ) {
    if ( $query->is_home() && $query->is_main_query() ) { // Run only on the homepage
        $query->query_vars['cat'] = [-45, -46, -47, -48, -49, -57, -58, -59, -60, -61, -62, -63, -64]; // Exclude ad slider categories
       $query->query_vars['posts_per_page'] = 10; // Show only 10 posts on the homepage only
        $query->query_vars['orderby'] = 'post_date';
        $query->query_vars['order'] = 'DESC';
    }
}
// Hook the above function to the pre_get_posts action
add_action( 'pre_get_posts', 'my_modify_main_query' );

function remove_oembed_provider() {
    //removes auto embedding of facebook links in posts (see all auto embeds in wp-includes/class-oembed.php)
    wp_oembed_remove_provider( '#https?://www\.facebook\.com/.*/posts/.*#i' );
}
add_action( 'init', 'remove_oembed_provider' );




























