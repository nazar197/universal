<?php get_header(); ?>
<main class="front-page-header"> 
  <div class="container">
    <div class="hero">
      <div class="left">
      <?php
      global $post;

      $myposts = get_posts([ 
        'numberposts' => 1,
        'category_name' => 'javascript, css, html, web-design',
      ]);
        
      if( $myposts ){
        foreach( $myposts as $post ){
          setup_postdata( $post );
      ?>
        <?php 
          if( has_post_thumbnail() ) {
            echo '<img src="' . esc_url(get_the_post_thumbnail_url()) . '" alt="' . get_the_title() . '" class="post-thumb">';
          }
          else {
            echo '<img src="'. esc_url( get_template_directory_uri()) . '/assets/images/img-not-found.jpg" alt="image not found" class="post-thumb"/>';
          }
        ?>
        <?php $author_id = get_the_author_meta('ID'); ?>
        <a href="<?php echo get_author_posts_url($author_id); ?>" class="author">
          <img src="<?php echo get_avatar_url($author_id); ?>" alt="avatar" class="avatar">
          <div class="author-bio">
            <span class="author-name"><?php the_author() ?></span>
            <span class="author-rank"><?php _e('User rank', 'universal-theme') ?></span>
          </div>
        </a>
        <div class="post-text">
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
          <h2 class="post-title"><?php echo mb_strimwidth(get_the_title(), 0, 60, '...'); ?></h2>
          <a href="<?php echo get_the_permalink(); ?>" class="more"><?php _e('Read more', 'universal-theme') ?></a>
        </div>
      <?php 
        }
      } else {
        ?><p><?php _e('No posts', 'universal-theme') ?></p><?php 
      }

      wp_reset_postdata(); // Сбрасываем $post
      ?>
      </div>
      <!-- /.left -->
      <div class="right">
          <h3 class="recommend"><?php _e('Our recommendations', 'universal-theme') ?></h3>
          <ul class="posts-list">
          <?php
          global $post;

          $myposts = get_posts([ 
            'numberposts' => 5,
            'offset' => 1,
            'category_name' => 'javascript, css, html, web-design',
            ]);

          if( $myposts ){
            foreach( $myposts as $post ){
              setup_postdata( $post );
          ?>
            <!-- Выводим записи -->
            <li class="post">
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
              <a href="<?php echo get_the_permalink(); ?>" class="post-permalink">
                <h4 class="post-title"><?php the_title(); ?></h4>
              </a>
            </li>
            <?php 
              }
            } else {
              ?><p><?php _e('No posts', 'universal-theme') ?></p><?php 
            }

            wp_reset_postdata(); // Сбрасываем $post
            ?>
          </ul>
        </div>
        <!-- /.right -->
    </div>
    <!-- /.hero -->
  </div>
  <!-- /.container -->
