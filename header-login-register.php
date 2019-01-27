<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        <?php
        if(is_404()){
            echo '404 Not Found';
        }
        elseif(is_search()){
            echo 'Search results about' . ' ' . get_search_query();
        }
         else{
            echo $current_page_title = get_the_title(); 
        }
        ?>
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
<body <?php body_id_dynamic(); body_class(); ?>>
    
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PBCV9H7"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    
<?php 
    if (is_404()) { 
        $site_url = site_url();
        header( "refresh:15;url=$site_url" );
        echo '<h3 class="text-center">
        You\'ll be redirect to dyepie.COM in about 15 secs. <br> If not, click 
            <a href="'. site_url('/index.php') .'">here</a>. <br>
            until that you can use search
            </h3>
            ';
    }     
?>