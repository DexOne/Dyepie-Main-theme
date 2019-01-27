<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        <?php echo $blog_title = get_bloginfo( 'name' ); ?>
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <?php wp_head() ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-132663926-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'UA-132663926-1');
        </script>
        
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-PBCV9H7');</script>
        <!-- End Google Tag Manager -->
</head>
<body <?php body_id_dynamic();body_class(); ?> >
    
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PBCV9H7"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    
    <main class="main">
        <nav class="navbar navbar-expand-lg navbar-light bg-light dyepie_navbar">
            <div class="row middle_size_container">
                <a class="navbar-brand" href="#">DYEPIE.COM</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                    <?php /* Primary navigation */
                        wp_nav_menu( array(
                            'menu' => 'header_menu',
                            'depth' => 2,
                            'container' => false,
                            'menu_class' => 'nav',
                            //Process nav menu using our custom nav walker
                            'walker' => new wp_bootstrap_navwalker())
                        );
                        ?>
                </div>
                <div class="login_main">
                    <a class="login-trigger" href="#" data-target="#login" data-toggle="modal">SIGN IN - SIGN UP</a>
                    <div id="login" class="modal fade" role="dialog">
                        <div class="modal-dialog">                       
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button data-dismiss="modal" class="close">&times;</button>
                                    <?php get_template_part('template-parts/login', 'frontjs') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="logout">
                    <a class="log-out-trigger" href="<?php echo wp_logout_url(home_url());
                    ?>">LogOut</a>
                </div>
        </nav>
            <?php get_template_part('template-parts/header-footer/header','slider');?>
</main>