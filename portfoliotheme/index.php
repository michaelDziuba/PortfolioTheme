<?php get_header(); ?>



<hr style="width: 100%; border: solid transparent 1px; "/>

<div class="col-sm-12">

<div class="blog-main">
    <div class=" slider-top-1 ">
        <?php get_template_part('parts/slider-posts_original'); ?>
    </div><!--  End of slider-top-1 -->
    <div class="listview-posts ">
        <?php get_template_part('parts/listview-posts'); ?>
    </div><!--  End of listview-posts -->
    <?php
    if ( have_posts() ) {
        while ( have_posts() ) : the_post();
            ?>
            <div class="blog-post<?php the_category_unlinked(' '); ?> ">
                <h2 class="blog-post-title"><?php the_title(); ?></h2>
                <p class="blog-post-meta"><?php echo the_time('j M. Y'); ?>&nbsp;by
                    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a>
					<?php
                    if(get_the_time() != get_the_modified_time()){
                        echo "<span class='last-updated'><br /><span class='date-updated'><span class='dashicons dashicons-update'></span> Last updated&nbsp;&nbsp;" . get_the_modified_date();
                    }
                    the_content(); 
                    ?>
                </p>
            </div><!-- /.blog-post -->
            <?php
        endwhile;
    }
    if($wp_query->is_page('Article Index') || $wp_query->is_page('فهرس المقالات') || $wp_query->is_page(7785)){
        get_template_part('parts/archive');
    }
    ?>
    <nav>
        <ul class="pager">
            <li><?php next_posts_link('Previous'); ?></li>
            <li><?php previous_posts_link('Next'); ?></li>
        </ul>
    </nav>
</div><!-- /.blog-main -->
</div>
<hr style="width: 100%; border: solid transparent 1px; "/>

<?php get_footer(); ?>