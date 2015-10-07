<?php
/**
 * _tk functions and definitions
 *
 * @package _tk
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 750; /* pixels */

if ( ! function_exists( '_tk_setup' ) ) :
/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function _tk_setup() {
	global $cap, $content_width;

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	/**
	 * Add default posts and comments RSS feed links to head
	*/
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	*/
	add_theme_support( 'post-thumbnails' );

	/**
	 * Enable support for Post Formats
	*/
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	*/
	add_theme_support( 'custom-background', apply_filters( '_tk_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on _tk, use a find and replace
	 * to change '_tk' to the name of your theme in all the template files
	*/
	load_theme_textdomain( '_tk', get_template_directory() . '/languages' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	*/
	register_nav_menus( array(
		'primary'  => __( 'Header bottom menu', '_tk' ),
	) );

}
endif; // _tk_setup
add_action( 'after_setup_theme', '_tk_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function _tk_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', '_tk' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', '_tk_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function _tk_scripts() {

	// Import the necessary TK Bootstrap WP CSS additions
	wp_enqueue_style( '_tk-bootstrap-wp', get_template_directory_uri() . '/includes/css/bootstrap-wp.css' );

	// load bootstrap css
	wp_enqueue_style( '_tk-bootstrap', get_template_directory_uri() . '/includes/resources/bootstrap/css/bootstrap.min.css' );

	// load Font Awesome css
	wp_enqueue_style( '_tk-font-awesome', get_template_directory_uri() . '/includes/css/font-awesome.min.css', false, '4.1.0' );

	// load _tk styles
	wp_enqueue_style( '_tk-style', get_stylesheet_uri() );

	// load bootstrap js
	wp_enqueue_script('_tk-bootstrapjs', get_template_directory_uri().'/includes/resources/bootstrap/js/bootstrap.min.js', array('jquery') );

	// load bootstrap wp js
	wp_enqueue_script( '_tk-bootstrapwp', get_template_directory_uri() . '/includes/js/bootstrap-wp.js', array('jquery') );

	wp_enqueue_script( '_tk-skip-link-focus-fix', get_template_directory_uri() . '/includes/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( '_tk-keyboard-image-navigation', get_template_directory_uri() . '/includes/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

}
add_action( 'wp_enqueue_scripts', '_tk_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/includes/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require get_template_directory() . '/includes/bootstrap-wp-navwalker.php';

function create_workers()
{
    register_post_type('workers',
        array(
            'labels' => array(
                'name' => 'Workers',
                'singular_name' => 'Worker',
                'add_new' => 'Add New',
                'add_new_item' => 'Add new worker',
                'edit' => 'Edit',
                'edit_item' => 'Edit worker',
                'new_item' => 'New worker',
                'view' => 'View',
                'view_item' => 'View worker',
                'search_items' => 'Search workers',
                'not_found' => 'No workers found',
                'not_found_in_trash' => 'No workers found in trash',
                'parent' => 'Parent workers'
            ),
            'description' => 'Our workers',
            'public' => true,
            'menu_position' => 5,
            'supports' => array('title', 'editor', 'comments', 'thumbnail', 'custom-fields'),
            'taxonomies' => array(''),
            'menu_icon' => 'dashicons-admin-users',
            'has_archive' => true
        )
    );
}

function create_challenges()
{
    register_post_type('challenges',
        array(
            'labels' => array(
                'name' => 'Challenges',
                'singular_name' => 'Challenge',
                'add_new' => 'Add New',
                'add_new_item' => 'Add new challenge',
                'edit' => 'Edit',
                'edit_item' => 'Edit challenge',
                'new_item' => 'New challenge',
                'view' => 'View',
                'view_item' => 'View challenge',
                'search_items' => 'Search challenges',
                'not_found' => 'No challenges found',
                'not_found_in_trash' => 'No challenges found in trash',
                'parent' => 'Parent challenges'
            ),
            'description' => 'Our challenges',
            'public' => true,
            'menu_position' => 4,
            'supports' => array('title', 'editor', 'comments', 'thumbnail', 'custom-fields'),
            'taxonomies' => array(''),
            'menu_icon' => 'dashicons-clipboard',
            'has_archive' => true
        )
    );
}


function register_wp_sidebar() {
    register_sidebar(
        array(
            'id' => 'my_sidebar', // уникальный id
            'name' => 'My sidebar', // название сайдбара
            'description' => 'Move widgets here to show them on sidebar', // описание
            'before_widget' => '<div id="%1$s" class="side widget %2$s">', // по умолчанию виджеты выводятся <li>-списком
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">', // по умолчанию заголовки виджетов в <h2>
            'after_title' => '</h3>'
        )
    );
}
add_action( 'widgets_init', 'register_wp_sidebar' );

function my_salary() {
    add_meta_box(
        'my_salary', // Идентификатор(id)
        'Salary', // Заголовок области с мета-полями(title)
        'show_my_salary', // Вызов(callback)
        'workers', // Где будет отображаться наше поле
        'normal',
        'high');
}
add_action('add_meta_boxes', 'my_salary'); // Запускаем функцию

$salary = array(
    array(
        'label' => 'Salary',
        'desc'  => 'Description',
        'id'    => 'salary', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    )

);

// Вызов метаполей
function show_my_salary() {
    global $salary; // Обозначим наш массив с полями глобальным
    global $post;  // Глобальный $post для получения id создаваемого/редактируемого поста
// Выводим скрытый input, для верификации. Безопасность прежде всего!
    echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

    // Начинаем выводить таблицу с полями через цикл
    echo '<table class="form-table">';
    foreach ($salary as $field) {
        // Получаем значение если оно есть для этого поля
        $meta = get_post_meta($post->ID, $field['id'], true);
        // Начинаем выводить таблицу
        echo '<tr>
                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
                <td>';
        switch($field['type']) {
            case 'text':
                echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
        <br /><span class="description">'.$field['desc'].'</span>';
                break;
            case 'textarea':
                echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
        <br /><span class="description">'.$field['desc'].'</span>';
                break;
            case 'checkbox':
                echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
        <label for="'.$field['id'].'">'.$field['desc'].'</label>';
                break;
// Всплывающий список
            case 'select':
                echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
                foreach ($field['options'] as $option) {
                    echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
                }
                echo '</select><br /><span class="description">'.$field['desc'].'</span>';
                break;
        }
        echo '</td></tr>';
    }
    echo '</table>';
}

// Пишем функцию для сохранения
function save_my_salary($post_id) {
    global $salary;  // Массив с нашими полями

    // проверяем наш проверочный код
    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
        return $post_id;
    // Проверяем авто-сохранение
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
    // Проверяем права доступа
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    // Если все отлично, прогоняем массив через foreach
    foreach ($salary as $field) {
        $old = get_post_meta($post_id, $field['id'], true); // Получаем старые данные (если они есть), для сверки
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {  // Если данные новые
            update_post_meta($post_id, $field['id'], $new); // Обновляем данные
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old); // Если данных нету, удаляем мету.
        }
    } // end foreach
}
add_action('save_post', 'save_my_salary'); // Запускаем функцию сохранения

function my_employment() {
    add_meta_box(
        'my_employment', // Идентификатор(id)
        'Employment', // Заголовок области с мета-полями(title)
        'show_my_employment', // Вызов(callback)
        'workers', // Где будет отображаться наше поле
        'normal',
        'high');
}
add_action('add_meta_boxes', 'my_employment'); // Запускаем функцию

$employment = array(
    array(
        'label' => 'Employment',
        'desc'  => 'Description',
        'id'    => 'employment', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    )

);

// Вызов метаполей
function show_my_employment() {
    global $employment; // Обозначим наш массив с полями глобальным
    global $post;  // Глобальный $post для получения id создаваемого/редактируемого поста
// Выводим скрытый input, для верификации. Безопасность прежде всего!
    echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

    // Начинаем выводить таблицу с полями через цикл
    echo '<table class="form-table">';
    foreach ($employment as $field) {
        // Получаем значение если оно есть для этого поля
        $meta = get_post_meta($post->ID, $field['id'], true);
        // Начинаем выводить таблицу
        echo '<tr>
                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
                <td>';
        switch($field['type']) {
            case 'text':
                echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
        <br /><span class="description">'.$field['desc'].'</span>';
                break;
            case 'textarea':
                echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
        <br /><span class="description">'.$field['desc'].'</span>';
                break;
            case 'checkbox':
                echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
        <label for="'.$field['id'].'">'.$field['desc'].'</label>';
                break;
// Всплывающий список
            case 'select':
                echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
                foreach ($field['options'] as $option) {
                    echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
                }
                echo '</select><br /><span class="description">'.$field['desc'].'</span>';
                break;
        }
        echo '</td></tr>';
    }
    echo '</table>';
}

// Пишем функцию для сохранения
function save_my_employment($post_id) {
    global $employment;  // Массив с нашими полями

    // проверяем наш проверочный код
    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
        return $post_id;
    // Проверяем авто-сохранение
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
    // Проверяем права доступа
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    // Если все отлично, прогоняем массив через foreach
    foreach ($employment as $field) {
        $old = get_post_meta($post_id, $field['id'], true); // Получаем старые данные (если они есть), для сверки
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {  // Если данные новые
            update_post_meta($post_id, $field['id'], $new); // Обновляем данные
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old); // Если данных нету, удаляем мету.
        }
    } // end foreach
}
add_action('save_post', 'save_my_employment'); // Запускаем функцию сохранения

function add_new_taxonomies() {
    /* создаем функцию с произвольным именем и вставляем
    в неё register_taxonomy() */
    register_taxonomy('position',
        'workers',
        array(
            'hierarchical' => true,
            /* true - по типу рубрик, false - по типу меток,
            по умолчанию - false */
            'labels' => array(
                /* ярлыки, нужные при создании UI, можете
                не писать ничего, тогда будут использованы
                ярлыки по умолчанию */
                'name' => 'Position',
                'singular_name' => 'position',
                'search_items' =>  'Find positions',
                'popular_items' => 'Popular positions',
                'all_items' => 'All positions',
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => 'Edit position',
                'update_item' => 'Update position',
                'add_new_item' => 'Add new position',
                'new_item_name' => 'New position name',
                'separate_items_with_commas' => 'Seperate positions with commas',
                'add_or_remove_items' => 'Add or remove position',
                'choose_from_most_used' => 'Choose from most used positions',
                'menu_name' => 'Positions'
            ),
            'public' => true,
            /* каждый может использовать таксономию, либо
            только администраторы, по умолчанию - true */
            'show_in_nav_menus' => true,
            /* добавить на страницу создания меню */
            'show_ui' => true,
            /* добавить интерфейс создания и редактирования */
            'show_tagcloud' => true,
            /* нужно ли разрешить облако тегов для этой таксономии */
            'update_count_callback' => '_update_post_term_count',
            /* callback-функция для обновления счетчика $object_type */
            'query_var' => true,
            /* разрешено ли использование query_var, также можно
            указать строку, которая будет использоваться в качестве
            него, по умолчанию - имя таксономии */
            'rewrite' => array(
                /* настройки URL пермалинков */
                'slug' => 'platform', // ярлык
                'hierarchical' => false // разрешить вложенность

            ),
        )
    );
    register_taxonomy('project',
        'workers',
        array(
            'hierarchical' => true,
            /* true - по типу рубрик, false - по типу меток,
            по умолчанию - false */
            'labels' => array(
                /* ярлыки, нужные при создании UI, можете
                не писать ничего, тогда будут использованы
                ярлыки по умолчанию */
                'name' => 'Project',
                'singular_name' => 'Project',
                'search_items' =>  'Find projects',
                'popular_items' => 'Popular projects',
                'all_items' => 'All projects',
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => 'Edit project',
                'update_item' => 'Update project',
                'add_new_item' => 'Add new project',
                'new_item_name' => 'New project name',
                'separate_items_with_commas' => 'Seperate projects with commas',
                'add_or_remove_items' => 'Add or remove projects',
                'choose_from_most_used' => 'Choose from most used projects',
                'menu_name' => 'Projects'
            ),
            'public' => true,
            /* каждый может использовать таксономию, либо
            только администраторы, по умолчанию - true */
            'show_in_nav_menus' => true,
            /* добавить на страницу создания меню */
            'show_ui' => true,
            /* добавить интерфейс создания и редактирования */
            'show_tagcloud' => true,
            /* нужно ли разрешить облако тегов для этой таксономии */
            'update_count_callback' => '_update_post_term_count',
            /* callback-функция для обновления счетчика $object_type */
            'query_var' => true,
            /* разрешено ли использование query_var, также можно
            указать строку, которая будет использоваться в качестве
            него, по умолчанию - имя таксономии */
            'rewrite' => array(
                /* настройки URL пермалинков */
                'slug' => 'platform', // ярлык
                'hierarchical' => false // разрешить вложенность

            ),
        )
    );
}
add_action( 'init', 'add_new_taxonomies', 0 );

register_nav_menus( array(

    'footer_menu' => __( 'Footer menu' ),

) );

function _tk_theme_customizer( $wp_customize )
{
    $wp_customize->add_section('_tk_logo_section', array(
        'title' => __('Logo', '_tk'),
        'priority' => 30,
        'description' => 'Upload a logo to replace the default site name and description in the header',
    ));
    $wp_customize->add_setting( '_tk_logo' );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, '_tk_logo', array(
        'label'    => __( 'Logo', '_tk' ),
        'section'  => '_tk_logo_section',
        'settings' => '_tk_logo',
    ) ) );
}
add_action( 'customize_register', '_tk_theme_customizer' );

function _tk_register_theme_customizer( $wp_customize ) {
    $wp_customize->add_section('_tk_bg_section', array(
        'title' => __('Background Color', '_tk'),
        'priority' => 30,
        'description' => 'Change background color',
    ));
    $wp_customize->add_setting(
        '_tk_bg_color',
        array(
            'default'     => '#ffffff'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'bg_color',
            array(
                'label'      => __( 'Background Color', '_tk' ),
                'section'    => '_tk_bg_section',
                'settings'   => '_tk_bg_color'
            )
        )
    );

}
add_action( 'customize_register', '_tk_register_theme_customizer' );

function _tk_customizer_css() {
    ?>
    <style type="text/css">
        body { background-color: <?php echo get_theme_mod( '_tk_bg_color' ); ?>; }
    </style>
    <?php
}
add_action( 'wp_head', '_tk_customizer_css' );

function _tk_customizer_text( $wp_customize ) {
    //All our sections, settings, and controls will be added here

    $wp_customize->add_section( 'text_field_section' , array(
        'title'      => __( 'Custom text in header', '_tk' ),
        'priority'   => 30,
    ) );

    $wp_customize->add_setting( 'text_field' , array(
        'transport'   => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'site_other', array(
        'label'      => __( 'Custom text', '_tk' ),
        'section'    => 'text_field_section',
        'settings'   => 'text_field',
    ) ) );
}
add_action( 'customize_register', '_tk_customizer_text' );