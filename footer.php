  <footer class="footer">
    <div class="container">
      <div class="footer-menu-bar">
        <?php dynamic_sidebar( 'sidebar-footer' ); ?>
      </div>
      <!-- ./footer-menu-bar -->
      <div class="footer-info">
        <?php 
          $logo_img = '';
          if( $custom_logo_id = get_theme_mod('custom_logo') ){
              $logo_img = wp_get_attachment_image( $custom_logo_id, 'full', false, array('class' => 'custom-logo'));
          }

          if( has_custom_logo() ){
            echo is_front_page() 
              ? '<div class="logo">' . $logo_img . '</div>'
              : '<div class="logo">' . get_custom_logo() . '</div>';
          } else {
              echo '<span class="logo-name">' . get_bloginfo( 'name' ) . '</span>';
          }

          wp_nav_menu( [
            'theme_location'  => 'footer_menu',
            'container'       => 'nav', 
            'container_class' => 'footer-nav-wrapper',
            'menu_class' => 'footer-nav', 
            'echo'            => true,
          ] );
        $instance = array(
          'facebook' => 'https://fb.com/',
          'instagram' => 'https://instagram.com/',
          'twitter' => 'https://twitter.com/',
          'youtube' => 'https://youtube.com/',
          'title' => '',
        );
        $args = array(
          'before_widget' => '<div class="footer-social">',
          'after_widget' => '</div>'
        );
        the_widget( 'Social_Widget', $instance, $args );
        ?>
      </div>
      <!-- /.footer-info -->
      <?php
        if ( ! is_active_sidebar( 'sidebar-footer' ) ) {
          return;
        }
      ?>
      <div class="footer-text-wrapper">
        <?php dynamic_sidebar( 'sidebar-footer-text' ); ?>
        <span class="footer-copyright"><?php echo date('Y') . ' &copy; ' . get_bloginfo('name'); ?></span>
      </div>
      <!-- /.footer-text-wrapper -->
    </div>
    <!-- /.container -->
  </footer>
  <!-- /.footer -->
<?php wp_footer(); ?>
</body>
</html>