</main>
<div class="container">
  <ul class="article-list">
  <?php
  global $post;

  $myposts = get_posts([ 
    'numberposts' => 4,
    'category_name' => 'articles',
    'category__not_in' => -41,
    ]);

  if( $myposts ){
    foreach( $myposts as $post ){
      setup_postdata( $post );
  ?>
    <!-- Выводим записи -->
    <li class="article-item">
      <a href="<?php echo get_the_permalink(); ?>" class="article-permalink">
        <h4 class="article-title"><?php echo mb_strimwidth(get_the_title(), 0, 50, '...'); ?></h4>
      </a>
      <img width="65" height="65" src="<?php if( has_post_thumbnail() ) {
          echo esc_url(get_the_post_thumbnail_url( null, 'homepage-thumb' ));
        } else {
          echo esc_url( get_template_directory_uri()) . '/assets/images/thumb-not-found.jpg';
        }?>" alt="<?php the_title(); ?>">
    </li>
    <?php 
      }
    } else {
      ?><p><?php _e('No posts', 'universal-theme') ?></p><?php 
    }

    wp_reset_postdata(); // Сбрасываем $post
    ?>
  </ul>
  <!-- /.article-list -->
  <div class="main-grid">
    <ul class="article-grid">
      <?php		
      global $post;

      $query = new WP_Query( [
        'posts_per_page' => 7,
        'orderby' => 'comment_count',
        'tag' => 'popular',
      ] );

      if ( $query->have_posts() ) {
        // Счетчик постов
        $cnt = 0;

        while ( $query->have_posts() ) {
          $query->the_post();
          $cnt++;
          switch ($cnt) {
            case '1':
              ?>
                <li class="article-grid-item article-grid-item-1">
                  <a href="<?php the_permalink(); ?>" class="article-grid-permalink">
                    <span class="category-name">
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
                    </span>
                    <!-- /.category-name -->
                    <h4 class="article-grid-title">
                      <?php echo mb_strimwidth(get_the_title(), 0, 50, '...'); ?>
                    </h4>
                    <!-- /.article-grid-title -->
                    <p class="article-grid-excerpt">
                      <?php echo mb_strimwidth(get_the_excerpt(), 0, 90, '...'); ?>
                    </p>
                    <!-- /.article-grid-excerpt -->
                    <div class="article-grid-info">
                      <div class="author">
                        <?php $author_id = get_the_author_meta('ID'); ?>
                        <img src="<?php echo get_avatar_url($author_id); ?>" alt="author avatar" class="author-avatar">
                        <span class="author-name">
                          <strong><?php the_author(); ?></strong>: 
                          <?php the_author_meta('description'); ?>
                        </span>
                        <!-- /.author-name -->
                      </div>
                      <!-- /.author -->
                      <div class="comments">
                        <svg width="19" height="15" class="icon comments-icon">
                          <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#сomment"></use>
                        </svg>
                        <span class="comments-counter">
                          <?php comments_number( '0', '1', '%' ) ?>
                        </span>
                      </div>
                      <!-- /.comments -->
                    </div>
                    <!-- /.article-grid-info -->
                  </a>
                  <!-- /.article-grid-permalink -->
                </li>
                <!-- /.article-grid-item -->
              <?php 
              break;
            case '2':
              ?>
                <li class="article-grid-item article-grid-item-2">
                  <?php 
                    if( has_post_thumbnail() ) {
                      echo '<img src="' . esc_url(get_the_post_thumbnail_url()). '" alt="' . get_the_title() . '" class="article-grid-thumb">';
                    }
                    else {
                      echo '<img src="'. esc_url( get_template_directory_uri()) . '/assets/images/img-not-found.jpg" alt="image not found" class="article-grid-thumb"/>';
                    }
                  ?>
                  <a href="<?php the_permalink(); ?>" class="article-grid-permalink">
                    <span class="tag">
                      <?php 
                        $posttags = get_the_tags();
                        if ($posttags) {
                          echo $posttags[ has_tag( 'popular' ) ] -> name; 
                        }
                      ?>
                    </span>
                    <!-- /.tag -->
                    <span class="category-name">
                      <?php 
                        $category = get_the_category();
                        echo $category[0]->name; 
                      ?>
                    </span>
                    <!-- /.category-name -->
                    <h4 class="article-grid-title">
                      <?php echo mb_strimwidth(get_the_title(), 0, 50, '...'); ?>
                    </h4>
                    <!-- /.article-grid-title -->
                    <div class="article-grid-info">
                      <div class="author">
                        <?php $author_id = get_the_author_meta('ID'); ?>
                        <img src="<?php echo get_avatar_url($author_id); ?>" alt="author avatar" class="author-avatar">
                        <div class="author-info">
                          <span class="author-name">
                            <strong><?php the_author(); ?></strong>: 
                            <?php the_author_meta('description'); ?>
                          </span>
                          <!-- /.author-name -->
                          <span class="date">
                            <?php the_time('j F'); ?>
                          </span>
                          <!-- /.date -->
                          <div class="comments">
                            <svg width="19" height="15" class="icon comments-icon">
                              <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#сomment"></use>
                            </svg>
                            <span class="comments-counter">
                              <?php comments_number( '0', '1', '%' ) ?>
                            </span>
                          </div>
                          <!-- /.comments -->
                          <div class="likes">
                            <svg width="19" height="15" class="icon likes-icon">
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
                  </a>
                </li>
                <!-- /.article-grid-item -->
              <?php 
              break;
            case '3':
              ?>
                <li class="article-grid-item article-grid-item-3">
                  <a href="<?php the_permalink(); ?>" class="article-grid-permalink">
                    <?php 
                      if( has_post_thumbnail() ) {
                        echo '<img src="' . esc_url(get_the_post_thumbnail_url()) . '" alt="' . get_the_title() . '" class="article-thumb">';
                      }
                      else {
                        echo '<img src="'. esc_url( get_template_directory_uri()) . '/assets/images/img-not-found.jpg" alt="image not found" class="article-thumb"/>';
                      }
                    ?>
                    <h4 class="article-grid-title">
                      <?php echo mb_strimwidth(get_the_title(), 0, 50, '...'); ?>
                    </h4>
                    <!-- /.article-grid-title -->
                  </a>
                  <!-- /.article-grid-permalink -->
                </li>
                <!-- /.article-grid-item -->
              <?php 
              break;
            default:
            ?>
              <li class="article-grid-item article-grid-item-default">
                <a href="<?php the_permalink(); ?>" class="article-grid-permalink">
                  <h4 class="article-grid-title">
                    <?php echo mb_strimwidth(get_the_title(), 0, 40, '...'); ?>
                  </h4>
                  <!-- /.article-grid-title -->
                  <p class="article-grid-excerpt">
                    <?php echo mb_strimwidth(get_the_excerpt(), 0, 70, '...'); ?>
                  </p>
                  <!-- /.article-grid-excerpt -->
                  <span class="article-date">
                    <?php the_time('j F Y'); ?>
                  </span>
                  <!-- /.article-date -->
                </a>
                <!-- /.article-grid-permalink -->
              </li>
              <!-- /.article-grid-item -->
            <?php 
          }
        }
      } else {
        ?><p><?php _e('No posts', 'universal-theme') ?></p><?php 
      }

      wp_reset_postdata(); // Сбрасываем $post
      ?>
    </ul>
    <!-- /.article-grid -->
    <!-- Подключаем верхний сайдбар -->
    <?php get_sidebar('home-top'); ?>
  </div>
