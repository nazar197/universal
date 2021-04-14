<?php 
// Добавление расширенных возможностей
if ( ! function_exists( 'universal_theme_setup' ) ) :
  function universal_theme_setup() {
    // Добавление тега title
    add_theme_support( 'title-tag' );
    
    // Добавление пользовательского логотипа
    add_theme_support( 'custom-logo', [
      'width'       => 163,
      'flex-height' => true,
      'header-text' => 'Universal',
      'unlink-homepage-logo' => false, // WP 5.5
    ] );

    // Добавление миниатюр
    add_theme_support( 'post-thumbnails', array( 'post' ) ); 

    // Регистрация меню
    register_nav_menus( [
      'header_menu' => 'Menu in header',
      'footer_menu' => 'Menu in footer'
    ] );

		// Регистрируем новый тип записей
    add_action( 'init', 'register_post_types' );
    function register_post_types(){
			register_post_type( 'lesson', [
				'label'  => null,
				'labels' => [
					'name'               => 'Уроки', // основное название для типа записи
					'singular_name'      => 'Урок', // название для одной записи этого типа
					'add_new'            => 'Добавить урок', // для добавления новой записи
					'add_new_item'       => 'Добавление урока', // заголовка у вновь создаваемой записи в админ-панели.
					'edit_item'          => 'Редактирование урока', // для редактирования типа записи
					'new_item'           => 'Новый урок', // текст новой записи
					'view_item'          => 'Смотреть уроки', // для просмотра записи этого типа.
					'search_items'       => 'Искать уроки', // для поиска по этим типам записи
					'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
					'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
					'parent_item_colon'  => '', // для родителей (у древовидных типов)
					'menu_name'          => 'Уроки', // название меню
				],
				'description'         => 'Раздел с видеоуроками',
				'public'              => true,
				'show_in_menu'        => true, // показывать ли в меню адмнки
				'show_in_rest'        => true, // добавить в REST API. C WP 4.7
				'rest_base'           => 'lesson', // $post_type. C WP 4.7
				'menu_position'       => 5,
				'menu_icon'           => 'dashicons-welcome-learn-more',
				'capability_type'   => 'post',
				'hierarchical'        => false,
				'supports'            => [ 'title', 'editor', 'thumbnail', 'custom-fields' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
				'taxonomies'          => ['genre', 'teacher'],
				'has_archive'         => true,
				'rewrite'             => true,
				'query_var'           => true,
			] );
		}

		// Хук, через который подключается функция
		// регистрирующая новые таксономии (create_lesson_taxonomies)
		add_action( 'init', 'create_lesson_taxonomies' );

    // функция, создающая 2 новые таксономии "genres" и "Teachers" для постов типа "lesson"
    function create_lesson_taxonomies(){

      // Добавляем древовидную таксономию 'genre' (как категории)
      register_taxonomy('genre', ['lesson'], [
        'hierarchical'  => true,
        'labels'        => [
					'name'              => _x( 'Жанры', 'taxonomy general name' ),
					'singular_name'     => _x( 'Жанр', 'taxonomy singular name' ),
					'search_items'      =>  __( 'Искать жанры' ),
					'all_items'         => __( 'Все жанры' ),
					'parent_item'       => __( 'Родительский жанр' ),
					'parent_item_colon' => __( 'Родительский жанр:' ),
					'edit_item'         => __( 'Редактировать жанр' ),
					'update_item'       => __( 'Обновить жанр' ),
					'add_new_item'      => __( 'Добавить новый жанр' ),
					'new_item_name'     => __( 'Имя нового жанра' ),
					'menu_name'         => __( 'Жанр' ),
				],
        'show_ui'       => true,
        'query_var'     => true,
        'rewrite'       => [ 'slug' => 'the_genre' ], // свой слаг в URL

				'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
				'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
				'show_in_rest'          => true, // добавить в REST API
				'rest_base'             => 'genre', // $taxonomy
			] );

      // Добавляем НЕ древовидную(плоскую) таксономию 'teacher' (как метки)
      register_taxonomy('teacher', 'lesson', [
        'hierarchical'  => false,
        'labels'        => [
          'name'                        => _x( 'Преподаватели', 'taxonomy general name' ),
					'singular_name'               => _x( 'Преподаватель', 'taxonomy singular name' ),
					'search_items'                => __( 'Поиск преподавателей' ),
					'popular_items'               => __( 'Популярные преподаватели' ),
					'all_items'                   => __( 'Все предподаватели' ),
					'parent_item'                 => null,
					'parent_item_colon'           => null,
					'edit_item'                   => __( 'Редактировать преподавателя' ),
					'update_item'                 => __( 'Обновить преподавателя' ),
					'add_new_item'                => __( 'Добавить нового преподавателя' ),
					'new_item_name'               => __( 'Имя нового преподавателя' ),
					'separate_items_with_commas'  => __( 'Разделите имена преподавателей запятыми' ),
					'add_or_remove_items'         => __( 'Добавить или убрать преподавателя' ),
					'choose_from_most_used'       => __( 'Выберите из наиболее популярных преподавателей' ),
					'menu_name'                   => __( 'Преподаватели' ),
				],
        'show_ui'       => true,
        'query_var'     => true,
        'rewrite'       => [ 'slug' => 'the_teacher' ], // свой слаг в URL

				'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
				'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
				'show_in_rest'          => true, // добавить в REST API
				'rest_base'             => 'teacher', // $taxonomy
			] );
		}
  }
endif;
add_action( 'after_setup_theme', 'universal_theme_setup' );

/**
 * Подключение сайдбара
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function universal_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Сайдбар c виджетами', 'universal-theme' ),
			'id'            => 'sidebar-home-widgets',
			'description'   => esc_html__( 'Добавьте виджеты сюда', 'universal-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
    )
	);
  register_sidebar(
		array(
			'name'          => esc_html__( 'Сайдбар с последними постами', 'universal-theme' ),
			'id'            => 'sidebar-home-last-posts',
			'description'   => esc_html__( 'Добавьте сюда последние посты', 'universal-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
    )
	);
  register_sidebar(
		array(
			'name'          => esc_html__( 'Меню в подвале', 'universal-theme' ),
			'id'            => 'sidebar-footer',
			'description'   => esc_html__( 'Добавьте меню сюда', 'universal-theme' ),
			'before_widget' => '<section id="%1$s" class="footer-menu %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="footer-menu-title">',
			'after_title'   => '</h2>',
    )
	);
  register_sidebar(
		array(
			'name'          => esc_html__( 'Текст в подвале', 'universal-theme' ),
			'id'            => 'sidebar-footer-text',
			'description'   => esc_html__( 'Добавьте текст сюда', 'universal-theme' ),
			'before_widget' => '<section id="%1$s" class="footer-text %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '',
			'after_title'   => '',
    )
	);
	register_sidebar(
    array(
      'name'          => esc_html__( 'Посты из той же категории на странице поста'),
      'id'            => 'sidebar-related-posts',
      'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="container">',
      'after_widget'  => '</div></section>',
    )
  );
	register_sidebar(
		array(
			'name'          => esc_html__( 'Виджеты на странице поиска', 'universal-theme' ),
			'id'            => 'sidebar-search',
			'description'   => esc_html__( 'Добавьте виджет сюда', 'universal-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '',
			'after_title'   => '',
    )
	);
}
add_action( 'widgets_init', 'universal_theme_widgets_init' );

/**
 * Добавление нового виджета Downloader_Widget.
 */
class Downloader_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'downloader_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: downloader_widget
			'Полезные файлы',
			array( 'description' => 'Файлы для скачивания', 'classname' => 'widget-downloader', )
		);

		// скрипты/стили виджета, только если он активен
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_downloader_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_downloader_widget_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		$title = $instance['title'];
		$description = $instance['description'];
		$link = $instance['link'];

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		if ( ! empty( $description ) ) {
			echo '<p>' . $description . '</p>';
		}
		if ( ! empty( $link ) ) {
			echo '<a target="_blank" class="widget-link" href="' . $link . '">
			<svg class="icon widget-link-icon">
				<use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#download"></use>
			</svg>
      Скачать</a>';
		}
		echo $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Полезные файлы';
		$description = @ $instance['description'] ?: 'Описание';
		$link = @ $instance['link'] ?: 'https://google.com';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Заголовок:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Описание:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" type="text" value="<?php echo esc_attr( $description ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Ссылка на файл:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>">
		</p>
		<?php 
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
		$instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';

		return $instance;
	}

	// скрипт виджета
	function add_downloader_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_downloader_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

		wp_enqueue_script('downloader_widget_script', $theme_url .'/downloader_widget_script.js' );
	}

	// стили виджета
	function add_downloader_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_downloader_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.downloader_widget a{ display:inline; }
		</style>
		<?php
	}
} 
// конец класса Downloader_Widget

