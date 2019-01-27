<?php 
$clothes = new homepage_product();
// Artworks ==== NORMAL ==== LOOP
wp_reset_query();
global $post;
$clothes_args = array(
    'post_type' => $clothes::POSTTYPE,
    'posts_per_page' => $clothes->posts_per_page,
    'tax_query' => array(
        array(
            'taxonomy' => $clothes->dyepie_tax,
            'feild'    => $clothes->slug(),
            'terms'    => $clothes->homepage_term_sec('clothes'),
        )
    ),
);?>
<section class="row popular_products">
    <main class="container animatedParent animateOnce">
        <h2 class="pop_prod">popular clothes</h2>
        <div class="main_product">
        <div class="row left_prod animatedParent"> 
        <div class="col-md-9 prod_three animated bounceInLeft">
<?php 
$clothes_query = new WP_Query( $clothes_args );
if($clothes_query->have_posts()){ 

while ( $clothes_query->have_posts() ){ $clothes_query->the_post();
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
                <?php echo $clothes->arrow('next_three'); ?>
                <div class="col-md-2 row social_medai animatedParent animateOnce">
                    <?php $clothes->social_media(); ?>
                </div>
            </div>
        </div>
    </main>
</section>
<?php 
  wp_reset_postdata(); 
?>