<?php 
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package dyepie
 * @subpackage dyepie_404
 * @since dyepie 1.0
 */

get_header('login-register'); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<div class="page-wrapper">
				<div class="page-content">
                    <img src="/wp-content/themes/dyepie/images/rick_morty_404.webp" alt="">
                    <?php get_search_form(); ?>
				</div><!-- .page-content -->
			</div><!-- .page-wrapper -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer('login-register');

if(is_404()){ ?>

    <header class="page-header">
        <h1 class="page-title"><?php _e( 'it\'s 404 Morty', 'dyepie' ); ?></h1>
    </header>
<style>
    body{

    }
#wpadminbar{
    display: none;
}

.content-area{
    text-align: center;
    text-transform: capitalize;
}


.page-content h2,
.page-title{
    font-size: 36px !important;

}

.page-title{
    font-size: 60px !important;
    margin-bottom: .5em;
}
.page-content img{
    width: 450px;
    height: auto;
    margin-bottom: 1em;
    border-radius: 20px;
}

div#primary * {
    color: #222;
    font-size: 22px;
    text-align: center;
}

.site-content{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background: #fff;
}

.search_form{
    width: 100%;
    border: 1px solid #ccc;
}

.search_submit{
    margin-top: 1em;
    border-radius: 5px;
    width: 25%;
    background: #222 !important;
    color: #fff !important;
    text-transform: capitalize;
}
</style>
<?php 
}  ?>