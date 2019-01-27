<?php 
/* 
    this class is used in:
    popular-accessories,
    popular-clothes,
    popular-artworks,
    taxonomy-productcar,
*/
class homepage_product{
    // constant vars
    const POSTTYPE = 'product';
    // static vars
    public $dyepie_tax = 'prod';
    public $posts_per_page = -1;
    public $term_by =  'slug';


    //public function
    public function slug(){
        global $post;
        $term_prod = wp_get_post_terms( $post->ID, $this->dyepie_tax );
        foreach( $term_prod as $prod){
            return $prod->slug;
        }
    }

    // arrow
    public function arrow($attr){
        return '
        <div class="col-md-1 animatedParent">
        <a href="" class="'.$attr.' animated lightSpeedInLeft">
            <i class="fas fa-angle-right next_arrow_one"></i>
        </a>               
        </div>
        ';
    }
    // single arrow
    public function arrow_single($class,$nex_prev){
        echo '
        <button type="button" class="'.$class.'">
        <i class="fas fa-angle-'.$nex_prev.'"></i>
        </button>
        ';
    }
    public function social_media() {
        
     // start social media icons
    $social_animated = 'col-md-4 animated swing socail_i';
    $social_icons = array(
        'fb' => 'fab fa-facebook',
        'yt' => 'fab fa-youtube',
        'tw' => 'fab fa-twitter',
    );
    echo'
        <h2 class="col-md-12 social_head animated swing">Social Media</h2>
        <div class="row social_media">
            <h6 class="col-md-12">Keep In Touch</h6>';
    foreach ($social_icons as $socail => $icons) {
        echo'<i class="' . $icons . ' ' .$social_animated .'"></i>';
    }
    echo '</div>';
}
    public function term_name() {
        global $post;
        $the_term_name = wp_get_post_terms( $post->ID, $this->dyepie_tax );
        foreach( $the_term_name as $the_term){ 
            $the_term;
        }
        return $the_term->name;
    }

    public function homepage_term_sec($term_n) {
        return get_term_by( $this->term_by, $term_n, $this->dyepie_tax);
    }
}
?>