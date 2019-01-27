<?php 
$tax_product = new homepage_product();

get_header('custom');
// get taxonomy terms
$terms = wp_get_post_terms( $post->ID, 'prod');
    foreach( $terms as $term){ $term->name; }
get_search_form();
echo '<h1 class="text-center taxo-name">' . single_term_title( "", false ) . '</h1>'; 
// show the name too
// echo $current_term = single_term_title( "", false );


// FIRST ==== TOP 5 ==== LOOP
wp_reset_query();
    $top5_args = array(
        'post_type' => $tax_product::POSTTYPE,
       'posts_per_page' => 5,
        'orderby' => 'comment_count',
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => $tax_product->dyepie_tax,
                'feild'    => $tax_product->slug(),
                'terms'    => $term->term_id,
            )
        ),
     );
    ?>
    <section class="text-center prod_main">
        <h2 class="recent_posts">TOP 5</h2>
        <div class="top5">
    <?php 
     $top5_loop = new WP_Query($top5_args);

     if($top5_loop->have_posts()) {
        $count = '';
        while($top5_loop->have_posts()) : $top5_loop->the_post(); 
        $count++;

        if ( $count == 1 ) {
           ?>
                <div class="top5_div top5_div_left">
                    <div class="overlay">
                        <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                        <span>$$$</span>
                    </div>
                </div>
        <?php 
        }elseif( $count == 2) { ?>
                <div class="top5_div top5_div_mid">
                    <div class="overlay">
                        <a href="<?php the_permalink(); ?>"><?php the_title() ?>
                        </a>
                        <span>$$$</span>
                    </div>
                </div>
        <?php 
        }elseif( $count == 3) { ?>
                <div class="top5_div top5_div_last">
                    <div class="overlay">
                        <a href="<?php the_permalink(); ?>"><?php the_title() ?>
                        </a>
                        <span>$$$</span>
                    </div>
                </div>
        <?php 
        }elseif( $count == 4) {      
            ?>
            <div class="top5_div top5_div_hold_updown">
                <div class="top5_div top5_div_up">
                    <div class="overlay">
                        <a href="<?php the_permalink(); ?>"><?php the_title() ?>
                        </a>
                        <span>$$$</span>
                    </div>
                </div>            
           <?php 
        }else{  ?>
                    <div class="top5_div top5_div_down">
                        <div class="overlay">
                        <a href="<?php the_permalink(); ?>"><?php the_title() ?>
                        </a>
                        <span>$$$</span>
                        </div>
                    </div> 
                </div>         
          <?php 
        } ?>
    <?php 

        endwhile;

     } 
     wp_reset_postdata();

     ?>
     <div  class="adv_er top5_div">
            <h6>Advertise</h6>
            </div>
     </div>
</section>
<h2 class="recent_posts">Recently Added</h2>
<section class="text-center prod_main normal_prod">
<?php 
// SECOND ==== NORMAL ==== LOOP
$normal_paged = isset( $_GET['normal_paged'] ) ? (int) $_GET['normal_paged'] : 1;
wp_reset_query();
$normal_args = array(
    'post_type' => $tax_product::POSTTYPE,
    'posts_per_page' => $tax_product->posts_per_page,
    'paged' => $normal_paged,
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy' => $tax_product->dyepie_tax,
            'feild'    => $tax_product->slug(),
            'terms'    => $term->term_id,
        )
    ),
);

$normal_query = new WP_Query( $normal_args );
if($normal_query->have_posts()){ ?>
    <div class="normal_top5">
        <?php 
while ( $normal_query->have_posts() ) { $normal_query->the_post();
    $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
    echo 
    '<div class="top5_div normal_div">
         <img src="'. $url .'" alt="">
             <div class="overlay">
             ';
?>           
            <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
            <span>$$$</span>
            <?php 
            echo'</div> 
             </div>'; // overlay
            ?>
<?php 

}
}
$normal_page_args = array(
'format'  => '?normal_paged=%#%',
'current' => $normal_paged,
'total'   => $normal_query->max_num_pages,
'show_all'           => false,
'end_size'           => 1,
'mid_size'           => 2,
'prev_next'          => true,
'prev_text'          => __('Previous','dyepie'),
'next_text'          => __('Next','dyepie'),
'type'               => 'list',
'add_args'           => false,
'add_fragment'       => '',
'before_page_number' => '',
'after_page_number'  => ''
);

?>

</div>
            <!-- Add Pagination -->
  <?php 
  echo paginate_links( $normal_page_args );
  wp_reset_postdata(); 
?>
<div class="hold_adv">
<h6 class="adv_head">Advertise</h6>
     <div  class="top5_div adv_margin">
        <img src="/wp-content/themes/dyepie/images/slider-4.jpg" alt="" >
    </div>
    <div  class="top5_div adv_margin">
        <img src="/wp-content/themes/dyepie/images/slider-4.jpg" alt="" >
    </div>
</div>
</section>
<div class="view_all">
    <h5 class="">
        <a href="<?php echo home_url('/product')?>">
        view all
    </a>
</h5>
</div>
<section class="rand-product">
    <?php get_template_part('/template-parts/random', 'prod') ?>
</section>
<?php 
get_footer();
    if(taxonomy_exists('prod')){ ?>
        <style>
            .overlay{
                height: 100%;
                background: rgba(0, 0, 0, 0.3);
            }
            .prod_main{
                width: 100%;
                padding: 0;
                margin: 0 auto;
                margin-bottom: 5em;
            }
            .recent_posts{
                text-align: left;
                font-size: 40px;
                font-weight: 900;
                padding-bottom: .5em;
                width: 80%;
                margin: 1em auto;
            }
            .left_form {
                float: right;
                width: 25%;
                margin-top: 1em;
                margin-right: .5em;
            }
            .taxo-name{
                clear: both;
                font-size: 60px;
                font-weight: 900;
                padding: .5em;
                text-transform: uppercase;
            }
            .normal_prod{
                width: 80%;
                padding: 0;
                margin: 0 auto;
                margin-bottom: 2em;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .hold_adv{
                position: relative;
            }
            .adv_head{
                position: absolute;
                left: 1.5em;
                right: 0px;
                z-index: 9999;
                color: #fff;
                background: rgba(0, 0, 0, 0.5);
                width: 85%;
                margin: auto;
            }
            .adv_margin img{
                margin-bottom: .8em;
                margin-top: 0px;
                width: 200px;
                margin-left: 1.5em;
            }

            .slick-prev:before {
                content: '←';
                color: #000;
                font-size: 26px;
                position: relative;
                right: 1em;
                bottom: .3em;
            }

            .slick-next:before {
                content: '→';
                color: #000;
                font-size: 26px;
                position: relative;
                right: 0em;
                bottom: .3em;
            }

            .slick-next, .slick-prev {
                -webkit-transform: translate(0,-85%);
                -ms-transform: translate(0,-85%);
                transform: translate(0,-85%);
                top: -25px;
                left: 35px;
            }
            .view_all{
                width: 80%;
                margin: auto;
            }
            .view_all h5 a{
                text-transform: uppercase;
                color: #252425;
                font-weight: 900;
            }
        </style>
        <?php 
    }
?>