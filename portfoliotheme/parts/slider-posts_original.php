<?php
$slides = array(); 
$slider_query = new WP_Query( array( 'category_name' => 'slider-posts') );

if ( $slider_query->have_posts() ) {
    while ( $slider_query->have_posts() ) {
        $slider_query->the_post();
        if(has_post_thumbnail()){
            $temp = array();
            $thumb_id = get_post_thumbnail_id();
            $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
            $thumb_url = $thumb_url_array[0];
            $temp['title'] = get_the_title();
            $temp['excerpt'] = get_the_excerpt();
            $temp['image'] = $thumb_url;
            $temp['post_url'] = get_post_permalink(get_the_ID());
            $slides[] = $temp;
        }
    }
} 
wp_reset_postdata();
?>
<?php if(count($slides) > 0) { ?>
    <div class="slider-posts">
<div id="slider-top-1" class="carousel slide slide-top" data-ride="carousel">  
    <ol class="carousel-indicators">
        <?php for($i=0;$i<count($slides);$i++) { ?>
        <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i ?>" <?php if($i==0) { ?>class="active"<?php } ?>></li>
        <?php } ?>
    </ol>
    <div class="carousel-inner" role="listbox">
        <?php $i=0; foreach($slides as $slide) { extract($slide); ?>
        <div class="item <?php if($i == 0) { ?>active<?php } ?>">
            <a href="<?php  echo $slide['post_url'];?>" class="slider-image-url">
                <div class="slider-content">
                    <img src="<?php echo $image ?>" alt="<?php echo esc_attr($title); ?>" >
                    <div class="text-content">
                        <h3><?php echo $title; ?></h3><p><?php echo wp_trim_words( $excerpt, 8, "..." ); ?></p>
                    </div>
                </div>
            </a>
        </div>
        <?php $i++; } ?>
    </div>
    <a class="left carousel-control" href="#slider-top-1" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a>
    <a class="right carousel-control" href="#slider-top-1" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span class="sr-only">Next</span></a>
</div>
    </div>
<?php } ?>