// регистрация Downloader_Widget в WordPress
function register_downloader_widget() {
	register_widget( 'Downloader_Widget' );
}
add_action( 'widgets_init', 'register_downloader_widget' );

/**
 * Добавление нового виджета Social_Widget.
 */
class Social_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'social_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: social_widget
			'Социальные сети',
			array( 'description' => 'Facebook, Instagram, Youtube и Twitter', 'classname' => 'social_widget', )
		);

		// скрипты/стили виджета, только если он активен
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_social_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_social_widget_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		$title = $instance['title'];
		$facebook = $instance['facebook'];
		$instagram = $instance['instagram'];
		$youtube = $instance['youtube'];
		$twitter = $instance['twitter'];

		echo $args['before_widget'];
		
		echo '<div class="widget-social">';
		if ( ! empty( $title ) ) {
			echo '<h2 class="widget-title">' . $title . '</h2>';
		}

		echo '<div class="widget-social-wrapper">';
		if ( ! empty( $facebook ) ) {
			echo '
				<a target="_blank" class="widget-link" href="' . $facebook . '">
					<svg class="icon widget-social-icon">
						<use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#facebook"></use>
					</svg>
				</a>
			';
		}
		if ( ! empty( $instagram ) ) {
			echo '
				<a target="_blank" class="widget-link" href="' . $instagram . '">
					<svg class="icon widget-social-icon">
						<use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#instagram"></use>
					</svg>
				</a>
			';
		}
		if ( ! empty( $youtube ) ) {
			echo '
				<a target="_blank" class="widget-link" href="' . $youtube . '">
					<svg class="icon widget-social-icon">
						<use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#youtube"></use>
					</svg>
				</a>
			';
		}
		if ( ! empty( $twitter ) ) {
			echo '
				<a target="_blank" class="widget-link" href="' . $twitter . '">
					<svg class="icon widget-social-icon">
						<use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#twitter"></use>
					</svg>
				</a>
			';
		}
		echo '</div>';
		echo '</div>';
		echo $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Наши соцсети';
		$facebook = @ $instance['facebook'] ?: 'https://facebook.com/';
		$instagram = @ $instance['instagram'] ?: 'https://instagram.com/';
		$youtube = @ $instance['youtube'] ?: 'https://youtube.com/';
		$twitter = @ $instance['twitter'] ?: 'https://twitter.com/';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Заголовок:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e( 'Instagram:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" type="text" value="<?php echo esc_attr( $instagram ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e( 'Youtube:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" type="text" value="<?php echo esc_attr( $youtube ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>">
		</p>
		<?php 
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
		$instance['instagram'] = ( ! empty( $new_instance['instagram'] ) ) ? strip_tags( $new_instance['instagram'] ) : '';
		$instance['youtube'] = ( ! empty( $new_instance['youtube'] ) ) ? strip_tags( $new_instance['youtube'] ) : '';
		$instance['twitter'] = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';

		return $instance;
	}

	// скрипт виджета
	function add_social_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_social_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

		wp_enqueue_script('social_widget_script', $theme_url .'/social_widget_script.js' );
	}

	// стили виджета
	function add_social_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_social_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.social_widget a{ display:inline; }
		</style>
		<?php
	}
} 
// конец класса Social_Widget