<!-- /.main-grid -->
</div>
<!-- /.container -->
<?php		
global $post;

$query = new WP_Query( [
	'posts_per_page' => 1,
	'category_name'  => 'investigation',
] );

if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		?>
		<section class="investigation" style="background: linear-gradient(0deg, rgba(64, 48, 61, 0.45), rgba(64, 48, 61, 0.45)), url(<?php echo esc_url(get_the_post_thumbnail_url()); ?>) no-repeat center center">
      <div class="container">
        <h2 class="investigation-title"><?php the_title(); ?></h2>
        <a href="<?php echo get_the_permalink(); ?>" class="more"><?php _e('Read more', 'universal-theme') ?></a>
      </div>
      <!-- /.container -->
    </section>
    <!-- /.investigation -->
<?php 
    }
  } else {
    ?><p><?php _e('No posts', 'universal-theme') ?></p><?php 
  }
  
  wp_reset_postdata(); // Сбрасываем $post
?>
<div class="container">
  <div class="main-grid">
    <div class="digest-wrapper">
      <ul class="digest">
        <?php		
        global $post;

        $query = new WP_Query( [
          'posts_per_page' => 6,
          'orderby' => 'title',
        ] );

        if ( $query->have_posts() ) {

          while ( $query->have_posts() ) {
            $query->the_post();
        ?>
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
        <?php 
            }
          } else {
            ?><p><?php _e('No posts', 'universal-theme') ?></p><?php 
          }
          
          wp_reset_postdata(); // Сбрасываем $post
        ?>
      </ul>
    </div>
    <!-- /.digest-wrapper -->
    <!-- Подключаем нижний сайдбар -->
    <?php get_sidebar('home-bottom'); ?>
  </div>
  <!-- /.main-grid -->
