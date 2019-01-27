<?php 
$archive_product = new homepage_product();
get_header('custom'); 
// get taxonomy terms
$terms = wp_get_post_terms( $post->ID, 'prod' );
    foreach( $terms as $term){ $term->name; }
?>
<div class="entry-content">
    <?php 
    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'tax_query' => array(
            'taxonomy' => $archive_product->dyepie_tax,
            'feild'    => $archive_product->slug(),
            'terms'    => $term->term_id,
        ),
    );
    $my_posts = new WP_Query( $args );
    if ( $my_posts->have_posts() ) : 
    ?>
        <h1 class="all_hot_prod">Hot Products From `All Categories`</h1>
        <h4 class="click_load_more">click "Load More" to show new products</h4>
        <div class="my-posts row container">
            <div class="col-md-8 row">
            </div>
            <div id="adv_hold" class="hold_adv col-md-4">
                <h6 class="adv_head">Advertise</h6>
                    <img src="/wp-content/themes/dyepie/images/slider-4.jpg" alt="" >
                    <img src="/wp-content/themes/dyepie/images/slider-4.jpg" alt="" >
                    <div class="row social_medai animatedParent animateOnce">
                    <?php $archive_product->social_media(); ?>
                    </div>
                </div>
        </div>
    <?php endif ?>
    <div class="loadmore">
        Load More >>
    </div>
    <h3 class="ha"></h3>
</div>
<?php 
get_footer('login-register');
?>
<section class="rand-product">
    <?php get_template_part('/template-parts/random', 'prod') ?>
</section>
<?php 
if(is_archive()){ ?>
    <style>
        .overlay{
            width: 100% !important;
            height: 100%;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .hold_adv{
            position: absolute;
            right: 0;
            z-index: 9999;
            width: 20%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 1em;
        }
        .hold_adv img{
            width: 200px;
            margin-bottom: .5em;
            height: 175px;
        }
        .stick{
            position: fixed;
            top: 2.5em;
            right: 0;
            bottom: 0;
            border-left: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }
        .my-posts div{
            margin: auto;
            padding: 0;
        }
        .product_hold{
            margin-bottom: 1.5% !important;
            background-size: cover;
            background-origin: border-box;
            background-repeat: no-repeat;
            border-left: 1px solid rgba(255, 255, 255, 0.2);
            border-right: 1px solid rgba(255, 255, 255, 0.2);
        }

    

        .prod_title{
            width: 100%;
            text-align: center;
            font-size: 29px;
            font-weight: 900;
            text-transform: capitalize;
            color: #fff;
        }
        .prod_title:hover{
            color: #ddd;
            text-decoration: none;
        }
        .prod_tags {
            border-bottom: 1px solid rgba(255, 255, 255, 0.45);
        }
        .prod_tags a{
            color: #ccc;
        }

        .loadmore {
            width: 87%;
            margin: auto;
            text-align: left;
            font-size: 36px;
            cursor: pointer;
            padding-bottom: 1em;
        }

        .all_hot_prod{
            width: 86%;
            margin: 1em auto;
            padding-top: .5em;
            text-align: center;
        }

        h3.ha {
            width: 90%;
            margin: auto;
            padding: 1em;
            text-transform: capitalize;
            font-weight: 900;
            letter-spacing: 1px;
            text-align: center;
        }
        .row.social_media h6 {
            font-size: 26px;
            text-align: center;
        }

        .row.social_media i {
            text-align: center;
            font-size: 31px;
        }
        .click_load_more{
            color: #89aa9a;
            text-shadow: 0px 0px 5px #fff;
            text-transform: capitalize;
            text-align: center;
        }
    </style>
<?php } ?>

<script type="text/javascript">
var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
var page = 1;
jQuery(function($) {
    $('body').on('click', '.loadmore', function() {
        var data = {
            'action': 'load_posts_by_ajax',
            'page': page,
            'security': '<?php echo wp_create_nonce("load_more_posts"); ?>',
        };
        max = '<?php echo $my_posts->max_num_pages; ?>';

        $.post(ajaxurl, data, function(response) {
            $('.my-posts').append(response);
            if (page > max) {
                // end of posts
                $('.loadmore').css('display', 'none');
                $(".ha").append("Ohh!, No more Products");
            }
            page++;
        });
    });
});
</script>