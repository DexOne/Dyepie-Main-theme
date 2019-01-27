<?php 
$accessories = new homepage_product();
// Artworks ==== NORMAL ==== LOOP
wp_reset_query();
global $post;
$accessories_args = array(
    'post_type' => $accessories::POSTTYPE,
    'posts_per_page' => $accessories->posts_per_page,
    'tax_query' => array(
        array(
            'taxonomy' => $accessories->dyepie_tax,
            'feild'    => $accessories->slug(),
            'terms'    => $accessories->homepage_term_sec('accessories'),
        )
    ),
);?>
<section class="row popular_products">
    <main class="container animatedParent animateOnce">
        <h2 class="pop_prod">popular accessories</h2>
        <div class="main_product">
        <div class="row left_prod animatedParent"> 
        <div class="col-md-9 prod_one animated bounceInLeft">
<?php 
$accessories_query = new WP_Query( $accessories_args );
if($accessories_query->have_posts()){ 

while ( $accessories_query->have_posts() ){ $accessories_query->the_post();
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
                <?php echo $accessories->arrow('next_one'); ?>
                <div class="col-md-2 row social_medai animatedParent animateOnce">
                    <?php $accessories->social_media(); ?>
                </div>
            </div>
        </div>
    </main>
</section>
<?php 
  wp_reset_postdata(); 
?>