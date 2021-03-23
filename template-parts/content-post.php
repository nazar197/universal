<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="<?php echo get_post_type(); ?>-header" style="background: linear-gradient(0deg, rgba(38, 45, 51, 0.75), rgba(38, 45, 51, 0.75)), url(
    <?php
    if( has_post_thumbnail() ) {
      echo esc_url(get_the_post_thumbnail_url());
    }
    else {
      echo esc_url( get_template_directory_uri()) . '/assets/images/img-not-found.jpg"';
    }
    ?>
  );">
    <div class="container">
    <?php
      foreach (get_the_category() as $category) {
        printf(
          '<a href="%s" class="category-link %s">%s</a>',
          esc_url( get_category_link( $category )),
          esc_html( $category -> slug ),
          esc_html( $category -> name ),
        );
      }
    ?>
      <div class="post-header-wrapper">
        <div class="post-header-nav">
          <a class="home-link" href="<?php echo get_home_url(); ?>">
            <svg width="18" height="17" class="icon home-icon">
                <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#home"></use>
              </svg>
            На главную
          </a>
          <?php  
          the_post_navigation(
            array(
              'prev_text' => '<span class="post-nav-prev">
                <svg width="15" height="7" class="icon prev-icon">
                  <use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#arrow"></use>
                </svg>
              ' . esc_html__( 'Назад', 'universal-theme' ) . '</span>',
              'next_text' => '<span class="post-nav-next">' . esc_html__( 'Вперед', 'universal-theme' ) . '
                <svg width="15" height="7" class="icon next-icon">
                  <use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#arrow"></use>
                </svg>
              </span>',
            )
          );
        ?>
        </div>
        <!-- /.post-header-nav -->
        <div class="post-header-title-wrapper">
          <?php 
            if ( is_singular() ) :
              the_title( '<h1 class="' . get_post_type() . '-title">', '</h1>' );
            else :
              the_title( '<h2 class="' . get_post_type() . 'title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            endif; 
          ?>
          <button class="bookmark">
            <svg width="14" height="18" class="icon bookmark-icon">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#bookmark"></use>
            </svg>
          </button>
        </div>
        <?php the_excerpt(); ?>
        <div class="post-header-info">
          <span class="post-header-date">
            <svg width="14" height="14" class="icon clock-icon">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#clock"></use>
            </svg>
            <?php the_time('j F'); ?>
          </span>
          <!-- /.post-header-date -->
          <div class="likes post-header-likes">
            <svg width="14" height="14" class="icon likes-icon">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#like"></use>
            </svg>
            <span class="likes-counter">
              <?php comments_number( '0', '1', '%' ) ?>
            </span>
          </div>
          <!-- /.likes post-header-likes -->
          <div class="comments post-header-comments">
            <svg width="15" height="14" class="icon comments-icon">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#сomment"></use>
            </svg>
            <span class="comments-counter">
              <?php comments_number( '0', '1', '%' ) ?>
            </span>
          </div>
          <!-- /.comments post-header-comments -->
        </div>
        <!-- /.post-header-info -->
        <?php $author_id = get_the_author_meta('ID'); ?>
        <div class="post-author">
            <div class="post-author-info">
              <img src="<?php echo get_avatar_url($author_id); ?>" alt="avatar" class="post-author-avatar">
              <span class="post-author-name"><?php the_author() ?></span>
              <span class="post-author-rank">Должность</span>
              <span class="post-author-posts">
                <?php plural_form( count_user_posts( $author_id ),
                  /* варианты написания для количества 1, 2 и 5 */
                  array('статья','статьи','статей')); ?>
              </span>
            </div>
            <!-- /.post-author-info -->
            <a href="<?php echo get_author_posts_url($author_id); ?>" class="post-author-link">
              Страница автора
            </a>
          </div>
          <!-- /.post-author -->
      </div>
      <!-- /.post-header-wrapper -->
    </div>
    <!-- /.container -->
	</header><!-- .post-header -->

  <!-- Содержимое поста -->
	<div class="<?php echo get_post_type(); ?>-content">
    <div class="container">
      <?php
      the_content(
        sprintf(
          wp_kses(
            /* translators: %s: Name of current post. Only visible to screen readers */
            __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'universal-theme' ),
            array(
              'span' => array(
                'class' => array(),
              ),
            )
          ),
          wp_kses_post( get_the_title() )
        )
      );

      wp_link_pages(
        array(
          'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'universal-theme' ),
          'after'  => '</div>',
        )
      );
      ?>
    </div><!-- /.container -->
	</div><!-- /.post-content -->

  <footer class="<?php echo get_post_type(); ?>-footer">
    <div class="container">
      <?php 
        $tags_list = get_the_tag_list( '', esc_html_x( '', 'list item separator', 'universal-theme' ) );
        if ( $tags_list ) {
          /* translators: 1: list of tags. */
          printf( '<span class="tags-links">' . esc_html__( '%1$s', 'universal-theme' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
        // Share via social networks 
        meks_ess_share();
      ?>
    </div>
  </footer><!-- .post-footer -->
</article><!-- #post-<?php the_ID(); ?> -->