<?php get_header('custom');
	$single_prod = new homepage_product();
	global $post;
	$author_id= $post->post_author;
   if (function_exists('my_breadcrumbs')) {my_breadcrumbs();}
?>    
            	<!-- The Author Information -->
				<div class="container">
					<div class="row">
				<div class="col-md-6 author_data">
						<div class="avatar_img_single">
						<!-- Get Author Avatar -->
						<?php
							$avatar_arguments = array(
							'class' => 'img-responsive img-thumbnail center-block custom-auto-thumbnail single_avatar');

							echo get_avatar(get_the_author_meta('ID'),150,'','USER Avatar',$avatar_arguments);
                        ?>             
						</div>
						<div class="single_name_stars">
						<h1 class="text-center single_author_name">

						<a href="<?php echo get_author_posts_url($author_id, get_the_author_meta( 'user_nicename' ) ); ?>">
							<?php echo get_user_meta($author_id,'first_name', true) . ' ' . get_user_meta($author_id,'last_name', true);
							?>
						</a>
					</h1>
					<div>
					<?php 
						echo do_shortcode( '[yasr_overall_rating] ' ); 
					 	echo get_post_meta(get_the_ID(), 'yasr_overall_rating', true);
						//for ($i=0; $i < 5; $i++) { echo '<i class="fas fa-star stars"></i>';}
						?>
					</div>
						</div>
				</div>

				<div class="col-md-6 single_author_social">
					<div>
						<a href="<?php echo 'https://www.facebook.com/' . get_user_meta($author_id, 'fb_icon', true);?>">
							<i class="fab fa-facebook"></i>
						</a>
						<a href="<?php echo 'https://www.twitter.com/' . get_user_meta($author_id, 'twitter_icon', true); ?>">
							<i class="fab fa-twitter"></i>
						</a>
					</div>
					<div>
						<h6>
						<?php echo get_user_meta($author_id, 'whatsapp_num', true); ?>
						</h6>
						<h6>
						<?php echo get_user_meta( $author_id , 'location', true); ?>
						</h6>
					</div>
				</div>
			</div>
			</div>
			<div class="container">
        <div class="row">
            <div class="col-md-6 single_prod_name">
                <h1><?php the_title(); ?></h1>
				<h4 style="color:#000;"><?php echo $single_prod->term_name(); ?></h4>
			</div>
			<div class="col-md-6 priceless">
				<h1 class="price_num">
			<?php 
			echo $meta_print_price_value = get_post_meta(get_the_ID(),'single_product_price',true);
			?> <span>L.E</span>
			</h1>
			</div>
		</div>
		<!-- author slider  -->
			<div class="row">
				<div class="col-md-8">
					<div class="prev">
						<?php $single_prod->arrow_single('prev_single','left'); ?>
					</div>
					<div class="single_prod_slider col-md-12">
					<?php $meta_vals = array(
						'one','two','three','four','five',);
						foreach ($meta_vals as $value) {
							$data = get_post_meta(get_the_ID(),'single_product_'.$value,true);
							echo('
							<img class="single_prod_img" src="'.$data.'" alt="">
							');
						}
					?>
					</div>
					<div class="next">
						<?php $single_prod->arrow_single('next_single','right'); ?>
					</div>
				</div>
				<div class="col-md-4 prod_details">
					<h2>- handmade product </h2>
					<?php 
						$meta_vals_info = array(
							'- shipping' => 'shipping',
							'- material' => 'material',
							'- wieght' => 'wieght',
							'- wieght unit' => 'wieght-unit',
							'- made in' => 'made-in',
						);
						foreach ($meta_vals_info as $key => $val_info) {
							$data_info = get_post_meta(get_the_ID(),'single_product_'.$val_info,true);
							echo('
							<h5 class="">'.$key.': <span>'.$data_info.'</span></h5>
							');
						}
						
?>
				</div>
	</div>
	<?php echo do_shortcode( '[yasr_visitor_votes] ' ); ?>
	<?php 
$single_product_content = new homepage_product();
// get taxonomy terms
$terms = wp_get_post_terms( $post->ID, 'prod' );
    foreach( $terms as $term){ $term->name; } ?>
	<div class="row">
	<div class="col-md-12 container">
		<?php 
		// Assuming you've got $author_id set
		// and your post type is called 'your_post_type'
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => 1,
			'tax_query' => array(
				array(
					'taxonomy' => $single_product_content->dyepie_tax,
					'feild'    => $single_product_content->slug(),
					'terms'    => $term->term_id,
				)
			),
		);
		$author_posts = new WP_Query( $args );
		if( $author_posts->have_posts() ) {
			while( $author_posts->have_posts()) { 
				$author_posts->the_post();
				// title, content, etc ?>
			<div class="author-products-container">
				<?php 
				the_content();

				?>
				</div>
				<?php 
			}
		}

		wp_reset_postdata();

		?>
	</div>
	</div> 
	<div class="row other_products">
		<h2 class="col-md-12 other_prod">other products by " <?php the_author(); ?> "</h2>
		<?php 
		// Assuming you've got $author_id set
		// and your post type is called 'your_post_type'
		$args = array(
			'author' => $author_id,
			'post_type' => 'product',
			'posts_per_page' => 4,
		);
		$author_posts = new WP_Query( $args );
		if( $author_posts->have_posts() ) {
			while( $author_posts->have_posts()) { 
				$author_posts->the_post();
				// title, content, etc ?>
				<div class="col-md-3 post-info">
					<div class="single-author-products-container">
						<?php the_post_thumbnail(array('100','100'), 
						['class' => 'img-responsive author-products-image', 'title' => 'Feature image']);
						?>
						<div class="single-author-products-overlay hold-title">
							<h2 class="title-h2">
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h2>	
						</div>
					</div>
				</div>
				<?php 
			}
			wp_reset_postdata();
		}

		?>
	</div>
<?php 
// If comments are open or we have at least one comment, load up the comment template.
   // comments_template();
?>
</div>
<?php 
get_footer(); ?>