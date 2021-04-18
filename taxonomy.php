<?php get_header(); ?>

<div class="container">
  <h1 class="category-title"><?php single_cat_title(); ?></h1>
  <div class="post-list">
  <?php while ( have_posts() ){ the_post(); ?>
    <div class="post-card">
      <a href="<?php the_permalink(); ?>" class="post-card-link">
        <img src="
        <?php if( has_post_thumbnail() ) {
          echo esc_url(get_the_post_thumbnail_url());
        }
        else {
          echo esc_url( get_template_directory_uri()) . '/assets/images/img-not-found.jpg"';
        } ?>" alt="" class="post-card-thumb">
      </a> 
      <div class="post-card-text">
        <a href="<?php the_permalink(); ?>" class="post-card-link">
          <h2 class="post-card-title">
            <?php echo mb_strimwidth(get_the_title(), 0, 20, '...') ?>
          </h2>
        </a> 
        <p class="post-card-excerpt">
          <?php echo mb_strimwidth(get_the_excerpt(), 0, 70, '...') ?>
        </p>
        <div class="author">
        <?php $author_id = get_the_author_meta( 'ID' );  ?>
          <img src="<?php echo get_avatar_url($author_id); ?>" alt="author avatar" class="author-avatar" />
          <div class="author-info">
            <span class="author-name"><strong><?php the_author(); ?></strong></span>
            <span class="date"><?php the_time('j M'); ?></span>
            <div class="comments">
              <svg width="15" height="14" class="icon comments-icon">
                <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#сomment"></use>
              </svg>
              <span class="comments-counter">
                <?php comments_number( '0', '1', '%' ) ?>
              </span>
            </div>
            <!-- /.comments -->
            <div class="likes">
              <svg width="14" height="14" class="icon likes-icon">
                <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#like"></use>
              </svg>
              <span class="likes-counter">
                <?php comments_number( '0', '1', '%' ) ?>
              </span>
            </div>
            <!-- /.likes -->
          </div>
          <!-- /.author-info -->
        </div>
        <!-- /.author -->
      </div>
      <!-- /.post-card-text -->
    </div>
    <!-- /.post-card -->
  <?php } 
  if ( ! have_posts() ){ ?>
    <?php _e('No posts', 'universal-theme') ?>
  <?php } ?>
  </div>
  <!-- /.posts-list -->
  <div class="pagination-category">
    <?php 
      $args = array(
        'prev_text'    => '<svg class="icon pagination-prev-icon">
          <use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#arrow"></use>
        </svg>'
        . __('Back', 'universal-theme'),
        'next_text'    => __('Next', 'universal-theme')
        . '
        <svg class="icon pagination-next-icon">
          <use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#arrow"></use>
        </svg>',
      );
      the_posts_pagination( $args );  
    ?>
  </div>
  <!-- /.pagination-category -->
</div>
<!-- /.container -->

<?php get_footer(); ?>