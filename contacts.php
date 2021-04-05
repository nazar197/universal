<?php
/*
Template Name: Страница контакты
Template Post Type: page
*/
?>

<?php get_header(); ?>

<section class="section-dark">
  <div class="container">
    <h1 class="page-title"><?php the_title(); ?></h1>
    <div class="contacts-wrapper">
      <div class="left">
        <!-- Форма, созданная с помощью кода -->
        <h2 class="contacts-title">Заполните форму обратной связи</h2>
        <form action="#" class="contacts-form" method="POST">
          <input name="contact_name" type="text" class="input contacts-input" placeholder="Ваше имя">
          <input name="contact_email" type="email" class="input contacts-input" placeholder="Ваш Email">
          <textarea name="contact_comment" id="" class="textarea contacts-textarea" placeholder="Ваш вопрос"></textarea>
          <button type="submit" class="button more">Отправить</button>
        </form>

        <!-- Форма, созданная с помощью плагина CF7 -->
        <!-- <?php //the_content(); ?> -->
      </div>
      <!-- /.left -->
      <div class="right">
        <h2 class="contacts-title">Или по этим контактам</h2>
        <a href="mailto:world@forpeople.studio"><?php the_field('email'); ?></a>
        <address><?php the_field('address'); ?></address>
        <a href="tel:<?php the_field('phone'); ?>"><?php the_field('phone'); ?></a>
      </div>
      <!-- /.right -->
    </div>
    <!-- /.contacts-wrapper -->
  </div>
  <!-- /.container -->
</section>
<!-- /.section-dark -->

<?php get_footer();