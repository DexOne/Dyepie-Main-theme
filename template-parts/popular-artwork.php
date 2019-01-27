<?php 
$artworks = new homepage_product();
// Artworks ==== NORMAL ==== LOOP
wp_reset_query();
global $post;
$artworks_args = array(
    'post_type' => $artworks::POSTTYPE,
    'posts_per_page' => $artworks->posts_per_page,
    'tax_query' => array(
        array(
            'taxonomy' => $artworks->dyepie_tax,
            'feild'    => $artworks->slug(),
            'terms'    => $artworks->homepage_term_sec('artworks'),
        )
    ),
); ?>
<section class="row popular_products">
    <main class="container animatedParent animateOnce">
        <h2 class="pop_prod">popular Artworks</h2>
        <div class="main_product">
        <div class="row left_prod animatedParent"> 
        <div class="col-md-9 prod_two animated bounceInLeft">
<?php 
$artworks_query = new WP_Query( $artworks_args );
if($artworks_query->have_posts()){ 

while ( $artworks_query->have_posts() ){ $artworks_query->the_post();
    $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
    ?>    
    <div class="home_image" style="background-image:url(<?php echo $url ?>);height:11rem;">
        <div class="overlay">
            <h3 class="prod_name">
            <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
        </h3>
        </div>
    </div>
        <?php 
    } // end-while
} // end-if ?>
                </div>
                <?php echo $artworks->arrow('next_two'); ?>
                <div class="col-md-2 row social_medai animatedParent animateOnce">
                    <?php $artworks->social_media(); ?>
                </div>
            </div>
        </div>
    </main>
</section>
<?php 
  wp_reset_postdata(); 
?>