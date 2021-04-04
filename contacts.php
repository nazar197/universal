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
        <h2 class="contacts-title">Через форму обратной связи</h2>
        <p>Заполните форму обратной связи</p>
        <form action="#" class="contacts-form" method="POST">
          <input name="contact_name" type="text" class="input contacts-input" placeholder="Ваше имя">
          <input name="contact_email" type="email" class="input contacts-input" placeholder="Ваш Email">
          <textarea name="contact_comment" id="" class="textarea contacts-textarea" placeholder="Ваш вопрос"></textarea>
          <button type="submit" class="button more">Отправить</button>
        </form>
        <?php echo do_shortcode('[contact-form-7 id="270" title="Контактная форма"]'); ?>
      </div>
      <!-- /.left -->
      <div class="right">
        <h2 class="contacts-title">Или по этим контактам</h2>
        <a href="mailto:world@forpeople.studio">world@forpeople.studio </a>
        <address>3522 I-75, Business Spur Sault Sainte Marie, MI, 49783</address>
        <a href="tel:+2 800 089 45-34">+2 800 089 45-34</a>
      </div>
      <!-- /.right -->
    </div>
    <!-- /.contacts-wrapper -->
  </div>
  <!-- /.container -->
</section>
<!-- /.section-dark -->

<?php get_footer();