// регистрация Social_Widget в WordPress
function register_social_widget() {
	register_widget( 'Social_Widget' );
}
add_action( 'widgets_init', 'register_social_widget' );

/**
 * Добавление нового виджета Recent_Posts_Widget.
 */
class Recent_Posts_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'recent_posts_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: recent_posts_widget
			'Недавно опубликовано',
			array( 'description' => 'Недавно опубликованные посты', 'classname' => 'widget-recent-posts', )
		);

		// скрипты/стили виджета, только если он активен
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_recent_posts_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_recent_posts_widget_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		$title = $instance['title'];
		$count = $instance['count'];

		echo $args['before_widget'];
		if ( ! empty( $count ) ) {
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			echo '<div class="widget-recent-posts-wrapper">';
			global $post;
			$postslist = get_posts( array( 'posts_per_page' => $count, 'order'=> 'DESC') );
			foreach ( $postslist as $post ){
				setup_postdata($post);
				?>
				<a href="<?php the_permalink(); ?>" class="recent-post-link">
					<?php 
            if( has_post_thumbnail() ) {
              echo '<img src="' . get_the_post_thumbnail_url( null, 'thumbnail' ) . '" alt="' . get_the_title() . '" class="recent-post-thumb">';
            }
            else {
              echo '<img src="'. esc_url( get_template_directory_uri()) . '/assets/images/thumb-not-found.jpg" alt="thumb not found" class="recent-post-thumb"/>';
            }
          ?>
					<div class="recent-post-info">
						<h4 class="recent-post-title"><?php echo mb_strimwidth(get_the_title(), 0, 35, '...'); ?></h4>
						<span class="recent-post-time">
							<?php 
								$time_diff = human_time_diff( get_post_time('U'), current_time('timestamp') );
								echo "$time_diff назад";
							?>
						</span>
					</div>
				</a>
				<?php
			}
			wp_reset_postdata();
			echo '</div>';
		}
		echo $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Недавно опубликовано';
		$count = @ $instance['count'] ?: '7';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Заголовок:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Количество постов:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>">
		</p>
		<?php 
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';

		return $instance;
	}

	// скрипт виджета
	function add_recent_posts_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_recent_posts_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

		wp_enqueue_script('recent_posts_widget_script', $theme_url .'/recent_posts_widget_script.js' );
	}

	// стили виджета
	function add_recent_posts_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_recent_posts_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.recent_posts_widget a{ display:inline; }
		</style>
		<?php
	}
} 
// конец класса Recent_Posts_Widget

