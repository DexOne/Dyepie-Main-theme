<?php 
/*
 *  Author: Ragnar
 *  URL: Soon
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	dyepie External Modules/Files
\*------------------------------------*/

function dyepie_styles() {
		$hold_styles_cdn = array(
			'bootstrap' => 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css',
			'fontawesome5' => 'https://use.fontawesome.com/releases/v5.5.0/css/all.css',
			'slick' => '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.css',
			'slick-theme' => 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.min.css',
			'bootstrap-toggle' => 'https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css',
			'dyepie_animated' => 'https://cdn.jsdelivr.net/gh/Jack-McCourt/css3-animate-it/css/animations.css',
		);		
		foreach ($hold_styles_cdn as $name => $src) {
			wp_enqueue_style( $name, $src, array(), true );
		}
		$hold_styles_static = array(
			'login_register' => 'login_register.css',
			'dyepie-main' => 'dyepie.css',
		);
		foreach ($hold_styles_static as $name => $src) {
			wp_enqueue_style( $name, get_template_directory_uri() . '/css/' . $src , array(), true );
		}

		if(is_page(array('log-in','register'))){
			wp_enqueue_style( 'login_register', get_template_directory_uri() . '/css/login_register.css', array(), true );
		}
			
	}

add_action( 'wp_enqueue_scripts', 'dyepie_styles' );
// Winterfell Scripts

function dyepie_scripts() {

	$hold_scripts = array(
		'dyepie_jquery' => 'https://code.jquery.com/jquery-3.3.1.min.js',
		'bootstrap' => 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js?ver=4.9.8',
		'slick' => 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
		'bootstrap-toggle' => 'https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js',
        'animate-it' => 'https://cdn.jsdelivr.net/gh/Jack-McCourt/css3-animate-it/js/css3-animate-it.js',
        // validation
        'validation' =>
        'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js',
	);

	foreach ($hold_scripts as $script_name => $link) {
		wp_register_script($script_name, $link, '','', true);
	wp_enqueue_script($script_name);
	}
    
wp_register_script('main-js', get_template_directory_uri() . '/js/dyepie.js', '','', true);
wp_enqueue_script('main-js');
}
 
add_action( 'wp_enqueue_scripts', 'dyepie_scripts' );

// dequeue embed
function my_deregister_scripts(){
 wp_dequeue_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );


// add theme support
function custom_theme_features()  {
	// Add theme support for Post Formats
	add_theme_support( 'post-formats', array( 'status', 'quote', 'gallery', 'image', 'video', 'audio', 'link', 'aside', 'chat' ) );

	// Add theme support for Featured Images
	add_theme_support( 'post-thumbnails', array( 'product' ) );

	// Add theme support for HTML5 Semantic Markup
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	// Add theme support for document Title tag
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'custom_theme_features' );
// styling Log-in && add style sheet

function my_custom_login(){
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/login/custom-login-style.css" />';
}
add_action('login_head', 'my_custom_login');



add_filter( 'body_class', 'wpse_268176_body_class' );

function wpse_268176_body_class( $classes ) {

    $user = wp_get_current_user();
	global $wp_roles;
    if ( in_array( 'client', $wp_roles->roles ) ) {
        $classes[] = 'class-name'; // your custom class name
    }

    return $classes;
}

// user roles //
//global $wp_roles; // global class wp-includes/capabilities.php

/* Register custom
 * navigation menus
 */
// include Navbar Walker For customize bootsrtap Navigation
require_once get_template_directory() . '/bootstrap-navwalker.php';

function dyepie_navbar() {

	$locations = array(
		'dyepie_navbar' => __( 'it\'s a header navbar menu', 'dyepie' ),
	);
	register_nav_menus( $locations );

}
add_action( 'init', 'dyepie_navbar' );

// make layout in Screen options 1 col by default
function so_screen_layout_columns( $columns ) {
    $columns['post product'] = 1;
    return $columns;
}
add_filter( 'screen_layout_columns', 'so_screen_layout_columns' );

function so_screen_layout_post() {
    return 1;
}
add_filter( 'get_user_option_screen_layout_post', 'so_screen_layout_post' );


function change_logo_class($html)
{
	$html = str_replace('custom-logo-link', 'navbar-brand', $html);
	return $html;
}

add_theme_support( 'custom-logo' );



function body_id_dynamic() {

    if (is_home()) {

        echo ' id="home"';

    } elseif (is_single()) {

        echo ' id="single"';

    } elseif (is_search()) {

        echo ' id="search"';

    }
	 elseif (is_author()) {

		echo ' id="author"';
	}
	 elseif (is_archive()) {

		echo ' id="archive"';
	}
}


