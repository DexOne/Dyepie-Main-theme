<?php get_header('custom'); ?>
		<!--  start row  -->
			<div class="row top_author">
				<div class="col-md-12 cover_image">
					<div class="cover_overlay">
						<div class="col-md-12 avatar_img">
						<!-- Get Author Avatar -->
						<?php
							$avatar_arguments = array(
							'class' => 'img-responsive img-thumbnail center-block custom-auto-thumbnail');

							echo get_avatar(get_the_author_meta('ID'),150,'','USER Avatar',$avatar_arguments);
								?>             
							</div>
							<a class="edit-profile" href="#">Edit Profie</a>
					</div>
				</div>
			</div>
			<div class="container">
			<div class="row author_info">
				<div class="col-md-4 author_description">
					<p class="text-center author_p">
						<?php the_author_meta('description'); ?>
					</p>
				</div>
				<div class="col-md-4">
					<h1 class="text-center author_name">
						<?php
						echo get_user_meta(get_queried_object_id(),'first_name', true) . ' ' . get_user_meta(get_queried_object_id(),'last_name', true) .'<br>';
							for ($i=0; $i < 5; $i++) { echo '<i class="fas fa-star stars"></i>';}
						?>
					</h1>
				</div>
				<div class="col-md-4 author_social">
<?php 
	echo get_user_meta(get_queried_object_id(), 'location', true) . '<br>';
	the_author_meta('user_email', get_queried_object_id()); ?>
	<br>
	<?php 
	echo get_user_meta(get_queried_object_id(), 'whatsapp_num', true) . '<br>';
	?>
	<br>
	<a href="<?php echo 'https://www.facebook.com/' . get_user_meta(get_queried_object_id(), 'fb_icon', true);?>">
		<i class="fab fa-facebook"></i>
	</a>
	<a href="<?php echo 'https://www.twitter.com/' . get_user_meta(get_queried_object_id(), 'twitter_icon', true);?>">
		<i class="fab fa-twitter"></i>
	</a>
	<hr>

				</div>
			</div>
			</div>
	<!--  end Row  -->

	<!--  start Row  -->
	<div class="container">
	<div class="row author-stats">
		<div class="col-md-6">
			<div class="stats">
				SELLER PRODUCTS : 
				<span class="span_green">
					<?php echo count_user_posts(get_queried_object_id(),'product');?>
				</span>
			</div>
		</div>
		<div class="col-md-6">
			<div class="stats">
				SELLER COMMENTS : 
			<span class="span_green">
					<?php $comment_count_arg = array(
	'user_id' => get_queried_object_id(),
	'count' => true );
					echo get_comments($comment_count_arg); ?>
				</span>
			</div>
		</div>
	</div>
	</div>
<!--  end row  -->
<div class="author_main">
<div class="row author_product">

	<?php
	$author_per_page = 6;
	$author_posts_arguments = array(
        'post_type' => 'product',
		'author' => get_queried_object_id(),
		'posts_per_page' => $author_per_page,
	);
	$author_posts = new wp_query($author_posts_arguments);
	?>
	<?php if ($author_posts->have_posts()) { // check if there's posts ?>
	<h1 class="posts-by-author text-center">
		USER'S PRODUCTS:
	</h1>
	<?php
	while ($author_posts->have_posts()) { // loop throught posts
		$author_posts->the_post(); ?>
			<div class="col-md-3 post-info">
			<div class="author-products-container">
				<?php the_post_thumbnail(array('100','150'), 
				['class' => 'img-responsive author-products-image', 'title' => 'Feature image']);
				the_content();

				?>
				<div class="author-products-overlay hold-title">
				<h2 class="title-h2">
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>	
				</div>
				</div>
		</div>
            
            <?php

	} // end while loop

	}// end if condition
	wp_reset_postdata();
?>
		<span class="container author_view_more">
			<a href="#" class="view_more">view more</a>
		</span>
    </div> 
</div>

<?php get_footer(); ?>
