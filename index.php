<?php 
/*-----------------------------------
--=-=-=-=-=-=-- OH THAT'S --=-=-=-=--
--=-=-- ANOTHER BETTER LINES  --=-=--
-----------------------------------*/
get_header();
    $sections = array('accessories','artwork','clothes','profiles',);
    // loop throught sections
    foreach($sections as $sec_name){
        get_template_part('/template-parts/popular-'. $sec_name);
    }
get_footer();
 ?>