add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
    <h3><?php _e("Extra profile information", "dyepie"); ?></h3>

    <table class="form-table">
    <tr>
        <th><label for="location"><?php _e("Location"); ?></label></th>
        <td>
            <input type="text" name="location" id="location" value="<?php echo esc_attr( get_the_author_meta( 'location', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your location."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="whatsapp_num"><?php _e("Whatsapp Number", 'dyepie'); ?></label></th>
        <td>
            <input type="text" name="whatsapp_num" id="whatsapp_num" value="<?php echo esc_attr( get_the_author_meta( 'whatsapp_num', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description">
				<?php _e("Please enter your whatsapp number .", 'dyepie'); ?></span>
        </td>
	</tr>
	<tr>
	<th>
		<label for="fb_icon"><?php _e("Facebook Profile Link"); ?></label>
	</th>
        <td>
            <input type="text" name="fb_icon" id="fb_icon" value="<?php echo esc_attr( get_the_author_meta( 'fb_icon', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your facebook link without facebook.com ."); ?></span>
        </td>
	</tr>
	<tr>
	<th>
		<label for="twitter_icon"><?php _e("Twitter Profile Link", "dyepie"); ?></label>
	</th>
        <td>
            <input type="text" name="twitter_icon" id="twitter_icon" value="<?php echo esc_attr( get_the_author_meta( 'twitter_icon', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your twitter id link without twitter.com ."); ?></span>
        </td>
	</tr>
    </table>
<?php }

// save data fields
add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'location', $_POST['location'] );
	update_user_meta( $user_id, 'whatsapp_num', $_POST['whatsapp_num'] );
	update_user_meta( $user_id, 'fb_icon', $_POST['fb_icon'] );
	update_user_meta( $user_id, 'twitter_icon', $_POST['twitter_icon'] );
}

/* Display a notice that can be dismissed */

// add_action('admin_notices', 'example_admin_notice');

// function example_admin_notice() {
//     global $current_user ;
//         $user_id = $current_user->ID;
//         /* Check that the user hasn't already clicked to ignore the message */
//     if ( ! get_user_meta($user_id, 'example_ignore_notice') ) {
//         echo '<div class="updated"><p>'; 
//         printf(__('This is an annoying nag message.  Why do people make these? | <a href="%1$s">Hide Notice</a>'), '?example_nag_ignore=0');
//         echo "</p></div>";
//     }
// }

// add_action('admin_init', 'example_nag_ignore');

// function example_nag_ignore() {
//     global $current_user;
//         $user_id = $current_user->ID;
//         /* If user clicks to ignore the notice, add that to their user meta */
//         if ( isset($_GET['example_nag_ignore']) && '0' == $_GET['example_nag_ignore'] ) {
//              add_user_meta($user_id, 'example_ignore_notice', 'true', true);
//     }
// }


// ajax
add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');

function load_posts_by_ajax_callback() {
    check_ajax_referer('load_more_posts', 'security');
    $paged = $_POST['page'];
    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => 6,
        'paged' => $paged,
    );
    $my_posts = new WP_Query( $args );
    if ( $my_posts->have_posts() ) {
        ?>
        <div class="my-posts row container">
            <div class="col-md-8 row">
        <?php while ( $my_posts->have_posts() ) { $my_posts->the_post() ?>
            <?php 
                   $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                   echo 
                   '
                   <div class="product_hold col-md-4" style="background-image:url('. $url .');height:11rem;">
                       <div class="overlay">
                           <a  class="prod_title" href="' . get_the_permalink() .'">' . get_the_title() .'</a>
                           <span>$$$</span>
                           ';
                           the_terms(
                               $term->id, 'prod', '<span class="prod_tags">', '-', '</span>'
                               );
                               echo'
                       </div> 
                   </div>
                   ';
                
                ?>
        <?php } ?>
            </div>
        </div>
        <?php
    } 
	wp_die();
}
require_once( get_template_directory() . '/inc/metabox.php');
// get classes
require_once( get_template_directory() . '/inc/classes/product_terms.php' );
require_once( get_template_directory() . '/inc/classes/dyepie_settings.php' );
// custom post type
require_once( get_template_directory() . '/template-parts/custom-products.php' );
// register class
require_once( get_template_directory() . '/template-parts/register-backend.php' );
// import custom post type 'product'
require_once dirname( __FILE__ ) . '/template-parts/breadcrumb.php';



// register widget area

if (function_exists('register_sidebar')) {

	register_sidebar(array(
		'name' => 'Dyepie Widgets Area',
		'id'   => 'dyepie-widgets',
		'description'   => 'This is a dyepie\'s widgetized area.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));

}
?>