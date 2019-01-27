<?php
$search = new homepage_product();
get_header('login-register');	
?>
<main class="author_main" class="site-main ajax_posts" role="main">
<div class="row author_product">
<aside class="col-md-3 aside_left">
        <div class="col-md-12 animatedParent position-fixed fixed-top hold_search_socail">
            <?php
            echo '<img class="dyepie_logo" src="/wp-content/themes/dyepie/images/all-about-handmade.png" >'; ?>
                <a class="back-home" href="<?php echo home_url() ?>"><< Back To dyepie</a>
            <?php 
            _e('<h2 class="col-md-12 search_results  ">best matches results for' . '<br> "' . get_query_var('s') . '"' .'</h2>');
                get_search_form();  
                $search->social_media();
            ?>

        </div>
</aside>
<aside class="col-md-9 search-content">
    <div class="row container">
<?php 
$s=get_search_query();
$args = array(
    's' =>$s,
    'posts_per_page' => -1,
    'post_type' => $search::POSTTYPE,
    'tax_query' => array(
        array(
            'taxonomy' => $search->dyepie_tax,
            'feild'    => $search->slug(),
            'terms'    => $search->term_name(),
        )
    ),
);
    // The Query
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
           $the_query->the_post();
                 ?>
            <div class="col-md-4 post-info">
			    <div class="author-products-container">
            <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
            ?>
				 <?php echo '<img class="img_prod" src="'. $url .'" alt="">'; ?>
                    <div class="author-products-overlay hold-title">
                        <h2 class="title-h2">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                            <?php echo $search->term_name(); ?>
                        </h2>	
                    </div>
				</div>
            </div>
    <?php
        }
    }else{
?>
        <div class="search_results missing_search_results">
        <h2 class="">Oh,Nothing Found</h2>
            <?php 
            echo'
          <p>Sorry, but nothing matched "'. get_search_query($s)  .'" Please try again with some different keywords.</p>'; ?>
        </div>
<?php } ?>
</div>
    </aside>
</div><!-- end col-md-8 -->
    </main>
<?php get_footer('login-register'); ?>
<?php // dyepie Template
if(is_search()){ ?>
<style>
    #wpadminbar{
    display: none;
}
    body{
        background: none;
    }
    html{
    background-image: url(/wp-content/themes/dyepie/images/login-bg.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: right;
    min-height: 100%;
    margin: 0 auto !important;
    background-attachment: fixed;
  }
  .dyepie_logo{
            height: auto;
        }
        /* search page styles */
        .aside_left
        {
            background: #fff;
        }

        .search_results{
            font-size: 21px;
            text-transform: capitalize;
            background: rgba(0, 0, 0, 0.1);
            color: #212529;
            padding: .5em;
            text-align: center;
        }

        .missing_search_results{
            width: 100%;
            text-align: center;
            padding: 1em;
            background: rgba(0, 0, 0, 0.3);
            color: #fff;
            text-transform: capitalize;
            margin: auto;
            position: absolute;
            left: 0;
            right: 0;
            bottom: 35%;
        }
        .search-content{
            min-height: 100vh;
        }
        .hold_search_socail{
            min-height: 100%;
            width: 25%;
            display: grid;
            justify-items: center;
            align-items: center;
        }
        .socail_i {
            font-size: 35px;
            margin-top: .5em;
        }
        /* end search page */
</style>
<?php 
} ?>