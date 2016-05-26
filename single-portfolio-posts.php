<?php
/**

 */

get_header(); ?>
<div class="portfolio-container">
  <header class="page-header">
      <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <h1 class="page-title"><?php the_title(); ?></h1>
  </header><!-- .page-header -->

  <div id="posts">
      <div class="media-container">
        <div class="media-thumbnail">
          <?php the_post_thumbnail('medium'); ?>
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
              <a class="media-article-link" href="<?php echo $link;?>" target="_blank">Read More.</a>
          </h3>
        <h3 class="back-to-media-link">
            <a class="media-article-link" href="<?php echo site_url();?>">&laquo Back to Portfolio Page.</a>
          </h3>
        </div>
<?php endwhile; // end of the loop. ?>
    </div>
  </div>


<small class="small-label">single-portfolio-posts.php</small>

<?php get_footer(); ?>
