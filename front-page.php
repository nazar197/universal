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
        <!-- Выводим записи -->
        <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="post-thumb">
        <?php $author_id = get_the_author_meta('ID'); ?>
        <a href="<?php echo get_author_posts_url($author_id); ?>" class="author">
          <img src="<?php echo get_avatar_url($author_id); ?>" alt="avatar" class="avatar">
          <div class="author-bio">
            <span class="author-name"><?php the_author() ?></span>
            <span class="author-rank">Разработчик</span>
          </div>
        </a>
        <div class="post-text">
          <?php the_category() ?>
          <h2 class="post-title"><?php echo mb_strimwidth(get_the_title(), 0, 60, '...'); ?></h2>
          <a href="<?php echo get_the_permalink(); ?>" class="more">Читать далее</a>
        </div>
      <?php 
        }
      } else {
        ?><p>Постов нет</p><?php 
      }

      wp_reset_postdata(); // Сбрасываем $post
      ?>
      </div>
      <!-- /.left -->
      <div class="right">
          <h3 class="recommend">Рекомендуем</h3>
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
              <?php the_category() ?>
              <a href="<?php echo get_the_permalink(); ?>" class="post-permalink">
                <h4 class="post-title"><?php the_title(); ?></h4>
              </a>
            </li>
            <?php 
              }
            } else {
              ?><p>Постов нет</p><?php 
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
          echo get_the_post_thumbnail_url( null, 'homepage-thumb' );
        } else {
          echo get_template_directory_uri() . '/assets/images/img-default.png';
        }?>" alt="<?php the_title(); ?>">
    </li>
    <?php 
      }
    } else {
      ?><p>Постов нет</p><?php 
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
                        $category = get_the_category();
                        echo $category[0]->name; 
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
                        <img src="<?php echo get_template_directory_uri() . '/assets/images/сomment.svg'; ?>" alt="comment icon" class="comments-icon">
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
                  <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="<?php the_title(); ?>" class="article-grid-thumb">
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
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/comment-white.svg'; ?>" alt="comment icon" class="comments-icon">
                            <span class="comments-counter">
                              <?php comments_number( '0', '1', '%' ) ?>
                            </span>
                          </div>
                          <!-- /.comments -->
                          <div class="likes">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/like.svg'; ?>" alt="like icon" class="likes-icon">
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
                    <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="<?php the_title(); ?>" class="article-thumb">
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
        // Постов не найдено
      }

      wp_reset_postdata(); // Сбрасываем $post
      ?>
    </ul>
    <!-- /.article-grid -->
    <!-- Подключаем сайдбар -->
    <?php get_sidebar( ); ?>
  </div>
<!-- /.main-grid -->
</div>
<!-- /.container -->