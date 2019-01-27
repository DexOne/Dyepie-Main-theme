<?php
/* Template Name: Login Page */ ?>
<?php 
get_header('login-register'); ?>
<main class="container hold_login_form">
    <div class="row login_register_nav">
        <div class="col-md-12 login_register_links">
                <a class="btn login_active">Sign in</a>
                <a href="<?php echo site_url() . '/register'; ?>" class="btn">Sign up </a>
        </div>
        <div class="col-md-12">
            <?php get_template_part('template-parts/login', 'backend'); ?>
            <div class="hr_container">
            <hr class="login_register_hr">
            </div>
            <div class="forget_pass">
            <a href="<?php echo wp_lostpassword_url(); ?>" title="Lost Password">Forgot Password?</a>
            <p>
            <a href="<?php echo home_url() ?>">D Y E P I E . C O M</a>
            </p>           
         </div>
        </div>
    </div>
</main>

    <?php 
    if(is_user_logged_in()){ ?>
    <div class="loggedin_user">
        <?php print('you are logged in click to back home'. '
          <a href="' . home_url() . '">dyepie.com</a>
          or
          <a href="'. wp_logout_url(get_the_permalink()) . '">Logout</a>')
          ?>   
    </div>
    <?php
} 
if(is_page('log-in')){ ?>
<style>
    body{
        background: rgba(66, 89, 83, 0.69);
        min-height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    html{
    background-image: url(/wp-content/themes/dyepie/images/login-bg.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    height: 100%;
    margin: 0 auto !important;
  }
</style>
<?php 
} ?>
<?php 
get_footer('login-register'); ?>