// регистрация Recent_Posts_Widget в WordPress
function register_recent_posts_widget() {
	register_widget( 'Recent_Posts_Widget' );
}
add_action( 'widgets_init', 'register_recent_posts_widget' );


/**
 * Добавление нового виджета Related_Posts_Widget.
 */
class Related_Posts_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'related_posts_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: related_posts_widget
			'Посты на ту же тему',
			array( 'description' => 'Посты из той же категории', 'classname' => 'widget_related-post' )
		);

		// скрипты/стили виджета, только если он активен
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_related_posts_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_related_posts_widget_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		global $post;
		$title = $instance['title'];
		$count = $instance['count'];
    $categories = get_the_category($post -> ID);
    $category_name = $categories[0] -> slug;

		echo $args['before_widget'];

		echo '<ul class="related-post-list">';

		$query = new WP_Query( [
			'posts_per_page' => $count,
			'offset' => 1,
			'category_name' => $category_name 
		] );
			
		if ( $query->have_posts() ) {

			while ( $query->have_posts() ) {
				$query->the_post(); ?>
				<li class="related-post-item">
					<a href="<?php echo get_the_permalink()?>" class="related-post-link">
						<img src="<?php
							if( has_post_thumbnail() ) {
								echo esc_url(get_the_post_thumbnail_url());
							}
							else {
								echo esc_url( get_template_directory_uri()) . '/assets/images/img-not-found.jpg"';
							}
							?>"
							alt="<?php the_title() ?>">
					</a>
					<h5 class="related-post-title">
					<?php echo mb_strimwidth( get_the_title(), 0, 50, '...') ; ?>
					</h5>
					<div class="related-post-info">
						<span class="related-post-watched">
							<svg width="15" height="15" class="icon watched-icon">
								<use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#eye"></use>
							</svg>
							<?php comments_number('0', '1', '%'); ?>
						</span>
						<span class="related-post-comments">
							<svg width="15" height="15" class="icon comments-icon">
								<use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#сomment"></use>
							</svg>
							<?php comments_number('0', '1', '%'); ?>
						</span>
					</div>
				</li>
			<?php }
			echo '</ul>';
		} else {
			?><p class="no-related-posts">Постов из той же категории больше нет</p><?php 
		}

		wp_reset_postdata();
		echo $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Посты из той же категории';
    $count = @ $instance['count'] ?: '4';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Заголовок:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Количество постов:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>">
		</p>
		<?php 
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';

		return $instance;
	}

	// скрипт виджета
	function add_related_posts_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_related_posts_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

		wp_enqueue_script('related_posts_widget_script', $theme_url .'/related_posts_widget_script.js' );
	}

	// стили виджета
	function add_related_posts_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_related_posts_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.related_posts_widget a{ display:inline; }
		</style>
		<?php
	}
} 
// конец класса Related_Posts_Widget

