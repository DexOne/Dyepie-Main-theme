<?php 
class dyepie_settings{
    public static function change_howdy($translated, $text, $domain) { 
        if ( 'default' != $domain) 
            return $translated; 
    
        if (false !== strpos($translated, 'Howdy')) 
            return str_replace('Howdy', 'Welcome ', $translated); 
    
        return $translated; 
    }

    //Remove JQuery migrate
    public static function remove_jquery_migrate( $scripts ) {
        if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
            $script = $scripts->registered['jquery'];
    
        if ( $script->deps ) { // Check whether the script has any dependencies
            $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
            }
        }
    }
    // over-write wp-login.php
    public static function login_overrides() {
        // do some check and call wp_redirect if its true or whatever you wanted to do
        wp_redirect(home_url());
    }


    public static function remove_wp_logo( $wp_admin_bar ) {
        $wp_admin_bar->remove_node( 'wp-logo' );
    }
    // Restrict Media Library Access
    public static function dyepie_media_only_access( $where ){
    	global $current_user;
    	if( is_user_logged_in() ){
    		// we spreken over een ingelogde user
    		if( isset( $_POST['action'] ) ){
    			// library query
    			if( $_POST['action'] == 'query-attachments' ){
    				$where .= ' AND post_author='.$current_user->data->ID;
    		    	}
    		}
    	    }
    
    	return $where;
        }
        // add product page link to admin bar
        public static function add_toolbar_items($admin_bar){
                $admin_bar->add_menu( array(
                    'id'    => 'add_product',
                    'title' => 'Add Product',
                    'href'  =>  site_url() . '/add-product',
                    'meta'  => array(
                        'title' => __('Add Product'),            
                    ),
				));
				$admin_bar->add_menu( array(
                    'id'    => 'edit_profile',
                    'title' => 'Edit Profile',
                    'href'  =>  site_url() . '/edit-profile',
                    'meta'  => array(
                        'title' => __('Edit Profile', 'dyepie'),            
                    ),
                ));
            
		}
		// remove some submenus from admin-bar 
		public static function remove_nodes_to_toolbar( $wp_admin_bar ) {
			global $current_user;
			wp_get_current_user();
			if( ! in_array( 'administrator', $current_user->roles ) ) {
				$wp_admin_bar->remove_node( 'site-name' );
				$wp_admin_bar->remove_node( 'new-content' );
				$wp_admin_bar->remove_node( 'edit-profile' );
				$wp_admin_bar->remove_node( 'user-info' );
				$wp_admin_bar->remove_node( 'search' );
				$wp_admin_bar->remove_node( 'notes' );
			}
			$wp_admin_bar->remove_node( 'logout' );

		}
		// hook failed login
		public static function my_front_end_login_fail( $username ) {
		$referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
		// if there's a valid referrer, and it's not the default log-in screen
		if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
			wp_redirect( $referrer . 'log-in' );  // let's append some information (login=failed) to the URL for the theme to use
			exit;
		}
		}
		// Remove the "Dashboard" , profile from the admin menu for non-admin users
		public static function wpse52752_remove_dashboard () {
			global $current_user, $menu, $submenu;
			wp_get_current_user();

			if( ! in_array( 'administrator', $current_user->roles ) ) {
				reset( $menu );
				$page = key( $menu );
				while( ( __( 'Dashboard' ) != $menu[$page][0] ) && next( $menu ) ) {
					$page = key( $menu );
				}
				if( __( 'Dashboard' ) == $menu[$page][0] ) {
					unset( $menu[$page] );
				}

				reset($menu);
				$page = key($menu);
				while ( ! $current_user->has_cap( $menu[$page][1] ) && next( $menu ) ) {
					$page = key( $menu );
				}
				if ( preg_match( '#wp-admin/?(index.php)?$#', $_SERVER['REQUEST_URI'] ) &&
					( 'index.php' != $menu[$page][2] ) ) {
						wp_redirect( get_option( 'siteurl' ));
				}
				if ( preg_match( '#wp-admin/?(profile.php)?$#', $_SERVER['REQUEST_URI'] ) &&
				( 'profile.php' != $menu[$page][2] ) ) {
					wp_redirect( get_option( 'siteurl' ));
			}
			}
		}
     
    }

// change howdy
add_filter('gettext', 'dyepie_settings::change_howdy', 10, 3);
add_action( 'wp_default_scripts', 'dyepie_settings::remove_jquery_migrate' );
// over-write wp-login.php
add_action( 'login_init', 'dyepie_settings::login_overrides' );
add_action( 'admin_bar_menu', 'dyepie_settings::remove_wp_logo', 999 );
// Restrict Media Library Access
add_filter( 'posts_where', 'dyepie_settings::dyepie_media_only_access' );
// add product hook
add_action('admin_bar_menu', 'dyepie_settings::add_toolbar_items', 100);
// remove admin-bar menus
add_action( 'admin_bar_menu', 'dyepie_settings::remove_nodes_to_toolbar', 999 );
// hook failed login
add_action( 'wp_login_failed', 'dyepie_settings::my_front_end_login_fail' ); 
// Remove the "Dashboard" from the admin menu for non-admin users
add_action('admin_menu', 'dyepie_settings::wpse52752_remove_dashboard');


// clean wp

// REMOVE EMOJI ICONS
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
// REMOVE JUNK FROM HEAD

remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
remove_action('wp_head', 'wp_generator'); // remove wordpress version
remove_action('wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
remove_action('wp_head', 'index_rel_link'); // remove link to index page
remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
?>