</div>
<!-- /.container -->
<div class="special">
  <div class="container">
    <div class="special-grid">
      <?php		
        global $post;

        $query = new WP_Query( [
          'posts_per_page' => 1,
          'category_name' => 'photoreport',
        ] );

        if ( $query->have_posts() ) {

          while ( $query->have_posts() ) {
            $query->the_post();
      ?>
      <div class="photo-report">
        <!-- Slider main container -->
        <div class="swiper-container photo-report-slider">
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper">
            <!-- Slides -->
            <?php 
              $images = get_attached_media( 'image' );
              foreach ($images as $image) {
                echo '<div class="swiper-slide"><img src="';
                print_r( $image -> guid ); 
                echo '"/></div>';
              }
            ?>
          </div>
          <div class="swiper-pagination"></div>
        </div>
        <div class="photo-report-content">
          <a href="#" class="category-link">
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
          </a>
          <?php $author_id = get_the_author_meta('ID'); ?>
          <a href="<?php echo get_author_posts_url($author_id); ?>" class="author">
            <img src="<?php echo get_avatar_url($author_id); ?>" alt="avatar" class="author-avatar">
            <div class="author-bio">
              <span class="author-name"><?php the_author() ?></span>
              <span class="author-rank">Разработчик</span>
            </div>
          </a>
          <!-- /.author -->
          <h3 class="photo-report-title"><?php the_title(); ?></h3>
          <a href="<?php echo get_the_permalink(); ?>" class="button photo-report-button">
            <svg width="19" height="15" class="icon photo-report-icon">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#images"></use>
            </svg>
            Смотреть фото
            <span class="photo-report-counter"><?php echo count($images); ?></span>
          </a>
        </div>
        <!-- /.photo-report-content -->
      </div>
      <!-- /.photo-report -->
      <?php 
          }
        } else {
          ?><p><?php _e('No posts', 'universal-theme') ?></p><?php 
        }

        wp_reset_postdata(); // Сбрасываем $post
      ?>
      <div class="other">
        <div class="career-post">
        <?php		
          global $post;

          $query = new WP_Query( [
            'posts_per_page' => 1,
            'category_name' => 'career',
          ] );

          if ( $query->have_posts() ) {

            while ( $query->have_posts() ) {
              $query->the_post();

              foreach (get_the_category() as $category) {
                printf(
                  '<a href="%s" class="category-link %s">%s</a>',
                  esc_url( get_category_link( $category )),
                  esc_html( $category -> slug ),
                  esc_html( $category -> name ),
                );
              }
          ?>
          <h3 class="career-post-title"><?php the_title(); ?></h3>
          <p class="career-post-excerpt"><?php echo get_the_excerpt(); ?></p>
          <a href="<?php the_permalink(); ?>" class="more"><?php _e('Read more', 'universal-theme') ?></a>
        <?php 
            }
          } else {
            ?><p><?php _e('No posts', 'universal-theme') ?></p><?php
          }

          wp_reset_postdata(); // Сбрасываем $post
        ?>
        </div>
        <!-- /.career-post -->
        <div class="other-posts">
        <?php		
        global $post;

        $query = new WP_Query( [
          'posts_per_page' => 2,
          'category__not_in' => [-37, -39],
        ] );

        if ( $query->have_posts() ) {

          while ( $query->have_posts() ) {
            $query->the_post();
        ?>
          <a href="<?php the_permalink(); ?>" class="other-post other-post-default">
            <h4 class="other-post-title">
              <?php echo mb_strimwidth(get_the_title(), 0, 22, '...'); ?>
            </h4>
            <!-- /.other-post-title -->
            <p class="other-post-excerpt">
              <?php echo mb_strimwidth(get_the_excerpt(), 0, 90, '...'); ?>
            </p>
            <!-- /.other-post-excerpt -->
            <span class="other-post-date">
              <?php the_time('j F Y'); ?>
            </span>
            <!-- /.other-post-date -->
          </a>
          <!-- /.other-post-permalink -->
        <?php 
            }
          } else {
            ?><p><?php _e('No posts', 'universal-theme') ?></p><?php 
          }
          
          wp_reset_postdata(); // Сбрасываем $post
        ?>
        </div>
        <!-- /.other-posts -->
      </div>
      <!-- /.other -->
    </div>
    <!-- /.special-grid -->
  </div>
  <!-- /.container -->
</div>
<!-- /.special -->
<?php get_footer(); ?>