// регистрация Related_Posts_Widget в WordPress
function register_related_posts_widget() {
	register_widget( 'Related_Posts_Widget' );
}
add_action( 'widgets_init', 'register_related_posts_widget' );

// Подключение стилей и скриптов
function enqueue_universal_style() {
  wp_enqueue_style( 'style', get_stylesheet_uri() );
  wp_enqueue_style( 'Roboto-Slab', '//fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&display=swap');
	wp_deregister_script( 'jquery-core' );
	wp_register_script( 'jquery-core', '//code.jquery.com/jquery-3.6.0.min.js');
	wp_enqueue_script( 'jquery' );
  wp_enqueue_style( 'swiper-slider', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', 'style');
  wp_enqueue_style( 'universal-theme', get_template_directory_uri() . '/assets/css/universal-theme.css', 'style');
  wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', 'swiper', null, true);
  wp_enqueue_script( 'scripts', get_template_directory_uri() . '/assets/js/scripts.js', null, null, true);
}
add_action( 'wp_enqueue_scripts', 'enqueue_universal_style' );

// Подключение ajax
function adminAjax_data(){
    wp_localize_script( 'jquery', 'adminAjax',
    array(
        'url' => admin_url('admin-ajax.php')
        )
    );
}
add_action( 'wp_enqueue_scripts', 'adminAjax_data', 99 );

function ajax_form() {
	$contact_name = $_POST['contact_name'];
	$contact_email = $_POST['contact_email'];
	$contact_comment = $_POST['contact_comment'];
	$message = 'Пользователь оставил заявку. Его имя: ' . $contact_name . '<br/> Его email: ' . $contact_email . '<br/> Текст заявки: ' . $contact_comment;
	$headers = ["From: Назар <nazar.webrazrabotchik@yandex.ua>\r\n", 'content-type: text/html'];
	$sent_message = wp_mail('nazar.webrazrabotchik@yandex.ru', 'Новая заявка с сайта', $message, $headers);
	echo $sent_message ? 'успех' : 'ошибка';

	wp_die();
}
add_action('wp_ajax_contacts_form', 'ajax_form');
add_action('wp_ajax_nopriv_contacts_form', 'ajax_form');


## изменяем настройки облака тегов
add_filter( 'widget_tag_cloud_args', 'edit_widget_tag_cloud_args');
function edit_widget_tag_cloud_args( $args ){
	$args['unit']     = 'px';
	$args['smallest'] = '14';
	$args['largest']  = '14';
	$args['number']   = '9';
	return $args;
}

## отключаем создание миниатюр файлов для указанных размеров
add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );
function delete_intermediate_image_sizes( $sizes ){
	// размеры которые нужно удалить
	return array_diff( $sizes, [
		'medium_large',
		'large',
		'1536x1536',
		'2048x2048',
	] );
}

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'homepage-thumb', 65, 65, true ); // Кадрирование изображения
	add_image_size( 'article-thumb', 336, 195, true ); // Кадрирование изображения
}

# меняем стиль многоточия в отрывках
add_filter('excerpt_more', function($more) {
	return '...';
});

// склоняем слова после числительных
function plural_form($number, $after) {
	$cases = array (2, 0, 1, 1, 1, 2);
	echo $number.' '.$after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
}