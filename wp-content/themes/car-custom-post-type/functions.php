<?php
/**
 * Car Custom Post Type functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Car_Custom_Post_Type
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function car_custom_post_type_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Car Custom Post Type, use a find and replace
		* to change 'car-custom-post-type' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'car-custom-post-type', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'car-custom-post-type' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'car_custom_post_type_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'car_custom_post_type_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function car_custom_post_type_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'car_custom_post_type_content_width', 640 );
}
add_action( 'after_setup_theme', 'car_custom_post_type_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function car_custom_post_type_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'car-custom-post-type' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'car-custom-post-type' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'car_custom_post_type_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function car_custom_post_type_scripts() {
	wp_enqueue_style( 'car-custom-post-type-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'car-custom-post-type-style', 'rtl', 'replace' );

	wp_enqueue_script( 'car-custom-post-type-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.3.min.js', false, '3.6.0');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'car_custom_post_type_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


function create_car_cpt() {
    $labels = array(
        'name' => _x( 'Cars', 'Post Type General Name', 'textdomain' ),
        'singular_name' => _x( 'Car', 'Post Type Singular Name', 'textdomain' ),
    );

    $args = array(
        'label' => __( 'Car', 'textdomain' ),
        'supports' => array( 'title', 'thumbnail' ),
        'taxonomies' => array( 'make', 'model', 'year', 'fuel_type' ),
        'public' => true,
        'show_ui' => true,
    );

    register_post_type( 'car', $args );
}
add_action( 'init', 'create_car_cpt' );

function create_car_taxonomies() {

    $labels = array(
        'name' => _x( 'Makes', 'taxonomy general name' ),
        'singular_name' => _x( 'Make', 'taxonomy singular name' ),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
    );

    register_taxonomy( 'make', array( 'car' ), $args );

    $labels = array(
        'name' => _x( 'Models', 'taxonomy general name' ),
        'singular_name' => _x( 'Model', 'taxonomy singular name' ),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
    );

    register_taxonomy( 'model', array( 'car' ), $args );

    $labels = array(
        'name' => _x( 'Years', 'taxonomy general name' ),
        'singular_name' => _x( 'Year', 'taxonomy singular name' ),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
    );

    register_taxonomy( 'year', array( 'car' ), $args );

    $labels = array(
        'name' => _x( 'Fuel Types', 'taxonomy general name' ),
        'singular_name' => _x( 'Fuel Type', 'taxonomy singular name' ),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
    );

    register_taxonomy( 'fuel_type', array( 'car' ), $args );
}
add_action( 'init', 'create_car_taxonomies' );


function car_entry_form() {
    
    $makes = get_terms(array(
    	'taxonomy' => 'make', 
    	'hide_empty' => false)
	);
    $models = get_terms(array(
    	'taxonomy' => 'model', 
    	'hide_empty' => false)
	);
    $fuel_types = get_terms(array(
    	'taxonomy' => 'fuel_type',
    	'hide_empty' => false)
	);

    ob_start();
   ?>

<div class="car-info-form">
    <h1>Car Form</h1>

    <form id="car-entry-form" enctype="multipart/form-data">
        <?php wp_nonce_field('car_entry_nonce', 'car_entry_nonce_field'); ?>
        <label for="car-name">Car Name:</label>
        <input type="text" id="car-name" name="car_name" required><br>

        <label for="car-make">Make:</label>
        <select id="car-make" name="car_make" required>
            <?php foreach ($makes as $make) : ?>
                <option value="<?php echo $make->term_id; ?>"><?php echo $make->name; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="car-model">Model:</label>
        <select id="car-model" name="car_model" required>
            <?php foreach ($models as $model) : ?>
                <option value="<?php echo $model->term_id; ?>"><?php echo $model->name; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="car-fuel-type">Fuel Type:</label>
        <?php foreach ($fuel_types as $fuel_type) : ?>
            <input type="radio" id="fuel-type-<?php echo $fuel_type->term_id; ?>" name="car_fuel_type" value="<?php echo $fuel_type->term_id; ?>" required>
            <label for="fuel-type-<?php echo $fuel_type->term_id; ?>"><?php echo $fuel_type->name; ?></label>
        <?php endforeach; ?><br>

        <label for="car-image">Image:</label>
        <input type="file" id="car-image" name="car_image" required><br>

        <button type="submit">Submit</button>
    </form>
</div>
<div id="car-entry-message"></div>


<script>
	jQuery(document).ready(function($) {
	    $('#car-entry-form').on('submit', function(e) {
	        e.preventDefault();

	        var formData = new FormData(this);
	        formData.append('action', 'submit_car_entry_form');

	        $.ajax({
	            url: '<?php echo admin_url('admin-ajax.php'); ?>',
	            type: 'POST',
	            data: formData,
	            processData: false,
	            contentType: false,
	            success: function(response) {
	                $('#car-entry-message').html('<p>' + response.data + '</p>');
	                if (response.success) {
	                    $('#car-entry-form')[0].reset();
	                }
	            },
	            error: function(response) {
	                $('#car-entry-message').html('<p>' + response.data + '</p>');
	            }
	        });
	    });
	});
</script>

<?php
	return ob_get_clean();
}
add_shortcode('car_entry', 'car_entry_form');


function submit_car_entry_form() {

    if (!isset($_POST['car_entry_nonce_field']) || !wp_verify_nonce($_POST['car_entry_nonce_field'], 'car_entry_nonce')) {
        wp_send_json_error('Nonce verification failed.');
        return;
    }

    if (!isset($_POST['car_name'], $_POST['car_make'], $_POST['car_model'], $_POST['car_fuel_type'], $_FILES['car_image'])) {
        wp_send_json_error('All fields are required.');
        return;
    }

    $car_name = $_POST['car_name'];
    $car_make = $_POST['car_make'];
    $car_model = $_POST['car_model'];
    $car_fuel_type = $_POST['car_fuel_type'];
    
    $car_post = array(
        'post_title' => $car_name,
        'post_type' => 'car',
        'post_status' => 'publish',
    );

    $post_id = wp_insert_post($car_post);

    if (is_wp_error($post_id)) {
        wp_send_json_error('Error creating the Car post.');
        return;
    }

    wp_set_post_terms($post_id, array($car_make), 'make');
    wp_set_post_terms($post_id, array($car_model), 'model');
    wp_set_post_terms($post_id, array($car_fuel_type), 'fuel_type');

    $attachment_id = media_handle_upload('car_image', $post_id);

    if (is_wp_error($attachment_id)) {
        wp_send_json_error('Error uploading the image.');
        return;
    }

    set_post_thumbnail($post_id, $attachment_id);

    wp_send_json_success('Car Info Added Successfully.');
}
add_action('wp_ajax_submit_car_entry_form', 'submit_car_entry_form');
add_action('wp_ajax_nopriv_submit_car_entry_form', 'submit_car_entry_form');

function car_list_shortcode() {
    $args = array(
        'post_type' => 'car',
        'posts_per_page' => -1,
    );

    $car_query = new WP_Query($args);

    ob_start();

    if ($car_query->have_posts()) {
        echo '<table class="car-list-table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Thumbnail</th>';
        echo '<th>Car Name</th>';
        echo '<th>Make</th>';
        echo '<th>Model</th>';
        echo '<th>Fuel Type</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($car_query->have_posts()) {
            $car_query->the_post();

            $make_terms = get_the_terms(get_the_ID(), 'make');
            $model_terms = get_the_terms(get_the_ID(), 'model');
            $fuel_type_terms = get_the_terms(get_the_ID(), 'fuel_type');

            echo '<tr>';
            echo '<td>';
            if (has_post_thumbnail()) {
                echo get_the_post_thumbnail(get_the_ID(), 'thumbnail');
            } else {
                echo 'N/A';
            }
            echo '</td>';
            echo '<td>' . get_the_title() . '</td>';
            echo '<td>' . ($make_terms ? $make_terms[0]->name : 'N/A') . '</td>';
            echo '<td>' . ($model_terms ? $model_terms[0]->name : 'N/A') . '</td>';
            echo '<td>' . ($fuel_type_terms ? $fuel_type_terms[0]->name : 'N/A') . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>No cars found.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('car_list', 'car_list_shortcode');
