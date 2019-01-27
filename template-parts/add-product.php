<?php 
/* Template Name: Add Product */
get_header('custom');
if(is_user_logged_in()){
// if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == "product" && isset($_POST['submit'])):
if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $title          =   $_POST['title'];
    $content        =   $_POST['content'];
    $post_type      =   'product';
    $prod  =   $_POST['prod'];

    //the array of arguements to be inserted with wp_insert_post
    $front_post = array(
    'post_title'    => $title,
    'post_content'  => $content,
    'post_status'   => 'publish',          
    'post_type'     => $post_type 
    );

    //insert the the post into database by passing $new_post to wp_insert_post
    //store our post ID in a variable $pid
    $post_id = wp_insert_post($front_post);
    //we now use $pid (post id) to help add out post meta data
    update_post_meta($post_id, 'single_product_shipping', $_POST["single_product_shipping"]);
    update_post_meta($post_id, 'single_product_price', $_POST["single_product_price"]);
    update_post_meta($post_id, 'single_product_material', $_POST["single_product_material"]);
    update_post_meta($post_id, 'single_product_wieght', $_POST["single_product_wieght"]);
    update_post_meta($post_id, 'single_product_wieght-unit', $_POST["single_product_wieght-unit"]);
    update_post_meta($post_id, 'single_product_made-in', $_POST["single_product_made-in"]);
    // handle upload
    // Set Thumbnail
    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    require_once(ABSPATH . "wp-admin" . '/includes/media.php');

    $attachment_id = media_handle_upload('thumbnail', $post_id);
    
    if (!is_wp_error($attachment_id)) { 
            set_post_thumbnail($post_id, $attachment_id);
        }

        $five_images = array(
            'single_product_one',
            'single_product_two',
            'single_product_three',
            'single_product_four',
            'single_product_five',
        );
        foreach($five_images as $src){

        $attach_id = media_handle_upload($src, $post_id);

        if (is_numeric($attach_id)) {
            $img_attach = wp_get_attachment_image_src($attach_id, array('500', '500'),'');
            $value = $img_attach[0];
                        
            update_post_meta($post_id, $src, $value);
        }
    }
    //ref. https://codex.wordpress.org/Function_Reference/wp_set_object_terms
	////for taxonomy 'news-category'//////////////////////////////
	$cat_ids = array($prod);
	$cat_ids = array_map( 'intval', $cat_ids );
	$cat_ids = array_unique( $cat_ids );
    $term_taxonomy_ids = wp_set_object_terms($post_id, $cat_ids, 'prod' );

    // after product added successfully
    $new_title = str_replace(' ', '-',$title);
    echo '
    <h3 class="success_prod">
    Product successfully added,<br> if you want to view it click' . '<a href="' . site_url().'/product/'.  $new_title .'">'. $title .'</a></h3>';
    //your redirect
    die();    
}
?>
<div class="container add_product">
    <div class="over_hold">
    <form id="featured_upload" method="POST" name="product" action="" enctype="multipart/form-data" class="row add_prod_form">
    <h1 class="col-sm-12 add_prod_head">Adding Your Products Now , Is true Easy!</h1>
    <div class="col-sm-12 add_title_content">
            <input type="text" class="input" name="title" placeholder="product title" required>
            <textarea class="form-control add_textarea_content" name="content" placeholder="descripe your product" rows="3" required></textarea>

    </div>
    <div class="col-sm-12 add_prod_info">
            <label class="add_input_label">Shipping :</label>
            <select class="custom-select" name="single_product_shipping">
                <option value="Available">Available</option>
                <option value="Unavailble">Unavailble</option>
                <option value="Available-only-one-week">Available only one week</option>
                <option value="Unavailble-before-one-week">Unavailble before one week</option>
            </select>
            <label class="add_input_label">Price :</label>
            <input type="number" class="input" name="single_product_price" placeholder="add only numbers" min="1" max="1000" required />
            <label class="add_input_label">Materials :</label>
            <select class="custom-select" name="single_product_material">
                <option value="Wood">Wood</option>
                <option value="Plastic">Plastic</option>
                <option value="Metal">Metal</option>
                <option value="Fabric">Fabric</option>
                <option value="Glass">Glass</option>
                <option value="Paper">Paper</option>      
            </select>
            <label class="add_input_label">Wieght :</label>
            <input type="number" class="input" name="single_product_wieght" placeholder="add your product's wieght" required />
            <label class="add_input_label">Wieght Unit :</label>
            <select class="custom-select" name="single_product_wieght-unit">
                <option value="gram">gram (g)</option>
                <option value="kilogram">kilogram (kg)</option>    
            </select>
            <label class="add_input_label">Add Country :</label>
            <input type="text" class="input" name="single_product_made-in" placeholder="made-in" required />
    </div>
    <div class="row col-sm-12 add_tax_album">
        <label class="add_input_label">select category :</label>
        <?php
        //ref. https://codex.wordpress.org/Function_Reference/get_terms
        $terms = get_terms("prod",'order_by=count&hide_empty=0');
    if ( !empty( $terms ) && !is_wp_error( $terms ) ){
        echo "<select class=\"custom-select\" name='prod' required>";    
        foreach ( $terms as $term ) {
        echo "<option value='".$term->term_id."'>" . $term->name . "</option>";
            
        }
        echo "</select>";
    }
        ?>
    <div class="col-sm-12 input-group add_upload">
    <label class="add_input_label">upload product Cover Image :</label>

            <input type="text" class="form-control" readonly>
            <div class="input-group-btn">
            <span class="fileUpload btn btn-success">
                <span class="upl" id="upload">Upload file</span>
                <input name="thumbnail" type="file" class="upload up" id="up" onchange="readURL(this);" required />
                </span><!-- btn-orange -->
            </div><!-- btn -->
        </div><!-- group -->



    <div class="col-sm-12 row  upload_5_images">
        <label class="col-sm-12 add_input_label">upload 5 images for your product :</label>
        <div class="col-sm-12 input-group add_upload">
            <input type="text" class="form-control" readonly>
            <div class="input-group-btn">
            <span class="fileUpload btn btn-success">
                <span class="upl" id="upload">Upload file</span>
                <input name="single_product_one" type="file" class="upload up" id="up" onchange="readURL(this);" required />
                </span><!-- btn-orange -->
            </div><!-- btn -->
        </div><!-- group -->
        <div class="col-sm-12 input-group add_upload">
            <input type="text" class="form-control" readonly>
            <div class="input-group-btn">
            <span class="fileUpload btn btn-success">
                <span class="upl" id="upload">Upload file</span>
                <input name="single_product_two" type="file" class="upload up" id="up" onchange="readURL(this);" required />
                </span><!-- btn-orange -->
            </div><!-- btn -->
        </div><!-- group -->
        <div class="col-sm-12 input-group add_upload">
            <input type="text" class="form-control" readonly>
            <div class="input-group-btn">
            <span class="fileUpload btn btn-success">
                <span class="upl" id="upload">Upload file</span>
                <input name="single_product_three" type="file" class="upload up" id="up" onchange="readURL(this);" required />
                </span><!-- btn-orange -->
            </div><!-- btn -->
        </div><!-- group -->
        <div class="col-sm-12 input-group add_upload">
            <input type="text" class="form-control" readonly>
            <div class="input-group-btn">
            <span class="fileUpload btn btn-success">
                <span class="upl" id="upload">Upload file</span>
                <input name="single_product_four" type="file" class="upload up" id="up" onchange="readURL(this);" required />
                </span><!-- btn-orange -->
            </div><!-- btn -->
        </div><!-- group -->
        <div class="col-sm-12 input-group add_upload">
            <input type="text" class="form-control" readonly>
            <div class="input-group-btn">
            <span class="fileUpload btn btn-success">
                <span class="upl" id="upload">Upload file</span>
                <input name="single_product_five" type="file" class="upload up" id="up" onchange="readURL(this);" required />
                </span><!-- btn-orange -->
            </div><!-- btn -->
        </div><!-- group -->
    </div>
    </div>

    <div>

    </div>
    <div class="col-sm-12">
        <input  class="publish_btn" type="submit" name="submit" value="publish" />
            <input type="hidden" name="action" value="product" />
    </div>
    </form>
    </div>
</div>

<?php

} //end if user regiser only
else{
    echo('
    <h3 class="must_login">
    Ohh seems you are not A member Yet,<br> you should register to add new products' . '
    <a href="'.site_url().'/register'.'">'. 'Register' .', </a>
    <a href="'.site_url().'/log-in'.'">'. 'Login' .'</a>
    </h3>');
}
get_footer();
if(is_page('add-product')){ ?>
        <style>
        .input{
            border: 1px solid #ddd;
            padding: .5em;  
            background: rgba(233, 236, 239, 0.5);
        }
        
        </style>
        <?php 
    }

    if (!(is_user_logged_in()) && is_page('add-product')){ ?>
        <style>
        /* .add_product{
          display: none !important
        }
         */
        </style>
        <?php
    }
?>