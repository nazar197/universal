<?php get_header(); ?>
<div class="container">
  <h1 class="search-title">
    Результаты поиска по запросу: 
    <?php 
    if (isset($_GET['s'])) {
      echo esc_html($_GET['s']);
    }
    ?>
  </h1>
  <div class="main-grid">
    <div class="digest-wrapper">
      <ul class="digest">
        <?php while( have_posts() ) { the_post();  ?>
        <li class="digest-item">
          <a href="<?php the_permalink(); ?>" class="digest-item-permalink">
          <?php 
            if( has_post_thumbnail() ) {
              echo '<img src="' . esc_url(get_the_post_thumbnail_url()) . '" alt="' .get_the_title() . '" class="digest-thumb">';
            }
            else {
              echo '<img src="'. esc_url( get_template_directory_uri()) . '/assets/images/img-not-found.jpg" alt="image not found" class="digest-thumb"/>';
            }
          ?>
          </a>
          <div class="digest-info">
            <button class="bookmark">
              <svg width="14" height="18" class="icon bookmark-icon">
                <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#bookmark"></use>
              </svg>
            </button>
            <a href="<?php the_permalink(); ?>" class="category-link articles">
              <?php 
                foreach (get_the_category() as $category) {
                  printf(
                    '<a href="%s" class="category-link %s">%s</a>',
                    esc_url( get_category_link( $category )),
                    esc_html( $category -> slug ),
                    esc_html( $category->name ),
                  );
                }
              ?>
            </a>
            <a href="<?php the_permalink(); ?>" class="digest-item-permalink">
              <h3 class="digest-title">
                <?php echo mb_strimwidth(get_the_title(), 0, 50, '...'); ?>
              </h3>
            </a>
            <p class="digest-excerpt">
              <?php echo mb_strimwidth(get_the_excerpt(), 0, 150, '...'); ?>
            </p>
            <div class="digest-footer">
              <span class="digest-date">
                <?php the_time('j F'); ?>
              </span>
              <!-- /.digest-date -->
              <div class="comments digest-comments">
                <svg width="15" height="14" class="icon comments-icon">
                  <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#сomment"></use>
                </svg>
                <span class="comments-counter">
                  <?php comments_number( '0', '1', '%' ) ?>
                </span>
              </div>
              <!-- /.comments digest-comments -->
              <div class="likes digest-likes">
                <svg width="14" height="14" class="icon likes-icon">
                  <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#like"></use>
                </svg>
                <span class="likes-counter">
                  <?php comments_number( '0', '1', '%' ) ?>
                </span>
              </div>
              <!-- /.likes digest-likes -->
            </div>
            <!-- /.digest-footer -->
          </div>
          <!-- /.digest-info -->
        </li>
        <!-- /.digest-item -->
        <?php } if( ! have_posts() ) {?>
          Записей нет
        <?php }?>
      </ul>
      <div class="pagination-search">
      <?php 
        $args = array(
          'prev_text'    => '
          <svg class="icon pagination-prev-icon">
            <use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#arrow"></use>
          </svg>
          Назад',
          'next_text'    => '
          Вперед
          <svg class="icon pagination-next-icon">
            <use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#arrow"></use>
          </svg>',
        );
        the_posts_pagination( $args );  
      ?>
      </div>
    </div>
    <!-- /.digest-wrapper -->
    
    <!-- сюда вставить сайдбар -->
    <?php get_sidebar('search'); ?>
  </div>
  <!-- /.main-grid -->
</div>
<!-- /.container -->
<?php get_footer(); ?>