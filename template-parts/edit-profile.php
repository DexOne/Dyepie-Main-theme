<?php 
/* Template Name: Edit Profile */

get_header('custom');
if(is_user_logged_in()){

    // get edit profile form
    get_template_part('template-parts/front-forms/edit-profile-form')?>

    <div id="widgetized-area">
        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('dyepie-widgets')) : else :  endif; ?>
    </div>
<?php 
}else {
    echo('
    <h3 class="must_login">
    Ohh seems you are not A member Yet,<br> you should register to access this page ' . '
    <a href="'.site_url().'/register'.'">'. 'Register' .', </a>
    <a href="'.site_url().'/log-in'.'">'. 'Login' .'</a>
    </h3>');
}
get_footer('login-register');
?>