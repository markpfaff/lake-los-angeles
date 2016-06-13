<?php

/* 
 * Template Name: Portfolio Posts
 */

get_header();
 ?>

    <div class="portfolio-container">

      <div id="posts">
        <?php 
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

          $custom_args = array(
              'post_type' => 'portfolio-posts',
              'posts_per_page' => 3,
              'paged' => $paged
            );
            //var_dump($custom_args);
          $custom_query = new WP_Query( $custom_args ); ?>

          <?php if ( $custom_query->have_posts() ) : ?>
        <?php $count = 1;?>
        <!-- the loop -->
        <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
        
        <div class="media-container portfolio-post-<?php echo $count;?>"
             <?php if($count > 1){
                        echo 'style="left:'. (4000 * ($count-1)) .'px"';
             }?>
             
             >
          
            <div class="media-inner-container">
                <div class="media-description">
                    <h2><?php the_title(); ?></h2>
                    <!--Article Title-->
                        <h3>
                        <?php $article = get_post_meta( get_the_ID(), '_la_portfolio_title', TRUE );?>
                        <?php echo $article;?>
                        </h3>
                    <!--Publication Title-->
                        <h3>
                        <?php $publication = get_post_meta( get_the_ID(), '_la_publication_title', TRUE );?>
                        <?php echo $publication;?>
                        </h3>
                    <!--Article Description-->
                        <?php the_content(); ?>
                    <!--Article Link-->
<!--                        <h3>
                        <?php //$link = get_post_meta( get_the_ID(), '_la_portfolio_link', TRUE );?>
                            <a href="<?php //echo $link;?>">Read More</a>
                        </h3>-->
                </div>                  
                <div class="media-thumbnail">
                    <?php 
                        if ( has_post_thumbnail() ) {
                            the_post_thumbnail('large');
                            echo '<div class="caption-text">' . get_post(get_post_thumbnail_id())->post_excerpt . '</div>';
                          } 
                    ?>
                </div>
                    <?php 
                       if( class_exists('Dynamic_Featured_Image') ) {
                            global $dynamic_featured_image;
                            $featured_images = $dynamic_featured_image->get_featured_images( );
                            
                            $i = 0;
                            foreach ($featured_images as $row=>$innerArray)
                            {
                                echo '<div class="media-thumbnail">';
                                $id = $featured_images[$i]['attachment_id'];

                                $fullImage = $dynamic_featured_image->get_image_url($id,'full'); 
                                $caption = $dynamic_featured_image->get_image_caption( $fullImage );

                                echo "      <div><img src=\"".$fullImage."\" alt=\"".$caption."\"><div class=\"caption-text\">".$caption."&nbsp;</div></div>";
                                echo '</div>';
                                $i++;
                            }
                        }
                    ?>
                

            </div>
        </div>
        <?php $count++;?>
        <?php endwhile; ?>
    <!-- pagination -->

    <?php             
        global $wp_query;

        $big = 999999999; // need an unlikely integer

        echo paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $custom_query->max_num_pages
        ) );
    ?>
            <?php wp_reset_postdata(); ?>

      </div><!-- #posts -->

    <?php endif; ?>
        <small class="small-label">page-portfolio.php</small>

    </div>

<?php get_footer();?>