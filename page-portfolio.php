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

    <!-- the loop -->
    <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
    <div class="media-container">
        
        <div class="media-thumbnail">
            <?php 
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail('medium');
                  } 
            ?>
        </div>
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
                <h3>
                <?php $link = get_post_meta( get_the_ID(), '_la_portfolio_link', TRUE );?>
                    <a href="<?php echo $link;?>">Read More</a>
                </h3>
        </div>
    </div>

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