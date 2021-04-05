<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="<?php echo get_post_type(); ?>-header" style="background: linear-gradient(0deg, rgba(38, 45, 51, 0.75), rgba(38, 45, 51, 0.75));">
    <div class="container">
      <div class="lesson-header-wrapper">
        <div class="lesson-header-nav">
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
          <div class="video">
          <?php
            $video_link = get_field('video_link');
            if ( strpos($video_link, 'youtube') ) {
              $tmp = explode('?v=', get_field('video_link'));
              ?>
              <iframe width="100%" height="450" src="https://www.youtube.com/embed/<?php echo end ($tmp); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <?php
            }
            if ( strpos($video_link, 'vimeo') ) {
              $tmp = explode('vimeo.com/', get_field('video_link'));
              ?>
              <iframe src="https://player.vimeo.com/video/<?php echo end ($tmp); ?>" width="100%" height="450" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
            <?php
            }
          ?>
          </div>
        </div>
        <!-- /.post-header-nav -->
        <div class="lesson-header-title-wrapper">
          <?php 
            if ( is_singular() ) :
              the_title( '<h1 class="' . get_post_type() . '-title">', '</h1>' );
            else :
              the_title( '<h2 class="' . get_post_type() . 'title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            endif; 
          ?>
        </div>
        <div class="post-header-info">
          <span class="post-header-date">
            <svg width="14" height="14" class="icon clock-icon">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#clock"></use>
            </svg>
            <?php the_time('j F'); ?>
          </span>
          <!-- /.post-header-date -->
        </div>
        <!-- /.post-header-info -->
      </div>
      <!-- /.lesson-header-wrapper -->
    </div>
    <!-- /.container -->
	</header><!-- .post-header -->

  <!-- Содержимое поста -->
	<div class="lesson-content">
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

  <footer class="post-footer">
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