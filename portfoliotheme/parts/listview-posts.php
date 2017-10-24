<div class="listview-posts">
            <div class="listview-inner">
                <ul>
                    <?php
                    if ( is_home() && is_main_query() && have_posts() ) { // Run only on the homepage
                        $switch = false;
                        while (have_posts()) : the_post();
                            $post_thumbnail = get_the_post_thumbnail(null, [50, 50], "");
                            $post_time = get_the_time('g:i a');
                            $post_date = get_the_date('d F Y');
                            $post_title = get_the_title();
                            if($switch) {
                                $post_link = "<a class='item-color-1' href='" . get_post_permalink(get_the_ID()) . "'><span class='thumb-date'>" . $post_thumbnail . "&nbsp;&nbsp;<span class='post-date'>" . $post_date . "</span></span>&nbsp;&nbsp;";
                            }else{
                                $post_link = "<a class='item-color-2' href='" . get_post_permalink(get_the_ID()) . "'><span class='thumb-date'>" . $post_thumbnail . "&nbsp;&nbsp;<span class='post-date'>" . $post_date . "</span></span>&nbsp;&nbsp;";
                            }
                            //$title = the_title($post_link, '</a>');
                            $title = $post_link . '<span class="post-title">' . $post_title . '</span></a>';
                            echo "<li>" . $title . "</li>";
                            $switch = $switch ? false : true;
                        endwhile;
                    } ?>
            </div>
</div>