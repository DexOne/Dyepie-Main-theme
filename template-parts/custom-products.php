<?php	
// Register Custom Post Type product
// Post Type Key: product
function create_product_cpt() {

	$labels = array(
		'name' => __( 'product', 'dyepie' ),
		'singular_name' => __( 'products', 'dyepie' ),
		'menu_name' => __( 'products', 'dyepie' ),
		'name_admin_bar' => __( 'product', 'dyepie' ),
		'archives' => __( 'product Archives', 'dyepie' ),
		'attributes' => __( 'product Attributes', 'dyepie' ),
		'parent_item_colon' => __( 'Parent product:', 'dyepie' ),
		'all_items' => __( 'All products', 'dyepie' ),
		'add_new_item' => __( 'Add New product', 'dyepie' ),
		'add_new' => __( 'Add New', 'dyepie' ),
		'new_item' => __( 'New product', 'dyepie' ),
		'edit_item' => __( 'Edit product', 'dyepie' ),
		'update_item' => __( 'Update product', 'dyepie' ),
		'view_item' => __( 'View product', 'dyepie' ),
		'view_items' => __( 'View products', 'dyepie' ),
		'search_items' => __( 'Search product', 'dyepie' ),
		'not_found' => __( 'Not found', 'dyepie' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'dyepie' ),
		'featured_image' => __( 'Featured Image', 'dyepie' ),
		'set_featured_image' => __( 'Set featured image', 'dyepie' ),
		'remove_featured_image' => __( 'Remove featured image', 'dyepie' ),
		'use_featured_image' => __( 'Use as featured image', 'dyepie' ),
		'insert_into_item' => __( 'Insert into product', 'dyepie' ),
		'uploaded_to_this_item' => __( 'Uploaded to this product', 'dyepie' ),
		'items_list' => __( 'products list', 'dyepie' ),
		'items_list_navigation' => __( 'products list navigation', 'dyepie' ),
		'filter_items_list' => __( 'Filter products list', 'dyepie' ),
		'capabilities' => array(
			'read_post'			=> 'read_product',
			'read_private_posts' 		=> 'read_private_products',
			'edit_post'			=> 'edit_product',
			'edit_posts'			=> 'edit_products',
			'edit_others_posts'		=> 'edit_others_products',
			'edit_published_posts'		=> 'edit_published_products',
			'edit_private_posts'		=> 'edit_private_products',
			'delete_post'			=> 'delete_product',
			'delete_posts'			=> 'delete_products',
			'delete_others_posts'		=> 'delete_others_products',
			'delete_published_posts'	=> 'delete_published_products',
			'delete_private_posts'		=> 'delete_private_products',
			'publish_posts'			=> 'publish_products',
			'moderate_comments'		=> 'moderate_product_comments',
			),
			'map_meta_cap' => true,
			'hierarchical' => true,
			'supports' => array( 'title', 'editor', 'author', 'excerpt', 'custom-fields', 'comments' ),
			'taxonomies' => array( 'prod' ),
			'has_archive' => true,
			);
	$args = array(
		'label' => __( 'product', 'dyepie' ),
		'description' => __( 'show users products', 'dyepie' ),
		'labels' => $labels,
		'menu_icon' => 'dashicons-cart',
        'supports' => array('title','editor','author', 'thumbnail'),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'map_meta_cap' => true,
		'has_archive' => true,
        'query_var' => true,
		'rewrite' => true,
	);
	register_post_type( 'product', $args);
}
add_action( 'init', 'create_product_cpt', 0 );

// Register Taxonomy prod
// Register Custom Taxonomy
function dyepie_taxonomy() {

	$labels = array(
		'name'                       => _x( 'product list', 'Taxonomy General Name', 'dyepie' ),
		'singular_name'              => _x( 'product list', 'Taxonomy Singular Name', 'dyepie' ),
		'menu_name'                  => __( 'product list', 'dyepie' ),
		'all_items'                  => __( 'All Items', 'dyepie' ),
		'parent_item'                => __( 'Parent Item', 'dyepie' ),
		'parent_item_colon'          => __( 'Parent Item:', 'dyepie' ),
		'new_item_name'              => __( 'New Item Name', 'dyepie' ),
		'add_new_item'               => __( 'Add New Item', 'dyepie' ),
		'edit_item'                  => __( 'Edit Item', 'dyepie' ),
		'update_item'                => __( 'Update Item', 'dyepie' ),
		'view_item'                  => __( 'View Item', 'dyepie' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'dyepie' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'dyepie' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'dyepie' ),
		'popular_items'              => __( 'Popular Items', 'dyepie' ),
		'search_items'               => __( 'Search Items', 'dyepie' ),
		'not_found'                  => __( 'Not Found', 'dyepie' ),
		'no_terms'                   => __( 'No items', 'dyepie' ),
		'items_list'                 => __( 'Items list', 'dyepie' ),
		'items_list_navigation'      => __( 'Items list navigation', 'dyepie' ),
	);
	$args = array(
		'labels'                => $labels,
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'show_in_nav_menus'     => true,
		'show_tagcloud'         => true,
		'show_in_rest'			=> true,
        'rewrite'      			=> array('slug' => '/prod', 'with_front' => true),
	);
	register_taxonomy( 'prod', array( 'product' ), $args );

}
add_action( 'init', 'dyepie_taxonomy', 0 );
?>
